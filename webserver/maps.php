<!DOCTYPE html>
<html>
<?php

	include("connect.php"); 	
	$link=Connection();

	$result=mysql_query("SELECT * FROM `templog`",$link);
?>

<head>
<script src="http://maps.googleapis.com/maps/api/js"></script>
<script>
 function initialize() {
	var myPosition = {lat: 38.960382, lng: -0.180747};
  var mapProp = {
    center:new google.maps.LatLng(myPosition),
    zoom:10,
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
</head>

<body>
<div id="googleMap" style="width:500px;height:380px;"></div>
<h1>Temperature / moisture sensor readings</h1>

   <table border="1" cellspacing="1" cellpadding="1">
		<tr>
			<td>&nbsp;Timestamp&nbsp;</td>
			<td>&nbsp;Temperature 1&nbsp;</td>
			<td>&nbsp;Moisture 1&nbsp;</td>
		</tr>

      <?php 
		  if($result!==FALSE){
		     while($row = mysql_fetch_array($result)) {
		        printf("<tr><td> &nbsp;%s </td><td> &nbsp;%s&nbsp; </td><td> &nbsp;%s&nbsp; </td></tr>", 
		           $row["timeStamp"], $row["temperature"], $row["humidity"]);
		     }
		     mysql_free_result($result);
		     mysql_close();
		  }
      ?>
   </table>
	<div id="googleMap" style="width:500px;height:380px;"></div>
</body>

</html>