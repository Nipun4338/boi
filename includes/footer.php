
<script>
// When the user scrolls the page, execute myFunction
window.onscroll = function() {myFunction()};

function myFunction() {
  var winScroll = document.body.scrollTop || document.documentElement.scrollTop;
  var height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
  var scrolled = (winScroll / height) * 100;
  document.getElementById("myBar").style.width = scrolled + "%";
}
</script>
<footer id="footer" class="footer-wrapper" style="box-shadow: 0px 10px 5px #888, 0px -10px 5px #888;background-color:#abcdef;">
	 <div class="container">
			 <div class="row">
					 <div class="col-lg-8 col-md-8 col-sm-8" style="padding:25px">
								<h1 class="quick-links-title">বই</h1>
								<p>© Copyright 2021</p>
					 </div>
					 <div class="col-lg-4 col-md-4 col-sm-4" style="padding:25px">
							 <h1 class="quick-links-title">QUICK LINKS</h1>
							 <ul class="quick-links">
									 <li><a href="home">Home</a></li>
									 <li><a href="sell">Sell</a></li>
									 <li><a href="contact">Contact Us</a></li>
							 </ul>
					 </div>

			 </div>
	 </div>



</footer>
</html>
