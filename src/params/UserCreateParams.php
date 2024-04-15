<?php

namespace llianpay\params;

class UserCreateParams
{
    
    /**
     * 商户号
     */

    public string $mch_id;
    /**
     * 用户唯一编号
     */
    public string $user_id;
    /**
     * 用户名称
     */
    public string $name;
    /**
     * 用户手机号
     */
    public string $phone;
    /**
     * 用户邮箱
     */
    public string $email;
    /**
     * 人员职级
     */
    public string $rank;
    /**
     * 用户性别
     */
    public string $sex;
    /**
     * 工号
     */
    public string $work_code;
    /**
     * 证件号
     */
    public string $cert_no;
    /**
     * 证件类型
     */
    public string $cert_type;
    /**
     * 用户状]
     */
    public string $enable;
    /**
     * 用户所属法人主体id
     */
    public string $enterprise_id;
    /**
     * 入职日期
     */
    public string $hiring_date;
    /**
     * 直属领导用户唯一编号
     */
    public string $leader_user_id;
    /**
     * 税号
     */
    public string $taxNo;
    
}