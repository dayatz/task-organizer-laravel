@extends('app')

@section('content')
<div class="container">
    <input type="hidden" name="board_id" value="{{ $board->id }}">
    <div class="row">
        <div class="col-md-10">
            <div class="panel panel-default">
                <div class="panel-heading">Board: {{ $board->name }}
                <button class="btn btn-xs btn-danger" onclick="deleteBoard({{ $board->id }})">X</button>
                <a type="button" class="btn btn-sm btn-default pull-right" data-toggle="modal" data-target=".add-card-modal">Add Card</a>
                </div>

                <div class="panel-body">
                    <div class="row board-container">
                        @foreach ($board->cards as $card)
                            <div class="col-md-4 card-container" card-id="{{ $card->id }}">
                                <div class="panel panel-default">
                                    <div class="panel-heading">{{ $card->name }}
                                        <button class="btn btn-danger btn-xs pull-right" onclick="deleteCard({{ $card->id }})">x</button>
                                    </div>
                                    <div class="panel-body card-list">
                                        @foreach ($card->todos as $todo)
                                            <li style="list-style-type:none" todo-id="{{ $todo->id }}">
                                                <input type="checkbox"
                                                    name="check_todo" class="selection_checkbox" value="{{ $todo->id }}"
                                                    @if($todo->done == 1) checked @endif>
                                                <label for="todo-{{ $todo->id }}" class="selection_label">{{ $todo->name }}</label>
                                                <button class="btn btn-danger btn-xs pull-right" onclick="deleteTodo({{ $todo->id }})">
                                                    <span class="i glyphicon glyphicon-trash"></span>
                                                </button>
                                            </li>
                                        @endforeach
                                        <input class="form-control" type="text" name="todo_name" placeholder="Enter new task..." card-id="{{ $card->id }}">
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-2">
            <div class="panel panel-default">
                <div class="panel-heading">Collaborators:
                <a type="button" class="btn btn-default btn-xs pull-right"  data-toggle="modal" data-target=".add-collaborator-modal">+</a>
                </div>
                <div class="panel-body">
                    <!-- <li rel='tooltip' data-toggle="tooltip" data-placement="top" title="{{ Auth::user()->email }}">{{ Auth::user()->name }}</li> -->
                    @foreach ($board->collaborators as $coll)
                    <li rel='tooltip' data-toggle="tooltip" data-placement="top" title="{{ $coll->user->email }}">{{ $coll->user->name }}</li>
                    @endforeach
                </div>
            </div>
        </div>

    </div>
</div>

<div class="modal fade add-card-modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header"><h3>Add new card</h3></div>
            <div class="modal-body">
                <input type="text" class="form-control" name="card_name" placeholder="Enter the card name..." />
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="addCard()">Add</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade add-collaborator-modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header"><h3>Invite other user by email</h3></div>
            <div class="modal-body">
                <input type="text" class="form-control" name="user_email" placeholder="Enter the user email..." />
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="addCollaborator()">Add</button>
            </div>
        </div>
    </div>
</div>
@endsection
