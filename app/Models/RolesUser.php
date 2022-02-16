<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RolesUser extends Model
{
    public $timestamps = false; //set time to false
    protected $fillable = [
        'role_id', 'admin_id', 'role_id',
    ];
    protected $primaryKey = 'id_role_user';
    protected $table = 'tbl_role_user';
}
