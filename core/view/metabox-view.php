<div class="shortcode-help">
	<?php _e('Use <span>[dy-post-gallery]</span> shortcode in post for showing this gallery', 'daneshjooyar-post-gallery');?>
</div>
<ul>
<?php foreach( $dy_post_gallery_images as $url ):?>
	<li>
		<div class="dy-post-gallery-image">
			<img src="<?php echo esc_url( $url );?>" width="100" height="100"/>
			<a href="#" class="dy-post-gallery-delete">x</a>
			<input type="hidden" name="dy_post_gallery_image_url[]" value="<?php echo esc_url( $url );?>"/>
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