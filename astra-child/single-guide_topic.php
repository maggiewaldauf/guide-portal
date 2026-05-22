<?php get_header(); ?>

<div class="guide-container">

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

    <!-- =========================
         TITLE
    ========================== -->
     <div class="knowledge-header">
    <h1 class="guide-title"><?php the_title(); ?></h1>
     <!-- =========================
         INTRO (ACF FIELD)
    ========================== -->
    <?php if (get_field('short_intro')) : ?>
        <div class="guide-intro">
            <?php the_field('short_intro'); ?>
        </div>
    <?php endif; ?>
    </div>

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
         MAIN CONTENT
    ========================== -->
    <div class="guide-content">
        <?php the_content(); ?>
    </div>

<?php endwhile; endif; ?>

</div>

<?php get_footer(); ?>