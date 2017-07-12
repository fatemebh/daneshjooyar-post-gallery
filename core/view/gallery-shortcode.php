<?php
/**
 * @author Hamed Moodi <hamedmoodi2011@gmail.com>
 * @since 1.0
 */
?>
<div class="swipebox-container-images">
	<?php foreach( $dy_post_gallery_images as $aid ):?>
		<?php if( wp_attachment_is_image( $aid ) ):?>
			<a rel="swipebox-gallery" href="<?php echo wp_get_attachment_url( $aid );?>" class="swipebox" title="<?php echo esc_attr( get_the_title( $aid ) );?>">
				<img src="<?php echo wp_get_attachment_thumb_url( $aid );?>" alt="<?php echo esc_attr( get_the_title( $aid ) );?>">
			</a>
		<?php elseif( wp_attachment_is( 'video', $aid ) ):?>
			<a rel="swipebox-gallery" href="<?php echo wp_get_attachment_url( $aid );?>" class="swipebox swipebox-video" title="<?php echo esc_attr( get_the_title( $aid ) );?>">
				<img src="<?php echo DYPG_IMG;?>play_icon.png" alt="<?php echo esc_attr( get_the_title( $aid ) );?>">
			</a>
		<?php endif;?>
	<?php endforeach;?>
</div>