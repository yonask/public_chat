<?php  
require_once(dirname(__DIR__).'/database/DB.php');
require_once('class.user.php');
class Validate{
	private $_passed=false,
	        $_errors=array(),
	        $_db=null;
	public function __construct(){
		$this->_db= DB::getInstance();
	}
	public  function check ($source, $items=array()) {
           foreach($items as $item =>$rules) {
               foreach($rules as $rule=>$rule_value) {
               	 $value=trim($source[$item]);
               	 $item=mysql_real_escape_string($item);
	              if($rule==='required' && empty($value)){
                    $this->addError("{$item} is required");
	              }else if(!empty($value)){
	              	switch($rule) {
	              		case 'min':
	              		      if (strlen($value)<$rule_value) {
	              		      	$this->addError("{$item} must be a minimun of {$rule_value} characters.");
	              		      }
	              		break;
	              		case 'max':
	              		     if (strlen($value)>$rule_value) {
	              		      	$this->addError("{$item} must be a maximum of {$rule_value} characters.");
	              		      }
	              		break;
	              		case 'matches':
	              		     
	              		      if($value!=$source[$rule_value]){
	              		      	$this->addError("{$rule_value} must match  {$item}");
	              		      
	              		      }
	              		break;
	              		case 'email':
                              if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
								 //$emailErr = "Invalid email format"; 
								 $this->addError("{$item} Invalid format");
							  }
	              		break;
	              		case 'unique':
	              		        $user= new User();
                                $check=$user->get($rule_value,$item,$value );
                       	        if($check){
	              		        	$this->addError("{$item} already exists.");
	              		        }
	              		break;
	              	}

	              }
               }
           }
           if(empty($this->_errors)){
              $this->_passed=true;
           }

           return $this;
	}

	public function addError($error) {
		$this->_errors[]=$error;
	}
	public function errors(){
		return  $this->_errors; 
	}
	public function passed(){
		return $this->_passed;
	}

   





}