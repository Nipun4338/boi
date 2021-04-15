
<nav class = "navbar navbar-expand-lg navbar-light bg-light sticky-top shadow p-3 mb-5 bg-white rounded">

	 <div class="container-fluid">
	 <a href="index.php" class = "navbar-brand" style="font-weight:bold;padding:0 0 0 5%"><img src="favicon.svg" style="padding:5px; border-right:2px solid #ddd">
			বই
	</a>
	<p class = "navbar-brand" style="font-size: 12px;">বিকশিত হোক মনের দুয়ার</p>
		<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
	</button>
	 <div class="collapse navbar-collapse" id="navbarSupportedContent">
	 <ul class="navbar-nav ms-auto mb-2 mb-lg-0" style="padding: 0px 5px 0px 5px;font-weight:bold">

			 <a class="nav-item nav-link" href = "index.php"> HOME </a>

			 <a class="nav-item nav-link" href = "selling.php"> SELLING </a>

			 <a class=" nav-item nav-link" href = "aboutus.php"> ABOUT US </a>

			 <a class=" nav-item nav-link" href = "contactus.php"> CONTACT US </a>

			 <?php if (!isset($_SESSION["username"])) {

    		$message= '<a class="nav-item nav-link" href = "login.php"> LOGIN </a>';
			}
			else {
				$message='<a class="nav-item nav-link" href = "profile.php"> PROFILE </a>';
			}

				echo ($message);?>

	 </ul>
 </div>
</div>
 </nav>
