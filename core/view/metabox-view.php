<div class="shortcode-help">
	<?php _e('Use <span>[dy-post-gallery]</span> shortcode in post for showing this gallery', 'daneshjooyar-post-gallery');?>
</div>
<div class="settings">
	<p><?php _e('Select ColorBox theme: ', 'daneshjooyar-post-gallery');?></p>
	<?php foreach( range(1, 5) as $index ):?>
		<div>
		  	<input id="cb-theme-<?php echo $index;?>" type="radio" name="colorbox_theme" value="theme-<?php echo $index;?>" <?php checked( $dy_post_colorbox_gallery_theme, 'theme-' . $index );?>>
		  	<label for="cb-theme-<?php echo $index;?>"><?php printf(__( 'Theme %d', 'daneshjooyar-post-gallery'), $index);?></label>
		</div>
	<?php endforeach;?>
</div>
<ul>
<?php foreach( $dy_post_gallery_images as $aid ):?>
	<li>
		<div class="dy-post-gallery-image">
			<img src="<?php echo wp_get_attachment_thumb_url( $aid );?>" width="100" height="100"/>
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