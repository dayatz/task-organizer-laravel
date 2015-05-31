<?php namespace App\Http\Controllers;

use App\User;
use App\Board;
use App\Todo;
use App\BoardCollaborator;
use App\BoardHistory;
use App\Card;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Redirect;
use Auth;
use Log;
class BoardController extends Controller {
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() {
        $boards = Auth::user()->boards;
        return view('home', ['boards' => $boards]);
    }

    public function addBoard() {
        if (Request::ajax()) {
            $board_name = Request::input('board_name');

            try {
                $board = new Board;
                $board->name = $board_name;
                $board->user_id = Auth::user()->id;
                $board->save();

                return array(
                    'id' => $board->id,
                    'name' => $board->name
                );
            } catch (Exception $e) {
                return 'error';
            }
        }
    }

    public function boardDetail($id) {
        $board = Board::find($id);
        $x = $board->collaborators->lists('user_id');
        if (($board->user_id == Auth::user()->id) || in_array(Auth::user()->id, $x) ) {
            return view('board', ['board' => $board]);
        }
        return Redirect::route('home');
    }

    public function addCollaborator() {
        if (Request::ajax()) {
            try {
                $user = User::where('email', Request::input('user_email'))->firstOrFail();
                try {
                    $c = new BoardCollaborator;
                    $c->board_id = Request::input('board_id');
                    $c->user_id = $user->id;
                    $c->save();
                    return 'success';
                } catch (\Exception $e) {
                    return $e;
                }
            } catch (\Exception $e) {
                return 'not_found';
            }
        }
    }

    public function deleteBoard($id) {
        try {
            $board = Board::find($id);
            
            if (Auth::user()->id != $board->id) {
                return 'error';
            }

            $cards = Card::where('board_id', '=', $id);

            $card_ids = $cards->lists('id');
            $todos = Todo::whereIn('card_id', $card_ids);

            $collaborators = BoardCollaborator::where('board_id', '=', $id);
            $histories = BoardHistory::where('board_id', '=', $id);

            $board->delete();
            $cards->delete();
            $todos->delete();
            $collaborators->delete();
            $histories->delete();

            return 'success';
        } catch (\Exception $e) {
            return 'error';
        }
    }

    public function editBoard($id) {
        try {
            $board = Board::find($id)->firstOrFail();
            if (Auth::user()->id != $board->id) {
                return 'error';
            }
            $board->name = Request::input('board_name');
            $board->save();

            $history = new BoardHistory;
            $history->board_id = $id;
            $history->user_id = Auth::user()->id;
            $history->did = "edited";
            $history->history = "Board";
            $history->name = $board->name;
            $history->save();

            return 'success';
        } catch (\Exception $e) {
            return 'error';
        }
    }
}

?>
