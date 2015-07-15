@extends('admin.layout')

@section('title', 'Modifica utente')

@section('main')
    <header class="admin-header">
        <h1>Modifica <em>{{ $user->name }}</em></h1>

        {!! Form::open(['route' => ['admin.users.destroy', $user], 'method' => 'delete', 'class' => 'delete']) !!}
            <button type="submit">Elimina</button>
        {!! Form::close() !!}
    </header>

    {!! Form::model($user, ['route' => ['admin.users.update', $user], 'method' => 'put', 'class' => 'main']) !!}
            
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
            {!! Form::password('password', ['placeholder' => 'Lascia vuota per se non vuoi cambiarla']) !!}

            <button type="submit">Salva</button>
    
    {!! Form::close() !!}

@endsection
