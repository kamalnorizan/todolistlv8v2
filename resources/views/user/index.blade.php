@extends('layouts.app')

@section('head')

@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Senarai User
                    <a href="{{route('user.create')}}" class="btn btn-primary float-right">Create User Page</a>
                </div>

                <div class="card-body">
                    <table class="table" width="100%">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Registered At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>
                                        {{ $user->name }}
                                    </td>
                                    <td>
                                        {{ $user->email }}
                                    </td>
                                    <td>
                                        {{ $user->created_at }}
                                    </td>
                                    <td>
                                        <i class="fa fa-battery-full fa-5x sweet" aria-hidden="true"></i>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="4" align="center">
                                    {!! $users->links() !!}
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    $('.sweet').click(function (e) {
        e.preventDefault();
        swal("You are not allowed to remove the this layer",{
            dangerMode: true,
            icon:'error',
            buttons: {
                cancel: {
                    text: "OK",
                    value: null,
                    visible: true,
                    className: "",
                    closeModal: true,
                },
                confirm: {
                    text: "Ok",
                    value: true,
                    visible: false,
                    className: "",
                    closeModal: true
                }
            }
        });
    });
</script>
@endsection
