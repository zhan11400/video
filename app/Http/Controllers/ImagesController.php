<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ImagesController extends Controller
{
    
    /**
    *上传图片
    *filedir //上传目录
    *input   //上传接受缀名
    */
    public function upload(){
        //$var = $request->has('image');
        //var_dump($var);die;
        //var_dump($var);die;
        //$images=Request::file('image'); //1、使用laravel 自带的request类来获取一下文件
        //$filedir="upload/images"; //2、定义图片上传路径
        
        //if($images){
            // $imagesName=$images->getClientOriginalName(); //3、获取上传图片的文件名
            // $extension=$images->getClientOriginalExtension(); //4、获取上传图片的后缀名
            // $newImagesName=md5(time()).random_int(5,5).".".$extension;//5、重新命名上传文件名字
            // $images->move($filedir,$newImagesName); //6、使用move方法移动文件.
            // return [$filedir,$newImagesName];
        //}

        //return null;
    }
}
