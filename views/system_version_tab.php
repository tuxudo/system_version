<!-- Create the header and localization placeholder -->
<h2 data-i18n="system_version.system_version"></h2>

<!-- Create the "Loading data from server" localization placeholder entry -->
<div id="system_version-msg" data-i18n="listing.loading" class="col-lg-12 text-center"></div>

<!-- Setup the hidden table that will be filled with data -->
<div id="system_version-view" class="row hide">
    <!--  "col-md-2" is how wide the table is  -->
    <!--  change the 2 to make it more narrow or wider  -->
    <div class="col-md-2">
        <table class="table table-striped">
            <tr>
                <!-- <th> contains the localization placeholder -->
                <th data-i18n="system_version.productversion"></th>
                <!-- <td> will be filled in with data from the JavaScript below -->
                <td id="system_version-productversion"></td>
            </tr>
            <tr>
                <th data-i18n="system_version.productbuildversion"></th>
                <td id="system_version-productbuildversion"></td>
            </tr>
            <tr>
                <th data-i18n="system_version.productname"></th>
                <td id="system_version-productname"></td>
            </tr>
            <tr>
                <th data-i18n="system_version.productcopyright"></th>
                <td id="system_version-productcopyright"></td>
            </tr>
        </table>
    </div>
</div>

<script>
$(document).on('appReady', function(e, lang) {

	// Get system_version data from the API in the controller and give it the variable "data"
	$.getJSON( appUrl + '/module/system_version/get_data/' + serialNumber, function( data ) {
		// Check if we have data in the productbuildversion entry in the returned data
		if( ! data.productbuildversion){
			// If we don't, change the "Loading data from server" message to
			// a locatization placeholder to show we have no data
			$('#system_version-msg').text(i18n.t('no_data'));
		}
		else{
			// If we do have data...
            
			// Blank the "Loading data from server" message and show the table
			$('#system_version-msg').text('');
			$('#system_version-view').removeClass('hide');

			// Add strings to the <td> in the table above from the entries in the data object
			$('#system_version-productversion').text(data.productversion); 
			$('#system_version-productbuildversion').text(data.productbuildversion);
			$('#system_version-productname').text(data.productname); 
			$('#system_version-productcopyright').text(data.productcopyright);
		}
	});
});
</script>