<?php

/**
 * 
 */
class User_model extends CI_Model
{
    
    //帐号id
    public $id;

    //帐号
    public $username;

    //密码
    public $pwd;

    //帐号权限
    public $uright;

    //帐号密钥--32位
    public $token;

    //注册时间
    public $regtime;

    function __construct(){
        parent::__construct();
        $this->config->load('message');
    }

    //帐号是否存在
    private function isExist(){
        $this->db->where("username", $this->username);
        $result = $this->db->get("account")->result();
        return count($result) > 0;
    }

    //注册操作
    public function regAction(){
        $this->username = $this->input->post("username");
        $this->pwd = $this->authPwd($this->input->post("password"));
        if($this->isExist()){
            return $this->config->item('Result')["REG_USERNAMEISEXIST"];
        }
        $data = array(
            "username"  =>  $this->username,
            "pwd"       =>  $this->pwd,
            "uright"    =>  0,
            "token"     =>  md5(time().$this->config->item('pwdtoken')),
            "regtime"   =>  date("Y-m-d H:i:s",time())
        );
        if($this->db->insert('account', $data)){
            return $this->config->item('Result')["SUCCESS"];
        }
        return $this->config->item('Result')["UNKNOW"];
    }

    //登录操作
    public function loginAction(){
        $this->username = $this->input->post("username");
        $this->pwd = $this->authPwd($this->input->post("password"));
        $this->db->where("username", $this->username);
        $this->db->where("pwd", $this->pwd);
        $result = $this->db->get("account")->result();
        //print_r($result);die;
        if (count($result) == 1) {
            $this->id     =  $result[0]->id;
            $this->uright =  $result[0]->uright;
            $this->token  =  $result[0]->token;
            if ($this->uright == -1) {
                return $this->config->item('Result')["LOG_FATALURIGHT"];
            }
            return $this->config->item('Result')["SUCCESS"];
        }
        return $this->config->item('Result')["UNKNOW"];
    }


    //密码加密方式
    private function authPwd($pass){
        return md5(md5($pass).$this->config->item('pwdtoken'));
    }

}

?>