<?php get_header(); ?>

<div class="script-container" style="max-width: 800px; margin: 40px auto;">

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

    <!-- HEADER -->
    <div style="display:flex; justify-content:space-between; align-items:center;">
        <h1><?php the_title(); ?></h1>

        <?php if (is_user_logged_in() && get_current_user_id() == get_post_field('post_author')) : ?>
            <a href="?edit=1" style="padding:8px 12px; border:1px solid #ccc;">
                Edit
            </a>
        <?php endif; ?>
    </div>

    <hr>

    <!-- VIEW MODE -->
    <?php if (!isset($_GET['edit'])) : ?>

        <div class="script-view">
            <?php the_content(); ?>
        </div>

    <!-- EDIT MODE -->
    <?php else : ?>

        <h3>Edit Script</h3>

        <?php
        acf_form([
            'post_id' => get_the_ID(),
            'post_title' => true,
            'post_content' => true,
            'submit_value' => 'Save Script',
            'return' => get_permalink(),
        ]);
        ?>

    <?php endif; ?>

<?php endwhile; endif; ?>

</div>

<?php get_footer(); ?>