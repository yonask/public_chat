<?php
require_once('config.php');

class DB extends mysqli{
	 private static  $_instance=null;  
	private  $mMysqli,$_count=0;
  
  // constructor opens database connection
public function __construct() 
  {   
    
     parent::__construct(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);   
  }

  public static function getInstance() {

        self::$_instance = new DB();
  	return self::$_instance;
  }


}