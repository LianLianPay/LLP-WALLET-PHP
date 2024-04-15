<?php

use llianpay\client\LLianPayClient;
use llianpay\params\EnterpriseCreateParams;

require '../vendor/autoload.php';
require '../src/cfg.php';
require '../src/client/LLianPayClient.php';
require '../src/params/EnterpriseCreateParams.php';

// 测试“创建公司主体”接口https://cwallet-openapi.lianlianpay-inc.com/corp/v1/enterprise/create
function test_enterprise_create()
{
    // 构建请求参数
    echo "开始构建入参\n";
    $params = new llianpay\params\EnterpriseCreateParams();
    $params->mch_id = '402404150000089423';
    $params->enterprise_id = 'YourEnterpriseId';
    $params->enterprise_name = '测试公司主体';
    $params->enterprise_tax = '1234567890';
    $params->standard_currency = 'CNY';
    $params->taxpayer_type = 'GENERAL';
    $params->address = '连连大厦';
    $params->telephone = '86500000';
    $params->taxpayer_type = 'GENERAL';
    $params->bank_name = '开户行名称';
    $params->bank_account_no = '2400000000000';

    // echo json_encode($params);
    // 测试环境地址
    $url = 'https://cwallet-openapi.lianlianpay-inc.com/corp/v1/enterprise/create';
    $result = LLianPayClient::sendRequest($url, json_encode($params), $params->mch_id);
    echo $result;
}
date_default_timezone_set('Asia/Shanghai');
test_enterprise_create();

?>