@extends('base')

@section('css')
<link rel="stylesheet" href="/css/card.css">
@endsection

@section('content')
<div class="ui right vertical labeled icon sidebar menu histories">
    <h2 class="item">Histories</h2>
    @foreach ($board->histories() as $history)
        <p class="item">{{ $history->user->name }} has {{ $history->did }} {{ $history->history }} : <b>{{ $history->name }}</b></p>
    @endforeach
</div>

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

<div class="content">
    <div class="board-menu">
        <div class="ui labeled icon button">
            <i class="plus icon"></i>Add New Card
        </div>
        <div class="ui labeled icon button" onclick="collaboratorSidebar()">
            <i class="users icon"></i>Collaborators
        </div>
        <div class="ui labeled icon button" onclick="viewHistory()">
            <i class="history icon"></i>History
        </div>
    </div>

    <div class="column">
        <h2>Board : <span>Board Title</span></h2>
    </div>

    <div class="ui two column centered grid">
        <div class="four column centered row">
            <div class="grid-content">
                <div class="ui grid">
                    <div class="six wide column">
                        <div class="card">
                            <h4>Card 1 Tittle</h4>
                            <div class="ui action input">
                                <input type="text" placeholder="Edit here . . .">
                                <button class="ui icon button">
                                <i class="checkmark icon"></i>
                                </button>
                                <button class="ui icon button">
                                <i class="remove icon"></i>
                                </button>
                            </div>
                            <ul>
                                <li>
                                    <div class="ui checkbox check">
                                        <input type="checkbox" name="fun">
                                        <label>Lorem ipsum dolor sit. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consectetur adipisicing.</label>
                                    </div>
                                    <div class="corner-edit">
                                        <i class="edit icon"></i>
                                        <i class="trash icon"></i>
                                    </div>
                                </li>
                                <li class="done">
                                    <div class="ui checkbox check">
                                        <input type="checkbox" name="fun">
                                        <label>Lorem ipsum dolor sit amet, consectetur adipisicing.</label>
                                    </div>
                                    <div class="i">
                                        <i class="ion-ios-compose-outline"></i>
                                        <i class="ion-ios-trash-outline"></i>
                                    </div>
                                </li>
                            </li>
                            <li>
                                <div class="ui checkbox check">
                                    <input type="checkbox" name="fun">
                                    <label>Lorem ipsum dolor sit amet.</label>
                                </div>
                                <div class="i">
                                    <i class="ion-ios-compose-outline"></i>
                                    <i class="ion-ios-trash-outline"></i>
                                </div>
                            </li>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="six wide column">
                <div class="card">
                    <h4>Card 2 Tittle is here</h4>
                    <ul>
                        <li>
                            <div class="ui checkbox check">
                                <input type="checkbox" name="fun">
                                <label>Lorem ipsum dolor sit.</label>
                            </div>
                        </li>
                        <li>
                            <div class="ui checkbox check">
                                <input type="checkbox" name="fun">
                                <label>Lorem ipsum dolor sit amet, consectetur adipisicing.</label>
                            </div>
                        </li>
                    </li>
                    <li>
                        <div class="ui checkbox check">
                            <input type="checkbox" name="fun">
                            <label>Lorem ipsum dolor sit amet.</label>
                        </div>
                    </li>
                </li>
                <li>
                    <div class="ui checkbox check">
                        <input type="checkbox" name="fun">
                        <label>Lorem ipsum dolor sit amet, consectetur adipisicing.</label>
                    </div>
                </li>
            </li>
            <li>
                <div class="ui checkbox check">
                    <input type="checkbox" name="fun">
                    <label>Lorem ipsum dolor sit amet.</label>
                </div>
            </li>
        </li>
        <li>
            <div class="ui checkbox check">
                <input type="checkbox" name="fun">
                <label>Lorem ipsum dolor sit. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consectetur adipisicing.</label>
            </div>
            <div class="i">
                <i class="ion-edit"></i>
            </div>
        </li>
        <li>
            <div class="ui checkbox check">
                <input type="checkbox" name="fun">
                <label>Lorem ipsum dolor sit amet, consectetur adipisicing.</label>
            </div>
            <div class="i">
                <i class="ion-ios-compose-outline"></i>
                <i class="ion-ios-trash-outline"></i>
            </div>
        </li>
    </li>
    <li>
        <div class="ui checkbox check">
            <input type="checkbox" name="fun">
            <label>Lorem ipsum dolor sit amet.</label>
        </div>
        <div class="i">
            <i class="ion-ios-compose-outline"></i>
            <i class="ion-ios-trash-outline"></i>
        </div>
    </li>
</li>
</ul>
</div>
</div>
<div class="six wide column">
<div class="card">
<h4>Card 1 Tittle</h4>
<ul>
<li>
    <div class="ui checkbox check">
        <input type="checkbox" name="fun">
        <label>Lorem ipsum dolor sit.</label>
    </div>
</li>
<li>
    <div class="ui checkbox check">
        <input type="checkbox" name="fun">
        <label>Lorem ipsum dolor sit amet, consectetur adipisicing.</label>
    </div>
</li>
</li>
<li>
<div class="ui checkbox check">
    <input type="checkbox" name="fun">
    <label>Lorem ipsum dolor sit.</label>
</div>
</li>
<li>
<div class="ui checkbox check">
    <input type="checkbox" name="fun">
    <label>Lorem ipsum dolor sit amet, consectetur adipisicing.</label>
</div>
</li>
</li>
</ul>
</div>
</div>
<div class="six wide column">
<div class="card">
<h4>Card 1 Tittle</h4>
<ul>
<li>
<div class="ui checkbox check">
<input type="checkbox" name="fun">
<label>Lorem ipsum dolor sit.</label>
</div>
</li>
<li>
<div class="ui checkbox check">
<input type="checkbox" name="fun">
<label>Lorem ipsum dolor sit amet, consectetur adipisicing.</label>
</div>
</li>
</li>
<li>
<div class="ui checkbox check">
<input type="checkbox" name="fun">
<label>Lorem ipsum dolor sit.</label>
</div>
</li>
<li>
<div class="ui checkbox check">
<input type="checkbox" name="fun">
<label>Lorem ipsum dolor sit amet, consectetur adipisicing.</label>
</div>
</li>
</li>
</ul>
</div>
</div>
</div>
</div>
</div>
@endsection
