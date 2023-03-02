@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create new Todolist</div>

                <div class="card-body">
                    {!! Form::model($todolist, ['route' => ['todolist.update', $todolist->id], 'method' => 'PUT']) !!}


                        @include('todolist._form')

                        <div class="btn-group pull-right">
                            {!! Form::submit("update", ['class' => 'btn btn-success']) !!}
                        </div>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
