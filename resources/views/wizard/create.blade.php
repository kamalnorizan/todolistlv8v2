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
            height: 410px;
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
            position: absolute;
            bottom: 31px;
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
                                Section 2
                            </fieldset>
                            <h3>Step 3</h3>
                            <fieldset>
                                Section 3
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
        $('#stepWizard').steps({
            headerTag: "h3",
            bodyTag: "fieldset",
            transitionEffect: "fade",
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

                var form = new FormData();
                form.append('_token','{{csrf_token()}}');
                if(currentIndex==0){
                    var name = $('#name').val();
                    var email = $('#email').val();
                    var password = $('#password').val();
                    form.append('currentIndex',currentIndex);
                    form.append('name',name);
                    form.append('email',email);
                    form.append('password',password);
                }

                var next = false;
                $.ajax({
                    type: "POST",
                    url: "{{route('wizard.wizardValidate')}}",
                    data: form,
                    cache:false,
                    processData: false,
                    contentType: false,
                    dataType: "json",
                    success: function (response) {
                        next = true;
                    },
                    error: function(e) {
                        $.each($('.text-danger'), function (indexInArray, valueOfElement) {
                            $(valueOfElement).text('');
                        });

                        $.each(e.responseJSON.errors, function (index, msg) {
                            $('#'+index).closest('.form-group').find('.text-danger').text(msg[0]);
                        });

                        return false;
                    }
                }).then(()=>{

                        return true;

                });

            }
        });
    </script>
@endsection
