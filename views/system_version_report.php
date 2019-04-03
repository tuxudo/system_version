<?php $this->view('partials/head', array(
	// Load in the header and client list JavaScript
	"scripts" => array(
		"clients/client_list.js"
	)
)); ?>

<!-- Build the report container -->
<div class="container">
      <!-- Build the row -->
      <div class="row">

          <!-- Add in the widget -->
          <!-- It is recommended to have a maximum of three widgets per row -->
          <?php $widget->view($this, 'system_version_productversion'); ?>

      </div> <!-- /row -->
</div>  <!-- /container -->

<!-- Load in the script that auto updates the widgets -->
<script src="<?php echo conf('subdirectory'); ?>assets/js/munkireport.autoupdate.js"></script>

<!-- Load in the footer -->
<?php $this->view('partials/foot'); ?>
