@extends('base')

@section('css')
<link rel="stylesheet" href="/css/card.css">
<link rel="stylesheet" href="/css/skins/square/grey.css">
@endsection

@section('content')
<input type="hidden" name="board_id" value="{{ $board->id }}">

<!-- board history -->
<div class="ui right vertical labeled icon sidebar menu histories">
    <h2 class="item">Histories</h2>
    @foreach ($board->histories as $history)
        <p class="item" data-content="{{ date('F d, Y h:ia', strtotime($history->created_at)) }}">
            <b>{{ $history->user->name }}</b> has {{ $history->did }} {{ $history->history }} : <b>{{ $history->name }}</b>
        </p>
    @endforeach
</div>

<!-- board collaborators -->
<div class="ui right vertical labeled icon sidebar menu collaborators">
    <h2 class="item">Collaborators
        @if($board->user_id != Auth::user()->id)
        <button class="ui inverted red button" onclick="$('.modal.leaveboard').modal('show')">
            <i class="external share icon"></i> Leave
        </button>
        @else
        <button class="ui green basic button" onclick="$('.modal.addcollaborator').modal('show')">
            <i class="add user icon"></i> Invite
        </button>
        @endif
    </h2>
    @foreach($board->collaborators as $collaborator)
        <p class="item" id="{{ $collaborator->user_id }}">
            {{ $collaborator->user->name }} ({{ $collaborator->user->email }})
            @if($board->user_id == Auth::user()->id)
            <button class="ui inverted red button" onclick="confirmKick({{ $collaborator->user_id }})">
                kick
            </button>
            @endif
        </p>
    @endforeach
</div>

<div class="mycontent">
    <div class="board-menu">
        <div class="ui icon button addcard" data-content="Add card">
            <i class="plus icon"></i>
        </div>
        <div class="ui icon button" data-content="Collaborators" onclick="collaboratorSidebar()">
            <i class="users icon"></i>
        </div>
        <div class="ui icon button" data-content="Histories" onclick="viewHistory()">
            <i class="history icon"></i>
        </div>
    </div>

    <div class="column">
        <h2>{{ $board->name }}</h2>
        @if(Auth::user()->id != $board->user_id)
        <span class="username">{{ $board->user->name }} ({{ $board->user->email }})</span>
        @endif
    </div>

    <div class="ui two column centered grid">
        <div class="four column centered row">
            <div class="grid-content">
                <div class="ui grid card-container">
                    @foreach($board->cards as $card)
                    <div class="four wide column card-item" id="{{ $card->id }}">
                        <div class="card">
                            <h4>{{ $card->name }}
                                <a href="javascript:;" class="delete-card" id="{{ $card->id }}" onclick="deleteconfirm(this)">
                                    <i class="remove circle outline icon"></i>
                                </a>
                            </h4>
                            <ul class="todo-container">
                                @foreach ($card->todos as $todo)
                                <li class="todo-item @if ($todo->done == 1) done @endif" id="{{ $todo->id }}">
                                    <div class="todo">
                                        <input type="checkbox" name="check_todo" class="check-todo" id="{{ $todo->id }}" @if ($todo->done == 1) checked @endif>
                                        <label>{{ $todo->name }}</label>

                                        <a href="javascript:;" class="delete-todo" id="{{ $todo->id }}" onclick="deleteTodo(event, {{ $todo->id }})">
                                            <i class="trash outline icon"></i>
                                        </a>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                            <input type="text" name="todo_name" class="newtodo" placeholder="Add new todo...">
                        </div>
                    </div>
                    @endforeach
                </div>kickuser
            </div>
        </div>
    </div>
</div>

<div class="ui basic modal addcard">
    <div class="ui two column centered grid">
        <div class="column">
            <input name="card_name" id="card_name" type="text" class="validate" placeholder="Add new card . . .">
        </div>
    </div>
</div>

<div class="ui small modal transition deletemodal" style="margin-top: -97.5px;">
    <i class="close icon"></i>
    <div class="content">
      <p>Are you sure you want to delete this card: <b class="card-name"></b></p>
    </div>
    <div class="actions">
        <div class="ui negative button">No</div>
        <div class="ui positive right labeled icon button okdelete" onclick="deleteCard(this)">
            Yes<i class="checkmark icon"></i>
        </div>
    </div>
</div>

@if($board->user_id == Auth::user()->id)
<div class="ui basic modal addcollaborator">
    <div class="ui two column centered grid">
        <div class="column">
            <input name="user_email" id="card_name" type="text" class="validate" placeholder="Enter the user email. . .">
        </div>
    </div>
</div>
@endif

@if(Auth::user()->id == $board->user_id)
<div class="ui small modal transition kickuser" style="margin-top: -97.5px;">
    <i class="close icon"></i>
    <div class="content">
      <p>Kick this user from board ?</p>
    </div>
    <div class="actions">
        <div class="ui negative button">No</div>
        <div class="ui positive right labeled icon button okkick" onclick="kickUser(this)">
            Yes<i class="checkmark icon"></i>
        </div>
    </div>
</div>
@endif

@if(Auth::user()->id != $board->user_id)
<div class="ui small modal transition leaveboard" style="margin-top: -97.5px;">
    <i class="close icon"></i>
    <div class="content">
      <p>Are you sure to leave this board ?</p>
    </div>
    <div class="actions">
        <div class="ui negative button">No</div>
        <div class="ui positive right labeled icon button okdelete" onclick="leaveBoard({{ $board->id }})">
            Yes<i class="checkmark icon"></i>
        </div>
    </div>
</div>
@endif

@endsection

@section('custom_js')
    <script src="/js/icheck.min.js"></script>
    <script>
    $('.board-menu>.button').popup({
        position: 'left center',
        setFluidWidth: false,
    });

    $(document).on('click', '.button.addcard', function(){
        $('.modal.addcard').modal('show');
    });

    $(document).on('keypress', 'input[name=card_name]', function(e){
        if((e.keyCode || e.which) == 13) {
            addCard();
        }
    });

    apply_icheck();

    $('p.item').popup({
       position: 'top center'
    });
    </script>
@endsection
