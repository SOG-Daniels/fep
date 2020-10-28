<?php 
    //run the store proc
    //$result = mysqli_query($connection, "CALL StoreProcName");


class Process {

    //private data members
    private $conn;
    
    public function __construct(){
        //connecting to database
        $this->conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        // Check connection
        
        if ($this->conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
    }
    /*
    *   Functions Below communicate with the database to select, update or insert information.
    */

    //checks if the user signing in is registered in the system
    public function validateUser($data = array()){

        $result = [];


        $email = $this->sanitize($data['email']);

        //checking if user exists 

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

    //applies a XSS, SQl Injections sanitization to a string 
    function sanitize($input){
        
        $input = trim($input);
        $input = $this->conn->real_escape_string($input);

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