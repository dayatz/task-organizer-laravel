<?php namespace App\Http\Controllers;

use Illuminate\Support\Facades\Request;
use App\Card;
use App\Board;
use App\Todo;
use Auth;

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

                // return 'success';
                return array(
                    'id' => $card->id,
                    'name' => $card->name
                );
            } catch (Exception $e) {
                return $e;
            }
        }
    }

    public function deleteCard($id) {
        if (Request::ajax()) {
            $card = Card::findOrFail($id);
            $card->delete();

            $todos = Todo::where('card_id', '=', $id)->delete();
            return 'success';
        }
    }

    public function editCard($id) {
        try {
            $card = Card::find($id)->firstOrFail();
            $card->name = Request::input('card_name');
            $card->save();
            return 'success';
        } catch (\Exception $e) {
            return 'error';
        }
    }
}
