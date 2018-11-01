<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

abstract class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * @var Response 响应
     */
    protected $response;

    public function __construct()
    {
        $this->response = response();
    }

    /**
     * 输出 Json 信息
     * @param $data
     * @return \Illuminate\Http\JsonResponse
     */
    protected function jsonResult($errcode, $data = null,$message = null)
    {
        $message = empty($message) ? config('errors.'.$errcode) : $message;

        $content = ['errcode' => $errcode, 'message' => $message];
        if(empty($data) === false){
            $content['data'] = $data;
        }

        $this->response = $this->response->json($content)
            ->header('Pragma','no-cache')
            ->header('Cache-Control','no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        return $this->response;
    }
}
