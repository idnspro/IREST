<div class="container">
	<p class="wow fadeInLeft" data-wow-delay="0.4s">&copy; 2016  All rights  Reserved by &nbsp;<a href="<?php echo SITE_URL; ?>" target="target_blank"><?php echo ucwords( SITE_NAME ); ?></a></p>
</div>
<script type="text/javascript">
	$(document).ready(function() {
		/*
		var defaults = {
			containerID: 'toTop', // fading element id
			containerHoverID: 'toTopHover', // fading element hover id
			scrollSpeed: 1200,
			easingType: 'linear' 
		};
		*/
		$().UItoTop({ easingType: 'easeOutQuart' });
	});
</script>
<a href="#" id="toTop" style="display: block;"> <span id="toTopHover" style="opacity: 1;"> </span></a>
<?php /* ?>
<p align="left">
<strong>Sitemap:</strong><br />
<ul>
    <li style="padding-left:10px; font-size:14px;">
        <a href="<?php echo SITE_URL; ?>restaurants">Top Restaurants</a> | <a href="<?php echo SITE_URL; ?>restaurants">Delhi/NCR Restaurants</a> | <a href="<?php echo SITE_URL; ?>restaurants">East Delhi Restaurants</a> | <a href="<?php echo SITE_URL; ?>pages/restaurant-owners">Restaurant Owners</a> | <a href="<?php echo SITE_URL; ?>pages/restaurant-owners">Advertise with Us</a> | <a href="<?php echo SITE_URL; ?>pages/restaurant-owners">Why Foods24Hours?</a> |  <a href="<?php echo SITE_URL; ?>pages/careers">Careers</a>
    </li>
</ul>
<div class="clearfix"></div>
</p>
<hr />
<ul>
    <li style="width:20%; text-align:left;">&nbsp;
    <a href="<?php echo $facebooklink; ?>"><img src="<?php echo SITE_IMAGES;?>t.gif" class="gui-icon-social gui-icon-fb" style="opacity:0.4;filter:alpha(opacity=40)" onmouseover="this.style.opacity=1;this.filters.alpha.opacity=100" onmouseout="this.style.opacity=0.4;this.filters.alpha.opacity=40" ></a> <a href="<?php echo $twitterlink; ?>"><img src="<?php echo SITE_IMAGES;?>t.gif" class="gui-icon-social gui-icon-tw" style="opacity:0.4;filter:alpha(opacity=40)" onmouseover="this.style.opacity=1;this.filters.alpha.opacity=100" onmouseout="this.style.opacity=0.4;this.filters.alpha.opacity=40" ></a> <a href="<?php echo $youtubelink; ?>"><img src="<?php echo SITE_IMAGES;?>t.gif" class="gui-icon-social gui-icon-yt" style="opacity:0.4;filter:alpha(opacity=40)" onmouseover="this.style.opacity=1;this.filters.alpha.opacity=100" onmouseout="this.style.opacity=0.4;this.filters.alpha.opacity=40" ></a>
    </li>
    <li style="width:60%; text-align:center;">
        Copyright <?php echo date('Y');?> Foods24Hours.com<br />
		<?php
		if($_SESSION['ses_user_home'] == SITE_URL."manager-home") {
		?>
            <a href="<?php echo SITE_URL; ?>manager-about-us">About us</a> | <a href="<?php echo SITE_URL; ?>manager-terms">Terms & Condition</a> | <a href="<?php echo SITE_URL; ?>manager-privacy-policy">Privacy Policy</a> | <a href="<?php echo SITE_URL; ?>manager-testimonials">Testimonials</a> | <a href="<?php echo SITE_URL; ?>manager-resources">Resources</a>
        <?php
        } else {
		?>
            <a href="<?php echo SITE_URL; ?>about-us">About us</a> | <a href="<?php echo SITE_URL; ?>show-terms">Terms & Condition</a> | <a href="<?php echo SITE_URL; ?>privacy-policy">Privacy Policy</a> | <a href="<?php echo SITE_URL; ?>testimonials">Testimonials</a> | <a href="<?php echo SITE_URL; ?>resources">Resources</a>
        <?php
        }
        ?>
    </li>
    <li style="width:20%; text-align:right;"><a href="<?php if($_SESSION['ses_user_home'] == SITE_URL."manager-home") { echo SITE_URL."manager-contact-us"; } else { echo SITE_URL."contact-us"; } ?>" style="text-decoration:none; color:#fff;">Contact Us <img src="<?php echo SITE_IMAGES;?>t.gif" class="gui-icon-contact gui-icon-ct" style="margin-bottom:-5px;opacity:0.4;filter:alpha(opacity=40)" onmouseover="this.style.opacity=1;this.filters.alpha.opacity=100" onmouseout="this.style.opacity=0.4;this.filters.alpha.opacity=40" /></a></li>
</ul>
<div class="clearfix"></div>
<p align="center">Use of the website constitutes acceptence of our Terms & Conditions and Privacy Policy</p>
<p align="right" class="pad-rgt5">Website Developed By <a href="http://www.idns-technologies.com/" target="_blank" style="text-decoration:underline;">IDNS Technologies</a></p>
<!-- Piwik -->
<script type="text/javascript">
  var _paq = _paq || [];
  _paq.push(["trackPageView"]);
  _paq.push(["enableLinkTracking"]);

  (function() {
    var u=(("https:" == document.location.protocol) ? "https" : "http") + "://www.idns-technologies.info/analytics1/";
    _paq.push(["setTrackerUrl", u+"piwik.php"]);
    _paq.push(["setSiteId", "2"]);
    var d=document, g=d.createElement("script"), s=d.getElementsByTagName("script")[0]; g.type="text/javascript";
    g.defer=true; g.async=true; g.src=u+"piwik.js"; s.parentNode.insertBefore(g,s);
  })();
</script>
<!-- End Piwik Code -->
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-46842365-1', 'wdelivered.com');
  ga('send', 'pageview');

</script>
<?php */ ?>