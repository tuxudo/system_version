<?php

// Tell PHP to use the following libraries
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Capsule\Manager as Capsule;

// The class should be the name of the file with the
// underscores removed and the charactor after them
// made into upper case
class SystemVersion extends Migration
{
    // What should be done when migrating up
    public function up()
    {
        // Make a new database action capsule
        $capsule = new Capsule();

        // Create a table named 'system_version'
        $capsule::schema()->create('system_version', function (Blueprint $table) {

            // Every table should contain an 'id' and 'serial_number' column
            $table->increments('id');
            $table->string('serial_number');

            // Create columns that are VARCHAR(255) and allow them to be set to null
            $table->string('productbuildversion')->nullable();
            $table->string('productcopyright')->nullable();
            $table->string('productname')->nullable();
            $table->string('productversion')->nullable();

            // Create indexes
            $table->index('productbuildversion');
            $table->index('productcopyright');
            $table->index('productname');
            $table->index('productversion');
        });
    }

    // What should be done if migrating down
    public function down()
    {
        // Make a new database action capsule
        $capsule = new Capsule();

        // Drop the system_version table
        $capsule::schema()->dropIfExists('system_version');
    }
}
