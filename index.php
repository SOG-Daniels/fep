<?php 
    // The Index.php file is the controller of the application, which request data from the DBMS and returns the appropriate view
    require_once('./class.interface.php');
    require_once('./definitions.php');
        
    require_once('./class.facebook_api.php');
    require_once('./class.google_api.php');


    // echo "<br><br><br><br>";
    // echo "<pre>";
    // print_r($_SESSION);
    // echo "</pre>";

    $view = new Ui();
    $fb = new FacebookAPI(); 
    $google = new GoogleAPI();

    //variables will determine if the public or portal website view
    $header = '';
    $topbar = '';
    $sidebar = '';
    $pageContent = '';
    $footer = '';
    $currentPage = '';

    $ajaxResponse = '';


    if (!empty($_SESSION) && isset($_SESSION['USERDATA'])){
        //User is logged into the portal

        if ($_GET){
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
        //User is logged out 
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

                $currentPage = 'home';
                $pageContent = $view->home();
                
            }

        }else if ($_POST && isset($_POST['action'])){

            if ($_POST['action'] == 'signIn'){
                
                //validating user login
                
                

                //redirecting to login portal
                header('Location: '.BASE_URL.'index.php/?page=dashboard');
            }

        }else{
            $currentPage = 'home';
            $pageContent = $view->home();
        }

        //Public Website structure
        $header = $view->header();
        $topbar =  $view->topBar($currentPage);
        $sidebar = '';
        $footer =  $view->footer();
    }

    if (!isset($_POST['ajaxRequest'])){
        
        //Displaying webpage structure 
        echo $header;
        echo $topbar;
        echo $sidebar;
        echo $pageContent;
        echo $footer;

    }else{
        //returning ajax response
        echo json_encode($ajaxResponse);
    }


?>