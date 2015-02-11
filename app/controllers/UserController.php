<?php

    class UserController extends BaseController {

        protected $layout = 'layouts.master';
        public function getLogin()
        { 
            if (Auth::check()){
                return Redirect::to('');
            }
            return View::make('auth.login');
        }
        public function getRegister()
        {
            if (Auth::check()){
                return Redirect::to('');
            }
            return View::make('auth.register');
        }
        public function getForgotPassword()
        {
            if (Auth::check()){
                return Redirect::to('');
            }
            return View::make('auth.forgotpassword');
        }
        public function postForgotPassword()
        {
            if (Auth::check()){
                return Redirect::to('');
            }
            $userdata = array(
                'email' => Input::get('email'),
            );  
            $rules = array(
                'email'  => 'required|email',
            ); 
            $valid = true; 
            $validator = Validator::make($userdata, $rules); 
            if($validator->fails()){
                $error[] = 'The email must be a valid email address.';
                $valid = false;
            } 
            $user = User::where('email','=',$userdata['email'])->count();
            if($user == 0){
                $error[] = 'Email does not exist.';
                $valid = false;
            }
            if($valid)  return Redirect::to('user/resetpassword')->withInput();
            return Redirect::to('user/forgotpassword')->withErrors($error);

        }
        public function getResetPassword()
        {
            if (Auth::check()){
                return Redirect::to('');
            }
            $email = Input::old('email');
            return View::make('auth.resetpassword')->with(array('email' => $email));
        }
        public function postResetPassword(){
            $userdata = array(
                'email' => Input::get('email'),
                'password' => Input::get('password')
            );  
            $rules = array(
                'email'  => 'required|email',
                'password'  => 'required'
            ); 
            $validator = Validator::make($userdata, $rules); 
            if($validator->fails()){
                return Redirect::to('user/resetpassword')->withErrors($validator)->withInput();
            }
            $userdata['password'] = Hash::make($userdata['password']);
            $user = User::where('email','=',$userdata['email'])->first();
            if($user){
                $user->password = $userdata['password'];
                $user->save();
            }
            return Redirect::to('user/login')->with('success', 'Reset password successfully'); 

        }
        public function postLogin()
        {
            $userdata = array(
                'email' => Input::get('email'),
                'password' => Input::get('password')
            );   
            $rules = array(
                'email'  => 'required|email',
                'password'  => 'required'
            ); 
            $validator = Validator::make($userdata, $rules);  
            if ($validator->passes())
            {
                if (Auth::attempt($userdata))
                { 
                    return Redirect::to('')->with('success', 'You have logged in successfully');
                }
                else
                {
                    return Redirect::to('user/login')->withErrors(array('password' => 'Email does not exist or password invalid.'));
                }
            } 
            return Redirect::to('user/login')->withErrors($validator);
        }
        public function postRegister()
        {
            $tmp_userdata = array(
                'email' => Input::get('email'),
                'password' => Input::get('password'),       
            );

            $rules = array(                          
                'email' => 'required|email|unique:users',
                'password' => 'required|min:4',
            );
            $userdata = $tmp_userdata;
            $validation = Validator::make($userdata, $rules);
            if($validation->fails()){   
                return Redirect::to('user/register')->withErrors($validation)->withInput();
            } 

            $userdata['password'] = Hash::make($userdata['password']);
            $userdata = (object) $userdata;

            $user = new User();
            foreach($userdata as $key => $value) {
                $user->$key = $value;
            }

            $user->save();

            if ( $user->id )
            {
                $accountSetting = new AccountSetting();
                $accountSetting->user_id =  $user->id;
                $accountSetting->status = "trial";
                $accountSetting->expires_date = date('Y-m-d',strtotime("+1 month")); 
                $accountSetting->save();  
                $rules = array(
                    'email'  => 'required|email',
                    'password'  => 'required'
                ); 
                $validator = Validator::make($tmp_userdata, $rules); 
                if ($validator->passes())
                {
                    if (Auth::attempt($tmp_userdata))
                    {
                        return Redirect::to('')->with('success', 'You have logged in successfully');
                    }
                    else
                    {
                        return Redirect::to('user/login')->withErrors(array('password' => 'Password invalid'))->withInput(Input::except('password'));
                    }
                }
                return Redirect::to('user/login')->withErrors($validator)->withInput(Input::except('password'));
            }
            else {
                $error = $user->errors();
                return Redirect::to('user/register')
                ->withErrors($error);
            }

        }
        public function getLogout()
        { 
            Auth::logout();
            return Redirect::to('user/login');
        }
    }

