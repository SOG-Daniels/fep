<?php 
    //starting session
    session_start();

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
                    // echo '<br><br><br><br>';

    $view = new Ui();
    $process = new Process();
    $fb = new FacebookAPI(); 
    $google = new GoogleAPI();
    $email = new Email(EMAIL_SENDER_NAME, EMAIL_SENDER, EMAIL_SENDER_PASS);

    //variables will determine if the public or portal website view
    //pages with the exception of pageContent need to be null to make sure isset() returns false
    $header = null;
    $topbar = null;
    $sidebar = null;
    $pageContent = '';
    $footer = null;
    $currentPage = '';
    
    //Variables Keep track of the ajax request being sent
    $ajaxRequest = false;
    $ajaxResponse = [];

    // echo '<br><br><br><br>';
    // echo '<pre class="pt-5 d-flex justify-content-center">';
    // print_r($_SESSION);
    // echo '</pre>';

    if (!empty($_SESSION['USERDATA']) && isset($_SESSION['USERDATA']['access_token'])){
        //User is logged into the portal
        
        if ($_GET && isset($_GET['page'])){
            // logged in user wants to access a page
            if($_GET['page'] == 'dashboard'){
               
                $currentPage = 'dashboard';
                $pageContent = $view->dashboard();
            
            }else if($_GET['page'] == 'profile'){

                $pageContent = $view->profile();

            }else if($_GET['page'] == 'mentorList'){

                $pageContent = $view->mentorList();

            }else if($_GET['page'] == 'editMentorProfile'){

                $pageContent = $view->editMentorProfile();

            }else if($_GET['page'] == 'viewMentorProfile'){

                $pageContent = $view->viewMentorProfile();

            }else if($_GET['page'] == 'addCourse'){

                //getting course categories
                $result['categories'] = $process->getCourseCategories();
                
                $pageContent = $view->addNewCourse($result);

            }else if($_GET['page'] == 'courseInfo'){

                $pageContent = $view->courseInfo();
            
            }else if($_GET['page'] == 'addCourseCategory'){

                $pageContent = $view->addCourseCategory();
            
            }else if($_GET['page'] == 'editCourseCat' && isset($_GET['courseCatId'])){
                // editing course category
                $courseCatId  = decrypt($_GET['courseCatId']);
                
                $category = $process->getCourseCategory($courseCatId);

                $pageContent = $view->editCourseCategory($category);
            
            }else if($_GET['page'] == 'deleteCourseCat' && isset($_GET['courseCatId'])){
                
                $courseCatId  = decrypt($_GET['courseCatId']);

                $result['category'] = $process->getCourseCategory($courseCatId);
                
                if (!empty($result)){
                    // valid courseCatid 

                }else{
                    //display 404 error

                }
 

            }else if($_GET['page'] == 'courseCategories'){
                
                $result['categories'] = $process->getCourseCategories();
   
                
                $pageContent = $view->courseCategories($result);
            
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

                //ending user session and logging it
                
                $wasLoggedOut = $process->logout_account($_SESSION['USERDATA']['access_token']);
                
                if ($wasLoggedOut['res_code'] == 1){

                    //Destroys current sessions
                    session_destroy();
                    unset($_SESSION['USERDATA']);
                    $_SESSION = array();
                    
                    $currentPage = 'home';
                   
                    //data for home page
                    $data['Mentors'] = $process->getMentorList(null, 0);
                    $data['topPrograms'] = $process->getProgramList(null, 3);
                    $data['courses'] = $process->getCourseList();
                    $data['systemSummary'] = $process->getSystemSummary();
        
                    $currentPage = 'home';
                    
                    // Displaying font end home page
                    $header = $view->header();
                    $topbar = $view->topBar($currentPage);
                    $sidebar = '';
                    $pageContent = $view->home($data);
                    $footer = $view->footer();
                    
                }
                
                

            }else{

                $pageContent = $view->dashboard();
            }

        }else{
            if ($_POST && isset($_POST['action'])){
                // logged in user wasnt to perform an action 

                if ($_POST['action'] == 'addNewCourseCategory'){
                    //working
                    $result = $process->addNewCourseCategory($_POST['courseName'], $_POST['courserIcon']);

                    if ($result){
                        //success 
                        $data['message'] ='
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>Success!</strong> New Category was Added.
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        ';

                    }else{
                        //failed to insert
                        $data['message'] ='
                            <div class="alert alert-waring  alert-dismissible fade show" role="alert">
                                <strong>!</strong> New Category was Added.
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        ';

                    }
                    $data['categories'] = $process->getCourseCategories();
                    
                    $pageContent = $view->courseCategories($data);


                }else if ($_POST['action'] == 'updateCourseCategory'){
                    //updating course category after form submission
                    $courseCatId = decrypt($_POST['courseCatId']);
                    
                    $result = $process->updateCourseCategories($_POST['courseName'], $_POST['courseIcon'], $courseCatId);
                    
                    if ($result){
                        //success 
                        $data['message'] ='
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>Success!</strong> Category was Updated.
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        ';

                    }else{
                        //failed to insert
                        $data['message'] ='
                            <div class="alert alert-waring  alert-dismissible fade show" role="alert">
                                <strong>Oops!</strong> We could not update the Course Category
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        ';

                    }
                    $data['categories'] = $process->getCourseCategories();
                    
                    $pageContent = $view->courseCategories($data);


                }else if($_POST['action'] == 'addCourse'){

                        echo '<br><br><br><br>';
                        echo '<pre class="pt-5 d-flex justify-content-center">';
                        print_r($_POST);
                        echo '</pre>';



                }else{

                }

            }else{
                //action was not found
                $pageContent = $view->dashboard();
            }
        }
       
        //Portal website structure
        $header =  $header ?? $view->portalHeader();
        $topbar =  $topbar ?? $view->portalTopBar();
        $sidebar = $sidebar ?? $view->portalSideBar();
        $footer =  $footer ?? $view->portalFooter();


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
                    if (isset($_GET['activationCode'])){
                        
                        $data['message'] = '
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>Registration Complete!</strong><br> You have been registered, you can now Sign In to your account now.
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        ';

                        $isActivated = $process->activate_account($_GET['activationCode']);
                       
                        if ($isActivated['res_code'] != 1){
                            
                            $data['message'] = '
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <strong>Oops!</strong><br>The '.$isActivated['message'].'
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
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
                        $data['profilePic'] = $result['fb_user_info']['picture']['data']['url'] ?? '';
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
                                $data['profilePic'] = $result['profilePic'] ?? '';
                                $data['userId'] = $result['userId'] ?? '';
                                $data['gender'] = $result['gender'] ?? '';
                                $data['verifiedEmail'] = $result['verifiedEmail'] ?? '';
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
            
            }else if($_GET['page'] == 'mentorCourseDetails' && isset($_GET['programId'])){
                //working
                $programId = decrypt($_GET['programId']);
                $result['program'] = $process->getProgramById($programId);

                if (!empty($result['program'])){

                    $result['mentor'] = $process->getMentorById($result['program']['mentor_id']);
                    // $result = $process->getMentorByProgramId($programId , 1);//will return the mentor we are looking for by programId
                    $result['courseOutline'] = $process->getCourseOutline($result['program']['course_id']);
                    $result['testimonials'] = $process->getprogramTestimonials($result['program']['program_id']);

                    $pageContent = $view->mentorCourseDetails($result);

                    
                }else{

                    $pageContent = $view->pageNotFound();

                }


            }else if($_GET['page'] == 'courseDetails' && isset($_GET['courseId'])){
                //working 
                $courseId = decrypt($_GET['courseId']);
                $result['course'] = $process->getCourseById($courseId);

                if (!empty($result['course'])){
                    // $courseName = str_replace('+', ' ', $_GET['courseName']);
    

                    // $result['course'] = $process->getCourseDetail($courseName, $courseId);
                    $result['courseMentors'] = $process->getMentorsByCourseId($result['course']['course_id']);
                    $result['courseOutline'] = $process->getCourseOutline($result['course']['course_id']);
        

                    $currentPage = 'courseDetails';
                    $pageContent = $view->courseDetails($result);

                }else{

                    $pageContent = $view->pageNotFound();

                }
               

            }else if($_GET['page'] == 'mentorBio' && isset($_GET['mentorId'])){
                //working
                $mentorId = decrypt($_GET['mentorId']);
                $result['mentor'] = $process->getMentorById($mentorId);

                if (!empty($result['mentor'])){
                    $result['programs'] = $process->getMentorPrograms($result['mentor']['mentor_id']);
       
                    
                    // $result['mentor'] = $process->getMentorById($result['program']['mentor_id']);
                    // $result = $process->getMentorByProgramId($programId , 1);//will return the mentor we are looking for by programId
                    // $result['courseOutline'] = $process->getCourseOutline($result['programs']['course_id']);
                    if(!empty($result['programs'][0])){
                        
                        $result['testimonials'] = $process->getprogramTestimonials($result['programs'][0]['program_id']);

                    }

                    $currentPage = 'mentorBio';
                    $pageContent = $view->mentorBio($result);

                    
                }else{
                    
                    $pageContent = $view->pageNotFound();

                }
                
            
            }else if($_GET['page'] == 'mentors'){
            

                $result['mentors'] = $process->getMentorList(); 
  
                $currentPage = 'mentors';
                $pageContent = $view->mentors($result);

            }else if ($_GET['page'] == 'changePass' && isset($_GET['activationCode'])){

                $data['activationCode'] = $_GET['activationCode'];

                $pageContent = $view->changePass($data);

            }else if($_GET['page'] == 'courses'){

                $currentPage = 'courses';
                $result['courses'] = $process->getCourseList(); 

                $pageContent = $view->courses($result);
            
            }else{

                $temp = $process->getMentorList(null, 3);
                $data['Mentors'] = $process->getMentorList(null, 0);
                $data['topPrograms'] = $process->getProgramList(null, 3);
                $data['courses'] = $process->getCourseList();
                $data['systemSummary'] = $process->getSystemSummary();

                $currentPage = 'home';
                $pageContent = $view->home($data);
                
            }

        }else if ($_POST && isset($_POST['action'])){

            if ($_POST['action'] == 'signIn'){
                
                $data['message'] = '';
                //validating user login
                
                $result = $process->validateLogin($_POST);
                
                if ($result['res_code'] != 1){
                    //user not found
                    $data['message'] ='
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Access Denied!</strong><br> Make sure your enter the correct email and password, please try again.
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    ';

                    $pageContent = $view->signin($data);

                }else{
                    //success - displaying login portal
                    $_SESSION['USERDATA']['access_token'] = $result['access_token'];

                    $header =  $view->portalHeader();
                    $topbar = $view->portalTopBar();
                    $sidebar = $view->portalSideBar();
                    $pageContent = $view->dashboard();
                    $footer = $view->portalFooter();
                    
                }
                
            }else if ($_POST['action'] == 'registration'){

                //setting api links
                $data['fbAuthLink'] = $fb->getFacebookLoginUrl(FB_REDIRECT_URI_REG);
                $data['googleAuthLink'] = $google->getGoogleAuthUrl(G_REDIRECT_URI_REG);

                $data['message'] = '';

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
                   
                    $pageContent = $view->registration($data);

                    
                }else{
                    // correct passwords entered
                    if (isset($_POST['api']) && $_POST['api'] == 1){
                        // user registering by api - no email verification needed
                        
                        $result = $process->registerUser($_POST);
                        //add user info

                        if ($result['res_code'] == '42000'){
                            //Pass complexity not matched
                            $data['message'] = '
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <strong>Registration could not be complete!</strong><br> '.$result['message'].', please try again.
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            ';
                            
                        }else if ($result['res_code'] == 1){
                            // registration was a success
                            $data['message'] = '
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <strong>Registration Complete!</strong><br> You have been registered, please <a href="'.BASE_URL.'index.php?page=signIn" >Sign In</a>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            ';
                            $isActivated = $process->activate_account($result['activation_code']);

                            if ($isActivated['res_code'] != 1){
                                
                                $data['message'] = '
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <strong>Oops!</strong><br>The '.$isActivated['res_code'].'.
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                ';
                            }


                        }else{
                            // registration complete notify success and redirect to signIn
                            $data['message'] = '
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <strong>Oops!</strong><br> Sorry and error occured while trying to register your information. Please try again.
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            ';


                        }
                        
                        //calling registration page to display message
                        $pageContent = $view->registration($data);


                    }else{

                        // registering user
                        $result = $process->registerUser($_POST);

                        if ($result['res_code'] == 42000){
                         //Pass complexity not matched
                                $data['message'] = '
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <strong>Registration could not be complete!</strong><br> '.$result['message'].', please try again.
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            ';
                            
                        }else if ($result['res_code'] == 1){
                            // registration was a success
                            $data['message'] = '
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <strong>Success!</strong><br> To complete the registration process please check your email for further instructions.
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            ';
                            
                            //Verification code for user
                            $link  = BASE_URL.'index.php/?page=signIn&activationCode='.$result['activation_code'];

                            //HTML structured card for email body
                            $message = $view->emailCard($link);

                            // sending activation code to email
                            $email->set_Subject('Female Entrepreneurs Account Activation');

                            //
                            $emailSent = $email->send($_POST['email'], $message);//sending email

                            if ($emailSent != 1){
                                
                                $data['message'] = '
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <strong>Oops!</strong><br> Sorry, we could not send your account activation code to your email. Please try again later.
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    ';
                            }


                        }else{
                            // registration complete notify success and redirect to signIn
                            $data['message'] = '
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <strong>Oops!</strong><br> Sorry and error occured while trying to register your information. Please try again.
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            ';


                        }
                     
                        $pageContent = $view->registration($data);

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

                        $data['message'] = '<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>Email was not sent!</strong><br> Sorry, we could not send the email. Please try agian later.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
                    }

                }else{
                    $data['message'] = '<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>reCaptcha was not selected!</strong><br>Please select confirm that your are not a robot and try again.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
                }

                $currentPage = 'contact';
                $pageContent = $view->contact($data);
                


            }else if($_POST['action'] == 'courseSearch'){
               
                if (isset($_POST['search'])){
                    //ajax request for autocomplete
                    $ajaxRequest = true; 

                    $result = $process->getCourseList($_POST['search']);

                    $found = [];

                    //looping to get the course names
                    foreach($result as $key => $course){
                        $found[] = $course['course_name'];
                    }

                    echo json_encode($found);

                }else{
                    //submitted search form
                    $result['searchFor'] = $_POST['searchFor'];
                    $result['courses'] = $process->getCourseList($_POST['searchFor']);
                    
                    $currentPage = 'courses';
                    $pageContent = $view->courses($result);

                }

            }else if($_POST['action'] == 'mentorSearch'){
                //autocomplete word search
                if (isset($_POST['search'])){
                    //ajax request for autocomplete
                    $ajaxRequest = true; 

                    $result['mentors'] = $process->getMentorList($_POST['search']);

                    $found = [];

                    //looping to get the mentor names
                    foreach($result['mentors'] as $key => $course){
                        $found[] = $course['mentor_name'];
                    }

                    echo json_encode($found);

                }else{
                    //submitted search form
                    $currentPage = 'mentors';
                    $result['mentors'] = $process->getMentorList($_POST['searchFor']); 
                    $result['searchFor'] = $_POST['searchFor'];
                    
                    $pageContent = $view->mentors($result);


                }
            
            }else if($_POST['action'] == 'forgotPassword'){

                $result = $process->requestPassReset($_POST['email']);
                
                $data['message'] = '<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Success, Email Sent!</strong><br> Please check your email and follow the intructions specified.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';

                if ($result['res_code'] == 1){
                    // send email
                    $fullMessage = 'Hello '.$_POST['email'].', we\'ve noticed that you have requested a password reset. <a href="'.BASE_URL.'?page=changePass&activationCode='.$result['activation_code'].'"> Please click here to change your password</a><br> The activation code is valid for 24 hours.';
                    
                    //sending email 
                    $email->set_Subject('Password Reset');
                    $result = $email->send($_POST['email'], $fullMessage);//sending email

                    if ($result != 1){
                        // failed to send message

                        $data['message'] = '<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>Email was not sent!</strong><br> Sorry, we could not send the email. Please try agian later.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
                    }

                }else{
                    //error
                    $data['message'] = '<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>Oops!</strong><br> Sorry, '.$result['message'].'<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
                }
                
                $pageContent = $view->forgotPassword($data);
                
                            

            }else if ($_POST['action'] == 'passReset'){
                    
                $data['activationCode'] =  $_POST['activationCode'];
                $confirmPass = $_POST['confirmPassword'];

                $data['message'] = '<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Success!!</strong><br> Your password has been changed, Please sign in.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';

                if($_POST['confirmPassword'] == $_POST['newPassword']){
                    //request pass reset
                
                    $result = $process->confirmForgotPass($data['activationCode'], $confirmPass);

                    if ($result['res_code'] == 1){
                        // success
                        $data['fbAuthLink'] = $fb->getFacebookLoginUrl(FB_REDIRECT_URI_SIGN);
                        $data['googleAuthLink'] = $google->getGoogleAuthUrl(G_REDIRECT_URI_SIGN);
                        
                        $pageContent = $view->signIn($data);

                    }else{
                        $data['message'] = '<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>Oops!</strong><br> Sorry, '.$result['message'].'<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
                        $pageContent = $view->changePass($data);
                    }
               
                }else{
                
                    $data['message'] = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Passwords do not match!</strong><br> Please make sure your new password matches your confirm password, click the eye icon to see your password.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
                    $pageContent = $view->changePass($data);
                    
                }

               
                

            }else{

                $data['Mentors'] = $process->getMentorList(null, 0);
                $data['topPrograms'] = $process->getProgramList(null, 3);
                $data['courses'] = $process->getCourseList();
                $data['systemSummary'] = $process->getSystemSummary();

                $pageContent = $view->home($data);

            }

        }else{

            $data['Mentors'] = $process->getMentorList(null, 0);
            $data['topPrograms'] = $process->getProgramList(null, 3);
            $data['courses'] = $process->getCourseList();
            $data['systemSummary'] = $process->getSystemSummary();

            $currentPage = 'home';
            $pageContent = $view->home($data);
        }

        //Public Website structure
        $header = $header ?? $view->header();
        $topbar =  $topbar ?? $view->topBar($currentPage);
        $sidebar = $sidebar ?? '';
        $footer =  $footer ?? $view->footer();
    }

    if (!$ajaxRequest){
        
        // Displaying webpage structure 
        echo $header;
        echo $topbar;
        echo $sidebar;
        echo $pageContent;
        echo $footer;

    }
    


?>