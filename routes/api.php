<?php

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:api']], function () {
    // Permissions
    Route::apiResource('permissions', 'PermissionsApiController');

    // Roles
    Route::apiResource('roles', 'RolesApiController');

    // Users
    Route::apiResource('users', 'UsersApiController');

    // Incident Reports
    Route::apiResource('incident-reports', 'IncidentReportsApiController');

    // Category Incidents
    Route::apiResource('category-incidents', 'CategoryIncidentApiController');

    // Asset Categories
    Route::apiResource('asset-categories', 'AssetCategoryApiController');

    // Asset Locations
    Route::apiResource('asset-locations', 'AssetLocationApiController');

    // Asset Statuses
    Route::apiResource('asset-statuses', 'AssetStatusApiController');

    // Assets
    Route::post('assets/media', 'AssetApiController@storeMedia')->name('assets.storeMedia');
    Route::apiResource('assets', 'AssetApiController');

    // Teams
    Route::apiResource('teams', 'TeamApiController');

    // Root Causes
    Route::apiResource('root-causes', 'RootCauseApiController');

    // Department Address Tos
    Route::apiResource('department-address-tos', 'DepartmentAddressToApiController');
});
