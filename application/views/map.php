<div id="mapholder"> </div>
<p id="demo"></p>
<?php 
  $query = @unserialize (file_get_contents('http://ip-api.com/php/'));
  if ($query && $query['status'] == 'success') {
    $default = $query['zip'];
    $lat = $query['lat'];;
    $lng = $query['lon'];;
  }
    $latlon = $lat.",".$lng;
?>



<script  src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
    if(navigator.geolocation){
        navigator.geolocation.getCurrentPosition(showLocation);
    }else{ 
        $('#location').html('Geolocation is not supported by this browser.');
    }
});

function showLocation(position){
    var latitude = position.coords.latitude;
    var longitude = position.coords.longitude;
    var latlng = latitude+","+longitude;
    // alert(latitude+":"+longitude);
    var img_url = "https://www.google.com/maps/embed/v1/place?key=AIzaSyCwuR2690ydPt-VGfmU2Qv9z-lOF72CZZE&q="+latlng ;
    // alert(img_url);
    $("#mapholder").html("<iframe width='600' height='450' frameborder='0' style='border:0' src='"+img_url+"'></iframe>")
    
}
</script>