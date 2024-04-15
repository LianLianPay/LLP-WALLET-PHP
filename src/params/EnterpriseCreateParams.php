<?php

namespace llianpay\params;

class EnterpriseCreateParams
{
    /**
     * 商户唯一编号
     */
    public string $mch_id;
    /**
     * 主体编码
     */
    public string $enterprise_id;
    /**
     * 企业名称
     */
    public string $enterprise_name;
    /**
     * 税号
     */
    public string $enterprise_tax;
    /**
     * 记账本位币
     */
    public string $standard_currency;
    /**
     * 纳税人类型
     * GENERAL|SMALL_SCALE|OTHER
     */
    public string $taxpayer_type;
    /**
     * 企业地址
     */
    public string $address;
    /**
     * 企业电话
     */
    public string $telephone;
    /**
     * 开户行名称
     */
    public string $bank_name;
    /**
     * 开户行号
     */
    public string $bank_account_no;

    
}