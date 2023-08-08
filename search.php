<?php get_header() ?>
<form action="">
    <div>
        <label class="relative block">
            Article sponsorisé
            <input class="" type="checkbox" value="1" name="sponso" <?= checked('1', get_query_var('sponso')) ?>>
            <span class="sr-only">Search</span>
            <span class="absolute inset-y-0 left-0 flex items-center pl-2">
                <svg class="h-5 w-5 fill-slate-300" viewBox="0 0 20 20"><!-- ... --></svg>
            </span>
            <input type="search" class="placeholder:italic placeholder:text-slate-400 block bg-white w-full border border-slate-300 rounded-md py-2 pl-9 pr-3 shadow-sm focus:outline-none focus:border-sky-500 focus:ring-sky-500 focus:ring-1 sm:text-sm" placeholder="Search for anything..." type="text" name="s" value="<?= get_search_query() ?>" />
        </label>
    </div>

</form>



<div class="flex flex-col gap-12 p-4">
    <?php if (have_posts()) : ?>
        <h1 class="text-4xl">Résultat pour votre recherche "<?= get_search_query() ?>"</h1>
        <?php while (have_posts()) : the_post(); ?>
            <?php get_template_part('template-parts/post-card', 'post'); ?>
        <?php endwhile; ?>
        <?php kaleneTheme_posts_pagination(); ?>
    <?php else : ?>
        <h1>Pas d'article</h1>
    <?php endif; ?>
</div>
<?php get_footer() ?>