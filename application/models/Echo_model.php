<?php
/**
 * 
 */
class Echo_model extends CI_Model
{
    

    public $params = array();

    function __construct(){
        # code...
    }

    //返回信息
    public function callBack($_code, $_msg="", $_params=NULL){
        $msg = array();
        $msg["code"] = $_code;
        $msg["message"] = $_msg;
        if ($_params != NULL && is_array($_params)) {
           foreach ($_params as $key => $value) {
               $params[$key] = $value;
           }
           $msg["params"] = $params;
        }
        echo json_encode($msg);
    }

}

?>