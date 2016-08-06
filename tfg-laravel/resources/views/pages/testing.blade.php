<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Chart.js demo</title>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/Chart.js/1.0.2/Chart.min.js'></script>
</head>
<body>

<?php



phpinfo()


?>

<script>
    var map;
    var marker;
    function initMap() {
        var mapProp = {
            center:new google.maps.LatLng(38.960382,-0.180747),
            zoom:7,
            mapTypeId:google.maps.MapTypeId.ROADMAP
        };
        var map=new google.maps.Map(document.getElementById("googleMap"),mapProp);

        var myPos = new google.maps.LatLng(38.960382,-0.180747);
        alert("trela");
        marker = new google.maps.Marker({
            position: myPos,
            map: map,
            title: 'It\'s me!'
        });
        marker.setMap(map);
    }
</script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBM3AK8M8UNQo7I39iu9pCK5T0KbTz2i5M&callback=initMap"
        async defer></script>
<div id="googleMap" style="width:500px;height:380px;"></div>
</body>
</html>