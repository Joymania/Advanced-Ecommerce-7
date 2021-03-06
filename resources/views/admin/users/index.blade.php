@extends('admin.layout.master')
@section('title', 'Users')
@section('pageTitle') <a href="{{route('users.index')}}">Users</a> @endsection
@section('parentPageTitle','')


@section('content')

<div class="row clearfix">

    <div class="col-lg-12">
        <div class="card">
            <div class="header">
                <h3>Users</h3>
            </div>
            @if(session()->has('success_msg'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{ session()->get('success_msg') }}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <div class="body">
                <div class="table-responsive">
                <table class="table table-bordered table-hover table-striped" cellspacing="0" id="addrowExample">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Gender</th>
                            <th>Status</th>
                            <th>Verified</th>
                            <th>Address</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Gender</th>
                            <th>Status</th>
                            <th>Verified</th>
                            <th>Address</th>
                            <th>Actions</th>
                        </tr>
                    </tfoot>

                    <tbody>
                    @foreach ($users as $user)
                        <tr class="gradeA">
                            <td>{{$user->id}}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->gender}}</td>
                            <td>{{$user->status == '1' ? 'active' :''}}</td>
                            <td>{{ ($user->email_verified_at) ? 'yes' : null }}</td>
                            <td>{{$user->address}}</td>
                            <td class="actions">
                                <a href="{{route('users.edit',$user->id)}}" class="btn btn-sm btn-icon btn-pure btn-default on-default m-r-5 button-edit"
                                data-toggle="tooltip" data-original-title="Edit"><i class="icon-pencil" aria-hidden="true"></i></a>

                                <!-- for deleting user using one form -->
                                <div hidden> {{$route = route('users.delete',$user->id)}}</div>
                                <a href="{{ route('users.delete',$user->id) }}"
                                    onclick="event.preventDefault();
                                    document.getElementById('delete-form').setAttribute('action', '{{$route}}');
                                    confirm('Are you sure to delete?') ? document.getElementById('delete-form').submit() : null;">

                                    <button class="btn btn-sm btn-icon btn-pure btn-default on-default button-remove"
                                    data-toggle="tooltip" data-original-title="Remove"><i class="icon-trash" aria-hidden="true"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    <form id="delete-form" method="POST"  class="d-none">
                            @csrf
                            @method('DELETE')
                    </form>
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
