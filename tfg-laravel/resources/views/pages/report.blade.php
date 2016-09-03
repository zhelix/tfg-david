

@extends('layouts.app')



@section('content')

    <body onload="javascript:cambiarPestanna(pestanas,temperatura);">

    <style>
        body {
            margin-left:45px;
        }
        h1 {
            margin-left:45px;
        }
        h2#rep {
            margin-left:45px;
            white-space: pre;
        }
        h2 {
            white-space: pre;
        }
        div.relative {
            position: absolute;
            top: 105px;
            left: 750px;


        }
        span {
            white-space:nowrap;
        }

    </style>



    <h1><span style="white-space:nowrap" class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> Informes</h1>
    <h2><span style="white-space:nowrap" class="glyphicon glyphicon-map-marker" aria-hidden="true"></span> Posición</h2>

    <div class="relative">
        <h2  id="rep"><span style="white-space:nowrap" class="glyphicon glyphicon-search" aria-hidden="true"></span> Generar un informe</h2><br>
        <br>
        {!! Form::open(['url' => 'generate']) !!}
        <div class="form-group">
            {!! Form::label('date','Fecha:') !!}<br>
            {!! Form::label('date1','Desde: ') !!}{!!Form::date('date1',null)  !!}
            {!! Form::label('date2',' Hasta: ') !!}{!!Form::date('date2', \Carbon\Carbon::now())  !!}
        </div>
        <div class="form-group">
            {!! Form::label('format','Formato: ') !!}<br>
            <table border="0">
                <td width="25">{!! Form::radio('format','txt',['class' => 'form-control']) !!}</td>
                <td width="50">{!! Form::label('format','.txt') !!}</td>
                <td width="25">{!! Form::radio('format','csv',['class' => 'form-control']) !!}</td>
                <td width="50">{!! Form::label('format','.csv') !!}</td>
            </table>
        </div>

        <div class="form-group">
            {!! Form::submit('Generar un Informe',['class' => 'btn btn-primary form-control']) !!}
        </div>
        {!! Form::close() !!}

    </div>
    <hr>
    <div id="googleMap" style="width:500px;height:380px;"></div>


    </script><script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCzynwvcJcmx8Tth4CJzZN_D_BjRkllbtA&callback=initMap"
                async defer></script>
        <script>
            var map;
            var marker;
            function initMap() {
                var mapProp = {
                    center: new google.maps.LatLng({{$mapa->poslat}},{{$mapa->poslon}}),
                    zoom: 14,
                    mapTypeId: google.maps.MapTypeId.HYBRID
                };
                var map = new google.maps.Map(document.getElementById("googleMap"), mapProp);
                var myPos = new google.maps.LatLng({{$mapa->poslat}},{{$mapa->poslon}});
                marker = new google.maps.Marker({
                    position: myPos,
                    map: map,
                    title: 'Arduino DUE'
                });
                marker.setMap(map);
            }
        </script>

    <hr>

    <h2><span style="white-space:nowrap" class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> Seguimiento</h2>

    <div id="pestanas">
        <ul class="nav nav-tabs">
            <li id="temperatura"><a href='javascript:cambiarPestanna(pestanas,temperatura);'>Temperatura</a></li>
            <li id="humedad"><a href='javascript:cambiarPestanna(pestanas,humedad);'>Humedad</a></li>
            <li id="luz"><a href='javascript:cambiarPestanna(pestanas,luz);'>Luminica</a></li>
            <li id="gas"><a href='javascript:cambiarPestanna(pestanas,gas);'>Gas (CO)</a></li>
            <li id="acustica"><a href='javascript:cambiarPestanna(pestanas,acustica);'>Ruido</a></li>

        </ul>
    </div>
    <br>
    <div id="contenidopestanas">
        <div id="ctemperatura">
            <canvas id="tempe1" width="1300" height="400"></canvas>
        </div>
        <div id="chumedad">
            <canvas id="hume1" width="1300" height="400"></canvas>
        </div>
        <div id="cluz">
            <canvas id="light1" width="1300" height="400"></canvas>
        </div>
        <div id="cgas">
            <canvas id="co1" width="1300" height="400"></canvas>
        </div>
        <div id="cacustica">
            <canvas id="acustic1" width="1300" height="400"></canvas>
        </div>

        </div>
    </div>

    <script>
        //Get all the temperature in real time
        var temperatureData = {
            labels : ["0:00","1:00","2:00","3:00","4:00","5:00","6:00","7:00","8:00","9:00","10:00",
                "11:00","12:00","13:00","14:00","15:00","16:00","17:00","18:00","19:00","20:00","21:00","22:00","23:00"],
            datasets: [{
                label:'Grados ºC',
                fillColor: "#fff",
                strokeColor: "r#fff",
                pointColor: "#fff",
                data: [
                    @for ($i = 0; $i < date('H',strtotime($hour->created_at)); $i++)
                        {{ 0 }},
                    @endfor
                    @foreach ($realTime as $datax)
                        {{ $datax->temp }},
                    @endforeach]
            }]
        }





        //Get all the humidity in real time
        var humidityData = {
            labels : ["0:00","1:00","2:00","3:00","4:00","5:00","6:00","7:00","8:00","9:00","10:00",
                "11:00","12:00","13:00","14:00","15:00","16:00","17:00","18:00","19:00","20:00","21:00","22:00","23:00"],
            datasets : [
                {
                    label: "Porcentaje %",
                    fillColor : "rgba(0,204,204,0.4)",
                    strokeColor : "#ACC26D",
                    pointColor : "#fff",
                    pointStrokeColor : "#9DB86D",
                    data : [
                        @for ($i = 0; $i < date('H',strtotime($hour->created_at)); $i++)
                            {{ 0 }},
                        @endfor
                        @foreach ($realTime as $datax)
                            {{ $datax->hum }},
                        @endforeach]
                }
            ]
        }

        //Get all the light in real time
        var lightData = {
            labels : ["0:00","1:00","2:00","3:00","4:00","5:00","6:00","7:00","8:00","9:00","10:00",
                "11:00","12:00","13:00","14:00","15:00","16:00","17:00","18:00","19:00","20:00","21:00","22:00","23:00"],
            datasets : [
                {
                    label: "Lumens L",
                    fillColor : "rgba(255,153,51,0.4)",
                    strokeColor : "#ACC26D",
                    pointColor : "#fff",
                    pointStrokeColor : "#9DB86D",
                    data : [
                        @for ($i = 0; $i < date('H',strtotime($hour->created_at)); $i++)
                            {{ 0 }},
                        @endfor
                        @foreach ($realTime as $datax)
                            {{ $datax->luz }},
                        @endforeach]
                }
            ]
        }

        //Get all the gas in real time
        var coData = {
            labels : ["0:00","1:00","2:00","3:00","4:00","5:00","6:00","7:00","8:00","9:00","10:00",
                "11:00","12:00","13:00","14:00","15:00","16:00","17:00","18:00","19:00","20:00","21:00","22:00","23:00"],
            datasets : [
                {
                    label: "Partes por millon ppm",
                    fillColor : "rgba(192,192,192,0.4)",
                    strokeColor : "#ACC26D",
                    pointColor : "#fff",
                    pointStrokeColor : "#9DB86D",
                    data : [
                        @for ($i = 0; $i < date('H',strtotime($hour->created_at)); $i++)
                            {{ 0 }},
                        @endfor
                        @foreach ($realTime as $datax)
                            {{ $datax->gas }},
                        @endforeach]
                }
            ]
        }

        //Get all the noise in real time
        var acusticData = {
            labels : ["t 0:00","1:00","2:00","3:00","4:00","5:00","6:00","7:00","8:00","9:00","10:00",
                "11:00","12:00","13:00","14:00","15:00","16:00","17:00","18:00","19:00","20:00","21:00","22:00","23:00"],
            datasets : [
                {
                    label: "Decibelios dB",
                    fillColor : "rgba(175,255,102,0.4)",
                    strokeColor : "#ACC26D",
                    pointColor : "#fff",
                    pointStrokeColor : "#9DB86D",
                    data : [
                        @for ($i = 0; $i < date('H',strtotime($hour->created_at)); $i++)
                            {{ 0 }},
                        @endfor
                        @foreach ($realTime as $datax)
                            {{ $datax->noise }},
                        @endforeach]
                }
            ]
        }



        //TEMPERATURE

        new Chart(document.getElementById('tempe1').getContext('2d') , {
            type: "line",
            data: temperatureData,
            scaleLabel: "     sssssssssssss     < %=value%>",
        });
        //HUMIDITY

        new Chart(document.getElementById('hume1').getContext('2d') , {
            type: "line",
            data: humidityData,
            scaleLabel: "     sssssssssssss     < %=value%>",
        });


        //Light

        new Chart(document.getElementById('light1').getContext('2d') , {
            type: "line",
            data: lightData,
            scaleLabel: "     sssssssssssss     < %=value%>",
        });


        //CO

        new Chart(document.getElementById('co1').getContext('2d') , {
            type: "line",
            data: coData,
            scaleLabel: "     sssssssssssss     < %=value%>",
        });


        //Noise
        new Chart(document.getElementById('acustic1').getContext('2d') , {
            type: "line",
            data: acusticData,
            scaleLabel: "     sssssssssssss     < %=value%>",
        });


    </script>

    <script>
        function cambiarPestanna(pestannas,pestanna) {
            // Obtiene los elementos con los identificadores asignados.
            pestanna = document.getElementById(pestanna.id);
            listaPestannas = document.getElementById(pestannas.id);
            // Obtiene las divisiones que tienen el contenido de las pestañas.
            cpestanna = document.getElementById('c'+pestanna.id);
            listacPestannas = document.getElementById('contenido'+pestannas.id);
            i=0;
            // Recorre la lista ocultando todas las pestañas y restaurando el fondo y el padding de las pestañas.
            while (typeof listacPestannas.getElementsByTagName('div')[i] != 'undefined'){
                $(document).ready(function(){
                    $(listacPestannas.getElementsByTagName('div')[i]).css('display','none');
                    $(listaPestannas.getElementsByTagName('li')[i]).css('background','');
                    $(listaPestannas.getElementsByTagName('li')[i]).css('padding-bottom','');
                });
                i += 1;
            }
            $(document).ready(function(){
                $(cpestanna).css('display','');
                $(pestanna).css('padding-bottom','2px');
            });
        }
    </script>
@stop


