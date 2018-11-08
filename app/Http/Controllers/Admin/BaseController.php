<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Admin\Admin;
use Session;

class BaseController extends Controller
{
	/**
     * @var \Illuminate\Http\Request 请求对象
     */
    protected $request;

    public function __construct(Request $request){
    	$this->request = $request;
    	
    	$this->user_info = Session::get('user_info');

    	if(empty($this->user_info)){
    		die(redirect("/admin/login"));
		}

		view()->share('user_info', $this->user_info);
    }

    /**
     * 判断是否是POST请求
     * @return bool
     */
    protected function isPost()
    {
        return strcasecmp($this->request->getMethod(),'post') === 0;
    }

    /**
     * 判断是否是GET请求
     * @return bool
     */
    protected function isGet()
    {
        return strcasecmp($this->request->getMethod(),'get') === 0;
    }

    /**
     * 判断是否是ajax请求
     * @return bool
     */
    protected function isAjax()
    {
        return $this->request->ajax();
    }
}
