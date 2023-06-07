@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="pull-right">
                    <a class="btn btn-primary" href="{{ route('home') }}">Back</a>
                </div>
                <h2>{{ $post->title }}</h2>
                <p>{{ $post->content }}</p>
            </div>
        </div>
    </div>
@endsection
