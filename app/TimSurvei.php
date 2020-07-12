<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TimSurvei extends Model
{
    protected $table = 'tim_survei';

    protected $primaryKey = 'username';

    protected $fillable = ['username', 'password'];

    public $incrementing = false;

    public function setPasswordAttribute($value)
    {
      $this->attributes['password'] = bcrypt($value);
    }
}
