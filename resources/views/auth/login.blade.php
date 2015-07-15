@extends('layout')

@section('class', 'login')

@section('main')
       
       <div class="panel">
           <h1>Login</h1>

            <form method="POST" action="/login" id="login">
                {!! csrf_field() !!}

                    <label for="email">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}">

                    <label for="password">Password</label>
                    <input type="password" name="password" id="password">

                    <label>
                        <input type="checkbox" name="remember" id="remember">
                        Remember Me
                    </label>

                    <button type="submit" class="login-btn">Login</button>
            </form>

        </div>



@endsection