<?php  
    class DB_Fonctions {

        private $conn;
    
        // constructor
        function __construct() {
            require_once 'ConnectDB.php';
            // connecting to database
            $db = new ConnectDB();
            $this->conn = $db->connect();
        }
        public function AddUser($Name,$LastName,$Email,$Password,$gender,$PhoneNumber){
        	$rqaddUser="INSERT INTO USER(id_user, uuid, hachuuid, DateCreated, Name,LastName, PhoneNumber, Status, Email,Password,Gender,Salt,type) VALUES (NULL, :uuid, :hachuuid, NOW(), :Name, :LastName, :PhoneNumber,:Status, :Email,:Password,:Gender,:Salt,:type);";
        	// status active.. default value 
        	$type="user";
        	$Status="active";
			
			$hash = $this->hachdata($Password);
			
			$encrypted_password = $hash["hachdata"]; // encrypted password
			$salt=$hash['salt'];
			
			$uuid=str_replace(['+', '/', '='], ['-', '_', ''],md5(uniqid('', true)));
			
			$h=$this->hachdata($uuid);
			
			$hachuuid=$h['hachdata'];
			

        	$statement = $this->conn->prepare($rqaddUser);
        	$statement->bindParam(":uuid",$uuid);
        	$statement->bindParam(":hachuuid",$hachuuid);
        	$statement->bindParam(":Name",$Name);
        	$statement->bindParam(":LastName",$LastName);
        	$statement->bindParam(":PhoneNumber",$PhoneNumber);
        	$statement->bindParam(":Status",$Status);
        	$statement->bindParam(":Salt",$salt);
        	$statement->bindParam(":Email",$Email);
        	$statement->bindParam(":Password",$encrypted_password);
        	$statement->bindParam(":Gender",$gender);
        	$statement->bindParam(":type",$type);

        	$result=$statement->execute();
        	if($result){
            	$stmt = $this->conn->prepare('SELECT id_user,Name,LastName,PhoneNumber,Status,Gender,type FROM USER WHERE Email = :Email');
            	$stmt->bindParam(":Email",$Email);

            	$stmt->execute();
            	$user=$stmt->fetchAll()[0];
	            if ($user) {
	            	//user is seccsfuly added

	                return array('id_user'=>$user['id_user'],'Name'=>$user['Name'],'LastName'=>$user['LastName'],'PhoneNumber'=>$user['PhoneNumber'],'Status'=>$user['Status'],'Gender'=>$user['Gender'],'type'=>$user['type']);
	            }else{
	            	//connection error
	                return NULL;
	            }
        	}else{
        		return NULL;
        	}
            

        }
		public function getUserByEmailAndPassword($Email, $Password) {

		    $que="SELECT id_user,Salt,Password FROM USER WHERE Email = :Email ";
		    $stmt= $this->conn->prepare($que);
		    $stmt->bindParam(":Email",$Email);
		    
		    $stmt->execute();
		    if (!$stmt->rowCount()==0) {
		        $result=$stmt->fetchAll();
		        foreach ($result as $row){
		        	// print_r($row);
		            $encrypted_password = $row['Password'];
		            $salt=$row['Salt'];
		            $hach = $this->checkhachdata($salt,$Password);
		            
		            // check for password equality
		            if ($encrypted_password === $hach) {
		                // user authentication details are correct
		                
		                return $row;
		            }else{
		                

		                return NULL;
		            }
		        }
		    } else {
		        

		        return NULL;
		    }
		    // return $result;
		}
        public function isUserExisted($Email) {
	        $stmt = $this->conn->prepare('SELECT Email from USER WHERE Email = :Email'); 
	        $stmt->bindParam(":Email",$Email);
	        $stmt->execute();
	        $num_rows=$stmt->rowCount();
	        if ($num_rows!=0) {
	            return true;
	        } else {
	            return false;
	        }
	    }
    	public function hachdata($data) {
	 
	        $salt = sha1(rand());
	        $salt = substr($salt, 0, 10);
	        $encrypted = base64_encode(sha1($data . $salt, true) . $salt);
	        $hash = array("salt" => $salt, "hachdata" => $encrypted);
	        return $hash;
	    }
	    public function checkhachdata($salt, $data) {
		 
		        $hash = base64_encode(sha1($data . $salt, true) . $salt);
		 
		        return $hash;
		}
    }
    // $Db=new DB_Fonctions();
    // $Db->AddUser($Name,$LastName,$Email,$Password,$gender);
    // print_r($Db->AddUser("Tarek","brahmi","Tarek@gmail.com","Tarek","Homme","1234567"));
    // print_r($Db->getUserByEmailAndPassword("Tarek@gmail.com","Tarek"));
    // print_r($Db->Hach("tarek"));
?>