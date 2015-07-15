@extends('admin.layout')

@section('title', 'Modifica risorsa')

@section('main')

    <header class="admin-header">
        <h1>Modifica <em>{{ $resource->name }}</em></h1>

        {!! Form::open(['route' => ['admin.resources.destroy', $resource], 'method' => 'delete', 'class' => 'delete']) !!}
            <button type="submit">Elimina</button>
        {!! Form::close() !!}
    </header>

    {!! Form::model($resource, ['route' => ['admin.resources.update', $resource], 'method' => 'put', 'class' => 'main']) !!}

        @if ($errors->has('name'))
            <div class="error">{{ $errors->first('name') }}</div>
        @endif
        <label for="name">Nome</label>
        {!! Form::text('name') !!}

        <button type="submit">Salva</button>

    {!! Form::close() !!}

@endsection
