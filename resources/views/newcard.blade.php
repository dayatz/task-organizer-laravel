<div class="four wide column card-item" id="{{ $card->id }}" style="display:none">
    <div class="card">
        <h4>{{ $card->name }}
            <a href="javascript:;" class="delete-card" id="{{ $card->id }}" onclick="deleteconfirm(this)">
                <i class="remove circle outline icon"></i>
            </a>
        </h4>
        <ul class="todo-container"></ul>
        <input type="text" name="todo_name" class="newtodo" placeholder="Add new todo...">
    </div>
</div>
