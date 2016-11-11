<?php



/** * account regist control  */


class Register extends CI_Controller
{
	
	
	//_	_construct function
	
	function __construct()
	{
		
		
		parent::__construct();
		
		
		$this->load->database();
		
		
	}
	
	
	
	public function Check()
	{
		
		
		$this->Init();
		
		
	}
	
	
	
	//初	始化并且检测该账号表是否存在，不存在将建立表格
	private function Init(){
		
		
		$this->load->dbutil();
		
		
		if(!$this->dbutil->table_exists("account")){
			
			
		}
		
		
		else {
			
			
		}
		
		
		
	}
	
	
}




?>