<?php

namespace App\Http\Controllers\Admin;


use App\Config;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;

class BaseController extends Controller
{
    /**
     * 析构函数
     */
    function __construct()
    {
        // Session::start();
        header("Cache-control: private");
        $web_info=(new Config())->getConfig('web_info');
        View::share(['webname'=>$web_info->web_name]);
        //通过中间件才能调用session
        $this->middleware(function ($request, $next) {

            if(!$this->check_priv()){
                if(request()->isMethod("POST") || request()->isMethod("DELETE")){
                    return $this->ajaxReturn(-1,'权限不够，请联系管理员');
                }
                abort(403,'权限不够，请联系管理员');
            }
            return $next($request);
        });
    }
    public function ajaxReturn($code=1,$msg='ok',$data=array()){
        $list['code']=$code;
        $list['msg']=$msg;
        $list['data']=$data;
        return response()->json($list);
    }
    public function check_priv()
    {
      //  echo '<pre>';
        //dd(session("act_list")[0]);exit;
        $nowAction=request()->route()->getAction();
        $uses=$nowAction['controller'];
      //  var_dump($nowAction);
         $es= substr($uses,strrpos($uses,"\\")+1);
        $ds=explode("@",$es);
        $controller=ucfirst($ds[0]);//首字母大写
        $action=$ds[1];
        $act_list= session('act_list')[0];
        //无需验证的操作
        $uneed_check = array('login','logout','vertifyHandle','vertify','imageUp','upload','login_task');
        if($act_list == 'all' || in_array($controller,['LoginController'])){//手动添加第一个超级管理员
            return true;
        }else{
            $act_list_arr = explode(',', session('act_list')[0]);
            $role_right='';
            $right = DB::table('system_menu')->whereIn("id", $act_list_arr)->pluck('right');
            foreach ($right as $val){
                $role_right .= $val.',';
            }
            $role_right = explode(',', $role_right);
            //检查是否拥有此操作权限
          /* echo $controller.'@'.$action;
            echo '<pre>';
            var_dump($role_right);*/
            if(!in_array($controller.'@'.$action, $role_right)){
                return false;
              //  return '您没有操作权限['.($controller.'@'.$action).'],请联系超级管理员分配权限';
            }
            return true;

        }
    }
}
