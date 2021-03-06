@extends('admin.layout.master')
@section('title', 'Tags')
@section('pageTitle') <a href="{{route('tags.list')}}">Tags</a> @endsection
@section('parentPageTitle', '')


@section('content')

    <div class="row clearfix">

        <div class="col-lg-12 col-md-12">
            <div class="card planned_task">
                <div class="body">
                    <div class="row">
                        <div class="col-md-12">
                            @if(session()->has('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <strong>{{ session()->get('success') }}</strong>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                            @if(session()->has('delete'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <strong>{{ session()->get('delete') }}</strong>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="row clearfix">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="header">
                                    <a class=" btn btn-primary m-b-15" href="{{route('tags.create')}}"><i class="fa fa-plus-circle"></i> Add New Tag</a>
                                </div>
                                <div class="body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-hover js-basic-example dataTable table-custom">
                                            <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Actions</th>
                                            </tr>
                                            </thead>
                                            <tfoot>
                                            <tr>
                                                <th>Name</th>
                                                <th>Actions</th>
                                            </tr>
                                            </tfoot>
                                            <tbody>
                                            @foreach($tags as $row)
                                                <tr>
                                                    <td>{{$row->name}}</td>
                                                    <td>
                                                        <div class="btn-group" role="group">
                                                        <a href="{{route('tags.edit',['tag'=>$row->id])}}" class="editLink" data-toggle="tooltip" title="Edit Tag!">
                                                            <button  class="btn btn-sm btn-icon btn-pure btn-default on-default m-r-5 button-edit">
                                                                <i class="icon-pencil" aria-hidden="true"></i></button>
                                                        </a>
                                                        <form action="{{route('tags.delete',['tag'=>$row->id])}}" class="deleteForm"
                                                              onsubmit="return confirm('Are you sure want to delete this item?')" method="post">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-icon btn-pure btn-default on-default button-remove"
                                                                    data-toggle="tooltip" data-original-title="Remove"><i class="icon-trash" aria-hidden="true"></i></button></a>
                                                        </form>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

@stop
