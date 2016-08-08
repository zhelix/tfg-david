

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



    <h1>Reportes</h1>
    <h2><span style="white-space:nowrap" class="glyphicon glyphicon-map-marker" aria-hidden="true"></span> Position</h2>

    <div class="relative">
        <h2  id="rep"><span style="white-space:nowrap" class="glyphicon glyphicon-search" aria-hidden="true"></span> Generate a Report</h2><br>
        <button onclick="window.location.href='txt'" >Generate .txt</button>
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

    <h2><span style="white-space:nowrap" class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> Monitoring</h2>

    <div id="pestanas">
        <ul class="nav nav-tabs">
            <li id="temperatura"><a href='javascript:cambiarPestanna(pestanas,temperatura);'>Temperatura</a></li>
            <li id="humedad"><a href='javascript:cambiarPestanna(pestanas,humedad);'>Humedad</a></li>
            <li id="luz"><a href='javascript:cambiarPestanna(pestanas,luz);'>Luz</a></li>
            <li id="gas"><a href='javascript:cambiarPestanna(pestanas,gas);'>CO</a></li>
            <li id="acustica"><a href='javascript:cambiarPestanna(pestanas,acustica);'>Acustica</a></li>

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
            labels : ["t 1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19","20",
                "21","22","23","24"],
            datasets : [
                {
                    label: "Temperature",
                    fillColor : "rgba(255,102,102,0.4)",
                    strokeColor : "#ACC26D",
                    pointColor : "#fff",
                    pointStrokeColor : "#9DB86D",
                    data : [15,17,20,24,26,28,26,25,26,24,20,18,15]
                }
            ]
        }

        //Get all the humidity in real time
        var humidityData = {
            labels : ["t 1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19","20",
                "21","22","23","24"],
            datasets : [
                {
                    label: "Humidity",
                    fillColor : "rgba(0,204,204,0.4)",
                    strokeColor : "#ACC26D",
                    pointColor : "#fff",
                    pointStrokeColor : "#9DB86D",
                    data : [203,56,199,51,125,247]
                }
            ]
        }

        //Get all the light in real time
        var lightData = {
            labels : ["t 1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19","20",
                "21","22","23","24"],
            datasets : [
                {
                    label: "Humidity",
                    fillColor : "rgba(255,153,51,0.4)",
                    strokeColor : "#ACC26D",
                    pointColor : "#fff",
                    pointStrokeColor : "#9DB86D",
                    data : [203,156,99,251,305,247]
                }
            ]
        }

        //Get all the gas in real time
        var coData = {
            labels : ["t 1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19","20",
                "21","22","23","24"],
            datasets : [
                {
                    label: "CO",
                    fillColor : "rgba(192,192,192,0.4)",
                    strokeColor : "#ACC26D",
                    pointColor : "#fff",
                    pointStrokeColor : "#9DB86D",
                    data : [203,156,99,251,305,247]
                }
            ]
        }

        //Get all the noise in real time
        var acusticData = {
            labels : ["t 1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19","20",
                "21","22","23","24"],
            datasets : [
                {
                    label: "Noise",
                    fillColor : "rgba(175,255,102,0.4)",
                    strokeColor : "#ACC26D",
                    pointColor : "#fff",
                    pointStrokeColor : "#9DB86D",
                    data : [203,156,99,251,305,247]
                }
            ]
        }

        //TEMPERATURE
        var temperature = document.getElementById('tempe1').getContext('2d');
        new Chart(temperature).Line(temperatureData);

        //HUMIDITY
        var humidity = document.getElementById('hume1').getContext('2d');
        new Chart(humidity).Line(humidityData);

        //Light
        var light = document.getElementById('light1').getContext('2d');
        new Chart(light).Line(lightData);

        //CO
        var cogas = document.getElementById('co1').getContext('2d');
        new Chart(cogas).Line(coData);

        //Noise
        var noise = document.getElementById('acustic1').getContext('2d');
        new Chart(noise).Line(acusticData);


    </script>

    <!-- new version no resize....
    <script>
        var buyerData = {
            labels: ["10:00", "11:00", "12:00", "13:00", "14:00", "15:00", "16:00"],
            datasets: [
                {

                    label: "Temperature",
                    fillColor: "rgba(220,220,220,0.2)",
                    strokeColor: "rgba(220,220,220,1)",
                    pointColor: "rgba(220,220,220,1)",
                    pointStrokeColor: "#fff",
                    pointHighlightFill: "#fff",
                    pointHighlightStroke: "rgba(220,220,220,1)",
                    data: [15, 17, 20, 21, 23, 25, 24]
                },
            ]
        };
        var buyers = document.getElementById('buyers').getContext('2d');
            var myNewChart = new Chart(buyers, {
                type: "line",

                maintainAspectRatio: true,
                data: buyerData,
            });
    </script>
    -->

    <script>
        function cambiarPestanna(pestannas,pestanna) {
            // Obtiene los elementos con los identificadores pasados.
            pestanna = document.getElementById(pestanna.id);
            listaPestannas = document.getElementById(pestannas.id);

            // Obtiene las divisiones que tienen el contenido de las pestañas.
            cpestanna = document.getElementById('c'+pestanna.id);
            listacPestannas = document.getElementById('contenido'+pestannas.id);

            i=0;
            // Recorre la lista ocultando todas las pestañas y restaurando el fondo
            // y el padding de las pestañas.
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


