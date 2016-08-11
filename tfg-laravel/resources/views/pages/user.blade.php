
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
                <h2><span style="white-space:nowrap" class="glyphicon glyphicon-user" aria-hidden="true"></span> User Info</h2>
                <table class="table table-striped">
                    <tr><td><b>Name:</b></td><td> {{ $userinfo->name }}</td></tr>
                    <tr><td><b>Company:</b></td><td>  {{ $userinfo->company }}</td></tr>
                    <tr><td><b>Mail:</b></td><td>  {{ $userinfo->email }}</td></tr>
                </table>
                <br>
                <br>
                <br>
                <button type="button">Edit Info</button>
            </div>
        </div>
    </div>
    <br>


    <div style="margin-left:45px;">
        <h2>Boards List </h2><button onclick="window.location.href='report'"><span class="glyphicon glyphicon-plus" aria-hidden="true"><a href='report'></a></span></button><br><br>
        <table class="table table-striped">
                <th>Board</th><th>Status</th><th></th>
            @foreach ($boardinfo as $board)
            <tr>
                <td>{{ $board->name }}</td>
                @if ($board->status === "W")
                    <td><font color="#green">{{ $board->status }}</font></td>
                    <td><button onclick="window.location.href='report'">Monitorize</button></td>
                @else
                    <td><font color="#red">{{ $board->status }}</font></td>
                    <td><button onclick="window.location.href='report'" >Monitorize</button></td>
                @endif
            </tr>
            @endforeach
        </table>
    </div>

@stop