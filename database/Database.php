<?php
require_once(dirname(__DIR__).'/database/DB.php');
class Database{
	
	private $db,
	        $_query,
	        $_error=false, 
	        $_results,
	        $_count=0;
		public function __construct(){
			
			    $this->db= DB::getInstance();
		
			if(mysqli_connect_errno()) {
	 
				echo "Error: Could not connect to database.";
	 
			exit;
 
			}
		}


 public function insert($tablename, $parameter_order, $values)
      
      {
        $_query = "insert into $tablename (";
        foreach($parameter_order as $po)
        {
          $_query .= $po.', ';
        }
        $_query = substr($_query,0,strlen($_query)-2).') values (';
      foreach($values as $v)
      {
      $_query .= "'$v', ";
      }
      $_query = substr($_query,0,strlen($_query)-2).');';
      //echo $_query;
      // var_dump($_query);
        return $this->makeQuery($_query);
      }

  function makeQuery($_query)
      {
          //echo $_query;
        $this->_results = $this->db->query($_query);
        if($this->_results) {
           $this->_count=1;
        }
        else { 
          //$this->_result="Error in query execution "
           $_error=true;
        }
        //var_dump($this);

        return $this;

      }




}

?>