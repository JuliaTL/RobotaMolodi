@extends('app')

@section('title')
    <div><h2>Мої резюме</h2></div>
    <div>
        {!! link_to_route('resume.create', 'Написати резюме') !!}
    </div>
@stop

@section('content')

    @foreach($resumes as $resume)
        <article>
            <h2>{!!$resume->position!!}</h2>
            <p>
                {!!$resume->name_u!!}
            </p>
            <p>
                Промисловість: {!!$resume->industry!!}
            </p>
            <p>
               Зарплата: {!!$resume->salary!!} грн.
            </p>
            <p>
                Опис: {{$resume->description}}
                <hr >
            </p>

        </article>
    @endforeach

@stop
