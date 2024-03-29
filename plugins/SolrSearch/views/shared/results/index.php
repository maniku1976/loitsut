<!-- Some English titles and labels displayed in search results replaced with Finnish -->
<?php

/**
* @package     omeka
* @subpackage  solr-search
* @copyright   2012 Rector and Board of Visitors, University of Virginia
* @license     http://www.apache.org/licenses/LICENSE-2.0.html
*/

?>


<?php queue_css_file('results'); ?>
<?php echo head(array('title' => __('Solr search')));?>

<h3><?php echo __('Search Terms'); ?></h3>
<!-- Search form. -->
<div class="solr">
  <form id="solr-search-form">
    <input type="submit" value="<?php echo __('Search'); ?>" />
    <span class="float-wrap">
      <input type="text" title="<?php echo __('Search for keywords') ?>" name="q" value="<?php
      echo array_key_exists('q', $_GET) ? $_GET['q'] : '';
      ?>" placeholder="<?php echo __('Search with keywords');?>"/> <!-- add placeholder in input field -->
    </span>
  </form>
</div>


<!-- Applied facets. -->

<div id="solr-applied-facets">
  <ul>

    <!-- Get the applied facets. -->
    <?php foreach (SolrSearch_Helpers_Facet::parseFacets() as $f): ?>
      <li>
        <!-- Facet label. -->
        <?php $label = SolrSearch_Helpers_Facet::keyToLabel($f[0]); ?>
        <?php $value = $f[1]; ?>
        <!-- Translations for applied facet labels (language files) -->
        <?php switch ($label) {
          case "Type":
          $label = __('Type');
          break;
          case "Language":
          $label = __('Language');
          break;
          case "Spatial Coverage":
          $label = __('Spatial coverage');
          break;
          case "Date":
          $label = __('Date');
          break;
          case "Tag":
          $label = __('Tag');
          break;

        }
        ?>

        <span class="applied-facet-label" style="font-weight:bold;"><?php echo $label." - "; ?></span>
        <!-- Capitalize specific labels in search results view -->
        <?php if ($label == __('Sent from')): ?>
          <span class="applied-facet-value"><?php echo ucfirst($value); ?></span>
        <?php elseif ($label == __('Collection')): ?>
          <span class="applied-facet-value"><?php echo __($value); ?></span>
        <?php else: ?>
          <span class="applied-facet-value"><?php echo $value; ?></span>
        <?php endif; ?>
        <!-- Remove link. -->
        <?php $url = SolrSearch_Helpers_Facet::removeFacet($f[0], $f[1]); ?>
        (<a href="<?php echo $url; ?>"><?php echo __('Remove'); ?></a>)

      </li>
    <?php endforeach; ?>

  </ul>

</div>

<!-- Facets. -->
<div id="solr-facets">

  <h2><?php echo "Rajaa hakua"; ?></h2>
  <?php foreach ($results->facet_counts->facet_fields as $name => $facets): ?>
    <?php $hits = 0; ?>

    <!-- Does the facet have any hits? -->
    <?php if (count(get_object_vars($facets))): ?>

      <!-- Facet label. -->
      <?php $label = SolrSearch_Helpers_Facet::keyToLabel($name);?>

      <!-- Translations for labels in facet list (language files) -->
      <?php switch ($label) {
        case "Title":
        $label = __('Title');
        break;
        case "Type":
        $label = __('Type');
        break;
        case "Language":
        $label = __('Language');
        break;
        case "Spatial Coverage":
        $label = __('Spatial coverage');
        break;
        case "Date":
        $label = __('Date');
        break;
        case "Tag":
        $label = __('Tag');
        break;
      }
      ?>

      <strong><?php echo $label; ?></strong>

      <ul>
        <!-- Facets. -->
        <?php foreach ($facets as $value => $count): ?>

          <li class="<?php echo $value; ?>">

            <!-- Facet URL. -->
            <?php $url = SolrSearch_Helpers_Facet::addFacet($name, $value); ?>

            <!-- Facet link. -->
            <a href="<?php echo $url; ?>" class="facet-value">
              <!-- Capitalize values in specific facets -->
              <?php if ($label == __('Sent from')) {
                $value = ucfirst($value);
              } elseif ($label == __('Collection')) {
                $value = __($value);
              }
              ?>
              <?php echo $value; ?>
            </a>

            <!-- Facet count. -->
            <!--(<span class="facet-count"><?php echo $count; ?></span>)-->

          </li>
        <?php endforeach; ?>
      </ul>

    <?php endif; ?>

  <?php endforeach; ?>
</div>

<!-- Results. -->
<div id="solr-results">
  <p>
    <!-- Number found. -->
    <h2 id="num-found">
      <?php echo "Tuloksia löytyi: "/*.$results->response->numFound*/; ?>
      <span style="display:inline-block;float:right;">
        <form class="txt-solr" method='post' action=''>
          <label for="txt" style="font-size:18px;text-decoration:underline;"><?php echo "Lataa hakutulokset";?></label>
          <input id="txt" type="submit" name="txt" hidden />
        </form>
      </span>
    </h2>
    <!-- empty array for copying results to text file (below) -->
    <?php $all_results = array(); ?>
    <?php foreach ($results->response->docs as $doc): ?>
      <?php $hits = 0; ?>
      <?php foreach($results->highlighting->{$doc->id} as $prop=>$field): ?>
        <?php foreach($field as $hl): ?>
          <?php $hits += 1;?>
        <?php endforeach ?>
      <?php endforeach ?>
      <!-- Document. -->
      <div class="result">
        <!-- Header. -->
        <div class="result-header">

          <!-- Record URL. -->
          <?php $url = SolrSearch_Helpers_View::getDocumentUrl($doc); ?>

          <!-- Title. -->

          <a href="<?php echo $url; ?>" class="result-title"><?php
          $title = is_array($doc->title) ? $doc->title[0] : $doc->title;
          if (empty($title)) {
            $title = '<i>' . __('[Untitled]') . '</i>';
          }

          echo $title;

          ?></a>

          <span><?php echo ': '.$hits; ?></span><a class="resultsBtn">hakutulokset &rarr;</a>
          <!-- Result type. -->
          <!--<span class="result-type">(<?php echo $doc->resulttype; ?>)</span>-->

        </div>

        <!-- empty array for sorting results (below) -->
        <?php $result_fields = array(); ?>

        <!-- empty array for copying all results into text file (below) -->


        <!-- Highlighting. -->
        <?php if (get_option('solr_search_hl')): ?>

          <ul class="hl">
            <!-- Make field labels visible in search results -->
            <!-- Get search result object field labels ($prop) as well as values ($field) to display
            which field a specific result was found in -->
            <?php foreach($results->highlighting->{$doc->id} as $prop=>$field): ?>
              <?php foreach($field as $hl): ?>

                <!-- Replace Solr field codes with proper names -->
                <?php
                switch ($prop) {
                  case "50_t":
                  $prop = __('Title');
                  break;
                  case "51_t":
                  $prop = __('Type');
                  break;
                  case "40_t":
                  $prop = __('Date');
                  break;
                  case "41_t":
                  $prop = __('Description');
                  break;
                  case "42_t":
                  $prop = __('Transkriptio ja kommentaarit');
                  break;
                  case "65_t":
                  $prop = __('Transkriptio ja kommentaarit');
                  break;
                  case "81_t":
                  $prop = __('Spatial coverage');
                  break;
                  case "simple_pages_text_t":
                  $prop = 'Tietosivut';
                  break;
                }
                ?>
                <!-- Push into sorting array -->
                <?php
                $entry = new stdClass;
                $entry->title = $prop;
                $entry->field = $hl;
                array_push($result_fields, $entry);
                ?>

              <?php endforeach; ?>
            <?php endforeach; ?>

            <!-- Move 'Kommentaarit' and 'Tietosivut' results to the end -->
            <?php foreach ($result_fields as $rs => $value) {
              if ($value->title == 'Kommentaarit') {
                $item = $result_fields[$rs];
                unset($result_fields[$rs]);
                array_push($result_fields, $item);
              }
            }
            ?>
            <?php foreach ($result_fields as $rs => $value) {
              if ($value->title == 'Tietosivut') {
                $item = $result_fields[$rs];
                unset($result_fields[$rs]);
                array_push($result_fields, $item);
              }
            }
            ?>
            <!-- print sorted results -->
            <?php
            foreach ($result_fields as $rs) {
              echo '<li class="snippet"><b>'.$rs->title.'</b>: '.strip_tags($rs->field, '<em>').'</li>';
            }
            ?>
          </ul>

        <?php endif; ?>
        <?php
        $item = get_db()->getTable($doc->model)->find($doc->modelid);

        /*echo item_image_gallery(
          array('wrapper' => array('class' => 'gallery')),
          'square_thumbnail',
          false,
          $item
        );*/

        ?>

      </div>
      <!-- push each item title and results into $all_results -->
      <?php
        $results_entry = new stdClass;
        $results_entry->title = $title;
        $results_entry->results = $result_fields;
        array_push($all_results, $results_entry);
       ?>

    <?php endforeach; ?>

    <!-- Download results as text file -->
    <?php
    // regexes to remove tags
    if (isset($_POST['txt'])) {
      // Initialize txt file for writing
      $txtfile = 'results.txt';
      $fh = fopen($txtfile, 'w');

      // Write search terms and search results into text files
      fwrite($fh,strtoupper("Hakutermit: ".$results->responseHeader->params->q)."\n\n");
      foreach ($all_results as $result) {
        fwrite($fh,strtoupper($result->title)."\n\n");
        foreach ($result->results as $rs) {
          $result = strip_tags(html_entity_decode($rs->field));
          $result = str_replace('="blue">','',$result);
          $result = str_replace('="red">','',$result);
          $result = str_replace('">','',$result);
          $result = str_replace('>','',$result);
          $result = str_replace('="popup"','',$result);
          $result = str_replace($results->responseHeader->params->q, '--'.strtoupper($results->responseHeader->params->q).'--',$result);
          $result = preg_replace('/\h+/',' ',$result);
          fwrite($fh,"---".strtoupper($rs->title).': '.$result."\n\n");
        }
        fwrite($fh,"\n\n");
      }

      fclose($fh);

      // Force Download
      header("Content-Type: text/plain; charset=utf-8");
      header("Content-Disposition: attachment; filename=".sys_get_temp_dir().'/'.$txtfile);
      ob_clean();
      flush();
      readfile($txtfile);
      unlink($txtfile);
      exit();
    }

    //print_r($results->responseHeader->params->q);

    ?>
    <?php echo pagination_links(); ?>
  </div>



  <?php echo foot();
