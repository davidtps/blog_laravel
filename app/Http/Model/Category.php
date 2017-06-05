<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    protected $table = "category";
    protected $primaryKey = 'cat_id';
    public $timestamps = false;

    public function handldTree()
    {
        $category = $this->orderBy('cat_order','asc')->get();
        return $this->getTree($category, 'cat_id', 'cat_pid', 'cat_name');
    }

    /**
     * @param $data 源数据集合
     * @param string $field_id id
     * @param string $field_pid 父id
     * @param $field_modify  需要重新修改值的字段
     * @return array
     */
    public function getTree($data, $field_id = 'id', $field_pid = 'pid', $field_modify)
    {
        $arr = array();//组合后的排序对象
        foreach ($data as $k => $v) {
            if ($v->$field_pid == 0) {
                $arr[] = $data[$k];
                foreach ($data as $m => $n) {
                    if ($v->$field_id == $n->$field_pid) {
                        $n[$field_modify] = '├───' . $n[$field_modify];
//                        $data[$m]['_cat_name'] = '├───' . $data[$m]['_cat_name'];
                        $arr[] = $data[$m];
                    }
                }
            }
        }
        return $arr;
    }
}
