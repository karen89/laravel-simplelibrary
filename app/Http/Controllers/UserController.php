<?php
namespace App\Http\Controllers;
use App\User;
use App\Book;
use Illuminate\Routing\Controller as BaseController;
use Validator, Input, Redirect, Auth, View; 



class UserController extends BaseController {
    public function home () {
        $user = Auth::user();
        //$books = Book::where('user_id', '=', $user->id)->get();
        $books = $user->book;
        return View::make('home',compact('books'));    
        //return view('home', ['books' => $books]);
    }

    public function getLogin () {
        return View::make('login');
    }
    

    public function getRegister () {
        return View::make('register');
    }

    public function postLogin() {
        //Validate the data
        //Making the rules for the login confirmation
        $rules = 
                array(
                    'username' => 'required',
                    'password' => 'required|min:4' 
                );
        //Check if the data sent for the form are valid, according to the defined rules  
        $validator = Validator::make(Input::all(), $rules);
        if ( $validator->fails() ) {
            return Redirect::to('login')
                                ->withErrors($validator)
                                ->withInput(Input::except('password'));
        } else {
            $userData = array(
                            'username' => Input::get('username'),
                            'password' => Input::get('password')
                        );
            $remember = Input::has('remember') ? true : false;
            if (Auth::attempt($userData,$remember)) {
                return Redirect::route('home');
            } else {
                // Redirects to the login page and sends to the view a message to be displayed to the user 
                // and the css alert-class defined as alert-danger
                return Redirect::to('login')->with('message', 'invalid user/password combination.')->with('alert-class', 'alert-danger');
            }
        }
    }


    public function postRegister() {
        //Check if the data sent for the form are valid, according to the rules defined in the User class
        $validator = User::validate(Input::all()); 
        if ($validator->passes()) {
            User::create(array(
                 'username' => Input::get('username') 
                ,'email' => Input::get('email')  
                ,'password' => Input::get('password')  
                ));
        return Redirect::to('login')->withMessage('The user was successfully created!');
        }
        return Redirect::to('register')->withErrors($validator);

    }

    public function logout() {
        Auth::logout();
        // Redirects to the login page and sends to the view a message to be displayed to the user
        return Redirect::to('login')->with('message', 'You are successfully logged out!');
    }
}