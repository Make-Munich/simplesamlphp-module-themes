<?php
// Define variables.
$url_path = SimpleSAML_Module::getModuleURL('themes');
$css_path = $url_path . '/css';
$js_path  = $url_path . '/js';
$img_path = $url_path . '/img';
?>

<?php
// Output the post content items.
if (!empty($this->data['htmlinject']['htmlContentPost'])) :
  foreach ($this->data['htmlinject']['htmlContentPost'] as $content) :
    echo $content;
  endforeach;
endif;
?>

          </div>
      </div>
		<div id="footer" class="navbar-fixed-bottom">
			<div class="container">
					<div class="row">
						<div class="col-md-4 footer"><p class="pull-left"><?php echo $this->t('{mm:footer_1}'); ?></p></div>
						<div class="col-md-4 footer"><p><?php echo $this->t('{mm:footer_2}'); ?></p></div>
						<div class="col-md-4 footer"><p class="pull-right"><?php echo $this->t('{mm:footer_3}'); ?></p></div>
					</div>
			</div>
		</div>
	</body>
</html>
