<?php
class AgenceMenuPage
{
    const GROUP = 'agence_options';
    public static function register()
    {
        add_action('admin_menu', [self::class, 'addMenu']);
        add_action('admin_init', [self::class, 'registerSettings']);
        add_action('admin_enqueue_scripts', [self::class, 'registerAssets']);
    }
    public static function registerAssets($suffix)
    {
        if ($suffix === 'settings_page_agence') {
            wp_register_script('flatpickr', 'https://cdn.jsdelivr.net/npm/flatpickr', [], false, true);
            wp_register_style('flatpickr', 'https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css', [], false);

            wp_enqueue_script('agence-admin', get_template_directory_uri() . '/assets/agence-admin.js', ['flatpickr'], false, true);
            wp_enqueue_style('flatpickr');
        }
    }
    public static function registerSettings()
    {
        register_setting(self::GROUP, 'agence_horaire');
        register_setting(self::GROUP, 'agence_date');

        register_setting(self::GROUP, 'agence_telephone');
        register_setting(self::GROUP, 'agence_email');
        register_setting(self::GROUP, 'agence_adresse');

        add_settings_section(
            'agence_section',
            'Paramètres',
            function () {
                echo "Vous pouvez ici gérer les paramètres de l'agence";
            },
            self::GROUP
        );
        add_settings_field(
            'agence_horaire',
            'Horaires',
            function () {
?>
            <textarea name="agence_horaire" id="agence_horaire" cols="30" rows="10" class="large-text code">
                    <?php echo esc_html(get_option('agence_horaire'));
                    ?>
                </textarea>
        <?php
            },
            self::GROUP,
            'agence_section'
        );
        add_settings_field(
            'agence_date',
            'Date ouverture',
            function () {
        ?>
            <input name="agence_date" id="agence_date" class="kaleneTheme_datpicker">
            <?php echo esc_html(get_option('agence_date'));
            ?>
        <?php
            },
            self::GROUP,
            'agence_section'
        );
    }

    public static function addMenu()
    {
        add_options_page(
            "Gestion de l'agence",
            'Agence',
            "manage_options",
            "agence",
            [self::class, 'render'],
        );
    }
    public static function render()
    {
        ?>
        <h1>Gestion de l'agence</h1>

        <form action="options.php" method="post">
            <?php
            settings_fields(self::GROUP);
            do_settings_sections(self::GROUP);
            submit_button();
            ?>
        </form>

<?php
    }
}
