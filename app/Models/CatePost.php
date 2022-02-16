<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CatePost extends Model
{
    public $timestamps = false; //set time to false
    protected $fillable = [
        'cate_post_name', 'cate_post_status', 'cate_post_slug', 'cate_post_desc',
    ];
    protected $primaryKey = 'cate_post_id';
    protected $table = 'tbl_category_post';

    public function post()
    {
        $this->hasMany('App\Post');
    }
}
