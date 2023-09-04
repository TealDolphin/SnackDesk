<?php
require_once "rebuildSQL.php";

// Quest Science Club
	class DatabaseAdaptor{
        private $DB; // The instance variable used in every method below
        
        //c:\xampp\mysql\bin\mysql -u root
        public function __construct() {
            $dataBase= 'mysql:dbname=snacks;charset=utf8;host=127.0.0.1';
            $user= 'root';
            $password= ''; //TODO To be determined   DO NOT LEAVE BLANK
            try {
                $this->DB= new PDO( $dataBase, $user, $password );
                $this->DB->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch ( PDOException$e ) {
				try{
					rebuild();
					
					$this->DB= new PDO( $dataBase, $user, $password );
					$this->DB->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					
				} catch ( PDOException$e ) {
					echo ('Error establishing Connection');
					exit();
				}
            }
        }
        
/*
	PurchaseTable:
	[itterableID, Parent, Student, $, date(time), hotLunch(bool)]
	
	// on negative student means money placed into the account
	
	
	MoneyTable
	[itterableID, Parent, current $]
	
	People Table
	[itterableID, student, parent]
	
	// assumed that most of the time there will be multiple students per parent, but that is easy to reverse lookup if needed.
	
	// all money is in cents. convert before/after calling functions
	
*/

	public function addMoney($parent, $value){
		$parent = htmlspecialchars(trim($parent));
		$value = htmlspecialchars(trim($value));
		
		$command = "SELECT * FROM money WHERE parent = :p";
		$stmt->$this->DB->prepare($command);
		$stmt->bindParam(":p", $parent, PDO::PARAM_STR);
		
		$stmt->execute();
        $arr = $stmt->fetchAll(PDO::FETCH_ASSOC);
		
		if(count($arr) > 0){
			$command = "UPDATE money SET currentMoney = currentMoney + :m WHERE parent = :p";
			$stmt->$this->DB->prepare($command);
			$stmt->bindParam(":p", $parent, PDO::PARAM_STR);
			$stmt->bindParam(":m", $value, PDO::PARAM_STR);
			$stmt->execute();
		}else{
			$command = "INSERT INTO money (parent, currentMoney) VALUES (:p, :m)";
			$stmt->$this->DB->prepare($command);
			$stmt->bindParam(":p", $parent, PDO::PARAM_STR);
			$stmt->bindParam(":m", $value, PDO::PARAM_STR);
			$stmt->execute();
		}
		
		$command = "INSERT INTO purchases (parent, student, pValue, pTime, hotLunch) VALUES (:p, -1, :m, :t, 0)";
		$stmt->$this->DB->prepare($command);
		$stmt->bindParam(":p", $parent, PDO::PARAM_STR);
		$stmt->bindParam(":m", $value, PDO::PARAM_STR);
		$stmt->bindParam(":t", date("Y-m-d H:i:s"), PDO::PARAM_STR);
		$stmt->execute();
	}

    public function purchase($std, $snack, $hLunch){
		$std = htmlspecialchars(trim($std));
		$snack = htmlspecialchars(trim($snack));
		$hLunch = htmlspecialchars(trim($hLunch));
		
		$par = retrieveParent($std);
		$value = 0;
		if($par == 'No parents found for this student.'){
			throw new Exception('No account found error.');
		}
		
		if($snack > 0){
			$command = "INSERT INTO purchases (parent, student, pValue, pTime, hotLunch) VALUES (:p, :s, :m, :d, 0)";
			$stmt->$this->DB->prepare($command);
			$stmt->bindParam(":p", $par, PDO::PARAM_STR);
			$stmt->bindParam(":s", $std, PDO::PARAM_STR);
			$stmt->bindParam(":m", $snack, PDO::PARAM_STR);
			$stmt->bindParam(":d", date("Y-m-d H:i:s"), PDO::PARAM_STR);
			
			$stmt->execute();
			$value = $value + $snack;
		}
		
		if($hLunch > 0){
			$command = "INSERT INTO purchases (parent, student, pValue, pTime, hotLunch) VALUES (:p, :s, :m, :d, 1)";
			$stmt->$this->DB->prepare($command);
			$stmt->bindParam(":p", $par, PDO::PARAM_STR);
			$stmt->bindParam(":s", $std, PDO::PARAM_STR);
			$stmt->bindParam(":m", $hLunch, PDO::PARAM_STR);
			$stmt->bindParam(":d", date("Y-m-d H:i:s"), PDO::PARAM_STR);
			
			$stmt->execute();
			$value = $value + $hLunch;
		}
		
		if($value > 0){
			$command = "UPDATE money SET currentMoney = currentMoney - :m WHERE parent = :p";
			$stmt->$this->DB->prepare($command);
			$stmt->bindParam(":p", $parent, PDO::PARAM_STR);
			$stmt->bindParam(":m", $value, PDO::PARAM_STR);
			$stmt->execute();
		}
		
		return 'success';
	}
	
	public function retrieveParent($std){
		$std = htmlspecialchars(trim($std));
		
		$command = "SELECT * FROM people WHERE student = :s";
		$stmt->$this->DB->prepare($command);
		$stmt->bindParam(":s", $std, PDO::PARAM_STR);
		
		$stmt->execute();
        $arr = $stmt->fetchAll(PDO::FETCH_ASSOC);
		
		if(count($arr) > 0){
			return $arr[0]['parent'];
		}
		return 'No parents found for this student.';
	}
	
	public function parentsList(){
		$l = array();
		$i = 0;
		
		$command = "SELECT DISTINCT parent FROM money ORDER BY parent ASC";
		$stmt->$this->DB->prepare($command);
		
		$stmt->execute();
        $arr = $stmt->fetchAll(PDO::FETCH_ASSOC);
		
		// may be wrong. don't remember single item returns exactly
		foreach($arr as $row){$l[$i++] = $row['parent'];}
		
		return $l;
	}
	
	public function assignParent($std, $par){
		$par = htmlspecialchars(trim($par));
		$std = htmlspecialchars(trim($std));
		
		// As is you can assign an id to a parent and can't change it.
		// Unsure if should leave it or if should make it so it overrides.
		if(retrieveParent($std) == 'No parents found for this student.'){		
			$command = "INSERT INTO people (student, parent) VALUES (:s, :p)";
			$stmt->$this->DB->prepare($command);
			$stmt->bindParam(":s", $std, PDO::PARAM_STR);
			$stmt->bindParam(":p", $par, PDO::PARAM_STR);
			$stmt->execute();
		}
	}
	
	public function addParent($par){
		$par = htmlspecialchars(trim($par));
		
		$command = "INSERT INTO money (parent, currentMoney) VALUES (:p, 0)";
		$stmt->$this->DB->prepare($command);
		$stmt->bindParam(":p", $par, PDO::PARAM_STR);
		$stmt->execute();
	}
	
	
	public function retrieveBal($par){
		$par = htmlspecialchars(trim($par));
		
		
		$command = "SELECT * FROM money WHERE parent = :p";
		$stmt->$this->DB->prepare($command);
		$stmt->bindParam(":p", $par, PDO::PARAM_STR);
		
		$stmt->execute();
        $arr = $stmt->fetchAll(PDO::FETCH_ASSOC);
		
		if(count($arr) > 0){
			return $arr[0]['currentMoney'];
		}
		
		$command = "INSERT INTO money (parent, currentMoney) VALUES (:p, 0)";
		$stmt->$this->DB->prepare($command);
		$stmt->bindParam(":p", $parent, PDO::PARAM_STR);
		$stmt->execute();
		
		return 0;
	}
	
//================== Reference codes to remain commented

//  throw new Exception('Division by zero.');



/* This is how to setup and execute a SQL statement along with the most common filters/commands needed


$stmt->$this->DB->prepare("SELECT column FROM table WHERE column = :to_be_bound");
$stmt->bindParam(":to_be_bound", $str, PDO::PARAM_STR);
$stmt->execute();
$arr = $stmt->fetchAll(PDO::FETCH_ASSOC);


$hashed = password_hash($psw, PASSWORD_DEFAULT);
$stmt->bindParam(':bind_psw', $hashed);

if (count($arr) != 0){
return password_verify($psw, $arr['password']);



*/

// $theDBA is an instance of the database connector and one that we set up this way so we can import this file and it work.
$theDBA = new DatabaseAdaptor();
?>