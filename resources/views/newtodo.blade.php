<li class="todo-item" id="{{ $todo->id }}" style="display:none">
    <div class="todo">
        <input type="checkbox" name="check_todo" class="check-todo" id="{{ $todo->id }}">
        <label>{{ $todo->name }}</label>

        <a href="javascript:;" class="delete-todo" id="{{ $todo->id }}" onclick="deleteTodo(event, {{ $todo->id }})">
            <i class="trash outline icon"></i>
        </a>
    </div>
</li>
