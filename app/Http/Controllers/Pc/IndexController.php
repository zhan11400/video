<?php
namespace App\Http\Controllers\Pc;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Pc\BaseContrller as Base;
use App\Admin;


class IndexController extends Base
{
    /**
     * 首页显示
     *
     * @param  int  $id
     * @return Response
     */
    public function index()
    {
        $member = new Admin;
        $member = $member->text();
        foreach ($member as $key => $value) {
            echo $value->password;
        }
        die;
        if(! $member->save()){
            die('修改失败');
        }
    }
}
