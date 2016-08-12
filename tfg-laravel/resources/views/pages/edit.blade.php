@extends('layouts.app')
@section('content')

    <style>
        div {
            margin-left:45px;
            margin-right:100px;

        }
        h1 {display: inline;}

    </style>
    <h1>Edit user info</h1>

    {!! Form::open(['url' => 'save']) !!}
        <div class="form-group">
        {!! Form::label('name','Name') !!}
        {!! Form::text('name',$userinfo->name,['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
        {!! Form::label('email','Email') !!}
        {!! Form::text('email',$userinfo->email,['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
        {!! Form::label('company','Company') !!}
        {!! Form::text('company',$userinfo->company,['class' => 'form-control']) !!}
        </div>

        <div class="form-group">

        {!! Form::submit('Save',['class' => 'btn btn-primary form-control']) !!}
        </div>
    {!! Form::close() !!}
@stop
