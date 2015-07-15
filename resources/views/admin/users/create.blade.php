@extends('admin.layout')

@section('title', 'Nuovo utente')

@section('main')
    <header class="admin-header">
        <h1>Crea un nuovo utente</h1>
    </header>

    {!! Form::open(['route' => 'admin.users.store', 'class' => 'main']) !!}
            
            @if ($errors->has('name'))
                <div class="error">{{ $errors->first('name') }}</div>
            @endif            
            <label for="name">Nome</label>
            {!! Form::text('name') !!}

            @if ($errors->has('email'))
                <div class="error">{{ $errors->first('email') }}</div>
            @endif            
            <label for="email">Email</label>
            {!! Form::email('email') !!}

            @if ($errors->has('password'))
                <div class="error">{{ $errors->first('password') }}</div>
            @endif            
            <label for="password">Password</label>
            {!! Form::password('password') !!}

            <button type="submit">Salva</button>
    
    {!! Form::close() !!}

@endsection
