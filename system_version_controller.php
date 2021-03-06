<?php 

/**
* System_vesion module class
*
* @package munkireport
* @author tuxudo
**/

// Class name should start with upper case to conform to set style
class System_version_controller extends Module_controller
{
    /*** Protect methods with auth! ****/
    public function __construct()
    {
        // Store module path
        $this->module_path = dirname(__FILE__);
    }

    /**
     * Default method
     *
     * @author AvB
     **/

    // The index is used to test if the module is loaded by MunkiReport
    // Visit https://yourMunkiRepo.com/munkireport-php/index.php?/module/system_version/index
    public function index()
    {
        echo "You've loaded the system_version module!";
    }

    /**
     * Get product version for product version widget
     *
     * @return void
     * @author tuxudo
     *
     **/
    public function get_product_version()
    {
        // Set up a new view called object
        $obj_view = new View();

        // Check if the client is allowed to retrieve data using the API
        if (! $this->authorized()) {
            // If they are not, return the message that they are not and exit the function
            $obj->view('json', array('msg' => array('error' => 'Not authenticated')));
            return;
        }
        
        // Prepare to run retrieve the data from the database
        // Remember to use a upper case letter at the start
        // of the model
        $queryobj = new System_version_model;
        
        // Initialize a blank array
        $out = array();
        
        // Build out the SQL statement that you want to run
        // Statement should always include 'LEFT JOIN reportdata USING (serial_number)".get_machine_group_filter()."'
        // so that machine group filtering works
        $sql = "SELECT COUNT(CASE WHEN productversion <> '' AND productversion IS NOT NULL THEN 1 END) AS count, productversion 
                FROM system_version
                LEFT JOIN reportdata USING (serial_number)
                ".get_machine_group_filter()."
                GROUP BY productversion
                ORDER BY count DESC";
        
        // Process each item from the resulting query as $item
        foreach ($queryobj->query($sql) as $item) {
            // If count of $item is not zero...
            if ("$item->count" !== "0") {
                // Set the product version
                $item->productversion = $item->productversion ? $item->productversion : 'Unknown';
                // Add the product version to the out array
                $out[] = $item;
            }
        }
        
        // Return the resulting data and return it as a JSON
        $obj_view->view('json', array('msg' => $out));
    }
  
    /**
     *
     * Retrieve data in JSON format for client tab
     * @author tuxudo
     *
     **/
    // Create the function called "get_data"
    // This is an API and can be access by going
    // to https://yourMunkiRepo.com/munkireport-php/index.php?/module/system_version/get_data/VALID_SERIAL_NUMBER
    public function get_data($serial_number = '')
    {
        // Set up a new view called object
        $obj = new View();

        // Check if the client is allowed to retrieve data using the API
        if (! $this->authorized()) {
            // If they are not, return the message that they are not and exit the function
            $obj->view('json', array('msg' => 'Not authorized'));
            return;
        }

        // Prepare to run retrieve the data from the database
        // using the provided serial number
        // Remember to use a upper case letter at the start
        // of the model
        $queryobj = new System_version_model($serial_number);
        
        // Return the resulting data and return it as a JSON
        $obj->view('json', array('msg' => $queryobj->rs));
    }
} // End class System_version_controller
// Don't forget that the class should start with an upper case