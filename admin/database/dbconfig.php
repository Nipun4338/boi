<?php

$server_name = "us-cdbr-east-03.cleardb.com";
$db_username = "b59c5d3fb540d0";
$db_password = "cbc81910";
$db_name = "heroku_636d30189854019";
$host="us-cdbr-east-03.cleardb.com";
$user="b7c37092a91da5";
$password="1ec492d3";
$db="heroku_6f64f08356c88c1";

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
