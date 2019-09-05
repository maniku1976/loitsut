<?php echo head(array('title' => metadata('item', array('Dublin Core', 'Title')),'bodyclass' => 'item show')); ?>

<h4 id="show_title"><?php echo metadata('item', array('Dublin Core', 'Title')); ?></h4>

<?php echo metadata('item', array('Dublin Core', 'Description')); ?>

<!-- Display images, transcription -->
<div class="container-fluid" id="show_container">
  <div class="row" id="show_row_1">
    <div class="col-sm-5">
    </div>
    <?php if (metadata('item', array('Dublin Core', 'Type')) == 'loitsu'): ?>
    <div class="col-sm-3">
    </div>
    <div class="col-sm-4">
      <nav id="pic_nav1" class="navbar navbar-expand-md">
      <ul class="navbar-nav">
          <?php $url1 = metadata('item', array('Dublin Core','Relation'), 0); ?>
          <?php $url2 = metadata('item', array('Dublin Core','Relation'), 1); ?>
          <!--<li id="pic_nav2" class="nav-item">
            <input type="radio" title="Näytä loitsu" name="choice" selected/> 
            <a>Loitsu</a>
          </li>-->
          <li id="pic_nav3" class="nav-item">        
            <a class="nav-link" title="Näytä koko pöytäkirja" name="choice" href="<?php echo $url2;?>" target="_blank">
              Koko pöytäkirja <i class="fas fa-arrow-right"></i>
            </a>
          </li>
        </ul>
      </nav>
    </div>
    <?php else: ?>
    <div class="col-sm-4">
        <span id="pic_nav4" class="nav-item">
          <a id="prevPic" class="nav-link" title="edellinen sivu"><i class="fas fa-arrow-left"></i></a>
          <a id="nextPic" class="nav-link" title="seuraava sivu"><i class="fas fa-arrow-right"></i></a>
        </span>
    </div>
    <div class="col-sm-3">
      <nav id="pic_nav1" class="navbar navbar-expand-md">
        <ul class="navbar-nav">
          <li id="pic_nav3" class="nav-item"><span style="font-size:14px;font-weight:800;">Pöytäkirja</span></li>
        </ul>
      </nav>
    </div>
    <?php endif;?>
  </div>
  <div class="row" id="show_row_2">
    <div class="col-sm-5" id="show_col_1">
      <div id="pics">
      <?php
      // Fetch each item's images
      $files = $item->Files;
      foreach ($files as $file) {
        if ($file->getExtension() == 'jpg' || $file->getExtension() == 'JPG') {
          echo '<img class="pic" src="http://loitsut.finlit.fi/files/original/'.metadata($file, 'filename').'" />';
        }
      }
      ?>
      </div>
      <div id="metadata">
        <p><a id="metadata-link">m<br>e<br>t<br>a<br>t<br>i<br>e<br>d<br>o<br>t</a></p>
      </div>
      <div id="metadata-content" title="vieritä alaspain hiiren pyörällä"><?php echo all_element_texts('item'); ?></div>
    </div>
    <?php if (metadata('item', array('Dublin Core', 'Type')) != 'loitsu'): ?>
    <div class="col-sm-4" id="show_col_2">
      <?php
      // Fetch each item's XML file and convert to XHTML using DOMDocument()
      $files = $item->Files;
      foreach ($files as $file) {
        if ($file->getExtension() == 'xml') {
          $xmlDoc = new DOMDocument();
          $xmlDoc->load("http://loitsut.finlit.fi/files/original/".metadata($file, 'filename'));
          $xslDoc = new DOMDocument();
          $xslDoc->load("http://loitsut.finlit.fi/files/TEI-to-HTML.xsl");
          $proc = new XSLTProcessor();
          $proc->importStylesheet($xslDoc);
          echo $proc->transformToXML($xmlDoc);
        }
      }
      ?>
    </div>
    <div id="show_col_3" class="col-sm-3">
    </div>
    <?php else:?>
    <div class="col-sm-3" id="show_col_2">
      <?php
      // Fetch each item's XML file and convert to XHTML using DOMDocument()
      $files = $item->Files;
      foreach ($files as $file) {
        if ($file->getExtension() == 'xml') {
          $xmlDoc = new DOMDocument();
          $xmlDoc->load("http://loitsut.finlit.fi/files/original/".metadata($file, 'filename'));
          $xslDoc = new DOMDocument();
          $xslDoc->load("http://loitsut.finlit.fi/files/TEI-to-HTML.xsl");
          $proc = new XSLTProcessor();
          $proc->importStylesheet($xslDoc);
          echo $proc->transformToXML($xmlDoc);
        }
      }
      ?>
    </div>
    <div id="show_col_3" class="col-sm-4">
    <?php endif;?>
  </div>
</div>



<nav>
<ul class="item-pagination navigation">
    <li id="previous-item" class="previous"><?php echo link_to_previous_item_show(); ?></li>
    <li id="next-item" class="next"><?php echo link_to_next_item_show(); ?></li>
</ul>
</nav>

<?php echo foot(); ?>
