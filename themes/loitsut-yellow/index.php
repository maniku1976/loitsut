<?php echo head(array('bodyid'=>'home', 'bodyclass' =>'two-col')); ?>
<div id="primary">
    <p><img src="themes/loitsut-yellow/images/PAAKUVA@2x.png" /></p>
    <?php if ($homepageText = get_theme_option('Homepage Text')): ?>
    <p><?php echo $homepageText; ?></p>
    <?php endif; ?>
    <?php 
    $tags = get_records('Tag', array(), 0);
    echo tag_cloud($tags, $link = '/items/browse');?>
</div><!-- end primary -->
<div>
</div>
<div id="secondary">

    <?php
    $recentItems = get_theme_option('Homepage Recent Items');
    if ($recentItems === null || $recentItems === ''):
        $recentItems = 3;
    else:
        $recentItems = (int) $recentItems;
    endif;
    if ($recentItems):
    ?>
    <div id="recent-items">
        <h2>Poimintoja</h2>
        <?php echo recent_items($recentItems); ?>
    </div><!--end recent-items -->
    <?php endif; ?>

    <?php fire_plugin_hook('public_home', array('view' => $this)); ?>

</div><!-- end secondary -->

<?php echo foot(); ?>
