<?php
/**
 * Posts layout right sidebar.
 *
 * @package          Flatsome\Templates
 * @flatsome-version 3.16.0
 */

do_action('flatsome_before_blog');
?>

<?php if(!is_single() && flatsome_option('blog_featured') == 'top'){ get_template_part('template-parts/posts/featured-posts'); } ?>

<div class="row row-large <?php if(flatsome_option('blog_layout_divider')) echo 'row-divided ';?>">
	<div class="large-9 col">
	<?php if(is_category() || is_tag()) { 
		$category = get_queried_object(); // Get the current category object
		$category_id = $category->term_id; // Get the category ID
		$category_banner = get_field('category_banner_img', 'category_' . $category_id);
		if($category_banner != NULL) {
	?>
		<div class="banner-container">
			<img src="<?php echo $category_banner; ?>"	/>
		</div>
	<?php }
	}?>
	<?php if(!is_single() && flatsome_option('blog_featured') == 'content'){ get_template_part('template-parts/posts/featured-posts'); } ?>
	<?php
		if(is_single()){
			get_template_part( 'template-parts/posts/single');
			comments_template();
		} elseif(flatsome_option('blog_style_archive') && (is_archive() || is_search())){
			get_template_part( 'template-parts/posts/archive', flatsome_option('blog_style_archive') );
		} else {
			get_template_part( 'template-parts/posts/archive', flatsome_option('blog_style') );
		}
	?>
	<?php
		if ( is_category() ) :
			// show an optional category description
			$category_description = category_description();
			if ( ! empty( $category_description ) ) :
				$category_title = get_field('category_title', 'category_' . $category_id);
				echo apply_filters( 'category_archive_meta', '<div class="taxonomy-description"><div class="category-title">'. $category_title .'</div><div class="desc-content collapsed">' . $category_description . '<button class="read-more-btn">Xem thêm</button></div></div>' );
			endif;

		elseif ( is_tag() ) :
			// show an optional tag description
			$tag_description = tag_description();
			if ( ! empty( $tag_description ) ) :
				echo apply_filters( 'tag_archive_meta', '<div class="taxonomy-description">' . $tag_description . '</div>' );
			endif;

		endif;
	?>
	</div>
	<div class="post-sidebar large-3 col">
		<?php flatsome_sticky_column_open( 'blog_sticky_sidebar' ); ?>
		<?php get_sidebar(); ?>
		<?php flatsome_sticky_column_close( 'blog_sticky_sidebar' ); ?>
	</div>
</div>

<?php
	do_action('flatsome_after_blog');
?>
