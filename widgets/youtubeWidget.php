<?php
class YoutubeWidget extends WP_Widget
{
    public function __construct()
    {
        parent::__construct('youtube_widget', 'Youtube Widget');
    }
    public function widget($args, $instance)
    {
        $title = $instance['title'] ?? '';
        $url = isset($instance['youtube']) ? $instance['youtube'] : '';
        $url_components = parse_url($url);
        parse_str($url_components['query'], $params);
        // $url = $params['v'];

        echo $args['before_widget'];
        if (!empty($title)) {
            $title = apply_filters('widget_title', $title);
            echo $args['before_title'] . $title . $args['after_title'];
        }
        echo '<div class="p-4">';
        if (isset($params['v'])) {
            $video_code = $params['v'];
            echo '<iframe width="' . 560 / 1.5 . '" height="' . 315 / 1.5 . '" src="https://www.youtube.com/embed/' . $video_code . '" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>';
        } else {
            echo "Code vidéo non trouvé dans l'URL";
        }




        echo '</div>';
        echo $args['after_widget'];
    }
    public function form($instance)
    {
        $title = $instance['title'] ?? '';
        $youtube = $instance['youtube'] ?? '';
?>
        <p>
            <label for="<?= $this->get_field_id('title') ?>">Titre</label>
            <input type="text" name="<?= $this->get_field_name('title') ?>" value="<?= esc_attr($title) ?>" id="<?= $this->get_field_name('title') ?>">
        </p>

        <p>
            <label for="<?= $this->get_field_id('youtube') ?>">Id video</label>
            <input type="text" name="<?= $this->get_field_name('youtube') ?>" value="<?= esc_attr($youtube) ?>" id="<?= $this->get_field_name('youtube') ?>">
        </p>
<?php

    }
    public function update($newInstance, $oldInstance)
    {
        $instance = [];
        $instance['title'] = strip_tags($newInstance['title']);
        $instance['youtube'] = strip_tags($newInstance['youtube']);
        return $instance;
    }
}
