@extends('admin.layout.master')
@section('title','Add Contact')
@section('pageTitle') <a href="{{route('contact.add')}}">Add Contact</a> @endsection
@section('parentPageTitle')<a href="{{route('contact.view')}}">Contacts</a> @endsection


@section('content')

<div class="card">
    <div class="card-header">
      <h3>
          @if (isset($editdata))
              Edit Contact
              @else
                 Add Contact
          @endif

        <a class=" float-right btn btn-success btn-sm" href="{{ route('contact.view') }}"><i class="fa fa-list"></i> Contact List</a>
      </h3>
    </div>
    <div class="card-body">
      <form method="post" action="{{ (@$editdata)? route('contact.update',$editdata->id): route('contact.store') }}" id="myform" enctype="multipart/form-data">
          @csrf
          <div class="form-row">
            <div class="form-group col-md-4">
                <label for="address">Address</label>
                <input type="text" name="address" class="form-control" id="address" value="{{ @$editdata->address }}">

            </div>
            <div class="form-group col-md-4">
                <label for="mobile_no">Mobile No</label>
                <input type="text" name="mobile_no" class="form-control" id="mobile_no" value="{{ @$editdata->mobile_no }}">

            </div>
            <div class="form-group col-md-4">
                <label for="address">Email</label>
                <input type="email" name="email" class="form-control" id="email" value="{{ @$editdata->email }}">

            </div>
            <div class="form-group col-md-4">
                <label for="facebook">Facebook</label>
                <input type="text" name="facebook" class="form-control" id="facebook" value="{{ @$editdata->facebook }}">

            </div>
            <div class="form-group col-md-4">
                <label for="twitter">Twitter</label>
                <input type="text" name="twitter" class="form-control" id="twitter" value="{{ @$editdata->twitter }}">

            </div>

            <div class="form-group col-md-4">
                <label for="youtube">Youtube</label>
                <input type="text" name="youtube" class="form-control" id="youtube" value="{{ @$editdata->youtube }}">

            </div>

             <div class="form-group col-md-4">
                  <label for="google_plus">Instagram</label>
                  <input type="text" name="instagram" class="form-control" id="instagram" value="{{ @$editdata->instagram }}">

               </div>
               <div class="form-group col-md-4">
                <label for="google_plus">Pioneer</label>
                <input type="text" name="pioneer" class="form-control" id="pioneer" value="{{ @$editdata->pioneer }}">

             </div>

              <div class="form-group col-md-6" style="padding-left: 10px;padding-top:30px">
                  <input type="submit" class="btn btn-primary" value="{{ (@$editdata)? "Update": "Submit" }}">

              </div>

          </form>
      </div>

    </div>

@stop

@section('page-script')

    $(function() {
        // validation needs name of the element
        $('#food').multiselect();

        // initialize after multiselect
        $('#basic-form').parsley();
    });

@stop
