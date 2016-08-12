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
    <h1>Add a new Board</h1>

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
        {!! Form::label($userinfo->id,'1') !!}
        {!! Form::hidden('user_id', '1') !!}
        {!! Form::hidden('status', 'Stopped') !!}
    </div>
    <div class="form-group">

        {!! Form::submit('Add New Board',['class' => 'btn btn-primary form-control']) !!}
    </div>
    {!! Form::close() !!}
@stop
