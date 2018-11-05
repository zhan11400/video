<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Session;

class BaseController extends Controller
{
    public function __construct(){
    	$user_info = Session::get('user_info');

    	if(empty($user_info)){
    		die(redirect("/admin/login"));
		}

		view()->share('user_info', $user_info);
    }
}
