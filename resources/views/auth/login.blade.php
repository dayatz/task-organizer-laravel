@extends('auth/auth')

@section('content')
<div class="centered animated fadeInDown">
    <div class="ui three column centered grid">
        <div class="column">
            <h1>Organize Your Life </h1>
            <span class="landing">Everything start here</span>
            <form method="POST" action="{{ url('login') }}">
                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                <div class="form">
                    <input name="email" id="username" type="text" class="validate" placeholder="Your email address" autocomplete="off">
                    <input name="password" id="password" type="password" class="validate" placeholder="Your password" autocomplete="off">
                    @if (count($errors) > 0)
                    <div class="error">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li style="list-style:none"><i class="ion-close-circled"> {{ $error }}</i></li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <div class="my-btn">
                        <button type="submit" class="ui button">Sign in</button>
                        <span style="color: #ddd; float: right; margin-right: 30px">
                            Don't have an account? <a href="{{ url('signup') }}" style="color: #bbb">Sign up now!</a>
                        </span>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
