<!-- Build the container to hold the widget -->
<div class="col-lg-4 col-md-6">
	<!-- Build widget and give it an ID -->
	<div class="panel panel-default" id="system_version-productversion-widget">
		<div class="panel-heading" data-container="body" >
			<!-- Create the widget header and give it an icon from https://fontawesome.com/v4.7.0/icons/ -->
			<h3 class="panel-title"><i class="fa fa-code-fork"></i>
			    <!-- Add widget title localization placeholder -->
			    <span data-i18n="system_version.system_version"></span>
			    <!-- Add the listing that the widget listing button directs to -->
			    <list-link data-url="/show/listing/system_version/system_version"></list-link>
			</h3>
		</div>
		<!-- Tell the widget to be a scroll box type widget -->
		<div class="list-group scroll-box"></div>
	</div><!-- /panel -->
</div><!-- /col -->

<script>
$(document).on('appUpdate', function(e, lang) {
	
	// Set "box" to be the widget's ID as set above
	var box = $('#system_version-productversion-widget div.scroll-box');
	
	// Get the JSON from the controller's API and assign it to be "data"
	$.getJSON( appUrl + '/module/system_version/get_product_version', function( data ) {
		
		// Empty the box if there is something in it
		box.empty();
		// Check if we have data
		if(data.length){
			// Process each item in the data array and give it the name "d"
			$.each(data, function(i,d){
				// Set the badge from the count of different product versions
				var badge = '<span class="badge pull-right">'+d.count+'</span>';
				// Add the row to the widget's scroll box
				// Include what listing the widget directs to when the row is clicked
				// "d.productversion" means get the product version from "d"
				// "+badge" appends the count the different product versions to the row
				box.append('<a href="'+appUrl+'/show/listing/system_version/system_version/#'+d.productversion+'" class="list-group-item">'+d.productversion+badge+'</a>')
			});
		}
        
		// If we don't have data
		else{ 
			// Tell the box to show that we have no data using a localization placeholder
			box.append('<span class="list-group-item">'+i18n.t('system_version.noproductversion')+'</span>');
		}
	});
});	
</script>
