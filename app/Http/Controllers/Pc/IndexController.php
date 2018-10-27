<?php
namespace App\Http\Controllers\Pc;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Pc\BaseContrller as Base;

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
        var_dump($this->request);die;
        echo 'Hello world!';
    }
}
