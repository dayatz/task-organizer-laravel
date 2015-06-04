<?php namespace App\Http\Controllers;

use Illuminate\Support\Facades\Request;
use App\Card;
use App\Board;
use App\BoardHistory;
use App\Todo;
use Auth;
use View;

class CardController extends Controller {
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function addCard() {
        if (Request::ajax()) {
            $board_id = Request::input('board_id');
            $card_name = Request::input('card_name');

            try {
                $card = new Card;
                $card->board_id = $board_id;
                $card->name = $card_name;
                $card->user_id = Auth::user()->id;
                $card->save();

                $history = new BoardHistory;
                $history->board_id = $board_id;
                $history->user_id = Auth::user()->id;
                $history->did = "created a new";
                $history->history = "Card";
                $history->name = $card_name;
                $history->save();

                // return 'success';
                // return array(
                //     'id' => $card->id,
                //     'name' => $card->name
                // );
                $html = View::make('newcard', [
                    'card' => $card
                ]);
                return $html;
            } catch (Exception $e) {
                return $e;
            }
        }
    }

    public function deleteCard($id) {
        if (Request::ajax()) {
            $card = Card::findOrFail($id);

            $todos = Todo::where('card_id', '=', $id)->delete();

            $history = new BoardHistory;
            $history->board_id = $card->board_id;
            $history->user_id = Auth::user()->id;
            $history->did = "deleted";
            $history->history = "Card";
            $history->name = $card->name;
            $history->save();

            $card->delete();
            return 'success';
        }
    }

    public function editCard($id) {
        try {
            $card = Card::find($id)->firstOrFail();
            $card->name = Request::input('card_name');
            $card->save();

            $history = new BoardHistory;
            $history->board_id = Request::input('board_id');
            $history->user_id = Auth::user()->id;
            $history->did = "edited";
            $history->history = "Card";
            $history->name = $card->name;
            $history->save();

            return 'success';
        } catch (\Exception $e) {
            return 'error';
        }
    }
}
