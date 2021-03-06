@extends('adminlte::page')

@section('content')
@if(session()->has('success'))
<div class="alert {{session('alert') ?? 'alert-info'}}">
    {{ session('success') }}
</div>
@endif
{!! Form::open(['action' =>'ContactController@store', 'method' => 'POST','files'=>true])!!}

    <div class="col-md-6">


			 <div class="form-group required">
				{!! Form::label("NAME") !!}
				{!! Form::text("name", null ,["class"=>"form-control","required"=>"required"]) !!}
			</div>

			 <div class="form-group required">
				{!! Form::label("EMAIL") !!}
				{!! Form::text("email", null ,["class"=>"form-control","required"=>"required"]) !!}
			</div>

			 <div class="form-group required">
				{!! Form::label("TOTAL SCORE") !!}
				{!! Form::text("total_score", null ,["class"=>"form-control","required"=>"required"]) !!}
			</div>



        <div class="well well-sm clearfix">
            <button class="btn btn-success pull-right" title="Save" type="submit">Create</button>
        </div>
    </div>

{!! Form::close() !!}
@endsection
