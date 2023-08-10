<?php
get_header(); ?>

<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">

        <?php while (have_posts()) : the_post(); ?>

            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <header class="entry-header">
                    <h1 class="entry-title"><?php the_title(); ?></h1>
                </header>

                <div class="entry-content">
                    <?php the_content(); ?>

                    <?php if (is_user_logged_in()) {
                        $current_user = wp_get_current_user(); ?>

                        <h2>Informations du profil</h2>
                        <p><strong>Nom d'utilisateur :</strong> <?php echo $current_user->user_login; ?></p>
                        <p><strong>Email :</strong> <?php echo $current_user->user_email; ?></p>
                        <p><strong>Prénom :</strong> <?php echo $current_user->user_firstname; ?></p>
                        <p><strong>Nom :</strong> <?php echo $current_user->user_lastname; ?></p>
                        <p><strong>Avatar :</strong> <?php echo get_avatar($current_user->ID, 96); ?></p>
                    <?php } else { ?>
                        <p>Veuillez vous connecter pour voir vos informations de profil.</p>
                    <?php } ?>

                </div>
            </article>

        <?php endwhile; ?>

    </main>
</div>
<?php get_footer(); ?>
