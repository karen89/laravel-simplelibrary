<?php

namespace App;
use App\Book;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Validator, Hash;

class User extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['username', 'email', 'password'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    public function setPasswordAttribute($password) {
        $this->attributes['password'] = Hash::make($password); 
    }

    public function book() {
        return $this->hasMany('App\Book');
    }

    public static function validate($input) {
        $rules = [
                     'username' => 'required|min:3|max:50|alphanum|unique:users'
                    ,'email'    => 'required|email|unique:users'
                    ,'password' => 'required|between:4,10|confirmed|alphanum'
                    ,'password_confirmation' => 'required|between:4,10'
                 ];
        return Validator::make($input, $rules);
    }
}
