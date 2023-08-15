<?php
get_header(); ?>

<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">

        <?php while (have_posts()) : the_post(); ?>

            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

                <div class="entry-content">
                    <?php the_content(); ?>

                    <?php if (is_user_logged_in()) { ?>

                        <section class="pt-16 bg-blueGray-50">
                            <div class="w-full lg:w-8/12 px-4 mx-auto">
                                <div class="relative flex flex-col min-w-0 break-words bg-white w-full mb-6 shadow-xl rounded-lg mt-16">
                                    <div class="px-6">
                                        <div class="flex flex-wrap justify-center">
                                            <div class="w-full px-4 flex justify-center">
                                                <div class="relative">
                                                    <?php
                                                    $user_id = get_current_user_id();
                                                    $avatar_url = get_avatar_url($user_id);

                                                    ?>
                                                    <img alt="..." src="<?= esc_url($avatar_url) ?>" class="shadow-xl rounded-full h-auto align-middle border-none absolute -m-16 -ml-20 lg:-ml-16 max-w-max">
                                                </div>
                                            </div>
                                            <div class="w-full px-4 text-center mt-20">
                                                <div class="flex justify-center py-4 lg:pt-4 pt-8">
                                                    <!-- <div class="mr-4 p-3 text-center">
                                    <span class="text-xl font-bold block uppercase tracking-wide text-blueGray-600">
                                        22
                                    </span>
                                    <span class="text-sm text-blueGray-400">Friends</span>
                                </div>
                                <div class="mr-4 p-3 text-center">
                                    <span class="text-xl font-bold block uppercase tracking-wide text-blueGray-600">
                                        10
                                    </span>
                                    <span class="text-sm text-blueGray-400">Photos</span>
                                </div> -->
                                                    <div class="lg:mr-4 p-3 text-center">
                                                        <?php
                                                        $user_id = get_current_user_id(); // Obtient l'ID de l'utilisateur connecté
                                                        $comments_count = get_comments(array(
                                                            'user_id' => $user_id,
                                                            'count' => true,
                                                        ));
                                                        ?>
                                                        <span class="text-xl font-bold block uppercase tracking-wide text-blueGray-600">
                                                            <?= $comments_count ?>
                                                        </span>
                                                        <span class="text-sm text-blueGray-400">
                                                            <?= sprintf(_n('%s Commentaire', '%s Commentaires', $comments_count), __('')) ?>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-center mt-12">
                                            <h1 class="text-xl font-bold mb-4">Informations du profil :</h1>
                                            <p>
                                                <strong> Nom utilisateur:</strong>
                                                <?php echo $current_user->user_login; ?>
                                            </p>
                                            <p><strong>Email :</strong> <?php echo $current_user->user_email; ?></p>
                                            <p><strong>Prénom :</strong> <?php echo $current_user->user_firstname; ?></p>
                                            <p><strong>Nom :</strong> <?php echo $current_user->user_lastname; ?></p>
                                            <p><strong>Tel :</strong>
                                                <?php
                                                $user_id = get_current_user_id();
                                                $user_phone = get_the_author_meta('user_phone', $user_id);

                                                if (!empty($user_phone)) {
                                                    echo  esc_html($user_phone);
                                                }
                                                ?>
                                            </p>
                                            <!-- <div class="text-sm leading-normal mt-0 mb-2 text-blueGray-400 font-bold uppercase">
                            <i class="fas fa-map-marker-alt mr-2 text-lg text-blueGray-400"></i>
                            Los Angeles, California
                        </div>
                        <div class="mb-2 text-blueGray-600 mt-10">
                            <i class="fas fa-briefcase mr-2 text-lg text-blueGray-400"></i>
                            Solution Manager - Creative Tim Officer
                        </div>
                        <div class="mb-2 text-blueGray-600">
                            <i class="fas fa-university mr-2 text-lg text-blueGray-400"></i>
                            University of Computer Science
                        </div> -->
                                        </div>
                                        <div class="mt-10 py-10 border-t border-blueGray-200 text-center">
                                            <div class="flex flex-wrap justify-center">
                                                <div class="w-full lg:w-9/12 px-4">
                                                    <p class="mb-4 text-lg leading-relaxed text-blueGray-700">
                                                        <?php
                                                        $user_id = get_current_user_id(); // Obtient l'ID de l'utilisateur connecté
                                                        $user_bio = get_the_author_meta('description', $user_id); // Récupère la biographie par défaut de l'utilisateur

                                                        if (!empty($user_bio)) {
                                                            echo '<p>' . esc_html($user_bio) . '</p>';
                                                        }
                                                        ?>
                                                    </p>
                                                    <!-- <a href="javascript:void(0);" class="font-normal text-pink-500">
                                                        Show more
                                                    </a> -->
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <footer class="relative  pt-8 pb-6 mt-8">
                                <div class="container mx-auto px-4">
                                    <div class="flex flex-wrap items-center md:justify-between justify-center">
                                        <div class="w-full md:w-6/12 px-4 mx-auto text-center">
                                            <?php
                                            $user_id = get_current_user_id(); // Obtient l'ID de l'utilisateur connecté
                                            $edit_profile_url = get_edit_profile_url($user_id); // Obtient l'URL de modification du profil

                                            echo '<a href="' . esc_url($edit_profile_url) . '" class="bg-yellow-400 py-2 px-4 rounded-lg text-xl drop-shadow-sm hover:drop-shadow-md hover:bg-yellow-300">Modifier mon profil</a>';
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </footer>
                        </section>




                    <?php } else { ?>
                        <p>Veuillez vous connecter pour voir vos informations de profil.</p>
                    <?php } ?>

                </div>
            </article>

        <?php endwhile; ?>

    </main>


</div>
<?php get_footer(); ?>