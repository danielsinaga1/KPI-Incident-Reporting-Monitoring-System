<?php

Route::redirect('/', '/login');
Route::get('/home', function () {
    if (session('status')) {
        return redirect()->route('admin.home')->with('status', session('status'));
    }

    return redirect()->route('admin.home');
});

Auth::routes(['register' => false]);

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');

    // Incident Reports
    Route::delete('incident-reports/destroy', 'IncidentReportController@massDestroy')->name('incident-reports.massDestroy');
    Route::resource('incident-reports', 'IncidentReportController');

    // Category Incidents
    Route::delete('category-incidents/destroy', 'CategoryIncidentController@massDestroy')->name('category-incidents.massDestroy');
    Route::resource('category-incidents', 'CategoryIncidentController');

    // Asset Categories
    Route::delete('asset-categories/destroy', 'AssetCategoryController@massDestroy')->name('asset-categories.massDestroy');
    Route::resource('asset-categories', 'AssetCategoryController');

    // Asset Locations
    Route::delete('asset-locations/destroy', 'AssetLocationController@massDestroy')->name('asset-locations.massDestroy');
    Route::resource('asset-locations', 'AssetLocationController');

    // Asset Statuses
    Route::delete('asset-statuses/destroy', 'AssetStatusController@massDestroy')->name('asset-statuses.massDestroy');
    Route::resource('asset-statuses', 'AssetStatusController');

    // Assets
    Route::delete('assets/destroy', 'AssetController@massDestroy')->name('assets.massDestroy');
    Route::post('assets/media', 'AssetController@storeMedia')->name('assets.storeMedia');
    Route::resource('assets', 'AssetController');

    // Assets Histories
    Route::resource('assets-histories', 'AssetsHistoryController', ['except' => ['create', 'store', 'edit', 'update', 'show', 'destroy']]);

    // Teams
    Route::delete('teams/destroy', 'TeamController@massDestroy')->name('teams.massDestroy');
    Route::resource('teams', 'TeamController');
    
    // Results
    Route::delete('results/destroy', 'ResultController@massDestroy')->name('results.massDestroy');
    Route::resource('results', 'ResultController');

    // Root Causes
    Route::delete('root-causes/destroy', 'RootCauseController@massDestroy')->name('root-causes.massDestroy');
    Route::resource('root-causes', 'RootCauseController');

    // Designation Departments
    Route::delete('designation-departments/destroy', 'DesignationDepartmentController@massDestroy')->name('designation-departments.massDestroy');
    Route::resource('designation-departments', 'DesignationDepartmentController');

        // My Incident Reports
    Route::delete('my-incident-reports/destroy', 'MyIncidentReportController@massDestroy')->name('my-incident-reports.massDestroy');
    Route::post('my-incident-reports/media', 'MyIncidentReportsController@storeMedia')->name('my-incident-reports.storeMedia');
    Route::resource('my-incident-reports', 'MyIncidentReportController');

    // Task Incident Reports
    Route::delete('task-incident-reports/destroy', 'IncidentReportsController@massDestroy')->name('task-incident-reports.massDestroy');
    Route::resource('task-incident-reports', 'TaskIncidentReportsController');
    
});
