<?php
class SponsoMetaBox
{
    const META_KEY = 'kaleneTheme_sponso';
    const NONCE = '_kaleneTheme_sponso_nonce';

    public static function register()
    {
        add_action('add_meta_boxes', [self::class, 'add'], 10, 2);
        add_action('save_post', [self::class, 'save']);
    }
    public static function add($postType, $post)
    {
        if ($postType === 'post' && current_user_can('publish_posts', $post)) {
            add_meta_box(
                self::META_KEY,
                'Sponsoring',
                [self::class, 'render'],
                'post',
                'side'
            );
        }
    }
    public static function render($post)
    {
        $isSponsored = get_post_meta($post->ID, self::META_KEY, true);
        wp_nonce_field(self::NONCE, self::NONCE);
?>

        
        <div class="meta-container">
            <div>
                <input type="hidden" name="<?= self::META_KEY ?>" value="">
                <input type="checkbox" name="<?= self::META_KEY ?>" value="1" <?php checked($isSponsored, 1); ?>>

                <label for="kaleneThemesponso">Cet article est un sponsorisé ?</label>
            </div>
        </div>
<?php
    }

    public static function save(int $post_id)
    {
        if (
            !array_key_exists(self::NONCE, $_POST) ||
            !wp_verify_nonce($_POST[self::NONCE], self::NONCE)
        ) {
            return;
        }
        if (array_key_exists(self::META_KEY, $_POST) && current_user_can('publish_posts', $post_id)) {
            if ($_POST[self::META_KEY] === 0) {
                delete_post_meta($post_id, self::META_KEY);
                return;
            } else {
                update_post_meta(
                    $post_id,
                    self::META_KEY,
                    $_POST[self::META_KEY]
                );
            }
        }
    }
}
