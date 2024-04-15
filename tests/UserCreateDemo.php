<?php

use llianpay\client\LLianPayClient;
use llianpay\params\UserCreateParams;

require '../vendor/autoload.php';
require '../src/cfg.php';
require '../src/client/LLianPayClient.php';
require '../src/params/UserCreateParams.php';

// 测试“创建用户”接口https://cwallet-openapi.lianlianpay-inc.com/corp/v1/user/create
function test_user_create()
{
    // 构建请求参数
    echo "开始构建入参\n";
    $params = new llianpay\params\UserCreateParams();
    $params->mch_id = '402404150000089423';
    $params->user_id = 'test4';
    $params->name = '用户名';
    $params->phone = '15000000000';
    $params->email = '1234@lianlianpay.com';
    $params->enable = 'ENABLE';
    $params->work_code = '0004';
 
    // echo json_encode($params);
    // 测试环境地址
    $url = 'https://cwallet-openapi.lianlianpay-inc.com/corp/v1/user/create';
    $result = LLianPayClient::sendRequest($url, json_encode($params), $params->mch_id);
    echo $result;
}
date_default_timezone_set('Asia/Shanghai');
test_user_create();

?>