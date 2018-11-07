<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\HashController;     //密码
use App\Http\Controllers\ImagesController;     //上传图片
use App\Http\Controllers\Admin\BaseController as Base;
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
        return view('admin.index.index',['nav'=>$nav]);
    }

    /**
    * 个人中心
    */
    public function personal_center(Request $request)
    {
        var_dump($this->isAjax());die;
        if(true){
            // $account = $request->input('account');
            // $passwd = $request->input('passwd');

            // if(!empty($account)){
            //     $data['account'] = $account;
            // }

            // if(!empty($passwd)){
            //     $hash = new HashController;
            //     $passwd = $hash->UserPassword($passwd);
            //     $data['password'] = $passwd;
            // }

            // $image = new ImagesController;
            // $image_result = $image->upload('image','upload/images');
            // if(!empty($image_result)){
            //     $image_result = implode("", $image_result);
            //     $data['head_image'] = $image_result;
            // }
            

            // $result = db('admin')->where(['id'=>$this->info['id']])->update($data);
            // if(!$result)return $this->error('修改失败!');
            // $this->success('修改成功');
        }

        $admin = new Admin();
        $info = $admin->find($this->user_info['account']);
        $info['logintime'] = date('Y-m-d H:i:s', $info['logintime']);
        return view('admin.index.personal_center',['info'=>$info]);
    }
}
