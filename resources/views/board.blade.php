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
        <div class="four wide column board-item" id="{{ $board->id }}">
            <a href="/board/{{ $board->id }}" id="{{ $board->id }}">
                <div class="box">
                    <h3>{{ $board->name }}</h3>
                    <div class="corner-edit">
                        <i class="ion-ios-compose-outline edit-board" onclick="editConfirm(event, this)" id="{{ $board->id }}"></i>
                        <i class="ion-ios-trash-outline delete-board" onclick="deleteBoardConfirm(event, this)" id="{{ $board->id }}"></i>
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

<div class="ui small modal transition deletemodal" style="margin-top: -97.5px;">
    <i class="close icon"></i>
    <div class="content">
      <p>Are you sure you want to delete this board: <b class="board-name"></b></p>
    </div>
    <div class="actions">
        <div class="ui negative button">No</div>
        <div class="ui positive right labeled icon button okdelete" onclick="deleteBoard(this)">
            Yes<i class="checkmark icon"></i>
        </div>
    </div>
</div>

<!-- edit board modal -->
<div class="ui small test modal edit transition" style="margin-top: -98px;">
    <div class="ui action input edit-modal">
        <input type="text" placeholder="Edit Name Here..." name="edit_board">
        <button class="ui icon button saveedit" onclick="editBoard(this)">
            <i class="ion-checkmark-round"></i>
        </button>
    </div>
</div>
@endsection

@section('custom_js')
<script>
    deleteBoardConfirm = function(event, e) {
        var e = $(e);
        console.log(e.parents('.box').find('h3').text());
        var target = $('.modal.deletemodal');

        target.find('.board-name').text(e.parents('.box').find('h3').text());
        target.find('.okdelete').attr('id', e.attr('id'));
        target.modal('show');

        event.preventDefault();
        event.stopPropagation();
    }

    editConfirm = function (event, e) {
        var e = $(e);
        var txt = e.parents('.box').find('h3').text();
        var target = $('.modal.edit').modal('show');

        target.find('input').val(txt);
        target.find('button.saveedit').attr('id', e.attr('id'));
        target.modal('show');

        event.preventDefault();
        event.stopPropagation();
    }
</script>
@endsection
