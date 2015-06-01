@extends('base')

@section('css')
<link rel="stylesheet" href="/css/board.css">
@endsection

@section('content')
<div class="content">
    @if(count($boards)>0)
    <h2>My Boards</h2>
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

    {{-- @if() --}}
    <br><br>
    <h2>Invited boards</h2>
    <div class="ui grid board">
        <div class="four wide column">
            <a href="#">
                <div class="box">
                    <h3>Board 1 Lorem ipsum dolor sit amet, .</h3>
                    <div class="corner-edit">
                        <i class="ion-ios-compose-outline edit"></i>
                        <i class="ion-ios-trash-outline delete"></i>
                    </div>
                </div>
            </a>
        </div>
    </div>
    {{-- @endif --}}
</div>
@endsection
