<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    public $timestamps = false; //set time to false
    protected $fillable = [
        'info_contact', 'info_map', 'info_fanpage',
    ];
    protected $primaryKey = 'info_id';
    protected $table = 'tbl_infomation';
}
