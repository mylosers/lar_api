<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\UserModel;

/**
 * 注册控制器
 * Class RequestController
 * @package App\Http\Controllers\Api
 */
class RequestController extends Controller
{
    /**
     * 注册接口
     */
    public function request(Request $request){
        $name=$request->post('name'); //接受名字
        $pwd1=$request->post('pwd1'); //接受密码
        $pwd2=$request->post('pwd2'); //接受确认密码
        $email=$request->post('email'); //接受邮箱
        if($pwd1!=$pwd2){
            $res=[
                'error'=>50002,
                'msg'=>'两次密码不一致，请重新输入'
            ];
            die(json_encode($res,JSON_UNESCAPED_UNICODE));
        }
        $info=UserModel::where(['email'=>$email])->first();
        if($info){
            $res=[
                'error'=>50003,
                'msg'=>'此邮箱已被注册'
            ];
            die(json_encode($res,JSON_UNESCAPED_UNICODE));
        }
        $pwd=password_hash($pwd1,PASSWORD_BCRYPT);
        $data=[
            'name'=>$name,
            'pwd'=>$pwd,
            'email'=>$email,
            'add_time'=>time()
        ];
        $uid=UserModel::insertGetId($data);
        if($uid){
            $res=[
                'error'=>0,
                'msg'=>'注册成功,排名：'.$uid
            ];
        }else{
            $res=[
                'error'=>60001,
                'msg'=>'注册失败'
            ];
            die(json_encode($res,JSON_UNESCAPED_UNICODE));
        }
        return json_encode($res,JSON_UNESCAPED_UNICODE);
    }
}