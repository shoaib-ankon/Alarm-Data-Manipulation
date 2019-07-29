<?php

class csv extends mysqli 
{
	function __construct()

	{
		parent::__construct("localhost","root","","ipasso");
		if($this->connect_error){
			echo "file to connect to the database".$this->connect_error;

		}
	}

public function import($file)
{
	$file=fopen($file,'r');
	while ($row=fgetcsv($file)){
		
		while ($row=fgetcsv($file)){
			$value="'".implode("','", $row)."'";
			$q="INSERT INTO cata (blank, occur, link, alarm, status, state, ip, hexa, anblank, location)  VALUES(".$value.")";
			if ($this->query($q)){
				$this->state_csv=true;}
				else{
					$this->state_csv=false;
					echo $this->error;
				}
			
		

		}
	}
}

}


  ?>
