@extends('layouts.app')

@section('head')

@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">

            <div class="card card-default">
                <div class="card-header">Create User</div>
                <div class="card-body">
                    <form action="{{route('user.store')}}" method="post">
                        @include('user._form')
                        <button class="btn btn-success" type="submit">Create</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')

@endsection
