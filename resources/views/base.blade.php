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
                        <a href="#" class="ui bottom left pointing dropdown" style="text-align:center">
                            <i class="ion-ios-person-outline" ></i><br>
                            <label class="label">{{ Auth::user()->name }}</label>
                            <div class="menu">
                                <div class="item">
                                    <i class="edit icon"></i>
                                    Preferences
                                </div>
                                <div class="divider"></div>
                                <div class="item" onclick="location.href='/logout/'">
                                    <i class="sign out icon"></i>
                                    Logout
                                </div>
                            </div>
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

            $('.dropdown').dropdown();
        </script>
        @yield('custom_js')
    </body>
</html>
