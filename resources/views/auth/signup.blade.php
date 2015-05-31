@extends('auth/auth')

@section('content')
<div class="centered animated fadeIn">
    <div class="ui three column centered grid">
        <div class="column">
            <h1>Signup Here </h1>
            <div class="form">
                <form method="POST" action="{{ url('signup') }}">
                    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">

                    <input type="text" placeholder="Your name" name="name" autocomplete="off" value="{{ old('name') }}"/>
                    <input type="email" placeholder="Your email address" name="email"  autocomplete="off" value="{{ old('email') }}"/>
                    <input type="password" placeholder="Your password" name="password"  autocomplete="off"/>
                    <input type="password" placeholder="Re-enter your password" name="password_confirmation"  autocomplete="off"/>

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
                            Or <a href="{{ url('login') }}" style="color: #bbb">Login here!</a>
                        </span>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
