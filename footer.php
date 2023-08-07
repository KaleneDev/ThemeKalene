</div>


<footer>
    <?php wp_nav_menu([
        'theme_location' => 'footer',
        'container' => 'nav',
        'container_class' => 'bg-gray-800',
        'container_id' => 'footer-navigation',
        'menu_class' => 'flex flex-wrap justify-center gap-4 text-white p-4',
        'link_class' => 'hover:text-gray-300',
        'fallback_cb' => false
    ]); ?>
    <?php wp_footer(); ?>

</footer>
</body>

</html>