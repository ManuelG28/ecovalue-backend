<?php

/**
 * Author: Santiago Gil
 * Date: 18/06/2021
 * Email: sgilz@eafit.edu.co
 */

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Validator;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email',
        'first_name',
        'job',
        'last_name',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getId()
    {
        return $this->attributes['id'];
    }
    
    public function setId($id)
    {
        $this->attributes['id'] = $id;
    }

    public function getEmail()
    {
        return $this->attributes['email'];
    }
    
    public function setEmail($email)
    {
        $this->attributes['email'] = $email;
    }

    public function getFirstName()
    {
        return $this->attributes['first_name'];
    }

    public function setFirstName($name)
    {
        $this->attributes['first_name'] = $name;
    }

    public function getLastName()
    {
        return $this->attributes['last_name'];
    }

    public function setLastName($name)
    {
        $this->attributes['last_name'] = $name;
    }

    public function getJob()
    {
        return $this->attributes['job'];
    }

    public function setJob($job)
    {
        $this->attributes['job'] = $job;
    }

    public function getPassword()
    {
        return $this->attributes['password'];
    }

    public function setPassword($password)
    {
        $this->attributes['password'] = $password;
    }

    public function organizations()
    {
        return $this->hasMany(Organization::class);
    }

    public static function validateRegister(Request $request) 
    {
        //validating fields from the request
        return Validator::make(
            $request->all(), [
                'first_name' => 'required|string|max:100',
                'last_name' => 'required|string|max:100',
                'job' => 'nullable|string|max:100',
                'email' => 'required|string|email|max:200|unique:users',
                'password' => 'required|string|min:8',
        ]);
    }
}
