@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create new Todolist</div>

                <div class="card-body">
                    {!! Form::open(['method' => 'POST', 'route' => 'todolist.store','files'=>true]) !!}

                        @include('todolist._form')

                        <div class="btn-group pull-right">
                            {!! Form::reset("Reset", ['class' => 'btn btn-warning']) !!}
                            {!! Form::submit("Add", ['class' => 'btn btn-success']) !!}
                        </div>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
