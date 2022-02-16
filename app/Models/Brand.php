<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    public $timestamps = false; //set thời gian bằng false
    protected $fillable = [
        'brand_name','brand_slug','brand_desc','brand_status'
    ];
    protected $primaryKey='brand_id';
    protected $table='tbl_brand';

}
