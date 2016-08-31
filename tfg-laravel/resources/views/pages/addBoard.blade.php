@extends('layouts.app')
@section('content')

    <style>
        div {
            margin-left:45px;
            margin-right:100px;

        }
        h1 {
            display: inline;
            margin-left:45px;
        }

    </style>
    <h1>Add new Node</h1>

    {!! Form::open(['url' => 'addB']) !!}
    <div class="form-group">
        {!! Form::label('name','Name') !!}
        {!! Form::text('name',null,['class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('brand','Brand') !!}
        {!! Form::text('brand',null,['class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('user_id','User ID: ') !!}
        {!! Form::label(Auth::user()->id,Auth::user()->id) !!}
        {!! Form::hidden('user_id', Auth::user()->id) !!}
        {!! Form::hidden('status', 'Stopped') !!}
    </div>
    <div class="form-group">

        {!! Form::submit('Add New Node',['class' => 'btn btn-primary form-control']) !!}
    </div>
    {!! Form::close() !!}
@stop
