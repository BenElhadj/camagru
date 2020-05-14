<?php


class User {

	private $db;

    // object properties
    public $id;
    public $username;
    public $email;
    public $password;

	public function __construct()
	{
		$this->db = database::connection(); // in this line we out the value return from this static function in vairable db 
	}


	/*
	* this function will check the email of the user if it exsist or no if yes it will retrun true  if no it return false
	*/

	public function CheckUserExsit($email)
	{
		$query = $this->db->prepare('SELECT * FROM users WHERE email=:email');
        $query->execute(['email' => $email]);
         if($query->rowCount()){
         	return true ;
         }else{
         	return false;
         }
	}


	public function create()
	{
		    $query = $this->db->prepare('INSERT  INTO users (username, email, password) VALUES (:username, :email, :password)');
		    
		    // sanitize && some security tips 

		    $this->username=htmlspecialchars(strip_tags($this->username));
    		$this->email=htmlspecialchars(strip_tags($this->email));
    		$this->password=password_hash($this->password, PASSWORD_BCRYPT);

            
			// bind the values

    		$query->bindParam(':username', $this->username);
    		$query->bindParam(':email', $this->email);
    		$query->bindParam(':password', $this->password);

    		//after we prepare our query we call the CheckUserExsit function if no error we will excute the query

    		if($this->CheckUserExsit($this->email)){
    			return 'this user is alreday register';
    		}else{
    			if($query->execute()){
                return true;
            }
            else{
                return false;
            }
    		}

	}



}