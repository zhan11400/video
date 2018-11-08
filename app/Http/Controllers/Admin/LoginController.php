<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\BaseController;
use App\User;
use Illuminate\Http\Request;
use Gregwar\Captcha\CaptchaBuilder;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class LoginController extends BaseController
{
    //登录
    public function login(){
        if(request()->isMethod("POST")){
            $data=request()->input("data");
            if($data['vertify']!=Session::get("code")){
                //return $this->ajaxReturn(-1,'验证码不正确');
            };
            $db_admin=DB::table("admin");
            $user=$db_admin->where("name",$data['username'])->select("password","id",'name',"salt","role_id")->first();
            if(empty($user)){
                return $this->ajaxReturn(-1,'用户不存在');
            };
           if($data['password'].$user->salt!= Crypt::decrypt($user->password)){
               return $this->ajaxReturn(-1,'密码不正确');
           }
            $user->role_id;
            $act_list=DB::table("admin_role")->where("id",$user->role_id)->pluck("act_list");
            Session::put("act_list",$act_list);
            Session::put("admin",$user);
            add_admin_log('登录后台');
            $ips=ipGetArea();
            $last['last_ip']=$ips['ip'];
            $last['last_login']=time();
            $db_admin->where("name",$data['username'])->update($last);
            return $this->ajaxReturn();
        }
        return view("admin.login");
    }
    //验证码
    public function code(){
        //生成验证码图片的Builder对象，配置相应属性
        $builder = new CaptchaBuilder;
        //可以设置图片宽高及字体
        $builder->build($width = 100, $height = 40, $font = null);
        //获取验证码的内容
        $phrase = $builder->getPhrase();
       // var_dump($phrase);
        //把内容存入session
        Session::flash("code",$phrase);
       // ob_clean(); //清除缓存
        return response($builder->output())->header('Content-type','image/jpeg'); //把验证码数据以jpeg图片的格式输出

    }
    //登录
    public function crypt(){
      //  echo Crypt::encrypt('123456');
        $str='eyJpdiI6Ik5UVFY2dWozVXpwNEN4NEVtSE1yYUE9PSIsInZhbHVlIjoicmhPcHEzMU9Hczk1REdTXC9aY0lUZFE9PSIsIm1hYyI6ImMxMDczYmZlZDdjM2U0MzZhNDVkNWRhNTRiNjhkYzA0OTU4ZDhkZDVhYjI1MzhkNWRmYjYwN2Y0MDhiNTU4OTkifQ==';
       echo  Crypt::decrypt($str);
    }
}
