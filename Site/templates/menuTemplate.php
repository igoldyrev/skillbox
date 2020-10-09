<ul class="main-menu <?=$ulClass ?>"><?php
    foreach ($arr as $items) {

        $activeClass = isCurrentUrl($items['path']) ? 'main-menu__active' : ''; ?>

        <li><a class="main-menu__link <?=$styleClass . ' ' . $activeClass ?>" href=<?=$items['path']; ?>><?=cutString($items['title']); ?></a></li><?php
    } ?>

</ul>