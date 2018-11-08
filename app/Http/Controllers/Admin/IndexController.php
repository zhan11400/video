<?php

namespace App\Http\Controllers\Admin;

use App\Config;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpKernel\EventListener\ValidateRequestListener;

class IndexController extends BaseController
{
    //首页
    public function index(){
        $info=Session::get("admin");
        $menu=getMenuArr();
        return view("admin.index",['info'=>$info,'menu'=>$menu,

        ]);
    }
    //系统信息
    public function info(){
        $mysqlinfo = DB::select("SELECT VERSION() as version");
        return view("admin.info",['mysql_version'=>$mysqlinfo[0]->version]);
    }
    //退出登录
    public function logout()
    {
       Session::forget("admin");
       return redirect("admin/login");
    }
    //修改密码
    public function pass()
    {

        if(request()->isMethod("POST")){
            //前端后端同时增加验证
          $reles=[
                "data.password_o"=>"required",
                "data.password"=>"required",
            ];
            $message=[
                "data.password_o.required"=>"旧密码不能为空",
                "data.password.required"=>"新密码不能为空",
            ];
            $data=request()->input("data");
            $validator=Validator::make(request()->input(),$reles,$message);
            if($validator->fails()){
                return $this->ajaxReturn(-1,$validator->errors()->first());//获得第一条报错信息
            }
            $admin=Session::get("admin");
            $password=User::where("id",$admin->id)->pluck("password");
            if($data['password_o']!= Crypt::decrypt($password)){
                return $this->ajaxReturn(-1,'旧密码不正确');
            };
            if($data['password']== Crypt::decrypt($password)){
                return $this->ajaxReturn(-1,'新密码与旧密码一致');
            };
            $password=Crypt::encrypt($data['password']);
            $num = DB::table('users')
                ->where('id',$admin->id)
                ->update(['password'=>$password]);
           if($num){
               return $this->ajaxReturn(1,'密码修改成功');
           }
        }
        return view("admin.pass");
    }
    //更改上下架状态
    public function changetab()
    {

        $table=request()->input("table");
        $id=request()->input("id");
        $id_name=request()->input("id_name");
        $field=request()->input("field");
        $model=DB::table($table);
       $pluck=$model->where($id_name,$id)->pluck($field);
       if($pluck[0]){
           $res=$model->where($id_name,$id)->update([$field=>0]);
       }else{
           $res=$model->where($id_name,$id)->update([$field=>1]);
       }
        if($res)  return $this->ajaxReturn(1,'更改成功');
        return $this->ajaxReturn(-1,'更改失败');
    }
    //更改排序
    public function changeorder()
    {

        $table=request()->input("table");
        $id=request()->input("id");
        $id_name=request()->input("id_name");
        $field=request()->input("field");
        $value=request()->input("value");
        $model=DB::table($table);
        $res=$model->where($id_name,$id)->update([$field=>$value]);

        if($res)  return $this->ajaxReturn(1,'更改成功');
        return $this->ajaxReturn(-1,'更改失败');
    }
}
