@extends('adminlte::page')
@section('content')
@if(session()->has('success'))
<div class="alert {{session('alert') ?? 'alert-info'}}">
    {{ session('success') }}
</div>
@endif
{!! Form::open(['action' =>['ContactController@update', $contact->id], 'method' => 'PUT','files'=>true])!!}

<div class="col-md-6">


        <div class="form-group required">
           {!! Form::label("NAME")!!}
           {!! Form::text("name", "$contact->name" ,["class"=>"form-control","required"=>"required"]) !!}
       </div>

        <div class="form-group required">
           {!! Form::label("EMAIL") !!}
           {!! Form::text("email", $contact->email ,["class"=>"form-control","required"=>"required"]) !!}
       </div>

        <div class="form-group required">
           {!! Form::label("TOTAL SCORE") !!}
           {!! Form::text("total_score", $contact->total_score ,["class"=>"form-control","required"=>"required"]) !!}
       </div>



   <div class="well well-sm clearfix">
       <button class="btn btn-success pull-right" title="Save" type="submit">Update</button>
   </div>
</div>

{!! Form::close() !!}
@endsection
