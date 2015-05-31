var ajaxPost = function(url, data, successEvent) {
    var token = $('input[name=_token]').val();
    $.ajax({
        url: url,
        type: 'POST',
        headers: {'X-CSRF-Token': token},
        data: data,
        success: successEvent,
        error: function(r) {
            console.log(r);
        }
    });
}

// ================================== BOARD ====================================
addBoard = function() {
    var data = { 'board_name': $('input[name=board_name]').val() };
    ajaxPost('/', data, function(r){
        if (r != 'error') {
            $('.modal').modal('hide');
            var new_board = '<p style="display:none"><a href="/board/'+ r.id +'">'+ r.name +'</a></p>'
            $(new_board).appendTo('.board-container').slideDown();
        }
    });
};


deleteBoard = function(id) {
    var d = confirm('Delete this board ?');
    if (d) {
        ajaxPost('/board/'+id+'/delete', {}, function(r){
            if (r == 'success') {
                window.location.replace('/');
            } else {
                console.log(r);
            }
        });
    }
}


editBoard = function(id) {
    var data = {};
    ajaxPost('/board/'+id+'/update', data, function(r) {
        if (r == 'success') {

        } else {
            console.log('error');
        }
    });
}

// =============================================================================



// ================================ Card =======================================
addCard = function() {
    var data = {
        'card_name': $('input[name=card_name]').val(),
        'board_id' : $('input[name=board_id]').val()
    };
    console.log(data);
    ajaxPost('/card', data, function(r){
        if (r != 'success') {
            $('.modal').modal('hide');

            var new_card = '<div style="display:none" class="col-md-4 card-container" card-id="'+ r.id +'">'+
                '<div class="panel panel-default">'+
                    '<div class="panel-heading">' + r.name+
                        '<button class="btn btn-danger btn-xs pull-right" onclick="deleteCard('+ r.id +')">x</button>'+
                    '</div>'+
                    '<div class="panel-body card-list">'+
                        '<input class="form-control" type="text" name="todo_name" placeholder="Enter new task..." card-id="' + r.id + '">'+
                    '</div>'+
                '</div>'+
            '</div>';

            $(new_card).appendTo('.board-container').fadeIn();
        }
    });
}


deleteCard = function(id) {
    var del = confirm('Delete this card ?');
    if (del) {
        ajaxPost('/card/'+id+'/delete', {}, function(r){
            if (r == 'success') {
                $('.card-container[card-id='+id+']').fadeOut(function(){
                    $(this).remove();
                });
            } else {
                console.log(r);
            }
        });
    }
}


editCard = function(id) {
    var data = {};
    ajaxPost('/card/'+id+'/update', data, function(r) {
        if (r == 'success') {

        } else {
            console.log('error');
        }
    });
}
// =============================================================================



// ================================= TODO ======================================
// add new todo to card
$(document).on('keypress', 'input[name=todo_name]', function(e) {
    var t = $(this);
    if((e.keyCode || e.which) == 13) {
        var todo = t.val();
        var card_id = t.parents('.card-container').attr('card-id');
        var data = {'todo': todo, 'card_id': card_id};
        ajaxPost('/todo', data, function(r){
            t.val('');

            var added_todo = '<li style="list-style-type:none; display:none" todo-id="'+r.id+'">'+
                '<input type="checkbox" name="check_todo" class="selection_checkbox" value="'+ r.id +'"> ' +
                '<label class="selection_label"> ' + todo + '</label>' +
                '<button class="btn btn-danger btn-xs pull-right" onclick="deleteTodo('+r.id+')">' +
                    '<span class="i glyphicon glyphicon-trash"></span>' +
                '</button>' +
            '</li>';

            $(added_todo).insertBefore('input[type=text][card-id='+ card_id +']').slideDown();
        });
    }
});


// todo check event
$(document).on('change', 'input[name=check_todo]', function(){
    var e = $(this);
    var done = (e.is(':checked') ? 1 : 0);
    var data = {'done': done };

    ajaxPost('/todo/' + e.val(), data, function(r){
        console.log(r);
    });
});


deleteTodo = function(id) {
    var c = confirm('Delete this task ?');
    if (c) {
        ajaxPost('/todo/'+id+'/delete', {'board_id': $('input[name=board_id]').val()}, function(r){
            if (r == 'success') {
                $('li[todo-id='+id+']').slideUp(function(){ $(this).remove });
            } else {
                console.log(r);
            }
        });
    }
}


editTodo = function(id) {
    var data = {};
    ajaxPost('/todo/'+id+'/update', data, function(r) {
        if (r == 'success') {

        } else {
            console.log('error');
        }
    });
}


// add collaborator to board
addCollaborator = function() {
    var data = {
        'board_id' : $('input[name=board_id]').val(),
        'user_email': $('input[name=user_email]').val()
    };
    ajaxPost('/collaborator', data, function(r){
        if (r == 'success') {
            alert('ye');
        } else if (r == 'not_found') {
            alert('not');
        } else {
            console.log(r);
        }
    });
}
// =============================================================================



// ============================ OTHERS =========================================
$('.modal').on('hidden.bs.modal', function(e) {
    $(this).find('input').val('');
})
.on('shown.bs.modal', function(e) {
    $(this).find('input:first').focus();
});
$("[rel='tooltip']").tooltip();
