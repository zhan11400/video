<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\BaseController as Base;
use App\Http\Controllers\HashController;                    //密码
use App\Http\Controllers\ImagesController;                  //上传图片
use App\Model\Admin\Admin;

class IndexController extends Base
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$nav=config('nav');
        return view('admin.index.index',['nav'=>$nav['Admin']]);
    }

    /**
    * 个人中心
    */
    public function personal_center()
    {
        $admin = new Admin();
        if($this->isAjax()){
            $account = $this->request->input('account');
            $passwd = $this->request->input('passwd');
            
            if(!empty($account)){
                $data['account'] = $account;
            }

            if(!empty($passwd)){
                $hash = new HashController;
                $passwd = $hash->UserPassword($passwd);
                $data['password'] = $passwd;
            }

            $image_result = $this->upload_img('image');

            if(!empty($image_result)){
                $data['head_image'] = $image_result;
            }
            
            $data['logintime'] = time();
            $data['ip'] = $_SERVER['REMOTE_ADDR'];

            $result = $admin->update_compile($data,$this->user_info['id']);
            if(!$result)$this->jsonResult(60009);
            die;
        }

        $info = $admin->find($this->user_info['account']);
        $info['logintime'] = date('Y-m-d H:i:s', $info['logintime']);
        return view('admin.index.personal_center',['info'=>$info]);
    }
}
