<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    //
    protected $table = "article";
    protected $primaryKey = 'art_id';
    public $timestamps = false;
    protected $guarded =[];
    //$guarded =['art_title']; 表示通过create添加数据时，该字段不赋值

}
