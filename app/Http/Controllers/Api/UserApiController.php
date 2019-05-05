<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\UserModel;

class UserApiController extends Controller
{
    /**
     * @param Request $request
     * @return array|mixed|string|void
     * get 接口测试
     */
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
        $data=json_encode($data,JSON_UNESCAPED_UNICODE);
        return $data;
    }

    /**
     * post接口测试
     */
    public function user_post(Request $request){
        //获取数据
        $name=$request->post('name');
        $email=$request->post('email');
        //查询数据库，判断是否存在
        $info=UserModel::where(['name'=>$name])->first();
        if($info){
            $data=[
                'error'=>50001,
                'msg'=>"已被注册"
            ];
        }else{
            $data_info=[
                'name'=>$name,
                'email'=>$email
            ];
            $id=UserModel::insertGetId($data_info);
            if($id){
                $data=[
                    'error'=>0,
                    'msg'=>'注册成功，排名.'.$id
                ];
            }else{
                $data=[
                    'error'=>60001,
                    'msg'=>'注册失败'
                ];
            }
        }
        $data=json_encode($data,JSON_UNESCAPED_UNICODE);
        return $data;

    }
}