@extends('base')

@section('css')
<link rel="stylesheet" href="/css/card.css">
@endsection

@section('content')
<input type="hidden" name="board_id" value="{{ $board->id }}">

<!-- board history -->
<div class="ui right vertical labeled icon sidebar menu histories">
    <h2 class="item">Histories</h2>
    @foreach ($board->histories as $history)
        <p class="item">
            <b>{{ $history->user->name }}</b> has {{ $history->did }} {{ $history->history }} : <b>{{ $history->name }}</b>
        </p>
    @endforeach
</div>

<!-- board collaborators -->
<div class="ui right vertical labeled icon sidebar menu collaborators">
    <h2 class="item">Histories</h2>
    <p class="item">Ela</p>
    <p class="item">Dayat</p>
    <p class="item">Emet</p>
    <p class="item">Ela ela ela ela ela elaaaa 4</p>
    <p class="item">Ela ela ela ela ela elaaaa 5</p>
    <p class="item">Ela ela ela ela ela elaaaa 6</p>
    <p class="item">Ela ela ela ela ela elaaaa 7</p>
    <p class="item">Ela ela ela ela ela elaaaa 8</p>
    <p class="item">Ela ela ela ela ela elaaaa 9</p>
    <p class="item">Ela ela ela ela ela elaaaa 10</p>

    <div class="item">
    <input type="text" placeholder="Invites by email" style="position:fixed;bottom:0;width:100%">
    </div>
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
                    <div class="four wide column">
                        <div class="card">
                            <h4 style="color: #fff">{{ $card->name }}</h4>
                            <div class="ui action input">
                                <input type="text" placeholder="Edit here . . .">
                                <button class="ui icon button">
                                <i class="checkmark icon"></i>
                                </button>
                                <button class="ui icon button">
                                <i class="remove icon"></i>
                                </button>
                            </div>

                            <ul class="todo-container">
                                @foreach ($card->todos as $todo)
                                <li>
                                    <div class="ui checkbox check">
                                        <input type="checkbox" name="fun">
                                        <label>{{ $todo->name }}</label>
                                    </div>
                                    <div class="corner-edit">
                                        <i class="edit icon"></i>
                                        <i class="trash icon"></i>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    @endforeach
                </div>
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
@endsection

@section('custom_js')
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
@endsection
