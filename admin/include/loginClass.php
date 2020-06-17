<?php

require_once 'connection.php';

$session['user']= new connection();

class Login
{
	private username;
	private password;
	
	   function login($username, $password, $table_name)
    {
        echo "-->" . $username . "<br>" . $password . "<br>" . $table_name;
        // Fetch data from database on the basis of username/email and password
        if ($username == "admin") {
            
            $sql = "SELECT username,password FROM $table_name WHERE (username=:usname) and (password=:usrpassword)";
        } else {
            $sql = "SELECT email,password FROM $table_name WHERE (email=:usname) and (password=:usrpassword)";
        }
        $query = $this->conn->prepare($sql);
        $query->bindParam(':usname', $username);
        $query->bindParam(':usrpassword', $password);
        // print_r($query);exit;
        $query->execute();
        
        $results = $query->fetchAll();
        // echo "jrrrddf";
        if ($query->rowCount() > 0) {
            return $username;
        } else {
            // echo "<br>else";
            return "INVALID DETAILS";
        }
    }
}
    