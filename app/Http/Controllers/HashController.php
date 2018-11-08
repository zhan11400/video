<?php
namespace App\Http\Controllers;

use Hash;
use App\Http\Controllers\Controller;

class HashController extends Controller
{
    /**
     * 生成密码
     * @param  [type] $tmp [description]
     * @return [type]      [description]
     */
    public function UserPassword($pass)
    {
        if(empty($pass))return false;
        if(Hash::make($pass)){
            return Hash::make($pass);
        }else{
            return false;
        }
    }

    /**
    *  检测密码
    *
    */ 
    public function UserPasswordCheck($pass,$hashedPassword)
    {
        if(empty($pass) || empty($hashedPassword))return false;
        if (Hash::check($pass, $hashedPassword)) {
            return true;
        }else{
            return false;
        }
    }
}
