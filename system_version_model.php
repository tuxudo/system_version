<?php

// Tell PHP to use CFPropertyList to process plists
use CFPropertyList\CFPropertyList;

// Model name should start with upper case to conform to set style
class System_version_model extends \Model 
{
    public function __construct($serial='')
    {
        // Setup how the database will be setup
        parent::__construct('id', 'system_version'); // Primary key, table name
        $this->rs['id'] = 0;
        $this->rs['serial_number'] = $serial;
        $this->rs['productbuildversion'] = "";
        $this->rs['productcopyright'] = "";
        $this->rs['productname'] = "";
        $this->rs['productversion'] = "";

        // Return entry for a serial number if provided
        if ($serial) {
            $this->retrieve_record($serial);
        }

        $this->serial = $serial;
    }

    // ------------------------------------------------------------------------

    /**
     * Process data sent by postflight
     *
     * @param string data
     * 
     **/
    public function process($data)
    {        
        // Check if we have data
        if (! $data) {
            // Send out an error, errors are visible when running 'sudo postflight' on a client Mac
            print_r("Error Processing Request: No SystemVersion.plist found!");
        } else {

            // Process incoming SystemVersion.plist
            
            // Set up the plist parser
            $parser = new CFPropertyList();
            
            // Parse the data into an array
            $parser->parse($data);
            
            // Change the keys to lower case and set the array to be the $plist object
            $plist = array_change_key_case($parser->toArray(), CASE_LOWER);

            // For each key in the array, process it using the variable $item
            foreach (array('productbuildversion', 'productcopyright', 'productname', 'productversion') as $item) {
                
                // If the key in the array is set
                if (isset($plist[$item])) {
                    // Set the model object's entry to the array's entry
                    $this->$item = $plist[$item];
                } else {
                    // If the key is not set, set the model object's entry to blank
                    $this->$item = '';
                }
            }

            // Once done processing each key in the array, save the data to the database
            $this->save();
        }
    }
}
