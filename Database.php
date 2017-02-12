<?php
/*
Autor: Reginaldo
Objetivo: Classe para conectar com o um SGBD MySQL/PostgreSQL/MSSQL/SQLite
Data: 22/01/2017
*/
class Database
{
	private $drive;
	private $host;
	private $dbname;
	private $user;
	private $pass;
	private $conn;
	
    function Database($drive, $host, $dbname, $user, $pass)
    {
         $this->drive = $drive;
		 $this->host = $host;
		 $this->dbname = $dbname;
		 $this->user = $user;
		 $this->pass = $pass;
    }
    function getDB()
	{
	    if($this->conn instanceof PDO)
			 return $this->conn;
	}
	
	function getDrive()
	{
	    return $this->drive;
	}
	function getHost()
	{
	    return $this->host;
	}
	function getDBname()
	{
	    return $this->dbname;
	}
	function getUser()
	{
	    return $this->user;
	}
	function getPass()
	{
	    return $this->pass;
	}
	
    function conectaBanco()
    {
		$drive = $this->getDrive();
		$host  = $this->getHost();
		$dbname = $this->getDBname();
		$user = $this->getUser();
		$pass = $this->getPass();
		
		//echo "drive= " .$drive. " host= " .$host. " dbname= " .$dbname. " user= " .$user. " pass= " .$pass. "";
         switch($drive)
         {
              case "mysql":
                 $conn = $this->conectaMySQL($host, $dbname, $user, $pass); 
                 break;
              case "mssql":
                 $conn = $this->conectaMSSQL($host, $dbname, $user, $pass);
                 break;
              case "sqlite":
                 $conn = $this->conectaSQLite($dbname);
                 break;
              case "pgsql":
                 $conn = $this->conectaPostgreSQL($host, $dbname, $user, $pass);
                 break;
         }
		 return $conn;
    }

    function conectaMySQL($host, $dbname, $user, $pass)
    {
	    //echo "<br>entrou na função conectaMySQL";
        try{  
        $conexao = new PDO("mysql:host=".$host.";dbname=".$dbname, $user, $pass);
        $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch(PDOException $e){
           echo $e->getMessage();
        }
		return $conexao;
    }
    function conectaMSSQL($host, $dbname, $user, $pass)
    {
        try{
        $conexao = new PDO("mssql:dbname=".$dbname.";host=".$host, $user, $pass);
        $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch(PDOException $e){
           echo $e->getMessage();
        }
		return $conexao;
    }
    function conectaSQLite($dbname)
    {
        try{
        $conexao = new PDO("sqlite:".$dbname);
        $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch(PDOException $e){
           echo $e->getMessage();
        }
		return $conexao;
    }
    function conectaPostgreSQL($host, $dbname, $user, $pass)
    {
        try{ 
        $conexao = new PDO("pgsql:".$host."dbname=".$dbname. $user, $pass);
        $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch(PDOException $e){
           echo $e->getMessage();
        }
		return $conexao;
    }
	
	function executeDML($sql, $arrayParametros, $conn)
	{
	   //echo "<pre>SQL= " .$sql. "</pre>";
	   //echo "<br>" . var_dump($this->conn);
	    try{
		$stmt = $conn->prepare($sql);
		
		for($i=0; $i<sizeof($arrayParametros); $i++)
		{
		    $stmt->bindParam($i+1, $arrayParametros[$i]);
		}
		$stmt->execute();
		
		}catch(PDOException $e) {
		   echo $e->getMessage();
		}
	}
	
	function executeQuery($sql, $id, $conn)
	{
	   try{
	      $query = $conn->prepare($sql);
		  $query->bindParam(1, $id, PDO::PARAM_INT);
		  $query->execute();
	   }catch(PDOException $e) {
	      echo $e->getMessage();
	   }
	   return $query;
	}
}
?>