<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
| /opt/plesk/php/7.4/bin/php  /usr/lib/plesk-9.0/composer.phar require jenssegers/date

*/

Route::get('/', 'TankController@index');
Route::get('simu', 'TankController@water_tank');
Route::post('excute', 'TankController@excute');

// Route::get('/privacy', function () {
//     return view('privacy');
// });
// Route::get('/support', function () {
//     return view('support');
// });



// Route::group(['namespace' => 'Dashboard'], function () {
//     Route::get('login', 'AdminController@login');
//     Route::get('api_login', 'AdminController@api_login');
//     // Route::get('login', 'AdminController@login');
//     Route::post('user-login', 'AdminController@user_login');
//     Route::get('logout', 'AdminController@logout');
//     Route::get('setlang/{lang?}', 'AdminController@setlang');
// });

// Route::get('g', 'AuthController@redirectTo');


// Route::group(['namespace' => 'Dashboard' , 'middleware' => ['Loggedin']], function () {

//     // Route::group(['middleware' => ['role:admin']], function () {
//         //roles
//         Route::get('roles', 'RolesController@RolesList');
//         Route::post('add-role', 'RolesController@store');
//         Route::post('edit-roles', 'RolesController@update');
//         Route::get('get-roles', 'RolesController@getRoles');
//         Route::delete('delete-roles', 'RolesController@destroy');
//         //permissions
//         Route::get('permissions', 'PermissionController@index');
//         Route::post('add-permissions', 'PermissionController@store');
//         Route::post('edit-permissions', 'PermissionController@update');
//         Route::get('get-permissions', 'PermissionController@getPermissions');
//         Route::delete('delete-permissions', 'PermissionController@destroy');
//         Route::get('permission_roles', 'PermissionRolesController@index');
//         Route::post('add-permission_roles', 'PermissionRolesController@store');
//         Route::post('edit-permission_roles', 'PermissionRolesController@update');
//         Route::get('get-permission_roles', 'PermissionRolesController@getPermissions');
//         Route::delete('delete-permission_roles', 'PermissionRolesController@destroy');
//         Route::get('/get-all_roles', 'PermissionRolesController@getRoles');
//         Route::get('/all-permissions', 'PermissionRolesController@all_permissions');
//         Route::get('PermissionsList', 'RolesController@PermissionsList');
//         Route::get('CreatePermission', 'RolesController@CreatePermission');
//         Route::get('RolesList', 'RolesController@RolesList');
//         Route::get('CreateRole', 'RolesController@CreateRole');
//         Route::post('permissions/give-permission-to-role', 'PermissionController@givePermissionToRole');
//         Route::post('permissions/revoke-permission-to-role', 'PermissionController@revokePermissionToRole');
//     // });
//     Route::get('/', 'AdminController@index')->name("dashboard.page");
//     Route::post('filter-cards', 'AdminController@filterAdmin');
//     Route::get('dashboard', 'AdminController@index')->name("dashboard.page");
//     Route::post('uploads', 'AdminController@upload');
//     Route::get('limits', 'AdminController@limits');
//     Route::get('get-limits', 'AdminController@get_limits');
//     Route::post('add-new-user', 'AdminController@addUser');
//     Route::get('general-settings', 'AdminController@general_settings');
//     Route::post('settings/update', 'AdminController@update_settings');

//     // charts

//     Route::get('chart-revenue-44/{trader_id}', 'TraderController@getCommissionsStatistics');
//     Route::get('chart-months-4', 'AdminController@get_chart_months_parameters_status4');
//     Route::get('chart-revenue-4', 'AdminController@getPaymentsStatistics');
//     Route::get('chart-revenue-3', 'AdminController@getUsersStatistics');
//     Route::get('chart-revenue-2', 'AdminController@getBookingsStatistics');

//     // profile
//     Route::get('/profile', 'ProfileController@index');
//     Route::post('/profile/save', 'ProfileController@save')->name('profile.save');

    
//     // setting
//     Route::get('settings', "SettingController@index")->name('settings.page');
//     Route::get('get-settings', "SettingController@getSettings")->name('settings.page');
//     Route::post('add-settings', "SettingController@store");
//     Route::post('edit-settings', "SettingController@editSettings");
//     Route::post('delete-settings', "SettingController@deleteSettings");

//     // services
//     Route::get('categories', "CategoryController@index")->name('categories.page');
//     Route::get('get-categories', "CategoryController@getcategories")->name('categories.page');
//     Route::post('add-category', "CategoryController@store")->name('categories.store');
//     Route::post('edit-category', "CategoryController@update");
//     Route::post('delete-category', "CategoryController@destroy");

//     //vendors
//     // Route::group([ 'middleware' => 'role:admin'], function () {
//     Route::get('vendors', "VendorController@index")->name('vendors.page');
//     Route::get('get-vendors', "VendorController@getVendors")->name('vendors.page');
//     Route::post('add-vendors', "VendorController@addVendors")->name('vendors.store');
//     Route::post('edit-vendor', "VendorController@editVendors");
//     Route::post('delete-vendor', "VendorController@deleteVendors");
//     Route::get('vendors/{id}/services', "VendorController@vendorServicesIndex");
//     Route::get('getsubServices', "VendorController@getsubServices");
//     Route::post('add-vendor_services', "VendorController@addVendorServices");
//     Route::post('edit-vendor_services', "VendorController@editVendorServices");
//     Route::get('get-vendor-services/{id}', "VendorController@getVendorServices");
//     Route::post('delete-vendor_service', "VendorController@deleteVendorService");
//     Route::post('activate-vendor', "VendorController@activateVendor");
//     Route::post('delete-gallery-image', "VendorController@deleteGalleryImage");

//     //vendors reports
//     Route::get('vendors/{vendor_id}/reports', 'VendorController@VendorReportsIndex');
//     Route::get('/vendor-chart-revenue-2', 'VendorController@getVendorReports');
//     Route::get('/vendor-chart-revenue-4', 'VendorController@getVendorPayments');
//     Route::post('filter-cards-vendors', 'VendorController@filterCardsVendors');
//     //users
//     Route::get('users', "AdminController@users_index")->name('users.page');
//     Route::get('get-users', "AdminController@get_users")->name('users.page');
//     Route::post('add-users', "AdminController@addUsers");
//     Route::post('edit-users', "AdminController@editUsers");
//     Route::post('delete-users', "AdminController@deleteUsers");
//     Route::post('delete-users-image', 'AdminController@deleteUserImage');
//     // });

    

//     //clients
//     Route::get('clients', "ClientController@index");
//     Route::get('get-clients', "ClientController@getClients");
//     Route::post('add-clients', "ClientController@addClients");
//     Route::post('edit-clients', "ClientController@editClients");
//     Route::post('delete-clients', "ClientController@deleteClients");

//     //cities and towns
//     Route::get('getCityTowns', "CitiesController@getCityTowns");

//     //cities
//     Route::get('cities', 'CitiesController@index')->name('cities.page');
//     Route::get('get-cities', 'CitiesController@getCities')->name('cities.page');
//     Route::post('add-city', 'CitiesController@store');
//     Route::post('update-city', 'CitiesController@update');
//     Route::post('delete-city', 'CitiesController@destroy');

//     //towns
//     Route::get('towns', 'TownController@index')->name('towns.page');
//     Route::get('get-towns', 'TownController@getTowns')->name('towns.page');
//     Route::post('add-town', 'TownController@store');
//     Route::post('update-town', 'TownController@update');
//     Route::delete('delete-town', 'TownController@destroy');

//     //timetable
//     Route::get('timetable', 'TimeTableController@index')->name('timetable.page');
//     Route::get('get-timetable', 'TimeTableController@gettimetable')->name('timetable.page');
//     Route::post('add-timetable', 'TimeTableController@store');
//     Route::post('edit-timetable', 'TimeTableController@update');
//     Route::delete('delete-timetable', 'TimeTableController@destroy');
    

//     //bookings
    
//     //timetable
//     Route::get('bookings', 'BookingController@index')->name('bookings.page');
//     Route::get('get-bookings', 'BookingController@getbookings')->name('bookings.page');
//     Route::post('add-bookings', 'BookingController@store');
//     Route::post('edit-bookings', 'BookingController@update');
//     Route::delete('delete-bookings', 'BookingController@destroy');
//     Route::get('get-mid-services', 'BookingController@getMidServices');
//     Route::get('get-low-services', 'BookingController@getLowServices');

//     //comments
//     Route::get('comments', 'CommentController@index')->name('comments.page');
//     Route::get('get-comments', 'CommentController@getcomments')->name('comments.page');
//     Route::post('add-comments', 'CommentController@store');
//     Route::post('edit-comments', 'CommentController@update');
//     Route::delete('delete-comments', 'CommentController@destroy');
//     //
//     Route::get('contact-us', "ContactUsController@index")->name('contact-us.page');
//     Route::get('get-contact-us', "ContactUsController@getContactUs")->name('contact-us.page');
//     Route::post('update-contactus', "ContactUsController@update");
    

//     //
//     Route::get('notifications', "NotificationCOntroller@index")->name('notifications.page');
//     Route::post('notify-all', "NotificationCOntroller@notifyAll");
//     Route::post('edit-clients', "ClientController@editClients");
//     Route::post('delete-clients', "ClientController@deleteClients");

//     //packages
//     Route::get('packages', 'packagesController@index')->name('packages.page');
//     Route::get('get-packages', 'packagesController@getPackages')->name('packages.page');
//     Route::post('add-packages', 'packagesController@store');
//     Route::post('edit-packages', 'packagesController@update');
//     Route::delete('delete-packages', 'packagesController@destroy');
//     //reviews
//     Route::get('reviews', 'ReviewController@index')->name('reviews.page');
//     Route::get('get-reviews', 'ReviewController@getReviews')->name('reviews.page');
//     Route::post('add-reviews', 'ReviewController@store');
//     Route::post('edit-reviews', 'ReviewController@update');
//     Route::delete('delete-reviews', 'ReviewController@destroy');


//     Route::get('get-vendor-services', 'packagesController@getVendorServices');
//     Route::post('delete-contact_us_id', 'ContactUsController@destroy');


//     //coupons
//     Route::get('coupons', "CouponController@index")->name('coupons.page');
//     Route::get('get-coupons', "CouponController@getCoupons")->name('coupons.page');
//     Route::post('add-coupons', "CouponController@store");
//     Route::post('update-coupons', "CouponController@updateCoupons");
//     Route::delete('delete-coupons', "CouponController@destroy");
//     Route::get('/coupons/{coupon_id}', "CouponController@couponInfo");
//     Route::get('get-couponsInfo', "CouponController@getCouponsInfo");
//     Route::post('add-vendors-coupons', "CouponController@addVendorsCoupons");
//     Route::post('update-vendors-coupons', "CouponController@updateVendorsCoupons");
//     Route::delete('delete-vendor-coupons', "CouponController@deleteVendorsCoupons");


//     // Route::get('testper', 'PermissionController@testper');
//     Route::get('get-user-role', 'PermissionController@get_user_role');

// });
