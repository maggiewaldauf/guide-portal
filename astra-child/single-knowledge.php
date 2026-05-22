<?php get_header(); ?>

<div class="knowledge-container" style="max-width: 1100px; margin: 40px auto; position: relative;">

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

   <div class="knowledge-header">

    <h1><?php the_title(); ?></h1>

    <?php if (get_field('summary')) : ?>
        <p class="knowledge-summary">
            <?php the_field('summary'); ?>
        </p>
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




    <!-- META -->
    <div class="knowledge-meta">
        <?php
        $categories = get_the_terms(get_the_ID(), 'knowledge-category');
        if ($categories) {
            foreach ($categories as $cat) {
                echo '<span class="meta-pill">' . esc_html($cat->name) . '</span>';
            }
        }
        ?>
    </div>

    <hr>

    <div class="knowledge-layout">

        <!-- MAIN CONTENT -->
        <div class="knowledge-main">
            <?php the_content(); ?>
        </div>

        <!-- KEY FACTS -->
        <?php if (get_field('key_facts')) : ?>
            <div class="knowledge-facts">
                <h3>Key Facts</h3>
                <?php the_field('key_facts'); ?>
            </div>
        <?php endif; ?>

    </div>

    <!-- GUIDE NOTES -->
    <?php if (get_field('guide_notes')) : ?>
        <div class="guide-notes-box">
            <h3>For Guides</h3>
            <?php the_field('guide_notes'); ?>
        </div>
    <?php endif; ?>

<?php endwhile; endif; ?>

</div>

<?php get_footer(); ?>

