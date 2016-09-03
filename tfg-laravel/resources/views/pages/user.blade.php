
@extends('layouts.app')

@section('content')

    <style>
        div {
            margin-left:45px;
        }
        h2 {display: inline;}

    </style>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-4"><img src="http://nineplanets.org/images/themoon.jpg" width="275" height="275" border="1"/></div>
            <div class="col-sm-6">
                <h2><span style="white-space:nowrap" class="glyphicon glyphicon-user" aria-hidden="true"></span> Información de Usuario</h2>
                <table class="table table-striped">
                    <tr><td><b>Name:</b></td><td> {{ $userinfo->name }}</td></tr>
                    <tr><td><b>Company:</b></td><td>  {{ $userinfo->company }}</td></tr>
                    <tr><td><b>Mail:</b></td><td>  {{ $userinfo->email }}</td></tr>
                </table>
                <br>
                <br>
                <br>
                <button onclick="window.location.href='user/editinfo'">Editar Usuario </button>
            </div>
        </div>
    </div>
    <br>


    <div style="margin-left:45px;">
        <h2>Lista de Nodos </h2><br>
        <a href='user/addboard'><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Nuevo Nodo</a><br><br>
        <table class="table table-striped">
            <th>ID</th><th>Nodo</th><th>Estado</th><th></th>
            @foreach ($boardinfo as $board)
            <tr>
                <td>{{ $board->id }}</td>
                <td>{{ $board->name }}</td>
                @if ($board->status === "W")
                    <td><font color="#green">{{ $board->status }}</font></td>
                    <td><button name="on" onclick="window.location.href='report?id={{ $board->id }}'">Seguimiento</button></td>
                @else
                    <td><font color="#red">{{ $board->status }}</font></td>
                    <td><button name="off" onclick="window.location.href='report?id={{ $board->id }}'">Seguimiento</button></td>
                @endif
            </tr>
            @endforeach
        </table>
    </div>

@stop