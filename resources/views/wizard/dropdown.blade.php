@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Title</div>

                    <div class="card-body">
                        {!! Form::open(['method' => 'POST', 'route' => 'dropdown.dropdownStore']) !!}

                        <div class="form-group{{ $errors->has('user') ? ' has-error' : '' }}">
                            {!! Form::label('user', 'User') !!}
                            {!! Form::select('user', $users, null, ['id' => 'user', 'class' => 'form-control', 'required' => 'required']) !!}
                            <small class="text-danger">{{ $errors->first('user') }}</small>
                        </div>

                        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                            {!! Form::label('title', 'Post Title') !!}
                            {!! Form::select('title', [], null, ['id' => 'title', 'class' => 'form-control', 'required' => 'required']) !!}
                            <small class="text-danger">{{ $errors->first('title') }}</small>
                        </div>

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            {!! Form::label('name', 'Name') !!}
                            {!! Form::text('name', null, ['class' => 'form-control']) !!}
                            <small class="text-danger">{{ $errors->first('name') }}</small>
                        </div>

                        <div class="btn-group pull-right">
                            {!! Form::submit('Add', ['class' => 'btn btn-success']) !!}
                        </div>

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            @if ($errors->any())
                loadTitle("{{ old('user') }}");
            @endif

            $('#user').change(function(e) {
                loadTitle($(this).val());
            });

            function loadTitle(userId) {
                $.ajax({
                    type: "post",
                    url: "{{ route('dropdown.ajaxLoadTitle') }}",
                    data: {
                        _token: '{{ csrf_token() }}',
                        user_id: userId
                    },
                    dataType: "json",
                    success: function(response) {
                        $('#title').empty();
                        var options = '';
                        $.each(response, function(indexInArray, valueOfElement) {
                            options = options + '<option value="' + indexInArray + '">' +
                                valueOfElement + '</option>'
                        });
                        $('#title').append(options);
                        @if ($errors->any())
                        $('#title').val("{{ old('title') }}");
                        @endif
                    }
                });
            }
        });
    </script>
@endsection
