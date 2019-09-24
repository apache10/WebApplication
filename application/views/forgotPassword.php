<?php ?>
<!DOCTYPE html>

<html lang="en">
<header>
    <meta charset="UTF-8">
    <title>Forgot Password</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="css/styles.css">
</header>

<body>
    <header>
       <h1>Forgot Password!</h1>
    </header>
    <!-- container -->
    <main class="container">
     <p>Please enter your email below to reset the password.</p>
     <?php if (strlen($status) > 0): echo '<div class="alert alert-danger">' . $status . '</div>'; endif?>
     <form action="<?php echo base_url();?>login/sendEmail" method="POST">
                <div class="form-group">
                    <label class="shift-right">Email:</label>
                    <input id="email" type="email" name="email"  required>
                    <small id="emailHelp" class="form-text text-muted">enter the registered email address</small>
                </div>
                <div class="text-center">
                    <button id="submit-button" type="submit" class="btn btn-primary text-center">Submit</button>
                    <p><a href="<?php echo base_url();?>register">Don't have an account?</a></p>
                </div>
            </form>

    </main>
    
</body>
</html>