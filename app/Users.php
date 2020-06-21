<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    protected $table = 'users';

    protected $primaryKey = 'username';

    protected $fillable = ['username', 'nama', 'email', 'password'];

    public $incrementing = false;

    public function setPasswordAttribute($value)
    {
      $this->attributes['password'] = bcrypt($value);
    }

    public function users() {
        return $this->hasMany('App\DataMitra', 'username');
    }
}
