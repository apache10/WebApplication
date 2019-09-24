<?php ?>
<!DOCTYPE html>

<html lang="en">
<header>
    <meta charset="UTF-8">
    <title>Change Password</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="css/styles.css">
</header>

<body>
    <header>
       <h1>Change Password!</h1>
    </header>
    <!-- container -->
    <main class="container">
     <p>Please enter the new password.</p>
     <?php if (strlen($status) > 0): echo '<div class="alert alert-danger">' . $status . '</div>'; endif?>
     <form action="<?php echo base_url();?>login/updatePassword" method="POST">
                <div class="form-group">
                    <label class="shift-right">Password:</label>
                    <input id="password" type="password" name="password"  required>
                </div>
                <div class="text-center">
                    <button id="submit-button" type="submit" class="btn btn-primary text-center">Change</button>
                </div>
            </form>

    </main>
    
</body>
</html>