@extends('admin.layout')

@section('title', 'Nuova tessera')

@section('main')
    <header class="admin-header">
        <h1>Aggiungi una nuova tessera</h1>
    </header>

    <form action="{{ route('admin.cards.store') }}" method="post" class="main">
            {!! csrf_field() !!}
            
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
    </form>
@endsection
