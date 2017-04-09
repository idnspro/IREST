<div class="container">
	<p class="wow fadeInLeft" data-wow-delay="0.4s">&copy; <?php echo date('Y'); ?>  All rights  Reserved by &nbsp;<a href="<?php echo SITE_URL; ?>" target="target_blank"><?php echo ucwords( SITE_NAME ); ?></a></p>
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
