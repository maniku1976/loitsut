<?php
$pageTitle = __('Browse Collections');
echo head(array('title'=>$pageTitle,'bodyclass' => 'collections browse'));
?>




<div class="content-fluid" style="margin-top:2em;">
  <div class="row">
    <!-- list collections in menu to the left -->
    <div class="col-2">
      <ul id="runot-nav" class="navbar-nav">
        <?php $collections = get_records('Collection',array('sort_field'=>'Dublin Core,Identifier','sort_dir'=>'a')); ?>
        <?php set_loop_records('collections',$collections);?>
        <?php foreach (loop('collections') as $collection): ?>
          <?php $collId = metadata($collection, array('Dublin Core', 'Identifier')); ?>
          <?php if (strpos($collId, 'coll') !== false):?>
            <li class="nav-item"><a class="nav-link"><?php echo metadata('collection', array('Dublin Core', 'Title')) ;?></a></li>
          <?php endif;?>
        <?php endforeach; ?>
      </ul>
    </div>
    <!-- list items for each collection -->
    <div class="col-10" id="poems">
      <?php foreach (loop('collections') as $collection): ?>

        <?php $collId = metadata('collection', array('Dublin Core', 'Identifier')); ?>
        <?php if (strpos($collId, 'coll') !== false):?>

          <ul id="<?php echo $collId;?>" class="navbar-nav">
            <?php echo metadata($collection,array('Dublin Core', 'Description'));?>
            <?php $items = get_records('Item', array('collection'=>$collection)); ?>
            <?php set_loop_records('items',$items); ?>
            <?php foreach(loop('items') as $item): ?>
              <?php if ($item->id != '6'):?> 
              <li class="nav-item">
                <?php $itemTitle = metadata($item, 'display_title'); ?>
                <span><?php echo link_to_item(item_image('square_thumbnail', array('alt' => $itemTitle))); ?></span>
                <span>
                  <span style="width:100%;"><?php echo link_to_item($itemTitle, array('class'=>'permalink')); ?></span>
                  <span style="width:100%"><?php echo metadata($item, array('Dublin Core', 'Description')); ?></span>
                </span>
              </li>
              <?php endif ?>
            <?php endforeach; ?>
          </ul>
        <?php endif;?>
      <?php endforeach; ?>

    </div>
  </div>
</div>




<?php echo pagination_links(); ?>

<?php fire_plugin_hook('public_collections_browse', array('collections'=>$collections, 'view' => $this)); ?>

<?php echo foot(); ?>



<!--<h1><?php echo $pageTitle; ?> <?php echo __('(%s total)', $total_results); ?></h1>
<?php echo pagination_links(); ?>

<?php
$sortLinks[__('Title')] = 'Dublin Core,Title';
$sortLinks[__('Date Added')] = 'added';
?>-->

<!--<div id="sort-links">
<span class="sort-label"><?php echo __('Sort by: '); ?></span><?php echo browse_sort_links($sortLinks); ?>
</div>-->

<!--<div class="collection">

<h2><?php echo link_to_collection(); ?></h2>
<?php if ($collectionImage = record_image('collection')): ?>
<?php echo link_to_collection($collectionImage, array('class' => 'image')); ?>
<?php endif; ?>

<?php if (metadata('collection', array('Dublin Core', 'Description'))): ?>
<div class="collection-description">
<?php echo text_to_paragraphs(metadata('collection', array('Dublin Core', 'Description'), array('snippet'=>150))); ?>
</div>
<?php endif; ?>

<?php if ($collection->hasContributor()): ?>
<div class="collection-contributors">
<p>
<strong><?php echo __('Contributors'); ?>:</strong>
<?php echo metadata('collection', array('Dublin Core', 'Contributor'), array('all'=>true, 'delimiter'=>', ')); ?>
</p>
</div>
<?php endif; ?>

<p class="view-items-link"><?php echo link_to_items_browse(__('View the items in %s', metadata('collection', array('Dublin Core', 'Title'))), array('collection' => metadata('collection', 'id'))); ?></p>

<?php fire_plugin_hook('public_collections_browse_each', array('view' => $this, 'collection' => $collection)); ?>

</div><!-- end class="collection" -->
