@extends('base')

@section('css')
<link rel="stylesheet" href="/css/board.css">
@endsection

@section('content')
<div class="content">
    @if(count($boards)>0)
    <h2>My Boards ({{count($boards)>0}})</h2>
    <div class="ui grid board">
        @foreach ($boards as $board)
        <div class="four wide column">
            <a href="/board/{{ $board->id }}" id="{{ $board->id }}">
                <div class="box">
                    <h3>{{ $board->name }}</h3>
                    <div class="corner-edit">
                        <i class="ion-ios-compose-outline edit"></i>
                        <i class="ion-ios-trash-outline delete"></i>
                    </div>
                </div>
            </a>
        </div>
        @endforeach
    </div>
    @else
    <h2>You don't have any boards</h2>
    @endif

    @if(count($invites)>0)
    <br><br>
    <h2>Invited boards ({{ count($invites) }})</h2>
    <div class="ui grid board">
        @foreach ($invites as $invite)
        <div class="four wide column">
            <a href="/board/{{ $invite->board_id }}">
                <div class="box">
                    <h3>{{ $invite->board->name }}</h3>
                    <span class="userinvite">{{ $invite->board->user->name }}</span>
                </div>
            </a>
        </div>
        @endforeach
    </div>
    @endif
</div>
@endsection
