<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\UserModel;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Redis;
/**
 * 登陆控制器
 * Class LoginController
 * @package App\Http\Controllers\Api
 */
class LoginController extends Controller
{
    /**
     * 登陆接口
     */
    public function login(Request $request){
        $email=$request->post('email'); //邮箱
        $pwd=$request->post('pwd');     //密码
        $uid=UserModel::where(['email'=>$email])->first();
        if($uid){
            //判断密码是否正确
            $info=password_verify($pwd,$uid->pwd);
            if($info==true){
                //执行登陆
                //生成token
                $token=$this->token($uid->id);
                $key='login_token';
                Redis::setex($key,3600,$token.','.$uid->id);
                $val=Redis::get($key); //查询key值中的val值
                $arr=explode(',',$val); //根据，切割字符串为数组 explode
                $res=[
                    'error'=>0,
                    'msg'=>'登陆成功'
                ];
                die(json_encode($res,JSON_UNESCAPED_UNICODE));
            }else{
                //密码不正确
                $res=[
                    'error'=>50005,
                    'msg'=>'密码不正确'
                ];
                die(json_encode($res,JSON_UNESCAPED_UNICODE));
            }
        }else{
            //查无此人
            $res=[
                'error'=>50004,
                'msg'=>'没有此用户'
            ];
            die(json_encode($res,JSON_UNESCAPED_UNICODE));
        }
    }

    /**
     * token
     */
    public function token($id){
        return substr(sha1($id.time().Str::title(10)),5,15);
    }
}