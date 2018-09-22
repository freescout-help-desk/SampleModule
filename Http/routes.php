<?php

Route::group(['middleware' => 'web', 'prefix' => 'samplemodule', 'namespace' => 'Modules\SampleModule\Http\Controllers'], function()
{
    Route::get('/', 'SampleModuleController@index');
});
