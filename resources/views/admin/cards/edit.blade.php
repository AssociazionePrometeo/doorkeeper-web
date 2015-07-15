@extends('admin.layout')

@section('title', 'Modifica tessera')

@section('main')
    <header class="admin-header">
        <h1>Modifica tessera</h1>
    </header>

    {!! Form::model($card, ['route' => ['admin.cards.update', $card], 'method' => 'put', 'class' => 'main']) !!}
            
            @if ($errors->has('id'))
                <div class="error">{{ $errors->first('id') }}</div>
            @endif
            <label for="id">Identificativo</label>
            {!! Form::text('id') !!}
            
            @if ($errors->has('user_id'))
                <div class="error">{{ $errors->first('user_id') }}</div>
            @endif
            <label for="user_id">Utente</label>
            {!! Form::select('user_id', $users) !!}
            

            <button type="submit">Salva</button>
    {!! Form::close() !!}
@endsection
