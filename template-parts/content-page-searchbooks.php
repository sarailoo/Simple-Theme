<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Simple_Theme
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		<form method="post">
		<label fro="search">Search By ISBN: </label>
		<input id="search" type="number" name="search">
		<input id="submit" type="submit">
		</form>
	</header><!-- .entry-header -->

	<div class="entry-content">
	<?php
		if(isset($_POST['search'])){
			global $wpdb;
			echo "You Have Searched For ISBN = ".$_POST["search"]."<br/>";
			$post_id = $wpdb->get_var($wpdb->prepare("SELECT post_id FROM books_info WHERE isbn=%d",$_POST['search']));
			if(empty($post_id)){
				echo "Nothing Found !";
			}
			else{
				echo "Book Title: ".get_the_title($post_id);
			}
		}
	?>
	</div><!-- .entry-content -->

	<?php if ( get_edit_post_link() ) : ?>
		<footer class="entry-footer">
			<?php
			edit_post_link(
				sprintf(
					wp_kses(
						/* translators: %s: Name of current post. Only visible to screen readers */
						__( 'Edit <span class="screen-reader-text">%s</span>', 'simple-theme' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					get_the_title()
				),
				'<span class="edit-link">',
				'</span>'
			);
			?>
		</footer><!-- .entry-footer -->
	<?php endif; ?>
</article><!-- #post-<?php the_ID(); ?> -->
