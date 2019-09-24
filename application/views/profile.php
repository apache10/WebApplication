<style type="text/css">
.effect7
{
    box-shadow: 20px 20px 50px 10px #CFCFCF;  
    border-radius: 3em 7em; 
    margin-left:1em;
}

</style>
<main class="container">
<?php if (isset($_SESSION["email"])): ?> 

<link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.min.css" rel="stylesheet" id="bootstrap-css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/style.css">
<script src="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

<br>
<div class="container-fluid well span6 " style="width:50em; box-shadow:0 10px 6px -6px ;">
  <div class="row-fluid" >
        <div class="span2" >
        <img src="<?php echo base_url();?>profilePic/<?php echo $_SESSION['filename']; ?>" alt="Profile image not available" class="img-circle">
        </div>
        
        <div class="span8">
            <h3><?php echo $_SESSION["name"]; ?></h3>
            <h6>Email: <?php echo $_SESSION["email"]; ?></h6>
            <h6>Phone : <?php echo $_SESSION["phone"]; ?></h6>
            <br>
        </div>
        
        <div class="span2">
                <a class="btn btn-info" style="background:#474747; color:#FFFFFF" onclick="openForm()">
                    Edit 
                </a>
        </div>
</div>
</div>

    <div id="mapholder" > </div>
            <p id="demo" ></p>
            <?php 
              $query = @unserialize (file_get_contents('http://ip-api.com/php/'));
              if ($query && $query['status'] == 'success') {
                $default = $query['zip'];
                $lat = $query['lat'];;
                $lng = $query['lon'];;
              }
                $latlon = $lat.",".$lng;
            ?>

    <br><br>
    <div id="temp" style="text-align: center; background:#F7F7F7;  box-shadow:0px 10px 6px -6px; border-radius:8px 8px 5em 5em; padding:2em; display: none;">
    <button type="button" class="btn btn-info" style="background:#CC0000; color:#FFFFFF;  margin-bottom:10px;" onclick="closeForm()">Close</button>
    <h3>Edit Profile</h3>
    <?php if (strlen($status) > 0): echo '<div class="alert bg-not">' . $status . '</div>'; endif?>
    <form action="<?php echo base_url();?>profile/update" method="POST" style="background:#F7F7F7; box-shadow:20px 20px 50px 15px #D1D1D1;  border-radius: 3em 3em 8px 8px; padding:5px 3em;">
        <input type="hidden" name="action" value="update">
        <label class="">Name:</label>
        <input type="text" name="name" value="<?php echo $_SESSION['name'] ;?>"><br>
        <label class="">Phone:</label>
        <input type="phone" name="phone" value="<?php echo $_SESSION['phone'] ;?>"><br>
        <input type="submit" class="btn btn-info" style="background:#474747;" value="update"><br><br>
    </form> 
    <h3 style="text-align:center;">Update password</h3>
    <form action="<?php echo base_url();?>profile/updatePassword" method="POST" style="background:#F7F7F7; box-shadow:20px 20px 50px 15px #D1D1D1;border-radius: 8px; padding:5px 3em;">
        <input type="hidden" name="action1" value="pass">
        <label class="">Password:</label>
        <input type="Password" id="password" name="password" placeholder="Enter new password"><br>
        <span id="passstrength"></span><br>
        <input type="submit"  class="btn btn-info" style="background:#474747;" value="update">
    </form> 
    <!-- style it better -->
    <h3 style="text-align:center;">Update Profile Picture</h3>
    <?php echo form_open_multipart('profile/uploadPic', 'style="background:#F7F7F7; box-shadow:20px 20px 50px 15px #D1D1D1;  border-radius: 8px 8px 3em 3em; padding:5px 3em;"');?>
    <?php echo "<input type='file' name='userfile' size='10' />"; ?>
    <?php echo "<input type='submit' class='btn btn-info' style='background:#474747;' name='submit' value='upload' /> ";?>
    <?php echo "<br>Please select file size less than 2MB";?>
    <?php echo "</form>"?>
        </div>
        

    <?php else: ?>
    <div class="bg-img">
    <br><br>
        <div class="col-6 mx-auto">
            <h1 class="header-welcome">WELCOME</h1>
            <p> Please login first</p>
        </div>
    </div>
    <br>
    <?php endif ?>
</main>





<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<script >
 $(document).ready(function(){  
    if(navigator.geolocation){
        navigator.geolocation.getCurrentPosition(showLocation);
    }else{ 
        $('#location').html('Geolocation is not supported by this browser.');
    }
$('#password').blur(function(){
     var password = $(this).val();
     $.ajax({
      url:'<?php echo site_url('register/checkPass')?>',
      method:"POST",
      data:{pass:password},
      success:function(html)
      {
        $('#passstrength').html(html);
      },
      error: function(jqxhr, status, exception) {
             alert('Exception:', exception);
         }
     })

  });
});

  function openForm() {
        document.getElementById("temp").style.display = "block";
        }
        
    function closeForm() {
        document.getElementById("temp").style.display = "none";
        }


function showLocation(position){
    var latitude = position.coords.latitude;
    var longitude = position.coords.longitude;
    var latlng = latitude+","+longitude;
    // alert(latitude+":"+longitude);
    var img_url = "https://www.google.com/maps/embed/v1/place?key=AIzaSyCwuR2690ydPt-VGfmU2Qv9z-lOF72CZZE&q="+latlng ;
    // alert(img_url);
    $("#mapholder").html("<iframe width='300' height='200' frameborder='0' class='effect7'  src='"+img_url+"'></iframe>")
    
}
</script>