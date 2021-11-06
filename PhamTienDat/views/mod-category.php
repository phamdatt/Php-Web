<?php
$category = loadModel('category');
$list_category1 = $category->category_list(['parentid' => 0, 'status' => 1, 'order' => ['orders', 'ASC']]);
?>
<div class="mod-category">
    <div class="mod-category-body">
        <ul class='nav__list'>
            <?php foreach ($list_category1 as $row_cat1) : ?>
                <?php
                $list_category2 = $category->category_list(['parentid' => $row_cat1['id'], 'status' => 1]);
                ?>
                <li class='nav__menu'><a href="index.php?option=product&cat=<?php echo $row_cat1['slug']; ?>"><?php echo $row_cat1['name']; ?></a>
                    <?php if (count($list_category2) > 0) : ?>
                        <ul class='nav__menu-lists nav__menu--1-lists'>
                            <?php foreach ($list_category2 as $row_cat2) : ?>
                                <li class='nav__menu-items'><a href="index.php?option=product&cat=<?php echo $row_cat2['slug']; ?>"><?php echo $row_cat2['name']; ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>