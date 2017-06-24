<div class="shortcode-help">
	<?php _e('Use <span>[dy-post-gallery]</span> shortcode in post for showing this gallery', 'daneshjooyar-post-gallery');?>
</div>
<ul>
<?php foreach( $dy_post_gallery_images as $aid ):?>
	<?php
	$thumbnail_url = wp_get_attachment_thumb_url( $aid );
	if( wp_attachment_is( 'video', $aid ) ){
		$thumbnail_url = DYPG_IMG . 'play_icon.png';
	}elseif( wp_attachment_is( 'audio', $aid ) ){
		$thumbnail_url = DYPG_IMG . 'audio_icon.png';
	}
	?>
	<li>
		<div class="dy-post-gallery-image" title="<?php echo esc_attr( get_the_title( $aid ) );?>">
			<img src="<?php echo $thumbnail_url;?>" height="100"/>
			<a href="#" class="dy-post-gallery-delete">x</a>
			<input type="hidden" name="dy_post_gallery_image_url[]" value="<?php echo $aid;?>"/>
		</div>
	</li>
<?php endforeach;?>
	<li class="add-new">
		<div class="dy-post-gallery-image">
			<img src="<?php echo DYPG_IMG;?>plus.jpg" width="100" height="100"/>
		</div>
	</li>
</ul>
<?php wp_nonce_field( $post->ID . get_current_user_id(), 'dy_post_gallery_nonce', false ); ?>