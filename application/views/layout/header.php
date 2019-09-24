<!DOCTYPE html>
<html lang="en">
<header>
    <meta charset="UTF-8">
    <title>Homepage</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <!-- <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"> -->
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/style.css">
</header>

<body>
    <nav class="navbar navbar-expand-lg sticky-top navbar-light bg-light" >
        <a class="navbar-brand" href="<?php echo base_url();?>">Homepage</a>
        <ul class="navbar-nav ml-auto">

            <li class="nav-item ">
                <?php 
                if (isset($_SESSION["email"])) {
                    echo '<a class="nav-link" href="'. base_url().'chat">Chat</a>';
                } 
                ?>
            </li>
            <li class="nav-item ">
                <?php 
                if (isset($_SESSION["email"])) {
                    echo '<a class="nav-link" href="'. base_url().'resturant">Resturant</a>';
                } 
                ?>
            </li>
            <li class="nav-item ">
                <?php 
                if (isset($_SESSION["email"])) {
                    echo '<a class="nav-link " href="'. base_url().'login/logout">Logout</a>';
                } else {
                    echo '<a class="nav-link " href="'. base_url().'login">Login</a>';
                }
                ?>
            </li>
            <li class="nav-item ">
                <?php 
                if (isset($_SESSION["email"])) {
                    //format this
                    echo '<a class="nav-link " href="'. base_url().'profile">Profile</a>';
                } else {
                    echo '<a class="nav-link register " href="'. base_url().'register">Create an account</a>';
                }
                ?>
            </li>
        </ul>
    </nav>

