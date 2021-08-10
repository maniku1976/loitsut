
<div class="item record" style="display:inline;">
    <?php
    $title = metadata($item, 'display_title');
    $description = metadata($item, array('Dublin Core', 'Description'), array('snippet' => 150));
    ?>
    <ul>
    <li>
    <?php if (metadata($item, 'has files')) {
        echo link_to_item(
            item_image(null, array(), 0, $item),
            array('class' => 'image'), 'show', $item
        );
    }

    ?>
    </li>
    <li>
        <h5><?php echo link_to($item, 'show', $title); ?></h5>
    </li>
    <li class="item-description"><?php echo $description; ?></li>
</div>

