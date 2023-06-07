@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <a href="{{ route('posts.create') }}">Create</a>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>Title</th>
                            <th>Content</th>
                            <th width="300px;">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(!empty($posts) && $posts->count())
                            @foreach($posts as $post)
                                <tr>
                                    <td>{{ $post->title }}</td>
                                    <td>{{ $post->content }}</td>
                                    <td>
                                        <form action="{{ route('posts.destroy', $post->id) }}" method="POST">
                                            <a href="{{ route('posts.show', $post->id) }}">Show</a>
                                            @csrf
                                            @method('DELETE')

                                            @if ($userId === $post->user_id)
                                                <a href="{{ route('posts.edit', $post->id) }}">Edit</a>
                                                <button class="btn btn-danger">Delete</button>
                                            @endif
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="10">There are no data.</td>
                            </tr>
                        @endif
                        </tbody>
                    </table>

                    {!! $posts->links() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
