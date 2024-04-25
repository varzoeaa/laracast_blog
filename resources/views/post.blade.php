@extends('layout')

@section('content')
    <article>
         {{ $post->title }}

         <p> 
            <a href="/categories/{{ $post->category->slug}}">{{ $post->category->name }}</a>
        </p>

        <div>
             {!! $post->body !!}
        </div>
    </article>

    <a href="/">Go back</a>
@endsection