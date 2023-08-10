<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php wp_head(); ?>
</head>

<body>

    <nav class="border-b">
        <div class="mx-auto max-w-7xl px-2 sm:px-6 lg:px-8">
            <div class="relative flex h-16 items-center justify-between">
                <div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
                    <!-- Mobile menu button-->
                    <button type="button" class="relative inline-flex items-center justify-center rounded-md p-2 text-gray-400 hover:bg-gray-700 hover:text-white focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white" aria-controls="mobile-menu" aria-expanded="false">
                        <span class="absolute -inset-0.5"></span>
                        <span class="sr-only">Open main menu</span>
                        <!--
            Icon when menu is closed.

            Menu open: "hidden", Menu closed: "block"
          -->
                        <svg class="block h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                        </svg>
                        <!--
            Icon when menu is open.

            Menu open: "block", Menu closed: "hidden"
          -->
                        <svg class="hidden h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <div class="flex flex-1 items-center justify-center sm:items-stretch sm:justify-start">
                    <div class="flex flex-shrink-0 items-center">
                        <img class="h-8 w-auto" src="https://tailwindui.com/img/logos/mark.svg?color=blue&shade=300" alt="Your Company">
                    </div>
                    <div class="hidden sm:ml-6 sm:flex m-auto justify-between w-full">
                        <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
                        <?php
                        wp_nav_menu(
                            array(
                                'theme_location' => 'header',
                                'container' => false,
                                'menu_class' => 'flex space-x-1 items-center',
                                'link_before' => '<span class="text-gray-700 hover:bg-gray-700 hover:text-white rounded-md md:px-3 py-2 text-sm font-medium">',
                            )
                        );
                        ?>
                        <?= get_search_form(); ?>
                    </div>
                </div>

                <div class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto lg:ml-6 sm:pr-0">
                    <div class="relative ml-3">
                        <?php if (is_user_logged_in()) : ?>
                            <div>
                                <button type="button" class="relative flex rounded-full bg-gray-800 text-sm focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800" id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                                    <span class="absolute -inset-1.5"></span>
                                    <span class="sr-only">Open user menu</span>
                                    <?php $current_user_avatar_url = get_avatar_url(get_current_user_id(), array('size' => 96));
                                    ?>
                                    <img class="h-8 w-8 rounded-full" src="<?php echo $current_user_avatar_url; ?>" alt="">
                                </button>
                            </div>
                            <div class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none transform opacity-0 scale-95" role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">
                                <!-- Active: "bg-gray-100", Not Active: "" -->
                                <a href="<?= home_url('/profile/') ?>" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="user-menu-item-0">Votre Profil</a>
                                <a href="#" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="user-menu-item-1">Paramètres</a>
                                <a href="<?= wp_logout_url() ?>" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="user-menu-item-2">Se déconnecter</a>

                            </div>
                        <?php else : ?>
                            <a href="<?= wp_login_url() ?>" class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium">Se connecter</a>
                            <a href="<?= wp_registration_url() ?>" class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium">S'inscrire</a>

                        <?php endif; ?>

                    </div>
                </div>

            </div>
        </div>

        <!-- Mobile menu, show/hide based on menu state. -->
        <div class="sm:hidden hidden" id="mobile-menu">

            <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
            <!-- <a href="#" class="bg-gray-900 text-white block rounded-md px-3 py-2 text-base font-medium" aria-current="page">Dashboard</a> -->
            <?php
            wp_nav_menu(
                array(
                    'theme_location' => 'header',
                    'container' => false,
                    'menu_class' => 'space-y-1 px-2 pb-3 pt-2',
                    'link_before' => '<span class="text-gray-300 hover:bg-gray-700 hover:text-white block rounded-md px-3 py-2 text-base font-medium">',
                )
            );
            ?>
            <div class="p-4">
                <?= get_search_form(); ?>
            </div>
        </div>
    </nav>
    <script>
        // Récupérer les éléments du menu et du menu mobile
        const menuButton = document.querySelector('[aria-controls="mobile-menu"]');
        const mobileMenu = document.getElementById('mobile-menu');
        const userMenuButton = document.getElementById('user-menu-button');
        const userMenu = document.querySelector('[aria-labelledby="user-menu-button"]');

        // Fonction pour ouvrir le menu mobile
        function openMobileMenu() {
            mobileMenu.classList.remove('hidden');
        }

        // Fonction pour fermer le menu mobile
        function closeMobileMenu() {
            mobileMenu.classList.add('hidden');
        }

        // Écouteur d'événement pour le bouton de menu mobile
        menuButton.addEventListener('click', () => {
            // Vérifier si le menu mobile est actuellement ouvert ou fermé
            const isMobileMenuOpen = !mobileMenu.classList.contains('hidden');
            if (isMobileMenuOpen) {
                // Si le menu mobile est ouvert, le fermer lors du clic sur le bouton
                closeMobileMenu();
            } else {
                // Si le menu mobile est fermé, l'ouvrir lors du clic sur le bouton
                openMobileMenu();
            }
        });

        // Fonction pour ouvrir le menu de profil
        function openUserMenu() {
            userMenu.classList.add('transition', 'ease-out', 'duration-100', 'opacity-100', 'scale-100');
            userMenu.classList.remove('ease-in', 'duration-75', 'opacity-0', 'scale-95');
        }

        // Fonction pour fermer le menu de profil
        function closeUserMenu() {
            userMenu.classList.add('transition', 'ease-in', 'duration-75', 'opacity-0', 'scale-95');
            userMenu.classList.remove('ease-out', 'duration-100', 'opacity-100', 'scale-100');
        }

        // Écouteur d'événement pour le bouton de menu de profil
        userMenuButton.addEventListener('click', (event) => {
            // Vérifier si le menu de profil est actuellement ouvert ou fermé
            const isUserMenuOpen = !userMenu.classList.contains('opacity-0');
            event.preventDefault();
            event.stopPropagation();
            if (isUserMenuOpen) {

                // Si le menu de profil est ouvert, le fermer lors du clic sur le bouton
                closeUserMenu();
            } else {
                // Si le menu de profil est fermé, l'ouvrir lors du clic sur le bouton
                openUserMenu();
            }
        });

        // Écouteur d'événement pour fermer le menu de profil lorsque l'utilisateur clique en dehors du menu
        document.addEventListener('click', (event) => {
            // Vérifier si l'élément cliqué se trouve à l'intérieur du menu de profil
            const isClickedInsideUserMenu = userMenu.contains(event.target);
            // Vérifier si le menu de profil est actuellement ouvert et que l'élément cliqué est en dehors du menu
            if (!isClickedInsideUserMenu && isUserMenuOpen) {
                // Fermer le menu de profil lorsque l'utilisateur clique en dehors de celui-ci
                closeUserMenu();
            }
        });
    </script>


    <div class="max-w-7xl m-auto mt-2 mb-12">