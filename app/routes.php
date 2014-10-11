<?php

Route::get('/', array(
'as'  => 'home',
'uses' => 'HomeController@home'
));
/*
 * Authenticated Group
 */
Route::group(array('before' => 'auth'), function(){

    /*
     * CSRF protection
     */
    Route::group(array('before' => 'csrf'), function(){
        /*
         * Change Password (post)
         */
        Route::Post('/account/change-password', array(
            'as'  => 'account-change-password-post',
            'uses' => 'AccountController@postChangePassword'
        ));
    });
    /*
     * SignOUt (get)
     */
    Route::get('/account/sign-out', array(
        'as'  => 'account-sign-out',
        'uses' => 'AccountController@getSignOut'
    ));
    /*
     * Change Password (get)
     */
    Route::get('/account/change-password', array(
        'as'  => 'account-change-password',
        'uses' => 'AccountController@getChangePassword'
    ));
    /*
     * User Profile (get)
     */
    Route::get('/user/profile', array(
        'as'  => 'profile-user',
        'uses' => 'ProfileController@user'
    ));

});

/*
 * Unauthenticated Group
 */
Route::group(array('before' => 'guest'), function(){

    /*
     * CSRF protection
     */
    Route::group(array('before' => 'csrf'), function(){
        /*
         * Create Account (post)
         */
        Route::Post('/account/create', array(
            'as'  => 'account-create-post',
            'uses' => 'AccountController@postCreate'
        ));
        /*
         * SignIn (post)
         */
        Route::Post('/account/sign-in', array(
            'as'  => 'account-sign-in-post',
            'uses' => 'AccountController@postSignIn'
        ));
        /*
         * Account Recovery (post)
         */
        Route::Post('/account/forgot-password', array(
            'as'  => 'account-forgot-password',
            'uses' => 'AccountController@postForgotPassword'
        ));


    });
    /*
     * Create Account (get)
     */
    Route::get('/account/create', array(
        'as'  => 'account-create',
        'uses' => 'AccountController@getCreate'
    ));
    /*
     * SignIn (get)
     */
    Route::get('/account/sign-in', array(
        'as'  => 'account-sign-in',
        'uses' => 'AccountController@getSignIn'
    ));
    /*
     * Activate Account (get)
     */
    Route::get('/account/activate/{code}', array(
        'as'  => 'account-activate',
        'uses' => 'AccountController@getActivate'
    ));

    /*
     * Recover Account (get)
     */
    Route::get('/account/forgot-password', array(
        'as'  => 'account-forgot-password',
        'uses' => 'AccountController@getForgotPassword'
    ));
    /*
     * recover Account code (get)
     */
    Route::get('/account/recover/{code}', array(
        'as'  => 'account-recover',
        'uses' => 'AccountController@getRecover'
    ));
});
