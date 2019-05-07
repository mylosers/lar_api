<?php

namespace App\Http\Controllers\Text;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TextController extends Controller
{
    public function base64Test()
    {
        $str = 'Hello World';
        echo base64_encode($str);
    }
    public function testBase64Decode(Request $request)
    {
        $base64_str = $request->input('b64');
        echo 'Base64: '.$base64_str;echo '</br>';
        echo base64_decode($base64_str);
    }
    public function userInfo(Request $request)
    {
        //$uid = $request->input('uid');
        $user_info = [
            'nickname'  => 'zhangsan北京天安门',
            'email'     => 'zhangsan@qq.com'
        ];
        $json_str = json_encode($user_info,JSON_UNESCAPED_UNICODE);
        $b64_str = base64_encode($json_str);
        echo $b64_str;
    }
    /**
     * 发起接口请求
     */
    public function testCurl()
    {
        $url = 'http://1809.api.com/curlGet?id=11';
        // 创建一个新cURL资源
        $ch = curl_init();
        // 设置URL和相应的选项
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        // 抓取URL并把它传递给浏览器
        $rs = curl_exec($ch);
        $code = curl_errno($ch);
        var_dump($code);
        // 关闭cURL资源，并且释放系统资源
        curl_close($ch);
    }

    /**
     * 中间件测试
     */
    public function text(){
        echo __METHOD__;
    }
}