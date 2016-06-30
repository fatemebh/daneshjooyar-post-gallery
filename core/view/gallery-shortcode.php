<div style="clear: both;"></div>
<div class="viewbox-container-images">
	<?php foreach( $dy_post_gallery_images as $image ):?>
		<a class="box thumbnail viewbox-thumbnail" href="<?php echo esc_url($image);?>">
		    <img alt="<?php echo end(explode('/', esc_url($image)));?>" class="viewbox-image" src="<?php echo esc_url($image);?>">
		</a>
	<?php endforeach;?>
<div>
<div style="clear: both;"></div>
