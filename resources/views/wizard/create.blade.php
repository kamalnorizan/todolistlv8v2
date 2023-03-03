@extends('layouts.app')

@section('head')
    {{-- <link rel="stylesheet" href="{{ asset('colorlib-wizard/css/style.css') }}"> --}}
    <style>
        display-flex,
        .select-icon,
        .select-icon i,
        .steps ul,
        .actions ul li a,
        .form-row,
        .select-list li,
        .form-radio-group {
            display: flex;
            display: -webkit-flex;
        }

        /* @extend list-type-ulli; */
        list-type-ulli,
        .steps ul,
        .actions ul,
        .select-list {
            list-style-type: none;
            margin: 0;
            padding: 0;
        }

        a:focus,
        a:active {
            text-decoration: none;
            outline: none;
            transition: all 300ms ease 0s;
            -moz-transition: all 300ms ease 0s;
            -webkit-transition: all 300ms ease 0s;
            -o-transition: all 300ms ease 0s;
            -ms-transition: all 300ms ease 0s;
        }

        h3 {
            font-size: 12px;
            font-weight: 400;
            color: #999999;
            cursor: pointer;
        }

        fieldset {
            border: none;
            margin: 0px;
            padding: 0px;
        }

        fieldset.current {
            padding-top: 60px;
        }

        .content {
            padding-right: 70px;
            padding-left: 80px;
            /* height: 410px; */
        }

        .content h3 {
            display: none;
        }

        .steps {
            border-bottom: 1px solid #ebebeb;
        }

        .steps ul {
            justify-content: space-between;
            -moz-justify-content: space-between;
            -webkit-justify-content: space-between;
            -o-justify-content: space-between;
            -ms-justify-content: space-between;
        }

        .steps ul li {
            width: 330px;
            margin: 0 75px;
            position: relative;
        }

        .steps ul li:after {
            position: absolute;
            content: '';
            height: 0px;
            width: 100%;
            left: 0;
            bottom: -2px;
            background: #6dbdfe;
        }

        .steps ul li a {
            text-decoration: none;
            display: block;
            background: transparent;
            color: #999999;
            text-align: center;
            padding-bottom: 7px;
            padding-top: 4px;
            font-weight: bold;
        }

        .steps ul li:hover:after {
            height: 3px;
        }

        .steps ul li:hover a h3 {
            color: #6dbdfe;
        }

        .steps ul .current:after {
            height: 3px;
        }

        .steps ul .current a h3 {
            color: #6dbdfe;
        }

        .actions {
            position: auto;
            /* bottom: 31px; */
            right: 0;
            width: 100%;
        }

        .actions ul {
            width: 100%;
            display: inline-block;
        }

        .actions ul .disabled {
            display: none;
        }

        .actions ul li:first-child {
            float: left;
            padding-left: 80px;
        }

        .actions ul li:first-child a {
            background: #ebebeb;
            color: #999999;
        }

        .actions ul li:first-child a:hover {
            background-color: #d2d2d2;
        }

        .actions ul li:nth-child(2),
        .actions ul li:last-child {
            float: right;
            padding-right: 70px;
        }

        .actions ul li a {
            width: 140px;
            height: 50px;
            color: #fff;
            background: #6dbdfe;
            align-items: center;
            -moz-align-items: center;
            -webkit-align-items: center;
            -o-align-items: center;
            -ms-align-items: center;
            justify-content: center;
            -moz-justify-content: center;
            -webkit-justify-content: center;
            -o-justify-content: center;
            -ms-justify-content: center;
            text-decoration: none;
            text-transform: uppercase;
        }

        .actions ul li a:hover {
            background-color: #3aa6fe;
        }
    </style>
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Create Form</div>

                    <div class="card-body">
                        <div id="stepWizard">
                            <h3>Step 1</h3>
                            <fieldset>
                                @include('user._form')
                            </fieldset>
                            <h3>Step 2</h3>
                            <fieldset>
                                @include('todolist._form')
                            </fieldset>
                            <h3>Step 3</h3>
                            <fieldset>
                                <div class="form-group{{ $errors->has('comment') ? ' has-error' : '' }}">
                                    {!! Form::label('comment', 'Comment') !!}
                                    {!! Form::text('comment', null, ['class' => 'form-control', 'required' => 'required']) !!}
                                    <small class="text-danger">{{ $errors->first('comment') }}</small>
                                </div>
                                <div class="form-group{{ $errors->has('imageComment') ? ' has-error' : '' }}">
                                    {!! Form::label('imageComment', 'Image') !!}
                                    {!! Form::file('imageComment') !!}
                                    <small class="text-danger">{{ $errors->first('imageComment') }}</small>
                                </div>
                            </fieldset>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    {{-- <script src="{{ asset('colorlib-wizard/js/main.js') }}"></script> --}}
    <script src="{{ asset('colorlib-wizard/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('colorlib-wizard/vendor/jquery-steps/jquery.steps.js') }}"></script>
    <script>
        var next1 = false;
        $('#stepWizard').steps({
            headerTag: "h3",
            bodyTag: "fieldset",
            transitionEffect: "slideLeft",
            labels: {
                previous: 'Prev',
                next: 'Next',
                finish: 'Finish',
                current: ''
            },
            titleTemplate: '<h3 class="title">#title#</h3>',
            transitionEffect: "slideLeft",
            onStepChanging: function (event, currentIndex, newIndex)
            {
                if (newIndex < currentIndex) {
                    return true;
                }else{
                    var form = new FormData();

                    form.append('_token','{{csrf_token()}}');
                    if(currentIndex==0){
                        form.append('name',$('#name').val());
                        form.append('email',$('#email').val());
                        form.append('password',$('#password').val());
                    }else if(currentIndex==1){
                        form.append('title',$('#title').val());
                        form.append('description',$('#description').val());
                        var fileInput = $('input[name=image]')[0];
                        if (fileInput.files.length > 0) {
                            var file = fileInput.files[0];
                            form.append('image', file);
                        }
                    }
                    form.append('currentIndex',currentIndex);
                    return validation(form);
                }
            },
            onFinishing: function (event, currentIndex, newIndex)
            {
                var form = new FormData();
                form.append('_token','{{csrf_token()}}');
                form.append('name',$('#name').val());
                form.append('email',$('#email').val());
                form.append('password',$('#password').val());
                form.append('title',$('#title').val());
                form.append('description',$('#description').val());
                form.append('comment',$('#comment').val());
                var fileInput = $('#image')[0];
                if (fileInput.files.length > 0) {
                    var file = fileInput.files[0];
                    form.append('image', file);
                }
                var fileInputComment = $('#imageComment')[0];
                if (fileInputComment.files.length > 0) {
                    var fileComment = fileInputComment.files[0];
                    form.append('imageComment', fileComment);
                }
                form.append('currentIndex',currentIndex);
                return validation(form);
            },
            onFinished: function (event, currentIndex) {
                swal("All of the inputs recorded successfully",{
                    icon:'success',
                    buttons: {
                        confirm: {
                            text: "Ok",
                            value: true,
                            visible: true,
                            className: "",
                            closeModal: true
                        }
                    }
                }).then(()=>{
                    window.location = "{{route('todolist.index')}}";
                });
            }
        });

        function clearError() {
            $.each($('.text-danger'), function (indexInArray, valueOfElement) {
                $(valueOfElement).text('');
            });
        }

        function validation(form) {
            clearError();
            var status= false;
            $.ajax({
                type: "POST",
                url: "{{route('wizard.wizardValidate')}}",
                data: form,
                cache:false,
                async: false,
                processData: false,
                contentType: false,
                dataType: "json",
                success: function (response) {
                    if(response.status=='success'){
                        status = true;
                    }else{
                        $.each(response.errors, function (indexInArray, valueOfElement) {
                            $('#'+indexInArray).closest('.form-group').find('.text-danger').text(valueOfElement[0]);
                        });
                        status = false;
                    }
                }
            });
            return status;
        }
    </script>
@endsection
