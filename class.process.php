<?php 
    //run the store proc
    //$result = mysqli_query($connection, "CALL StoreProcName");


class Process {

    //private data members
    private $conn;
    
    public function __construct(){
        //connecting to database
        try {
            $this->conn = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME."", DB_USER, DB_PASS);
            // set the PDO error mode to exception
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        } catch(PDOException $e) {
            die ("Connection failed: " . $e->getMessage());
        }

    }
    /*
    *   Functions Below communicate with the database to select, update or insert information.
    */

    //checks if the user signing in is registered in the system
    public function validateLogin($data = array()){

        //sanitizing inputs
        $email = $this->sanitize($data['email'] ?? '');
        $pass = $data['password'] ?? '';

        // $sql = $this->conn->prepare('CALL register_account(:fname, :lname, :dob, :type, :email, :pass);');
        $sql = $this->conn->prepare('call login_account(?, ?);');

        //escaping input
        $sql->bindParam(1, $email);
        $sql->bindParam(2, $pass);
       
        $sql->execute();
        $result = $sql->fetch(PDO::FETCH_ASSOC);

        return $result;


    }
    //registers a users to the system
    public function registerUser($data = []){
        
        //sanitizing inputs
        $profilePic = $this->sanitize($data['profilePic'] ?? null);
        $email = $this->sanitize($data['email'] ?? '');
        $type =  $data['userType'];
        $fname = $this->sanitize($data['firstName'] ?? '');
        $lname = $this->sanitize($data['lastName'] ?? '');
        $dob = $this->sanitize($data['dob'] ?? '');
        $pass = $data['confirmPassword'] ?? '';

        // $sql = $this->conn->prepare('CALL register_account(:fname, :lname, :dob, :type, :email, :pass);');
        $sql = $this->conn->prepare('call register_account(?, ?, ?, ?, ?, ?, ?);');

        //escaping input
        $sql->bindParam(1, $fname);
        $sql->bindParam(2, $lname);
        $sql->bindParam(3, $dob);
        $sql->bindParam(4, $profilePic);
        $sql->bindParam(5, $type);
        $sql->bindParam(6, $email);
        $sql->bindParam(7, $pass);
      

        $sql->execute();
        $result = $sql->fetch(PDO::FETCH_ASSOC);

        return $result;
      
        

    }
    //Activates an account throguh activation code
    public function activate_account($activationCode){
        
        $sql = $this->conn->prepare('call activate_account(?);');

        //escaping input
        $sql->bindParam(1, $activationCode);
       
       
        $sql->execute();
        $result = $sql->fetch(PDO::FETCH_ASSOC);

        return $result;
    }
    public function logout_account($accesstoken){
        
        $sql = $this->conn->prepare('call logout_account(?);');

        //escaping input
        $sql->bindParam(1, $accesstoken);
       
       
        $sql->execute();
        $result = $sql->fetch(PDO::FETCH_ASSOC);

        return $result;
    }
    //Gets the number of mentors in the system
    public function getMentorCount(){

    }
    //Gets the number of mentors in the system
    public function getMenteeCount(){
        
    }
    //Gets the top mentors by rating
    public function getTopMentors(){
        
    }
    //Gets the top courses that have a mentor
    public function getTopPrograms(){
        
    }
    //Gets the courses available in the program
    public function getCourses(){
        
    }
    //Gets the number of upcoming events
    public function getUpcomingEventCount(){
        
    }
    //Gets the matching course name being types
    public function getCourseName($search){


    }



    /*
    *   Functions below are used to help the process class in carring out additional functionality.
    *   Functions below do not communicate with the database.
    */

    //applies a basic sanitization
    function sanitize($input){
        
        $input = trim($input);

        $search = array(
          '@<script[^>]*?>.*?</script>@si',   // Strip out javascript
          '@<[\/\!]*?[^<>]*?>@si',            // Strip out HTML tags
          '@<style[^>]*?>.*?</style>@siU',    // Strip style tags properly
          '@<![\s\S]*?--[ \t\n\r]*>@'         // Strip multi-line comments
        );
       
        $output = preg_replace($search, '', $input);
        return $output;
    }
   

}

?>