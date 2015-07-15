@extends('admin.layout')

@section('title', 'Modifica prenotazione')

@section('main')

    <header class="admin-header">
        <h1>Modifica prenotazione</h1>

        {!! Form::open(['route' => ['admin.reservations.destroy', $reservation], 'method' => 'delete', 'class' => 'delete']) !!}
            <button type="submit">Elimina</button>
        {!! Form::close() !!}
    </header>

    {!! Form::model($reservation, ['route' => ['admin.reservations.update', $reservation], 'method' => 'put', 'class' => 'main']) !!}
            
            @if ($errors->has('user'))
                <div class="error">{{ $errors->first('user') }}</div>
            @endif
            <label for="name">Utente</label>
            {!! Form::select('user_id', $users) !!}

            @if ($errors->has('resource'))
                <div class="error">{{ $errors->first('resource') }}</div>
            @endif
            <label for="name">Risorsa</label>
            {!! Form::select('resource_id', $resources) !!}

            @if ($errors->has('start_date'))
                <div class="error">{{ $errors->first('start_date') }}</div>
            @endif
            @if ($errors->has('start_time'))
                <div class="error">{{ $errors->first('start_time') }}</div>
            @endif
            <label for="name">Inizio prenotazione</label>
            {!! Form::date('start_date', null, ['class' => 'datepicker']) !!}
            {!! Form::input('time', 'start_time', null, ['step' => '1800']) !!}

            @if ($errors->has('end_date'))
                <div class="error">{{ $errors->first('end_date') }}</div>
            @endif
            @if ($errors->has('end_time'))
                <div class="error">{{ $errors->first('end_time') }}</div>
            @endif
            <label for="name">Fine prenotazione</label>
            {!! Form::date('end_date', null, ['class' => 'datepicker']) !!}
            {!! Form::input('time', 'end_time', null, ['step' => '1800']) !!}

            <button type="submit">Salva</button>
    
    {!! Form::close() !!}

@endsection

@section('javascripts')
    @parent

    <script>
        // require(['jquery', 'datepicker', 'timepicker', 'picker_it'], function($) {
        //     $('input[name="from_date"]').pickadate({
        //         // min: new Date(),
        //         formatSubmit: 'yyyy-mm-dd',
        //         hiddenName: true
        //     });

        //     $('input[name="to_date"]').pickadate({
        //         min: new Date(),
        //         formatSubmit: 'yyyy-mm-dd',
        //         hiddenName: true
        //     });

        //     $('input[name="from_time"]').pickatime({
        //         min: [8, 00],
        //         max: [22, 00]
        //     });
            
        //     $('input[name="to_time"]').pickatime({
        //         min: [8, 00],
        //         max: [22, 00]
        //     });
        // });
    </script>

@endsection


@section('stylesheets')
    @parent

    <link rel="stylesheet" href="{{ asset('assets/lib/css/pickadate.css') }}">
@endsection