<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件
function status($status){
    if($status ==1){
        $str ="<span class='label label-success radius'>正常</span>";
    } elseif($status ==0){
        $str ="<span class='label label-danger radius'>待审</span>";
    }else{
        $str ="<span class='label label-danger radius'>删除</span>";
    }
    return $str;
}

/**
 * @param $url
 * @param int $type 0 get 1 post
 * @param array $data
 */
function doCurl($url,$type=0,$data=[]){
    $ch = curl_init();//初始化
    //设置选项
    curl_setopt($ch,CURLOPT_URL,$url);//url常量
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);//如果我们成功只返回结果，不把内容输出来，就通过这样形式
    curl_setopt($ch,CURLOPT_HEADER,0);//header头输出

    if($type=1){
        //post方式
        curl_setopt($ch,CURLOPT_POST,1);
        curl_setopt($ch,CURLOPT_POSTFIELDS,$data);
    }

    //执行并获取内容
    $output = curl_exec($ch);
    //释放curl句柄
    curl_close($ch);
    return $output;
}

//商户入驻申请文案
function bisRegister($status){
    if ($status ==1){
        $str = "入驻申请成功";
    }elseif ($status == 0){
        $str = "待审核，审核后及时通知";
    }elseif ($status == -1){
        $str ="抱歉，审核失败，请确认您提交的资料是否属实";
    }else{
        $str ="审核已过期";
    }
}