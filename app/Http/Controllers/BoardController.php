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
        $invites = BoardCollaborator::where('user_id', '=', Auth::user()->id)->get();
        return view('board', [
            'boards' => $boards,
            'invites' => $invites
        ]);
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
        try {
            $board = Board::find($id);
            $x = $board->collaborators->lists('user_id');
            if (($board->user_id == Auth::user()->id) || in_array(Auth::user()->id, $x) ) {
                return view('boarddetail', ['board' => $board]);
            }
        } catch (\Exception $e) {
            return Redirect::route('home');
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
                    return [
                        'name' => $c->user->name,
                        'email' => $c->user->email
                    ];
                } catch (\Exception $e) {
                    return $e;
                }
            } catch (\Exception $e) {
                return 'not_found';
            }
        }
    }

    public function leaveCollaborator() {
        if (Request::ajax()) {
            try {
                $match = ['board_id' => Request::input('board_id'), 'user_id' => Auth::user()->id];
                $c = BoardCollaborator::where($match);
                $c->delete();
                return 'success';
            } catch (\Exception $e) {
                return 'error';
            }
        }
    }

    public function deleteBoard($id) {
        try {
            $board = Board::find($id)->firstOrFail();
            
            if (Auth::user()->id != $board->user_id) {
                return 'not authorized';
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
            if (Auth::user()->id != $board->user_id) {
                return 'not authorized';
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

            return "$board->name";
        } catch (\Exception $e) {
            return "error";
        }
    }
}

?>
