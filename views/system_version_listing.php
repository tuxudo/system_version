<?php $this->view('partials/head'); ?>

<?php 
// Initialize models needed for the table
// These two are always required
new Machine_model;
new Reportdata_model;

// This model is the model for the module
new System_version_model;
?>

<!-- Setup the HTML container that will hold the table -->
<div class="container">
  <div class="row">
  	<div class="col-lg-12">
		  <!--   Add in the localized header and total count of all entries in the database   -->
		  <!--   Localization works by using the i18n library, to have a string fill a placeholder   -->
		  <!--   it should be in the format of "modulename.placeholdername"   -->
		  <h3><span data-i18n="system_version.report_title"></span> <span id="total-count" class='label label-primary'>…</span></h3>
		  <table class="table table-striped table-condensed table-bordered">
		    <thead>
		      <tr>
		      	<!--   The left section of the <th> tags is for localization and the   -->
		      	<!--   right is for the column name in the format of "tablename.columnname"   -->
		      	<!--   The first three <th> should always be used   -->
		      	<th data-i18n="listing.computername" data-colname='machine.computer_name'></th>
		        <th data-i18n="serial" data-colname='reportdata.serial_number'></th>
		        <th data-i18n="username" data-colname='reportdata.long_username'></th>
		        <th data-i18n="system_version.productversion" data-colname='system_version.productversion'></th>	                
		        <th data-i18n="system_version.productbuildversion" data-colname='system_version.productbuildversion'></th>	        
		        <th data-i18n="system_version.productcopyright" data-colname='system_version.productcopyright'></th>	        
		        <th data-i18n="system_version.productname" data-colname='system_version.productname'></th>	        
		      </tr>
		    </thead>
		    <tbody>
		      <tr>
		        <!--   This <td> shows the "Loading data from server" when first loading the data   -->
		        <!--   the "colspan" should be equal to the amount of columns in the   -->
		        <!--   listing when starting from 1   -->
		        <td data-i18n="listing.loading" colspan="7" class="dataTables_empty"></td>
		      </tr>
		    </tbody>
		  </table>
    </div> <!-- /span 12 -->
  </div> <!-- /row -->
</div>  <!-- /container -->

<script type="text/javascript">

	$(document).on('appUpdate', function(e){

		var oTable = $('.table').DataTable();
		oTable.ajax.reload();
		return;

	});

	$(document).on('appReady', function(e, lang) {
		// Get column names from data attribute
		var columnDefs = [],
		col = 0; // Column counter
		$('.table th').map(function(){
	             columnDefs.push({name: $(this).data('colname'), targets: col, render: $.fn.dataTable.render.text()});
	             col++;
		});
	    oTable = $('.table').dataTable( {
	        columnDefs: columnDefs,
	        ajax: {
                url: appUrl + '/datatables/data',
                type: "POST",
                data: function(d){
                    // Only show rows if this column is not empty
                    // This is an optional thing and not required
                    d.mrColNotEmpty = "productbuildversion";
                }
            },
            dom: mr.dt.buttonDom,
            buttons: mr.dt.buttons, // Setup the buttons on the listing
	        createdRow: function( nRow, aData, iDataIndex ) {
	        	// Update name in first column to link
	        	// This should always be included to setup the buttons
	        	var name=$('td:eq(0)', nRow).html();
	        	if(name == ''){name = "No Name"};
	        	var sn=$('td:eq(1)', nRow).html();
 	        	// This should point to the client tab
	        	var link = mr.getClientDetailLink(name, sn, '#tab_system_version-tab');
	        	$('td:eq(0)', nRow).html(link);
	        }
	    });
	});
</script>

<?php $this->view('partials/foot'); ?>
