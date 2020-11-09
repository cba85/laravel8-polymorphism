@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-sm-12 col-md-8 mb-4">

            @if (session('error'))
            <div class="alert alert-danger" role="alert">
                {{ session('error') }}
            </div>
            @endif

            <form action="{{ route('posts.create') }}" method="post">
                @csrf
                <div class="form-group">
                    <textarea class="form-control" name="post" id="post" cols="30" rows="2" required></textarea>
                    <button type="submit" class="btn btn-block btn-primary">Post</button>
                </div>
            </form>

            <div class="card">
                <div class="card-body">
                    @foreach ($posts as $post)
                    <h4>#{{ $post->id }} {{ $post->user->name }}</h4>
                    <p>{{ $post->body }}</p>
                    <div>{{ $post->created_at->diffForHumans() }} &nbsp;
                        <strong>❤️ {{ $post->countLikes() }}</strong> &nbsp;

                        <form method="post" style="display: inline" action="{{ route('posts.like', ['post' => $post->id]) }}">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-outline-primary">@if (!$post->isLiked()) 💗 Like @else 💔 Unlike @endif</button>
                        </form>

                    </div>
                    <hr>
                    @endforeach
                </div>
            </div>

        </div>

        <div class="col-sm-12 col-md-4">

            <div class="card">
                <div class="card-header">Photos</div>
                <div class="card-body">
                    <div class="row">
                        @foreach ($photos as $photo)
                        <div class="col-sm-6 col-md-12 col-lg-6 mt-2">
                            <div class="card">
                                <div class="card-body text-center">
                                    <img src="{{ $photo->url }}" alt="{{ $photo->user->name }}" class="img-fluid">
                                    <div class="mt-2">
                                        <strong>❤️ {{ $photo->countLikes() }}</strong> &nbsp;
                                        <form method="post" style="display: inline" action="{{ route('photos.like', ['photo' => $photo->id]) }}">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-outline-primary">@if (!$photo->isLiked()) 💗 Like @else 💔 Unlike @endif</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>
@endsection
