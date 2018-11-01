<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Model\Admin\Admin;
use App\Http\Controllers\VerifyController;   //验证码类
use App\Http\Controllers\HashController;     //密码
use Session;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.login.index');
    }

    public function verify_login(Request $request){
        $hash = new HashController;
        $kit = new VerifyController();
        $admin = new Admin();

        //接收指定参数
        $account = $request->input('account');
        $password = $request->input('passwd');
        $code = $request->input('code');
        if(!$kit->check_verify($code))return $this->jsonResult(40101);

        if(empty($account) || empty($password))return $this->jsonResult(40401);

        $result = $admin->find($account);
        if(!empty($result)){
            if(!$hash->UserPasswordCheck($password,$result['password']))return $this->jsonResult(40606);

            
        }else{
            return $this->jsonResult(40506);
        }
    }
}
