<?php 
// The UI class manages the different layouts for the application
class Ui {

    private $title = '';
    private $footer = '';
    
    function __construct(){
        $this->title = 'Female Entrepreneurship';
        $this->footer = '
            
        ';
    }
    // returns the starting header of html page structure
    public function header(){
        $html = '
                <!DOCTYPE html>
                <html lang="en">

                <head>
                <meta charset="utf-8">
                <meta content="width=device-width, initial-scale=1.0" name="viewport">

                <title>'.$this->title.'</title>
                <meta content="" name="descriptison">
                <meta content="" name="keywords">

                <!-- Favicons -->
                <link href="'.BASE_URL.'" rel="icon">
                <link href="'.BASE_URL.'assets/img/apple-touch-icon.png" rel="apple-touch-icon">

                <!-- Google Fonts -->
                <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
                

                <!-- Vendor CSS Files -->
                <link href="'.BASE_URL.'assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
                <link href="'.BASE_URL.'assets/vendor/icofont/icofont.min.css" rel="stylesheet">
                <link href="'.BASE_URL.'assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
                <link href="'.BASE_URL.'assets/vendor/remixicon/remixicon.css" rel="stylesheet">
                <link href="'.BASE_URL.'assets/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">
                <link href="'.BASE_URL.'assets/vendor/animate.css/animate.min.css" rel="stylesheet">
                <link href="'.BASE_URL.'assets/vendor/aos/aos.css" rel="stylesheet">
            
                <!-- CSS for Autocomplete-->
                <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
                <link rel="stylesheet" href="/resources/demos/style.css">

                <!-- FontAwesome v4.7.0--> 
                <link href="'.BASE_URL.'css/font-awesome.min.css" rel="stylesheet">
                
                <!-- Fontawesome v5.0.0 >
                <script src="https://use.fontawesome.com/b70401e877.js"></script>
                -->

                <!-- Template Main CSS File -->
                <link href="'.BASE_URL.'assets/css/style.css" rel="stylesheet">

                <!-- custom CSS File -->
                <link href="'.BASE_URL.'css/customStyles.css" rel="stylesheet">
                
                <!-- =======================================================
                * Template Name: Mentor - v2.1.0
                * Template URL: https://bootstrapmade.com/mentor-free-education-bootstrap-theme/
                * Author: BootstrapMade.com
                * License: https://bootstrapmade.com/license/
                ======================================================== -->
                
                <!-- JS SET and GET functioins for global variables-->
                <script src="'.BASE_URL.'assets/js/globalVariables.js"></script>

                <script>
                    BASE_URL = "'.BASE_URL.'";
                </script>
                <!-- GOOGLE reCaptcha script-->
                <script src="https://www.google.com/recaptcha/api.js" async defer></script>
                    
                </head>

                <body>
                ';
        return $html;
    }
    //returns the top tool bar
    public function topbar($currentPage = 'home'){

        $html = '
            <!-- ======= Header ======= -->
            <header id="header" class="fixed-top">
                <div class="container d-flex align-items-center">

                <!--<h1 class="logo mr-auto"><a href="'.BASE_URL.'">FEMALE ENTREPRENEURSHIP</a></h1>-->
                <!-- Uncomment below if you prefer to use an image logo -->
                <a href="'.BASE_URL.'" class="logo mr-auto"><img src="'.BASE_URL.'assets/img/logos/fep_logo.png" alt="" class="img-fluid"></a>

                <nav class="nav-menu d-none d-lg-block">
                    <ul>
                    <li class="'. (($currentPage == 'home')? 'active' : '').'"><a href="'.BASE_URL.'">Home</a></li>
                    <li class="'. ($currentPage == 'about'? 'active' : '') .'"><a href="'.BASE_URL.'index.php/?page=about">About</a></li>
                    <li class="'. ($currentPage == 'courses'? 'active' : '') .'"><a href="'.BASE_URL.'index.php/?page=courses">Courses</a></li>
                    <li class="'. ($currentPage == 'mentors'? 'active' : '') .'"><a href="'.BASE_URL.'index.php/?page=mentors">Mentors</a></li>
                    <!--<li class="'. ($currentPage == 'events'? 'active' : '') .'"><a href="'.BASE_URL.'index.php/?page=events">Events</a></li>-->
                    <!--<li><a href="pricing.html">Pricing</a></li>-->
                    <!--<li class="drop-down"><a href="">Drop Down</a>
                        <ul>
                        <li><a href="#">Drop Down 1</a></li>
                        <li class="drop-down"><a href="#">Deep Drop Down</a>
                            <ul>
                            <li><a href="#">Deep Drop Down 1</a></li>
                            <li><a href="#">Deep Drop Down 2</a></li>
                            <li><a href="#">Deep Drop Down 3</a></li>
                            <li><a href="#">Deep Drop Down 4</a></li>
                            <li><a href="#">Deep Drop Down 5</a></li>
                            </ul>
                        </li>
                        <li><a href="#">Drop Down 2</a></li>
                        <li><a href="#">Drop Down 3</a></li>
                        <li><a href="#">Drop Down 4</a></li>
                        </ul>
                    </li>-->
                    <li class="'. (($currentPage == 'contact')? 'active' : '') .'"><a href="'.BASE_URL.'index.php/?page=contact">Contact</a></li>

                    </ul>
                </nav><!-- .nav-menu -->

                <a href="'.BASE_URL.'index.php/?page=signIn" class="get-started-btn">Sign In</a>

                </div>
            </header><!-- End Header --> 

        ';
        return $html;
    } 
    // return the home page
    public function home($data = []){
        
        
        $courses = '';
        $topPrograms = '';
        $topMentors = '';
        
        if (!empty($data['courses'])){

            // courses with icon 
            foreach($data['courses'] as $key => $course){
                
                $urlCourseName = str_replace(' ', '+', $course['course_name']);

                $courses .= '
                    <div class="col-lg-3 col-md-4 mt-2">
                        <div class="icon-box">
                        <i class="fa fa-'.$course['course_icon'].' fa-lg" style="color: black;"></i>
                        <h3><a href="'.BASE_URL.'index.php/?page=courseDetails&courseName='.$urlCourseName.'&courseId='.encrypt($course['course_id']).'">'.$course['course_name'].'</a></h3>
                        </div>
                    </div>
                ';
            }

        }
    
        //building top programs
        if (!empty($data['topPrograms'])){
            // program cards
            foreach($data['topPrograms'] as $key => $program){
            
                $topPrograms .= $this->generate_program_card_public($program);
                
            }

        }else{
            $topPrograms = '<h3 class="ml-3">Coming Soon....</h3>';
        }
        //building top mentors
        if (!empty($data['Mentors'])){
            // mentor cards 
            $i = 0;
            foreach($data['Mentors'] as $key => $mentor){
                if ($i < 3){
                    $topMentors .= $this->generate_mentor_card_public($mentor);
                }
                $i++;
            }

        }else{
            $topMentors = '<h3 class="ml-3">Coming Soon....</h3>';
        }

        
        $html = '
            <!-- ======= Hero Section ======= -->
            <section id="hero" class="d-flex justify-content-center align-items-center">
                <div class="container position-relative" data-aos="zoom-in" data-aos-delay="100">
                <h1>Learning Today,<br>Leading Tomorrow</h1>
                <h2>Become a Mentor or seek Mentorship from succesful Women.</h2>
                <a href="'.BASE_URL.'index.php/?page=register" class="btn-get-started">Get Started</a>
                </div>
            </section><!-- End Hero -->

            <main id="main">

                <!-- ======= About Section ======= -->
                <section id="about" class="about">
                    <div class="container" data-aos="fade-up">

                        <div class="section-title">
                        <h2>About</h2>
                        <p>About Us</p>
                        </div>

                        <div class="row">
                        <div class="col-lg-6 order-1 order-lg-2" data-aos="fade-left" data-aos-delay="100">
                            <img src="'.BASE_URL.'assets/img/stockPhotos/DSC_1307.jpg" class="img-fluid shadow-lg rounded" alt="">
                        </div>
                        <div class="col-lg-6 pt-4 pt-lg-0 order-2 order-lg-1 content">
                            <h3>Our Purpose Is To</h3>
                           
                            <ul>
                            <li>
                            <i class="icofont-check-circled"></i> 
                            Promote
                            </li>
                            <li>
                            <i class="icofont-check-circled"></i> 
                            Sustain
                            </li>
                            <li>
                            <i class="icofont-check-circled"></i> 
                            Empower 
                            </li>
                            <li>
                            <i class="icofont-check-circled"></i> 
                            Recognize
                            </li>
                            </ul>
                            <p>
                            Women in Micro, Small and Medium-Sized Enterprises
                            </p>
                            <a href="'.BASE_URL.'index.php/?page=about" class="learn-more-btn">Learn More</a>
                        </div>
                        </div>

                    </div>
                </section><!-- End About Section -->

                <!-- ======= Counts Section ======= -->
                <section id="counts" class="counts section-bg">
                    <div class="container">

                        <div class="row counters">

                        <div class="col-lg-4 col-6 text-center">
                            <span data-toggle="counter-up">'.($data['systemSummary']['mentors'] ?? 0).'</span>
                            <p>Mentors</p>
                        </div>

                        <div class="col-lg-4 col-6 text-center">
                            <span data-toggle="counter-up">'.($data['systemSummary']['mentees'] ?? 0).'</span>
                            <p>Mentees</p>
                        </div>

                        <div class="col-lg-4 col-12 text-center">
                            <span data-toggle="counter-up">'.($data['systemSummary']['courses'] ?? 0).'</span>
                            <p>Courses</p>
                        </div>

                        <!--<div class="col-lg-3 col-6 text-center">
                            <span data-toggle="counter-up">'.($data['systemSummary']['mentors'] ?? 0).'</span>
                            <p> Upcoming Events</p>
                        </div>-->

                        </div>

                    </div>
                </section><!-- End Counts Section -->

                <!-- ======= Why Us Section ======= -->
                <section id="why-us" class="why-us">
                    <div class="container" data-aos="fade-up">

                        <div class="row">
                        <div class="col-lg-4 d-flex align-items-stretch">
                            <div class="content">
                            <h3>Want to become a Mentor?</h3>
                            <p>
                                Share your skills and experience by becoming a Mentor.
                            </p>
                            <div class="text-center">
                                <a href="'.BASE_URL.'index.php/?page=about" class="more-btn">Learn More <i class="bx bx-chevron-right"></i></a>
                            </div>
                            </div>
                        </div>
                        <div class="col-lg-8 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="100">
                            <div class="icon-boxes d-flex flex-column justify-content-center">
                            <div class="row">
                                <div class="col-xl-4 d-flex align-items-stretch ">
                                <div class="icon-box mt-4 mt-xl-0 shadow">
                                    <i class="bx bx-receipt"></i>
                                    <h4>Step 1</h4>
                                    <p>Fill out the <a href="'.BASE_URL.'index.php/?page=register" >registration form.</a></p>
                                </div>
                                </div>
                                <div class="col-xl-4 d-flex align-items-stretch">
                                <div class="icon-box mt-4 mt-xl-0 shadow">
                                    <i class="bx bx-check"></i>
                                    <h4>Step 2</h4>
                                    <p>Wait for your account to be approved for mentoring.</p>
                                </div>
                                </div>
                                <div class="col-xl-4 d-flex align-items-stretch">
                                <div class="icon-box mt-4 mt-xl-0 shadow">
                                    <i class="bx bx-chalkboard"></i>
                                    <h4>Step 3</h4>
                                    <p><a href="'.BASE_URL.'index.php/?page=signIn">Sign In</a> to your mentor profile and start sharing your skills.</p>
                                </div>
                                </div>
                            </div>
                            </div><!-- End .content-->
                        </div>
                        </div>

                    </div>
                </section><!-- End Why Us Section -->

                <!-- ======= Features Section ======= -->
                <section id="features" class="features">
                    <div class="container" data-aos="fade-up">

                        <div class="row" data-aos="zoom-in" data-aos-delay="100">

                        '.$courses.'

                        <!--
                            <div class="col-lg-3 col-md-4">
                                <div class="icon-box">
                                <i class="ri-store-line" style="color: #ffbb2c;"></i>
                                <h3><a href="">Program 1</a></h3>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-4 mt-4 mt-md-0">
                                <div class="icon-box">
                                <i class="ri-bar-chart-box-line" style="color: #5578ff;"></i>
                                <h3><a href="">Program 2</a></h3>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-4 mt-4 mt-md-0">
                                <div class="icon-box">
                                <i class="ri-calendar-todo-line" style="color: #e80368;"></i>
                                <h3><a href="">program 3</a></h3>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-4 mt-4 mt-lg-0">
                                <div class="icon-box">
                                <i class="ri-paint-brush-line" style="color: #e361ff;"></i>
                                <h3><a href="">program 4</a></h3>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-4 mt-4">
                                <div class="icon-box">
                                <i class="ri-database-2-line" style="color: #47aeff;"></i>
                                <h3><a href="">program 5</a></h3>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-4 mt-4">
                                <div class="icon-box">
                                <i class="ri-gradienter-line" style="color: #ffa76e;"></i>
                                <h3><a href="">program 6</a></h3>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-4 mt-4">
                                <div class="icon-box">
                                <i class="ri-file-list-3-line" style="color: #11dbcf;"></i>
                                <h3><a href="">Program 7</a></h3>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-4 mt-4">
                                <div class="icon-box">
                                <i class="ri-price-tag-2-line" style="color: #4233ff;"></i>
                                <h3><a href="">Program 8</a></h3>
                                </div>
                            </div>
                        -->
                        </div>

                    </div>
                </section><!-- End Features Section -->

                <!-- ======= Top 3 Courses Section ======= -->
                <section id="popular-courses" class="courses">
                    <div class="container" data-aos="fade-up">

                        <div class="section-title">
                            <h2>Mentorship</h2>
                            <p>Top 3 Courses</p>
                        </div>

                        <div class="row" data-aos="zoom-in" data-aos-delay="100">

                            '.($topPrograms ?? '<h3 class="pl-3">Coming Soon...</h3>').'
                    
                        </div>    
                    </div>
                </section><!-- End Popular Courses Section -->

                <!-- ======= Top 3 Mentors Section ======= -->
                <section id="trainers" class="trainers">
                    <div class="container" data-aos="fade-up">

                        <div class="section-title">
                        <h2>Mentors</h2>
                        <p>Top 3 Mentors</p>
                        </div>

                        <div class="row" data-aos="zoom-in" data-aos-delay="100">
                            '.($topMentors ?? '<h3 class="pl-3">Coming Soon...</h3>').'

                        </div>

                    </div>
                </section><!-- End Trainers Section -->

            </main><!-- End #main --> 
        ';
        return $html;
    }
    // return html struture for a banner
    public function banner($title = '', $description = ''){
        $html = '
            <!-- ======= Breadcrumbs ======= -->
            <div class="breadcrumbs" data-aos="fade-in">
                <div class="container pt-5 pt-md-0">
                    <h2>'.$title.'</h2>
                    <p>'.$description.'</p>
               </div>
            </div><!-- End Breadcrumbs -->

        ';
        return $html;
    }
    // Displays the course Detial information
    public function courseDetails($data = []){

        $cards = '';
        $moreMentorCards = '';
        $courseOutlineDownloadLink = '';
        $courseOutline = '';
        $tabs = '';
        $tabContent = '';
        $viewMoreMentorsBtn = '';
        $courseOutlineSection = '';
        
        //checking if we recieved courseMentors that contain the top mentors
        if (!empty($data['courseMentors'])){

            foreach($data['courseMentors'] as $key => $top){
                //creating top mentor cards

                //giving mentor program rating by replacing mentor overall rating 
                $top['mentor']['rating'] = $data['courseMentors'][$key]['program']['rating'];
                $cards .= $this->generate_mentor_card_public($top['mentor']);
               
            }

        }else{
            $cards = '<h3 class="ml-3">Coming Soon...</h3>';
        }
        //building more mentor cards that are not top 3
        if (!empty($data['moreMentors'])){

            foreach($data['moreMentors'] as $key => $mentors){
                //creating top mentor cards
                $moreMentorCards .= $this->generate_mentor_card_public($mentors);
            }
            //view the other mentors link 
            $viewMoreMentorsBtn = '
                <span class="d-flex justify-content-center">
                    <a href="#trainers" id="view-all-mentors" class="btn btn-link mt-3"><i class="fa fa-eye fa-lg"></i> <span id="view-all-mentors-text">View</span> all Mentors</a>
                </span>
            ';
        }else{
            $moreMentorCards = '';
        }


        if (isset($data['course']['outline_scr']) && $data['course']['outline_scr'] != ''){
            $courseOutlineDownloadLink = '
                <div class="row col-12 d-flex justify-content-center">

                    <a class="mt-5 text-primary" href="'.$data['course']['outline_scr'].'"><i class="fa fa-download"></i> Download the Course Outline here</a>

                </div>
            ';
        }
        if (!empty($data['courseOutline'])){
            //creating tabs and tab content
            $courseOutline = $this->generate_tabbed_content_public($data['courseOutline']);
            
            $courseOutlineSection = '
            <!-- ======= Cource Details Tabs Section ======= -->
                <section id="cource-details-tabs" class="cource-details-tabs">
                  <div class="container" data-aos="fade-up">
            
                    '.$courseOutline.'
                    '.$courseOutlineDownloadLink.'

                  </div>
                </section><!-- End Cource Details Tabs Section -->
            ';
        }
        $html = '
            <main id="main">

                '.$this->banner('Course Details', 'Check out our Mentors and request Mentorship or become a mentors yourself!.').'
                
            
                <!-- ======= Cource Details Section ======= -->
                <section id="course-details" class="course-details">
                    <div class="container" data-aos="fade-up">
                
                        <div class="row">
                            <div class="col-lg-12">
                                <span class="d-flex justify-content-center">
                                    <img src="'.($data['course']['image_src'] ?? BASE_URL."assets/img/logos/fep_logo.png").'" class="img-fluid" alt="">
                                </span>
                                <span class="d-flex justify-content-end mt-3 mb-1">
                                    <a href="'.BASE_URL.'index.php/?page=signIn" class="h4 get-started-btn btn-lg mr-0"><i class="fa fa-paper-plane-o fa-lg"></i> Become a Mentor</a>
                                </span>
                                <h3>'.($data['course']['course_name']?? 'Name not listed yet...').'</h3>
                                <p>
                                    '.($data['course']['course_summary']?? 'No description has been provided for this course yet...').'
                                </p>
                            </div>
                            
                        </div>
                
                    </div>
                </section><!-- End Course Details Section -->
                
                <!-- ======= Cource Details Tabs Section ======= -->
                <section id="cource-details-tabs" class="cource-details-tabs">
                  <div class="container" data-aos="fade-up">
            
                    '.$courseOutline.'
                    '.$courseOutlineDownloadLink.'

                  </div>
                </section><!-- End Cource Details Tabs Section -->

                <!-- ======= Top 3 Mentors Section ======= -->
                <section id="trainers" class="trainers">
                    <div class="container" data-aos="fade-up">

                        <div class="section-title">
                            <h2>Mentors
                            </h2>
                            <p>Most Popular Mentors</p>
                        </div>

                        <div class="row" data-aos="zoom-in" data-aos-delay="100">
                            
                            '.$cards.'

                        </div>
                        <span id="more-mentors" class="d-none">
                            <div class="row " data-aos="zoom-in" data-aos-delay="100">
                                
                                '.$moreMentorCards.'

                            </div>
                        </span>
                        '.$viewMoreMentorsBtn.'

                    </div>
                </section><!-- End Trainers Section -->

            </main><!-- End #main -->
        ';
        return $html;
    }
    // Displays the mentor Course details
    public function mentorCourseDetails($data = []){

        $testimonialSection = '';
        $courseOutline= '';
        $rating = $data['program']['rating'] ?? 0;

        //creating tabs and tab content
        $courseOutline = $this->generate_tabbed_content_public($data['courseOutline']);

        //generating testimonials
        $testimonialSection = $this->generate_testimonials_public($data['testimonials']);

        $starRating = $this->create_start_rating($rating);
       
        $occupation = '';
        
        //getting occupation
        if (!empty($data['mentor']['professions']) && $data['mentor']['professions'][0] != ''){
            foreach($data['mentor']['professions'] as $key => $profession){
                $occupation .= ($key == 0 ? '': ', ').$data['mentor']['professions'][$key];
            }
        }else{
            $occupation = 'N/a';
        }

        if ($courseOutline != ''){
            $couresOutlineSection = '
            <!-- ======= Cource Details Tabs Section ======= -->
            <section id="cource-details-tabs" class="cource-details-tabs">
              <div class="container" data-aos="fade-up">
        
                '.$courseOutline.'
                
                <div class="row col-12 d-flex justify-content-center">
    
                    <a class="mt-5 text-primary" href="'.($data['courseOutline'] ?? '#').'"><i class="fa fa-download"></i> Download the Course Outline here</a>
    
                </div>
    
              </div>
            </section><!-- End Cource Details Tabs Section -->
            ';
        }
        
        $html = '
        
        <main id="main">

        '.$this->banner('Mentor Program Details', 'Check out this mentors Course profile, if you like what you see why not try requesting mentorship!').'
        
    
        <!-- ======= Cource Details Section ======= -->
        <section id="course-details" class="course-details">
          <div class="container" data-aos="fade-up">
    
            <div class="row">
              <div class="col-lg-8">
                <img src="'.($data['program']['course_pic'] ?? BASE_URL."assets/img/logos/fep_logo.png").'" class="img-fluid" alt="">
                <h3>'.($data['program']['course_name']).'</h3>
                <p>
                 '.($data['program']['summary']??'Course Summary is not set yet....').'
                </p>
              </div>
              <div class="col-lg-4">
    
                <div class="course-info d-flex justify-content-between align-items-center">
                  <h5>Mentor:</h5>
                  <a href="'.BASE_URL.'index.php/?page=mentorBio&mentorId='.encrypt($data['mentor']['mentor_id']??'').'">'.($data['mentor']['mentor_name']).'</a>
                </div>
    
                <div class="course-info d-flex justify-content-between align-items-center">
                  <h5>Occupation:</h5>
                  <p ml-1>'.$occupation.'</p>
                </div>

                <div class="course-info d-flex justify-content-between align-items-center">
                  <h5>Mentees:</h5>
                  <p>'.($data['program']['total_enrollment']).'</p>
                </div>
                <div class="course-info d-flex justify-content-between align-items-center">
                    <h5>Rating:</h5>
                    <p>
                      '.$starRating.'
                    </p>
                </div>
                <div class="d-flex justify-content-center">

                    <a href="'.BASE_URL.'index.php/?page=register" class="get-started-btn mr-0 ml-0"><i class="fa fa-paper-plane"></i> Request Mentorship</a>

                </div>
    
    
              </div>
            </div>
    
          </div>
        </section><!-- End Cource Details Section -->
       
      

        '.$testimonialSection.'
            
        
      
      </main><!-- End #main -->
    
        
        ';
        return $html;
    }
    //Displays the profile of a mentor
    public function mentorBio($data = []){

        $courseTags = '';
        $testimonials = '';
        $testimonialSection = '';
        $rating = $data['mentor']['rating'] ?? 3;

        

        //generating testimonials
        $testimonialSection = $this->generate_testimonials_public($data['testimonials']);

        $starRating = $this->create_start_rating($rating);
       
        $occupation = '';
        $socialIcons = '';

        //getting social media links
        if (!empty($data['mentor']['social_networks'])){

            foreach($data['mentor']['social_networks'] as $key => $socialNetwork){

                $socialIcons .= '
                        <a href="'.$socialNetwork['sn_url'].'"><i class="'.$socialNetwork['sn_icon'].'"></i></a>
                ';
            }
            $socialIcons = '
                <div class="social">
                '.$socialIcons.'
                </div>
            ';

        }

        //getting occupation
        if (!empty($data['mentor']['professions']) && $data['mentor']['professions'][0] != ''){
            foreach($data['mentor']['professions'] as $key => $profession){
                $occupation .= ($key == 0 ? '': ', ').$data['mentor']['professions'][$key];
            }
        }else{
            $occupation = 'N/a';
        }
        // $courseId = (isset($data[]['courseId'])? encrypt($data['courseId']) : 0);

        foreach($data['programs'] as $key => $program){
            
            $courseTags .= '
            <a href="'.BASE_URL.'index.php/?page=mentorCourseDetails&programId='.encrypt($program['program_id']).'">
                <span class="badge badge-pill badge-secondary mt-2"><i class="fa fa-tag fa-lg"></i> '.($program['course_name'] ?? 'N/A').'</span>
            </a>
            ';
        }

        
        //generating testimonials
        $testimonialSection = $this->generate_testimonials_public($data['testimonials']);

        $starRating = $this->create_start_rating($rating);
        
        $html = '
            <main id="main">

                '.$this->banner('Mentor Profile', 'Get to know the mentor!').'

               
                <!-- ======= Cource Details Section ======= -->
                <section id="course-details" class="course-details">
                    <div class="container" data-aos="fade-up">
                
                        <div class="row">
                            <div class="col-lg-4">

                                <!-- ======= Mentor Profile card ======= -->
                                <div id="trainers" class="trainers">
                                    <div class="container" data-aos="fade-up">
                                        <div data-aos="zoom-in" data-aos-delay="100">
                                            <div class="d-flex align-items-stretch">
                                                <div class="member shadow">
                                                    <img src="'.($data['mentor']['profile_pic'] ?? BASE_URL."img/profileImg/default-profile-pic-4.png").'" class="img-fluid mb-3" alt="">
                                                   
                                                    <div class="member-content">
                                                        <h4>'.($data['mentor']['mentor_name'] ?? 'N/a').'</h4>
                                                        '.$socialIcons.'
                                                    <div class="d-flex justify-content-center">
                                                        <a href="'.BASE_URL.'index.php/?page=signIn" class="get-started-btn  mt-3 mr-0 ml-0"><i class="fa fa-paper-plane-o fa-lg"></i> Request Mentorship</a>
                                                    </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- End Trainers Section -->
                                
                            
                            </div>
                            <div class="col-lg-8">
                    
                                <div class="course-info d-flex justify-content-between align-items-center">
                                    <h4 class="font-weight-bold h2">Mentor</h4>
                               
                                </div>
                    
                                <div class="course-info d-flex justify-content-between align-items-center">
                                <p class="font-weight-bold h5">Occupation:</p>
                                <h6 class="mt-2">'.($occupation ?? 'N/a').'</h6>
                                </div>

                                <div class="course-info d-md-flex justify-content-md-between align-items-md-center">
                                <p class="font-weight-bold h5">Course(s): </p>
                                <span class="h5 d-block d-md-inline ">
                                   '.$courseTags.'
                                
                                </span>
                                </div>
                    
                                <div class="course-info d-flex justify-content-between align-items-center">
                                    <p class="font-weight-bold h5">Rating:</p>
                                    <p>
                                        '.$starRating.'  
                                    </p>
                                </div>

                                <div class="course-info">
                                    <p class="font-weight-bold h5" >About Mentor:</p>
                                    <br>
                                    <h6>
                                        '.($data['mentor']['about']?? 'Mentor has not set a their Bio as yet....').'
                                    </h6>
                                </div>
                    
                    
                            </div>
                        </div>
                
                    </div>
                </section><!-- End Cource Details Section -->

                '.$testimonialSection.'

            
            </main><!-- End #main -->        
        ';
        return $html;
    }
    //Displays info about information   
    public function aboutUs(){

        
        $html = '
                <main id="main">
                    '.$this->banner('About Us', 'Learn more about what Female Entrepreneurs Belize is doing!').'

                    <!-- ======= Why Us Section ======= -->
                    <section id="why-us" class="why-us pb-5 mb-0">
                        <div class="container" data-aos="fade-up">
                        <!-- ======= Trainers Section ======= -->
            
                            <div class="section-title pb-2">
                                <h2>Our Purpose is to</h2>
                                <p>Purpose</p>
                            </div>
                            
                            <div class="row">
                                <div class="col-lg-12 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="100">
                                    <div class="icon-boxes d-flex flex-column justify-content-center">
                                        <div class="row">
                                            <div class="col-xl-3 d-flex align-items-stretch">
                                                <div class="icon-box mt-4 mt-xl-0 shadow">
                                                    <i class="fa fa-bullhorn"></i>
                                                    <h4>Promote</h4>
                                                    <p>Women in Micro, Small and Medium-Sized Enterprises</p>
                                                </div>
                                            </div>
                                            <div class="col-xl-3 d-flex align-items-stretch">
                                                <div class="icon-box mt-4 mt-xl-0 shadow">
                                                    <i class="bx bx-donate-heart"></i>
                                                    <h4>Sustain</h4>
                                                    <p>Women in Micro, Small and Medium-Sized Enterprises</p>
                                                </div>
                                            </div>
                                            <div class="col-xl-3 d-flex align-items-stretch">
                                                <div class="icon-box mt-4 mt-xl-0 shadow">
                                                    <i class="fa fa-hand-rock-o"></i>
                                                    <h4>Empower</h4>
                                                    <p>Women in Micro, Small and Medium-Sized Enterprises</p>
                                                </div>
                                            </div>
                                            <div class="col-xl-3 d-flex align-items-stretch">
                                                <div class="icon-box mt-4 mt-xl-0 shadow">
                                                    <i class="bx bx-trophy"></i>
                                                    <h4>Recognize</h4>
                                                    <p>Women in Micro, Small and Medium-Sized Enterprises</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div><!-- End .content-->
                                </div>
                            </div>
                        </div>
                    </section><!-- End Why Us Section -->
                    <!-- ======= About Section ======= -->
                    <section id="about" class="about">
                        <div class="container" data-aos="fade-up">
                            
                            
                            <div class="row">
                                <div class="col-lg-6 order-1 order-lg-2" data-aos="fade-left" data-aos-delay="100">
                                <img src="'.BASE_URL.'assets/img/stockPhotos/DSC_4942.JPG" class="img-fluid shadow-lg rounded" alt="">
                                </div>
                                <div class="col-lg-6 pt-4 pt-lg-0 order-2 order-lg-1 content">
                                
                                <div class="section-title pb-2">
                                    <h2>Our Mission is to</h2>
                                    <p>Mission</p>
                                </div>
                                
                                <ul>
                                    <li>
                                    <i class="icofont-hand-drawn-right"></i> 
                                    To collaboratively provide a platform that unites women entrepreneurs and empowers them to achieve, succeed and prosper long term high impact catalyst for change in the MSME
                                    </li>
                                    <li>
                                    <i class="icofont-hand-drawn-right"></i> 
                                    To facilitate the highest quality of entrepreneurship for empowerment amongst women whilst increasing the growth of
                                    women throughout MSME by delivering programs such as training, market distribution, economic networking, finance,
                                    information technology, and exporting that contributes to their personal and professional development
                                    </li>
                                    <li>
                                    <i class="icofont-hand-drawn-right"></i> 
                                    It is our mission to collaboratively empower long-term high-impact catalysts for change and 
                                    continuing to stay competitive in tomorrow\'s world.
                                    </li>
                                    <li>
                                    <i class="icofont-hand-drawn-right"></i> 
                                    Promote women entrepreneurs, while offering an organized and welcoming network to transact business, strengthen abilities,
                                    create business prospects, and provide mentoring programs to develop their entrepreneurship skills.
                                    </li>
                                </ul>
                                

                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-lg-6 order-1 order-lg-2" data-aos="fade-left" data-aos-delay="100">
                                <img src="'.BASE_URL.'assets/img/stockPhotos/DSC_5133.JPG" class="img-fluid shadow rounded" alt="">
                                </div>
                                <div class="col-lg-6 pt-4 pt-lg-0 order-2 order-lg-1 content">
                                <div class="section-title pb-2">
                                    <h2>Our Vision is to</h2>
                                    <p>Vision</p>
                                </div>
                                
                                <ul>
                                    <li>
                                    <i class="icofont-hand-drawn-right"></i> 
                                    To change the future of women in MSME globally by creating networking platforms for advancement, developing relationships and promoting the 
                                    progress of members through business and career growth.
                                    </li>
                                    <li>
                                    <i class="icofont-hand-drawn-right"></i> 
                                    To make a global change for women amid caste, income and ethnicity are encouraged and nurtured to achieve their potential.
                                    </li>
                                    <li>
                                    <i class="icofont-hand-drawn-right"></i> 
                                    Provide global resources for women entrepreneurs to stimulate growth, prosperity and infinite opportunities.
                                    </li>
                                </ul>
                                

                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-lg-6 order-1 order-lg-2" data-aos="fade-left" data-aos-delay="100">
                                <img src="'.BASE_URL.'assets/img/stockPhotos/DSC_0165.jpg" class="img-fluid shadow rounded" alt="">
                                </div>
                                <div class="col-lg-6 pt-4 pt-lg-0 order-2 order-lg-1 content">
                                    <div class="section-title pb-2">
                                        <h2>Committed to</h2>
                                        <p>Value</p>
                                    </div>
                                    
                                    <ul>
                                        <li><i class="fa fa-hand-rock-o" style="font-size: 30px;"></i>
                                            Empowerment
                                        </li>
                                        <li><i class="bx bx-trophy" style="font-size: 30px;"></i> 
                                            Excellence
                                        </li>
                                        <li><i class="fa fa-handshake-o" style="font-size: 30px;"></i> 
                                            Respect
                                        </li>
                                        <li><i class="icofont-unity-hand" style="font-size: 30px;"></i> 
                                            Diversity
                                        </li>
                                        <li><i class="icofont-people" style="font-size: 30px;"></i> 
                                            Team Work
                                        </li>
                                    </ul>
                                    

                                </div>
                            </div>
                        </div>
                    </section><!-- End About Section -->
                   
                    </main><!-- End #main -->


        ';
        return $html;
    }
    //Displays webinars available
    public function webinars($data = []){
    
        $html = '
            <div class="container pt-5 mt-5">
                <h2 class="text-center">Bootstrap 4 User Rating Form / Comment Form</h2>
                
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-2">
                                <img src="https://image.ibb.co/jw55Ex/def_face.jpg" class="img img-rounded img-fluid"/>
                                <p class="text-secondary text-center">15 Minutes Ago</p>
                            </div>
                            <div class="col-md-10">
                                <p>
                                    <a class="float-left" href="https://maniruzzaman-akash.blogspot.com/p/contact.html"><strong>Maniruzzaman Akash</strong></a>
                                    <span class="float-right"><i class="text-warning fa fa-star"></i></span>
                                    <span class="float-right"><i class="text-warning fa fa-star"></i></span>
                                    <span class="float-right"><i class="text-warning fa fa-star"></i></span>
                                    <span class="float-right"><i class="text-warning fa fa-star"></i></span>

                            </p>
                            <div class="clearfix"></div>
                                <p>Lorem Ipsum is simply dummy text of the pr make  but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
                                <p>
                                    <a class="float-right btn btn-outline-primary ml-2"> <i class="fa fa-reply"></i> Reply</a>
                                    <a class="float-right btn text-white btn-danger"> <i class="fa fa-heart"></i> Like</a>
                            </p>
                            </div>
                        </div>
                            <div class="card card-inner">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <img src="https://image.ibb.co/jw55Ex/def_face.jpg" class="img img-rounded img-fluid"/>
                                            <p class="text-secondary text-center">15 Minutes Ago</p>
                                        </div>
                                        <div class="col-md-10">
                                            <p><a href="https://maniruzzaman-akash.blogspot.com/p/contact.html"><strong>Maniruzzaman Akash</strong></a></p>
                                            <p>Lorem Ipsum is simply dummy text of the pr make  but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
                                            <p>
                                                <a class="float-right btn btn-outline-primary ml-2">  <i class="fa fa-reply"></i> Reply</a>
                                                <a class="float-right btn text-white btn-danger"> <i class="fa fa-heart"></i> Like</a>
                                        </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
            </div>  
        ';

        return $html;
    }
    //Displays mentors
    public function mentors($data = []){
        
        $cards = '';                            //holds all the card html markup
        $count = 0;                             //keeps track of how much cards have been made
        $maxCardPerPage = 6;                    //capacity of course cards per page for pagination
        $possibleCardTotal = $maxCardPerPage;   //gets added +6 everytime course cards reach maxCoursePerPage;
        $pageCount = 0;                         //page count for pagination
        $pages = '';                            //hold a the pages for the pagination
        $pageContent = '';                      //contains all the pages and pagination elements

        if(!empty($data['mentors'])){
            
            foreach($data['mentors'] as $key => $mentor){
                
                $cards .= $this->generate_mentor_card_public($mentor);
                
               
                if ($count == ($possibleCardTotal-1)){
                    //creating page because we reached out maximum cards per page
                    $pageCount++;
                    $pages .= '
                        <div id="page-'.$pageCount.'"> 
                            <div class="row" data-aos="zoom-in" data-aos-delay="100">
                            '.$cards.'
                            </div>
                        </div>
                    ';
                    $cards = '';
                    $possibleCardTotal += $maxCardPerPage; // increasing count for another page to be added
                }

                $count++;


            }

            // Creating a page for the remaining Course Cards
            if ($count <= $possibleCardTotal){
                
                if ($count != ($possibleCardTotal - $maxCardPerPage)){
                    //if we have more cards than the maximum amount we will add another page
                    $pageCount++;
                }
                $pages .= '
                    <div id="page-'.$pageCount.'"> 
                        <div class="row" data-aos="zoom-in" data-aos-delay="100">
                            '.$cards.'
                        </div>
                    </div>
                ';
            }

            

            // creating pagination 
            $pageContent = '
                <div id="pagination-content">
                    '.$pages.'
                </div>
                <div class="row pt-3">
                    <div class="col-12 d-flex justify-content-center">
                        <div id="pagination-btn"> 
                        </div>  
                    </div>
                </div>
            ';

        }else{
            $pageContent = '<h3 class="">No Course Found...</h3>';
        }

        $html = '
        <main id="main" data-aos="fade-in">
            '.$this->banner('Mentors','Take a look at our mentors or search for a specific mentor!').' 
            
            <form action="'.BASE_URL.'" method="post">
                <div class="container mt-4">
                    <div class="d-flex justify-content-center">
                        <div class="searchbar ui-widget">
                            <input type="hidden" name="action" value="mentorSearch">
                            <input class="search_input" id="mentorSearch" name="searchFor" value="'.($data['searchFor'] ?? '').'" type="text" placeholder="Search for a mentor...">
                            <button type="submit" class="btn btn-link search_icon d-inline"><i class="fa fa-search fa-lg"></i></a>
                        </div>
                    </div>
                </div>
            </form>
            
            
            
            <!-- ======= Trainers Section ======= -->
            <section id="trainers" class="trainers">
                <div class="container" data-aos="fade-up">

                    <div class="section-title">
                        <h2>Mentors</h2>
                        <p>Mentors</p>
                    </div>
            
                    '.$pageContent.' 
            
                </div>
            </section><!-- End Trainers Section -->
        
        </main><!-- End #main -->
        <script>
            setPaginationTotalCount('.$pageCount.');
        </script>
    
        
        ';
        return $html;
    }
    //Displays Events taken place   
    public function events(){
        $html = '
            <main id="main">
                '.$this->banner('Events', 'Up Coming Events').'
                <!-- ======= Events Section ======= -->
                <section id="events" class="events">
                    <div class="container" data-aos="fade-up">
                
                        <div class="row">
                        <div class="col-md-6 d-flex align-items-stretch">
                            <div class="card">
                            <div class="card-img">
                                <img src="'.BASE_URL.'assets/img/events-1.jpg" alt="...">
                            </div>
                            <div class="card-body">
                                <h5 class="card-title"><a href="">Introduction to webdesign</a></h5>
                                <p class="font-italic text-center">Sunday, September 26th at 7:00 pm</p>
                                <p class="card-text">Lorem ipsum dolor sit amet, consectetur elit, sed do eiusmod tempor ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat</p>
                            </div>
                            </div>
                        </div>
                        <div class="col-md-6 d-flex align-items-stretch">
                            <div class="card">
                            <div class="card-img">
                                <img src="'.BASE_URL.'assets/img/events-2.jpg" alt="...">
                            </div>
                            <div class="card-body">
                                <h5 class="card-title"><a href="">Marketing Strategies</a></h5>
                                <p class="font-italic text-center">Sunday, November 15th at 7:00 pm</p>
                                <p class="card-text">Sed ut perspiciatis unde omnis iste natus error sit voluptatem doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo</p>
                            </div>
                            </div>
                
                        </div>
                        </div>
                
                    </div>
                </section><!-- End Events Section -->
            </main><!-- End #main -->
        ';
        return $html;
    }
    // Will display all the mentorship programs available
    public function courses($data = []){

      

        $cards = '';                            //holds all the card html markup
        $count = 0;                             // keeps track of how much cards have been made
        $maxCardPerPage = 6;                    //capacity of course cards per page for pagination
        $possibleCardTotal = $maxCardPerPage;   //gets added +6 everytime course cards reach maxCoursePerPage;
        $pageCount = 0;                         // page count for pagination
        $pages = '';                            // hold a the pages for the pagination
        $pageContent = '';                      //contains all the pages and pagination elements

        if(!empty($data['courses'])){
            
            foreach($data['courses'] as $key => $course){
                
                //getting course card
                $cards .= $this->generate_course_card_public($course);
                               
                if ($count == ($possibleCardTotal-1)){
                    //creating page because we reached out maximum cards per page
                    $pageCount++;
                    $pages .= '
                        <div id="page-'.$pageCount.'"> 
                            <div class="row" data-aos="zoom-in" data-aos-delay="100">
                            '.$cards.'
                            </div>
                        </div>
                    ';
                    $cards = '';
                    $possibleCardTotal += $maxCardPerPage; // increasing cardTotal for another page to be added
                }

                $count++;
            }

            // Creating a page for the remaining Course Cards
            if ($count <= $possibleCardTotal){
                
                if ($count != ($possibleCardTotal - $maxCardPerPage)){
                    //if we have more cards than the maximum amount we will add another page
                    $pageCount++;
                }
                //creating a page for cards
                $pages .= '
                    <div id="page-'.$pageCount.'"> 
                        <div class="row" data-aos="zoom-in" data-aos-delay="100">
                            '.$cards.'
                        </div>
                    </div>
                ';
            }

            // creating pagination with pages
            $pageContent = '
                <div id="pagination-content">
                    '.$pages.'
                </div>
                <div class="row pt-3">
                    <div class="col-12 d-flex justify-content-center">
                        <div id="pagination-btn"> 
                        </div>  
                    </div>
                </div>
            ';

        }

        $html = '
        <main id="main" data-aos="fade-in">
            '.$this->banner('Courses', 'These are the courses we currently offer. Find a mentor for the course or become a mentor.').'           

            <form action="'.BASE_URL.'" method="post">
                <div class="container mt-4">
                    <div class="d-flex justify-content-center">
                        <div class="searchbar ui-widget">
                            <input type="hidden" name="action" value="courseSearch">
                            <input class="search_input" id="courseSearch" name="searchFor" value="'.($data['searchFor'] ?? '').'" type="text" placeholder="Search for a course...">
                            <button type="submit" class="btn btn-link search_icon d-inline"><i class="fa fa-search fa-lg"></i></a>
                        </div>
                    </div>
                </div>
            </form>

            <!-- ======= Courses Section ======= -->
            <section id="courses" class="courses">
                <div class="container" data-aos="fade-up">
                    
                    <div class="section-title">
                        <h2>Mentorship</h2>
                        <p>Courses</p>
                    </div>
                    '.$pageContent.'
                </div>
            </section><!-- End Courses Section -->
        </main><!-- End #main -->
    
        <script>
            setPaginationTotalCount('.$pageCount.');
        </script>
        
        ';
        return $html;
    }
    //Displays a 404 page error
    public function pageNotFound(){
        $html = $this->banner('Oops! The page was not found', 'Sorry we could not find the page your were looking for').'
            <main id="main">
                <div class="container">
                    <div class="row d-flex justify-content-center">
                        <div class="col-12 col-md-5">
                            <div class="card mt-4 login-form shadow-lg ">
                                <div class="card-header"
                                <div class="card-body">
                                    <h3 class="text-center">404 Page Not Found</h3>		
                                    <hr>
                                    <div class="form-group">
                                        <p class="text-center">
                                            <a href="'.BASE_URL.'"><i class="fa fa-home"></i> Go to Home</a>
                                        </p>
                                    </div>
                                </div>    
                            </div>
                            
                        </div>
                    </div>
                </div>
            </main>    
                        

        ';
        return $html;
        
    }
    // Displays a signIn form
    public function signIn($data = []){
             
        $html = $this->banner('Sign In', 'Sign in using your facebook, google or custom Sign In credentials').'
        <main id="main">
            <div class="container">
                <div class="row d-flex justify-content-center">
                    <div class="col-12 col-md-5">
                        <div class="card mt-4 login-form shadow-lg">
                            <div class="card-body">
                                '.($data['message'] ?? '').'
                                <form action="'.BASE_URL.'" method="post">
                                    <input type="hidden" name="action" value="signIn">
                                    <h3 class="text-center">Sign in</h3>		
                                    <div class="text-center">
                                        <a href="'.($data['fbAuthLink'] ?? '').'" class="btn btn-primary btn-block social-btn" id="facebook-signin"><i class="fa fa-facebook fa-lg"></i> Sign in with <b>Facebook</b></a>
                                        <a href="'.($data['googleAuthLink'] ?? '').'" class="btn btn-danger btn-block social-btn" id="google-signin"><i class="fa fa-google fa-lg"></i> Sign in with <b>Google</b></a>
                                    </div>
                                    <div class="or-seperator"><i>or</i></div>
                                    <div class="form-group">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1"><i class="fa fa-user fa-lg"></i></span>
                                            </div>
                                            <input type="text" class="form-control" name="email" aria-label="emial" aria-describedby="basic-addon1" placeholder="Enter your email" required="required">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1"><i class="fa fa-lock fa-lg"></i></span>
                                            </div>
                                            <input type="password" name="password" class="form-control" placeholder="**********" aria-label="password" aria-describedby="basic-addon1" required="required">
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-success btn-block login-btn">Sign in</button>
                                    <div class="clearfix pt-2 text-center">
                                        <a href="'.BASE_URL.'index.php/?page=forgotPassword" class="text-success">Forgot Password?</a>
                                    </div>  
                                </form>
                            </div>    
                        </div>  
                    </div>
                </div>
                <div class="row mt-2 d-flex justify-content-center mb-4">
                    <div class="col-12 text-center">
                        <div class="hint-text small">Don\'t have an account? <a href="'.BASE_URL.'index.php/?page=register" class="text-success">Register Now!</a></div> 
                    </div>    
                </div>    
            </div>
        </main>    
                      

        ';
        return $html;
    }
    // Displays a signIn form
    public function signInWithApi($data){
             
        $html = $this->banner('Sign In', 'Sign In by entering your pasword').'
            <main id="main">
                <div class="container">
                    <div class="row d-flex justify-content-center">
                        <div class="col-12 col-md-5">
                            <div class="card mt-4 login-form shadow-lg">
                                <div class="card-body">
                                    <form action="'.BASE_URL.'" method="post">
                                        <input type="hidden" name="action" value="signIn">
                                        <h3 class="text-center">Sign in as </h3> 
                                        <hr>		 
                                        <div class="form-group">
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1"><i class="fa fa-user fa-lg"></i></span>
                                                </div>
                                                <input type="text" class="form-control" name="email" value="'.($data['email'] ?? '').'" aria-label="emial" aria-describedby="basic-addon1" placeholder="Enter your email" required="required">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1"><i class="fa fa-lock fa-lg"></i></span>
                                                </div>
                                                <input type="password" class="form-control" name="password" placeholder="Enter your password" aria-label="password" aria-describedby="basic-addon1" required="required">
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-success btn-block login-btn">Sign in</button>
                                        <div class="clearfix pt-2 text-center">
                                            <a href="'.BASE_URL.'index.php/?page=forgotPassword" class="text-success">Forgot Password?</a>
                                        </div>  
                                    </form>
                                </div>    
                            </div>  
                        </div>
                    </div>
                    <div class="row mt-2 d-flex justify-content-center mb-4">
                        <div class="col-12 text-center">
                            <div class="hint-text small">Don\'t have an account? <a href="'.BASE_URL.'index.php/?page=register" class="text-success">Register Now!</a></div> 
                        </div>    
                    </div>    
                </div>
            </main>    
        ';
        return $html;
    }
    //display a change password form
    public function changePass($data){
             
        $html = $this->banner('Password Reset', 'Please enter a new pasword to login to the system.').'
            <main id="main">
                <div class="container">
                    <div class="row d-flex justify-content-center">
                        <div class="col-12 col-md-5">
                            <div class="card mt-4 login-form shadow-lg">
                                <div class="card-body">
                                    <form action="'.BASE_URL.'" method="post">
                                        <input type="hidden" name="action" value="passReset">
                                        <input type="hidden" name="activationCode" value="'.($data['activationCode']?? '').'">
                                        <h3 class="text-center">Password Reset</h3> 
                                        '.($data['message'] ?? '').'
                                        <hr>
                                        <div class="row">		 
                                            <div class="col-12 pb-2">
                                                <label class="">New Password</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text show-pass" id="basic-addon1"><i class="fa fa-eye fa-lg"></i></span>
                                                    </div>
                                                    <input type="password" class="form-control" name="newPassword" placeholder="**********" aria-label="password" aria-describedby="basic-addon1" required="required">
                                                </div>
                                            </div>
                                            <div class="col-12 pb-2">
                                                <label class="">Confirm Password</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text show-pass" id="basic-addon1"><i class="fa fa-eye fa-lg"></i></span>
                                                    </div>
                                                    <input type="password" class="form-control" name="confirmPassword" placeholder="**********" aria-label="password" aria-describedby="basic-addon1" required="required">
                                                </div>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-success btn-block login-btn">Change Password</button>
                                        <div class="clearfix pt-2 text-center">
                                            <a href="'.BASE_URL.'index.php/?page=signIn" class="text-success">I remember my password</a>
                                        </div>  
                                    </form>
                                </div>    
                            </div>  
                        </div>
                    </div>
                        
                </div>
            </main>    
        ';
        return $html;
    } 
    // Displays a registration from
    public function registration($data = null){
             
        $html = $this->banner('Create an Account', 'Using your facebook, google or custom registration form to become a Mentor or Mentee').'
        <main id="main">
            <div class="container">
                <div class="row d-flex justify-content-center">
                    <div class="col-12 col-md-6">
                        <div class="card mt-4 login-form shadow-lg">
                            <div class="card-header">
                                <h3 class="text-center">Registration Form</h3>
                            </div>
                            <div class="card-body">
                                '.($data['message'] ?? '').'

                                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                    <li class="nav-item">
                                    <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Facebook or Google</a>
                                    </li>
                                    <li class="nav-item">
                                    <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Custom Registration</a>
                                    </li>
                                </ul>
                                <div class="tab-content" id="pills-tabContent">
                                    <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                                        <h4 class="text-center mb-2 mt-2">Register with Facbook or Google</h4>
                                        <div class="text-center">
                                            <a href="'.$data['fbAuthLink'].'" class="btn btn-block social-btn" id="facebook-register"><i class="fa fa-facebook fa-lg"></i> Register with <b>Facebook</b></a>
                                            <a href="'.$data['googleAuthLink'].'" class="btn btn-block social-btn" id="google-register"><i class="fa fa-google fa-lg"></i> Register with <b>Google</b></a>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                                        <form action="'.BASE_URL.'" method="post">
                                            <input type="hidden" name="api" value="'.($data['api'] ?? 0).'">
                                            <input type="hidden" name="action" value="registration">
                                            <!--<div class="or-seperator d-flex justify-content-center justify-content-md-start">
                                                <i class="">Are you a Mentor or Mentee?</i>
                                            </div>--!>
                                            <label class="">Are you a Mentor or Mentee?</label>
                                            <div class="pb-3 pl-3 d-flex justify-content-start ">
                                                <div class="form-check-inline">
                                                    <label class="form-check-label">
                                                        <input type="radio" class="form-check-input" name="userType" value="mentee" checked>Mentee
                                                    </label>
                                                </div>
                                                <div class="form-check-inline">
                                                    <label class="form-check-label">
                                                        <input type="radio" class="form-check-input" name="userType" value="mentor">Mentor
                                                    </label>
                                                </div>
                                            </div>
                                            
                                            <!--<div class="or-seperator"><i>or</i></div>--!>
                                            <div class="row">
                                                <div class="col-12 col-md-6 pb-2">
                                                    <label class="">First Name</label>
                                                    <input type="text" class="form-control" name="firstName" aria-label="firstName" aria-describedby="basic-addon1" placeholder="Enter your first name..." required>
                                                </div>
                                                <div class="col-12 col-md-6 pb-2">
                                                    <label class="">Last Name </label>
                                                    <input type="text" class="form-control" name="lastName" aria-label="emial" aria-describedby="basic-addon1" placeholder="Enter your last name..." required>
                                                </div>
                                                <div class="col-12 col-md-6 pb-2">
                                                    <label class="">DoB</label>
                                                    <input type="date" class="form-control" name="dob" aria-label="dateofbirth" aria-describedby="dateofbirth" placeholder="" required>
                                                </div>
                                                <div class="col-12 col-md-6 pb-2">
                                                    <label class="">Email</label>
                                                    <input type="text" class="form-control" name="email" aria-label="emial" aria-describedby="basic-addon1" placeholder="Enter your email..." required>
                                                </div>
                                                <div class="col-12 pb-2">
                                                    <label class="">New Password</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text show-pass" id="basic-addon1"><i class="fa fa-eye fa-lg"></i></span>
                                                        </div>
                                                        <input type="password" class="form-control" name="newPassword" placeholder="**********" aria-label="password" pattern=".{8,}" aria-describedby="basic-addon1" required title="Enter minimum of 8 characters">
                                                    </div>
                                                </div>
                                                <div class="col-12 pb-2">
                                                    <label class="">Confirm Password</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text show-pass" id="basic-addon1"><i class="fa fa-eye fa-lg"></i></span>
                                                        </div>
                                                        <input type="password" class="form-control" name="confirmPassword" placeholder="**********" aria-label="password" pattern=".{8,}" aria-describedby="basic-addon1" required title="Enter minimum of 8 characters">
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="clearfix pt-2 pl-1">
                                                        <label class="pull-left checkbox-inline"><input type="checkbox" required title="Please accept out Terms and Conditions"> I Accept the <a class="text-success" href="'.BASE_URL.'index.php/?page=terms">Terms and Conditions</a></label>
                                                    </div>  
                                                </div>  
                                                
                                            </div>
                                            <div class="form-group">
                                            </div>
                                            <button type="submit" class="btn btn-success btn-block login-btn">Create Account</button>
                                        </form>
                                    </div>
                                </div>

                            </div>    
                        </div>  
                    </div>
                </div>
                <div class="row mt-2 mb-4 d-flex justify-content-center">
                    <div class="col-12 text-center">
                        <div class="hint-text small">I have an account. <a href="'.BASE_URL.'index.php/?page=signIn" class="text-success">Sign In</a></div> 
                    </div>    
                </div>    
            </div>
        </main>    
            <!--<div class="login-form shadow">
                <form action="'.BASE_URL.'" method="post">
                    <input type="hidden" name="action" value="signIn">
                    <h4 class="text-center">Sign in</h4>		
                    <div class="text-center social-btn">
                        <a href="#" class="btn btn-primary btn-block"><i class="fa fa-facebook"></i> Sign in with <b>Facebook</b></a>
                        <a href="#" class="btn btn-danger btn-block"><i class="fa fa-google"></i> Sign in with <b>Google</b></a>
                    </div>
                    <div class="or-seperator"><i>or</i></div>
                    
                    <div class="form-group">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="fa fa-user"></i></span>
                            </div>
                            <input type="text" class="form-control" aria-label="emial" aria-describedby="basic-addon1" placeholder="Enter your email" required="required">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="fa fa-lock"></i></span>
                            </div>
                            <input type="password" class="form-control" placeholder="**********" aria-label="password" aria-describedby="basic-addon1" required="required">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <button type="submit" class="btn btn-success btn-block login-btn">Sign in</button>
                    </div>
                    <div class="clearfix">
                        <label class="pull-left checkbox-inline"><input type="checkbox"> Remember me</label>
                        <a href="#" class="pull-right text-success">Forgot Password?</a>
                    </div>  
                    
                </form>
                <div class="hint-text small">Don\'t have an account? <a href="#" class="text-success">Register Now!</a></div>
            </div>-->            

        ';
        return $html;
    }
    // Displays a registration pre filled by a API
    public function preFilledRegistration($data = null){

        $profilePic = '';

        if (isset($data['profilePic'])){
            
            $profilePic = '<span class="d-flex justify-content-center"><img class="" src="'.$data['profilePic'].'" alt="Profile Pic" style="width:100px;height:100px;border-radius: 15%;" /></span>';

        }  

        $html = $this->banner('Create an Account', 'Please enter the remaining information').'
        <main id="main">
            <div class="container">
                <div class="row d-flex justify-content-center">
                    <div class="col-12 col-md-6">
                        <div class="card mt-4 login-form shadow-lg">
                            <div class="card-header">
                                <h3 class="text-center">Registration</h3>
                            </div>
                            <div class="card-body">

                                <form action="'.BASE_URL.'" method="post">
                                    <input type="hidden" name="action" value="registration">
                                    <input type="hidden" name="profilePic" aria-label="profilePic" value="'.($data['profilePic'] ?? '').'">
                                    <input type="hidden" name="email" aria-label="emial" value="'.($data['email'] ?? '').'">
                                    <input type="hidden" name="api" value="'.($data['api'] ?? 0).'">
                                    '.$profilePic.'
                                    <label class="">Register as a</label>
                                    <div class="pb-3 pl-3 d-flex justify-content-start ">
                                        <div class="form-check-inline">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input" name="userType" value="mentee" checked>Mentee
                                            </label>
                                        </div>
                                        <div class="form-check-inline">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input" name="userType" value="mentor">Mentor
                                            </label>
                                        </div>
                                    </div>
                                    
                                    <!--<div class="or-seperator"><i>or</i></div>--!>
                                    <div class="row">
                                        <div class="col-12 col-md-6 pb-2">
                                            <label class="">First Name</label>
                                            <input type="text" class="form-control" name="firstName" aria-label="firstName" aria-describedby="basic-addon1" value="'.($data['firstName'] ?? '').'" placeholder="Enter your first name..." required>
                                        </div>
                                        <div class="col-12 col-md-6 pb-2">
                                            <label class="">Last Name </label>
                                            <input type="text" class="form-control" name="lastName" aria-label="emial" aria-describedby="basic-addon1" value="'.($data['lastName'] ?? '').'" placeholder="Enter your last name..." required>
                                        </div>
                                        <div class="col-12 col-md-6 pb-2">
                                            <label class="">DoB</label>
                                            <input type="date" class="form-control" name="dob" aria-label="dateofbirth" aria-describedby="dateofbirth" placeholder="" required>
                                        </div>
                                        <div class="col-12 col-md-6 pb-2">
                                            <label class="">Email</label>
                                            <p class="font-weight-bold">'.($data['email'] ?? '').'</p>
                                        </div>
                                        <div class="col-12 pb-2">
                                            <label class="">New Password</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text show-pass" id="basic-addon1"><i class="fa fa-eye fa-lg"></i></span>
                                                </div>
                                                <input type="password" class="form-control" name="newPassword" placeholder="**********" aria-label="password" aria-describedby="basic-addon1" required="required">
                                            </div>
                                        </div>
                                        <div class="col-12 pb-2">
                                            <label class="">Confirm Password</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text show-pass" id="basic-addon1"><i class="fa fa-eye fa-lg"></i></span>
                                                </div>
                                                <input type="password" class="form-control" name="confirmPassword" placeholder="**********" aria-label="password" aria-describedby="basic-addon1" required="required">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="clearfix pt-2 pl-1">
                                                <label class="pull-left checkbox-inline"><input type="checkbox" required> I Accept the <a class="text-success" href="'.BASE_URL.'index.php/?page=terms">Terms and Conditions</a></label>
                                            </div>  
                                        </div>  
                                        
                                    </div>
                                    <div class="form-group">
                                    </div>
                                    <button type="submit" class="btn btn-success btn-block login-btn">Create Account</button>
                                </form>
                                  

                            </div>    
                        </div>  
                    </div>
                </div>
                <div class="row mt-2 mb-4 d-flex justify-content-center">
                    <div class="col-12 text-center">
                        <div class="hint-text small">I have an account. <a href="'.BASE_URL.'index.php/?page=signIn" class="text-success">Sign In</a></div> 
                    </div>    
                </div>    
            </div>
        </main>    
            <!--<div class="login-form shadow">
                <form action="'.BASE_URL.'" method="post">
                    <input type="hidden" name="action" value="signIn">
                    <h4 class="text-center">Sign in</h4>		
                    <div class="text-center social-btn">
                        <a href="#" class="btn btn-primary btn-block"><i class="fa fa-facebook"></i> Sign in with <b>Facebook</b></a>
                        <a href="#" class="btn btn-danger btn-block"><i class="fa fa-google"></i> Sign in with <b>Google</b></a>
                    </div>
                    <div class="or-seperator"><i>or</i></div>
                    
                    <div class="form-group">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="fa fa-user"></i></span>
                            </div>
                            <input type="text" class="form-control" aria-label="emial" aria-describedby="basic-addon1" placeholder="Enter your email" required="required">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="fa fa-lock"></i></span>
                            </div>
                            <input type="password" class="form-control" placeholder="**********" aria-label="password" aria-describedby="basic-addon1" required="required">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <button type="submit" class="btn btn-success btn-block login-btn">Sign in</button>
                    </div>
                    <div class="clearfix">
                        <label class="pull-left checkbox-inline"><input type="checkbox"> Remember me</label>
                        <a href="#" class="pull-right text-success">Forgot Password?</a>
                    </div>  
                    
                </form>
                <div class="hint-text small">Don\'t have an account? <a href="#" class="text-success">Register Now!</a></div>
            </div>-->            

        ';
        return $html;
    }
    //Displays a thank you page
    public function thankYou(){
        $html = $this->banner('Thank You', 'Thank you for creating an account with us.').'
            <main id="main">
                <div class="container">
                    <div class="row d-flex justify-content-center">
                        <div class="col-12 col-md-5">
                            <div class="card mt-4 login-form shadow-lg">
                                <div class="card-body">
                                    <input type="hidden" name="action" value="signIn">
                                    <h3 class="text-center">Thank You for Registering!</h3>		
                                    <hr>
                                    <div class="form-group">
                                        <p class="text-center">
                                        Please follow the intructions sent to your email to complete the registration process.
                                        </p>
                                    </div>
                                </div>    
                            </div>  
                        </div>
                    </div>
                </div>
            </main>    
                        

        ';
        return $html;
    }
    //Displays the forgot password card
    public function forgotPassword($data = []){
        $html = $this->banner('Sign In', 'Sign in using your facebook, google or custom Sign In credentials').'
            <main id="main">
                <div class="container">
                    <div class="row d-flex justify-content-center">
                        <div class="col-12 col-md-5">
                            <div class="card mt-4 login-form shadow-lg">
                                <div class="card-body">
                                    <form action="'.BASE_URL.'" method="post">
                                        <input type="hidden" name="action" value="forgotPassword">
                                        <h3 class="text-center mb-3">Request Password Reset</h3>		
                                        '.($data['message'] ?? '').'
                                        <div class="form-group">
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1"><i class="fa fa-envelope fa-lg"></i></span>
                                                </div>
                                                <input type="text" class="form-control" aria-label="emial" name="email" aria-describedby="basic-addon1" placeholder="Enter your email" required="required">
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-success btn-block login-btn">Send Request</button>
                                    </form>
                                </div>    
                            </div>  
                        </div>
                    </div>
                    <div class="row mt-2 d-flex justify-content-center mb-4">
                        <div class="col-12 text-center">
                            <div class="hint-text small"><a href="'.BASE_URL.'index.php/?page=signIn" class="text-success">I remember my password</a></div> 
                        </div>    
                    </div>    
                </div>
            </main>    
           
        ';
        return $html;

    }
    //creates a  html markup to be sent via email for registration
    public function emailCard($link){
        $html = '
            <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
            <html xmlns="http://www.w3.org/1999/xhtml" lang="en-GB">
                <head>
                    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
                    <title>Female Entrepreneurs</title>
                    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
                
                    <style type="text/css">
                        a[x-apple-data-detectors] {color: inherit !important;}
                    </style>
                
                </head>
                <body style="margin: 0; padding: 0;">
                    <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
                        <tr>
                            <td style="padding: 20px 0 30px 0;">
                
                                <table align="center" border="0" cellpadding="0" cellspacing="0" width="600" style="border-collapse: collapse; border: 1px solid #cccccc;">
                                    <tr>
                                        <td align="center" bgcolor="#5fcf80" style="padding: 40px 0 30px 0px;">
                                            <img src="https://femaleentrepreneurs.bz/fep/assets/img/logos/fep_logo.png" alt="FEP Logo" width="300" height="auto" style="display: block;" />
                                        </td>
                                        
                                    </tr>
                                    <tr>
                                        <td bgcolor="#ffffff" style="padding: 40px 30px 40px 30px;">
                                            <table border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse: collapse;">
                                                <tr>
                                                    <td style="color: #153643; font-family: Arial, sans-serif;">
                                                        <h1 style="font-size: 24px; margin: 0;">Thank you for registering!</h1>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="color: #153643; font-family: Arial, sans-serif; font-size: 16px; line-height: 24px; padding: 20px 0 30px 0;">
                                                        <p style="margin: 0;">Welcome to the Female Entrepreneurship Program, your account registration is almost Complete. 
                                                        <br><br>
                                                        Please <a href="'.$link.'">click here</a> to activate your account.
                                                        
                                                        </p>
                                                    </td>
                                                </tr>
                                                
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td bgcolor="#5fcf80" style="padding: 30px 30px;">
                                            <table border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse: collapse;">
                                                <tr>
                                                    <td style="color: #ffffff; font-family: Arial, sans-serif; font-size: 14px;" align="center">
                                                        <p style="margin: 0;">&#169; <a href="https://www.belizeinvest.org.bz/" style="color: #ffffff;">BELTRAIDE</a>, Belize '.date('Y').'<br/>
                                                        </p>
                                                    </td>
                                                    
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                
                            </td>
                        </tr>
                    </table>
                </body>
            </html>
        ';

        return $html;
    }
    //Displays contact information
    public function contact($data = array()){
        $html = '
        <main id="main">
        '.$this->banner('Contact Us', 'Got any questions? Send us an email.').'
        
            <!-- ======= Contact Section ======= -->
            <section id="contact" class="contact">
                <div data-aos="fade-up">
                    <iframe style="border:1; width: 100%; height: 350px;" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15220.05176183644!2d-88.1997271!3d17.5068957!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x8d7beaf7b10be549!2sSBDCBelize%2C%20BELTRAIDE!5e0!3m2!1sen!2sbz!4v1603748137616!5m2!1sen!2sbz" frameborder="0" allowfullscreen></iframe>
                </div>
            
                <div class="container" data-aos="fade-up">
            
                    <div class="row mt-5">
            
                    <div class="col-lg-4">
                        <div class="info">
                        <div class="address">
                            <i class="icofont-google-map"></i>
                            <h4>Location:</h4>
                            <p>Fultec Building, 3rd Floor, 831 Coney Drive</p>
                        </div>
            
                        <div class="email">
                            <i class="icofont-envelope"></i>
                            <h4>Email:</h4>
                            <p>SBDCBelize@belizeinvest.org.bz</p>
                        </div>
            
                        <div class="phone">
                            <i class="icofont-phone"></i>
                            <h4>Call:</h4>
                            <p>+501 223-3195</p>
                        </div>
            
                        </div>
            
                    </div>
            
                    <div class="col-lg-8 mt-5 mt-lg-0">
                        '.($data['message'] ?? '').'
                        <span id="contactUsMessage"></span>
                        <form id="contactUsForm" action="'.BASE_URL.'" method="post" class="email-form">
                            <input type="hidden" name="action" value="contactUsEmail">
                            <div class="form-row">
                                <div class="col-md-6 form-group">
                                <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" data-rule="minlen:4" data-msg="Please enter at least 4 chars" required/>
                                <div class="validate"></div>
                                </div>
                                <div class="col-md-6 form-group">
                                <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" data-rule="email" data-msg="Please enter a valid email" required/>
                                <div class="validate"></div>
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" data-rule="minlen:4" data-msg="Please enter at least 8 chars of subject" required/>
                                <div class="validate"></div>
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" name="message" rows="5" data-rule="required" data-msg="Please write something for us" placeholder="Message" required></textarea>
                                <div class="validate"></div>
                            </div>
                            <div class="g-recaptcha mb-3" data-sitekey="'.RECAPTCHA_SITE_KEY.'"></div>
                            <div class="text-center"><button type="submit">Send Message</button></div>
                        </form>
            
                    </div>
            
                    </div>
            
                </div>
            </section><!-- End Contact Section -->
        </div>
        ';
        return $html;
    }
    //Displays the footer
    public function footer(){
        $html = '
            <!-- ======= Footer ======= -->
            <footer id="footer">
                <div class="footer-top">
                <div class="container">
                    <div class="row">

                    <div class="col-12 col-lg-4 col-md-4 footer-contact">
                        <h3>Female Entrepreneurs</h3>
                        <p>
                       
                        Fultec Building, 3rd Floor <br>
                        831 Coney Drive<br>
                        Belize, Belize City<br>
                        Central America<br><br>
                        <strong>Phone:</strong> +(501) 223-3195<br>
                        <strong>Email:</strong> <a href="mailto:SBDCBelize@belizeinvest.org.bz">SBDCBelize@belizeinvest.org.bz</a><br>
                        </p>
                    </div>

                    <div class="col-12 col-lg-4 col-md-4 footer-links">
                        <span class="row col-12 d-flex justify-content-center">
                            <a href="https://www.belizeinvest.org.bz/">
                                <img src="'.BASE_URL.'assets/img/logos/BELTRAIDE_logo.png" alt="BELTRAIDE Logo" width="260" height="auto">
                            </a>
                        </span>
                    </div>

                    <div class="col-12 col-lg-4 col-md-4 footer-newsletter">
                        <!--<h4>Join Our Newsletter</h4>
                        <p>Tamen quem nulla quae legam multos aute sint culpa legam noster magna</p>
                        <form action="" method="post">
                            <input class="form-control" type="email" name="email"><input type="submit" value="Subscribe">
                        </form>-->
                        <span class="row col-12 d-flex justify-content-center justify-content-md-end">
                            <a href="https://www.belizeinvest.org.bz/exportbelize.html">
                                <img src="'.BASE_URL.'assets/img/logos/EXPORTBelize_logo.png" alt="EXPORTBelize Logo" width="210" height="auto">
                            </a>
                        </span>
                        <span class="row col-12 pt-4 d-flex justify-content-center justify-content-md-end">
                            <a href="https://www.belizeinvest.org.bz/sbdcbelize.html">
                                <img src="'.BASE_URL.'assets/img/logos/SBDCBelize_logo.png" alt="SBDCBelize Logo" width="200" height="auto">
                            </a>
                        </span>

                    </div>

                    </div>
                </div>
                </div>

                <div class="container d-md-flex py-4">

                <div class="mr-md-auto text-center text-md-left">
                    <div class="copyright">
                    &copy; Copyright <span><a href="https://www.belizeinvest.org.bz/sbdcbelize.html">SBDC</a></span>. All Rights Reserved
                    </div>
                    <div class="credits">
                    <!-- All the links in the footer should remain intact. -->
                    <!-- You can delete the links only if you purchased the pro version. -->
                    <!-- Licensing information: https://bootstrapmade.com/license/ -->
                    <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/mentor-free-education-bootstrap-theme/ -->
                    Designed by <a href="https://www.belizeinvest.org.bz/">BELTRAIDE </a>'.date('Y').'
                    </div>
                </div>
                <div class="social-links text-center text-md-right pt-3 pt-md-0">
                    <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
                    <a href="www.facebook.com/SBDCBelize" class="facebook"><i class="bx bxl-facebook"></i></a>
                    <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
                    <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
                </div>
                </div>
            </footer><!-- End Footer -->

            <a href="#" class="back-to-top"><i class="bx bx-up-arrow-alt"></i></a>
            <div id="preloader"></div>
            

            <!-- Vendor JS Files -->
            <script src="'.BASE_URL.'assets/vendor/jquery/jquery.min.js"></script>

            <!-- Popper.js -->
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

            <!-- Script for Autocomplete-->
            <!--<script src="https://code.jquery.com/jquery-1.12.4.js"></script>-->
            <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

            <script src="'.BASE_URL.'assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
            <script src="'.BASE_URL.'assets/vendor/jquery.easing/jquery.easing.min.js"></script>
            <script src="'.BASE_URL.'assets/vendor/php-email-form/validate.js"></script>
            <script src="'.BASE_URL.'assets/vendor/waypoints/jquery.waypoints.min.js"></script>
            <script src="'.BASE_URL.'assets/vendor/counterup/counterup.min.js"></script>
            <script src="'.BASE_URL.'assets/vendor/owl.carousel/owl.carousel.min.js"></script>
            <script src="'.BASE_URL.'assets/vendor/aos/aos.js"></script>

            
            <!-- bootpag pagination plugin-->
            <script src="'.BASE_URL.'/js/jquery.bootpag.min.js"></script>
            
            <!-- Template Main JS File -->
            <script src="'.BASE_URL.'assets/js/main.js"></script>

            <!-- Tooltip js file -->
            <script src="'.BASE_URL.'assets/js/tooltip.js"></script>
            
            <!-- Custome jQuery for User interaction with the UI-->
            <script src="'.BASE_URL.'assets/js/jQueryForUI.js"></script>

            <!-- Custome jQuery for User interaction with the UI-->
            <script src="'.BASE_URL.'assets/js/pagination.js"></script>

            

            </body>

            </html>
        ';
        return $html;
    }
    /***************************************************************************************
        Functions below are seperated html content that can be used to create content dynamically
        The functions listed below should only be used on the Public Website
    ****************************************************************************************/

    //Generates a testimonial section on a page 
    //@params array()
    //values need => name, jobtitle, profile image, testimonialText, 
    public function generate_testimonials_public($data = []){

        $testimonials = '';

        foreach($data as $testimonial){
       
            $testimonials .= '
                <div class="testimonial-wrap">
                    <div class="testimonial-item shadow">
                        <img src="'.($testimonial['profileImg'] ?? BASE_URL."img/profileImg/default-profile-pic.png").'" class="testimonial-img" alt="">
                        <h3>'.($testimonial['mentee_name'] ?? 'No text to display....').'</h3>
                        <!--<h4>'.($testimonial['jobTitle'] ?? 'No Job Title listed....').'</h4>-->
                        <p>
                        <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                        '.($testimonial['texto'] ?? 'N/A').'
                        <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                        </p>
                    </div>
                </div>
            ';
        }
        $testimonialSection = '
            <!-- ======= Testimonials Section ======= -->
            <section id="testimonials" class="testimonials">
                <div class="container" data-aos="fade-up">

                    <div class="section-title">
                        <h2>Testimonials</h2>
                        <p>What are they saying</p>
                    </div>

                    <div class="owl-carousel testimonials-carousel" data-aos="zoom-in" data-aos-delay="100">
                        '.$testimonials.'

                    </div>
                </div>
            </section><!-- End Testimonials Section -->
        ';
        
        return $testimonialSection;
    }

    //Generates Course Outline in tabbed content
    //@params array()
    //values need => tab title, tab content
    //provide an array containing all the content you want to display on the tab
    public function generate_tabbed_content_public($data = []){

        $tabs = '';
        $tabContent = '';

        $count = 1;
        if (!empty($data)){
            foreach($data as $key => $tab){
                
                $tabs .= '
                    <li class="nav-item">
                        <a class="nav-link '.(($count == 1)? 'active show' : '').'" data-toggle="tab" href="#tab-'.$count.'">'.($tab['title']).'</a>
                    </li>
                ';
    
                $text = '';
    
                //building tab with multiple content
                foreach($tab['contents'] as $key => $content){
                    
                    if ($key > 0 && $tab['title'] != 'Requirements'){
                        $text .= '<br>';
                    }
                    if ($tab['title'] == 'Requirements'){
                        $text .= '<li><i class="icofont-check-circled"></i>'.$content.'</li>';
                    }else{
                        
                        $text .= $content;
    
                    }
                }
                if ($tab['title'] == 'Requirements'){
        
                    $text = '<ul class="course-outline-content">'.$text.'</ul>';
    
                }
    
                $tabContent .= '
                    <div class="tab-pane '.(($count == 1)? 'active show' : '').'" id="tab-'.$count.'">
                        <div class="row">
                        <div class="col-lg-8 details order-2 order-lg-1">
                            <h3>'.($tab['title'] ?? 'No title was test').'</h3>
                            <!--<p class="font-italic"></p>-->
                            <p>'.($text ?? "No content to display...").'</p>
                        </div>
                        <div class="col-lg-4 text-center order-1 order-lg-2">
                            <img src="assets/img/course-details-tab-1.png" alt="" class="img-fluid">
                        </div>
                        </div>
                    </div>
                ';
                $count++;
            }
            // creating course outline display
            $tabContent = '
                <div class="row">
                    <div class="col-lg-3">
                        <ul class="nav nav-tabs flex-column">
                        '.$tabs.'
                        </ul>
                    </div>
                    <div class="col-lg-9 mt-4 mt-lg-0">
                        <div class="tab-content">
                        '.$tabContent.'
                        </div>
                    </div>
            
                </div>
            ';

        }
       

        return $tabContent;
    }

    //Generates a card for a course 
    //@params array()
    // course id, course name, course overall rating, course description, course image
    public function generate_course_card_public($data = []){

        $courseId = (isset($data['course_id'])? encrypt($data['course_id']) : 0); 
        $rating = ($data['rating'] != 0)? $data['rating'] : 0;
        $starRating = $this->create_start_rating($rating, 'mr-3');
        
        $urlCourseName = str_replace(' ', '+', $data['course_name']);
        
        $summary = $this->make_text_shorter($data['course_summary']);
        
        $html = '
            <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-3">
                <div class="course-item shadow-lg">
                    <a href="'.BASE_URL.'index.php/?page=courseDetails&courseName='.$urlCourseName.'&courseId='.$courseId.'">
                        <img src="'.($data['image_src'] ?? BASE_URL."assets/img/logos/fep_logo.png").'" class="card-img" alt="...">
                    </a>
                    <div class="course-content">
                        <div class="row d-flex justify-content-between align-items-center mb-3">
                            <a href="'.BASE_URL.'index.php/?page=courseDetails&courseName='.$urlCourseName.'&courseId='.$courseId.'" class="text-light"><h4><i class="fa fa-eye fa-lg"></i> View Course</h4></a>
                            '.$starRating.'
                        </div>

                        <h3><a href="'.BASE_URL.'index.php/?page=courseDetails&courseName='.$urlCourseName.'&courseId='.$courseId.'">'.($data['course_name'] ?? 'N/A').'</a></h3>
                        <p>'.$summary.'</p>
                    
                    </div>
                </div>
            </div> <!-- End Course Item-->
        ';
        
        return $html;

    }

    //Generates a card for a top course with a mentor assigned to it 
    //@params array()
    // program id, program name, mentor rating for program, program image, program description, mentor id, mentor name, total mentees in program
    public function generate_program_card_public($data = []){

        $programId = (isset($data['program_id'])? encrypt($data['program_id']) : 0); 
        $mentorId = (isset($data[''])? encrypt($data['mentorId']) : 0);
        $programRating = $data['rating'] ?? 0;
        
        $summary = $this->make_text_shorter($data['summary'] ?? '');
        $urlCourseName = str_replace(' ', '+', $data['course_name']);
        $courseId = (isset($data['course_id'])? encrypt($data['course_id']) : 0); 

        //variables for html content 
        $socialMediaIcons = '';

        $starRating = $this->create_start_rating($programRating, 'mr-3');

        //building card with all other components combined
        $html = '
            <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-3 mt-md-0">
                <div class="course-item shadow">
                    <a href="'.BASE_URL.'index.php/?page=mentorCourseDetails&programId='.$programId.'">
                        <img src="'.($data['course_pic'] ?? BASE_URL."assets/img/logos/fep_logo.png").'" class="card-img" alt="Program Image">
                    </a>
                    <div class="course-content">
                        <div class="row d-flex justify-content-between align-items-center mb-3">
                            <a href="'.BASE_URL.'index.php/?page=signIn" class="text-light"><h4><i class="fa fa-paper-plane-o fa-lg"></i> Request Mentorship</h4></a>
                            '.$starRating.'
                        </div>

                        <h3><a href="'.BASE_URL.'index.php/?page=courseDetails&courseName='.$urlCourseName.'&courseId='.$courseId.'">'.$data['course_name'].'</a></h3>
                        <p>'.$summary.'</p>
                        <div class="trainer d-flex justify-content-between align-items-center">
                            <div class="trainer-profile d-flex align-items-center">
                                <img src="'.($data['profile_pic'] ?? BASE_URL."img/profileImg/default-profile-pic-4.png").'" class="img-fluid" alt="">
                                <span><a href="'.BASE_URL.'index.php/?page=mentorCourseDetails&programId='.$programId.'">'.($data['mentor_name'] ?? 'N/A').'</a></span>
                            </div>
                            <div class="trainer-rank d-flex align-items-center">
                                <span data-toggle="tooltip" data-placement="top" title="Number of Mentees"><i class="fa fa-user-o"></i>&nbsp;'.($data['total_enrollment'] ?? 0).'</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>                  
        ';
        return $html;
    }

    //Generates a card for a top course with a mentor assigned to it 
    //@params array()
    // mentor id, name, overall rating, profle image, mentor bio, job title
    // array(socialMediaLinks) => link, icon 
    public function generate_mentor_card_public($data = []){
        
        // $courseId = (isset($data['courseId'])? encrypt($data['courseId']) : 0); 
        $mentorId = (isset($data['mentor_id'])? encrypt($data['mentor_id']) : 0);
        $rating = $data['rating'] ?? 0;
        $bio = $this->make_text_shorter($data['about'] ?? '');

        //variables for html content 
        $starRating = $this->create_start_rating($rating);
        $socialIcons = '';

        $occupation = '';
        
        if (!empty($data['professions']) && $data['professions'][0] != ''){
            foreach($data['professions'] as $key => $profession){
                $occupation .= ($key == 0 ? '': ', ').$data['professions'][$key];
            }
        }else{
            $occupation = 'Mentor has not set his occupations yet....';
        }

        if($bio == ''){
            $bio = 'Mentor has not set a bio as yet....';
        }
       
        //getting social media links
        if (!empty($data['social_networks'])){

            foreach($data['social_networks'] as $key => $socialNetwork){

                $socialIcons .= '
                        <a href="'.$socialNetwork['sn_url'].'"><i class="'.$socialNetwork['sn_icon'].'"></i></a>
                ';
            }
            $socialIcons = '
                <div class="social">
                '.$socialIcons.'
                </div>
            ';

        }

        $html = '
            <div class="col-12 col-lg-4 col-md-6 d-flex align-items-stretch mt-2 mt-md-0">
                <div class="member shadow-lg">
                    <img src="'.($data['profile_pic'] ?? BASE_URL."img/profileImg/default-profile-pic-4.png").'" class="img-fluid mb-3" alt="">
                    <div class="member-content mb-5">
                        <h4 class="mb-2"><a href="'.BASE_URL.'index.php/?page=mentorBio&mentorId='.$mentorId.'">'.($data['mentor_name'] ?? 'N/A').'</a></h4>
                        '.$starRating.'
                        <span class="mt-2">'.$occupation.'</span>
                        <p>
                        '.$bio.'
                        </p>
                        '.$socialIcons.'
                        
                         
                    </div>
                    <div class="stay-bottom">
                        <a href="'.BASE_URL.'index.php/?page=signIn" class="get-started-btn mt-3 mr-0 ml-0"><i class="fa fa-paper-plane-o fa-lg"></i> Request Mentorship</a>
                    </div>
                </div>
            </div>              
        ';
        
        return $html;
    }

    /***************************************************************************************
        Functions below should only be called when a user has logged into the portal
    ****************************************************************************************/

    //Holds the header information of login portal
    public function portalHeader(){
        $html = '
            <!DOCTYPE html>
            <html>
            <head>
                <!-- Basic Page Info -->
                <meta charset="utf-8">
                <title>Female Entrepreneurship</title>
            
                <!-- Site favicon -->
                <link rel="" type="image/png" sizes="180x180" href="'.BASE_URL.'assets/img/logos/fep_logo.png">
                <link rel="" type="image/png" sizes="32x32" href="'.BASE_URL.'assets/img/logos/fep_logo.png">
                <link rel="" type="image/png" sizes="16x16" href="'.BASE_URL.'assets/img/logos/fep_logo.png">
            
                <!-- Mobile Specific Metas -->
                <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
            
                <!-- Google Font -->
                <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
                
                <!-- CSS -->
                <link rel="stylesheet" type="text/css" href="'.BASE_URL.'vendors/styles/core.css">
                <link rel="stylesheet" type="text/css" href="'.BASE_URL.'vendors/styles/icon-font.min.css">

                <!-- DataTables Plugins Bootstrap 4 CSS -->
                <link rel="stylesheet" type="text/css" href="'.BASE_URL.'src/plugins/datatables/css/dataTables.bootstrap4.min.css">
                <link rel="stylesheet" type="text/css" href="'.BASE_URL.'src/plugins/datatables/css/responsive.bootstrap4.min.css">
                
                <!-- Fullcalendar CSS  -->
                <link rel="stylesheet" type="text/css" href="'.BASE_URL.'src/plugins/fullcalendar/fullcalendar.css">

                <!-- Additional Styling from template -->
                <link rel="stylesheet" type="text/css" href="'.BASE_URL.'vendors/styles/style.css">
                
                
                <!-- Video Player CSS-->
                <link rel="stylesheet" type="text/css" href="'.BASE_URL.'src/plugins/plyr/dist/plyr.css">
            
                <!-- Additional CSS-->
                <link rel="stylesheet" type="text/css" href="'.BASE_URL.'vendors/styles/customStyle.css">
                
                
                <!-- Global site tag (gtag.js) - Google Analytics -->
                <script async src="https://www.googletagmanager.com/gtag/js?id=UA-119386393-1"></script>
                
                <script>
                    window.dataLayer = window.dataLayer || [];
                    function gtag(){dataLayer.push(arguments);}
                    gtag("js", new Date());
            
                    gtag("config", "UA-119386393-1");

                    //Global javascript variables;
                    var BASE_URL = "'.BASE_URL.'";
                </script>
                
                <!-- JS SET and GET functioins for global variables-->
                <script src="'.BASE_URL.'assets/js/globalVariables.js"></script>

                </head>
                <body>
                ';

        return $html;

    }
    //Displays a topbar for users that are logged in portal
    public function portalTopBar($currentPage = ''){
        
        $html = '
                <div class="header">
                    <div class="header-left">
                    <div class="menu-icon fa fa-bars"></div>
                    
                </div>
                <div class="header-right">
                    <div class="user-notification">
                        <div class="dropdown">
                            <a class="dropdown-toggle no-arrow" href="#" role="button" data-toggle="dropdown">
                                <i class="icon-copy dw dw-notification"></i>
                                <span class="badge notification-active"></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <div class="notification-list mx-h-350 customscroll">
                                    <ul>
                                        <li>
                                            <a>
                                                <img src="'.BASE_URL.'vendors/images/img.jpg" alt="">
                                                <h3>John Doe</h3>
                                                <p>
                                                    Is requesting mentorship.
                                                </p>
                                                <div class="d-flex justify-content-end mt-2">
                                                    <button type="button" class="btn btn-light text-danger btn-sm mr-2">Reject</button>
                                                    <button type="button" class="btn btn-success btn-sm mr-2">Accept</button>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <img src="'.BASE_URL.'vendors/images/photo1.jpg" alt="">
                                                <h3>Lea R. Frith</h3>
                                                <p>Wants to become a mentor.</p>
                                                <div class="d-flex justify-content-end mt-2">
                                                    <button type="button" class="btn btn-light text-danger btn-sm mr-2">Reject</button>
                                                    <button type="button" class="btn btn-success btn-sm mr-2">Accept</button>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <img src="'.BASE_URL.'vendors/images/photo2.jpg" alt="">
                                                <h3>Erik L. Richards</h3>
                                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed...</p>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <img src="'.BASE_URL.'vendors/images/photo3.jpg" alt="">
                                                <h3>John Doe</h3>
                                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed...</p>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <img src="'.BASE_URL.'vendors/images/photo4.jpg" alt="">
                                                <h3>Renee I. Hansen</h3>
                                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed...</p>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <img src="'.BASE_URL.'vendors/images/img.jpg" alt="">
                                                <h3>Vicki M. Coleman</h3>
                                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed...</p>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="user-info-dropdown">
                        <div class="dropdown">
                            <a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                                <span class="user-icon">
                                    <img src="'.BASE_URL.'vendors/images/photo1.jpg" alt="">
                                </span>
                                <span class="user-name">Ross C. Lopez</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                <a class="dropdown-item" href="'.BASE_URL.'index.php/?page=profile"><i class="dw dw-user1"></i> Profile</a>
                                <a class="dropdown-item" href="'.BASE_URL.'index.php/?page=logout"><i class="dw dw-logout"></i> Log Out</a>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        ';

        return $html;
    }  
    //Displays a sidebar for users that are logged in portal
    public function portalSideBar($currentPage = ''){
        
        $html = '
            <div class="left-side-bar">
                <div class="brand-logo">
                    <a href="'.BASE_URL.'index.php/?page=dashboard">
                        <!--<img src="'.BASE_URL.'vendors/images/deskapp-logo.svg" alt="" class="dark-logo">-->
                        <!--<img src="'.BASE_URL.'vendors/images/deskapp-logo-white.svg" alt="" class="light-logo">-->
                        <img src="'.BASE_URL.'assets/img/logos/fep_logo.png" alt="Female Entrepreneurship Logo" class="portal-logo">
                    </a>
                    <div class="close-sidebar" data-toggle="left-sidebar-close">
                        <i class="ion-close-round"></i>
                    </div>
                </div>
                <div class="menu-block customscroll">
                    <div class="sidebar-menu">
                        <ul id="accordion-menu">
                            
                            <li>
                                <a href="'.BASE_URL.'index.php/?page=dashboard" class="dropdown-toggle no-arrow">
                                    <span class="micon fa fa-tachometer"></span><span class="mtext">Dashboard</span>
                                </a>
                            </li>
                            <li>
                                <a href="'.BASE_URL.'index.php/?page=menteeList" class="dropdown-toggle no-arrow">
                                    <span class="micon fa fa-users"></span><span class="mtext">Mentees</span>
                                </a>
                            </li>
                            <li>
                                <a href="'.BASE_URL.'index.php/?page=mentorList" class="dropdown-toggle no-arrow">
                                    <span class="micon fa fa-users"></span><span class="mtext">Mentors</span>
                                </a>
                            </li>
                            <li>
                                <a href="'.BASE_URL.'index.php/?page=courseList" class="dropdown-toggle no-arrow">
                                    <span class="micon fa fa-book"></span><span class="mtext">Courses</span>
                                </a>
                            </li>
                            <li>
                                <a href="'.BASE_URL.'index.php/?page=courseCategories" class="dropdown-toggle no-arrow">
                                    <span class="micon fa fa-book"></span><span class="mtext">Course Categories</span>
                                </a>
                            </li>
                           
                            <li>
                                <a href="'.BASE_URL.'index.php/?page=viewCourses" class="dropdown-toggle no-arrow">
                                    <span class="micon fa fa-book"></span><span class="mtext">View Courses</span>
                                </a>
                            </li>
                            <li>
                                <a href="'.BASE_URL.'index.php/?page=viewMentors" class="dropdown-toggle no-arrow">
                                    <span class="micon fa fa-users"></span><span class="mtext">View Mentors</span>
                                </a>
                            </li>
                            <li class="dropdown">
                                <a href="javascript:;" class="dropdown-toggle">
                                    <span class="micon fa fa-wechat"></span><span class="mtext">Forums</span>
                                </a>
                                <ul class="submenu">
                                    <li><a href="'.BASE_URL.'index.php/?page=forums&program=programName">Marketing</a></li>
                                    <li><a href="'.BASE_URL.'index.php/?page=forums&program=programName">Programming</a></li>
                                    <li><a href="'.BASE_URL.'index.php/?page=forums&program=programName">Psychology</a></li>
                                    <li><a href="'.BASE_URL.'index.php/?page=forums&program=programName">Maths</a></li>
                                </ul>
                            </li>
                            <!--
                            <li class="dropdown">
                                <a href="javascript:;" class="dropdown-toggle">
                                    <span class="micon dw dw-edit2"></span><span class="mtext">Forms</span>
                                </a>
                                <ul class="submenu">
                                    <li><a href="form-basic.html">Form Basic</a></li>
                                    <li><a href="advanced-components.html">Advanced Components</a></li>
                                    <li><a href="form-wizard.html">Form Wizard</a></li>
                                    <li><a href="html5-editor.html">HTML5 Editor</a></li>
                                    <li><a href="form-pickers.html">Form Pickers</a></li>
                                    <li><a href="image-cropper.html">Image Cropper</a></li>
                                    <li><a href="image-dropzone.html">Image Dropzone</a></li>
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a href="javascript:;" class="dropdown-toggle">
                                    <span class="micon dw dw-library"></span><span class="mtext">Tables</span>
                                </a>
                                <ul class="submenu">
                                    <li><a href="basic-table.html">Basic Tables</a></li>
                                    <li><a href="datatable.html">DataTables</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="calendar.html" class="dropdown-toggle no-arrow">
                                    <span class="micon dw dw-calendar1"></span><span class="mtext">Calendar</span>
                                </a>
                            </li>
                            <li class="dropdown">
                                <a href="javascript:;" class="dropdown-toggle">
                                    <span class="micon dw dw-apartment"></span><span class="mtext"> UI Elements </span>
                                </a>
                                <ul class="submenu">
                                    <li><a href="ui-buttons.html">Buttons</a></li>
                                    <li><a href="ui-cards.html">Cards</a></li>
                                    <li><a href="ui-cards-hover.html">Cards Hover</a></li>
                                    <li><a href="ui-modals.html">Modals</a></li>
                                    <li><a href="ui-tabs.html">Tabs</a></li>
                                    <li><a href="ui-tooltip-popover.html">Tooltip &amp; Popover</a></li>
                                    <li><a href="ui-sweet-alert.html">Sweet Alert</a></li>
                                    <li><a href="ui-notification.html">Notification</a></li>
                                    <li><a href="ui-timeline.html">Timeline</a></li>
                                    <li><a href="ui-progressbar.html">Progressbar</a></li>
                                    <li><a href="ui-typography.html">Typography</a></li>
                                    <li><a href="ui-list-group.html">List group</a></li>
                                    <li><a href="ui-range-slider.html">Range slider</a></li>
                                    <li><a href="ui-carousel.html">Carousel</a></li>
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a href="javascript:;" class="dropdown-toggle">
                                    <span class="micon dw dw-paint-brush"></span><span class="mtext">Icons</span>
                                </a>
                                <ul class="submenu">
                                    <li><a href="font-awesome.html">FontAwesome Icons</a></li>
                                    <li><a href="foundation.html">Foundation Icons</a></li>
                                    <li><a href="ionicons.html">Ionicons Icons</a></li>
                                    <li><a href="themify.html">Themify Icons</a></li>
                                    <li><a href="custom-icon.html">Custom Icons</a></li>
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a href="javascript:;" class="dropdown-toggle">
                                    <span class="micon dw dw-analytics-21"></span><span class="mtext">Charts</span>
                                </a>
                                <ul class="submenu">
                                    <li><a href="highchart.html">Highchart</a></li>
                                    <li><a href="knob-chart.html">jQuery Knob</a></li>
                                    <li><a href="jvectormap.html">jvectormap</a></li>
                                    <li><a href="apexcharts.html">Apexcharts</a></li>
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a href="javascript:;" class="dropdown-toggle">
                                    <span class="micon dw dw-right-arrow1"></span><span class="mtext">Additional Pages</span>
                                </a>
                                <ul class="submenu">
                                    <li><a href="video-player.html">Video Player</a></li>
                                    <li><a href="login.html">Login</a></li>
                                    <li><a href="forgot-password.html">Forgot Password</a></li>
                                    <li><a href="reset-password.html">Reset Password</a></li>
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a href="javascript:;" class="dropdown-toggle">
                                    <span class="micon dw dw-browser2"></span><span class="mtext">Error Pages</span>
                                </a>
                                <ul class="submenu">
                                    <li><a href="400.html">400</a></li>
                                    <li><a href="403.html">403</a></li>
                                    <li><a href="404.html">404</a></li>
                                    <li><a href="500.html">500</a></li>
                                    <li><a href="503.html">503</a></li>
                                </ul>
                            </li>

                            <li class="dropdown">
                                <a href="javascript:;" class="dropdown-toggle">
                                    <span class="micon dw dw-copy"></span><span class="mtext">Extra Pages</span>
                                </a>
                                <ul class="submenu">
                                    <li><a href="blank.html">Blank</a></li>
                                    <li><a href="contact-directory.html">Contact Directory</a></li>
                                    <li><a href="blog.html">Blog</a></li>
                                    <li><a href="blog-detail.html">Blog Detail</a></li>
                                    <li><a href="product.html">Product</a></li>
                                    <li><a href="product-detail.html">Product Detail</a></li>
                                    <li><a href="faq.html">FAQ</a></li>
                                    <li><a href="profile.html">Profile</a></li>
                                    <li><a href="gallery.html">Gallery</a></li>
                                    <li><a href="pricing-table.html">Pricing Tables</a></li>
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a href="javascript:;" class="dropdown-toggle">
                                    <span class="micon dw dw-list3"></span><span class="mtext">Multi Level Menu</span>
                                </a>
                                <ul class="submenu">
                                    <li><a href="javascript:;">Level 1</a></li>
                                    <li><a href="javascript:;">Level 1</a></li>
                                    <li><a href="javascript:;">Level 1</a></li>
                                    <li class="dropdown">
                                        <a href="javascript:;" class="dropdown-toggle">
                                            <span class="micon fa fa-plug"></span><span class="mtext">Level 2</span>
                                        </a>
                                        <ul class="submenu child">
                                            <li><a href="javascript:;">Level 2</a></li>
                                            <li><a href="javascript:;">Level 2</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="javascript:;">Level 1</a></li>
                                    <li><a href="javascript:;">Level 1</a></li>
                                    <li><a href="javascript:;">Level 1</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="sitemap.html" class="dropdown-toggle no-arrow">
                                    <span class="micon dw dw-diagram"></span><span class="mtext">Sitemap</span>
                                </a>
                            </li>
                            <li>
                                <a href="chat.html" class="dropdown-toggle no-arrow">
                                    <span class="micon dw dw-chat3"></span><span class="mtext">Chat</span>
                                </a>
                            </li>
                            <li>
                                <a href="invoice.html" class="dropdown-toggle no-arrow">
                                    <span class="micon dw dw-invoice"></span><span class="mtext">Invoice</span>
                                </a>
                            </li>
                            <li>
                                <div class="dropdown-divider"></div>
                            </li>
                            <li>
                                <div class="sidebar-small-cap">Extra</div>
                            </li>
                            <li>
                                <a href="javascript:;" class="dropdown-toggle">
                                    <span class="micon dw dw-edit-2"></span><span class="mtext">Documentation</span>
                                </a>
                                <ul class="submenu">
                                    <li><a href="introduction.html">Introduction</a></li>
                                    <li><a href="getting-started.html">Getting Started</a></li>
                                    <li><a href="color-settings.html">Color Settings</a></li>
                                    <li><a href="third-party-plugins.html">Third Party Plugins</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="https://dropways.github.io/deskapp-free-single-page-website-template/" target="_blank" class="dropdown-toggle no-arrow">
                                    <span class="micon dw dw-paper-plane1"></span>
                                    <span class="mtext">Landing Page <img src="vendors/images/coming-soon.png" alt="" width="25"></span>
                                </a>
                            </li>
                            -->
                        </ul>
                    </div>
                </div>
            </div>
        ';

        return $html;
    } 
    //Displays a pre-loader. Must be called by all portal pages
    public function preloader(){
        $html = '
            <!--<div class="pre-loader">
                <div class="pre-loader-box">
                    <div class="loader-logo"><img src="'.BASE_URL.'assets/img/logos/fep_logo.png" alt="Female Entrepreneurship Logo" width="350" height="auto"></div>
                    <div class="loader-progress" id="progress_div">
                        <div class="bar" id="bar1"></div>
                    </div>
                    <div class="percent" id="percent1">0%</div>
                    <div class="loading-text">
                        Loading...
                    </div>
                </div>
            </div>-->
        
        ';
        return  $html;
    } 
    //Displays summary of content when logged in
    public function dashboard($data = []){
        
        $courses = '';

        $topMentors = '';
        $mentorCards = '';
        $mentorIndicators = '';

        //programs the user is linked too as a mentor or mentee
        if (!empty($data['programs'])){

            foreach($data['programs'] as $key => $program){
                $programId = encrypt($program['id']);
                $courses .= $this->create_basic_course_card();
            }

        }else{
            // user is not linked any programs
            for($num =0; $num < 4; $num++){//foreach($data['courses'] as $key => $course){
                $courseId = encrypt(1);
                $course['mentee_total'] = 2;
                $course['name'] = 'Marketing';

                $courses .= '
                    <div class="col-xl-3 mb-30">
                        <a href="'.BASE_URL.'index.php/?page=programContent&programId='.$courseId.'">
                            <div class="card-box height-100-p widget-style1 shadow-lg">
                                <div class="d-flex flex-wrap align-items-center">
                                    <div class="progress-data text-center">
                                        <!--<div id="chart"></div>-->
                                        <i class="icon-copy dw dw-suitcase h1"></i>
                                    </div>
                                    <div class="widget-data">
                                        <div class="h4 mb-0" data-toggle="tooltip" data-placement="top" title="Mentee total"><i class="fa fa-user"></i> '.$course['mentee_total'].'</div>
                                        <div class="weight-600 font-14">'.$course['name'].'</div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>  
                ';
            }

        }  
        //top mentors 
        // if (!empty($data['topMentors'])){

            for($num = 0; $num < 3; $num++){//foreach($data['topMentors'] as $key => $topMentor){

                $mentorCards .= $this->create_mentor_card();
            }
            $topMentors = '
                <h3 class="h3 text-blue">Top Mentors</h3>
                <div class="row">
        
                    '.$mentorCards.'
                           
                         
                </div>
            ';
        // }
        // echo '<br><br><br><br>';
        // var_dump($courses);
        $html = $this->preloader().'
            <div class="main-container">
                <div class="pd-ltr-20">
                    <h3 class="h3 text-blue">Courses</h3>
                    <div class="row">
                        '.$courses.'
                       
                    </div>
                    
                    '.$topMentors.'
                    
                   <!-- Calendar for user-->
                    <!--<div class="pd-20 card-box mb-30">
                        <div class="calendar-wrap">
                            <div id="calendar"></div>
                        </div>
                        <!-- calendar modal 
                        <div id="modal-view-event" class="modal modal-top fade calendar-modal">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <h4 class="h4"><span class="event-icon weight-400 mr-3"></span><span class="event-title"></span></h4>
                                        <div class="event-body"></div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="modal-view-event-add" class="modal modal-top fade calendar-modal">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <form id="add-event">
                                        <div class="modal-body">
                                            <h4 class="text-blue h4 mb-10">Add Event Detail</h4>
                                            <div class="form-group">
                                                <label>Event name</label>
                                                <input type="text" class="form-control" name="ename">
                                            </div>
                                            <div class="form-group">
                                                <label>Event Date</label>
                                                <input type="text" class="datetimepicker form-control" name="edate">
                                            </div>
                                            <div class="form-group">
                                                <label>Event Description</label>
                                                <textarea class="form-control" name="edesc"></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label>Event Color</label>
                                                <select class="form-control" name="ecolor">
                                                    <option value="fc-bg-default">fc-bg-default</option>
                                                    <option value="fc-bg-blue">fc-bg-blue</option>
                                                    <option value="fc-bg-lightgreen">fc-bg-lightgreen</option>
                                                    <option value="fc-bg-pinkred">fc-bg-pinkred</option>
                                                    <option value="fc-bg-deepskyblue">fc-bg-deepskyblue</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Event Icon</label>
                                                <select class="form-control" name="eicon">
                                                    <option value="circle">circle</option>
                                                    <option value="cog">cog</option>
                                                    <option value="group">group</option>
                                                    <option value="suitcase">suitcase</option>
                                                    <option value="calendar">calendar</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary" >Save</button>
                                            <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>-->

                  
                </div>
            </div>
        ';

        return $html;
    }
    // Displays the profile of a user 
    public function profile($data = array()){

        //building profile display based on user type
        $country = ['personalInfo']['country'] ?? '';

        $socialMedia = '';
        $socialMediaIcons = '';
        $personalInfo = '';
        $courses = '';
        $courseList = '';

        $userType = 'mentee';//$_SESSION['USERDATA']['user_type']
        
        if ($userType == 'mentor'){
            $socialMedia = '
                <h4 class="text-blue h5 pl-20">Edit Social Media links</h4>
                <hr>
                <form action="'.BASE_URL.'" method="POST" class="profile-edit-list">
                    <li class="weight-500 row pt-0 mt-0">
                        <input type="hidden" name="action" value="updateSocialLinks">
                        <div class="form-group col-12 col-md-6">
                            <label>Facebook URL:</label>
                            <input class="form-control form-control-lg" type="text" placeholder="Paste your link here">
                        </div>
                        <div class="form-group col-12 col-md-6">
                            <label>Twitter URL:</label>
                            <input class="form-control form-control-lg" type="text" placeholder="Paste your link here">
                        </div>
                        <div class="form-group col-12 col-md-6">
                            <label>Linkedin URL:</label>
                            <input class="form-control form-control-lg" type="text" placeholder="Paste your link here">
                        </div>
                        <div class="form-group col-12 col-md-6">
                            <label>Instagram URL:</label>
                            <input class="form-control form-control-lg" type="text" placeholder="Paste your link here">
                        </div>
                    </li>
                    <div class="mb-10 d-flex justify-content-end mr-20">
                        <input type="submit" class="btn btn-primary" value="Save & Update">
                    </div>
                </form>
            ';
            $socialMediaIcons = '
                <div class="profile-social">
                    <h5 class="mb-20 h5 text-blue">Social Links</h5>
                    <ul class="clearfix">
                        <li><a href="#" class="btn" data-bgcolor="#3b5998" data-color="#ffffff"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="#" class="btn" data-bgcolor="#1da1f2" data-color="#ffffff"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="#" class="btn" data-bgcolor="#007bb5" data-color="#ffffff"><i class="fa fa-linkedin"></i></a></li>
                        <li><a href="#" class="btn" data-bgcolor="#f46f30" data-color="#ffffff"><i class="fa fa-instagram"></i></a></li>
                        <li><a href="#" class="btn" data-bgcolor="#db4437" data-color="#ffffff"><i class="fa fa-google-plus"></i></a></li>
                    </ul>
                </div>
            ';

            for ($num = 0; $num < 4; $num++){//foreach ($data['courses'] as $ket => $course){
                $courseList .='
                    
                    <li class="list-group-item ">
                        <span class="d-block d-flex justify-content-between align-items-center">
                            <p>Marketing</p>
                            <span class="badge badge-primary badge-pill" data-toggle="tooltip" data-placement="top" title="Mentee Count">14</span>
                        </span>
                        <span class="d-flex justify-content-start" data-toggle="tooltip" data-placement="top" title="4.0">
                            <span class=""><i class="text-warning fa fa-star fa-lg"></i></span>
                            <span class=""><i class="text-warning fa fa-star fa-lg"></i></span>
                            <span class=""><i class="text-warning fa fa-star fa-lg"></i></span>
                            <span class=""><i class="text-warning fa fa-star fa-lg"></i></span>
                            <span class=""><i class="text-warning fa fa-star-o fa-lg"></i></span>
                        </span>
                    </li>
                            
                      
                ';
            }

            $courses = '
                <div class="profile-skills">
                    <h5 class="mb-20 h5 text-blue">Course(s)</h5>
                    <ul class="list-group">
                    '.$courseList.'
                    </ul>
                </div>
            ';
           
        }

        $html = $this->preloader().'
        <div class="main-container">
            <div class="pd-ltr-20 xs-pd-20-10">
                <div class="min-height-200px">
                    <div class="page-header">
                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <div class="title">
                                    <h4>Profile</h4>
                                </div>
                                <nav aria-label="breadcrumb" role="navigation">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="'.BASE_URL.'index.php/?page=dashboard">Home</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Profile</li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 mb-30">
                            <div class="pd-20 card-box">
                                <div class="profile-photo">
                                    <input id="profile-pic-upload" type="file" class="d-none" name="profilePic" accept="image/*">
                                    <a href="#" id="upload-profile-pic"  class="edit-avatar"><i class="fa fa-camera"></i></a>
                                    <a href="#" id="remove-profile-pic" class="remove-avatar d-none text-danger"><i class="fa fa-trash"></i></a>
                                    <img src="'.($data['personalInfo']['profileImage'] ?? BASE_URL."img/profileImg/default-profile-pic.png").'" alt="" class="avatar-photo">
                                </div>
                                <h5 class="text-center h5 mb-0">Ross C. Lopez</h5>
                                <p class="text-center text-muted font-14">Lorem ipsum dolor sit amet</p>
                                <div class="profile-info">
                                    <h5 class="mb-20 h5 text-blue">Contact Information</h5>
                                    <ul>
                                        <li>
                                            <span>Email Address:</span>
                                            '.($data['personalInfo']['emai'] ?? 'N/A').'
                                        </li>
                                        <li>
                                            <span>Phone Number:</span>
                                            '.($data['personalIn']['phone'] ?? 'N/A').'
                                        </li>
                                        <li>
                                            <span>District:</span>
                                            '.($data['personalInfo']['disctrict'] ?? 'N/A').'
                                        </li>
                                        <li>
                                            <span>City/Town/Village:</span>
                                            '.($data['personalInfo']['ctv'] ?? 'N/A').'
                                        </li>
                                        <li>
                                            <span>Address:</span>
                                            '.($data['personalInfo']['address'] ?? 'N/A').'
                                        </li>
                                    </ul>
                                </div>
                                '.$socialMediaIcons.'
                                '.$courses.'
                            </div>
                        </div>
                        <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 mb-30">
                            <div class="card-box height-100-p overflow-hidden">
                                <div class="profile-tab height-100-p">
                                    <div class="tab height-100-p">
                                        <ul class="nav nav-tabs customtab" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link active" data-toggle="tab" href="#personal-info" role="tab">Personal Info</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" data-toggle="tab" href="#change-pass-tab" role="tab">Change Password</a>
                                            </li>
                                        </ul>
                                        <div class="tab-content">
                                            
                                            <!-- Personal Info Tab start -->
                                            <div class="tab-pane fade show active height-100-p" id="personal-info" role="tabpanel">
                                                <div class="profile-setting">
                                                    <ul>
                                                        <form action="'.BASE_URL.'" method="POST" class="profile-edit-list">
                                                            <h4 class="text-blue h5 pl-20">Edit Your Personal Info</h4>
                                                            <hr>
                                                            <li class="weight-500 row">
                                                                <input type="hidden" name="action" value="updatePersonalInfo">
                                                                <div class="form-group col-12 col-md-6">
                                                                    <label>First Name</label>
                                                                    <input class="form-control name="firstName" value="'.($data['personalInfo']['firstName'] ?? '').'" form-control-lg" type="text">
                                                                </div>
                                                                <div class="form-group col-12 col-md-6">
                                                                    <label>Last Name</label>
                                                                    <input class="form-control name="lastName" value="'.($data['personalInfo']['lastName'] ?? '').'" form-control-lg" type="text">
                                                                </div>
                                                                <div class="form-group col-12 col-md-6">
                                                                    <label>Occupation</label>
                                                                    <input class="form-control form-control-lg" type="text" name="jobTitle" value="'.($data['personalInfo']['jobtitle'] ?? '').'">
                                                                </div>
                                                                <div class="form-group col-12 col-md-6">
                                                                    <label>Email</label>
                                                                    <p>'.($data['personalInfo'] ?? 'testing@gmail.com').'</p>
                                                                    
                                                                </div>
                                                                <div class="form-group col-12 col-md-6">
                                                                    <label>Date of birth</label>
                                                                    <input class="form-control form-control-lg date-picker" name="dob" value="'.($data['personalInfo']['dob'] ?? '').'" type="text">
                                                                </div>
                                                                <div class="form-group col-12 col-md-6">
                                                                    <label>Gender</label>
                                                                    <div class="d-flex">
                                                                    <div class="custom-control custom-radio mb-5 mr-20">
                                                                        <input type="radio" id="customRadio4" name="gender" class="custom-control-input">
                                                                        <label class="custom-control-label weight-400" for="customRadio4">Male</label>
                                                                    </div>
                                                                    <div class="custom-control custom-radio mb-5">
                                                                        <input type="radio" id="customRadio5" name="gender" class="custom-control-input">
                                                                        <label class="custom-control-label weight-400" for="customRadio5">Female</label>
                                                                    </div>
                                                                    </div>
                                                                </div>
                                                                
                                                                <div class="form-group col-12 col-md-6">
                                                                    <label>District</label>
                                                                    <select class="selectpicker form-control form-control-lg" name="district" title="Not Chosen">
                                                                        <option '.((isset($country) && $country == 'corozal')? 'selected' : '').' value="corozal">Corozal</option>
                                                                        <option '.((isset($country) && $country == 'orange walk')? 'selected' : '').' value="orange walk">Orange Walk</option>
                                                                        <option '.((isset($country) && $country == 'belize')? 'selected' : '').' value="belize">Belize</option>
                                                                        <option '.((isset($country) && $country == 'cayo')? 'selected' : '').' value="cayo">Cayo</option>
                                                                        <option '.((isset($country) && $country == 'stan creek')? 'selected' : '').' value="stann creek">Stann Creek</option>
                                                                        <option '.((isset($country) && $country == 'toledo')? 'selected' : '').' value="toledo">Toledo</option>
                                                                    </select>
                                                                </div>
                                                                <div class="form-group col-12 col-md-6">
                                                                    <label>City/Town/Village</label>
                                                                    <input class="form-control form-control-lg" name="ctv" value="'.($data['personalInfo']['ctv'] ?? '').'" type="text">
                                                                </div>
                                                                <div class="form-group col-12 col-md-6">
                                                                    <label>Address</label>
                                                                    <input class="form-control form-control-lg" name="address"  value="'.($data['personalInfo']['address'] ?? '').'" type="text">
                                                                </div>
                                                               
                                                                <div class="form-group col-12 col-md-6">
                                                                    <label>Phone</label>
                                                                    <input class="form-control" value="'.($data['personalInfo']['firstName'] ?? '').'" type="tel">
                                                                </div>
                                                                
                                                                <div class="form-group col-12 col-md-12">
                                                                    <label>What do you want people to know about you?</label>
                                                                    <textarea class="form-control" name="description">'.($data['personalInfo']['bio'] ?? '').'</textarea>
                                                                </div>


                                                                
                                                            </li>
                                                            <div class="mb-10 d-flex justify-content-end mr-20">
                                                                <input type="submit" class="btn btn-primary" value="Save & Update">
                                                            </div>
                                                        </form>
                                                        '.$socialMedia.'
                                                    </ul>
                                                </div>
                                            </div>
                                            <!-- Personal Info Tab End -->

                                            <!-- Change Password Tab start -->
                                            <div class="tab-pane fade height-100-p" id="change-pass-tab" role="tabpanel">
                                                <div class="profile-setting">
                                                    <form action="'.BASE_URL.'" method="POST">
                                                        <div class="alert alert-warning" role="alert">
                                                            <i class="fa fa-exclamation-triangle"></i>
                                                            New password length must be 8 characters including a upper, lower case letter and a number
                                                            
                                                        </div>
                                                        <ul class="profile-edit-list row d-flex justify-content-center mt-0 pt-0">
                                                            <li class="weight-500 col-md-6">
                                                                <h4 class="text-blue h5 mb-20">Change your password</h4>
                                                                <div class="form-group">
                                                                    <label>Old Password</label>
                                                                    <input class="form-control form-control-lg" id="oldPass"  type="password" required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>New Password</label>
                                                                    <input class="form-control form-control-lg" id="newPass" type="password" required>
                                                                </div>
                                                                <div id="passRequirement"></div>
                                                                <div class="form-group">
                                                                    <label>Confirm Password</label>
                                                                    <input class="form-control form-control-lg" id="confirmPass" type="password" required>
                                                                </div>
                                                                <div id="divCheckPasswordMatch" class="mb-3"></div>
                                                                
                                                                <div class="form-group mb-0">
                                                                    <button id="change-pass-btn" type="submit" class="btn btn-primary" disabled>Change Password</button
                                                                </div>
                                                            </li>
                                                            
                                                        </ul>
                                                    </form>
                                                </div>
                                            </div>
                                            <!-- Change Password Tab End -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        ';
        return $html;
    }
    //Displays a list of mentors in the system
    public function mentorList($data = array()){

        $tr = '';

        for ($i = 1; $i < 5; $i++){

            $tr .= '
                <tr>
                    <td class="table-plus">Danielson L. Correa</td>
                    <td>Basic programming</td>
                    <td>4.0</td>
                    <td class="text-success">Active</td>
                    <td>29-03-2018</td>
                    <td>
                        <div class="dropdown">
                            <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                                <i class="dw dw-more"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                <a class="dropdown-item" href="'.BASE_URL.'index.php/?page=viewMentorProfile"><i class="dw dw-eye"></i> View</a>
                                <a class="dropdown-item" href="'.BASE_URL.'index.php/?page=editMentorProfile&mentorId="><i class="dw dw-edit2"></i> Edit</a>
                                <a class="dropdown-item text-danger" href="#"><i class="dw dw-delete-3"></i> Delete</a>
                            </div>
                        </div>
                    </td>
                </tr>
            ';

        }
        $html = $this->preloader().'
            <div class="main-container">
                <div class="pd-ltr-20 xs-pd-20-10">
                    <div class="min-height-200px">
                        <div class="page-header">
                            <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <div class="title">
                                        <h4>Mentors</h4>
                                    </div>
                                    
                                    <nav aria-label="breadcrumb" role="navigation">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="'.BASE_URL.'index.php/?page=dashboard">Home</a></li>
                                            <li class="breadcrumb-item active" aria-current="page">Mentors</li>
                                        </ol>
                                    </nav>
                                </div>
                        
                            </div>
                        </div>
                        <!-- Simple Datatable start -->
                        <div class="card-box mb-30">
                            <div class="pd-20">
                                <h4 class="text-blue h4">Mentors</h4>
                            </div>
                            <div class="pb-20">
                                <table id="mentor-table" class="table stripe hover nowrap">
                                    <thead>
                                        <tr>
                                            <th class="table-plus">Name</th>
                                            <th>Course Name</th>
                                            <th>Rating</th>
                                            <th>Status</th>
                                            <th>Last Online</th>
                                            <th class="datatable-nosort">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    '.$tr.'
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- Simple Datatable End -->
                    
                    </div>
                
                </div>
            </div>
        ';

        return $html;
    }
    //Displays the form to add a new course to the system
    public function addCourse($data = []){

        $categoryOptions = '';
        $courseOutlineCards = '';
        $cardCount = 1;

        if (!empty($data['course_outline'])){

            foreach($data['course_outline'] as $key => $outline){
                //displaying all cards entered
                $courseOutlineCards .= $this->create_course_outline_topic_card($outline);
            }
        }else{
            //will display one card for input
            $courseOutlineCards = $this->create_course_outline_topic_card();

        }

        foreach($data['categories'] as $key => $category){
            $categoryOptions .= '
                <option value="'.(encrypt($category['id'])).'">'.$category['name'].'</option>
            ';
        }

        $html = $this->preloader().'
            <div class="main-container">
                <div class="pd-ltr-20 xs-pd-20-10">
                    <div class="min-height-200px">
                        <div class="page-header">
                            <div class="row">
                                <div class="col-md-12 col-sm-12">
                                    <div class="title">
                                        <h4>Add Course</h4>
                                    </div>
                                    <nav aria-label="breadcrumb" role="navigation">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="'.BASE_URL.'index.php/?page=dashboard">Home</a></li>
                                            <li class="breadcrumb-item"><a href="'.BASE_URL.'index.php/?page=courseList">Courses</a></li>
                                            <li class="breadcrumb-item active" aria-current="page">Add Course</li>
                                        </ol>
                                    </nav>
                                </div>
                            </div>
                        </div>

                        <div class="pd-20 card-box shadow">
                                <form action="'.BASE_URL.'" method="POST" id="course-outline-list" enctype="multipart/form-data">
                                    <input type="hidden" name="action" value="addCourse">
                                        <h4 class="text-blue h5">Course Info</h4>
                                        <hr>
                                    <div class="row">

                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 mb-30">
                                            <!--style="opacity:0;width:0;float:left;"-->
                                            <div class="profile-photo card shadow img-fluid" style="width: 700px;height:auto;">
                                                <input id="course-pic-upload" type="file" class="d-none" name="coursePicture" accept=".jpg,.jpeg,.png"  oninvalid="alert(\'You must uploade a course picture!\');" required />
                                                <a href="#" id="upload-course-pic"  class="edit-avatar bg-white" style="margin-top: auto;"><i class="fa fa-upload text-dark mt-2"></i></a>
                                                <img id="course-pic" src="'.BASE_URL.'assets/img/logos/fep_logo.png" alt="" style="width:auto;height:auto;">
                                            </div>
                                    
                                        </div>  


                                        <div class="form-group col-12 col-md-4">
                                            <label>Course Name</label>
                                            <input class="form-control name="courseName" value="Programming" placeholder="e.g. Programming...." form-control-lg" type="text">
                                        </div>
                                        <div class="form-group col-12 col-md-4">
                                            <label>Course Icon</label>
                                            <input class="form-control name="courseIcon" placeholder="e.g. fa fa-star...." value="fa fa-laptop" form-control-lg" type="text">
                                        </div>
                                        
                                        <div class="form-group col-12 col-md-4">
                                            <label>Course Category</label>
                                            <select class="selectpicker form-control" name="courseCategoryId"  title="Choose a category" required>
                                                '.$categoryOptions.'
                                            </select>
                                        </div>
                                        
                                        <div class="form-group col-12 col-md-12">
                                            <label>Upload a PDF Copy of the Course Outline</label>
                                            <input type="file" class="form-control-file form-control height-auto" name="digitalCourseOutline" accept=".pdf" required>
                                        </div>
                                        
                                        <div class="form-group col-12 col-md-12">
                                            <label>Description about the Course</label>
                                            <textarea class="form-control" name="courseDescription">Basic description, testing</textarea>
                                        </div>

                                    </div>

                                    <h4 class="text-blue h5">Course Outline Sections</h4>
                                    <hr>
                                    <span id="course-outline-container">
                                        '.$courseOutlineCards.'                                    
                                    </span>


                                    <div class="mt-3 d-flex justify-content-center mb-4">
                                        <a href="#" id="add-course-card" class="btn btn-light btn-sm text-primary"><i class="fa fa-plus fa-lg text-primary"></i></a>
                                    </div>
                                    
                                         
                                    <div class="row">
                                        <div class="col-12 d-flex justify-content-end">
                                            <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-plus" ></i> Add Course</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <script>
                    setCourserOutlineCardCount('.$cardCount.');
                </script>
        ';
        return $html;
    }
        //Displays the form to add a new course to the system
    public function editCourse($data = []){

        // echo '<br><br><br><br>';
        // echo '<pre class="pt-5 d-flex justify-content-center">';
        // print_r($data);
        // echo '</pre>';
        $categoryOptions = '';
        $courseOutlineCards = '';
        $cardCount = 1;

        if (!empty($data['course_outline'])){

            foreach($data['course_outline'] as $key => $outline){
                //displaying all cards entered
                $courseOutlineCards .= $this->create_course_outline_topic_card($outline);
            }
        }else{
            //will display one card for input
            $courseOutlineCards = $this->create_course_outline_topic_card();

        }

        foreach($data['categories'] as $key => $category){
            $categoryOptions .= '
                <option value="'.(encrypt($category['id'])).'">'.$category['name'].'</option>
            ';
        }

        $html = $this->preloader().'
            <div class="main-container">
                <div class="pd-ltr-20 xs-pd-20-10">
                    <div class="min-height-200px">
                        <div class="page-header">
                            <div class="row">
                                <div class="col-md-12 col-sm-12">
                                    <div class="title">
                                        <h4>Add Course</h4>
                                    </div>
                                    <nav aria-label="breadcrumb" role="navigation">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="'.BASE_URL.'index.php/?page=dashboard">Home</a></li>
                                            <li class="breadcrumb-item"><a href="'.BASE_URL.'index.php/?page=courseList">Courses</a></li>
                                            <li class="breadcrumb-item active" aria-current="page">Add Course</li>
                                        </ol>
                                    </nav>
                                </div>
                            </div>
                        </div>

                        <div class="pd-20 card-box shadow">
                                <form action="'.BASE_URL.'" method="POST" id="course-outline-list" enctype="multipart/form-data">
                                    <input type="hidden" name="action" value="addCourse">
                                        <h4 class="text-blue h5">Course Info</h4>
                                        <hr>
                                    <div class="row">

                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 mb-30">
                                            <!--style="opacity:0;width:0;float:left;"-->
                                            <div class="profile-photo card shadow img-fluid" style="width: 700px;height:auto;">
                                                <input id="course-pic-upload" type="file" class="d-none" name="coursePicture" accept=".jpg,.jpeg,.png"  oninvalid="alert(\'You must uploade a course picture!\');" required />
                                                <a href="#" id="upload-course-pic"  class="edit-avatar bg-white" style="margin-top: auto;"><i class="fa fa-upload text-dark mt-2"></i></a>
                                                <img id="course-pic" src="'.BASE_URL.'assets/img/logos/fep_logo.png" alt="" style="width:auto;height:auto;">
                                            </div>
                                    
                                        </div>  


                                        <div class="form-group col-12 col-md-4">
                                            <label>Course Name</label>
                                            <input class="form-control name="courseName" value="Programming" placeholder="e.g. Programming...." form-control-lg" type="text">
                                        </div>
                                        <div class="form-group col-12 col-md-4">
                                            <label>Course Icon</label> <i class="fa fa-info-circle fa-lg" data-toggle="tooltip" data-placement="top" title="Search for icons at https://fontawesome.com/v4.7.0/icons/ and enter the icon name as started below."></i>
                                            <input class="form-control name="courseIcon" placeholder="e.g. fa fa-star...." value="fa fa-laptop" form-control-lg" type="text">
                                        </div>
                                        
                                        <div class="form-group col-12 col-md-4">
                                            <label>Course Category</label>
                                            <select class="selectpicker form-control" name="courseCategoryId"  title="Choose a category" required>
                                                '.$categoryOptions.'
                                            </select>
                                        </div>
                                        
                                        <div class="form-group col-12 col-md-12">
                                            <label>Upload a PDF Copy of the Course Outline</label>
                                            <input type="file" class="form-control-file form-control height-auto" name="digitalCourseOutline" accept=".pdf" required>
                                        </div>
                                        
                                        <div class="form-group col-12 col-md-12">
                                            <label>Description about the Course</label>
                                            <textarea class="form-control" name="courseDescription">Basic description, testing</textarea>
                                        </div>

                                    </div>

                                    <h4 class="text-blue h5">Course Outline Topics</h4>
                                    <hr>
                                    <span id="course-outline-container">
                                        '.$courseOutlineCards.'                                    
                                    </span>


                                    <div class="mt-3 d-flex justify-content-center mb-4">
                                        <a href="#" id="add-course-card" class="btn btn-light btn-sm text-primary"><i class="fa fa-plus fa-lg text-primary"></i></a>
                                    </div>
                                    
                                         
                                    <div class="row">
                                        <div class="col-12 d-flex justify-content-end">
                                            <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-plus" ></i> Add Course</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <script>
                    setCourserOutlineCardCount('.$cardCount.');
                </script>
        ';
        return $html;
    }
     //Displays a list of Courses available in the system
    public function courseList($data = array()){
                // echo '<br><br><br><br>';
                // echo '<pre class="pt-5 d-flex justify-content-center" style="margin-left: 200px; padding-left:600px;">';
                // print_r($data);
                // echo '</pre>';

        $tr = '';

        // for admin 
        $i = 1;
        foreach($data['courses'] as $key => $course){

            $tr .= '
                <tr>
                    <td class="table-plus">'.$i.'</td>
                    <td>'.($course['course_name']??'N/a').'</td>
                    <td>'.(sprintf("%.1f", $course['rating']?? null) ??'N/a').'</td>
                    <td>'.(isset($course['outline_src'])? '<a href="'.BASE_URL.$course['outline_src'].'"></a>' : 'N/a').'</td>
                    <td>'.($course['course_icon']??'N/a').'</td>
                    <td>
                        <div class="dropdown">
                            <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                                <i class="dw dw-more"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                <a class="dropdown-item" href="'.BASE_URL.'index.php/?page=editCourse&courseId='.(encrypt($course['course_id']) ?? '').'"><i class="dw dw-edit2"></i> Edit</a>
                                <a class="dropdown-item text-danger" href="'.BASE_URL.'index.php/?page=removeCourse&courseId='.(encrypt($course['course_id']??'')).'" data-toggle="modal" data-target="#remove-course-modal"><i class="dw dw-delete-3"></i> Remove</a>
                            </div>
                        </div>
                    </td>
                </tr>
            ';
            $i++;
        }
        $html = $this->preloader().'
            <div class="main-container">
                <div class="pd-ltr-20 xs-pd-20-10">
                    <div class="min-height-200px">
                        <div class="page-header">
                            <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <div class="title">
                                        <h4>Courses</h4>
                                    </div>
                                    
                                    <nav aria-label="breadcrumb" role="navigation">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="'.BASE_URL.'index.php/?page=dashboard">Home</a></li>
                                            <li class="breadcrumb-item active" aria-current="page">Courses</li>
                                        </ol>
                                    </nav>
                                </div>
                                <div class="col-md-6 col-sm-12 text-right pt-3">
                                    <a class="btn btn-primary btn-sm" href="#" data-toggle="modal" data-target="#request-course-addition-modal">
                                        <i class="icon-copy fa fa-lightbulb-o fa-lg" aria-hidden="true"></i> Suggest Course               
                                    </a>
                                </div>
                        
                            </div>
                        </div>
                        <!-- Simple Datatable start -->
                        <div class="card-box mb-30">
                            <div class="pd-20">
                                <h4 class="text-blue h4 d-inline">Courses</h4>
                                <span class="float-right">
                                    <a href="'.BASE_URL.'index.php/?page=addCourse" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Add Course</a>
                                    <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#add-course-modal"><i class="fa fa-paper-plane"></i> Request Course</button>
                                </span>
                            </div>
                            <div class="pb-20">
                                <table id="mentor-table" class="table stripe hover nowrap">
                                    <thead>
                                        <tr>
                                            <!--<th class="table-plus">Course Name</th>
                                            <th>Advisor</th>
                                            <th>Mentee Total</th>
                                            <th>Mentor Total</th>
                                            <th>Forum Total</th>
                                            <th>Overall Rating</th>
                                            <th class="datatable-nosort">Action</th>-->

                                            <th class="table-plus">#</th>
                                            <th>Name</th>
                                            <th>Overall Rating</th>
                                            <th>Course Outline</th>
                                            <th>Icon</th>
                                            <th class="datatable-nosort">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    '.$tr.'
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- Simple Datatable End -->
                    
                    </div>
                
                </div>
            </div>
        ';

        return $html;
    
    
    
    
    }
    //Displays a list of Courses available in the system
    public function courseCategories($data = array()){

        $tr = '';
        if (!empty($data['categories'])){
            $i = 1;
            foreach($data['categories']as $key => $category){

                $courseCatId = encrypt($category['id']);

                $tr .= '
                    <tr>
                        <td class="table-plus">'.$i.'</td>
                        <td>'.($category['name'] ?? '').'</td>
                        <td>'.($category['icon'] ?? '').'</td>
                        <td>'.($category['creation_date'] ?? '').'</td>
                        <td>
                            <div class="dropdown">
                                <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                                    <i class="dw dw-more"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                    <a class="dropdown-item" href="'.BASE_URL.'index.php/?page=editCourseCat&courseCatId='.$courseCatId.'"><i class="dw dw-edit2"></i> Edit</a>
                                    <a class="dropdown-item text-danger" href="'.BASE_URL.'index.php/?page=deleteCourseCat&couserCatId='.encrypt($courseCatId).'" data-toggle="modal" data-target="#remove-course-modal"><i class="dw dw-delete-3"></i> Remove</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                ';
                $i++;

            }
        }
        $html = $this->preloader().'
            <div class="main-container">
                <div class="pd-ltr-20 xs-pd-20-10">
                    <div class="min-height-200px">
                        <div class="page-header">
                            <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <div class="title">
                                        <h4>Course Categories</h4>
                                    </div>
                                    
                                    <nav aria-label="breadcrumb" role="navigation">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="'.BASE_URL.'index.php/?page=dashboard">Home</a></li>
                                            <li class="breadcrumb-item active" aria-current="page">Course Categories</li>
                                        </ol>
                                    </nav>
                                </div>
                            </div>
                        </div>
                        '.($data['message'] ?? '').'
                        <!-- Simple Datatable start -->
                        <div class="card-box mb-30">
                            <div class="pd-20">
                                <h4 class="text-blue h4 d-inline">Courses</h4>
                                <span class="float-right">
                                    <a href="'.BASE_URL.'index.php/?page=addCourseCategory" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Add Course Category</a>
                                </span>
                            </div>
                            <div class="pb-20">
                                <table id="mentor-table" class="table stripe hover nowrap">
                                    <thead>
                                        <tr>
                                           
                                            <th class="table-plus">#</th>
                                            <th>Name</th>
                                            <th class="datatable-nosort">Icon</th>
                                            <th>Data Created</th>
                                            <th class="datatable-nosort">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    '.$tr.'
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- Simple Datatable End -->
                    
                    </div>
                
                </div>
            </div>
        ';

        return $html;
    }   
    //displays the add courser category page
    public function editCourseCategory($data = []){
        // echo '<br><br><br><br>';
        // echo '<pre class="pt-5 d-flex justify-content-center">';
        // print_r($data);
        // echo '</pre>';
        $html = $this->preloader().'
            <div class="main-container">
                <div class="pd-ltr-20 ">
                    <div class="">
                        <div class="page-header">
                            <div class="row">
                                <div class="col-md-12 col-sm-12">
                                    <div class="title">
                                        <h4>Course Category</h4>
                                    </div>
                                    <nav aria-label="breadcrumb" role="navigation">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="'.BASE_URL.'index.php/?page=dashboard">Home</a></li>
                                            <li class="breadcrumb-item"><a href="'.BASE_URL.'index.php/?page=courseCategories">Edit Courses Category</a></li>
                                            <li class="breadcrumb-item active" aria-current="page">Edit Category</li>
                                        </ol>
                                    </nav>
                                </div>
                            </div>
                        </div>

                        <form action="'.BASE_URL.'" method="POST" class="profile-edit-list">
                            <div class="pd-20 card-box shadow">
                                <input type="hidden" name="action" value="updateCourseCategory">
                                <input type="hidden" name="courseCatId" value ="'.(encrypt($data['id'] ?? '')).'">
                                <div class="row d-flex justify-content-center">


                                    <div class="form-group col-md-12 col-12">
                                    
                                        <h4 class="text-blue h5 pl-0">Course Category Info</h4>
                                        <hr>
                                    </div>

                                    <div class="form-group col-md-6 col-12">
                                        <label>Course Name</label>
                                        <input class="form-control  form-control-lg" name="courseName" value="'.($data['name'] ?? '').'" placeholder="Accounting...." type="text" required>
                                    </div>
                                    <div class="form-group col-12 col-md-6">
                                        <label>Course icon</label>
                                        <input class="form-control form-control-lg" name="courseIcon" value="'.($data['icon'] ?? '').'" placeholder="fa fa-briefcase...." type="text" required>
                                    </div>
                                                                    

                                    <div class="col-12 col-md-12 mb-10 d-flex justify-content-end mr-20">
                                        <button type="submit" class="btn btn-primary"><i class="fa fa-pencil"></i> update</button>
                                    </div>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        ';
        return $html;

    }
    //displays the add courser category page
    public function addCourseCategory($data = []){

        $html = $this->preloader().'
            <div class="main-container">
                <div class="pd-ltr-20 xs-pd-20-10">
                    <div class="min-height-200px">
                        <div class="page-header">
                            <div class="row">
                                <div class="col-md-12 col-sm-12">
                                    <div class="title">
                                        <h4>Course Category</h4>
                                    </div>
                                    <nav aria-label="breadcrumb" role="navigation">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="'.BASE_URL.'index.php/?page=dashboard">Home</a></li>
                                            <li class="breadcrumb-item"><a href="'.BASE_URL.'index.php/?page=courseCategories">Add Courses Categories</a></li>
                                            <li class="breadcrumb-item active" aria-current="page">Add Categories</li>
                                        </ol>
                                    </nav>
                                </div>
                            </div>
                        </div>

                        <div class="pd-20 card-box shadow">
                                <form action="'.BASE_URL.'" method="POST" class="profile-edit-list">
                                    <input type="hidden" name="action" value="addNewCourseCategory">
                                     <div class="row">


                                    <div class="form-group col-12 col-md-12">
                                    
                                        <h4 class="text-blue h5 pl-0">Course Category Info</h4>
                                        <hr>
                                    </div>

                                    <div class="form-group col-12 col-md-6">
                                        <label>Course Name</label>
                                        <input class="form-control  form-control-lg" name="courseName" value="" placeholder="Accounting...." type="text" required>
                                    </div>
                                    <div class="form-group col-12 col-md-6">
                                        <label>Course Name</label>
                                        <input class="form-control form-control-lg" name="courserIcon" value="" placeholder="fa fa-briefcase...." type="text" required>
                                    </div>
                                                                      

                                    <div class="col-12 col-md-12 mb-10 d-flex justify-content-end mr-20">
                                        <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> Add Category</button>
                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        ';
        return $html;

    }
    //Displays a list of all the mentors in the system for a mentee
    public function viewMentors(){

        $html = $this->preloader().'
            <div class="main-container">
                <div class="pd-ltr-20 xs-pd-20-10">
                    <div class="min-height-200px">
                        <div class="page-header">
                            <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <div class="title">
                                        <h4>Mentors</h4>
                                    </div>
                                    <nav aria-label="breadcrumb" role="navigation">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                                            <li class="breadcrumb-item active" aria-current="page">View Mentors</li>
                                        </ol>
                                    </nav>
                                </div>
                                <div class="col-md-6 col-sm-12 pt-3">
                                    <form>
                                        <input type="hidden" name="action" value="mentorSearch">
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" name="search" placeholder="Search for a course..." aria-label="Search for a course" aria-describedby="basic-addon2">
                                            <div class="input-group-append">
                                            <button class="btn btn-outline-primary" type="button"><i class="fa fa-search"></i></button>
                                            </div>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                        
                        <div class="product-wrap">
                            <div id="pagination-content"> 
                                <div id="page-1"> 
                                    <div class="row">
                                        <div class="col-lg-3 col-md-3 col-12 d-flex align-items-stretch">
                                            <div class="da-card shadow">
                                                <div class="da-card-photo">
                                                    <img src="'.BASE_URL.'vendors/images/photo1.jpg" alt="">
                                                    <div class="da-overlay da-slide-top">
                                                        <div class="da-social">
                                                            <ul class="clearfix">
                                                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                                                <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                                                <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="da-card-content">
                                                    <a href="'.BASE_URL.'index.php/?page=mentorProfile">
                                                    <h5 class="h5 mb-0">Don H. Rabon</h5>
                                                    </a>
                                                    <span class="d-flex justify-content-start align-items-center">
                                                        <span data-toggle="tooltip" data-placement="top" title="4.0">
                                                            <span class="float-right"><i class="text-warning fa fa-star-o fa-lg"></i></span>
                                                            <span class="float-right"><i class="text-warning fa fa-star fa-lg"></i></span>
                                                            <span class="float-right"><i class="text-warning fa fa-star fa-lg"></i></span>
                                                            <span class="float-right"><i class="text-warning fa fa-star fa-lg"></i></span>
                                                            <span class="float-right"><i class="text-warning fa fa-star fa-lg"></i></span>
                                                        </span>
                                                    </span>                                    
                                                    <p class="mb-0 font-weight-bold">Job Title</p>
                                                    <p class="mb-3">Description of what this person does</p>

                                                    
                                                    
                                                    <span class="d-flex justify-content-end">
                                                        <a href="'.BASE_URL.'index.php/?page=" class="btn btn-success btn-sm" data-toggle="modal" data-target="#mentorship-request-success-modal"><i class="fa fa-paper-plane-o "></i> Request Mentorship</a>
                                                    </span>
                                                </div>
                                            </div>

                                        </div> <!-- End Course Item-->      

                                        <div class="col-lg-3 col-md-3 col-12 d-flex align-items-stretch mt-4 mt-md-0">
                                            <div class="da-card">
                                                <div class="da-card-photo">
                                                    <img src="'.BASE_URL.'vendors/images/photo1.jpg" alt="">
                                                    <div class="da-overlay da-slide-top">
                                                        <div class="da-social">
                                                            <ul class="clearfix">
                                                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                                                <li><a href="#"><i class="fa fa-envelope-o"></i></a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="da-card-content">
                                                    <h5 class="h5 mb-10">Don H. Rabon</h5>
                                                    <p class="mb-0">Lorem ipsum dolor sit amet</p>
                                                </div>
                                            </div>
                                        </div> <!-- End Course Item-->      

                                        <div class="col-lg-3 col-md-3 col-12 d-flex align-items-stretch mt-4 mt-md-0">
                                            <div class="da-card">
                                                <div class="da-card-photo">
                                                    <img src="'.BASE_URL.'vendors/images/photo1.jpg" alt="">
                                                    <div class="da-overlay da-slide-top">
                                                        <div class="da-social">
                                                            <ul class="clearfix">
                                                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                                                <li><a href="#"><i class="fa fa-envelope-o"></i></a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="da-card-content">
                                                    <h5 class="h5 mb-10">Don H. Rabon</h5>
                                                    <p class="mb-0">Lorem ipsum dolor sit amet</p>
                                                </div>
                                            </div>
                                        </div> <!-- End Course Item-->      

                                        <div class="col-lg-3 col-md-3 col-12 d-flex align-items-stretch mt-4 mt-md-0">
                                            <div class="da-card">
                                                <div class="da-card-photo">
                                                    <img src="'.BASE_URL.'vendors/images/photo1.jpg" alt="">
                                                    <div class="da-overlay da-slide-top">
                                                        <div class="da-social">
                                                            <ul class="clearfix">
                                                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                                                <li><a href="#"><i class="fa fa-envelope-o"></i></a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="da-card-content">
                                                    <h5 class="h5 mb-10">Don H. Rabon</h5>
                                                    <p class="mb-0">Lorem ipsum dolor sit amet</p>
                                                </div>
                                            </div>
                                        </div> <!-- End Course Item-->      
                                    </div>                                     
                                    <div class="row pt-3">
                                        <div class="col-lg-3 col-md-3 col-12 d-flex align-items-stretch">
                                            <div class="da-card">
                                                <div class="da-card-photo">
                                                    <img src="'.BASE_URL.'vendors/images/photo1.jpg" alt="">
                                                    <div class="da-overlay da-slide-top">
                                                        <div class="da-social">
                                                            <ul class="clearfix">
                                                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                                                <li><a href="#"><i class="fa fa-envelope-o"></i></a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="da-card-content">
                                                    <h5 class="h5 mb-10">Don H. Rabon</h5>
                                                    <p class="mb-0">Lorem ipsum dolor sit amet</p>
                                                </div>
                                            </div>

                                        </div> <!-- End Course Item-->      

                                        <div class="col-lg-3 col-md-3 col-12 d-flex align-items-stretch mt-4 mt-md-0">
                                            <div class="da-card">
                                                <div class="da-card-photo">
                                                    <img src="'.BASE_URL.'vendors/images/photo1.jpg" alt="">
                                                    <div class="da-overlay da-slide-top">
                                                        <div class="da-social">
                                                            <ul class="clearfix">
                                                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                                                <li><a href="#"><i class="fa fa-envelope-o"></i></a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="da-card-content">
                                                    <h5 class="h5 mb-10">Don H. Rabon</h5>
                                                    <p class="mb-0">Lorem ipsum dolor sit amet</p>
                                                </div>
                                            </div>
                                        </div> <!-- End Course Item-->      

                                        <div class="col-lg-3 col-md-3 col-12 d-flex align-items-stretch mt-4 mt-md-0">
                                            <div class="da-card">
                                                <div class="da-card-photo">
                                                    <img src="'.BASE_URL.'vendors/images/photo1.jpg" alt="">
                                                    <div class="da-overlay da-slide-top">
                                                        <div class="da-social">
                                                            <ul class="clearfix">
                                                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                                                <li><a href="#"><i class="fa fa-envelope-o"></i></a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="da-card-content">
                                                    <h5 class="h5 mb-10">Don H. Rabon</h5>
                                                    <p class="mb-0">Lorem ipsum dolor sit amet</p>
                                                </div>
                                            </div>
                                        </div> <!-- End Course Item-->      

                                        <div class="col-lg-3 col-md-3 col-12 d-flex align-items-stretch mt-4 mt-md-0">
                                            <div class="da-card">
                                                <div class="da-card-photo">
                                                    <img src="'.BASE_URL.'vendors/images/photo1.jpg" alt="">
                                                    <div class="da-overlay da-slide-top">
                                                        <div class="da-social">
                                                            <ul class="clearfix">
                                                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                                                <li><a href="#"><i class="fa fa-envelope-o"></i></a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="da-card-content">
                                                    <h5 class="h5 mb-10">Don H. Rabon</h5>
                                                    <p class="mb-0">Lorem ipsum dolor sit amet</p>
                                                </div>
                                            </div>
                                        </div> <!-- End Course Item-->      
                                    </div>                                     
                                </div>
                                <div id="page-2"> 

                                    <div class="row" >
                                        <div class="col-lg-3 col-md-3 col-12 d-flex align-items-stretch">
                                            <div class="da-card">
                                                <div class="da-card-photo">
                                                    <img src="'.BASE_URL.'vendors/images/photo1.jpg" alt="">
                                                    <div class="da-overlay da-slide-top">
                                                        <div class="da-social">
                                                            <ul class="clearfix">
                                                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                                                <li><a href="#"><i class="fa fa-envelope-o"></i></a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="da-card-content">
                                                    <h5 class="h5 mb-10">Don H. Rabon</h5>
                                                    <p class="mb-0">Lorem ipsum dolor sit amet</p>
                                                </div>
                                            </div>

                                        </div> <!-- End Course Item-->      

                                        <div class="col-lg-3 col-md-3 col-12 d-flex align-items-stretch mt-4 mt-md-0">
                                            <div class="da-card">
                                                <div class="da-card-photo">
                                                    <img src="'.BASE_URL.'vendors/images/photo1.jpg" alt="">
                                                    <div class="da-overlay da-slide-top">
                                                        <div class="da-social">
                                                            <ul class="clearfix">
                                                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                                                <li><a href="#"><i class="fa fa-envelope-o"></i></a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="da-card-content">
                                                    <h5 class="h5 mb-10">Don H. Rabon</h5>
                                                    <p class="mb-0">Lorem ipsum dolor sit amet</p>
                                                </div>
                                            </div>
                                        </div> <!-- End Course Item-->      

                                        <div class="col-lg-3 col-md-3 col-12 d-flex align-items-stretch mt-4 mt-md-0">
                                            <div class="da-card">
                                                <div class="da-card-photo">
                                                    <img src="'.BASE_URL.'vendors/images/photo1.jpg" alt="">
                                                    <div class="da-overlay da-slide-top">
                                                        <div class="da-social">
                                                            <ul class="clearfix">
                                                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                                                <li><a href="#"><i class="fa fa-envelope-o"></i></a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="da-card-content">
                                                    <h5 class="h5 mb-10">Don H. Rabon</h5>
                                                    <p class="mb-0">Lorem ipsum dolor sit amet</p>
                                                </div>
                                            </div>
                                        </div> <!-- End Course Item-->      

                                        <div class="col-lg-3 col-md-3 col-12 d-flex align-items-stretch mt-4 mt-md-0">
                                            <div class="da-card">
                                                <div class="da-card-photo">
                                                    <img src="'.BASE_URL.'vendors/images/photo1.jpg" alt="">
                                                    <div class="da-overlay da-slide-top">
                                                        <div class="da-social">
                                                            <ul class="clearfix">
                                                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                                                <li><a href="#"><i class="fa fa-envelope-o"></i></a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="da-card-content">
                                                    <h5 class="h5 mb-10">Don H. Rabon</h5>
                                                    <p class="mb-0">Lorem ipsum dolor sit amet</p>
                                                </div>
                                            </div>
                                        </div> <!-- End Course Item-->      
                                    </div>                                     
                                                                    
                                </div>
                                <div id="page-3"> 
                                    <div class="row" data-aos="zoom-in" data-aos-delay="100">
                                        <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
                                            <div class="card">
                                                <a href="'.BASE_URL.'index.php/?page=programDetails">
                                                    <img src="'.BASE_URL.'assets/img/course-1.jpg" class="img-fluid" alt="...">
                                                </a>
                                                <div class="card-body">
                                                    <h3><a href="'.BASE_URL.'index.php/?page=programDetails">Maths</a></h3>
                                                    
                                                    <span class="d-flex justify-content-start align-items-center">
                                                        <p class="" data-toggle="tooltip" data-placement="top" title="4.0">
                                                            <span class="float-right"><i class="text-warning fa fa-star-o fa-lg"></i></span>
                                                            <span class="float-right"><i class="text-warning fa fa-star fa-lg"></i></span>
                                                            <span class="float-right"><i class="text-warning fa fa-star fa-lg"></i></span>
                                                            <span class="float-right"><i class="text-warning fa fa-star fa-lg"></i></span>
                                                            <span class="float-right"><i class="text-warning fa fa-star fa-lg"></i></span>
                                                        </p>
                                                    </span>                                    

                                                    <p>Et architecto provident deleniti facere repellat nobis iste. Id facere quia quae dolores dolorem tempore.</p>
                                                    <span class="d-flex justify-content-end">
                                                        <a href="'.BASE_URL.'index.php/?page=" class="btn btn-success btn-sm"><i class="fa fa-paper-plane-o "></i> Request Mentorship</a>
                                                    </span>

                                                
                                                </div>
                                            </div>
                                        </div> <!-- End Course Item-->      

                                        <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-md-0">
                                            <div class="card">
                                                <a href="'.BASE_URL.'index.php/?page=programDetails">
                                                    <img src="'.BASE_URL.'assets/img/course-1.jpg" class="img-fluid" alt="...">
                                                </a>
                                                <div class="card-body">
                                                    <h3><a href="'.BASE_URL.'index.php/?page=programDetails">Maths</a></h3>
                                                    
                                                    <span class="d-flex justify-content-start align-items-center">
                                                        <p class="" data-toggle="tooltip" data-placement="top" title="4.0">
                                                            <span class="float-right"><i class="text-warning fa fa-star-o fa-lg"></i></span>
                                                            <span class="float-right"><i class="text-warning fa fa-star fa-lg"></i></span>
                                                            <span class="float-right"><i class="text-warning fa fa-star fa-lg"></i></span>
                                                            <span class="float-right"><i class="text-warning fa fa-star fa-lg"></i></span>
                                                            <span class="float-right"><i class="text-warning fa fa-star fa-lg"></i></span>
                                                        </p>
                                                    </span>                                    

                                                    <p>Et architecto provident deleniti facere repellat nobis iste. Id facere quia quae dolores dolorem tempore.</p>
                                                    <span class="d-flex justify-content-end">
                                                        <a href="'.BASE_URL.'index.php/?page=" class="btn btn-success btn-sm"><i class="fa fa-paper-plane-o "></i> Request Mentorship</a>
                                                    </span>

                                                
                                                </div>
                                            </div>
                                        </div> <!-- End Course Item-->      

                                        <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-md-0">
                                            <div class="card">
                                                <a href="'.BASE_URL.'index.php/?page=programDetails">
                                                    <img src="'.BASE_URL.'assets/img/course-1.jpg" class="img-fluid" alt="...">
                                                </a>
                                                <div class="card-body">
                                                    <h3><a href="'.BASE_URL.'index.php/?page=programDetails">Maths</a></h3>
                                                    
                                                    <span class="d-flex justify-content-start align-items-center">
                                                        <p class="" data-toggle="tooltip" data-placement="top" title="4.0">
                                                            <span class="float-right"><i class="text-warning fa fa-star-o fa-lg"></i></span>
                                                            <span class="float-right"><i class="text-warning fa fa-star fa-lg"></i></span>
                                                            <span class="float-right"><i class="text-warning fa fa-star fa-lg"></i></span>
                                                            <span class="float-right"><i class="text-warning fa fa-star fa-lg"></i></span>
                                                            <span class="float-right"><i class="text-warning fa fa-star fa-lg"></i></span>
                                                        </p>
                                                    </span>                                    

                                                    <p>Et architecto provident deleniti facere repellat nobis iste. Id facere quia quae dolores dolorem tempore.</p>
                                                    <span class="d-flex justify-content-end">
                                                        <a href="'.BASE_URL.'index.php/?page=" class="btn btn-success btn-sm"><i class="fa fa-paper-plane-o "></i> Request Mentorship</a>
                                                    </span>

                                                
                                                </div>
                                            </div>
                                        </div> <!-- End Course Item-->      
                                    </div>                                     
                                </div>
                            </div>
                            <div class="row pt-3">
                                <div class="col-12 d-flex justify-content-center">
                                    <div id="pagination-btn"> 
                                    </div>  
                                </div>
                            </div>
                        </div>
                    </div>
                   
                </div>
            </div>
            <script>
                setPaginationTotalCount(3);
            </script>
        ';
        
        return $html;
    }
    //Displays the course info 
    public function courseInfo(){

        $html = '
            <div class="main-container">
                <div class="pd-ltr-20 xs-pd-20-10">
                    <div class="min-height-200px">
                        <div class="page-header">
                            <div class="row">
                                <div class="col-md-12 col-sm-12">
                                    <div class="title">
                                        <h4>Course Info</h4>
                                    </div>
                                    <nav aria-label="breadcrumb" role="navigation">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="'.BASE_URL.'index.php/?page=dashboard">Home</a></li>
                                            <li class="breadcrumb-item active" aria-current="page">Course Info</li>
                                        </ol>
                                    </nav>
                                </div>
                            </div>
                        </div>
                        <div class="blog-wrap">
                            <div class="container pd-0">
                                <div class="row">
                                    <div class="col-md-8 col-sm-12">
                                        <div class="blog-detail card-box overflow-hidden mb-30">
                                            <div class="blog-img">
                                                <img src="'.BASE_URL.'vendors/images/img2.jpg" alt="">
                                            </div>
                                            <div class="blog-caption">
                                                <h4 class="mb-10">What you should learn from this course</h4>
                                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt 
                                                ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco 
                                                laboris nisi ut aliquip ex ea commodo</p>
                                                
                                                <h5 class="mb-10">Course Outline</h5>
                                                <ul>
                                                    <li>Duis aute irure dolor in reprehenderit in voluptate.</li>
                                                    <li>Sunt in culpa qui officia deserunt mollit anim id est laborum.</li>
                                                    <li>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris.</li>
                                                    <li>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</li>
                                                    <li>Duis aute irure dolor in reprehenderit in voluptate.</li>
                                                    <li>Sunt in culpa qui officia deserunt mollit anim id est laborum.</li>
                                                    <li>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris.</li>
                                                    <li>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-12">
                                        <div class="card-box mb-30">
                                            <h5 class="pd-20 h5 mb-0">Top 5 Course Mentors</h5>
                                            <div class="list-group">
                                                <a href="#" class="list-group-item d-flex align-items-center justify-content-between">Mentor 1<span class="badge badge-primary badge-pill rounded"  data-toggle="tooltip" data-placement="top" title="Mentees">7</span></a>
                                                <a href="#" class="list-group-item d-flex align-items-center justify-content-between">Mentor 2 <span class="badge badge-primary badge-pill rounded" data-toggle="tooltip" data-placement="top" title="Mentees">10</span></a>
                                                <a href="#" class="list-group-item d-flex align-items-center justify-content-between">Mentor 3 <span class="badge badge-primary badge-pill rounded" data-toggle="tooltip" data-placement="top" title="Mentees">8</span></a>
                                                <a href="#" class="list-group-item d-flex align-items-center justify-content-between">Mentor 4 <span class="badge badge-primary badge-pill rounded" data-toggle="tooltip" data-placement="top" title="Mentees">15</span></a>
                                                <a href="#" class="list-group-item d-flex align-items-center justify-content-between">Mentor 5 <span class="badge badge-primary badge-pill rounded" data-toggle="tooltip" data-placement="top" title="Mentees" >5</span></a>
                                            </div>
                                        </div>
                                        
                                        <h4 class="h4 mb-10 text-blue">Course Advisor</h4>
                                        <div class="da-card">
                                            <div class="da-card-photo">
                                                <img src="'.BASE_URL.'vendors/images/photo1.jpg" alt="">
                                                <div class="da-overlay da-slide-top">
                                                    <div class="da-social">
                                                        <ul class="clearfix">
                                                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                                            <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                                            <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="da-card-content">
                                                <h5 class="h5 mb-10">Don H. Rabon</h5>
                                                <p class="mb-0">Description about the advisor</p>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> 
        ';

        return $html;
    }
    //Display a list of all the available courses for a mentee
    public function viewCourses(){

        $cards = '';                            //holds all the card html markup
        $count = 0;                             //keeps track of how much cards have been made
        $maxCardPerPage = 6;                    //capacity of course cards per page for pagination
        $possibleCardTotal = $maxCardPerPage;   //gets added +6 everytime course cards reach maxCoursePerPage;
        $pageCount = 0;                         //page count for pagination
        $pages = '';                            //hold a the pages for the pagination
        $pageContent = '';                      //contains all the pages and pagination elements

        // if(!empty($data['mentors'])){
            
            for ($num = 0; $num < 6; $num++){//foreach($data['mentors'] as $key => $mentor){
                
                $cards .= '
                ';
               
                if ($count == ($possibleCardTotal-1)){
                    //creating page because we reached out maximum cards per page
                    $pageCount++;
                    $pages .= '
                        <div id="page-'.$pageCount.'"> 
                            <div class="row" data-aos="zoom-in" data-aos-delay="100">
                            '.$cards.'
                            </div>
                        </div>
                    ';
                    $cards = '';
                    $possibleCardTotal += $maxCardPerPage; // increasing count for another page to be added
                }

                $count++;


            }
            // Creating a page for the remaining Course Cards
            if ($count <= $possibleCardTotal){
                
                if ($count != ($possibleCardTotal - $maxCardPerPage)){
                    //if we have more cards than the maximum amount we will add another page
                    $pageCount++;
                }
                $pages .= '
                    <div id="page-'.$pageCount.'"> 
                        <div class="row" data-aos="zoom-in" data-aos-delay="100">
                            '.$cards.'
                        </div>
                    </div>
                ';
            }

            // creating pagination 
            $pageContent = '
                <div id="pagination-content">
                    '.$pages.'
                </div>
                <div class="row pt-3">
                    <div class="col-12 d-flex justify-content-center">
                        <div id="pagination-btn"> 
                        </div>  
                    </div>
                </div>
            ';
        // }

        $html = $this->preloader().'
            <div class="main-container">
                <div class="pd-ltr-20 xs-pd-20-10">
                    <div class="min-height-200px">
                        <div class="page-header">
                            <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <div class="title">
                                        <h4>Courses</h4>
                                    </div>
                                    <nav aria-label="breadcrumb" role="navigation">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                                            <li class="breadcrumb-item active" aria-current="page">View Courses</li>
                                        </ol>
                                    </nav>
                                </div>
                                <div class="col-md-6 col-sm-12 pt-3 pt-md-0">
                                    <form>
                                        <input type="hidden" name="action" value="courseSearch">
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" name="search" placeholder="Search for a course..." aria-label="Search for a course" aria-describedby="basic-addon2">
                                            <div class="input-group-append">
                                            <button class="btn btn-outline-primary" type="submit"><i class="fa fa-search"></i></button>
                                            </div>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                        
                        <div class="product-wrap">
                            '.$pageContent.'
                        </div>
                    </div>
                   
                </div>
            </div>
            <script>
                setPaginationTotalCount('.$pageCount.');
            </script>
        ';
        
        return $html;
    }
    //Displays a list of mentees in the system
    public function menteeList($data = array()){

        $tr = '';

        for ($i = 1; $i < 15; $i++){

            $tr .= '
                <tr>
                    <td class="table-plus">Danielson L. Correa</td>
                    <td>Basic Guitar Lessons</td>
                    <td class="text-success">Accepted</td>
                    <td>29-03-2017</td>
                    <td>29-03-2018</td>
                    <td>
                        <div class="dropdown">
                            <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                                <i class="dw dw-more"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                <a class="dropdown-item" href="#"><i class="dw dw-eye"></i> View</a>
                                <a class="dropdown-item" href="#"><i class="dw dw-edit2"></i> Edit</a>
                                <a class="dropdown-item text-danger" href="#"><i class="dw dw-delete-3"></i> Remove</a>
                            </div>
                        </div>
                    </td>
                </tr>
            ';

        }
        $html = $this->preloader().'
            <div class="main-container">
                <div class="pd-ltr-20 xs-pd-20-10">
                    <div class="min-height-200px">
                        <div class="page-header">
                            <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <div class="title">
                                        <h4>Mentees</h4>
                                    </div>
                                    
                                    <nav aria-label="breadcrumb" role="navigation">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="'.BASE_URL.'index.php/?page=dashboard">Home</a></li>
                                            <li class="breadcrumb-item active" aria-current="page">Mentees</li>
                                        </ol>
                                    </nav>
                                </div>
                        
                            </div>
                        </div>
                        <!-- Simple Datatable start -->
                        <div class="card-box mb-30">
                            <div class="pd-20">
                                <h4 class="text-blue h4">Mentees</h4>
                            </div>
                            <div class="pb-20">
                                <table id="mentor-table" class="table stripe hover nowrap">
                                    <thead>
                                        <tr>
                                            <th class="table-plus">Name</th>
                                            <th>Course Name</th>
                                            <th>Mentorship Request</th>
                                            <th>Date Joined</th>
                                            <th>Last Online</th>
                                            <th class="datatable-nosort">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="table-plus">S0G L. Correa</td>
                                            <td>0</td>
                                            <td class="text-warning">Pending</td>
                                            <td>29-03-2018</td>
                                            <td>29-03-2018</td>
                                            <td>
                                                <div class="dropdown">
                                                    <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                                                        <i class="dw dw-more"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                                        <a class="dropdown-item" href="#"><i class="dw dw-eye"></i> View</a>
                                                        <a class="dropdown-item" href="#"><i class="dw dw-edit2"></i> Edit</a>
                                                        <a class="dropdown-item text-danger" href="#"><i class="dw dw-delete-3"></i> Remove</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>   
                                        <tr>
                                            <td class="table-plus">S0G L. Correa</td>
                                            <td>0</td>
                                            <td class="text-danger">Rejected</td>
                                            <td>29-03-2018</td>
                                            <td>29-03-2018</td>
                                            <td>
                                                <div class="dropdown">
                                                    <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                                                        <i class="dw dw-more"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                                        <a class="dropdown-item" href="#"><i class="dw dw-eye"></i> View</a>
                                                        <a class="dropdown-item" href="#"><i class="dw dw-edit2"></i> Edit</a>
                                                        <a class="dropdown-item text-danger" href="#"><i class="dw dw-delete-3"></i> Delete</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>   
                                        '.$tr.'
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- Simple Datatable End -->
                    
                    </div>
                
                </div>
            </div>
        ';

        return $html;
    }
    // Displays the mentor profile  
    public function editMentorProfile($data = array()){

        $html = $this->preloader().'
        <div class="main-container">
            <div class="pd-ltr-20 xs-pd-20-10">
                <div class="min-height-200px">
                    <div class="page-header">
                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <div class="title">
                                    <h4>Edit Profile</h4>

                                </div>
                                <nav aria-label="breadcrumb" role="navigation">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="'.BASE_URL.'index.php/?page=dashboard">Home</a></li>
                                        <li class="breadcrumb-item"><a href="'.BASE_URL.'index.php/?page=mentorList">Mentors</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Edit Mentor Profile</li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                    <div class="row d-flex justify-content-center">
                        <div class="col-xl-10 col-lg-10 col-md-10 col-sm-12 mb-30">
                            <div class="card-box height-100-p overflow-hidden">
                                <div class="profile-tab height-100-p">
                                    <div class="tab height-100-p">
                                       
                                        <div class="profile-setting">
                                            <ul>
                                                <form action="'.BASE_URL.'" method="POST" class="profile-edit-list">
                                                    <h4 class="text-blue h5 pl-20">Personal Information</h4>
                                                    <hr>
                                                    <li class="weight-500 row">
                                                        <input type="hidden" name="action" value="updatePersonalInfo">
                                                        <div class="form-group col-12 col-md-6">
                                                            <label>First Name</label>
                                                            <input class="form-control name="firstName" value="" form-control-lg" type="text">
                                                        </div>
                                                        <div class="form-group col-12 col-md-6">
                                                            <label>Last Name</label>
                                                            <input class="form-control name="lastName" value="" form-control-lg" type="text">
                                                        </div>
                                                        <div class="form-group col-12 col-md-6">
                                                            <label>Occupation</label>
                                                            <input class="form-control form-control-lg" type="text" name="jobTitle">
                                                        </div>
                                                        <div class="form-group col-12 col-md-6">
                                                            <label>Email</label>
                                                            <input class="form-control form-control-lg" type="email" name="email">
                                                        </div>
                                                        <div class="form-group col-12 col-md-6">
                                                            <label>Date of birth</label>
                                                            <input class="form-control form-control-lg date-picker" name="dob" type="text">
                                                        </div>
                                                        <div class="form-group col-12 col-md-6">
                                                            <label>Gender</label>
                                                            <div class="d-flex">
                                                            <div class="custom-control custom-radio mb-5 mr-20">
                                                                <input type="radio" id="customRadio4" name="gender" class="custom-control-input">
                                                                <label class="custom-control-label weight-400" for="customRadio4">Male</label>
                                                            </div>
                                                            <div class="custom-control custom-radio mb-5">
                                                                <input type="radio" id="customRadio5" name="gender" class="custom-control-input">
                                                                <label class="custom-control-label weight-400" for="customRadio5">Female</label>
                                                            </div>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="form-group col-12 col-md-6">
                                                            <label>District</label>
                                                            <select class="selectpicker form-control form-control-lg" name="district"  data-style="btn-outline-secondary btn-lg" title="Not Chosen">
                                                                <option>Corozal</option>
                                                                <option>Orange Walk</option>
                                                                <option>Belize</option>
                                                                <option>Cayo</option>
                                                                <option>Stann Creek</option>
                                                                <option>Toledo</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group col-12 col-md-6">
                                                            <label>City/Town/Village</label>
                                                            <input class="form-control form-control-lg" name="ctv" type="text">
                                                        </div>
                                                        <div class="form-group col-12 col-md-6">
                                                            <label>Address</label>
                                                            <input class="form-control form-control-lg" name="address" type="text">
                                                        </div>
                                                        
                                                        <div class="form-group col-12 col-md-6">
                                                            <label>Phone</label>
                                                            <input class="form-control" value="111-1111" type="tel">
                                                        </div>
                                                        
                                                        <div class="form-group col-12 col-md-12">
                                                            <label>What do you want people to know about you?</label>
                                                            <textarea class="form-control" name="description"></textarea>
                                                        </div>


                                                        
                                                    </li>
                                                    <div class="mb-10 d-flex justify-content-end mr-20">
                                                        <input type="submit" class="btn btn-primary" value="Save & Update">
                                                    </div>
                                                </form>
                                                <h4 class="text-blue h5 pl-20">Edit Social Media links</h4>
                                                <hr>
                                                <form action="'.BASE_URL.'" method="POST" class="profile-edit-list">
                                                    <li class="weight-500 row pt-0 mt-0">
                                                        <input type="hidden" name="action" value="updateSocialLinks">
                                                        <div class="form-group col-12 col-md-6">
                                                            <label>Facebook URL:</label>
                                                            <input class="form-control form-control-lg" type="text" placeholder="Paste your link here">
                                                        </div>
                                                        <div class="form-group col-12 col-md-6">
                                                            <label>Twitter URL:</label>
                                                            <input class="form-control form-control-lg" type="text" placeholder="Paste your link here">
                                                        </div>
                                                        <div class="form-group col-12 col-md-6">
                                                            <label>Linkedin URL:</label>
                                                            <input class="form-control form-control-lg" type="text" placeholder="Paste your link here">
                                                        </div>
                                                        <div class="form-group col-12 col-md-6">
                                                            <label>Instagram URL:</label>
                                                            <input class="form-control form-control-lg" type="text" placeholder="Paste your link here">
                                                        </div>
                                                        
                                                    </li>
                                                    <div class="mb-10 d-flex justify-content-end mr-20">
                                                        <input type="submit" class="btn btn-primary" value="Save & Update">
                                                    </div>
                                                </form>
                                            </ul>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        ';
        return $html;
    }   
    //Displays the info of a mentor
    public function viewMentorProfile($data = array()){

        $html = $this->preloader().'
            <div class="main-container">
                <div class="pd-ltr-20 xs-pd-20-10">
                    <div class="min-height-200px">
                        <div class="page-header">
                            <div class="row">
                                <div class="col-md-12 col-sm-12">
                                    <div class="title">
                                        <h4>Profile</h4>
                                    </div>
                                    <nav aria-label="breadcrumb" role="navigation">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="'.BASE_URL.'index.php/?page=dashboard">Home</a></li>
                                            <li class="breadcrumb-item"><a href="'.BASE_URL.'index.php/?page=mentorsList">Mentors</a></li>
                                            <li class="breadcrumb-item active" aria-current="page">Mentor Profile</li>
                                        </ol>
                                    </nav>
                                </div>
                            </div>
                        </div>
                        <div class="row d-flex justify-content-center">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 mb-30">
                                <div class="pd-20 card-box height-100-p">
                                    <div class="profile-photo">
                                        <img src="'.BASE_URL.'img/profileImg/default-profile-pic.png" alt="" class="avatar-photo">
                                    </div>
                                    <h5 class="text-center h5 mb-0">Ross C. Lopez</h5>
                                    <p class="text-center text-muted font-14">Lorem ipsum dolor sit amet</p>
                                    <div class="profile-info">
                                        <h5 class="mb-20 h5 text-blue">Personal Information</h5>
                                        <ul class="row">
                                            <li class="col-12 col-md-4">
                                                <span>Occupation:</span>
                                                Teacher
                                            </li>
                                            <li class="col-12 col-md-4">
                                                <span>Gender:</span>
                                                Female
                                            </li>
                                            <li class="col-12 col-md-4">
                                                <span>Date of Birth:</span>
                                                December 16, 2020
                                            </li>
                                            
                                        </ul>
                                    </div>
                                    <div class="profile-info">
                                        <h5 class="mb-20 h5 text-blue">Contact Information</h5>
                                        <ul class="row">
                                            <li class="col-12 col-md-4">
                                                <span>Email Address:</span>
                                                FerdinandMChilds@test.com
                                            </li>
                                            <li class="col-12 col-md-4">
                                                <span>Phone Number:</span>
                                                619-229-0054
                                            </li>
                                            <li class="col-12 col-md-4">
                                                <span>District:</span>
                                                Belize
                                            </li>
                                            <li class="col-12 col-md-4">
                                                <span>City/Town/Village:</span>
                                                Ladyville
                                            </li>
                                            <li class="col-12 col-md-4">
                                                <span>Address:</span>
                                                1807 Holden Street,<br class="d-sm-block d-md-none">
                                                San Diego, CA 92115
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="profile-social">
                                        <h5 class="mb-20 h5 text-blue">Social Links</h5>
                                        <ul class="clearfix">
                                            <li><a href="#" class="btn" data-bgcolor="#3b5998" data-color="#ffffff"><i class="fa fa-facebook"></i></a></li>
                                            <li><a href="#" class="btn" data-bgcolor="#1da1f2" data-color="#ffffff"><i class="fa fa-twitter"></i></a></li>
                                            <li><a href="#" class="btn" data-bgcolor="#007bb5" data-color="#ffffff"><i class="fa fa-linkedin"></i></a></li>
                                            <li><a href="#" class="btn" data-bgcolor="#f46f30" data-color="#ffffff"><i class="fa fa-instagram"></i></a></li>
                                            <li><a href="#" class="btn" data-bgcolor="#db4437" data-color="#ffffff"><i class="fa fa-google-plus"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="profile-skills">
                                        <h5 class="mb-20 h5 text-blue">Course(s)</h5>
                                        <ul class="list-group">
                                            <li class="list-group-item ">
                                                <span class="d-block d-flex justify-content-between align-items-center">
                                                    <p>Marketing</p>
                                                    <span class="badge badge-primary badge-pill" data-toggle="tooltip" data-placement="top" title="Mentee Count">14</span>
                                                </span>
                                                <span class="d-flex justify-content-start" data-toggle="tooltip" data-placement="top" title="4.0">
                                                    <span class=""><i class="text-warning fa fa-star fa-lg"></i></span>
                                                    <span class=""><i class="text-warning fa fa-star fa-lg"></i></span>
                                                    <span class=""><i class="text-warning fa fa-star fa-lg"></i></span>
                                                    <span class=""><i class="text-warning fa fa-star fa-lg"></i></span>
                                                    <span class=""><i class="text-warning fa fa-star-o fa-lg"></i></span>
                                                </span>
                                            </li>
                                            <li class="list-group-item ">
                                                <span class="d-block d-flex justify-content-between align-items-center">
                                                    <p>Programming</p>
                                                    <span class="badge badge-primary badge-pill" data-toggle="tooltip" data-placement="top" title="Mentee Count">7</span>
                                                </span>
                                                <span class="d-flex justify-content-start" data-toggle="tooltip" data-placement="top" title="4.0">
                                                    <span class=""><i class="text-warning fa fa-star fa-lg"></i></span>
                                                    <span class=""><i class="text-warning fa fa-star-o fa-lg"></i></span>
                                                    <span class=""><i class="text-warning fa fa-star-o fa-lg"></i></span>
                                                    <span class=""><i class="text-warning fa fa-star-o fa-lg"></i></span>
                                                    <span class=""><i class="text-warning fa fa-star-o fa-lg"></i></span>
                                                </span>
                                            </li>
                                            <li class="list-group-item ">
                                                <span class="d-block d-flex justify-content-between align-items-center">
                                                    <p>Psychology</p>
                                                    <span class="badge badge-primary badge-pill" data-toggle="tooltip" data-placement="top" title="Mentee Count">10</span>
                                                </span>
                                                <span class="d-flex justify-content-start" data-toggle="tooltip" data-placement="top" title="4.0">
                                                    <span class=""><i class="text-warning fa fa-star fa-lg"></i></span>
                                                    <span class=""><i class="text-warning fa fa-star-o fa-lg"></i></span>
                                                    <span class=""><i class="text-warning fa fa-star-o fa-lg"></i></span>
                                                    <span class=""><i class="text-warning fa fa-star-o fa-lg"></i></span>
                                                    <span class=""><i class="text-warning fa fa-star-o fa-lg"></i></span>
                                                </span>
                                            </li>
                                            <li class="list-group-item ">
                                                <span class="d-block d-flex justify-content-between align-items-center">
                                                    <p>Maths</p>
                                                    <span class="badge badge-primary badge-pill" data-toggle="tooltip" data-placement="top" title="Mentee Count">12</span>
                                                </span>
                                                <span class="d-flex justify-content-start" data-toggle="tooltip" data-placement="top" title="4.0">
                                                    <span class=""><i class="text-warning fa fa-star fa-lg"></i></span>
                                                    <span class=""><i class="text-warning fa fa-star fa-lg"></i></span>
                                                    <span class=""><i class="text-warning fa fa-star fa-lg"></i></span>
                                                    <span class=""><i class="text-warning fa fa-star-o fa-lg"></i></span>
                                                    <span class=""><i class="text-warning fa fa-star-o fa-lg"></i></span>
                                                </span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        ';

        return $html;

    } 
    //Displays the Mentee profile
    public function menteeProfile($data = array()){

        $html = $this->prelaoder().'
        <div class="main-container">
            <div class="pd-ltr-20 xs-pd-20-10">
                <div class="min-height-200px">
                    <div class="page-header">
                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <div class="title">
                                    <h4>Profile</h4>
                                </div>
                                <nav aria-label="breadcrumb" role="navigation">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="'.BASE_URL.'index.php/?page=dashboard">Home</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Profile</li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 mb-30">
                            <div class="pd-20 card-box height-100-p">
                                <div class="profile-photo">
                                    <a href="modal" data-toggle="modal" data-target="#modal" class="edit-avatar"><i class="fa fa-pencil"></i></a>
                                    <img src="'.BASE_URL.'vendors/images/photo1.jpg" alt="" class="avatar-photo">
                                    <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-body pd-5">
                                                    <div class="img-container">
                                                        <img id="image" src="'.BASE_URL.'vendors/images/photo2.jpg" alt="Picture">
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <input type="submit" value="Update" class="btn btn-primary">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <h5 class="text-center h5 mb-0">Ross C. Lopez</h5>
                                <p class="text-center text-muted font-14">Lorem ipsum dolor sit amet</p>
                                <div class="profile-info">
                                    <h5 class="mb-20 h5 text-blue">Contact Information</h5>
                                    <ul>
                                        <li>
                                            <span>Email Address:</span>
                                            FerdinandMChilds@test.com
                                        </li>
                                        <li>
                                            <span>Phone Number:</span>
                                            619-229-0054
                                        </li>
                                        <li>
                                            <span>Country:</span>
                                            America
                                        </li>
                                        <li>
                                            <span>Address:</span>
                                            1807 Holden Street<br>
                                            San Diego, CA 92115
                                        </li>
                                    </ul>
                                </div>
                                <div class="profile-social">
                                    <h5 class="mb-20 h5 text-blue">Social Links</h5>
                                    <ul class="clearfix">
                                        <li><a href="#" class="btn" data-bgcolor="#3b5998" data-color="#ffffff"><i class="fa fa-facebook"></i></a></li>
                                        <li><a href="#" class="btn" data-bgcolor="#1da1f2" data-color="#ffffff"><i class="fa fa-twitter"></i></a></li>
                                        <li><a href="#" class="btn" data-bgcolor="#007bb5" data-color="#ffffff"><i class="fa fa-linkedin"></i></a></li>
                                        <li><a href="#" class="btn" data-bgcolor="#f46f30" data-color="#ffffff"><i class="fa fa-instagram"></i></a></li>
                                        <li><a href="#" class="btn" data-bgcolor="#db4437" data-color="#ffffff"><i class="fa fa-google-plus"></i></a></li>
                                    </ul>
                                </div>
                                <div class="profile-skills">
                                    <h5 class="mb-20 h5 text-blue">Key Skills</h5>
                                    <h6 class="mb-5 font-14">HTML</h6>
                                    <div class="progress mb-20" style="height: 6px;">
                                        <div class="progress-bar" role="progressbar" style="width: 90%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <h6 class="mb-5 font-14">Css</h6>
                                    <div class="progress mb-20" style="height: 6px;">
                                        <div class="progress-bar" role="progressbar" style="width: 70%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <h6 class="mb-5 font-14">jQuery</h6>
                                    <div class="progress mb-20" style="height: 6px;">
                                        <div class="progress-bar" role="progressbar" style="width: 60%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <h6 class="mb-5 font-14">Bootstrap</h6>
                                    <div class="progress mb-20" style="height: 6px;">
                                        <div class="progress-bar" role="progressbar" style="width: 80%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 mb-30">
                            <div class="card-box height-100-p overflow-hidden">
                                <div class="profile-tab height-100-p">
                                    <div class="tab height-100-p">
                                        <ul class="nav nav-tabs customtab" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link active" data-toggle="tab" href="#timeline" role="tab">Timeline</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" data-toggle="tab" href="#tasks" role="tab">Tasks</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" data-toggle="tab" href="#setting" role="tab">Settings</a>
                                            </li>
                                        </ul>
                                        <div class="tab-content">
                                            <!-- Timeline Tab start -->
                                            <div class="tab-pane fade show active" id="timeline" role="tabpanel">
                                                <div class="pd-20">
                                                    <div class="profile-timeline">
                                                        <div class="timeline-month">
                                                            <h5>August, 2020</h5>
                                                        </div>
                                                        <div class="profile-timeline-list">
                                                            <ul>
                                                                <li>
                                                                    <div class="date">12 Aug</div>
                                                                    <div class="task-name"><i class="ion-android-alarm-clock"></i> Task Added</div>
                                                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                                                                    <div class="task-time">09:30 am</div>
                                                                </li>
                                                                <li>
                                                                    <div class="date">10 Aug</div>
                                                                    <div class="task-name"><i class="ion-ios-chatboxes"></i> Task Added</div>
                                                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                                                                    <div class="task-time">09:30 am</div>
                                                                </li>
                                                                <li>
                                                                    <div class="date">10 Aug</div>
                                                                    <div class="task-name"><i class="ion-ios-clock"></i> Event Added</div>
                                                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                                                                    <div class="task-time">09:30 am</div>
                                                                </li>
                                                                <li>
                                                                    <div class="date">10 Aug</div>
                                                                    <div class="task-name"><i class="ion-ios-clock"></i> Event Added</div>
                                                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                                                                    <div class="task-time">09:30 am</div>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <div class="timeline-month">
                                                            <h5>July, 2020</h5>
                                                        </div>
                                                        <div class="profile-timeline-list">
                                                            <ul>
                                                                <li>
                                                                    <div class="date">12 July</div>
                                                                    <div class="task-name"><i class="ion-android-alarm-clock"></i> Task Added</div>
                                                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                                                                    <div class="task-time">09:30 am</div>
                                                                </li>
                                                                <li>
                                                                    <div class="date">10 July</div>
                                                                    <div class="task-name"><i class="ion-ios-chatboxes"></i> Task Added</div>
                                                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                                                                    <div class="task-time">09:30 am</div>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <div class="timeline-month">
                                                            <h5>June, 2020</h5>
                                                        </div>
                                                        <div class="profile-timeline-list">
                                                            <ul>
                                                                <li>
                                                                    <div class="date">12 June</div>
                                                                    <div class="task-name"><i class="ion-android-alarm-clock"></i> Task Added</div>
                                                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                                                                    <div class="task-time">09:30 am</div>
                                                                </li>
                                                                <li>
                                                                    <div class="date">10 June</div>
                                                                    <div class="task-name"><i class="ion-ios-chatboxes"></i> Task Added</div>
                                                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                                                                    <div class="task-time">09:30 am</div>
                                                                </li>
                                                                <li>
                                                                    <div class="date">10 June</div>
                                                                    <div class="task-name"><i class="ion-ios-clock"></i> Event Added</div>
                                                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                                                                    <div class="task-time">09:30 am</div>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Timeline Tab End -->
                                            <!-- Tasks Tab start -->
                                            <div class="tab-pane fade" id="tasks" role="tabpanel">
                                                <div class="pd-20 profile-task-wrap">
                                                    <div class="container pd-0">
                                                        <!-- Open Task start -->
                                                        <div class="task-title row align-items-center">
                                                            <div class="col-md-8 col-sm-12">
                                                                <h5>Open Tasks (4 Left)</h5>
                                                            </div>
                                                            <div class="col-md-4 col-sm-12 text-right">
                                                                <a href="task-add" data-toggle="modal" data-target="#task-add" class="bg-light-blue btn text-blue weight-500"><i class="ion-plus-round"></i> Add</a>
                                                            </div>
                                                        </div>
                                                        <div class="profile-task-list pb-30">
                                                            <ul>
                                                                <li>
                                                                    <div class="custom-control custom-checkbox mb-5">
                                                                        <input type="checkbox" class="custom-control-input" id="task-1">
                                                                        <label class="custom-control-label" for="task-1"></label>
                                                                    </div>
                                                                    <div class="task-type">Email</div>
                                                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Id ea earum.
                                                                    <div class="task-assign">Assigned to Ferdinand M. <div class="due-date">due date <span>22 February 2019</span></div></div>
                                                                </li>
                                                                <li>
                                                                    <div class="custom-control custom-checkbox mb-5">
                                                                        <input type="checkbox" class="custom-control-input" id="task-2">
                                                                        <label class="custom-control-label" for="task-2"></label>
                                                                    </div>
                                                                    <div class="task-type">Email</div>
                                                                    Lorem ipsum dolor sit amet.
                                                                    <div class="task-assign">Assigned to Ferdinand M. <div class="due-date">due date <span>22 February 2019</span></div></div>
                                                                </li>
                                                                <li>
                                                                    <div class="custom-control custom-checkbox mb-5">
                                                                        <input type="checkbox" class="custom-control-input" id="task-3">
                                                                        <label class="custom-control-label" for="task-3"></label>
                                                                    </div>
                                                                    <div class="task-type">Email</div>
                                                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                                                                    <div class="task-assign">Assigned to Ferdinand M. <div class="due-date">due date <span>22 February 2019</span></div></div>
                                                                </li>
                                                                <li>
                                                                    <div class="custom-control custom-checkbox mb-5">
                                                                        <input type="checkbox" class="custom-control-input" id="task-4">
                                                                        <label class="custom-control-label" for="task-4"></label>
                                                                    </div>
                                                                    <div class="task-type">Email</div>
                                                                    Lorem ipsum dolor sit amet. Id ea earum.
                                                                    <div class="task-assign">Assigned to Ferdinand M. <div class="due-date">due date <span>22 February 2019</span></div></div>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <!-- Open Task End -->
                                                        <!-- Close Task start -->
                                                        <div class="task-title row align-items-center">
                                                            <div class="col-md-12 col-sm-12">
                                                                <h5>Closed Tasks</h5>
                                                            </div>
                                                        </div>
                                                        <div class="profile-task-list close-tasks">
                                                            <ul>
                                                                <li>
                                                                    <div class="custom-control custom-checkbox mb-5">
                                                                        <input type="checkbox" class="custom-control-input" id="task-close-1" checked="" disabled="">
                                                                        <label class="custom-control-label" for="task-close-1"></label>
                                                                    </div>
                                                                    <div class="task-type">Email</div>
                                                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Id ea earum.
                                                                    <div class="task-assign">Assigned to Ferdinand M. <div class="due-date">due date <span>22 February 2018</span></div></div>
                                                                </li>
                                                                <li>
                                                                    <div class="custom-control custom-checkbox mb-5">
                                                                        <input type="checkbox" class="custom-control-input" id="task-close-2" checked="" disabled="">
                                                                        <label class="custom-control-label" for="task-close-2"></label>
                                                                    </div>
                                                                    <div class="task-type">Email</div>
                                                                    Lorem ipsum dolor sit amet.
                                                                    <div class="task-assign">Assigned to Ferdinand M. <div class="due-date">due date <span>22 February 2018</span></div></div>
                                                                </li>
                                                                <li>
                                                                    <div class="custom-control custom-checkbox mb-5">
                                                                        <input type="checkbox" class="custom-control-input" id="task-close-3" checked="" disabled="">
                                                                        <label class="custom-control-label" for="task-close-3"></label>
                                                                    </div>
                                                                    <div class="task-type">Email</div>
                                                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                                                                    <div class="task-assign">Assigned to Ferdinand M. <div class="due-date">due date <span>22 February 2018</span></div></div>
                                                                </li>
                                                                <li>
                                                                    <div class="custom-control custom-checkbox mb-5">
                                                                        <input type="checkbox" class="custom-control-input" id="task-close-4" checked="" disabled="">
                                                                        <label class="custom-control-label" for="task-close-4"></label>
                                                                    </div>
                                                                    <div class="task-type">Email</div>
                                                                    Lorem ipsum dolor sit amet. Id ea earum.
                                                                    <div class="task-assign">Assigned to Ferdinand M. <div class="due-date">due date <span>22 February 2018</span></div></div>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <!-- Close Task start -->
                                                        <!-- add task popup start -->
                                                        <div class="modal fade customscroll" id="task-add" tabindex="-1" role="dialog">
                                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLongTitle">Tasks Add</h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Close Modal">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body pd-0">
                                                                        <div class="task-list-form">
                                                                            <ul>
                                                                                <li>
                                                                                    <form>
                                                                                        <div class="form-group row">
                                                                                            <label class="col-md-4">Task Type</label>
                                                                                            <div class="col-md-8">
                                                                                                <input type="text" class="form-control">
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="form-group row">
                                                                                            <label class="col-md-4">Task Message</label>
                                                                                            <div class="col-md-8">
                                                                                                <textarea class="form-control"></textarea>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="form-group row">
                                                                                            <label class="col-md-4">Assigned to</label>
                                                                                            <div class="col-md-8">
                                                                                                <select class="selectpicker form-control" data-style="btn-outline-primary" title="Not Chosen" multiple="" data-selected-text-format="count" data-count-selected-text= "{0} people selected">
                                                                                                    <option>Ferdinand M.</option>
                                                                                                    <option>Don H. Rabon</option>
                                                                                                    <option>Ann P. Harris</option>
                                                                                                    <option>Katie D. Verdin</option>
                                                                                                    <option>Christopher S. Fulghum</option>
                                                                                                    <option>Matthew C. Porter</option>
                                                                                                </select>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="form-group row mb-0">
                                                                                            <label class="col-md-4">Due Date</label>
                                                                                            <div class="col-md-8">
                                                                                                <input type="text" class="form-control date-picker">
                                                                                            </div>
                                                                                        </div>
                                                                                    </form>
                                                                                </li>
                                                                                <li>
                                                                                    <a href="javascript:;" class="remove-task"  data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Remove Task"><i class="ion-minus-circled"></i></a>
                                                                                    <form>
                                                                                        <div class="form-group row">
                                                                                            <label class="col-md-4">Task Type</label>
                                                                                            <div class="col-md-8">
                                                                                                <input type="text" class="form-control">
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="form-group row">
                                                                                            <label class="col-md-4">Task Message</label>
                                                                                            <div class="col-md-8">
                                                                                                <textarea class="form-control"></textarea>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="form-group row">
                                                                                            <label class="col-md-4">Assigned to</label>
                                                                                            <div class="col-md-8">
                                                                                                <select class="selectpicker form-control" data-style="btn-outline-primary" title="Not Chosen" multiple="" data-selected-text-format="count" data-count-selected-text= "{0} people selected">
                                                                                                    <option>Ferdinand M.</option>
                                                                                                    <option>Don H. Rabon</option>
                                                                                                    <option>Ann P. Harris</option>
                                                                                                    <option>Katie D. Verdin</option>
                                                                                                    <option>Christopher S. Fulghum</option>
                                                                                                    <option>Matthew C. Porter</option>
                                                                                                </select>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="form-group row mb-0">
                                                                                            <label class="col-md-4">Due Date</label>
                                                                                            <div class="col-md-8">
                                                                                                <input type="text" class="form-control date-picker">
                                                                                            </div>
                                                                                        </div>
                                                                                    </form>
                                                                                </li>
                                                                            </ul>
                                                                        </div>
                                                                        <div class="add-more-task">
                                                                            <a href="#" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Add Task"><i class="ion-plus-circled"></i> Add More Task</a>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-primary">Add</button>
                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- add task popup End -->
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Tasks Tab End -->
                                            <!-- Setting Tab start -->
                                            <div class="tab-pane fade height-100-p" id="setting" role="tabpanel">
                                                <div class="profile-setting">
                                                    <form>
                                                        <ul class="profile-edit-list row">
                                                            <li class="weight-500 col-md-6">
                                                                <h4 class="text-blue h5 mb-20">Edit Your Personal Setting</h4>
                                                                <div class="form-group">
                                                                    <label>Full Name</label>
                                                                    <input class="form-control form-control-lg" type="text">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Title</label>
                                                                    <input class="form-control form-control-lg" type="text">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Email</label>
                                                                    <input class="form-control form-control-lg" type="email">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Date of birth</label>
                                                                    <input class="form-control form-control-lg date-picker" type="text">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Gender</label>
                                                                    <div class="d-flex">
                                                                    <div class="custom-control custom-radio mb-5 mr-20">
                                                                        <input type="radio" id="customRadio4" name="customRadio" class="custom-control-input">
                                                                        <label class="custom-control-label weight-400" for="customRadio4">Male</label>
                                                                    </div>
                                                                    <div class="custom-control custom-radio mb-5">
                                                                        <input type="radio" id="customRadio5" name="customRadio" class="custom-control-input">
                                                                        <label class="custom-control-label weight-400" for="customRadio5">Female</label>
                                                                    </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Country</label>
                                                                    <select class="selectpicker form-control form-control-lg" data-style="btn-outline-secondary btn-lg" title="Not Chosen">
                                                                        <option>United States</option>
                                                                        <option>India</option>
                                                                        <option>United Kingdom</option>
                                                                    </select>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>State/Province/Region</label>
                                                                    <input class="form-control form-control-lg" type="text">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Postal Code</label>
                                                                    <input class="form-control form-control-lg" type="text">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Phone Number</label>
                                                                    <input class="form-control form-control-lg" type="text">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Address</label>
                                                                    <textarea class="form-control"></textarea>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Visa Card Number</label>
                                                                    <input class="form-control form-control-lg" type="text">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Paypal ID</label>
                                                                    <input class="form-control form-control-lg" type="text">
                                                                </div>
                                                                <div class="form-group">
                                                                    <div class="custom-control custom-checkbox mb-5">
                                                                        <input type="checkbox" class="custom-control-input" id="customCheck1-1">
                                                                        <label class="custom-control-label weight-400" for="customCheck1-1">I agree to receive notification emails</label>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group mb-0">
                                                                    <input type="submit" class="btn btn-primary" value="Update Information">
                                                                </div>
                                                            </li>
                                                            <li class="weight-500 col-md-6">
                                                                <h4 class="text-blue h5 mb-20">Edit Social Media links</h4>
                                                                <div class="form-group">
                                                                    <label>Facebook URL:</label>
                                                                    <input class="form-control form-control-lg" type="text" placeholder="Paste your link here">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Twitter URL:</label>
                                                                    <input class="form-control form-control-lg" type="text" placeholder="Paste your link here">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Linkedin URL:</label>
                                                                    <input class="form-control form-control-lg" type="text" placeholder="Paste your link here">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Instagram URL:</label>
                                                                    <input class="form-control form-control-lg" type="text" placeholder="Paste your link here">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Dribbble URL:</label>
                                                                    <input class="form-control form-control-lg" type="text" placeholder="Paste your link here">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Dropbox URL:</label>
                                                                    <input class="form-control form-control-lg" type="text" placeholder="Paste your link here">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Google-plus URL:</label>
                                                                    <input class="form-control form-control-lg" type="text" placeholder="Paste your link here">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Pinterest URL:</label>
                                                                    <input class="form-control form-control-lg" type="text" placeholder="Paste your link here">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Skype URL:</label>
                                                                    <input class="form-control form-control-lg" type="text" placeholder="Paste your link here">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Vine URL:</label>
                                                                    <input class="form-control form-control-lg" type="text" placeholder="Paste your link here">
                                                                </div>
                                                                <div class="form-group mb-0">
                                                                    <input type="submit" class="btn btn-primary" value="Save & Update">
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </form>
                                                </div>
                                            </div>
                                            <!-- Setting Tab End -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        ';
        return $html;
    }
    //Displays the administrators profile
    public function adminProfile($data = array()){

        $html = $this->preloader().'
            <div class="main-container">
                <div class="pd-ltr-20 xs-pd-20-10">
                    <div class="min-height-200px">
                        <div class="page-header">
                            <div class="row">
                                <div class="col-md-12 col-sm-12">
                                    <div class="title">
                                        <h4>Profile</h4>
                                    </div>
                                    <nav aria-label="breadcrumb" role="navigation">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="'.BASE_URL.'index.php/?page=dashboard">Home</a></li>
                                            <li class="breadcrumb-item active" aria-current="page">Profile</li>
                                        </ol>
                                    </nav>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 mb-30">
                                <div class="pd-20 card-box height-100-p">
                                    <div class="profile-photo">
                                        <a href="modal" data-toggle="modal" data-target="#modal" class="edit-avatar"><i class="fa fa-pencil"></i></a>
                                        <img src="'.BASE_URL.'vendors/images/photo1.jpg" alt="" class="avatar-photo">
                                        <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-body pd-5">
                                                        <div class="img-container">
                                                            <img id="image" src="'.BASE_URL.'vendors/images/photo2.jpg" alt="Picture">
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <input type="submit" value="Update" class="btn btn-primary">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <h5 class="text-center h5 mb-0">Ross C. Lopez</h5>
                                    <p class="text-center text-muted font-14">Lorem ipsum dolor sit amet</p>
                                    <div class="profile-info">
                                        <h5 class="mb-20 h5 text-blue">Contact Information</h5>
                                        <ul>
                                            <li>
                                                <span>Email Address:</span>
                                                FerdinandMChilds@test.com
                                            </li>
                                            <li>
                                                <span>Phone Number:</span>
                                                619-229-0054
                                            </li>
                                            <li>
                                                <span>Country:</span>
                                                America
                                            </li>
                                            <li>
                                                <span>Address:</span>
                                                1807 Holden Street<br>
                                                San Diego, CA 92115
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="profile-social">
                                        <h5 class="mb-20 h5 text-blue">Social Links</h5>
                                        <ul class="clearfix">
                                            <li><a href="#" class="btn" data-bgcolor="#3b5998" data-color="#ffffff"><i class="fa fa-facebook"></i></a></li>
                                            <li><a href="#" class="btn" data-bgcolor="#1da1f2" data-color="#ffffff"><i class="fa fa-twitter"></i></a></li>
                                            <li><a href="#" class="btn" data-bgcolor="#007bb5" data-color="#ffffff"><i class="fa fa-linkedin"></i></a></li>
                                            <li><a href="#" class="btn" data-bgcolor="#f46f30" data-color="#ffffff"><i class="fa fa-instagram"></i></a></li>
                                            <li><a href="#" class="btn" data-bgcolor="#db4437" data-color="#ffffff"><i class="fa fa-google-plus"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="profile-skills">
                                        <h5 class="mb-20 h5 text-blue">Key Skills</h5>
                                        <h6 class="mb-5 font-14">HTML</h6>
                                        <div class="progress mb-20" style="height: 6px;">
                                            <div class="progress-bar" role="progressbar" style="width: 90%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        <h6 class="mb-5 font-14">Css</h6>
                                        <div class="progress mb-20" style="height: 6px;">
                                            <div class="progress-bar" role="progressbar" style="width: 70%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        <h6 class="mb-5 font-14">jQuery</h6>
                                        <div class="progress mb-20" style="height: 6px;">
                                            <div class="progress-bar" role="progressbar" style="width: 60%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        <h6 class="mb-5 font-14">Bootstrap</h6>
                                        <div class="progress mb-20" style="height: 6px;">
                                            <div class="progress-bar" role="progressbar" style="width: 80%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 mb-30">
                                <div class="card-box height-100-p overflow-hidden">
                                    <div class="profile-tab height-100-p">
                                        <div class="tab height-100-p">
                                            <ul class="nav nav-tabs customtab" role="tablist">
                                                <li class="nav-item">
                                                    <a class="nav-link active" data-toggle="tab" href="#timeline" role="tab">Timeline</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" data-toggle="tab" href="#tasks" role="tab">Tasks</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" data-toggle="tab" href="#setting" role="tab">Settings</a>
                                                </li>
                                            </ul>
                                            <div class="tab-content">
                                                <!-- Timeline Tab start -->
                                                <div class="tab-pane fade show active" id="timeline" role="tabpanel">
                                                    <div class="pd-20">
                                                        <div class="profile-timeline">
                                                            <div class="timeline-month">
                                                                <h5>August, 2020</h5>
                                                            </div>
                                                            <div class="profile-timeline-list">
                                                                <ul>
                                                                    <li>
                                                                        <div class="date">12 Aug</div>
                                                                        <div class="task-name"><i class="ion-android-alarm-clock"></i> Task Added</div>
                                                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                                                                        <div class="task-time">09:30 am</div>
                                                                    </li>
                                                                    <li>
                                                                        <div class="date">10 Aug</div>
                                                                        <div class="task-name"><i class="ion-ios-chatboxes"></i> Task Added</div>
                                                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                                                                        <div class="task-time">09:30 am</div>
                                                                    </li>
                                                                    <li>
                                                                        <div class="date">10 Aug</div>
                                                                        <div class="task-name"><i class="ion-ios-clock"></i> Event Added</div>
                                                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                                                                        <div class="task-time">09:30 am</div>
                                                                    </li>
                                                                    <li>
                                                                        <div class="date">10 Aug</div>
                                                                        <div class="task-name"><i class="ion-ios-clock"></i> Event Added</div>
                                                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                                                                        <div class="task-time">09:30 am</div>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                            <div class="timeline-month">
                                                                <h5>July, 2020</h5>
                                                            </div>
                                                            <div class="profile-timeline-list">
                                                                <ul>
                                                                    <li>
                                                                        <div class="date">12 July</div>
                                                                        <div class="task-name"><i class="ion-android-alarm-clock"></i> Task Added</div>
                                                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                                                                        <div class="task-time">09:30 am</div>
                                                                    </li>
                                                                    <li>
                                                                        <div class="date">10 July</div>
                                                                        <div class="task-name"><i class="ion-ios-chatboxes"></i> Task Added</div>
                                                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                                                                        <div class="task-time">09:30 am</div>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                            <div class="timeline-month">
                                                                <h5>June, 2020</h5>
                                                            </div>
                                                            <div class="profile-timeline-list">
                                                                <ul>
                                                                    <li>
                                                                        <div class="date">12 June</div>
                                                                        <div class="task-name"><i class="ion-android-alarm-clock"></i> Task Added</div>
                                                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                                                                        <div class="task-time">09:30 am</div>
                                                                    </li>
                                                                    <li>
                                                                        <div class="date">10 June</div>
                                                                        <div class="task-name"><i class="ion-ios-chatboxes"></i> Task Added</div>
                                                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                                                                        <div class="task-time">09:30 am</div>
                                                                    </li>
                                                                    <li>
                                                                        <div class="date">10 June</div>
                                                                        <div class="task-name"><i class="ion-ios-clock"></i> Event Added</div>
                                                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                                                                        <div class="task-time">09:30 am</div>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Timeline Tab End -->
                                                <!-- Tasks Tab start -->
                                                <div class="tab-pane fade" id="tasks" role="tabpanel">
                                                    <div class="pd-20 profile-task-wrap">
                                                        <div class="container pd-0">
                                                            <!-- Open Task start -->
                                                            <div class="task-title row align-items-center">
                                                                <div class="col-md-8 col-sm-12">
                                                                    <h5>Open Tasks (4 Left)</h5>
                                                                </div>
                                                                <div class="col-md-4 col-sm-12 text-right">
                                                                    <a href="task-add" data-toggle="modal" data-target="#task-add" class="bg-light-blue btn text-blue weight-500"><i class="ion-plus-round"></i> Add</a>
                                                                </div>
                                                            </div>
                                                            <div class="profile-task-list pb-30">
                                                                <ul>
                                                                    <li>
                                                                        <div class="custom-control custom-checkbox mb-5">
                                                                            <input type="checkbox" class="custom-control-input" id="task-1">
                                                                            <label class="custom-control-label" for="task-1"></label>
                                                                        </div>
                                                                        <div class="task-type">Email</div>
                                                                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Id ea earum.
                                                                        <div class="task-assign">Assigned to Ferdinand M. <div class="due-date">due date <span>22 February 2019</span></div></div>
                                                                    </li>
                                                                    <li>
                                                                        <div class="custom-control custom-checkbox mb-5">
                                                                            <input type="checkbox" class="custom-control-input" id="task-2">
                                                                            <label class="custom-control-label" for="task-2"></label>
                                                                        </div>
                                                                        <div class="task-type">Email</div>
                                                                        Lorem ipsum dolor sit amet.
                                                                        <div class="task-assign">Assigned to Ferdinand M. <div class="due-date">due date <span>22 February 2019</span></div></div>
                                                                    </li>
                                                                    <li>
                                                                        <div class="custom-control custom-checkbox mb-5">
                                                                            <input type="checkbox" class="custom-control-input" id="task-3">
                                                                            <label class="custom-control-label" for="task-3"></label>
                                                                        </div>
                                                                        <div class="task-type">Email</div>
                                                                        Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                                                                        <div class="task-assign">Assigned to Ferdinand M. <div class="due-date">due date <span>22 February 2019</span></div></div>
                                                                    </li>
                                                                    <li>
                                                                        <div class="custom-control custom-checkbox mb-5">
                                                                            <input type="checkbox" class="custom-control-input" id="task-4">
                                                                            <label class="custom-control-label" for="task-4"></label>
                                                                        </div>
                                                                        <div class="task-type">Email</div>
                                                                        Lorem ipsum dolor sit amet. Id ea earum.
                                                                        <div class="task-assign">Assigned to Ferdinand M. <div class="due-date">due date <span>22 February 2019</span></div></div>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                            <!-- Open Task End -->
                                                            <!-- Close Task start -->
                                                            <div class="task-title row align-items-center">
                                                                <div class="col-md-12 col-sm-12">
                                                                    <h5>Closed Tasks</h5>
                                                                </div>
                                                            </div>
                                                            <div class="profile-task-list close-tasks">
                                                                <ul>
                                                                    <li>
                                                                        <div class="custom-control custom-checkbox mb-5">
                                                                            <input type="checkbox" class="custom-control-input" id="task-close-1" checked="" disabled="">
                                                                            <label class="custom-control-label" for="task-close-1"></label>
                                                                        </div>
                                                                        <div class="task-type">Email</div>
                                                                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Id ea earum.
                                                                        <div class="task-assign">Assigned to Ferdinand M. <div class="due-date">due date <span>22 February 2018</span></div></div>
                                                                    </li>
                                                                    <li>
                                                                        <div class="custom-control custom-checkbox mb-5">
                                                                            <input type="checkbox" class="custom-control-input" id="task-close-2" checked="" disabled="">
                                                                            <label class="custom-control-label" for="task-close-2"></label>
                                                                        </div>
                                                                        <div class="task-type">Email</div>
                                                                        Lorem ipsum dolor sit amet.
                                                                        <div class="task-assign">Assigned to Ferdinand M. <div class="due-date">due date <span>22 February 2018</span></div></div>
                                                                    </li>
                                                                    <li>
                                                                        <div class="custom-control custom-checkbox mb-5">
                                                                            <input type="checkbox" class="custom-control-input" id="task-close-3" checked="" disabled="">
                                                                            <label class="custom-control-label" for="task-close-3"></label>
                                                                        </div>
                                                                        <div class="task-type">Email</div>
                                                                        Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                                                                        <div class="task-assign">Assigned to Ferdinand M. <div class="due-date">due date <span>22 February 2018</span></div></div>
                                                                    </li>
                                                                    <li>
                                                                        <div class="custom-control custom-checkbox mb-5">
                                                                            <input type="checkbox" class="custom-control-input" id="task-close-4" checked="" disabled="">
                                                                            <label class="custom-control-label" for="task-close-4"></label>
                                                                        </div>
                                                                        <div class="task-type">Email</div>
                                                                        Lorem ipsum dolor sit amet. Id ea earum.
                                                                        <div class="task-assign">Assigned to Ferdinand M. <div class="due-date">due date <span>22 February 2018</span></div></div>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                            <!-- Close Task start -->
                                                            <!-- add task popup start -->
                                                            <div class="modal fade customscroll" id="task-add" tabindex="-1" role="dialog">
                                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="exampleModalLongTitle">Tasks Add</h5>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Close Modal">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body pd-0">
                                                                            <div class="task-list-form">
                                                                                <ul>
                                                                                    <li>
                                                                                        <form>
                                                                                            <div class="form-group row">
                                                                                                <label class="col-md-4">Task Type</label>
                                                                                                <div class="col-md-8">
                                                                                                    <input type="text" class="form-control">
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="form-group row">
                                                                                                <label class="col-md-4">Task Message</label>
                                                                                                <div class="col-md-8">
                                                                                                    <textarea class="form-control"></textarea>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="form-group row">
                                                                                                <label class="col-md-4">Assigned to</label>
                                                                                                <div class="col-md-8">
                                                                                                    <select class="selectpicker form-control" data-style="btn-outline-primary" title="Not Chosen" multiple="" data-selected-text-format="count" data-count-selected-text= "{0} people selected">
                                                                                                        <option>Ferdinand M.</option>
                                                                                                        <option>Don H. Rabon</option>
                                                                                                        <option>Ann P. Harris</option>
                                                                                                        <option>Katie D. Verdin</option>
                                                                                                        <option>Christopher S. Fulghum</option>
                                                                                                        <option>Matthew C. Porter</option>
                                                                                                    </select>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="form-group row mb-0">
                                                                                                <label class="col-md-4">Due Date</label>
                                                                                                <div class="col-md-8">
                                                                                                    <input type="text" class="form-control date-picker">
                                                                                                </div>
                                                                                            </div>
                                                                                        </form>
                                                                                    </li>
                                                                                    <li>
                                                                                        <a href="javascript:;" class="remove-task"  data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Remove Task"><i class="ion-minus-circled"></i></a>
                                                                                        <form>
                                                                                            <div class="form-group row">
                                                                                                <label class="col-md-4">Task Type</label>
                                                                                                <div class="col-md-8">
                                                                                                    <input type="text" class="form-control">
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="form-group row">
                                                                                                <label class="col-md-4">Task Message</label>
                                                                                                <div class="col-md-8">
                                                                                                    <textarea class="form-control"></textarea>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="form-group row">
                                                                                                <label class="col-md-4">Assigned to</label>
                                                                                                <div class="col-md-8">
                                                                                                    <select class="selectpicker form-control" data-style="btn-outline-primary" title="Not Chosen" multiple="" data-selected-text-format="count" data-count-selected-text= "{0} people selected">
                                                                                                        <option>Ferdinand M.</option>
                                                                                                        <option>Don H. Rabon</option>
                                                                                                        <option>Ann P. Harris</option>
                                                                                                        <option>Katie D. Verdin</option>
                                                                                                        <option>Christopher S. Fulghum</option>
                                                                                                        <option>Matthew C. Porter</option>
                                                                                                    </select>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="form-group row mb-0">
                                                                                                <label class="col-md-4">Due Date</label>
                                                                                                <div class="col-md-8">
                                                                                                    <input type="text" class="form-control date-picker">
                                                                                                </div>
                                                                                            </div>
                                                                                        </form>
                                                                                    </li>
                                                                                </ul>
                                                                            </div>
                                                                            <div class="add-more-task">
                                                                                <a href="#" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Add Task"><i class="ion-plus-circled"></i> Add More Task</a>
                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-primary">Add</button>
                                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- add task popup End -->
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Tasks Tab End -->
                                                <!-- Setting Tab start -->
                                                <div class="tab-pane fade height-100-p" id="setting" role="tabpanel">
                                                    <div class="profile-setting">
                                                        <form>
                                                            <ul class="profile-edit-list row">
                                                                <li class="weight-500 col-md-6">
                                                                    <h4 class="text-blue h5 mb-20">Edit Your Personal Setting</h4>
                                                                    <div class="form-group">
                                                                        <label>Full Name</label>
                                                                        <input class="form-control form-control-lg" type="text">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Title</label>
                                                                        <input class="form-control form-control-lg" type="text">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Email</label>
                                                                        <input class="form-control form-control-lg" type="email">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Date of birth</label>
                                                                        <input class="form-control form-control-lg date-picker" type="text">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Gender</label>
                                                                        <div class="d-flex">
                                                                        <div class="custom-control custom-radio mb-5 mr-20">
                                                                            <input type="radio" id="customRadio4" name="customRadio" class="custom-control-input">
                                                                            <label class="custom-control-label weight-400" for="customRadio4">Male</label>
                                                                        </div>
                                                                        <div class="custom-control custom-radio mb-5">
                                                                            <input type="radio" id="customRadio5" name="customRadio" class="custom-control-input">
                                                                            <label class="custom-control-label weight-400" for="customRadio5">Female</label>
                                                                        </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Country</label>
                                                                        <select class="selectpicker form-control form-control-lg" data-style="btn-outline-secondary btn-lg" title="Not Chosen">
                                                                            <option>United States</option>
                                                                            <option>India</option>
                                                                            <option>United Kingdom</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>State/Province/Region</label>
                                                                        <input class="form-control form-control-lg" type="text">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Postal Code</label>
                                                                        <input class="form-control form-control-lg" type="text">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Phone Number</label>
                                                                        <input class="form-control form-control-lg" type="text">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Address</label>
                                                                        <textarea class="form-control"></textarea>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Visa Card Number</label>
                                                                        <input class="form-control form-control-lg" type="text">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Paypal ID</label>
                                                                        <input class="form-control form-control-lg" type="text">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <div class="custom-control custom-checkbox mb-5">
                                                                            <input type="checkbox" class="custom-control-input" id="customCheck1-1">
                                                                            <label class="custom-control-label weight-400" for="customCheck1-1">I agree to receive notification emails</label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group mb-0">
                                                                        <input type="submit" class="btn btn-primary" value="Update Information">
                                                                    </div>
                                                                </li>
                                                                <li class="weight-500 col-md-6">
                                                                    <h4 class="text-blue h5 mb-20">Edit Social Media links</h4>
                                                                    <div class="form-group">
                                                                        <label>Facebook URL:</label>
                                                                        <input class="form-control form-control-lg" type="text" placeholder="Paste your link here">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Twitter URL:</label>
                                                                        <input class="form-control form-control-lg" type="text" placeholder="Paste your link here">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Linkedin URL:</label>
                                                                        <input class="form-control form-control-lg" type="text" placeholder="Paste your link here">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Instagram URL:</label>
                                                                        <input class="form-control form-control-lg" type="text" placeholder="Paste your link here">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Dribbble URL:</label>
                                                                        <input class="form-control form-control-lg" type="text" placeholder="Paste your link here">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Dropbox URL:</label>
                                                                        <input class="form-control form-control-lg" type="text" placeholder="Paste your link here">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Google-plus URL:</label>
                                                                        <input class="form-control form-control-lg" type="text" placeholder="Paste your link here">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Pinterest URL:</label>
                                                                        <input class="form-control form-control-lg" type="text" placeholder="Paste your link here">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Skype URL:</label>
                                                                        <input class="form-control form-control-lg" type="text" placeholder="Paste your link here">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Vine URL:</label>
                                                                        <input class="form-control form-control-lg" type="text" placeholder="Paste your link here">
                                                                    </div>
                                                                    <div class="form-group mb-0">
                                                                        <input type="submit" class="btn btn-primary" value="Save & Update">
                                                                    </div>
                                                                </li>
                                                            </ul>
                                                        </form>
                                                    </div>
                                                </div>
                                                <!-- Setting Tab End -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        ';
        return $html;
    }
    //Displays all the webinars available for the content
    public function programContent(){

        $html = $this->preloader().'

        <div class="main-container">
            <div class="pd-ltr-20 customscroll-10-p height-100-p xs-pd-20-10">
                <div class="min-height-200px">
                    <div class="page-header">
                        <div class="row">
                            <div class="col-md-6 col-sm-12">
                                <div class="title">
                                    <h4>Marketing Feed</h4>
                                </div>
                                <nav aria-label="breadcrumb" role="navigation">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="'.BASE_URL.'?page=dashboard">Home</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Feed</li>
                                    </ol>
                                </nav>
                            </div>
                            <div class="col-md-6 col-sm-12 text-right pt-3">
                                <a class="btn btn-primary btn-sm" href="#" data-toggle="modal" data-target="#add-post-modal">
                                    <i class="icon-copy fa fa-plus" aria-hidden="true"></i> Add Post                  
                                </a>
                            </div>
                        </div>
                    </div>
                    
                    <span class="discussion">
                        <div class="pd-20 card-box mb-30">
                            <div class="clearfix mb-0">
                                <div class="dropleft">
                                    <i class="fa fa-ellipsis-v fa-lg float-right" aria-hidden="true" data-toggle="dropdown"></i>
                                    <div class="dropdown-menu dropright" aria-haspopup="true" aria-expanded="false">
                                        <h6 class="dropdown-header">Actions</h6>
                                        <a href="#" class="btn btn-link dropdown-item" data-toggle="modal" data-target="#edit-post-modal" data-backdrop="static" data-keyboard="false">
                                            <i class="fa fa-edit fa-lg"></i> Edit
                                        </a>
                                        <a href="#" class="btn btn-link dropdown-item text-danger" data-toggle="modal" data-target="#delete-post-modal">
                                            <i class="fa fa-trash fa-lg"></i> Delete
                                        </a>
                                    </div>
                                </div>

                                <div class="pull-left">
                                    <span class="d-block pb-2">
                                        <a class="" href="#">
                                            <span class="user-profile">
                                                <img src="'.BASE_URL.'vendors/images/photo1.jpg" alt="">
                                            </span>
                                            <span class="text-blue h5">
                                                Ross Lopenasonadasino
                                            </span>

                                        </a>
                                    </span>
                                    <span class="ml-3 d-block text-secondary">
                                        September 29, 2020
                                    </span>
                                    <span class="d-flex justify-content-start align-items-center ml-3 mt-2" data-toggle="tooltip" data-placement="top" title="4.0">
                                        <span class="float-right"><i class="text-warning fa fa-star fa-lg"></i></span>
                                        <span class="float-right"><i class="text-warning fa fa-star fa-lg"></i></span>
                                        <span class="float-right"><i class="text-warning fa fa-star fa-lg"></i></span>
                                        <span class="float-right"><i class="text-warning fa fa-star fa-lg"></i></span>
                                        <span class="float-right"><i class="text-warning fa fa-star-o fa-lg"></i></span>
                                    </span>                                    
                                </div>
                                
                            </div>
                            <div class="card-body">
                                <p>
                                    Post Content here -Lorem Ipsum is simply dummy text of the printing and typesetting industry. 
                                    Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown 
                                    printer took a galley of type and scrambled it to make a type specimen book. It has survived not
                                    only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.
                                    It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently 
                                    with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum. 
                                </p>
                            </div>
                            <div class="clearfix">
                                <span class="pull-right">
                                    <button class="btn btn-link text-secondary mr-2 reply-to-forum">
                                        <i class="icon-copy fa fa-reply" aria-hidden="true"></i> Reply
                                    </button>
                                    <!--<span class="mr-2">
                                        <i class="icon-copy fa fa-thumbs-o-up fa-lg like pr-2" aria-hidden="true"  data-placement="top" data-toggle="tooltip" title="I like this"><span class="pl-2">33</span></i>
                                        <i class="icon-copy fa fa-thumbs-o-down fa-lg dislike" aria-hidden="true" data-placement="top" data-toggle="tooltip" title="I dislike this"><span class="pl-2">3</span></i>
                                    </span>-->
                                    
                                </span>    
                                <span class="pull-left">
                                    <button class="btn btn-link text-secondary view-replies"><span class="reply-display-text">View</span> 4 Replies</button>
                                </span>                            
                            </div>      
                        </div>
                        <div class="reply-input d-none">
                            <form class="reply-input-form" action="'.BASE_URL.'" method="POST">
                                <input type="hidden" name="action" value="forumReply">
                                <input type="hidden" name="replyToId" value="id">
                                <input type="hidden" name="replyToName" value="Ross C. Lopez">
                                <div class="html-editor pd-20 card-box mb-30">
                                    <h4>Reply to "<i class="reply-to"></i>"</h4>
                                    <hr>
                                    <textarea class="post-reply form-control border-radius-0" rows="4" name="reply" placeholder="Enter text ..."></textarea>
                                    
                                    <div class="pt-3 d-flex justify-content-end">
                                        <button class="btn btn-secondary mr-2 cancel-form-reply">CANCEL</button>
                                        <button class="btn btn-primary post-form-reply">POST</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="reply-content ml-5" style="display: none;">
                            <div class="pd-20 card-box mb-30">
                                <h4 class="">Reply to "<i>Ross C. Lopez</i>"</h4>
                                <hr>
                                <div class="clearfix mb-0">
                                    <div class="pull-left">
                                        <span class="d-block pb-2">
                                            <a class="" href="#">
                                                <span class="user-profile">
                                                    <img src="'.BASE_URL.'vendors/images/photo1.jpg" alt="">
                                                </span>
                                                <span class="text-blue h5">
                                                    Ross C. Lopez
                                                </span>

                                            </a>
                                        </span>
                                        <span class="ml-3 text-secondary">
                                            September 29, 2020
                                        </span>
                                    </div>
                                    <div class="pull-right text-secondary">
                                        <div class="btn-group dropleft">
                                            <i class="fa fa-ellipsis-v fa-lg text-dark" aria-hidden="true" data-toggle="dropdown"></i>
                                            <div class="dropdown-menu dropright" aria-haspopup="true" aria-expanded="false">
                                                <h6 class="dropdown-header">Actions</h6>
                                                <a href="#" class="btn btn-link dropdown-item">
                                                    <i class="fa fa-paper-plane fa-lg"></i> Testimonial Request
                                                </a>
                                                <a href="#" class="btn btn-link dropdown-item">
                                                    <i class="fa fa-edit fa-lg"></i> Edit
                                                </a>
                                                <a href="#" class="btn btn-link dropdown-item text-danger">
                                                    <i class="fa fa-trash fa-lg"></i> Delete
                                                </a>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                                <div class="card-body">
                                    <p>
                                        Post Content here -Lorem Ipsum is simply dummy text of the printing and typesetting industry. 
                                        Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown 
                                        printer took a galley of type and scrambled it to make a type specimen book. It has survived not
                                        only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.
                                        It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently 
                                        with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum. 
                                    </p>
                                </div>
                                <div class="clearfix">
                                    <span class="pull-right">
                                        <button class="btn btn-link text-secondary mr-3">
                                            <i class="icon-copy fa fa-reply" aria-hidden="true"></i> Reply
                                        </button>
                                        <span class="mr-2">
                                            <i class="icon-copy fa fa-thumbs-o-up fa-lg" aria-hidden="true"  data-placement="top" data-toggle="tooltip" title="I like this"></i>33
                                            &nbsp;
                                            <i class="icon-copy fa fa-thumbs-o-down fa-lg" aria-hidden="true" data-placement="top" data-toggle="tooltip" title="I dislike this"></i>2
                                        </span>
                                        
                                    </span>    
                                </div>      
                            </div>
                            <div class="pd-20 card-box mb-30">
                                <h4 class="">Reply to "<i>Ross C. Lopez</i>"</h4>
                                <hr>
                                <div class="clearfix mb-0">
                                    <div class="pull-left">
                                        <span class="d-block pb-2">
                                            <a class="" href="#">
                                                <span class="user-profile">
                                                    <img src="'.BASE_URL.'vendors/images/photo1.jpg" alt="">
                                                </span>
                                                <span class="text-blue h5">
                                                    Ross C. Lopez
                                                </span>

                                            </a>
                                        </span>
                                        <span class="ml-3 text-secondary">
                                            September 29, 2020
                                        </span>
                                    </div>
                                    <div class="pull-right text-secondary">
                                        <div class="btn-group dropleft">
                                            <i class="fa fa-ellipsis-v fa-lg text-dark" aria-hidden="true" data-toggle="dropdown"></i>
                                            <div class="dropdown-menu dropright" aria-haspopup="true" aria-expanded="false">
                                                <h6 class="dropdown-header">Actions</h6>
                                                <a href="#" class="btn btn-link dropdown-item">
                                                    <i class="fa fa-edit fa-lg"></i> Edit
                                                </a>
                                                <a href="#" class="btn btn-link dropdown-item text-danger">
                                                    <i class="fa fa-trash fa-lg"></i> Delete
                                                </a>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                                <div class="card-body">
                                    <p>
                                        Post Content here -Lorem Ipsum is simply dummy text of the printing and typesetting industry. 
                                        Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown 
                                        printer took a galley of type and scrambled it to make a type specimen book. It has survived not
                                        only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.
                                        It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently 
                                        with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum. 
                                    </p>
                                </div>
                                <div class="clearfix">
                                    <span class="pull-right">
                                        <button class="btn btn-link text-secondary mr-3">
                                            <i class="icon-copy fa fa-reply" aria-hidden="true"></i> Reply
                                        </button>
                                        <span class="mr-2">
                                            <i class="icon-copy fa fa-thumbs-o-up fa-lg" aria-hidden="true"  data-placement="top" data-toggle="tooltip" title="I like this"></i>33
                                            &nbsp;
                                            <i class="icon-copy fa fa-thumbs-o-down fa-lg" aria-hidden="true" data-placement="top" data-toggle="tooltip" title="I dislike this"></i>2
                                        </span>
                                        
                                    </span>    
                                </div>      
                            </div>
                        </div> 
                    </span>
                    <span class="discussion">
                        <div class="pd-20 card-box mb-30">
                            <div class="clearfix mb-0">
                                <div class="dropleft">
                                    <i class="fa fa-ellipsis-v fa-lg float-right" aria-hidden="true" data-toggle="dropdown"></i>
                                    <div class="dropdown-menu dropright" aria-haspopup="true" aria-expanded="false">
                                        <h6 class="dropdown-header">Actions</h6>
                                        <a href="#" class="btn btn-link dropdown-item" data-toggle="modal" data-target="#edit-post-modal" data-backdrop="static" data-keyboard="false">
                                            <i class="fa fa-edit fa-lg"></i> Edit
                                        </a>
                                        <a href="#" class="btn btn-link dropdown-item text-danger" data-toggle="modal" data-target="#delete-post-modal">
                                            <i class="fa fa-trash fa-lg"></i> Delete
                                        </a>
                                    </div>
                                </div>

                                <div class="pull-left">
                                    <span class="d-block pb-2">
                                        <a class="" href="#">
                                            <span class="user-profile">
                                                <img src="'.BASE_URL.'vendors/images/photo1.jpg" alt="">
                                            </span>
                                            <span class="text-blue h5">
                                                Ross Lopenasonadasino
                                            </span>
                                        </a>
                                    </span>
                                    <span class="ml-3 text-secondary">
                                        September 29, 2020
                                    </span>
                                </div>
                                
                            </div>
                            <div class="container mb-3 mt-3">
                                <div data-type="youtube" data-video-id="dS7no_IEXgE"></div>
                            </div>
                            <div class="clearfix">
                                <span class="pull-right">
                                    <button class="btn btn-link text-secondary mr-2 reply-to-forum">
                                        <i class="icon-copy fa fa-reply" aria-hidden="true"></i> Reply
                                    </button>
                                    <span class="mr-2">
                                        <i class="icon-copy fa fa-thumbs-o-up fa-lg like pr-2" aria-hidden="true"  data-placement="top" data-toggle="tooltip" title="I like this"><span class="pl-2">33</span></i>
                                        <i class="icon-copy fa fa-thumbs-o-down fa-lg dislike" aria-hidden="true" data-placement="top" data-toggle="tooltip" title="I dislike this"><span class="pl-2">3</span></i>
                                    </span>
                                    
                                </span>    
                                <span class="pull-left">
                                    <button class="btn btn-link text-secondary view-replies"><span class="reply-display-text">View</span> 4 Replies</button>
                                </span>                            
                            </div>      
                        </div>
                        <div class="reply-input d-none">
                            <form class="reply-input-form" action="'.BASE_URL.'" method="POST">
                                <input type="hidden" name="action" value="forumReply">
                                <input type="hidden" name="replyToId" value="id">
                                <input type="hidden" name="replyToName" value="Ross C. Lopez">
                                <div class="html-editor pd-20 card-box mb-30">
                                    <h4>Reply to "<i class="reply-to"></i>"</h4>
                                    <hr>
                                    <textarea class="post-reply form-control border-radius-0" rows="4" name="reply" placeholder="Enter text ..."></textarea>
                                    
                                    <div class="pt-3 d-flex justify-content-end">
                                        <button class="btn btn-secondary mr-2 cancel-form-reply">CANCEL</button>
                                        <button class="btn btn-primary post-form-reply">POST</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="reply-content ml-5" style="display: none;">
                            <div class="pd-20 card-box mb-30">
                                <h4 class="">Reply to "<i>Ross C. Lopez</i>"</h4>
                                <hr>
                                <div class="clearfix mb-0">
                                    <div class="pull-left">
                                        <span class="d-block pb-2">
                                            <a class="" href="#">
                                                <span class="user-profile">
                                                    <img src="'.BASE_URL.'vendors/images/photo1.jpg" alt="">
                                                </span>
                                                <span class="text-blue h5">
                                                    Ross C. Lopez
                                                </span>

                                            </a>
                                        </span>
                                        <span class="ml-3 text-secondary">
                                            September 29, 2020
                                        </span>
                                    </div>
                                    <div class="pull-right text-secondary">
                                        <div class="btn-group dropleft">
                                            <i class="fa fa-ellipsis-v fa-lg text-dark" aria-hidden="true" data-toggle="dropdown"></i>
                                            <div class="dropdown-menu dropright" aria-haspopup="true" aria-expanded="false">
                                                <h6 class="dropdown-header">Actions</h6>
                                                <a href="#" class="btn btn-link dropdown-item">
                                                    <i class="fa fa-edit fa-lg"></i> Edit
                                                </a>
                                                <a href="#" class="btn btn-link dropdown-item text-danger">
                                                    <i class="fa fa-trash fa-lg"></i> Delete
                                                </a>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                                <div class="card-body">
                                    <p>
                                        Post Content here -Lorem Ipsum is simply dummy text of the printing and typesetting industry. 
                                        Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown 
                                        printer took a galley of type and scrambled it to make a type specimen book. It has survived not
                                        only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.
                                        It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently 
                                        with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum. 
                                    </p>
                                </div>
                                <div class="clearfix">
                                    <span class="pull-right">
                                        <button class="btn btn-link text-secondary mr-3">
                                            <i class="icon-copy fa fa-reply" aria-hidden="true"></i> Reply
                                        </button>
                                        <span class="mr-2">
                                            <i class="icon-copy fa fa-thumbs-o-up fa-lg" aria-hidden="true"  data-placement="top" data-toggle="tooltip" title="I like this"></i>33
                                            &nbsp;
                                            <i class="icon-copy fa fa-thumbs-o-down fa-lg" aria-hidden="true" data-placement="top" data-toggle="tooltip" title="I dislike this"></i>2
                                        </span>
                                        
                                    </span>    
                                </div>      
                            </div>
                            <div class="pd-20 card-box mb-30">
                                <h4 class="">Reply to "<i>Ross C. Lopez</i>"</h4>
                                <hr>
                                <div class="clearfix mb-0">
                                    <div class="pull-left">
                                        <span class="d-block pb-2">
                                            <a class="" href="#">
                                                <span class="user-profile">
                                                    <img src="'.BASE_URL.'vendors/images/photo1.jpg" alt="">
                                                </span>
                                                <span class="text-blue h5">
                                                    Ross C. Lopez
                                                </span>

                                            </a>
                                        </span>
                                        <span class="ml-3 text-secondary">
                                            September 29, 2020
                                        </span>
                                    </div>
                                    <div class="pull-right text-secondary">
                                        <div class="btn-group dropleft">
                                            <i class="fa fa-ellipsis-v fa-lg text-dark" aria-hidden="true" data-toggle="dropdown"></i>
                                            <div class="dropdown-menu dropright" aria-haspopup="true" aria-expanded="false">
                                                <h6 class="dropdown-header">Actions</h6>
                                                <a href="#" class="btn btn-link dropdown-item">
                                                    <i class="fa fa-edit fa-lg"></i> Edit
                                                </a>
                                                <a href="#" class="btn btn-link dropdown-item text-danger">
                                                    <i class="fa fa-trash fa-lg"></i> Delete
                                                </a>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                                <div class="card-body">
                                    <p>
                                        Post Content here -Lorem Ipsum is simply dummy text of the printing and typesetting industry. 
                                        Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown 
                                        printer took a galley of type and scrambled it to make a type specimen book. It has survived not
                                        only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.
                                        It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently 
                                        with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum. 
                                    </p>
                                </div>
                                <div class="clearfix">
                                    <span class="pull-right">
                                        <button class="btn btn-link text-secondary mr-3">
                                            <i class="icon-copy fa fa-reply" aria-hidden="true"></i> Reply
                                        </button>
                                        <span class="mr-2">
                                            <i class="icon-copy fa fa-thumbs-o-up fa-lg" aria-hidden="true"  data-placement="top" data-toggle="tooltip" title="I like this"></i>33
                                            &nbsp;
                                            <i class="icon-copy fa fa-thumbs-o-down fa-lg" aria-hidden="true" data-placement="top" data-toggle="tooltip" title="I dislike this"></i>2
                                        </span>
                                        
                                    </span>    
                                </div>      
                            </div>
                        </div> 
                    </span>
                    <span class="discussion">
                        <div class="pd-20 card-box mb-30">
                            <div class="clearfix mb-0">
                                <div class="dropleft">
                                    <i class="fa fa-ellipsis-v fa-lg float-right" aria-hidden="true" data-toggle="dropdown"></i>
                                    <div class="dropdown-menu dropright" aria-haspopup="true" aria-expanded="false">
                                        <h6 class="dropdown-header">Actions</h6>
                                        <a href="#" class="btn btn-link dropdown-item" data-toggle="modal" data-target="#edit-post-modal" data-backdrop="static" data-keyboard="false">
                                            <i class="fa fa-edit fa-lg"></i> Edit
                                        </a>
                                        <a href="#" class="btn btn-link dropdown-item text-danger" data-toggle="modal" data-target="#delete-post-modal">
                                            <i class="fa fa-trash fa-lg"></i> Delete
                                        </a>
                                    </div>
                                </div>

                                <div class="pull-left">
                                    <span class="d-block pb-2">
                                        <a class="" href="#">
                                            <span class="user-profile">
                                                <img src="'.BASE_URL.'vendors/images/photo1.jpg" alt="">
                                            </span>
                                            <span class="text-blue h5">
                                                Ross Lopenasonadasino
                                            </span>
                                        </a>
                                    </span>
                                    <span class="ml-3 text-secondary">
                                        September 29, 2020
                                    </span>
                                </div>
                                
                            </div>
                            <div class="container mb-3 mt-3">
                                <video controls crossorigin>
                                    <source src="'.BASE_URL.'videos/Samsung stong outside weak inside.mp4#t=0.1" type="video/mp4">
                                   
                                </video>
                                <!--<div data-type="youtube" data-video-id="dS7no_IEXgE"></div>-->
                            </div>
                            <div class="clearfix">
                                <span class="pull-right">
                                    <button class="btn btn-link text-secondary mr-2 reply-to-forum">
                                        <i class="icon-copy fa fa-reply" aria-hidden="true"></i> Reply
                                    </button>
                                    <span class="mr-2">
                                        <i class="icon-copy fa fa-thumbs-o-up fa-lg like pr-2" aria-hidden="true"  data-placement="top" data-toggle="tooltip" title="I like this"><span class="pl-2">33</span></i>
                                        <i class="icon-copy fa fa-thumbs-o-down fa-lg dislike" aria-hidden="true" data-placement="top" data-toggle="tooltip" title="I dislike this"><span class="pl-2">3</span></i>
                                    </span>
                                    
                                </span>    
                                <span class="pull-left">
                                    <button class="btn btn-link text-secondary view-replies"><span class="reply-display-text">View</span> 4 Replies</button>
                                </span>                            
                            </div>      
                        </div>
                        <div class="reply-input d-none">
                            <form class="reply-input-form" action="'.BASE_URL.'" method="POST">
                                <input type="hidden" name="action" value="forumReply">
                                <input type="hidden" name="replyToId" value="id">
                                <input type="hidden" name="replyToName" value="Ross C. Lopez">
                                <div class="html-editor pd-20 card-box mb-30">
                                    <h4>Reply to "<i class="reply-to"></i>"</h4>
                                    <hr>
                                    <textarea class="post-reply form-control border-radius-0" rows="4" name="reply" placeholder="Enter text ..."></textarea>
                                    
                                    <div class="pt-3 d-flex justify-content-end">
                                        <button class="btn btn-secondary mr-2 cancel-form-reply">CANCEL</button>
                                        <button class="btn btn-primary post-form-reply">POST</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="reply-content ml-5" style="display: none;">
                            <div class="pd-20 card-box mb-30">
                                <h4 class="">Reply to "<i>Ross C. Lopez</i>"</h4>
                                <hr>
                                <div class="clearfix mb-0">
                                    <div class="pull-left">
                                        <span class="d-block pb-2">
                                            <a class="" href="#">
                                                <span class="user-profile">
                                                    <img src="'.BASE_URL.'vendors/images/photo1.jpg" alt="">
                                                </span>
                                                <span class="text-blue h5">
                                                    Ross C. Lopez
                                                </span>

                                            </a>
                                        </span>
                                        <span class="ml-3 text-secondary">
                                            September 29, 2020
                                        </span>
                                    </div>
                                    <div class="pull-right text-secondary">
                                        <div class="btn-group dropleft">
                                            <i class="fa fa-ellipsis-v fa-lg text-dark" aria-hidden="true" data-toggle="dropdown"></i>
                                            <div class="dropdown-menu dropright" aria-haspopup="true" aria-expanded="false">
                                                <h6 class="dropdown-header">Actions</h6>
                                                <a href="#" class="btn btn-link dropdown-item">
                                                    <i class="fa fa-edit fa-lg"></i> Edit
                                                </a>
                                                <a href="#" class="btn btn-link dropdown-item text-danger">
                                                    <i class="fa fa-trash fa-lg"></i> Delete
                                                </a>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                                <div class="card-body">
                                    <p>
                                        Post Content here -Lorem Ipsum is simply dummy text of the printing and typesetting industry. 
                                        Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown 
                                        printer took a galley of type and scrambled it to make a type specimen book. It has survived not
                                        only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.
                                        It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently 
                                        with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum. 
                                    </p>
                                </div>
                                <div class="clearfix">
                                    <span class="pull-right">
                                        <button class="btn btn-link text-secondary mr-3">
                                            <i class="icon-copy fa fa-reply" aria-hidden="true"></i> Reply
                                        </button>
                                        <span class="mr-2">
                                            <i class="icon-copy fa fa-thumbs-o-up fa-lg" aria-hidden="true"  data-placement="top" data-toggle="tooltip" title="I like this"></i>33
                                            &nbsp;
                                            <i class="icon-copy fa fa-thumbs-o-down fa-lg" aria-hidden="true" data-placement="top" data-toggle="tooltip" title="I dislike this"></i>2
                                        </span>
                                        
                                    </span>    
                                </div>      
                            </div>
                            <div class="pd-20 card-box mb-30">
                                <h4 class="">Reply to "<i>Ross C. Lopez</i>"</h4>
                                <hr>
                                <div class="clearfix mb-0">
                                    <div class="pull-left">
                                        <span class="d-block pb-2">
                                            <a class="" href="#">
                                                <span class="user-profile">
                                                    <img src="'.BASE_URL.'vendors/images/photo1.jpg" alt="">
                                                </span>
                                                <span class="text-blue h5">
                                                    Ross C. Lopez
                                                </span>

                                            </a>
                                        </span>
                                        <span class="ml-3 text-secondary">
                                            September 29, 2020
                                        </span>
                                    </div>
                                    <div class="pull-right text-secondary">
                                        <div class="btn-group dropleft">
                                            <i class="fa fa-ellipsis-v fa-lg text-dark" aria-hidden="true" data-toggle="dropdown"></i>
                                            <div class="dropdown-menu dropright" aria-haspopup="true" aria-expanded="false">
                                                <h6 class="dropdown-header">Actions</h6>
                                                <a href="#" class="btn btn-link dropdown-item">
                                                    <i class="fa fa-edit fa-lg"></i> Edit
                                                </a>
                                                <a href="#" class="btn btn-link dropdown-item text-danger">
                                                    <i class="fa fa-trash fa-lg"></i> Delete
                                                </a>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                                <div class="card-body">
                                    <p>
                                        Post Content here -Lorem Ipsum is simply dummy text of the printing and typesetting industry. 
                                        Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown 
                                        printer took a galley of type and scrambled it to make a type specimen book. It has survived not
                                        only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.
                                        It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently 
                                        with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum. 
                                    </p>
                                </div>
                                <div class="clearfix">
                                    <span class="pull-right">
                                        <button class="btn btn-link text-secondary mr-3">
                                            <i class="icon-copy fa fa-reply" aria-hidden="true"></i> Reply
                                        </button>
                                        <span class="mr-2">
                                            <i class="icon-copy fa fa-thumbs-o-up fa-lg" aria-hidden="true"  data-placement="top" data-toggle="tooltip" title="I like this"></i>33
                                            &nbsp;
                                            <i class="icon-copy fa fa-thumbs-o-down fa-lg" aria-hidden="true" data-placement="top" data-toggle="tooltip" title="I dislike this"></i>2
                                        </span>
                                        
                                    </span>    
                                </div>      
                            </div>
                        </div> 
                    </span>
                  
                </div>
            </div>
        </div>
  
        ';

        return $html;
    }
    //Displays all the form topics available for a program
    public function forums($data = array()){

        $html = $this->preloader().'
        <div class="main-container">
            <div class="pd-ltr-20 xs-pd-20-10">
                <div class="min-height-200px">
                    <div class="page-header">
                        <div class="row">
                            <div class="col-md-6 col-sm-12">
                                <div class="title">
                                    <h3>Marketing Forum Topics</h3>
                                </div>
                                <nav aria-label="breadcrumb" role="navigation">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="'.BASE_URL.'index.php/?page=dashboard">Home</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Forums</li>
                                    </ol>
                                </nav>
                            </div>
                            <div class="col-md-6 col-sm-12 text-right pt-3">
                                <a class="btn btn-primary btn-sm" href="#" data-toggle="modal" data-target="#new-forum-topic-modal">
                                    <i class="icon-copy fa fa-plus" aria-hidden="true"></i> Add New Topic                       
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="pd-20 card shadow mb-30">
                        <div class="clearfix mb-0">
                        
                            <span class="dropleft">
                                <i class="fa fa-ellipsis-v fa-lg text-dark float-right" aria-hidden="true" data-toggle="dropdown"></i>
                                <div class="dropdown-menu dropright" aria-haspopup="true" aria-expanded="false">
                                    <h6 class="dropdown-header">Actions</h6>
                                    <a href="#" class="btn btn-link dropdown-item" data-toggle="modal" data-target="#edit-forum-topic-modal" data-backdrop="static" data-keyboard="false">
                                        <i class="fa fa-edit fa-lg"></i> Edit
                                    </a>
                                    <a href="#" class="btn btn-link dropdown-item text-danger" data-toggle="modal" data-target="#delete-form-topic-modal">
                                        <i class="fa fa-trash fa-lg"></i> Delete
                                    </a>
                                </div>
                            </span>
                        
                            <div class="pull-left">
                                <h4 class="h4">
                                    <a class="text-blue" href="'.BASE_URL.'index.php/?page=discussion">
                                        What is Lorem Ipsum Lorem Impsm?
                                    </a>
                                </h4>
                                <div class="text-secondary">September 29, 2020</div>
                            </div>
                            <div class="pull-right pt-md-4 mt-2">
                                <div class="d-flex justify-content-end">
                                </div>
                                <div class="d-flex justify-content-end text-secondary">
                                    <span data-placement="top" data-toggle="tooltip" title="Discussions" ><i class="fa fa-wechat fa-lg pr-2"></i>2</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="pd-20 card shadow mb-30">
                        <div class="clearfix mb-0">
                        
                            <span class="dropleft">
                                <i class="fa fa-ellipsis-v fa-lg text-dark float-right" aria-hidden="true" data-toggle="dropdown"></i>
                                <div class="dropdown-menu dropright" aria-haspopup="true" aria-expanded="false">
                                    <h6 class="dropdown-header">Actions</h6>
                                    <a href="#" class="btn btn-link dropdown-item" data-toggle="modal" data-target="#edit-discussion-modal" data-backdrop="static" data-keyboard="false">
                                        <i class="fa fa-edit fa-lg"></i> Edit
                                    </a>
                                    <a href="#" class="btn btn-link dropdown-item text-danger" data-toggle="modal" data-target="#delete-form-topic-modal">
                                        <i class="fa fa-trash fa-lg"></i> Delete
                                    </a>
                                </div>
                            </span>
                        
                            <div class="pull-left">
                                <h4 class="h4">
                                    <a class="text-blue" href="'.BASE_URL.'index.php/?page=discussion">
                                        What is Lorem Ipsum Lorem Impsm?
                                    </a>
                                </h4>
                                <div class="text-secondary">September 29, 2020</div>
                            </div>
                            <div class="pull-right pt-md-4 mt-2">
                                <div class="d-flex justify-content-end">
                                </div>
                                <div class="d-flex justify-content-end text-secondary">
                                    <span data-placement="top" data-toggle="tooltip" title="Discussions" ><i class="fa fa-wechat fa-lg pr-2"></i>2</span>
                                </div>
                            </div>
                        </div>
                    </div>                 
                    <div class="pd-20 card shadow mb-30">
                        <div class="clearfix mb-0">
                        
                            <span class="dropleft">
                                <i class="fa fa-ellipsis-v fa-lg text-dark float-right" aria-hidden="true" data-toggle="dropdown"></i>
                                <div class="dropdown-menu dropright" aria-haspopup="true" aria-expanded="false">
                                    <h6 class="dropdown-header">Actions</h6>
                                    <a href="#" class="btn btn-link dropdown-item" data-toggle="modal" data-target="#edit-discussion-modal" data-backdrop="static" data-keyboard="false">
                                        <i class="fa fa-edit fa-lg"></i> Edit
                                    </a>
                                    <a href="#" class="btn btn-link dropdown-item text-danger" data-toggle="modal" data-target="#delete-form-topic-modal">
                                        <i class="fa fa-trash fa-lg"></i> Delete
                                    </a>
                                </div>
                            </span>
                        
                            <div class="pull-left">
                                <h4 class="h4">
                                    <a class="text-blue" href="'.BASE_URL.'index.php/?page=discussion">
                                        What is Lorem Ipsum Lorem Impsm?
                                    </a>
                                </h4>
                                <div class="text-secondary">September 29, 2020</div>
                            </div>
                            <div class="pull-right pt-md-4 mt-2">
                                <div class="d-flex justify-content-end">
                                </div>
                                <div class="d-flex justify-content-end text-secondary">
                                    <span data-placement="top" data-toggle="tooltip" title="Discussions" ><i class="fa fa-wechat fa-lg pr-2"></i>2</span>
                                </div>
                            </div>
                        </div>
                    </div>                          
                </div>
            </div>
        </div>
        ';

        return $html;
    }
    //Displays all Discussions for a forum topic 
    public function discussion(){

        $html = $this->preloader().'
            <div class="main-container">
                <div class="pd-ltr-20 xs-pd-20-10">
                    <div class="min-height-200px">
                        <div class="page-header">
                            <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <div class="title pb-2">
                                        <h3>What is Lorem Ipsum?</h3>
                                    </div>
                                    <nav aria-label="breadcrumb" role="navigation">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="'.BASE_URL.'index.php/?page=dashboard">Home</a></li>
                                            <li class="breadcrumb-item"><a href="'.BASE_URL.'index.php/?page=forums&program=programName">Forums</a></li>
                                            <li class="breadcrumb-item active" aria-current="page">Discussions</li>
                                        </ol>
                                    </nav>
                                </div>
                                <div class="col-md-6 col-sm-12 text-right pb-md-4 pt-md-0 pt-3">
                                    <button class="btn btn-primary btn-sm" href="#" data-toggle="modal" data-target="#discussion-form-modal" data-backdrop="static" data-keyboard="false">
                                        <i class="icon-copy fa fa-plus" aria-hidden="true"></i> Add Discussion                       
                                    </button>
                                </div>
                            </div>
                        </div>

                        <span class="discussion">
                            <div class="pd-20 card-box mb-30">
                                <div class="clearfix mb-0">
                                    <div class="dropleft">
                                        <i class="fa fa-ellipsis-v fa-lg float-right" aria-hidden="true" data-toggle="dropdown"></i>
                                        <div class="dropdown-menu dropright" aria-haspopup="true" aria-expanded="false">
                                            <h6 class="dropdown-header">Actions</h6>
                                            <a href="#" class="btn btn-link dropdown-item" data-toggle="modal" data-target="#edit-discussion-modal" data-backdrop="static" data-keyboard="false">
                                                <i class="fa fa-edit fa-lg"></i> Edit
                                            </a>
                                            <a href="#" class="btn btn-link dropdown-item text-danger" data-toggle="modal" data-target="#delete-discuss-modal">
                                                <i class="fa fa-trash fa-lg"></i> Delete
                                            </a>
                                        </div>
                                    </div>

                                    <div class="pull-left">
                                        <span class="d-block pb-2">
                                            <a class="" href="#">
                                                <span class="user-profile">
                                                    <img src="'.BASE_URL.'vendors/images/photo1.jpg" alt="">
                                                </span>
                                                <span class="text-blue h5">
                                                    Ross Lopenasonadasino
                                                </span>

                                            </a>
                                        </span>
                                        <span class="ml-3 text-secondary">
                                            September 29, 2020
                                        </span>
                                    </div>
                                    
                                </div>
                                <div class="card-body">
                                    <p>
                                        Post Content here -Lorem Ipsum is simply dummy text of the printing and typesetting industry. 
                                        Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown 
                                        printer took a galley of type and scrambled it to make a type specimen book. It has survived not
                                        only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.
                                        It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently 
                                        with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum. 
                                    </p>
                                </div>
                                <div class="clearfix">
                                    <span class="pull-right">
                                        <button class="btn btn-link text-secondary mr-2 reply-to-forum">
                                            <i class="icon-copy fa fa-reply" aria-hidden="true"></i> Reply
                                        </button>
                                        
                                    </span>    
                                    <span class="pull-left">
                                        <button class="btn btn-link text-secondary view-replies"><span class="reply-display-text">View</span> 4 Replies</button>
                                    </span>                            
                                </div>      
                            </div>
                            <div class="reply-input d-none">
                                <form class="reply-input-form" action="'.BASE_URL.'" method="POST">
                                    <input type="hidden" name="action" value="forumReply">
                                    <input type="hidden" name="replyToId" value="id">
                                    <input type="hidden" name="replyToName" value="Ross C. Lopez">
                                    <div class="html-editor pd-20 card-box mb-30">
                                        <h4>Reply to "<i class="reply-to"></i>"</h4>
                                        <hr>
                                        <textarea class="discussion-reply form-control border-radius-0" name="reply" placeholder="Enter text ..."></textarea>
                                        
                                        <div class="pt-3 d-flex justify-content-end">
                                            <button class="btn btn-secondary mr-2 cancel-form-reply">CANCEL</button>
                                            <button class="btn btn-primary post-form-reply">POST</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="reply-content ml-5" style="display: none;">
                                <div class="pd-20 card-box mb-30">
                                    <h4 class="">Reply to "<i>Ross C. Lopez</i>"</h4>
                                    <hr>
                                    <div class="clearfix mb-0">
                                        <div class="pull-left">
                                            <span class="d-block pb-2">
                                                <a class="" href="#">
                                                    <span class="user-profile">
                                                        <img src="'.BASE_URL.'vendors/images/photo1.jpg" alt="">
                                                    </span>
                                                    <span class="text-blue h5">
                                                        Ross C. Lopez
                                                    </span>

                                                </a>
                                            </span>
                                            <span class="ml-3 text-secondary">
                                                September 29, 2020
                                            </span>
                                        </div>
                                        <div class="pull-right text-secondary">
                                            <div class="btn-group dropleft">
                                                <i class="fa fa-ellipsis-v fa-lg text-dark" aria-hidden="true" data-toggle="dropdown"></i>
                                                <div class="dropdown-menu dropright" aria-haspopup="true" aria-expanded="false">
                                                    <h6 class="dropdown-header">Actions</h6>
                                                    <a href="#" class="btn btn-link dropdown-item">
                                                        <i class="fa fa-edit fa-lg"></i> Edit
                                                    </a>
                                                    <a href="#" class="btn btn-link dropdown-item text-danger">
                                                        <i class="fa fa-trash fa-lg"></i> Delete
                                                    </a>
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <p>
                                            Post Content here -Lorem Ipsum is simply dummy text of the printing and typesetting industry. 
                                            Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown 
                                            printer took a galley of type and scrambled it to make a type specimen book. It has survived not
                                            only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.
                                            It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently 
                                            with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum. 
                                        </p>
                                    </div>
                                    <div class="clearfix">
                                        <span class="pull-right">
                                            <button class="btn btn-link text-secondary mr-1">
                                                <i class="icon-copy fa fa-reply" aria-hidden="true"></i> Reply
                                            </button>
                                        </span>    
                                    </div>      
                                </div>
                                <div class="pd-20 card-box mb-30">
                                    <h4 class="">Reply to "<i>Ross C. Lopez</i>"</h4>
                                    <hr>
                                    <div class="clearfix mb-0">
                                        <div class="pull-left">
                                            <span class="d-block pb-2">
                                                <a class="" href="#">
                                                    <span class="user-profile">
                                                        <img src="'.BASE_URL.'vendors/images/photo1.jpg" alt="">
                                                    </span>
                                                    <span class="text-blue h5">
                                                        Ross C. Lopez
                                                    </span>

                                                </a>
                                            </span>
                                            <span class="ml-3 text-secondary">
                                                September 29, 2020
                                            </span>
                                        </div>
                                        <div class="pull-right text-secondary">
                                            <div class="btn-group dropleft">
                                                <i class="fa fa-ellipsis-v fa-lg text-dark" aria-hidden="true" data-toggle="dropdown"></i>
                                                <div class="dropdown-menu dropright" aria-haspopup="true" aria-expanded="false">
                                                    <h6 class="dropdown-header">Actions</h6>
                                                    <a href="#" class="btn btn-link dropdown-item">
                                                        <i class="fa fa-edit fa-lg"></i> Edit
                                                    </a>
                                                    <a href="#" class="btn btn-link dropdown-item text-danger">
                                                        <i class="fa fa-trash fa-lg"></i> Delete
                                                    </a>
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <p>
                                            Post Content here -Lorem Ipsum is simply dummy text of the printing and typesetting industry. 
                                            Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown 
                                            printer took a galley of type and scrambled it to make a type specimen book. It has survived not
                                            only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.
                                            It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently 
                                            with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum. 
                                        </p>
                                    </div>
                                    <div class="clearfix">
                                        <span class="pull-right">
                                            <button class="btn btn-link text-secondary mr-1">
                                                <i class="icon-copy fa fa-reply" aria-hidden="true"></i> Reply
                                            </button>
                                            
                                        </span>    
                                    </div>      
                                </div>
                            </div> 
                        </span>    
                        <span class="discussion"> 
                            <div class="pd-20 card-box mb-30">
                                <div class="clearfix mb-0">
                                    <div class="pull-left">
                                        <span class="d-block pb-2">
                                            <a class="" href="#">
                                                <span class="user-profile">
                                                    <img src="'.BASE_URL.'vendors/images/photo1.jpg" alt="">
                                                </span>
                                                <span class="text-blue h5">Daniels C. Correa</span>
                                            </a>
                                        </span>
                                        <span class="ml-3 text-secondary">
                                            September 29, 2020
                                        </span>
                                    </div>
                                    <div class="pull-right text-secondary">
                                        <div class="btn-group dropleft">
                                            <i class="fa fa-ellipsis-v fa-lg text-dark" aria-hidden="true" data-toggle="dropdown"></i>
                                            <div class="dropdown-menu dropright" aria-haspopup="true" aria-expanded="false">
                                                <h6 class="dropdown-header">Actions</h6>
                                                <a href="#" class="btn btn-link dropdown-item">
                                                    <i class="fa fa-edit fa-lg"></i> Edit
                                                </a>
                                                <a href="#" class="btn btn-link dropdown-item text-danger">
                                                    <i class="fa fa-trash fa-lg"></i> Delete
                                                </a>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                                <div class="card-body">
                                    <p>
                                        Post Content here -Lorem Ipsum is simply dummy text of the printing and typesetting industry. 
                                        Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown 
                                        printer took a galley of type and scrambled it to make a type specimen book. It has survived not
                                        only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.
                                        It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently 
                                        with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum. 
                                    </p>
                                </div>
                                
                                <div class="clearfix">
                                    <span class="pull-right">
                                        <button class="btn btn-link text-secondary mr-1">
                                            <i class="icon-copy fa fa-reply" aria-hidden="true"></i> Reply
                                        </button>
                                        
                                    </span>    
                                    <span class="pull-left">
                                        <button class="btn btn-link text-secondary view-replies"><span class="reply-display-text">View</span> 4 Replies</button>
                                    </span>
                                    
                                </div>
                            </div>
                            <div class="reply-content ml-5" style="display: none;">
                                <div class="pd-20 card-box mb-30">
                                    <h4 class="">Reply to "<i>Ross C. Lopez</i>"</h4>
                                    <hr>
                                    <div class="clearfix mb-0">
                                        <div class="pull-left">
                                            <span class="d-block pb-2">
                                                <a class="" href="#">
                                                    <span class="user-profile">
                                                        <img src="'.BASE_URL.'vendors/images/photo1.jpg" alt="">
                                                    </span>
                                                    <span class="text-blue h5">
                                                        Ross C. Lopez
                                                    </span>

                                                </a>
                                            </span>
                                            <span class="ml-3 text-secondary">
                                                September 29, 2020
                                            </span>
                                        </div>
                                        <div class="pull-right text-secondary">
                                            <div class="btn-group dropleft">
                                                <i class="fa fa-ellipsis-v fa-lg text-dark" aria-hidden="true" data-toggle="dropdown"></i>
                                                <div class="dropdown-menu dropright" aria-haspopup="true" aria-expanded="false">
                                                    <h6 class="dropdown-header">Actions</h6>
                                                    <a href="#" class="btn btn-link dropdown-item">
                                                        <i class="fa fa-edit fa-lg"></i> Edit
                                                    </a>
                                                    <a href="#" class="btn btn-link dropdown-item text-danger">
                                                        <i class="fa fa-trash fa-lg"></i> Delete
                                                    </a>
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <p>
                                            Post Content here -Lorem Ipsum is simply dummy text of the printing and typesetting industry. 
                                            Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown 
                                            printer took a galley of type and scrambled it to make a type specimen book. It has survived not
                                            only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.
                                            It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently 
                                            with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum. 
                                        </p>
                                    </div>
                                    <div class="clearfix">
                                        <span class="pull-right">
                                            <button class="btn btn-link text-secondary mr-1">
                                                <i class="icon-copy fa fa-reply" aria-hidden="true"></i> Reply
                                            </button>
                                            
                                        </span>    
                                    </div>      
                                </div>
                                <div class="pd-20 card-box mb-30">
                                    <h4 class="">Reply to "<i>Ross C. Lopez</i>"</h4>
                                    <hr>
                                    <div class="clearfix mb-0">
                                        <div class="pull-left">
                                            <span class="d-block pb-2">
                                                <a class="" href="#">
                                                    <span class="user-profile">
                                                        <img src="'.BASE_URL.'vendors/images/photo1.jpg" alt="">
                                                    </span>
                                                    <span class="text-blue h5">
                                                        Ross C. Lopez
                                                    </span>

                                                </a>
                                            </span>
                                            <span class="ml-3 text-secondary">
                                                September 29, 2020
                                            </span>
                                        </div>
                                        <div class="pull-right text-secondary">
                                            <div class="btn-group dropleft">
                                                <i class="fa fa-ellipsis-v fa-lg text-dark" aria-hidden="true" data-toggle="dropdown"></i>
                                                <div class="dropdown-menu dropright" aria-haspopup="true" aria-expanded="false">
                                                    <h6 class="dropdown-header">Actions</h6>
                                                    <a href="#" class="btn btn-link dropdown-item">
                                                        <i class="fa fa-edit fa-lg"></i> Edit
                                                    </a>
                                                    <a href="#" class="btn btn-link dropdown-item text-danger">
                                                        <i class="fa fa-trash fa-lg"></i> Delete
                                                    </a>
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <p>
                                            Post Content here -Lorem Ipsum is simply dummy text of the printing and typesetting industry. 
                                            Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown 
                                            printer took a galley of type and scrambled it to make a type specimen book. It has survived not
                                            only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.
                                            It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently 
                                            with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum. 
                                        </p>
                                    </div>
                                    <div class="clearfix">
                                        <span class="pull-right">
                                            <button class="btn btn-link text-secondary mr-1">
                                                <i class="icon-copy fa fa-reply" aria-hidden="true"></i> Reply
                                            </button>
                                        </span>    
                                    </div>      
                                </div>
                            </div>
                        </span>

                    </div>
                </div>
            </div>
        ';

        return $html;

    }
    //contains all the JS scripts and ending html and body tag
    public function portalFooter(){
        $html = '
            <div class="footer-wrap mt-auto mb-3">
				FEP - By <a href="https://www.belizeinvest.org.bz/" target="_blank">BELTRAIDE</a> '.date('Y').'
            </div>

            <!-- MODAL DECLARATION START -->


            <!-- Modal for editing a discussion post -->
            <div class="modal fade" id="edit-discussion-modal" tabindex="-1" role="dialog" aria-labelledby="edit-discussion-modal" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="disscussion-modal-title">Edit Discussion</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="'.BASE_URL.'" method="POST">
                                <input type="hidden" name="action" value="editDiscussion">
                                <div class="html-editor">
                                    <h4 class="h4 text-blue">Make sure to stick to the forum topic.</h4>
                                    <textarea class="discussion-edit form-control border-radius-0" placeholder="Enter text ...">Post Content here -Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</textarea>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">CANCEL</button>
                            <button type="button" class="btn btn-success btn-sm">UPDATE</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal for Posting to a program feed -->
            <div class="modal fade" id="add-post-modal" tabindex="-1" role="dialog" aria-labelledby="edit-discussion-modal" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="text-blue">Post to Feed</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            
                            <div class="tab">
                                <ul class="nav nav-tabs customtab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="tab" href="#post-text" role="tab" aria-selected="true">Text</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#post-upload" role="tab" aria-selected="true">Upload</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#post-video" role="tab" aria-selected="false">Youtube Video Link</a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane fade show active" id="post-text" role="tabpanel">
                                        <div class="pd-20">

                                            <form action="'.BASE_URL.'" method="post">
                                                <input type="hidden" name="action" value="textPost">
                                                
                                                <!--<div class="form-group">
                                                    <label>Title</label>
                                                    <input class="form-control" type="text" placeholder="">
                                                </div>-->
                                                <div class="form-group">
                                                    <label>Have anything to say relevant to the program?</label>
                                                    <textarea class="form-control"></textarea>
                                                </div>
                                                <div class="d-flex justify-content-end">
                                                    <button type="button" class="btn btn-secondary btn-sm mr-2" data-dismiss="modal">CANCEL</button>
                                                    <button type="button" class="btn btn-primary btn-sm">POST</button>
                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                    <div class="tab-pane fade show" id="post-upload" role="tabpanel">
                                        <div class="pd-20">
                                            <form action="'.BASE_URL.'" method="post">
                                                <input type="hidden" name="action" value="videoUpload">
                                                <div class="form-group">
                                                    <label>Upload a MP4 Video</label>
                                                    <input type="file" class="form-control-file form-control height-auto" accept="video/mp4" required>
                                                </div>
                                                
                                                <div class="form-group">
                                                    <label>Description</label>
                                                    <textarea name="videoDescription" class="form-control" required></textarea>
                                                </div>
                                                <div class="d-flex justify-content-end">
                                                    <button type="button" class="btn btn-secondary btn-sm mr-2" data-dismiss="modal">CANCEL</button>
                                                    <button type="button" class="btn btn-primary btn-sm">POST</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="post-video" role="tabpanel">
                                        <div class="pd-20">
                                            <form action="'.BASE_URL.'" method="post">
                                                <input type="hidden" name="action" value="videoPost">
                                                <div class="form-group row">
                                                    <label class="col-sm-12 col-md-12 col-form-label">URL</label>
                                                    <div class="col-sm-12 col-md-12">
                                                        <input class="form-control" name="ytLink" placeholder="https://www.youtube.com/watch?v=dS7no_IEXgE" type="url">
                                                    </div>
                                                </div>
                                                <div class="d-flex justify-content-end">
                                                    <button type="button" class="btn btn-secondary btn-sm mr-2" data-dismiss="modal">CANCEL</button>
                                                    <button type="button" class="btn btn-primary btn-sm">POST VIDEO</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal for requesting to add a course to your list-->
            <div class="modal fade" id="add-course-modal" tabindex="-1" role="dialog" aria-labelledby="eadd-course-modal" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="text-blue">Course Mentoring Request</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="'.BASE_URL.'" method="POST">
                                <div class="row">
                                    <div class="col-12 col-md-12">
                                                                
                                        <div class="form-group">
                                            <label>Choose a Course you want to Mentor</label>
                                            <select class="selectpicker form-control form-control-lg" name="district" title="Not Chosen">
                                                <option>Programming</option>
                                                <option>Maths</option>
                                                <option>Physics</option>
                                                <option>Marketing</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-12">
                                        <div class="form-group">
                                            <label>What qualifications do you have to teach this course?</label>
                                            <textarea class="form-control"></textarea>
                                        </div>
                                    
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">CANCEL</button>
                            <button type="button" id="add-course" class="btn btn-primary btn-sm">REQUEST</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal for adding a course to the system **only admins should have access to this modal **  NOT BEING USED -->
            <div class="modal fade" id="add-course-to-system-modal" tabindex="-1" role="dialog" aria-labelledby="eadd-course-modal" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="text-blue">Add a New Course</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="'.BASE_URL.'" method="POST">
                                <input type="hidden" name="action" value="addNewCourse">
                                <div class="row">
                                    <div class="col-12 col-md-12"> 
                                        <div class="form-group">
                                            <label for="recipient-name" class="col-form-label">Course Name:</label>
                                            <input type="text" name="courseName" class="form-control">
                                        </div>
                                    </div>                                                               
                                    <div class="col-12 col-md-12">                                                                
                                        <div class="form-group">
                                            <label>Choose a Course you want to Mentor</label>
                                            <select class="selectpicker form-control form-control-lg" name="district" title="Not Chosen">
                                                <option>Admin 1</option>
                                                <option>Admin 2</option>
                                                <option>Admin 3</option>
                                                <option>Admin 4</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-12">
                                        <div class="form-group">
                                            <label>What qualifications do you have to teach this course?</label>
                                            <textarea class="form-control"></textarea>
                                        </div>
                                    
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">CANCEL</button>
                            <button type="button" id="add-course" class="btn btn-primary btn-sm">REQUEST</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal for suggesting a course to be added for mentorship in the system -->
            <div class="modal fade" id="request-course-addition-modal" tabindex="-1" role="dialog" aria-labelledby="eadd-course-modal" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="text-blue">Suggest a Course we should add</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="'.BASE_URL.'" method="POST">
                                <div class="row">
                                    <div class="col-12 col-md-12">
                                                                
                                        <div class="form-group">
                                            <label for="recipient-name" class="col-form-label">Course Name:</label>
                                            <input type="text" name="forumTitle" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-12">
                                        <div class="form-group">
                                            <label>Why should we add this course? and what are your qualifications to teach it?</label>
                                            <textarea class="form-control"></textarea>
                                        </div>
                                    
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">CANCEL</button>
                            <button type="button" id="request-course" class="btn btn-primary btn-sm">SEND</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal for Editing post to a program feed -->
            <div class="modal fade" id="edit-post-modal" tabindex="-1" role="dialog" aria-labelledby="edit-discussion-modal" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="text-blue">Edit Post</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            
                            <div class="tab">
                                <ul class="nav nav-tabs customtab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="tab" href="#edit-post-text" role="tab" aria-selected="true">Text</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#edit-post-upload" role="tab" aria-selected="false">Upload</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#edit-post-video" role="tab" aria-selected="false">Video</a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane fade show active" id="edit-post-text" role="tabpanel">
                                        <div class="pd-20">

                                            <form action="'.BASE_URL.'" method="post">
                                                <input type="hidden" name="action" value="updateTextPost">
                                                <input type="hidden" name="postId" value="">
                                                
                                                <div class="form-group">
                                                    <label>Have anything to say relevant to the program?</label>
                                                    <textarea class="form-control"></textarea>
                                                </div>
                                                <div class="d-flex justify-content-end">
                                                    <button type="button" class="btn btn-secondary btn-sm mr-2" data-dismiss="modal">CANCEL</button>
                                                    <button type="button" class="btn btn-primary btn-sm">POST</button>
                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                    <div class="tab-pane fade show" id="edit-post-upload" role="tabpanel">
                                        <div class="pd-20">
                                            <form action="'.BASE_URL.'" method="post">
                                                <input type="hidden" name="action" value="videoUpload">
                                                <div class="form-group">
                                                    <label>Upload a MP4 Video</label>
                                                    <input type="file" class="form-control-file form-control height-auto" accept="video/mp4" required>
                                                </div>
                                                
                                                <div class="form-group">
                                                    <label>Description</label>
                                                    <textarea name="videoDescription" class="form-control" required></textarea>
                                                </div>
                                                <div class="d-flex justify-content-end">
                                                    <button type="button" class="btn btn-secondary btn-sm mr-2" data-dismiss="modal">CANCEL</button>
                                                    <button type="button" class="btn btn-primary btn-sm">POST</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="edit-post-video" role="tabpanel">
                                        <div class="pd-20">
                                            <form action="'.BASE_URL.'" method="post">
                                                <input type="hidden" name="action" value="editVideoPost">
                                                <input type="hidden" name="postId" value="">

                                                <div class="form-group row">
                                                    <label class="col-sm-12 col-md-12 col-form-label">URL</label>
                                                    <div class="col-sm-12 col-md-12">
                                                        <input class="form-control" name="ytLink" placeholder="https://www.youtube.com/watch?v=dS7no_IEXgE" type="url">
                                                        
                                                    </div>
                                                </div>
                                                <div class="d-flex justify-content-end">
                                                    <button type="button" class="btn btn-secondary btn-sm mr-2" data-dismiss="modal">CANCEL</button>
                                                    <button type="button" class="btn btn-primary btn-sm">POST VIDEO</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal for adding a discussion to forum topic -->
            <div class="modal fade" id="discussion-form-modal" tabindex="-1" role="dialog" aria-labelledby="discussion-form-modal" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="disscussion-modal-title">New Discussion</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="'.BASE_URL.'" method="POST">
                                <div class="html-editor">
                                    <h4 class="h4 text-blue">Make sure to stick to the forum topic.</h4>
                                    <textarea class="new-discussion form-control border-radius-0" placeholder="Enter text ..."></textarea>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">CANCEL</button>
                            <button type="button" class="btn btn-primary btn-sm">POST</button>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Modal for adding a forum topic -->
            <div class="modal fade" id="new-forum-topic-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">New Forum Topic</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form>
                                <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Topic:</label>
                                <input type="text" name="forumTitle" class="form-control">
                                </div>
                                <div class="form-group">
                                <label for="message-text" class="col-form-label">Description:</label>
                                <textarea class="form-control" name="forumDescription"></textarea>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">CANCEL</button>
                            <button type="button" class="btn btn-primary">POST</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal for editing a forum topic -->
            <div class="modal fade" id="edit-forum-topic-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit Forum Topic</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="'.BASE_URL.'">
                                <input type="hidden" name="action" value="updateFormTopic">
                                <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Topic:</label>
                                <input type="text" name="forumTitle" class="form-control" value="What is Lorem Ipsum Lorem Impsm?">
                                </div>
                                <div class="form-group">
                                <label for="message-text" class="col-form-label">Description:</label>
                                <textarea class="form-control" name="forumDescription">Something about the topic</textarea>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">CANCEL</button>
                            <button type="button" class="btn btn-success">UPDATE</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- MODAL DECLARATION END -->



            <!-- START OF MODAL FOR DELETE ALERT -->
            
            <!-- modal for forum topic removal -->
            <div class="modal fade" id="delete-form-topic-modal" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="delete-forum-topic">Delete Forum Topic</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            Are you sure you want to permanetly delete this forum topic?
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-danger btn-sm">DELETE</button>
                        </div>
                    </div>
                </div>
            </div> 

            <!-- Modal For Post removal -->
            <div class="modal fade" id="delete-post-modal" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="delete-post-title">Delete Post</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            Are you sure you want to permanetly delete this post?
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-danger btn-sm">DELETE</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal For Discussion removal -->
            <div class="modal fade" id="delete-discuss-modal" tabindex="-1" role="dialog" aria-labelledby="delete-discussion-modal" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="delete-discussion-title">Delete Discussion</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            Are you sure you want to permanetly delete this discussion?
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-danger btn-sm">DELETE</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal For Course Removal -->
            <div class="modal fade" id="remove-course-modal" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="remove-course-modal">Remove Course</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            Are you sure you want to permanetly REMOVE this Course?
                        </div>
                        <div class="modal-footer">  
                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-danger btn-sm">DELETE</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- END OF MODAL FOR DELETE ALERT -->

            
            <!-- START OF MODAL FOR SUCCESS ALERT-->
            
            <!-- Succcess Modal-->
            <div class="modal fade" id="success-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-body text-center font-18">
                            <h3 class="mb-20">Success!</h3>
                            <div class="mb-30 text-center"><img src="'.BASE_URL.'vendors/images/success.png"></div>
                            Your request has been sent!
                        </div>
                        <div class="modal-footer justify-content-center">
                            <button type="button" class="btn btn-primary" data-dismiss="modal">Done</button>
                        </div>
                    </div>
                </div>
            </div>                 

            <!-- Succcess Modal for Mentorship Request-->
            <div class="modal fade" id="mentorship-request-success-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-body text-center font-18">
                            <h3 class="mb-20">Success!</h3>
                            <div class="mb-30 text-center"><img src="'.BASE_URL.'vendors/images/success.png"></div>
                            Your request has been sent!
                        </div>
                        <div class="modal-footer justify-content-center">
                            <button type="button" class="btn btn-primary" data-dismiss="modal">Done</button>
                        </div>
                    </div>
                </div>
            </div>                 
                   

            <!-- END OF MODAL FOR SUCCESS ALERT -->



            <!-- js -->
            <script src="'.BASE_URL.'vendors/scripts/core.js"></script>
            <script src="'.BASE_URL.'vendors/scripts/script.js"></script>
            <script src="'.BASE_URL.'vendors/scripts/process.js"></script>
            <script src="'.BASE_URL.'vendors/scripts/layout-settings.js"></script>
            
            <!-- Video Players js files -->
            <script src="'.BASE_URL.'src/plugins/plyr/dist/plyr.js"></script>
            <script src="https://cdn.shr.one/1.0.1/shr.js"></script>
        
            
            <!-- Datatables JS files -->        
            <script src="'.BASE_URL.'src/plugins/datatables/js/jquery.dataTables.min.js"></script>
            <script src="'.BASE_URL.'src/plugins/datatables/js/dataTables.bootstrap4.min.js"></script>
            <script src="'.BASE_URL.'src/plugins/datatables/js/dataTables.responsive.min.js"></script>
            <script src="'.BASE_URL.'src/plugins/datatables/js/responsive.bootstrap4.min.js"></script>
            
            <!-- buttons for Export datatable -->
            <script src="'.BASE_URL.'src/plugins/datatables/js/dataTables.buttons.min.js"></script>
            <script src="'.BASE_URL.'src/plugins/datatables/js/buttons.bootstrap4.min.js"></script>
            <script src="'.BASE_URL.'src/plugins/datatables/js/buttons.print.min.js"></script>
            <script src="'.BASE_URL.'src/plugins/datatables/js/buttons.html5.min.js"></script>
            <script src="'.BASE_URL.'src/plugins/datatables/js/buttons.flash.min.js"></script>
            <script src="'.BASE_URL.'src/plugins/datatables/js/pdfmake.min.js"></script>
            <script src="'.BASE_URL.'src/plugins/datatables/js/vfs_fonts.js"></script>
            
            <!-- Script for Autocomplete-->
            <!--<script src="https://code.jquery.com/jquery-1.12.4.js"></script>-->
            <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
            
            <!-- bootpag pagination plugin-->
            <script src="'.BASE_URL.'/js/jquery.bootpag.min.js"></script>
            

            <!-- Datatable Setting js -->
            <script src="'.BASE_URL.'vendors/scripts/datatable-setting.js"></script></body>
            
            <script src="'.BASE_URL.'src/plugins/apexcharts/apexcharts.min.js"></script>

            <!-- Full calendar js -->
            <script src="'.BASE_URL.'src/plugins/fullcalendar/fullcalendar.min.js"></script>
            <script src="'.BASE_URL.'vendors/scripts/calendar-setting.js"></script>
       
            <script src="'.BASE_URL.'vendors/scripts/dashboard.js"></script>

            <!-- jQuery file for forums discussion -->
            <script src="'.BASE_URL.'js/jqueryDiscussion.js"></script>
            
            <!-- jQuery custom script -->
            <script src="'.BASE_URL.'js/customScript.js"></script>
            
            <!-- Custome jQuery for bootpag pagination plugin-->
            <script src="'.BASE_URL.'assets/js/jQueryForUI.js"></script>

            <!-- Custome jQuery for bootpag pagination plugin-->
            <script src="'.BASE_URL.'assets/js/pagination.js"></script>

            <script>
                //ignoring form resubmission alert
                // if ( window.history.replaceState ) {
                //     window.history.replaceState( null, null, window.location.href );
                // }
                plyr.setup({
                    tooltips: {
                        controls: !0
                    },
                });
            </script>

            </body>
            </html>
        ';

        return $html;

    }
    /***************************************************************************************
        Functions below are seperated html content that can be used to create content dynamically
        The functions listed below should only be used on the Portal/ Backend
    ****************************************************************************************/
    
    //Builds the simple course cards that go on the dashboard for informational purposes
    //@param1 the id of the course
    //@param2 the name of the course
    //@param3 the icon for the course
    //@param4 the total amount of mentees in the course
    //@return the contructed html start rating or an empty string if rating is zero 
    public function create_basic_course_card($data = []){


        $html = '
            <div class="col-xl-3 mb-30">
                <a href="'.BASE_URL.'index.php/?page=programContent&programId='.$courseId.'">
                    <div class="card-box height-100-p widget-style1 shadow-lg">
                        <div class="d-flex flex-wrap align-items-center">
                            <div class="progress-data text-center">
                                <!--<div id="chart"></div>-->
                                <!--<i class="icon-copy dw dw-suitcase h1"></i>-->
                                <i class="'.($data['coures_icon'] ?? '').' h1"></i>
                            </div>
                            <div class="widget-data">
                                <div class="h4 mb-0" data-toggle="tooltip" data-placement="top" title="Mentee total"><i class="fa fa-user"></i> '.($data['mentee_total'] ?? 'N/a').'</div>
                                <div class="weight-600 font-14">'.($data['coures_name'] ?? 'N/a').'</div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>  
        ';
    }

    //creates a card for the section in add course
    public function create_course_outline_topic_card($data = [], $key = 0){
        $html = '
            <div class="pd-20 mt-2 card-box shadow border rounded-0 course-outline-card" data-card-count="'.$key.'">
                <div class="row">
                    <div class="col-8">
                        <h4 class="text-blue h5">Section</h4>
                    </div>
                    <div class="col-4 d-flex justify-content-end">
                        <a href="'.BASE_URL.'index.php/?page=deleteCourseOutline&courseOutlineId='.(encrypt($data['course_outline_id'] ?? '')).'" class="btn btn-light btn-sm remove-topic"><i class="fa fa-trash fa-lg text-danger"></i></a>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="form-group col-12 col-md-12">
                        <label>Title</label>
                        <input class="form-control" name="outline['.$key.'][title]" placeholder="e.g. Introduction...." value="'.($data['title'] ?? '').'"  type="text" required>
                    </div>
                </div>
                <span class="topic-content-container">
                    <div class="row content-list">
                        <div class="form-group col-12 col-md-12 mb-0">
                            <label>Content </label>
                            <div class="input-group">
                                <textarea class="form-control" name="outline['.$key.'][content]['.$key.']" placeholder="This course wil help you understand...." style="height: 110px;" required>'.($data['summary'] ?? '').'</textarea>
                                <div class="input-group-append">
                                    <button href="'.BASE_URL.'index.php/?page=removeTopicContent&contentId='.(encrypt($data['content_id'] ?? '#')).'" class="btn btn-danger remove-content" type="">
                                        <i class="fa fa-trash fa-lg text-white">                
                                    </i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="d-flex justify-content-center mb-4">
                        <a href="#" class="more-topic-content" class="btn btn-link text-primary btn-sm"><i class="fa fa-plus fa-lg m-auto"></i> Add More Content</a>
                    </div>
                </span>
                
            </div> 
        ';

        return $html;
    }
  
    //creates a mentor card for 
    public function create_mentor_card($data = []){

        $rating = $data['rating'] ?? 0;

        $starRating = $this->create_start_rating($rating);

        $html = '
            <div class="col-lg-4 col-md-4 col-12 d-flex align-items-stretch">
                <div class="da-card">
                    <div class="da-card-photo">
                        <img src="'.BASE_URL.'vendors/images/photo1.jpg" alt="">
                        <div class="da-overlay da-slide-top">
                            <div class="da-social">
                                <ul class="clearfix">
                                    <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                    <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                    <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="da-card-content text-center">
                        <h5 class="h5 mb-0"><a href="'.BASE_URL.'index.php/?page=mentorProfile">Don H. Rabon</a></h5>
                        <p class="mb-0">Marketing</p>
                        '.$starRating.'
                        <span>
                            <a href="#" class="btn btn-success btn-sm"><i class="fa fa-paper-plane-o"></i> Request Mentorship</a>
                        </span>
                    </div>
                </div>
            </div>
                        
        ';

        return $html;

    } 

    public function create_course_card($data = []){

        $rating = $data['rating'] ?? 0;
        $starRating = $this->create_start_rating($rating, 'justify-content-start align-items-center');

        $html = '
        
            <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-2">
                <div class="card shadow">
                    <a href="'.BASE_URL.'index.php/?page=programDetails">
                        <img src="'.($data['course_img'] ?? BASE_URL.'assets/img/course-1.jpg').'" class="img-fluid" alt="...">
                    </a>
                    <div class="card-body">
                        <h5 class="mb-1"><a href="'.BASE_URL.'index.php/?page=programDetails">'.($data['course_name']??'N/a').'</a></h5>
                        
                        '.$starRating.'                

                        <p class="">'.$data['course_about'].'</p>
                        <!--<span class="d-flex justify-content-end">
                            <a href="'.BASE_URL.'index.php/?page=" class="btn btn-success btn-sm"><i class="fa fa-paper-plane-o "></i> Request Mentorship</a>
                        </span>-->
                    
                    </div>
                </div>
            </div> <!-- End Course Item-->
        
        ';

        return $html;
    }

    /***************************************************************************************
        Functions below can be used for Public and the  Portal/ Backend
    ****************************************************************************************/

    //Makes a text shorter by specific amount of characters

    //@param1 the text to make shorter
    //@param2  make text shorter by number of characters
    //@param3 what to append to the string afte the end of string
    //@returns the text sumary
    public function make_text_shorter($text = '', $charSize = 150, $stringEnd = '.......'){

        if($text != ''){

            //making summary
            if (strlen($text) > $charSize){
                $maxLength = $charSize;
                $text = substr($text, 0, $maxLength);
                $text .= $stringEnd;
            }
        }
        return $text;
    }
    //Builds the start rating for the specified rating amount
    //@param the rating amount from 1 - 5
    //@param style classes for startrating
    //@return the contructed html start rating or an empty string if rating is zero 
    public function create_start_rating($rating = 0, $classes = ''){

        $starRating = '';
        $rating = sprintf("%.1f", $rating);

        if($rating != 0){

            for($num = 1; $num <= 5; $num++){
                
                if($num <= $rating){
                    $starRating .= '
                        <span class=""><i class="text-warning fa fa-star fa-lg"></i></span>
                    ';
                }else{
                    $starRating .= '
                        <span class=""><i class="text-warning fa fa-star-o fa-lg"></i></span>
                    ';

                }
            }
            $starRating = '
                <span class="d-flex justify-content-center '.$classes.'" data-toggle="tooltip" data-placement="top" title="'.$rating.'" >
                    '.$starRating.'
                </span>
            ';
        }
        return $starRating;
    }
}
?>