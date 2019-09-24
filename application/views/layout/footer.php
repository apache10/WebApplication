
    <!--footer below  -->
<footer class="page-footer font-small cyan darken-3">

    <!-- Copyright -->
    <div class="footer-copyright text-center py-3">
    <?php 
        $query = @unserialize (file_get_contents('http://ip-api.com/php/'));
        if ($query && $query['status'] == 'success') {
            $default = $query['zip'];
            }?> 
        <?php echo  '<p>Zip Code '.$default.'</p>'; ?>
    © 2019 Copyright:
    <a href="mailto: gaurav.gupta@uqconnect.edu.au"> email admin</a>
    <br>
    <p>We accept <img height="40" src="https://shoplineimg.com/assets/footer/card_visa.png"/></P>
    <p>Coming Soon
    
      <img height="40" src="https://shoplineimg.com/assets/footer/card_master.png"/>
      <img height="40" src="https://shoplineimg.com/assets/footer/card_paypal.png"/>
      <img height="40" src="https://shoplineimg.com/assets/footer/card_unionpay.png"/>
      <img height="40" src="https://shoplineimg.com/assets/footer/card_tw_711_pay.png"/>
      <!-- <img height="40" src="https://shoplineimg.com/assets/footer/card_taishin.png"/> -->
      <img height="40" src="https://shoplineimg.com/assets/footer/card_amex.png"/>
      <img height="40" src="https://shoplineimg.com/assets/footer/card_ecpay.png"/>
      </p>

    </div>
    
    <!-- Copyright -->

</footer>
<!-- Footer -->
    <!-- Footer -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    
</body>
</html>
