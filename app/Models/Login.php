<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Login extends Model
{
      public $timestamps = false;
      protected $fillable = [
            'admin_email', 'admin_password', 'admin_name', 'admin_phone',
      ];
      protected $primaryKey = 'admin_id';
      protected $table = 'tbl_admin';

}
