<?php

use lfrichter\omnivore\Facades\omnivore;

Route::get('/omnivore_test', function(){

    $locationId  = env('OMNIVORE_LOCATION_ID');

    $ticketList  = Omnivore::tickets()->ticketList($locationId);

    $tables      = Omnivore::tables()->tableList($locationId);

    $locations   = Omnivore::general()->locationList();

    dd(compact('ticketList','tables','locations'));

});
