<?php
/**
 * 控制器基类.
 * member: chan
 * Date: 2017/10/20 11:36
 */
namespace App\Http\Controllers\Pc;

use App\Http\Controllers\Controller;

class BaseContrller extends Controller
{
    public function __construct(){
        $this->request = '123';
    }
}