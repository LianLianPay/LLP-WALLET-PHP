<?php

namespace llianpay\security;

class LLianPaySignature
{

    /**
     * 对数据先进行MD5处理，后使用私钥进行RSA加签
     * @param $data 待加签数据
     * @return string 返回签名
     */
    public static function sign($data = '')
    {
        echo "签名逻辑";
        if (empty($data)) {
            echo ("[加签处理中]：待加签数据为空，请核实！");
            return False;
        }

        $private_key = self::_get_pem_content('/keys/merchant_private_key.pem');
        if (empty($private_key)) {
            echo ("[加签处理中]：私钥错误，请核实！");
            return False;
        }

        $pkeyid = openssl_get_privatekey($private_key);
        if (empty($pkeyid)) {
            echo("[加签处理中]：私钥错误，请核实！2");
            return False;
        }

        // 对数据进行MD5处理
        $md5Var = md5($data);
        echo ("[加签处理中]：待签名源内容：" . $data);
        echo ("[加签处理中]：待签名源内容对应MD5值为：" . $md5Var);
        
        // 使用数据的MD5值和私钥进行RSA加密
        $verify = openssl_sign($md5Var, $signature, $pkeyid, OPENSSL_ALGO_MD5);
        $result = base64_encode($signature);
        echo ("[加签处理中]，签名值为：" . $result);
        return $result;
    }

    /**
     * 利用连连公钥和进行验签
     * @param $data 待验证数据
     * @param $signature 签名值
     * @return -1:error验签异常 1:correct验证成功 0:incorrect验证失败
     */
    public static function checkSign($data = '', $signature = '')
    {
        if (empty($data) || empty($signature)) {
            echo ("[验签处理中]：待验签数据或签名值为空，请核实！");
            return False;
        }

        $public_key = self::_get_pem_content('/keys/llianpay_public_key.pem');
        if (empty($public_key)) {
            echo ("[验签处理中]：验签公钥错误，请核实！");
            return False;
        }

        $pkeyid = openssl_get_publickey($public_key);
        if (empty($pkeyid)) {
            echo ("[验签处理中]：验签公钥错误，请核实！");
            return False;
        }

        // 对数据进行MD5处理
        $md5Var = md5($data);
        echo ("[验签处理中]：待验签数据为：" . $data);
        echo ("[验签处理中]：待验签数据对应MD5值为：" . $md5Var);
        echo ("[验签处理中]：待验签名值为：" . $signature);

        // 使用数据的MD5值和签名值进行RSA校验
        $ret = openssl_verify($md5Var, base64_decode($signature), $pkeyid, OPENSSL_ALGO_MD5);
        switch ($ret) {
            case 0:
                echo ("[验签处理中]：验签完成，验签结果为：错误");
                break;
            case 1:
                echo ("[验签处理中]：验签完成，验签结果为：正确");
                break;
            default:
            echo ("[验签处理中]：验签异常！");
                break;
        }
        return $ret;
    }

    private static function _get_pem_content($file_path)
    {
        return file_get_contents(dirname(__FILE__, 3) . $file_path);
    }
}