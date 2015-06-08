<div class="four wide column card-item" id="{{ $card->id }}" style="display:none">
    <div class="card" id="{{ $card->id }}">
        <h4><span>{{ $card->name }}</span>
            <a href="javascript:;" class="delete-card" id="{{ $card->id }}" onclick="deleteconfirm(this)">
                <i class="remove circle outline icon"></i>
            </a>

            <a href="javascript:;" class="delete-card edit-card" id="{{ $card->id }}">
                <i class="edit icon"></i>
            </a>
        </h4>
        <div class="editing">
            <div class="ui action input" style="width: 100%">
                <input class="edit-card-name" type="text" placeholder="Edit card name..." value="{{ $card->name }}" id="{{ $card->id }}">
                <button class="ui button green" onclick="saveEditCard({{ $card->id }})">
                    <i class="checkmark icon"></i>
                </button>
                <button class="ui button red cancel-edit-card">
                    <i class="remove icon"></i>
                </button>
            </div>
        </div>
        <ul class="todo-container"></ul>
        <input type="text" name="todo_name" class="newtodo" placeholder="Add new todo...">
    </div>
</div>
