<?php get_header(); ?>

<div class="destination-container">

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

<!-- =========================
     TITLE
========================= -->

<h1 class="destination-title"><?php the_title(); ?></h1>


<!-- =========================
         Buttons
    ========================== -->

<?php
$user_id = get_current_user_id();
$bookmarks = get_user_meta($user_id, 'saved_bookmarks', true);

if (!is_array($bookmarks)) {
    $bookmarks = [];
}

$post_id = get_the_ID();

$is_saved = false;

foreach ($bookmarks as $b) {
    if (
        isset($b['id'], $b['type'], $b['group']) &&
        (int)$b['id'] === $post_id &&
        $b['type'] === 'content'
    ) {
        $is_saved = true;
        break;
    }
}
?>

<div class="card-actions">

    <div class="card-heart <?php echo $is_saved ? 'saved' : ''; ?>"
         data-id="<?php echo $post_id; ?>"
         data-type="content"
         data-group="content">
        <?php echo $is_saved ? '♥' : '♡'; ?>
    </div>

    <button class="add-to-script-btn" data-content-id="<?php echo get_the_ID(); ?>">
        <span class="add-icon">＋</span>
        <span class="add-text">Add to script</span>
    </button>

</div>



<!-- =========================
     TAB NAV
========================= -->
<div class="tabs-nav">
    <button class="tab-btn active" data-tab="overview">Overview</button>
    <button class="tab-btn" data-tab="tours">Tours</button>
    <button class="tab-btn" data-tab="knowledge">Knowledge</button>
    <button class="tab-btn" data-tab="logistics">Logistics</button>
</div>

<!-- =========================
     CONTENT WRAPPER
========================= -->
<div class="tab-content-wrapper">

<!-- =========================
     OVERVIEW
========================= -->
<div class="tab-content active" id="overview">

    <div class="overview-grid">

        <div class="overview-main destination-content">

         <!-- MAIN CONTENT (images, maps, etc.) -->
            <div class="destination-content prose-content">
    <?php the_content(); ?>
</div>

            <?php if (get_field('destination_intro')) : ?>
                <div class="content-block">
                    <?php the_field('destination_intro'); ?>
                </div>
            <?php endif; ?>



            <?php if (get_field('related_sights')) : ?>

<div class="content-block">
    <h2>Top Sights</h2>

    <div class="sight-grid">

        <?php foreach (get_field('related_sights') as $post) : setup_postdata($post); ?>

            <a href="<?php the_permalink(); ?>" class="sight-card">

                <?php if (has_post_thumbnail()) : ?>
                    <div class="sight-image">
                        <?php the_post_thumbnail('medium'); ?>
                    </div>
                <?php endif; ?>

                <div class="sight-content">
                    <h3><?php the_title(); ?></h3>

                    <p>
                        <?php echo wp_trim_words(get_field('summary'), 18); ?>
                    </p>
                </div>

            </a>

        <?php endforeach; wp_reset_postdata(); ?>

    </div>
</div>

<?php endif; ?>

            <?php if (get_field('destination_highlights')) : ?>
                <div class="content-block">
                    <h2>Other Destination Highlights</h2>
                    <?php the_field('destination_highlights'); ?>
                </div>
            <?php endif; ?>

        </div>

        <div class="overview-sidebar">

            <?php if (get_field('destination_facts')) :
                $facts = get_field('destination_facts');
            ?>

            <div class="facts-box">

                <h3>Key Facts</h3>

               <?php if (!empty($facts['region'])) : ?>

    <?php
    $region_ids = $facts['region'];

    $terms = get_terms([
        'taxonomy' => 'region',
        'include' => $region_ids,
        'hide_empty' => false
    ]);

    $names = [];

    if (!is_wp_error($terms)) {
        foreach ($terms as $term) {
            $names[] = $term->name;
        }
    }
    ?>

    <?php if (!empty($names)) : ?>
        <p><strong>Region:</strong> <?php echo esc_html(implode(', ', $names)); ?></p>
    <?php endif; ?>

<?php endif; ?>

                <?php if (!empty($facts['key_feature'])) : ?>
                    <p><strong>Feature:</strong> <?php echo esc_html($facts['key_feature']); ?></p>
                <?php endif; ?>

                <?php if (!empty($facts['season_notes'])) : ?>
                    <p><strong>Season:</strong> <?php echo esc_html($facts['season_notes']); ?></p>
                <?php endif; ?>

            </div>

            <?php endif; ?>

        </div>

    </div>

</div>

<!-- =========================
     TOURS
========================= -->
<div class="tab-content" id="tours">

    <h2>Tours</h2>

    <?php if (get_field('core_tour_overview')) : ?>
        <div class="content-block">
            <h3>Core Tour</h3>
            <?php the_field('core_tour_overview'); ?>
        </div>
    <?php endif; ?>

    <div class="content-block">

        <h3>Available Tours</h3>

        <?php
        $destination_id = get_the_ID();

        $tours = new WP_Query([
            'post_type' => 'tour',
            'posts_per_page' => -1,
            'meta_query' => [
                [
                    'key' => 'tour_destination',
                    'value' => '"' . $destination_id . '"',
                    'compare' => 'LIKE'
                ]
            ]
        ]);
        ?>

        <?php if ($tours->have_posts()) : ?>
            <?php while ($tours->have_posts()) : $tours->the_post(); ?>

                <div class="tour-card content-block">

                    <h4><?php the_title(); ?></h4>

                    <p>
                        <?php the_field('tour_type'); ?> •
                        <?php the_field('tour_duration'); ?>
                    </p>

                    <p><?php the_field('tour_description'); ?></p>

                </div>

            <?php endwhile; ?>
        <?php endif; wp_reset_postdata(); ?>

    </div>

    <div class="tour-variation-box content-block">

        <?php if (get_field('tour_variations')) : ?>
            <h3>Tour Variations</h3>
            <?php the_field('tour_variations'); ?>
        <?php endif; ?>

        <?php if (get_field('timing_pdf')) : ?>
            <a class="pdf-button" href="<?php the_field('timing_pdf'); ?>" target="_blank">
                Download Timings PDF
            </a>
        <?php endif; ?>

    </div>

</div>

<!-- =========================
     KNOWLEDGE
========================= -->
<div class="tab-content" id="knowledge">

    <h2>Related Knowledge</h2>

    <?php $related = get_field('related_knowledge'); ?>

    <?php if ($related) : ?>

        <div class="content-block">

            <ul>
                <?php foreach ($related as $post) : setup_postdata($post); ?>

                    <li>
                        <a href="<?php the_permalink(); ?>">
                            <?php the_title(); ?>
                        </a>
                    </li>

                <?php endforeach; wp_reset_postdata(); ?>
            </ul>

        </div>

    <?php endif; ?>

</div>

<!-- =========================
     LOGISTICS
========================= -->
<div class="tab-content" id="logistics">

<?php if (get_field('guide_logistics')) :
    $log = get_field('guide_logistics');
?>

<div class="content-block">

    <h2>Guide Logistics</h2>

    <div class="log-item">
        <strong>Harbour:</strong>
        <div class="content-block-inner">
            <?php echo wp_kses_post($log['harbour_info']); ?>
        </div>
    </div>

    <div class="log-item">
        <strong>Parking:</strong>
        <div class="content-block-inner">
            <?php echo wp_kses_post($log['parking']); ?>
        </div>
    </div>

    <div class="log-item">
        <strong>Webcams:</strong>
        <div class="content-block-inner">
            <?php echo make_clickable(wp_kses_post($log['webcams'])); ?>
        </div>
    </div>

    <div class="log-item">
        <strong>Notes:</strong>
        <div class="content-block-inner">
            <?php echo wp_kses_post($log['operational_notes']); ?>
        </div>
    </div>

    <?php if (!empty($log['timing_notes'])) : ?>

    <div class="log-item">
        <strong>Timing Notes:</strong>
        <div class="content-block-inner prose-content">
            <?php echo wp_kses_post($log['timing_notes']); ?>
        </div>
    </div>

<?php endif; ?>

</div>

<?php endif; ?>

</div>

</div> <!-- wrapper -->

<?php endwhile; endif; ?>

</div>

<script>
document.querySelectorAll('.tab-btn').forEach(button => {
  button.addEventListener('click', () => {

    document.querySelectorAll('.tab-btn').forEach(btn => btn.classList.remove('active'));
    button.classList.add('active');

    document.querySelectorAll('.tab-content').forEach(tab => tab.classList.remove('active'));

    document.getElementById(button.dataset.tab).classList.add('active');
  });
});
</script>

<?php get_footer(); ?>


