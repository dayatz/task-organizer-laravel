<?php namespace App\Http\Controllers;

use Illuminate\Support\Facades\Request;
use App\Todo;
use App\BoardHistory;
use Auth;

class TodoController extends Controller {
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function addTodo() {
        if (Request::ajax()) {

            try {
                $todo = new Todo;
                $todo->name = Request::input('todo');
                $todo->user_id = Auth::user()->id;
                $todo->done = false;
                $todo->card_id = Request::input('card_id');
                $todo->save();

                // return 'success';
                return array(
                    'id' => $todo->id,
                    'name' => $todo->name
                );
            } catch (Exception $e) {
                return $e;
            }
        }
    }

    public function toggleTodo($id) {
        try {
            $todo = Todo::findOrFail($id);
            $todo->done = Request::input('done');
            $todo->save();
            return 'success';
        } catch (Exception $e) {
            return $e;
        }
    }

    public function deleteTodo($id) {
        try {
            $todo = Todo::find($id);
            
            $history = new BoardHistory;
            $history->board_id = Request::input('board_id');
            $history->user_id = Auth::user()->id;
            $history->did = "deleted";
            $history->history = "Todo";
            $history->name = $todo->name;
            $history->save();

            $todo->delete();

            return 'success';
        } catch (\Exception $e) {
            return 'error';
        }
    }

    public function editTodo($id) {
        try {
            $todo = Todo::find($id)->firstOrFail();
            $todo->name = Request::input('todo_name');
            $todo->save();
            return 'success';
        } catch (\Exception $e) {
            return 'error';
        }
    }
}
