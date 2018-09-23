<?php

Route::group(['middleware' => 'web', 'prefix' => 'samplemodule', 'namespace' => 'Modules\SampleModule\Http\Controllers'], function()
{
    Route::get('/', ['uses' => 'SampleModuleController@index', 'laroute' => true])->name('samplemodule_index');
});
