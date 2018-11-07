<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'admin';
    public $timestamps = false;

    public function find($account){
    	if($this->where('account',$account)->first()){
            return $this->where('account',$account)->first()->toArray();
        }else{
            return [];
        }
    }

    public function update_compile(array $data,$whereid)
    {
        $result=$this->where('id',$whereid)->update($data);
        if(!$result)return false;
        return true;
    }
}
