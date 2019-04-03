<?php

return array(
    // Setup the client tabs to be added to the client tab drop down
    // Listings, tabs, and widgets should always end with '_listing.php', '_tab.php', or '_widget.php'
    // otherwise MunkiReport will not pick them up
    'client_tabs' => array(
        // URL tag of tab, file name of tab, localization of name tab
        'system_version-tab' => array('view' => 'system_version_tab', 'i18n' => 'system_version.system_version'),
    ),
    // Add the listing to the listings drop down
    'listings' => array(
        // URL of the listing, file name of listing, localization of name of listing
        'system_version' => array('view' => 'system_version_listing', 'i18n' => 'system_version.system_version'),
    ),
    // Add the report to the reports drop down
    'reports' => array(
        // URL of the report, file name of report, localization of name of report
        'system_version' => array('view' => 'system_version_report', 'i18n' => 'system_version.system_version'),
    ),
    // Add the widgets to the available widgets
    'widgets' => array(
        // Name of the widget, file name of widget
        'system_version_productversion' => array('view' => 'system_version_productversion_widget'),
    ),
);