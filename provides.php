<?php

return array(
    // Setup the client tabs to be added to the client tab drop down
    // Listings, tabs, and widgets (example not shown) should always end with '_listing.php', '_tab.php', or '_widget.php'
    // or MunkiReport will not pick them up
    'client_tabs' => array(
        // URL tag of tab, file name of tab, locatization of name tab
        'system_version-tab' => array('view' => 'system_version_tab', 'i18n' => 'system_version.system_version'),
    ),
    // Add the listing to the listing drop down
    'listings' => array(
        // URL of the listing, file name of listing, localization of name of listing
        'system_version' => array('view' => 'system_version_listing', 'i18n' => 'system_version.system_version'),
    ),
);