<?php

namespace llianpay\client;

use GuzzleHttp\Client;
use Psr\Http\Message\StreamInterface;

use llianpay\security\LLianPaySignature;

require '../src/security/LLianPaySignature.php';

class LLianPayClient
{
    public static function sendRequest($url, $content,$mch_id): StreamInterface
    {
        if (empty($url)) {
            echo ("[发送请求中]：请求URL非法，请核实！");
        }
        if (empty($content)) {
            echo ("[发送请求中]：请求参数非法，请核实！");
        }

        $signVar = LLianPaySignature::sign($content);

        echo ("[发送请求中]：请求URL为：" . $url);
        echo ("[发送请求中]：请求参数为：: " . $content);
        echo ("[发送请求中]：请求签名值为：: " . $signVar);
        
        $client = new Client();
        // 拼接请求头
        $header = [
            'timestamp' => date("YmdHis"),
            'Signature-Data' => $signVar,
            'Signature-Type' => 'RSA',
            'Content-Type' => 'application/json;charset=UTF-8',
            'mch_id' => $mch_id,
        ];
        // 发送请求
        $response = $client->post($url,
            [
                'body' => $content,
                'headers' => $header,
                'verify' => false
            ]);
        
        echo ("[请求完成]：响应结果为：" . $response->getBody());

        foreach ($response->getHeaders() as $name => $values) {
            foreach ($values as $value) {
                if ($name == 'Signature-Data') {
                    echo ("[请求完成]：响应签名为：" . $value);
                    // 验签
                    $isValid = LLianPaySignature::checkSign($response->getBody(), $value);
                    if ($isValid == 1) {
                        echo ("[请求完成]：验签结果为：正确");
                    } else {
                        echo ("[请求完成]：验签结果为：错误");
                    }
                }
            }
        }
        return $response->getBody();
    }
}