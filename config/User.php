<?php


class User {

	private $db;

    // object properties
    public $id;
    public $username;
    public $email;
    public $password;
    public $verfiykey;
    public $active;

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

    /*
        this function will genrate activation link to send it later to activate the user account  
        we you the time and the username
    */
    public function generateActivationUserLink($username)
    {
        $vkey=md5(time().$username);
        return $vkey;
    }


	public function create()
	{
		    $query = $this->db->prepare('INSERT  INTO users (username, email, password , verfiykey) VALUES (:username, :email, :password, :verfiykey)');
		    
		    // sanitize && some security tips 

		    $this->username=htmlspecialchars(strip_tags($this->username));
    		$this->email=htmlspecialchars(strip_tags($this->email));
    		$this->password=password_hash($this->password, PASSWORD_BCRYPT);
            $this->verfiykey=$this->generateActivationUserLink($this->username);

            
			// bind the values

    		$query->bindParam(':username', $this->username);
    		$query->bindParam(':email', $this->email);
            $query->bindParam(':password', $this->password);
    		$query->bindParam(':verfiykey', $this->verfiykey);

    		//after we prepare our query we call the CheckUserExsit function if no error we will excute the query

    		if($this->CheckUserExsit($this->email)){
    			return 'this user is alreday register';
    		}else{
    			if($query->execute())
                {
                    return true ;
                }
    		}

	}

    //this function to send link verification to new users

    public function sendEmail($email,$vkey)
    {
        $to = $email;
        $subject ="Email Verification";
        $message ="<a href='http://localhost/hamdi/index.php?page=user&action=verify&key=$vkey'";

        mail($to,$subject,$message);

        return header('location:thankyou.php');


    }





}