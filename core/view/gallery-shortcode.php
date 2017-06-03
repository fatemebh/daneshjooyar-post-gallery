<div style="clear: both;"></div>
<div class="swipebox-container-images">
	<?php foreach( $dy_post_gallery_images as $aid ):?>
		<a rel="swipebox-gallery" href="<?php echo wp_get_attachment_url( $aid );?>" class="swipebox" title="<?php echo esc_attr( get_the_title( $aid ) );?>">
			<img src="<?php echo wp_get_attachment_thumb_url( $aid );?>" alt="image">
		</a>
	<?php endforeach;?>
</div>
<div style="clear: both;"></div>
