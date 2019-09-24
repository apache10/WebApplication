<main class="bg-SL">
<div class="container">
    <br><br>
    <div class="col-6 mx-auto">
        <h1 class="text-center white-text">Login</h1>
        <?php 
        if (isset($_SESSION["message"])) {
            echo "<div id=error_msg'>".$_SESSION['message']."</div>";
            unset($_SESSION['message']);
        }
        ?>
        <?php if (strlen($status) > 0): echo '<div class="alert alert-danger">' . $status . '</div>'; endif?>
        <form id="form-login" class="mx-4" action="<?php echo base_url();?>login/login" method="POST">
            <div class="form-group">
                <label class="shift-right white-text">Email:</label>
                <input id="email" type="email" name="email" placeholder="email@domain.com" class="form-control" value="<?php if (isset($_COOKIE["email"])): echo $_COOKIE["email"]; endif ?>" required>
                <small id="emailHelp" class="form-text text-muted">enter the registered email address</small>
            </div>
            <div class="form-group">
                <label class="shift-right white-text">Password:</label>
                <input id="password-input" type="password" name="password" placeholder="Enter password" class="form-control" required>
                
            </div>
            <div class="form-group form-check">
                <input type="checkbox" class="form-check-input" name="remember" id="exampleCheck1" <?php if (isset($_COOKIE["email"])): echo "checked"; endif ?>>
                <label class="form-check-label white-text" for="remember" >remember me</label>
                <br>
                <p><a href="<?php echo base_url();?>login/forgotPassword">Forgot password?</a></p>
            </div>
            <div class="text-center">
                <button id="submit-button" type="submit" class="btn bg-four text-center">Login</button>
                <br><br>
                <p><a href="<?php echo base_url();?>register">Don't have an account?</a></p>
            </div>
        </form>
    </div>
</div>
<br><br>
</main>