<?php
global $categories;
$current_cat = get_category(get_query_var('cat'));
$current_cat_id = $current_cat->cat_ID;
$parents = get_ancestors($current_cat->cat_ID, 'category');
$subcategories = getSubCategories($parents[0]);
?>

<aside class="sidebar">
    <h3 class="sidebar__header">Категории</h3>
    <ul class="sidebar__menu">
        <?php if (count($parents) > 0): ?>
            <?php foreach ($subcategories as $subcategory): ?>
                <li>
                    <a
                        class="<?php echo ($current_cat->name == $subcategory->name) ? 'active' : ''; ?>"
                        href="<?php bloginfo('url') ?>/categories/<?= $subcategory->slug ?>">
                        <?= $subcategory->name ?>
                    </a>
                </li>
            <?php endforeach; ?>
        <?php else: ?>
            <?php foreach ($categories as $category): ?>
                <li>
                    <a
                        class="<?php echo ($current_cat->name == $category->name) ? 'active' : ''; ?>"
                        href="<?php bloginfo('url') ?>/categories/<?= $category->slug ?>">
                        <?= $category->name ?>
                    </a>
                </li>
            <?php endforeach; ?>
        <?php endif; ?>
    </ul>
</aside>