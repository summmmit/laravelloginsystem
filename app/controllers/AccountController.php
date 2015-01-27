<?php
/**
 * Created by PhpStorm.
 * User: Sumit Singh
 * Date: 11-10-2014
 * Time: 03:53 AM
 */

class AccountController extends BaseController
{

    public function getCreate(){
        return View::make('account.create');
    }

    public function postCreate(){
        $validator = Validator::make(Input::all(),
            array(
                'company_name' => 'required|max:50',
                'country' => 'required|max:50',
                'state' => 'required|max:50',
                'email' => 'required|max:50|email|unique:users',
                'username' => 'required|max:20|min:3|unique:users',
                'password' => 'required|min:6',
                'password_again' => 'required|same:password'
            )
    );
        if($validator->fails()){
            return Redirect::route('account-create')
                ->withErrors($validator)
                ->withInput();
        }else{

            $company_name         = Input::get('company_name');
            $address         = Input::get('address');
            $country         = Input::get('country');
            $state         = Input::get('state');
            $email         = Input::get('email');
            $username         = Input::get('username');
            $password       = Input::get('password');

            //Activation COde
            $code = str_random(60);

            $create = User::create(array(
                'company_name'    => $company_name,
                'address'    => $address,
                'country'    => $country,
                'state'    => $state,
                'email'    => $email,
                'username' => $username,
                'password' => Hash::make($password),
                'code'     => $code,
                'active'   => 0
            ));

            if($create){

                //send email
                       Mail::send('emails.auth.activate', array('link' => URL::route('account-activate', $code), 'username' => $username), function($message) use ($create){
                       $message->to($create->email, $create->username)->subject('Activate Your Account');
                        });
                return Redirect::route('home')
                    ->with('global' , 'Your account has been createde u can activate now');
            }else{

                return Redirect::route('home')
                    ->with('global', 'Cant create your Account. Try Later');
            }
        }

    }

    public function getActivate($code){

        $user = User::where('code' , '=', $code)->where('active', '=', 0);
        if($user->count()){
            $user = $user->first();

            //update user

            $user->active = 1;
            $user->code = "";

            if($user->save()){
                return Redirect::route('home')
                    ->with('global', 'Activted thanks');
            }
        }
        return Redirect::route('home')
            ->with('global', 'Cant activate do after some time');
    }

    public function getSignIn(){
        return View::make('account.signin');

    }

    public function postSignIn(){
        $validator = Validator::make(Input::all(),
            array(
                'username' => 'required',
                'password' => 'required'
            )
        );
        if($validator->fails()){
            return Redirect::route('account-sign-in')
                ->withErrors($validator)
                ->withInput();
        }else{

            $remember = (Input::has('remember')) ? true : false;

            $auth = Auth::attempt(array(
                'username'    => Input::get('username'),
                'password' =>  Input::get('password'),
                'active'   => 1
            ), $remember);

            if($auth){
                return Redirect::intended('/');
            }else{
                return Redirect::route('account-sign-in')
                    ->with('global', 'User Password Wrong');
            }
        }

        return Redirect::route('home')
            ->with('global', 'account not activated');

    }

    public function getSignOut(){
        Auth::logout();
        return Redirect::route('home');
    }

    public function getChangePassword(){
        return View::make('account.changePassword');
    }

    public function postChangePassword(){
        $validator = Validator::make(Input::all(),
            array(
                'old_password' => 'required',
                'new_password' => 'required|min:3',
                'Confirm_new_password' => 'required|same:new_password'
            )
        );
        if($validator->fails()){
            return Redirect::route('account-change-password')
                ->withErrors($validator);
        }else{

            $auth = Auth::attempt(array(
                'password' =>  Input::get('old_password')
            ));

            if($auth){
                $user = User::find(Auth::user()->id);
                $old_password = Input::get('old_password');
                $new_password = Input::get('new_password');

                $user->password = Hash::make($new_password);
                if($user->save()){
                    return Redirect::route('account-change-password')
                        ->with('global', 'Your Password is Changed');
                }

            }else{
                return Redirect::route('account-change-password')
                    ->with('global', 'Password Not Changed . Try Again');
            }

        }
        return Redirect::route('account-change-password')
            ->with('global', 'Password Not Changed . Try Again');

    }

    public function getForgotPassword(){
        return View::make('account.forgotPassword');
    }

    public function postForgotPassword(){
        $validator = Validator::make(Input::all(),
            array(
                'email' => 'required|email'
            )
        );
        if($validator->fails()){
            return Redirect::route('account-forgot-password')
                ->withErrors($validator)
                ->withInput();
        }else{
            $user = User::where('email' , '=', Input::get('email'));

            if($user->count()) {
                $user = $user->first();
            }

            //generate code and password

            $code                 = str_random(60);
            $password             = str_random(10);

            $user->code           = $code;
            $user->password_temp  = Hash::make($password);

            if($user->save()){

                //send email
                Mail::send('emails.auth.recover', array('link' => URL::route('account-recover', $code), 'username' => $user->username, 'password' => $password), function($message) use ($user){
                    $message->to($user->email, $user->username)->subject('Change Password for Your Account');
                });
                return Redirect::route('home')
                    ->with('global', 'We have sent the Password to ur email.');

            }


        }
        return Redirect::route('account-forgot-password')
            ->with('global', 'Password could Not Changed . Try Again');

    }

    public function getRecover($code){
        $user = User::where('code', '=', $code)
        ->where('password_temp', '!=', '');

        if($user->count()){
            $user = $user->first();

            $user->password = $user->password_temp;
            $user->password_temp = '';
            $user->code =  '';

            if($user->save()){
                return Redirect::route('home')
                    ->with('global', 'We have changed your password to new one.');
            }

            return Redirect::route('account-forgot-password')
                ->with('global', 'Password could Not Changed . Try Again');
        }
    }

}