        </div><!-- end content -->

    </div><!-- end wrap -->


    <footer role="contentinfo">

        <div id="footer-text">
            <?php echo get_theme_option('Footer Text'); ?>
            <?php if ((get_theme_option('Display Footer Copyright') == 1) && $copyright = option('copyright')): ?>
                <p><?php echo $copyright; ?></p>
            <?php endif; ?>
            <!--<p><?php echo __('Proudly powered by <a href="http://omeka.org">Omeka</a>.'); ?></p>-->
            <div class="row">
              <!--<div class="column">
                <img id="sks" src="http://kalevala-dev.ngrok.io/loitsut/logo-SKS-footer@2x.png" />
              </div>
              <div class="column">
                <img id="kordelin" src="http://kalevala-dev.ngrok.io/loitsut/logo-kordelin@2x.png" />
              </div>
              <div class="column">
                <img id="kalevalas" src="http://kalevala-dev.ngrok.io/loitsut/logo-kalevalaseura@2x.png" />
              </div>-->
            </div>
        </div>

        <?php fire_plugin_hook('public_footer', array('view' => $this)); ?>

    </footer><!-- end footer -->

    <script type="text/javascript">
    jQuery(document).ready(function () {
        Omeka.showAdvancedForm();
        Omeka.skipNav();
        Omeka.megaMenu('.no-touchevents #primary-nav');
        ThanksRoy.mobileMenu();
    });
    </script>

</body>
</html>
