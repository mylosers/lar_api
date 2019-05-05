<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\UserModel;

class UserApiController extends Controller
{
    public function user_get(Request $request){
        //获取id
        $id=$request->input('uid');

        //根据uid查数据
        $info=UserModel::where(['id'=>$id])->first();

        //判断数据
        if($info){
            $data=[
                'error'=>0,
                'msg'=>'ok',
                'data'=>$info->toArray()
            ];
        }else{
            $data=[
                'error'=>50001,
                'msg'=>'查无此人',
            ];
        }
        $data=json_encode($data);
        return $data;
    }
}