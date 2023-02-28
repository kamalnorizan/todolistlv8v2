@extends('layouts.app')

@section('head')

@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-default">
                <div class="card-header">title</div>
                <div class="card-body">
                    <form action="{{route('user.update', ['user'=>$user->id])}}" method="post">
                        @method('put')
                        @include('user._form')
                        <button type="submit" class="btn btn-primary float-right">Kemaskini</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')

@endsection
