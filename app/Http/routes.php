<?php

Route::group(array('before' => 'if_logged_in_must_be_subscribed'), function() {

    /*
      |--------------------------------------------------------------------------
      | Home Page Routes
      |--------------------------------------------------------------------------
     */

    Route::get('/', 'ThemeHomeController@index');

    /*
      |--------------------------------------------------------------------------
      | Course Page Routes
      |--------------------------------------------------------------------------
     */

    Route::get('courses', array('uses' => 'ThemeCourseController@courses', 'as' => 'courses'));
    Route::get('courses/category/{category}', 'ThemeCourseController@category');
    Route::get('courses/tag/{tag}', 'ThemeCourseController@tag');
    Route::get('course/{id}', 'ThemeCourseController@index');


    /*
      |--------------------------------------------------------------------------
      | Favorite Routes
      |--------------------------------------------------------------------------
     */

    Route::post('favorite', 'ThemeFavoriteController@favorite');
    Route::get('favorites', 'ThemeFavoriteController@show_favorites');


    /*
      |--------------------------------------------------------------------------
      | Post Page Routes
      |--------------------------------------------------------------------------
     */

    Route::get('posts', array('uses' => 'ThemePostController@posts', 'as' => 'posts'));
    Route::get('posts/category/{category}', 'ThemePostController@category');
    Route::get('post/{slug}', 'ThemePostController@index');


    /*
      |--------------------------------------------------------------------------
      | Page Routes
      |--------------------------------------------------------------------------
     */

    Route::get('pages', 'ThemePageController@pages');
    Route::get('page/{slug}', 'ThemePageController@index');


    /*
      |--------------------------------------------------------------------------
      | Search Routes
      |--------------------------------------------------------------------------
     */

    Route::get('search', 'ThemeSearchController@index');

    /*
      |--------------------------------------------------------------------------
      | Auth and Password Reset Routes
      |--------------------------------------------------------------------------
     */

    Route::get('login', 'ThemeAuthController@social_form');
    Route::get('mlogin', 'ThemeAuthController@login_form');
    Route::get('signup', 'ThemeAuthController@signup_form');
    Route::get('social/login/redirect/{provider}', ['uses' => 'ThemeAuthController@redirectToProvider', 'as' => 'social.login'])
            ->where('provider', 'facebook|twitter|google');
    Route::get('social/login/{provider}', 'ThemeAuthController@handleProviderCallback')
            ->where('provider', 'facebook|twitter|google');
    Route::post('login', 'ThemeAuthController@login');
    Route::post('signup', 'ThemeAuthController@signup');

    Route::get('password/reset', array('before' => 'demo', 'uses' => 'ThemeAuthController@password_reset', 'as' => 'password.remind'));
    Route::post('password/reset', array('before' => 'demo', 'uses' => 'ThemeAuthController@password_request', 'as' => 'password.request'));
    Route::get('password/reset/{token}', array('before' => 'demo', 'uses' => 'ThemeAuthController@password_reset_token', 'as' => 'password.reset'));
    Route::post('password/reset/{token}', array('before' => 'demo', 'uses' => 'ThemeAuthController@password_reset_post', 'as' => 'password.update'));

    //Route::controller('password', 'PasswordController');

    /*
      |--------------------------------------------------------------------------
      | User and User Edit Routes
      |--------------------------------------------------------------------------
     */

    Route::get('user/{username}', 'ThemeUserController@index');
    Route::get('user/{username}/edit', 'ThemeUserController@edit');
    Route::post('user/{username}/update', array('before' => 'demo', 'uses' => 'ThemeUserController@update'));
    Route::get('user/{username}/billing', array('before' => 'demo', 'uses' => 'ThemeUserController@billing'));
    Route::get('user/{username}/cancel', array('before' => 'demo', 'uses' => 'ThemeUserController@cancel_account'));
    Route::get('user/{username}/resume', array('before' => 'demo', 'uses' => 'ThemeUserController@resume_account'));
    Route::get('user/{username}/update_cc', 'ThemeUserController@update_cc');
}); // End if_logged_in_must_be_subscribed route

Route::get('user/{username}/renew_subscription', 'ThemeUserController@renew');
Route::post('user/{username}/update_cc', array('before' => 'demo', 'uses' => 'ThemeUserController@update_cc_store'));
Route::get('logout', 'ThemeAuthController@logout');

Route::get('upgrade', 'UpgradeController@upgrade');


/*
  |--------------------------------------------------------------------------
  | Admin Routes
  |--------------------------------------------------------------------------
 */

Route::group(array('before' => 'admin'), function() {

    // Admin Dashboard
    Route::get('admin', 'AdminController@index');

    // Admin Course Functionality
    Route::get('admin/courses', 'AdminCoursesController@index');
    Route::get('admin/courses/edit/{id}', 'AdminCoursesController@edit');
    Route::post('admin/courses/update', array('before' => 'demo', 'uses' => 'AdminCoursesController@update'));
    Route::get('admin/courses/delete/{id}', array('before' => 'demo', 'uses' => 'AdminCoursesController@destroy'));
    Route::get('admin/courses/create', 'AdminCoursesController@create');
    Route::post('admin/courses/store', array('before' => 'demo', 'uses' => 'AdminCoursesController@store'));
    Route::get('admin/courses/categories', 'AdminCourseCategoriesController@index');
    Route::post('admin/courses/categories/store', array('before' => 'demo', 'uses' => 'AdminCourseCategoriesController@store'));
    Route::post('admin/courses/categories/order', array('before' => 'demo', 'uses' => 'AdminCourseCategoriesController@order'));
    Route::get('admin/courses/categories/edit/{id}', 'AdminCourseCategoriesController@edit');
    Route::post('admin/courses/categories/update', array('before' => 'demo', 'uses' => 'AdminCourseCategoriesController@update'));
    Route::get('admin/courses/categories/delete/{id}', array('before' => 'demo', 'uses' => 'AdminCourseCategoriesController@destroy'));

    Route::get('admin/posts', 'AdminPostController@index');
    Route::get('admin/posts/create', 'AdminPostController@create');
    Route::post('admin/posts/store', array('before' => 'demo', 'uses' => 'AdminPostController@store'));
    Route::get('admin/posts/edit/{id}', 'AdminPostController@edit');
    Route::post('admin/posts/update', array('before' => 'demo', 'uses' => 'AdminPostController@update'));
    Route::get('admin/posts/delete/{id}', array('before' => 'demo', 'uses' => 'AdminPostController@destroy'));
    Route::get('admin/posts/categories', 'AdminPostCategoriesController@index');
    Route::post('admin/posts/categories/store', array('before' => 'demo', 'uses' => 'AdminPostCategoriesController@store'));
    Route::post('admin/posts/categories/order', array('before' => 'demo', 'uses' => 'AdminPostCategoriesController@order'));
    Route::get('admin/posts/categories/edit/{id}', 'AdminPostCategoriesController@edit');
    Route::get('admin/posts/categories/delete/{id}', array('before' => 'demo', 'uses' => 'AdminPostCategoriesController@destroy'));
    Route::post('admin/posts/categories/update', array('before' => 'demo', 'uses' => 'AdminPostCategoriesController@update'));

    Route::get('admin/pages', 'AdminPageController@index');
    Route::get('admin/pages/create', 'AdminPageController@create');
    Route::post('admin/pages/store', array('before' => 'demo', 'uses' => 'AdminPageController@store'));
    Route::get('admin/pages/edit/{id}', 'AdminPageController@edit');
    Route::post('admin/pages/update', array('before' => 'demo', 'uses' => 'AdminPageController@update'));
    Route::get('admin/pages/delete/{id}', array('before' => 'demo', 'uses' => 'AdminPageController@destroy'));


    Route::get('admin/users', 'AdminUsersController@index');
    Route::get('admin/user/create', 'AdminUsersController@create');
    Route::post('admin/user/store', array('before' => 'demo', 'uses' => 'AdminUsersController@store'));
    Route::get('admin/user/edit/{id}', 'AdminUsersController@edit');
    Route::post('admin/user/update', array('before' => 'demo', 'uses' => 'AdminUsersController@update'));
    Route::get('admin/user/delete/{id}', array('before' => 'demo', 'uses' => 'AdminUsersController@destroy'));

    Route::get('admin/menu', 'AdminMenuController@index');
    Route::post('admin/menu/store', array('before' => 'demo', 'uses' => 'AdminMenuController@store'));
    Route::get('admin/menu/edit/{id}', 'AdminMenuController@edit');
    Route::post('admin/menu/update', array('before' => 'demo', 'uses' => 'AdminMenuController@update'));
    Route::post('admin/menu/order', array('before' => 'demo', 'uses' => 'AdminMenuController@order'));
    Route::get('admin/menu/delete/{id}', array('before' => 'demo', 'uses' => 'AdminMenuController@destroy'));

    Route::get('admin/plugins', 'AdminPluginsController@index');

    Route::get('admin/themes', 'AdminThemesController@index');
    Route::get('admin/theme/activate/{slug}', array('before' => 'demo', 'uses' => 'AdminThemesController@activate'));

    Route::get('admin/settings', 'AdminSettingsController@index');
    Route::post('admin/settings', array('before' => 'demo', 'uses' => 'AdminSettingsController@save_settings'));

    Route::get('admin/payment_settings', 'AdminPaymentSettingsController@index');
    Route::post('admin/payment_settings', array('before' => 'demo', 'uses' => 'AdminPaymentSettingsController@save_payment_settings'));

    Route::get('admin/social_settings', 'AdminSocialSettingsController@index');
    Route::post('admin/social_settings', array('before' => 'demo', 'uses' => 'AdminSocialSettingsController@save_social_settings'));

    Route::get('admin/theme_settings_form', 'AdminThemeSettingsController@theme_settings_form');
    Route::get('admin/theme_settings', 'AdminThemeSettingsController@theme_settings');
    Route::post('admin/theme_settings', array('before' => 'demo', 'uses' => 'AdminThemeSettingsController@update_theme_settings'));
});

/*
  |--------------------------------------------------------------------------
  | Payment Webhooks
  |--------------------------------------------------------------------------
 */

Route::post('stripe/webhook', 'Laravel\Cashier\WebhookController@handleWebhook');

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

// Route::group(array('prefix' => 'api/v1'), function()
// {
//     Route::get('/', 'Api\v1\DocumentationController@index');
//     Route::resource('videos', 'Api\v1\VideosController');
// });


