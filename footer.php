</div>


<footer>
    <div class="max-w-7xl m-auto">
        <?php wp_nav_menu([
            'theme_location' => 'footer',
            'container' => 'nav',
            'container_class' => 'border-t',
            'container_id' => 'footer-navigation',
            'menu_class' => 'flex flex-wrap justify-center gap-4 text-gray-700 p-4',
            'link_class' => 'hover:text-gray-300',
            'fallback_cb' => false
        ]); ?>

        <?= get_option('agence_horaire') ?>
    </div>
</footer>
<?php wp_footer(); ?>
</body>

</html>