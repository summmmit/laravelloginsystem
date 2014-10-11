<?php
/**
 * Created by PhpStorm.
 * User: Sumit Singh
 * Date: 11-10-2014
 * Time: 03:53 PM
 */

class ProfileController extends BaseController
{
    public function user(){
            return View::make('profile.user');
    }

}