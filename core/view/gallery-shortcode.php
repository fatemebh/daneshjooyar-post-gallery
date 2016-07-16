<div style="clear: both;"></div>
<div class="colorbox-container-images">
	<?php foreach( $dy_post_gallery_images as $aid ):?>
		<a class="box thumbnail colorbox-thumbnail" href="<?php echo wp_get_attachment_url( $aid );?>">
		    <img alt="<?php echo esc_attr( get_the_title( $aid ) );?>" class="colorbox-image" src="<?php echo wp_get_attachment_thumb_url( $aid );?>">
		</a>
	<?php endforeach;?>
<div>
<div style="clear: both;"></div>
