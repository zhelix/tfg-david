
@extends('layouts.app')

@section('content')

    <style>
        div {
            margin-left:45px;
        }

    </style>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-4"><img src="http://nineplanets.org/images/themoon.jpg" width="275" height="275" border="1"/></div>
            <div class="col-sm-6">
                <h2>User Info</h2>
                <table class="table table-striped">
                    <tr><td><b>Name:</b></td><td> {{ $username }}</td></tr>
                    <tr><td><b>Company:</b></td><td>  {{ $usercompany }}</td></tr>
                    <tr><td><b>Mail:</b></td><td>  {{ $usermail }}</td></tr>
                </table>
                <br>
                <br>
                <br>
                <button type="button">Edit Info</button>
            </div>
        </div>
    </div>
    <div style="margin-left:45px;">
        <h2>Boards List</h2>
        <table class="table table-striped">
                <th>Board</th><th>Status</th><th></th>
            <tr>
                <td>Arduino1</td>
                <td><font color="#32cd32">Working</font></td>
                <td><button onclick="window.location.href='report'">Monitorize</button></td>
            </tr>
            <tr>
                <td>Arduino2</td>
                <td><font color="red">Stopped</font></td>
                <td><button onclick="window.location.href='monitorize'">Monitorize</button></td>
            </tr>
            <tr>
                <td>Arduino3</td>
                <td><font color="red">Stopped</font></td>
                <td><button onclick="window.location.href='monitorize'">Monitorize</button></td>
            </tr>
            <tr>
                <td>Arduino4</td>
                <td><font color="red">Stopped</font></td>
                <td><button onclick="window.location.href='monitorize'">Monitorize</button></td>
            </tr>
        </table>
        <button onclick="window.location.href='report'">ADD Board</button>
    </div>

@stop