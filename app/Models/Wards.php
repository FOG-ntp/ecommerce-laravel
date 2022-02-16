<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wards extends Model
{
    public $timestamps = false; //set time to false
    protected $fillable = [
        'name_xaphuong', 'type', 'maqh',
    ];
    protected $primaryKey = 'xaid';
    protected $table = 'tbl_xaphuongthitran';
}
