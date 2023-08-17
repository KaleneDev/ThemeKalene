<?php
class BienMetaBox
{
    const META_KEY = "kaleneTheme_bien";
    const NONCE = "_kaleneTheme_kaleneTheme_bien_nonce";

    public static function register()
    {
        add_action("add_meta_boxes", [self::class, "ajouter_metabox_prix"]);
        add_action("save_post", [self::class, "enregistrer_metabox_prix"]);
    }
    public static function ajouter_metabox_prix()
    {
        add_meta_box(
            self::META_KEY,
            "price",
            [self::class, "afficher_metabox_prix"],
            "bien",
            "side",
            "default"
        );
    }
    public static function afficher_metabox_prix($post)
    {
        $prix = get_post_meta($post->ID, self::META_KEY, true);
        wp_nonce_field(self::NONCE, self::NONCE);
?>
        <label for="price">Prix €</label>
        <input type="text" id="price" name="<?php echo self::META_KEY ?>" value="<?php echo $prix?>">
<?php

    }
    // Fonction pour enregistrer la valeur de la metabox de prix
    public static function enregistrer_metabox_prix($post_id)
    {
        if (array_key_exists(self::META_KEY, $_POST) && current_user_can("edit_post", $post_id)) {
            if (wp_verify_nonce($_POST[self::NONCE], self::NONCE)) {
                if (!empty($_POST[self::META_KEY])) {
                    update_post_meta(
                        $post_id,
                        self::META_KEY,
                        $_POST[self::META_KEY]
                    );
                } else {
                    delete_post_meta(
                        $post_id,
                        self::META_KEY
                    );
                    return;
                }
            }
        }
    }
}

?>