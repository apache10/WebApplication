<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Stripe Gateway Codeigniter</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link rel="stylesheet" href="<?php echo base_url(); ?>/assets/css/bootstrap.min.css" />

    <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/css/style.css" />    

    <!-- jQuery is used only for this example; it isn't required to use Stripe -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

	<link rel="stylesheet" href="<?php echo base_url(); ?>/assets/js/bootstrap.min.js" />

    <!-- Stripe JavaScript library -->
    <script type="text/javascript" src="https://js.stripe.com/v2/"></script>    
    
    <script type="text/javascript">
        //set your publishable key
        Stripe.setPublishableKey('pk_test_LlHZHX0t4PpVbjDDrb1WIzgF00WBtkZlfK');
        
        //callback to handle the response from stripe
        function stripeResponseHandler(status, response) {
            if (response.error) {
                //enable the submit button
                $('#payBtn').removeAttr("disabled");
                //display the errors on the form
                // $('#payment-errors').attr('hidden', 'false');
                $('#payment-errors').addClass('alert alert-danger');
                $("#payment-errors").html(response.error.message);
            } else {
                var form$ = $("#paymentFrm");
                //get token id
                var token = response['id'];
                //insert the token into the form
                form$.append("<input type='hidden' name='stripeToken' value='" + token + "' />");
                //submit form to the server
                form$.get(0).submit();
            }
        }
        $(document).ready(function() {
            //on form submit
            $("#paymentFrm").submit(function(event) {
                //disable the submit button to prevent repeated clicks
                $('#payBtn').attr("disabled", "disabled");
                
                //create single-use token to charge the user
                Stripe.createToken({
                    number: $('#card_num').val(),
                    cvc: $('#card-cvc').val(),
                    exp_month: $('#card-expiry-month').val(),
                    exp_year: $('#card-expiry-year').val()
                }, stripeResponseHandler);
                
                //submit from callback
                return false;
            });
        });
    </script>


	
</head>
<body>

    <h1 class="text-center">Payment Gateway</h1><br>
    <br><br>
    <div class="container">
        <div class="row">	
        <div class="col-sm-6">
               <div class="card text-right " style="width: 30rem; ; box-shadow: 5px 5px #d3d3d3;">
                  <div class="card-header bg-four text-white">CHECK OUT</div><br>
                  <?php if($menu):?>
                  <img class="card-img-top" width="330" src="<?php echo base_url(); ?>profilePic/<?php echo $menu['filename'];?>" alt="<?php echo base_url(); ?>profilePic/<?php echo $menu['filename'];?>" /><br/>
                  <div class="card-body">
                    <h5 class="card-title">Name: <?php echo $menu['name'];?></h5>
                    <p class="card-text">Details: <?php echo $menu['details'];?></p>
                    <p class="card-text">Amount:$ <?php echo $menu['price'];?> </p>
                  </div>
                  <div class="card-footer bg-transparent bg-primary text-black">
                     <a class="btn bg-link" >TOTAL: $ <?php echo $menu['price'];?></a>
                  </div>
                <?php endif ?>
               </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <!-- product info -->
                    <div class="card-header bg-success text-white ">Enter your card details</div>
                    <div class="card-body bg-light">
                        <?php if (validation_errors()): ?>
                            <div class="alert alert-danger" role="alert">
                                <strong>Oops!</strong>
                                <?php echo validation_errors() ;?> 
                            </div>  
                        <?php endif ?>
                        <div id="payment-errors"></div>  
                        <form method="post" id="paymentFrm" enctype="multipart/form-data" action="<?php echo base_url(); ?>Payment/check">
                            <div class="form-group">
                                <input type="text" name="name" class="form-control" placeholder="Name" value="<?php echo set_value('name'); ?>" required>
                            </div>  

                            <div class="form-group">
                                <input type="email" name="email" class="form-control" placeholder="email@you.com" value="<?php echo set_value('email'); ?>" required />
                            </div>

                            <div class="form-group">
                                <input type="number" name="card_num" id="card_num" class="form-control" placeholder="Card Number" autocomplete="off" value="<?php echo set_value('card_num'); ?>" required>
                            </div>
                        
                            
                            <div class="row">

                                <div class="col-sm-8">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <input type="text" name="exp_month" maxlength="2" class="form-control" id="card-expiry-month" placeholder="MM" value="<?php echo set_value('exp_month'); ?>" required>
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <input type="text" name="exp_year" class="form-control" maxlength="4" id="card-expiry-year" placeholder="YYYY" required="" value="<?php echo set_value('exp_year'); ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <input type="text" name="cvc" id="card-cvc" maxlength="3" class="form-control" autocomplete="off" placeholder="CVC" value="<?php echo set_value('cvc'); ?>" required>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group text-right">
                            <button class="btn btn-secondary" type="reset">Reset</button>
                            <button type="submit" id="payBtn" class="btn btn-success">Submit Payment</button>
                            </div>
                        </form>     
                    </div>
                </div>
                    
            </div>
        </div>
    </div>

</body>
</html>