<?php
/**
 * Template for Blog
 *
 * @package     Astra
 * @link        https://wpastra.com/
 * @since       Astra 4.6.0
 */
?>

<div <?php astra_blog_layout_class( 'blog-layout-4' ); ?>>
	<div class="post-content <?php echo wp_kses_post( astra_attr( 'ast-grid-common-col' ) ); ?>" >
		
		<?php astra_blog_post_thumbnail_and_title_order(); ?>

		<?php
$subcategories = get_the_terms(get_the_ID(), 'knowledge-subcategory');
$level = get_field('relevance_level');
?>

<?php if ($subcategories || $level) : ?>

<div class="card-meta-row">

    <div class="meta-left">

        <?php if ($subcategories && !is_wp_error($subcategories)) : ?>
            <?php foreach ($subcategories as $subcat) : ?>
                <span class="subcategory-pill">
                    <?php echo esc_html($subcat->name); ?>
                </span>
            <?php endforeach; ?>
        <?php endif; ?>

    </div>

    <div class="meta-right">
<?php
$field = get_field_object('relevance_level');

if ($field && $level) :

    $label = $field['choices'][$level];
?>

    <div class="relevance-badge <?php echo esc_attr($level); ?>">
        <?php echo esc_html($label); ?>
    </div>

<?php endif; ?>

    </div>

</div>

<?php endif; ?>

		<div class="entry-content clear"
		<?php
				echo wp_kses_post(
					astra_attr(
						'article-entry-content-blog-layout',
						array(
							'class' => '',
						)
					)
				);
				?>
		>
			<?php
				astra_entry_content_before();
				astra_entry_content_after();

				wp_link_pages(
					array(
						'before'      => '<div class="page-links">' . esc_html( astra_default_strings( 'string-blog-page-links-before', false ) ),
						'after'       => '</div>',
						'link_before' => '<span class="page-link">',
						'link_after'  => '</span>',
					)
				);
			?>
		</div><!-- .entry-content .clear -->

	</div><!-- .post-content -->
</div> <!-- .blog-layout-4 -->