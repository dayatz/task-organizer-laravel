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
            window.location.replace('/board/'+r.id);
        }
    });
};


deleteBoard = function(e) {
    var e = $(e);
    var id = e.attr('id');
    ajaxPost('/board/'+id+'/delete', {}, function(r){
        if (r == 'success') {
            $('.modal.deletemodal').modal('hide');
            $('.board-item[id='+id+']').fadeOut(function(){ $(this).remove() });
        } else {
            console.log(r);
        }
    });
}


editBoard = function(e) {
    var id = $(e).attr('id');
    var new_name = $(e).parent().find('input[name=edit_board]').val();
    if (new_name) {
        var data = {'board_name': new_name};
        ajaxPost('/board/'+id+'/update', data, function(r) {
            if (r) {
                $('.board-item[id='+id+']').find('h3').text(r);
                $('.modal.edit').modal('hide');
            } else {
                console.log('error');
            }
        });
    }
}

// =============================================================================



// ================================ Card =======================================
addCard = function() {
    var data = {
        'card_name': $('input[name=card_name]').val(),
        'board_id' : $('input[name=board_id]').val()
    };
    
    ajaxPost('/card', data, function(r){
        $('.modal').modal('hide');
        $(r).appendTo('.card-container').fadeIn();

        $('input[name=card_name]').val('');
    });
}



deleteconfirm = function(e) {
    var e = $(e);
    console.log(e.parent().text());
    var target = $('.modal.deletemodal');
    target.find('.card-name').text(e.parent().text());
    target.find('.okdelete').attr('id', e.attr('id'));
    target.modal('show');
}

deleteCard = function(e) {
    var id = $(e).attr('id');
    ajaxPost('/card/'+id+'/delete', {}, function(r){
        if (r == 'success') {
            $('.modal.deletemodal').modal('hide');
            $('.card-item[id='+id+']').fadeOut(function(){
                $(this).remove();
            });
        } else {
            console.log(r);
        }
    });
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
        var card = t.parents('.card-item');
        var card_id = card.attr('id');

        var data = {'todo': todo, 'card_id': card_id};
        ajaxPost('/todo', data, function(r){
            t.val('');

            var todo_container = card.find('ul');
            $(r).appendTo(todo_container).slideDown();

            apply_icheck();
        });
    }
});


// todo check event
$(document).on('click', 'li.todo-item', function(){
    var e = $(this);
    var c = e.find('.icheckbox_square-grey');
    var i = e.find('input[type=checkbox]');

    if (c.hasClass('checked')) {
        e.removeClass('done');
        c.removeClass('checked');
        i.prop('checked', true);
        var done = 0;
    } else {
        e.addClass('done');
        c.addClass('checked');
        i.removeAttr('checked');
        var done = 1;
    }

    var data = {'done': done };
    ajaxPost('/todo/' + i.attr('id'), data, function(r){
        console.log(r);
    });
});


deleteTodo = function(event, id) {
    ajaxPost('/todo/'+id+'/delete', {'board_id': $('input[name=board_id]').val()}, function(r){
        if (r == 'success') {
            $('li.todo-item[id='+id+']').slideUp(function(){ $(this).remove });
        } else {
            console.log(r);
        }
    });
    event.stopPropagation();
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
$(document).on('keypress', 'input[name=user_email]', function(e){
    if((e.keyCode || e.which) == 13) {
        var t = $(this);
        var user = t.val();
        var board_id = $('input[name=board_id]').val();
        if (user) {
            var data = {
                'user_email': user,
                'board_id' : board_id
            };
            ajaxPost('/collaborator', data, function(r){
                if (r == 'not_found') {
                    alert('user not found');
                } else {
                    $('.menu.collaborators').append('<p class="item">'+r.name+' ('+r.email+')</p>');
                    $('.modal.addcollaborator').modal('hide');
                }
            });
        }
    }
});

leaveBoard = function(board_id) {
    var data = {
        'board_id': $('input[name=board_id]').val()
    }
    ajaxPost('/collaborator/leave', data, function(r) {
        if (r == 'success') {
            window.location.replace('/');
        } else {
            console.log(r);
        }
    })
}
// =============================================================================

viewHistory = function() {
    $('.sidebar.histories').sidebar('toggle');
};
collaboratorSidebar = function() {
    $('.sidebar.collaborators').sidebar('toggle');
}


// ============================ OTHERS =========================================

function apply_icheck() {
    $('input[name=check_todo]').iCheck({
        checkboxClass: 'icheckbox_square-grey'
    });
}
