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
    //generates a access token if the for the user 
    public function requestPassReset($email){
        
        $email = $this->sanitize($email);

        $sql = $this->conn->prepare('call request_forgot_password(?);');

        //escaping input
        $sql->bindParam(1, $email);
       
        $sql->execute();
        $result = $sql->fetch(PDO::FETCH_ASSOC);


        return $result;
    }
    //confirm a password reset
    public function confirmForgotPass($activationCode, $pass){

        $sql = $this->conn->prepare('call confirm_forgot_password(?, ?);');

        //escaping input
        $sql->bindParam(1, $activationCode);
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
    //Logs the logging out of a user by their access_token provided to them
    public function logout_account($accesstoken){
        
        $sql = $this->conn->prepare('call logout_account(?);');

        //escaping input
        $sql->bindParam(1, $accesstoken);
       
       
        $sql->execute();
        $result = $sql->fetch(PDO::FETCH_ASSOC);

        return $result;
    }
    //gets a course detail
    //@param1 the course name 
    //@parma2 the course id
    //@returns associative array()
    // this is not needed
    public function getCourseDetail($name = null, $courseId = null){
        
        $name = $this->sanitize($name);
        $isFound = 0;
        $limit = 0;
        $data = [];
        
        $sql = $this->conn->prepare('call get_course_list(?, ?);');

        //escaping input
        $sql->bindParam(1, $name);
        $sql->bindParam(2, $limit);
       
        $sql->execute();
        $result = $sql->fetchAll(PDO::FETCH_ASSOC);

        foreach($result as $key => $course){
            if ($courseId == $course['course_id']){
                $data = $course;
                $isFound = 1;
            }
        }
        if (!$isFound){
            //no course found 
            return false;
        }

        return $data;
    } 
    //gets course by name or all courses if name not specified
    //@param1 course name if nulls queries all courses
    //@parma2 the amount of records to return if 0 will return all records
    //@returns associative array()
    public function getCourseList($name = null, $limit = 0){
        
        $name = $this->sanitize($name);

        $sql = $this->conn->prepare('call get_course_list(?, ?);');

        //escaping input
        $sql->bindParam(1, $name);
        $sql->bindParam(2, $limit);
       
        $sql->execute();
        $result = $sql->fetchAll(PDO::FETCH_ASSOC);


        return $result;
    }
    //gets course by name or all courses if name not specified
    //@param1 course name if nulls queries all courses
    //@parma2 the amount of records to return if 0 will return all records
    //@returns associative array()
    public function getMentorList($name = null, $limit = 0){
        
        $name = $this->sanitize($name);

        $sql = $this->conn->prepare('call get_mentor_list(?, ?);');

        //escaping input
        $sql->bindParam(1, $name);
        $sql->bindParam(2, $limit);
       
        $sql->execute();
        $result = $sql->fetchAll(PDO::FETCH_ASSOC);

        // restructuring records recieved

        $data['mentors'] = [];
        
        if (!empty($result) && !empty($result[0])){
            foreach ($result as $key => $mentor){
                
                if(array_key_exists($mentor['mentor_id'], $data['mentors'])){
                   
                    $isFound = 0;
                    foreach($data['mentors'][$mentor['mentor_id']]['social_networks'] as $key => $socialNetwork){
                        if (in_array($mentor['sn_url'], $data['mentors'][$mentor['mentor_id']]['social_networks'][$key])){
                            $isFound = 1;
                        }

                    }
                    if (!$isFound){
                        //adding social network if it hasnt been added
                        // echo '<br><br><br>';
                        // echo $mentor['sn_name'];
                        $data['mentors'][$mentor['mentor_id']]['social_networks'][] = array(
                            'sn_name' => $mentor['sn_name'],
                            'sn_icon' => $mentor['sn_icon'],
                            'sn_url' => $mentor['sn_url'],
                        );


                    }
                    if (!in_array($mentor['profession'], $data['mentors'][$mentor['mentor_id']]['professions'])){
                        //adding profession if it hasnt been added
                        $data['mentors'][$mentor['mentor_id']]['professions'][] = $mentor['profession'];
                    }


                }else{
                    
                    //adding mentor data
                    $data['mentors'][$mentor['mentor_id']]['mentor_id'] = $mentor['mentor_id'];
                    $data['mentors'][$mentor['mentor_id']]['mentor_name'] = $mentor['mentor_name'];
                    $data['mentors'][$mentor['mentor_id']]['profile_pic'] = $mentor['profile_pic'];
                    $data['mentors'][$mentor['mentor_id']]['about'] = $mentor['about'];
                    $data['mentors'][$mentor['mentor_id']]['rating'] = $mentor['rating'];

                    if (isset($mentor['sn_icon']) && isset($mentor['sn_url'])){
                        //adding social network
                        $data['mentors'][$mentor['mentor_id']]['social_networks'][] = array(
                            'sn_name' => $mentor['sn_name'],
                            'sn_icon' => $mentor['sn_icon'],
                            'sn_url' => $mentor['sn_url'],
                        );
                    }
                    else{
                        //creating an empty social network array
                        $data['mentors'][$mentor['mentor_id']]['social_networks'] = [];

                    }

                    if (isset($mentor['profession'])){

                        //adding mentor profession
                        $data['mentors'][$mentor['mentor_id']]['professions'][] = $mentor['profession'];

                    }else{
                        //creating empty profession array 
                        $data['mentors'][$mentor['mentor_id']]['professions'] = [];

                    }


                }
                
            }
        }

        return $data['mentors'];
    }
    //Gets all courses that have a mentor assigned to them in decending order
    //@param1 program name if nulls queries all programs
    //@parma2 the amount of records to return if 0 will return all records
    //@returns associative array()
    public function getProgramList($name = null, $limit = 0){
        
        $sql = $this->conn->prepare('call get_program_list(?, ?);');

        //escaping input
        $sql->bindParam(1, $name);
        $sql->bindParam(2, $limit);
       
        $sql->execute();
        $result = $sql->fetchAll(PDO::FETCH_ASSOC);

        return $result;
        
    }


    //gets the course outline title and content
    public function getCourseOutline($courseId){

        $data['courseOutline'] = [];

        $sql = $this->conn->prepare('
            select
            cot.summary as title, cos.summary as content, cot.id as title_id, cos.id as content_id
            from
            course_outline cot,
            course_outline cos
            where
            cot.course_id = ?
            and cot.parent = 0
            and cot.id = cos.parent
            and cos.parent <> 0
            order by cot.order_id DESC
        ');
        
        $sql->execute(array($courseId));
        $result = $sql->fetchAll(PDO::FETCH_ASSOC);

        foreach ($result as $key => $cot){

            if (array_key_exists($cot['title_id'], $data['courseOutline'])){
                //title exist already append to existing
                $data['courseOutline'][$cot['title_id']]['contents'][] = $cot['content'];

            }else{
                //title doest exist add 
                $data['courseOutline'][$cot['title_id']]['title'] = $cot['title'];
                $data['courseOutline'][$cot['title_id']]['title_id'] = $cot['title_id'];
                $data['courseOutline'][$cot['title_id']]['contents'][] = $cot['content'];

            }

        } 

        return $data['courseOutline'];
    }
    //returns the top default (3) mentors in a program/course
    //get mentors that are mentoring a course
    public function getMentorsByCourseId($courseId, $limit = 3){

        $data = [];
        $count = 0; 
        
        $programs = $this->getProgramList(null, 0);
        $mentors = $this->getMentorList(null, 0);

        foreach($programs as $key => $program){

            if ($courseId == $program['course_id']){
                //found course in program 
                if ($count < $limit){
                    // finding mentor info assigned to program
                    foreach ($mentors as $mentorId => $mentor){
                        if ($program['mentor_id'] == $mentorId){
                            // we found mentor data

                            //getting mentor and program data as one
                            $data[$count]['mentor'] = $mentor;
                            $data[$count]['program'] = $program;
                            $count++;
                        }
                        

                    }

                }else{
                    //extra mentors that are not at the top
                    $data['moreMentors']['mentor'] = $mentor;
                    $data['moreMentors']['program'] = $program;

                }

                
            }


        }

        return $data;

    }
 
    // returns mentor and program details by program id
    public function getMentorByProgramId($programId){

        $data = [];
        $isFound = 0;

        $programs = $this->getProgramList(null, 0);
        $mentors = $this->getMentorList(null, 0);

        foreach($programs as $key => $program){

            if (!$isFound && $programId == $program['program_id']){
                // Found program id 
                //searching for mentor that has that program_id
                foreach ($mentors as $mentorId => $mentor){
                    if (!$isFound && $program['mentor_id'] == $mentorId){
                        // we found mentor data

                        //getting mentor and program data as one
                        $data['mentor'] = $mentor;
                        $data['program'] = $program;
                        $isFound = 1;
                    }
                }
            }
        }

        return $data;

    }
    // returns the programs the user is mentoring
    public function getMentorPrograms($mentorId){

        $data['programs'] = [];
       

        $programs = $this->getProgramList(null, 0);

        foreach($programs as $key => $program){

            if ($program['mentor_id'] == $mentorId){
                // Found program for mentor
                
                $data['programs'][] = $programs[$key];
                                  
                
            }
        }

        return $data['programs'];

    }
 
    //gets the homepage system summary
    public function getprogramTestimonials($programId = 0){

        if ($programId != 0){
            $sql = $this->conn->prepare('
                select
                concat(p.first_name, " ", p.last_name) as mentee_name,
                p.image_src as profile_pic,
                c.texto
                from
                testimonial t, `comment` c, person p, post po
                where p.id = c.user_id and c.id = t.comment_id and t.status = 1 and c.post_id = po.id and po.program_id = '.$programId.';
            ');

        
            $sql->execute();
            $result = $sql->fetchAll(PDO::FETCH_ASSOC);

            return $result;

        }else{
            return false;
        }
    }

    
    //gets the homepage system summary
    public function getSystemSummary(){

        $sql = $this->conn->prepare('
            select
            c.total as courses,
            m.total as mentors,
            me.total as mentees
            from
            (select count(id) as total from course where status = 1) as c,
            (select count(id) as total from mentor where status = 1) as m,
            (select count(id) as total from mentee where status = 1) as me
        ');

       
        $sql->execute();
        $result = $sql->fetch(PDO::FETCH_ASSOC);

        return $result;
    }

    //gets course infor by Id
    public function getCourseById($courseId){

        $data = [];
        $courses  = $this->getCourseList();

        foreach ($courses as $key => $course){

            if ($courseId == $course['course_id']){
                $data = $course;
            }

        }

        return $data;

    }
    //gets course infor by Id
    public function getProgramById($programId){

        $data = [];
        $programs  = $this->getProgramList();

        foreach ($programs as $key => $program){

            if ($programId == $program['program_id']){
                $data = $program;
            }

        }

        return $data;

    }
    
    //gets course infor by Id
    public function getMentorById($mentorId){

        $data = [];
        $mentors  = $this->getMentorList();

        foreach ($mentors as $key => $mentor){

            if ($mentorId == $mentor['mentor_id']){
                $data = $mentor;
            }

        }

        return $data;

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