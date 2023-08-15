<?php

$count = absint(get_comments_number());
?>

<?php if ($count > 0) : ?>
    <h2><?= sprintf(_n('%s Commantaire', '%s Commantaires', $count, 'kaleneTheme'), $count) ?></h2>
<?php else : ?>
    <h2>Laisser un commentaire</h2>
<?php endif; ?>

<?php if (comments_open()) : ?>
    <?php comment_form(['title_reply' => '']); ?>
<?php else : ?>
    <p>Les commentaires sont fermés</p>
<?php endif; ?>

<?php

wp_list_comments(
    ['style' => 'div', 'reverse_top_level' => true]
);
?>
<div>
    <?php
    paginate_comments_links();
    ?>
</div>