<?php

$server_name = "us-cdbr-east-03.cleardb.com";
$db_username = "ba1268b5ca99c6";
$db_password = "557bfa4e";
$db_name = "heroku_923aa6dacc1b73c";
$host="us-cdbr-east-03.cleardb.com";
$user="ba1268b5ca99c6";
$password="557bfa4e";
$db="heroku_923aa6dacc1b73c";

$connection = mysqli_connect($server_name,$db_username,$db_password,$db_name);
$link=mysqli_connect($server_name,$db_username,$db_password,$db_name);

if(!$connection)
{
    die("Connection failed: " . mysqli_connect_error());
    echo '
        <div class="container">
            <div class="row">
                <div class="col-md-8 mr-auto ml-auto text-center py-5 mt-5">
                    <div class="card">
                        <div class="card-body">
                            <h1 class="card-title bg-danger text-white"> Database Connection Failed </h1>
                            <h2 class="card-title"> Database Failure</h2>
                            <p class="card-text"> Please Check Your Database Connection.</p>
                            <a href="#" class="btn btn-primary">:( </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    ';
}
?>