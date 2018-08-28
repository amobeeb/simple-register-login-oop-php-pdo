<?php 
spl_autoload_register(function($class_name)
{
	include $class_name.'.class.php';
});

class User extends Database
{
	private $fullname;
	private $username;
	private $password;
	public $sessionid;
	
	function __construct()
	{
		parent::__construct();
	}
	public function setFullname($_fullname)
	{
		$this->fullname = $_fullname;
	}
	public function setUsername($_username)
	{
		$this->username = $_username;
	}
	public function setPassword($_password)
	{
		$this->password = $_password;
	}
	public function getFullname()
	{
		return $this->fullname;
	}
	public function getUsername()
	{
		return $this->username;
	}
	public function getPassword()
	{
		return $this->password;
	}
	public function login()
	{
		parent::prepareSql("SELECT * FROM `user` WHERE `username`=? AND `password`=?");
		parent::execute(array($this->getUsername(), $this->getPassword()));
		$row = parent::fetchData();
		if($row)
		{
			foreach($row as $rows)
			{
				$uid = $rows['user_id'];
			}

			$login_session = self::loginSession($uid);
			$this->sessionid = $login_session;

			return True;
		}
		else
		{
			return False;
		}
	}
	public static function loginSession($user_id=null)
	{
		session_start();
		$_SESSION['user_id'] = $user_id;
		return  $_SESSION['user_id'];
	}
	public static function loginSession_id()
	{
		session_start();
		return $_SESSION['user_id'];
	}
	public function logout()
	{

	}
	
	

	
}

// $user = new User();

// $user->prepareSql("SELECT * FROM `user`");
// $user->execute();

// while($a = $user->fetchData())
// {
// 	echo $a['username']."<br/>";
// }

 ?>