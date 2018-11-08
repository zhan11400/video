<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Admin\Admin;
use Session;
use DB;

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

    /**
    * 上传图片方法
    *
    */
    protected function upload_img($file,$upload_path='upload/admin'){
        $var = $request->has($file);
        var_dump($var);die;
        $images=Request::file($file); //1、使用laravel 自带的request类来获取一下文件
        
        if($images){
            $imagesName=$images->getClientOriginalName(); //3、获取上传图片的文件名
            $extension=$images->getClientOriginalExtension(); //4、获取上传图片的后缀名
            $newImagesName=md5(time()).random_int(5,5).".".$extension;//5、重新命名上传文件名字
            $images->move($upload_path,$newImagesName); //6、使用move方法移动文件.
            return [$upload_path,$newImagesName];
        }

        return null;
    }
}
