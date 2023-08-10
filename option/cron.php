<?php
add_action('kaleneTheme_import_content', function () {
    touch(__DIR__ . '/demo-' . time() . '.txt');
});
add_filter('cron_schedules', function ($schedules) {
    $schedules['hourly'] = [
        'interval' => 3600,
        'display' => __('Une heure')
    ];
    return $schedules;
});

if (!wp_next_scheduled('kaleneTheme_import_content')) {
    wp_schedule_event(time(), 'hourly', 'kaleneTheme_import_content');
};
