@extends('layout')

@section('content')
    <article>
         {{ $post->title }}

        <div>
             {!! $post->body !!}
        </div>
    </article>

    <a href="/">Go back</a>
@endsection