<?php 
    //starting session

    // The Index.php file is the controller of the application, which request data from the DBMS and returns the appropriate view
    require_once('./definitions.php');
    require_once('./class.interface.php');
    require_once('./class.process.php');
    require_once('./class.email.php');
    require_once('./helper.php');
        
    require_once('./class.facebook_api.php');
    require_once('./class.google_api.php');


    // echo "<br><br><br><br>";
    // echo "<pre>";
    // print_r($_SESSION);
    // echo "</pre>";

    $view = new Ui();
    $process = new Process();
    $fb = new FacebookAPI(); 
    $google = new GoogleAPI();
    $email = new Email(EMAIL_SENDER_NAME, EMAIL_SENDER, EMAIL_SENDER_PASS);

    //variables will determine if the public or portal website view
    $header = '';
    $topbar = '';
    $sidebar = '';
    $pageContent = '';
    $footer = '';
    $currentPage = '';
    
    //Variables Keep track of the ajax request being sent
    $ajaxRequest = false;
    $ajaxResponse = [];


    if (!empty($_SESSION) && isset($_SESSION['USERDATA'])){
        //User is logged into the portal

        if ($_GET && isset($_GET['page'])){
            // logged in user wants to access a page
            if($_GET['page'] == 'dashboard'){

                $currentPage = 'dashboard';
                $pageContent = $view->dashboard();
            
            }else if($_GET['page'] == 'profile'){

                $pageContent = $view->mentorProfile();

            }else if($_GET['page'] == 'mentorList'){

                $pageContent = $view->mentorList();

            }else if($_GET['page'] == 'editMentorProfile'){

                $pageContent = $view->editMentorProfile();

            }else if($_GET['page'] == 'viewMentorProfile'){

                $pageContent = $view->viewMentorProfile();

            }else if($_GET['page'] == 'addCourse'){
                
                $pageContent = $view->addNewCourse();

            }else if($_GET['page'] == 'courseInfo'){

                $pageContent = $view->courseInfo();

            }else if($_GET['page'] == 'courseList'){

                $pageContent = $view->courseList();

            }else if($_GET['page'] == 'viewMentors'){

                $pageContent = $view->viewMentors();

            }else if($_GET['page'] == 'viewCourses'){

                $pageContent = $view->viewCourses();

            }else if($_GET['page'] == 'menteeList'){

                $pageContent = $view->menteeList();

            }else if($_GET['page'] == 'discussion'){

                $pageContent = $view->discussion();

            }else if($_GET['page'] == 'forums'){

                $pageContent = $view->forums();

            }else if($_GET['page'] == 'programContent'){
                
                $pageContent = $view->programContent();

            }else if($_GET['page'] == 'logout'){

                //ending user session and redirecting them to public website

                // session_destroy();
                // unset($_SESSION['USERDATA']);
                // $_SESSION = array();

                // header('Location: '.BASE_URL.'index.php/?page=home');
                

            }else{

                $pageContent = $view->dashboard();
            }

        }else{
            if ($_POST && isset($_POST['action'])){
                // logged in user wasnt to perform an action 

                if ($_POST['action'] == ''){

                }else{

                }

            }else if(isset($_POST['ajaxRequest'])){
                //Handles all ajax request made from client side 

                if($_POST['ajaxRequest'] == 'rating'){

                }else{

                }

            }else{
                //action was not found
                $pageContent = $view->dashboard();
            }
        }
       
        //Portal website structure
        $header =  $view->portalHeader();
        $topbar = $view->portalTopBar();
        $sidebar = $view->portalSideBar($data);
        $footer = $view->portalFooter();


    }else{
        //User is logged out or visiting the website
        if ($_GET && isset($_GET['page'])){
            if ($_GET['page'] == 'signIn'){

                //Creating AuthLink for signIn
                $data['fbAuthLink'] = $fb->getFacebookLoginUrl(FB_REDIRECT_URI_SIGN);
                $data['googleAuthLink'] = $google->getGoogleAuthUrl(G_REDIRECT_URI_SIGN);

                if (isset($_GET['signInBy']) && $_GET['signInBy'] == 'facebook'){
                    
                    $result = $fb->tryAndLoginWithFacebook($_GET, FB_REDIRECT_URI_SIGN);

                    $data['email'] = $result['fb_user_info']['email'] ?? '';

                    
                    if (isset($data['email']) && $data['email'] !== ''){
                        
                        $pageContent = $view->signInWithApi($data);

                    }else{
                        header('Location: '.BASE_URL.'index.php/?page=signIn&error=facebook');
                    }



                }else if (isset($_GET['signInBy']) && $_GET['signInBy'] == 'google'){
                    
                    $data = array();

                    try{
                        //If client reloads page an exception will be thrown 

                        $result = $google->getUserInfoByCode($_GET['code']);
                        
                        if (!empty($result)) {
                            
                            $data['email'] = $result['email'] ?? '';

                        }
                        $pageContent = $view->signInWithApi($data);

                    }catch(GuzzleHttp\Exception\ClientException $e){
                        //Rerequest triggers a clientexception throw
                        header('Location: '.BASE_URL.'index.php/?page=signIn&error=google');
                    }



                }else{

                    if (isset($_GET['error'])){
                        if ($_GET['error'] == 'facebook' || $_GET['error'] == 'google'){
                            $data['message'] = '
                                <div class="alert alert-danger alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                                    <strong>Oops!</strong> We could not get your '.(($_GET['error'] == 'facebook')? 'facebook email' : 'Gmail').' address. Please try again.
                                </div> 
                            ';
                        }
                    }

                    $pageContent = $view->signIn($data);
                }

            }else if($_GET['page'] == 'forgotPassword'){

                $pageContent = $view->forgotPassword();

            }else if($_GET['page'] == 'contact'){

                $currentPage = 'contact';
                $pageContent = $view->contact();

            }else if($_GET['page'] == 'register'){
                
                $currentPage = 'registration';
                $data['fbAuthLink'] = $fb->getFacebookLoginUrl(FB_REDIRECT_URI_REG);
                $data['googleAuthLink'] = $google->getGoogleAuthUrl(G_REDIRECT_URI_REG);

                if (isset($_GET['registerBy']) && $_GET['registerBy'] == 'facebook'){
                    //registration using facebook
                    
                    $result = $fb->tryAndLoginWithFacebook($_GET, FB_REDIRECT_URI_REG);

                    if (!empty($result['fb_user_info'])){

                        $data['firstName'] = $result['fb_user_info']['first_name'] ?? '';
                        $data['lastName'] = $result['fb_user_info']['last_name'] ?? '';
                        $data['email'] = $result['fb_user_info']['email'] ?? '';
                        $data['api'] = 1;//register with api is true 
                        

                    }else{

                        header('Location: '.BASE_URL.'index.php/?page=register&error=facebook');

                    }
                    
                    $pageContent = $view->preFilledRegistration($data);

                }else if(isset($_GET['registerBy']) && $_GET['registerBy'] == 'google'){
                    //registration using google

                    $data = array();
                    
                    if (isset($_GET['code'])){

                        try{
                            //If client reloads page an exception will be thrown 
                            $result = $google->getUserInfoByCode($_GET['code']);
                            if (!empty($result)) {
                                
                                //separating name
                                $name = explode(' ', $result['name']);

                                $data['firstName'] = $name[0] ?? '';
                                $data['lastName'] = $name[1] ?? '';
                                $data['email'] = $result['email'] ?? '';
                                $data['api'] = 1;//register with api is true 

                            }

                        }catch(GuzzleHttp\Exception\ClientException $e){
                            //Rerequest triggers a clientexception logging error
                                
                            header('Location: '.BASE_URL.'index.php/?page=register&error=google');
                        }

                    }

                    $pageContent = $view->preFilledRegistration($data);
                    

                }else{
                    //regular registration
                    if (isset($_GET['error'])){
                        if ($_GET['error'] == 'facebook' || $_GET['error'] == 'google'){
                            $data['message'] = '
                                <div class="alert alert-danger alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                                    <strong>Oops!</strong> We could not get your '.(($_GET['error'] == 'facebook')? 'facebook email' : 'Gmail').' address. Please try again.
                                </div> 
                            ';
                        }
                    }

                    $pageContent = $view->registration($data);

                }


            }else if($_GET['page'] == 'about'){

                $currentPage = 'about';
                $pageContent = $view->aboutUs();
            
            }else if($_GET['page'] == 'mentorProfile'){
                $pageContent = $view->mentorProfile();

            }else if($_GET['page'] == 'mentorCourseDetails'){
                $pageContent = $view->mentorCourseDetails();

            }else if($_GET['page'] == 'courseDetails'){

                $currentPage = 'courseDetails';
                $pageContent = $view->courseDetails();

            }else if($_GET['page'] == 'mentorBio'){

                $currentPage = 'mentorBio';
                $pageContent = $view->mentorBio();
            
            }else if($_GET['page'] == 'mentors'){
            
                $currentPage = 'mentors';
                $pageContent = $view->mentors();

            }else if($_GET['page'] == 'thankyou'){
                
                $pageContent = $view->thankYou();

            }else if($_GET['page'] == 'webinars'){

                $currentPage = 'webinars';
                $pageContent = $view->webinars();

            }else if($_GET['page'] == 'events'){

                $currentPage = 'events';
                $pageContent = $view->events();

            }else if($_GET['page'] == 'courses'){

                $currentPage = 'courses';
                $pageContent = $view->courses();
            
            }else{

                $data['topMentors'] = $process->getTopMentors();
                $data['topPrograms'] = $process->getTopPrograms();
                $data['courses'] = $process->getCourses();
                $data['courseCount'] = 1;//count($data['courses']);
                $data['mentorCount'] = 1;//$process->getMentorCount();
                $data['menteeCount'] = 2;//$process->getMenteeCount();
                $data['upcomingEventCount'] = 0;//$process->getUpcomingEventCount();                

                $currentPage = 'home';
                $pageContent = $view->home($data);
                
            }

        }else if ($_POST && isset($_POST['action'])){

            if ($_POST['action'] == 'signIn'){
                
                //validating user login
                // echo '<br><br><br><br>';
                // echo '<pre>';
                // print_r($_POST);
                // echo '</pre>';
                
                $result = $process->validateUser($_POST);

                // if($result == 0){
                //     $data['message'] ='
                //     <div class="alert alert-danger alert-dismissible fade show" role="alert">
                //         <strong>Access Denied!</strong><br> Make sure your enter the correct email and password, please try again.
                //         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                //             <span aria-hidden="true">&times;</span>
                //         </button>
                //     </div>
                //     ';
                // }else{
                //     //user entered correct credentials setting session

                //     // $_SESSION['USERDATA'] = $result[''];

                    
                //     // header('Location: '.BASE_URL.'index.php/?page=dashboard');
                    
                // }
                

                //redirecting to login portal
                // header('Location: '.BASE_URL.'index.php/?page=dashboard');
            }else if ($_POST['action'] == 'registration'){

                if($_POST['newPassword'] != $_POST['confirmPassword']){
                    //checking password

                    $data['message'] .= '
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Registration Cancelled!</strong><br> Password for the <b>new</b> and <b>confirm</b> password fields do not match, please try again.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    ';
                   
                    //setting api links
                    $data['fbAuthLink'] = $fb->getFacebookLoginUrl(FB_REDIRECT_URI_REG);
                    $data['googleAuthLink'] = $google->getGoogleAuthUrl(G_REDIRECT_URI_REG);

                    $pageContent = $view->registration($data);
                    
                }else{
                    // correct passwords entered

                    if (isset($_POST['api']) && $_POST['api'] == 1){
                        // user registering by api - no email verification needed

                        //add user info

                        //display success page and ask them to sign In

                    }else{
                        //user custom registration - email verification required
                        $link  = BASE_URL.'index.php/?activationCode=';
                        //enter user info

                        //succes in adding user send a email verification 

                        //success in sending email show thank you page and tell them to check email

                    }

                }
            }else if ($_POST['action'] == 'contactUsEmail'){
                //Guest is sending an email 

                //Form data submission
                $name = $_POST['name'] ?? '';
                $userEmail = $_POST['email'] ?? '';
                $subject = $_POST['subject'] ?? '';
                $message = $_POST['message'] ?? '';

                $data = [];

                //reCaptcha verification
                $responseKey = $_POST['g-recaptcha-response'];
                $userIP = $_SERVER['REMOTE_ADDR'];
                $url = 'https://www.google.com/recaptcha/api/siteverify?secret='.RECAPTCHA_SITE_SECRET.'&response='.$responseKey.'&remoteip='.$userIP.'';

                //verifying if recaptcha was a success
                $response = file_get_contents($url);
                $response = json_decode($response);

                if ($response->success){
                    // verification was succesfull
                    $data['message'] = '<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Email Sent!</strong><br>Thank you for contacting us! We will get back to you as soon as we can.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
                    //sending email 
                    
                    $fullMessage = '<b>Name:</b>'.$name.'<br> <b>Email:</b> '.$userEmail.'<br><b>Subject:</b> '.$subject.'<br><b>Message:</b><br>'.$message.'';

                    $email->set_Subject('ContactUs Email from Guest');
                    $result = $email->send(EMAIL_RECEIVER, $fullMessage);//sending email

                    if ($result != 1){
                        // failed to send message

                        $data['message'] = '<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>Eamil was not sent!</strong><br> Sorry, we could not send the email. Please try agian later.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
                    }

                }else{
                    $data['message'] = '<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>reCaptcha was not selected!</strong><br>Please select confirm that your are not a robot and try again.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
                }

                $currentPage = 'contact';
                $pageContent = $view->contact($data);
                


            }else if($_POST['action'] == 'courseSearch'){
                //autocomplete word search
                $ajaxRequest = true; 

                $words = [ 'what', 'yay', 'bro', 'shure'];
                
                $result = $words; //$process->getCourseName($_POST['search']);

                echo json_encode($result);

            }else if($_POST['action'] == 'mentorSearch'){
                //autocomplete word search
                $ajaxRequest = true; 

                $words = [ 'wow', 'test', 'dude', '777'];
                
                $result = $words; //$process->getCourseName($_POST['search']);

                echo json_encode($result);

            }else{

            }

        }else{

            $data['topMentors'] = $process->getTopMentors();
            $data['topPrograms'] = $process->getTopPrograms();
            $data['courses'] = $process->getCourses();
            $data['courseCount'] = 1;//count($data['courses']);
            $data['mentorCount'] = 1;//$process->getMentorCount();
            $data['menteeCount'] = 2;//$process->getMenteeCount();
            $data['upcomingEventCount'] = 0;//$process->getUpcomingEventCount();                

            $currentPage = 'home';
            $pageContent = $view->home($data);
        }

        //Public Website structure
        $header = $view->header();
        $topbar =  $view->topBar($currentPage);
        $sidebar = '';
        $footer =  $view->footer();
    }

    if (!$ajaxRequest){
        
        //Displaying webpage structure 
        echo $header;
        echo $topbar;
        echo $sidebar;
        echo $pageContent;
        echo $footer;

    }


?>