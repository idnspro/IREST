<?php
$restPhotoArr 	= $restObj->fun_getRestPhotosGallary($rest_id);
//print_r($restPhotoArr);
if(is_array($restPhotoArr) && !empty($restPhotoArr)) {
?>
<script type="text/javascript">
    jQuery(function($){
         $('a.photo-list-item').click(function(e){
             e.preventDefault();
             var uid = $(this).data('id');
             var url = $(this).data('url');
			 var title = $(this).data('name');
			 //alert(uid);
			 $('#menuModal .modal-title').html(title);
			 $('#menuModal .modal-body').html('<img src="'+url+'" width="100%" caption="'+title+'">');
			 $('#menuModal').modal('show');

			 /*
			 var menu_url = "<?php echo SITE_URL; ?>get-menu-items-Ajax.php?menu_id=" + uid + "&dtype='<?php echo ((isset($_COOKIE['cook_dtype']) && $_COOKIE['cook_dtype'] !="")?$_COOKIE['cook_dtype']:"delivery"); ?>'";
             $.get( menu_url, function(html){
                 $('#menuModal .modal-title').html(title);
                 $('#menuModal .modal-body').html(html);
                 $('#menuModal').modal('show', {backdrop: 'static'});
             });
			 */
         });
    });
</script>
<style type="text/css">
/* jQuery lightBox plugin - Gallery style */
#rest-gallery {
	/*
    background-color: #ccc;
	*/
    padding: 10px;
}
#rest-gallery ul { list-style: none; }
#rest-gallery ul li { display: inline; margin:5px;}
#rest-gallery ul img {
    border: 5px solid #3e3e3e;
    border-width: 5px 5px 20px;
}
#rest-gallery ul a:hover img {
    border: 5px solid #fff;
    border-width: 5px 5px 20px;
    color: #fff;
}
#rest-gallery ul a:hover { color: #fff; }
</style>
<div class="row" id="rest-gallery">
    <ul>
    <?php
        for($i =0; $i < count($restPhotoArr); $i++) {
            $photo_id 		= $restPhotoArr[$i]['photo_id'];
            $photo_caption 	= $restPhotoArr[$i]['photo_caption'];
            $rest_title 	= $restPhotoArr[$i]['rest_title'];
            $photo_url 		= RESTAURANT_IMAGES_LARGE_PATH.$restPhotoArr[$i]['photo_url'];
            $photo_thumb 	= RESTAURANT_IMAGES_THUMB168x126_PATH.$restPhotoArr[$i]['photo_thumb'];
            $photo_main 	= $restPhotoArr[$i]['photo_main'];
            echo '<li>';
            echo '<a href="#;" data-id="'.$photo_id.'" data-url="'.$photo_url.'" data-name="'.$photo_caption.'" class="photo-list-item" >';
            echo '<img src="'.$photo_thumb.'" width="168" height="126" alt="'.$photo_caption.'" />';
            echo '</a>';
            echo '</li>';
        }
    ?>
    </ul>
    <div class="clearfix"></div>
</div>
<?php
}
?>
