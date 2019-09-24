<main class="bg-SL">
    <div class="container">
    <br><br>
        <div class="col-6 mx-auto">
            <h1 class="text-center white-text">Register</h1>
            <br>
            <?php if (strlen($status) > 0): echo '<div class="alert bg-not">' . $status . '</div>'; endif?>

            <form id="reg" method="POST" action="<?php echo base_url();?>register/register">
                <div class="form-group row">
                    <label class="shift-right white-text">Name:</label>
                    <input id="name" type="text" placeholder="please enter your name" name="name" onkeyup="" class="form-control" required>
                </div>
                <div class="form-group row">
                    <label class="shift-right white-text">Mobile:</label>
                    <input id="phone" type="tel" placeholder="438XXXXXX" name="mobile"  class="form-control" required>
                </div>
                <div class="form-group row">
                    <label class="shift-right white-text">Email:</label>
                    <input id="email" type="email" placeholder="email@example.com" name="email" class="form-control" required>
                    <span id="availability"></span>
                </div>
                <div class="form-group row">
                    <label class="shift-right white-text">Password:</label>
                    <input id="password" type="password" placeholder="Enter password" name="password" class="form-control" required>
                    <span id="passstrength"></span>
                </div>
                <div class="form-group row">
                    <label class="shift-right white-text">Confirm Password:</label>
                    <input id="repassword" type="password" placeholder="Re-Enter password" name="repassword" class="form-control" required>
                    <span id="repass"></span>
                </div>
                <br>
                <div class="text-center">
                    <button id="submit-button" name="register" type="submit" class="btn bg-four text-center">Register</button>
                </div>
            </form>

        </div>
    </div>
    <br><br>
</main>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<script >
 $(document).ready(function(){  

   $('#email').blur(function(){
     var username = $(this).val();
     $.ajax({
      url:'<?php echo site_url('register/checkEmail')?>',
      method:"POST",
      data:{email:username},
      success:function(html)
      {
        $('#availability').html(html);
      },
      error: function(jqxhr, status, exception) {
             alert('Exception:', exception);
         }
     })

  });
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
  $('#repassword').blur(function(){
     var repassword = $(this).val();
     var password = $('#password').val();
     $.ajax({
      url:'<?php echo site_url('register/rePass')?>',
      method:"POST",
      data:{repass:repassword,pass:password},
      success:function(html)
      {
        $('#repass').html(html);
      },
      error: function(jqxhr, status, exception) {
             alert('Exception:', exception);
         }
     })

  });
 }); 
</script>

