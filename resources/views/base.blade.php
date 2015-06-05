<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Task Organizer-Board</title>
        <link rel="stylesheet" href="/css/normalize.css">
        <link rel="stylesheet" href="/css/font.css">
        <!--link rel="stylesheet" href="/css/semantic.min.css"-->
        <link rel="stylesheet" href="http://semantic-ui.com/dist/semantic.min.css">
        <link rel="stylesheet" href="/css/ionicons.css">
        @yield('css')

        <link rel="icon" href="/img/new_fav.png" type="image/gif">
    </head>
    <body>
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="navbar">
            <div class="my-nav">
                <a href="/">
                    <img src="/img/new-icon.png" style="width:100%; margin-left:15px">
                </a>
                <ul>
                    <li>
                        <a href="#" class="addboard">
                            <i class="ion-ios-plus-empty" id="dayatIcon"></i><br>
                            <label class="label">Add Board<label>
                        </a>
                    </li>
                    
                    <li>
                        <a href="/">
                        <i class="ion-ios-list-outline" id="dayatIcon"></i><br>
                        <label class="label">Board List<label>
                        </a>
                    </li>
                    
                    <li id="user">
                        <a href="#">
                            <i class="ion-ios-person-outline" ></i><br>
                            <label class="label">{{ Auth::user()->name }}</label>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        
        @yield('content')

        <!-- new board modal -->
        <div class="ui basic modal addboard">
            <div class="ui two column centered grid">
                <div class="column">
                    <input name="board_name" id="boardname" type="text" class="validate" placeholder="Enter the board name . . .">
                </div>
            </div>
        </div>

        <!-- edit board modal -->
        <div class="ui small test modal edit transition" style="margin-top: -98px;">
            <div class="ui action input edit-modal">
                <input type="text" placeholder="Edit Name Here...">
                <button class="ui icon button">
                    <i class="ion-checkmark-round"></i>
                </button>
                <button class="ui icon button">
                    <i class="ion-android-close" style="color: red"></i>
                </button>
            </div>
        </div>

        <!-- delete modal -->
        <div class="ui small test modal transition hidden" style="margin-top: -98px;">
            <div class="header">
                Delete Your Board
            </div>
            <div class="addit">
                <div class="content">
                    <p>Are you sure you want to delete your Board?</p>
                </div>
            </div>
            <div class="actions">
                <button class="ui icon button">
                <i class="checkmark icon"></i>
                </button>
                <button class="ui icon button">
                <i class="remove icon"></i>
                </button>
            </div>
        </div>
        <!-- modal -->

        <script src="/js/jquery-2.1.4.min.js"></script>
        <script src="/js/bootstrap.min.js"></script>
        <script src="/js/semantic.min.js"></script>
        <script src="/js/app.js"></script>
        
        <script>
            $(document).on('click', '.addboard', function(){
                $('.basic.modal.addboard').modal('show');
            });

            $(document).on('keypress', '#boardname', function(e){
                if((e.keyCode || e.which) == 13) {
                    addBoard();
                }
            });

            $(document).on('click', '.edit', function(){
                $('.small.modal.edit').modal('show');
            });

            $(document).on('click', '.delete', function(){
                $('.small.modal').modal('show');
            });
        </script>
        @yield('custom_js')
    </body>
</html>
