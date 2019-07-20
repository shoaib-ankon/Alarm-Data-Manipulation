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
		print "<pre>";
		print_r($row);
		print "</pre>";
		while ($row=fgetcsv($file)){
			$value="'".implode("','", $row)."'";
			$q="INSERT INTO cata(link,alarm,start,endt,type,ip,status,location,extra) VALUES(".$value.")";
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