@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row justify-content-center">
        @foreach ($todolists as $todolist)
        <div class="col-md-12 mt-3">
            <div class="card">
                <div class="card-header">{{$todolist->title}}</div>

                <div class="card-body">
                    {{$todolist->description}}<br>
                    @foreach ($todolist->images as $image)

                            <img width="50%" src="data:image/png;base64,{{$image->image_path}}" alt="Image">

                        @endforeach
                    <hr>
                    <strong>Comments ({{$todolist->comments->count()}})</strong>
                    <br>
                    @foreach ($todolist->comments as $comment)
                        <strong>{{$comment->user->name}}</strong> <br>
                        {{$comment->comment}}<br>
                        @foreach ($comment->images as $image)

                            <img  width="50%" src="data:image/png;base64,{{$image->image_path}}" class="img-responsive" alt="Image">

                        @endforeach<br><br>
                    @endforeach
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
