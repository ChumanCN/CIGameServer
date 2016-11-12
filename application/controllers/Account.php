<?php

/**
 * 帐号控制器
 */
class Account extends CI_Controller{
    
    //构造函数
    function __construct(){
        parent::__construct();
        $active_group = 'user';
        $this->load->model("User_model", "", TRUE);
    }

    /**
    * 注册帐号
    * 请求的URL：../CIGameServer/Account/Register
    * 请求方法：POST
    * 请求的参数：username和password
    */
    public function Register(){
        $code = $this->User_model->regAction();//0注册成功，1帐号已存在，-1未知错误
        $this->Echo_model->callBack($code);
    }


    /**
    * 注册帐号
    * 请求的URL：../CIGameServer/Account/Login
    * 请求方法：POST
    * 请求的参数：username和password
    */
    public function Login(){
        $code = $this->User_model->loginAction();//0登录成功，-1帐号不存在或密码错误
        $this->Echo_model->callBack($code);
    }

}



?>