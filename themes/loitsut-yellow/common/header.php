<!DOCTYPE html>
<html lang="<?php echo get_html_lang(); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php if ( $description = option('description')): ?>
    <meta name="description" content="<?php echo $description; ?>" />
    <?php endif; ?>
    <?php
    if (isset($title)) {
        $titleParts[] = strip_formatting($title);
    }
    $titleParts[] = option('site_title');
    ?>
    <title><?php echo implode(' &middot; ', $titleParts); ?></title>

    <?php echo auto_discovery_link_tags(); ?>

    <!-- Plugin Stuff -->

    <?php fire_plugin_hook('public_head', array('view'=>$this)); ?>


    <!-- Stylesheets -->
    <?php
    queue_css_file(array('iconfonts','style','bootstrap.min','all'));
    queue_css_url('//fonts.googleapis.com/css?family=Overpass');
    queue_css_url('//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css');
    echo head_css();

    echo theme_header_background();
    ?>

    <?php
    ($backgroundColor = get_theme_option('background_color')) || ($backgroundColor = "#FFFFFF");
    ($textColor = get_theme_option('text_color')) || ($textColor = "#444444");
    ($linkColor = get_theme_option('link_color')) || ($linkColor = "#888888");
    ($buttonColor = get_theme_option('button_color')) || ($buttonColor = "#000000");
    ($buttonTextColor = get_theme_option('button_text_color')) || ($buttonTextColor = "#FFFFFF");
    ($titleColor = get_theme_option('header_title_color')) || ($titleColor = "#000000");
    ?>
    <style>
        body {
            background-color: <?php echo $backgroundColor; ?>;
            color: <?php echo $textColor; ?>;
        }
        #site-title a:link, #site-title a:visited,
        #site-title a:active, #site-title a:hover {
            color: <?php echo $titleColor; ?>;
            <?php if (get_theme_option('header_background')): ?>
            text-shadow: 0px 0px 20px #000;
            <?php endif; ?>
        }
        a:link {
            color: <?php echo $linkColor; ?>;
        }
        a:visited {
            color: <?php echo thanksroy_brighten($linkColor, 40); ?>;
        }
        a:hover, a:active, a:focus {
            color: <?php echo thanksroy_brighten($linkColor, -40); ?>;
        }

        .button, button,
        input[type="reset"],
        input[type="submit"],
        input[type="button"],
        .pagination_next a,
        .pagination_previous a {
          background-color: <?php echo $buttonColor; ?>;
          color: <?php echo $buttonTextColor; ?> !important;
        }

        #search-form input[type="text"] {
            border-color: <?php echo $buttonColor; ?>
        }

        @media (max-width:768px) {
            #primary-nav li {
                background-color: <?php echo thanksroy_brighten($buttonColor, 40); ?>;
            }

            #primary-nav li ul li {
                background-color: <?php echo thanksroy_brighten($buttonColor, 20); ?>;
            }

            #primary-nav li li li {
                background-color: <?php echo thanksroy_brighten($buttonColor, -20); ?>;
            }
        }
    </style>
    <!-- JavaScripts -->
    <?php
    queue_js_file('jquery-1.12.4.min');
    queue_js_file('bootstrap.bundle.min');
    queue_js_file('vendor/modernizr');
    queue_js_file('vendor/selectivizr', 'javascripts', array('conditional' => '(gte IE 6)&(lte IE 8)'));
    queue_js_file('vendor/respond');
    queue_js_file('vendor/jquery-accessibleMegaMenu');
    queue_js_file('globals');
    queue_js_file('default');
    queue_js_file('all');
    queue_js_file('wheelzoom');
    queue_js_file('skvr');
    queue_js_file('imageviewer');
    queue_js_file('linkactions');
    queue_js_file('pagination');
    queue_js_url('//code.jquery.com/ui/1.12.1/jquery-ui.js');
    echo head_js();
    ?>
</head>
<?php echo body_tag(array('id' => @$bodyid, 'class' => @$bodyclass)); ?>
    <a href="#content" id="skipnav"><?php echo __('Skip to main content'); ?></a>
    <?php fire_plugin_hook('public_body', array('view'=>$this)); ?>

        <header role="banner">
            <?php fire_plugin_hook('public_header', array('view'=>$this)); ?>
            <div id="site-title">
              <?php echo '<span>Uuden ajan alun</span>'.link_to_home_page(); ?>
              <img src="http://kalevala-dev.ngrok.io/loitsut/SKS-logo@2x.png" />
            </div>
            <div>
            <nav class="navbar navbar-expand-md">
              <ul class="navbar-nav">
                 <li class="nav-item">
                   <a class="nav-link" href="/loitsut">Etusivu</a>
                 </li>
                 <li class="nav-item">
                   <a class="nav-link" href="/loitsut/esittely">Esittely</a>
                 </li>
                 <li class="nav-item" id ="spells">
                  <a class="nav-link" href="/loitsut/items/browse">Loitsut</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="/loitsut/ohjeet">Ohjeet</a>
                </li>
              </ul>
            </nav>
            <nav class="navbar navbar-expand-md">
              <ul class="navbar-nav">
                <li class="nav-item" id="solr_box">
                  <?php echo search_form(); ?>
                </li>
              </ul>
            </nav>
          </div>
        </header>

        <div id="wrap">
            <!--<div class="menu-button button">Menu</div>
            <nav id="primary-nav" role="navigation">
                <?php echo public_nav_main(array('role' => 'navigation')); ?>
                <div id="search-container" role="search">
                    <?php if (get_theme_option('use_advanced_search') === null || get_theme_option('use_advanced_search')): ?>
                    <?php echo search_form(array('show_advanced' => true)); ?>
                    <?php else: ?>
                    <?php echo search_form(); ?>
                    <?php endif; ?>
                </div>
            </nav>-->
            <div id="content" role="main" tabindex="-1">
                <?php fire_plugin_hook('public_content_top', array('view'=>$this)); ?>
