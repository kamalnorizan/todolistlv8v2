@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row justify-content-center">
        @foreach ($todolists as $todolist)
        <div class="col-md-6 mt-3">
            <div class="card">
                <div class="card-header">{{$todolist->title}}</div>

                <div class="card-body">
                    {{$todolist->description}}
                    <hr>
                    <strong>Comments ({{$todolist->comments->count()}})</strong>
                    <br>
                    @foreach ($todolist->comments as $comment)
                        <strong>{{$comment->user->name}}</strong> <br>
                        {{$comment->comment}} <br><br><br>
                    @endforeach
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
