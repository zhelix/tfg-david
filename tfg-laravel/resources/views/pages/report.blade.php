@extends('app')


<body onload="javascript:cambiarPestanna(pestanas,temperatura);">
@section('content')

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBM3AK8M8UNQo7I39iu9pCK5T0KbTz2i5M"
            async defer></script>

    <h1>Reportes</h1>

    <h2>Posicion</h2><div id="googleMap" style="width:500px;height:380px;"></div>
    <div >

    <script src="http://maps.googleapis.com/maps/api/js"></script>
    <script>
        function initialize() {
            var myPosition = { {{ $position }} };
            var mapProp = {
                center:new google.maps.LatLng(myPosition),
                zoom:13,
                mapTypeId:google.maps.MapTypeId.ROADMAP
            };

            var map=new google.maps.Map(document.getElementById("googleMap"),mapProp);

            var marker = new google.maps.Marker({
                position: myPosition,
                map: map,
                title: 'Hello World!'
            });
        }


        google.maps.event.addDomListener(window, 'load', initialize);

    </script>

    <hr>

    <h2>Seguimiento</h2>

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
            <canvas id="tempe1" width="600" height="400"></canvas>
        </div>
        <div id="chumedad">
            <canvas id="hume1" width="600" height="400"></canvas>
        </div>
        <div id="cluz">
            <canvas id="light1" width="600" height="400"></canvas>
        </div>
        <div id="cgas">
            <canvas id="co1" width="600" height="400"></canvas>
        </div>
        <div id="cacustica">
            <canvas id="acustic1" width="600" height="400"></canvas>
        </div>

        </div>
    </div>

    <script>
        //Get all the temperature in real time
        var temperatureData = {
            labels : ["H 1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19","20",
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
            labels : ["H 1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19","20",
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
            labels : ["H 1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19","20",
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
            labels : ["H 1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19","20",
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
            labels : ["H 1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19","20",
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


