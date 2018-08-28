<?php 

class Database
{
	private $host = "localhost";
	private $username = "root";
	private $password = "";
	private $databasename= "personnel_mgt";
	private $charset = "utf8mb4";
	protected $db;
	private $prepareVar;
	public $executedVar;
	public function __construct()
	{
		$dsn ="mysql:host=$this->host;dbname=$this->databasename;charset=$this->charset";
		$option = [
			PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
			PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
			PDO::ATTR_EMULATE_PREPARES => false

		];

		try 
		{
			$this->db = new PDO($dsn,$this->username,$this->password,$option);
			if($this->db)
			{
				// echo "Database Connection Successful";
			}
		} 
		catch (\PDOException $e) 
		{
			echo $e;
		}
	}
	public function prepareSql($_sql)
	{
		$this->prepareVar = $this->db->prepare($_sql);
	}
	public function execute(array $var = null)
	{
	 $a = $this->prepareVar->execute($var);
	 if($a)
	 {
	 	return True;
	 }
	 else
	 {
	 	return false;
	 }
		
	}
	public function fetchData()
	{
		$a = $this->prepareVar->fetchAll(PDO::FETCH_ASSOC);
		return $a;
	}
}




 ?>