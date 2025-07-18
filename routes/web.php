<?php

use App\Http\Controllers\Academics\VerticalController;
use App\Http\Controllers\authentications\LoginController;
use App\Http\Controllers\authentications\SocialiteController;
use App\Http\Controllers\authentications\VerifyOTPController;
use App\Http\Controllers\BlogCommentController;
use App\Http\Controllers\Website\CareerController;
use App\Http\Controllers\Website\CareerTestimonialController;
use App\Http\Controllers\Leads\LeadController;
use App\Http\Controllers\Panel\Dashboard\CRMController;
use App\Http\Controllers\Website\FooterController;
use App\Http\Controllers\Website\HeaderController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Website\HomePageController;
use App\Http\Controllers\Website\AboutUsController;
use App\Http\Controllers\Website\BecomeAPertnerController;
use App\Http\Controllers\Website\BlogController;
use App\Http\Controllers\Website\ComponentController;
use App\Http\Controllers\Website\ContactUsController;
use App\Http\Controllers\Website\CoursesController;
use App\Http\Controllers\Website\DepartmentController;
use App\Http\Controllers\Website\InstitutionsAndBoardsController;
use App\Http\Controllers\Website\ProgramTypeController;
use App\Http\Controllers\Website\WhySwayamVidyaController;
use App\Http\Controllers\Panel\Dashboard\LMSController;
use App\Http\Controllers\Settings\Components\RegionController;
use App\Http\Controllers\Student\StudentLoginController;
use App\Http\Controllers\Website\HelpCenterController;
use App\Http\Controllers\Website\HelpCenterFeatureController;
use App\Http\Controllers\Website\SpecializationController;

Route::middleware('guest')->group(function () {
  Route::get('/login', [LoginController::class, 'create'])->name('login');
  Route::post('/login', [LoginController::class, 'store'])->name('login');

  Route::get('/auth/redirect/google', [SocialiteController::class, 'redirectToGoogle'])->name('google.redirect');
  Route::get('/auth/callback/google', [SocialiteController::class, 'handleGoogleCallback'])->name('google.callback');

  Route::get('/student/sign-up', [StudentLoginController::class, 'signUp'])->name('student.sign-up');
  Route::post('/student/sign-up/{step}', [StudentLoginController::class, 'signUpSteps']);
  Route::get('/student/login', [StudentLoginController::class, 'create'])->name('student.login');
  Route::post('/student/login', [StudentLoginController::class, 'store'])->name('student.login');
  Route::post('/verify-login-otp', [StudentLoginController::class, 'verify_otp'])->name('verify-login-otp');

  // Forgot Password
  Route::get('/student/login/forgot-password', [StudentLoginController::class, 'forgotPassword'])->name('student.password.forgot');
  Route::post('/student/login/forgot-password/{step}', [StudentLoginController::class, 'forgotPasswordSteps']);
  Route::post('/student/login/forgot-password', [StudentLoginController::class, 'forgotPasswordFindEmail'])->name('student.password.forgot');
  Route::post('/student/login/forgot-password/otp/send', [StudentLoginController::class, 'forgotPasswordSendOTP'])->name('student.password.forgot.sendOtp');
  Route::post('/student/login/forgot-password/otp/verify', [StudentLoginController::class, 'forgotPasswordVerifyOTP'])->name('student.password.forgot.verifyOtp');
  Route::post('/student/login/forgot-password/change/password', [StudentLoginController::class, 'forgotPasswordChangePassword'])->name('student.password.forgot.changePassword');
});

Route::get('/', [HomePageController::class, 'index'])->name('home');
Route::get('/institutions-and-boards', [InstitutionsAndBoardsController::class, 'index'])->name('institutions-and-boards');
Route::get('/institutions-and-boards/{slug}', [InstitutionsAndBoardsController::class, 'view']);

Route::get('/courses', [CoursesController::class, 'index'])->name('courses');
Route::get('/skill-courses', [CoursesController::class, 'skillPrograms'])->name('skill-programs');
Route::get('/skill-courses/{slug}', [CoursesController::class, 'skillProgramsView']);
Route::get('/courses/{slug}', [CoursesController::class, 'view']);
Route::get('/courses/know-your-university/{slug}', [CoursesController::class, 'knowYourUniversity']);
Route::get('/specialization/{slug}', [SpecializationController::class, 'view']);
Route::get('/program-types/{slug}', [ProgramTypeController::class, 'view']);
Route::get('/departments/{slug}', [DepartmentController::class, 'view']);
Route::get('/why-swayam-vidya', [WhySwayamVidyaController::class, 'index'])->name('why-swayam-vidya');
Route::get('/about-us', [AboutUsController::class, 'index'])->name('about-us');
Route::get('/blogs', [BlogController::class, 'frontIndex'])->name('blogs');
Route::get('/blogs/{slug}', [BlogController::class, 'view'])->name('blog_details');
Route::get('/contact-us', [ContactUsController::class, 'index'])->name('contact-us');
Route::get('/become-a-partner', [BecomeAPertnerController::class, 'index'])->name('become-a-partner');
Route::get('/all-blogs', [BlogController::class, 'blogList'])->name('all-blogs');
Route::get('/career', [CareerController::class, 'view'])->name('career');
Route::view('/terms-&-conditions', 'website.forms.terms_conditions')->name('terms-and-conditions');
Route::view('/privacy-policy', 'website.forms.privacy_policy')->name('privacy-policy');
Route::post('/contactus/store',[ContactUsController::class,'contactStore'])->name('contactus.store');

// Lead
Route::get('/lead-otp-dom/{formId}/{leadId}', [VerifyOTPController::class, 'create']);
Route::view('/e-brochuer', 'website.forms.e-brochure')->name('download-e-brochure');
Route::post('/lead/popup/store', [LeadController::class, 'downloadEBrochure'])->name('download-e-brochure-store');
Route::post('/lead/call-back/store', [LeadController::class, 'callBackForm'])->name('call-back-store');
Route::post('/verify-phone-otp', [VerifyOTPController::class, 'verifyPhoneOtp']);
Route::get('/enquiry-form-program/{slug}', [LeadController::class, 'openProgramRegisterForm'])->name('enquiry-form-program');
Route::post('/enquiry-form-program/store', [LeadController::class, 'programRegisterFormStore'])->name('enquiry-form-program-store');
Route::post('/enroll-now-form', [LeadController::class, 'openEnrollNowForm']);
Route::post('/enroll-now-form-store', [LeadController::class, 'enrollNowFormStore'])->name('enroll-now-form-store');
Route::post('subscribe-news-letter', [LeadController::class, 'newsletterSubscribersStore'])->name('subscribe-news-letter');
Route::view('/thanksform', 'website.forms.thanksform')->name('thanksform');

// Regions
Route::get('/settings/dropdowns/regions/countries', [RegionController::class, 'countries']);
Route::get('/settings/dropdowns/regions/states/{countryId}', [RegionController::class, 'states']);
Route::get('/settings/dropdowns/regions/cities/{stateId}', [RegionController::class, 'cities']);


//Blog Comment
Route::post('/blog/comment/store',[BlogCommentController::class,'store'])->name('blog.comment.store');
// Error handler
//Route::any('{catchall}', [PageController::class, 'notfound'])->where('catchall', '.*');

Route::group(['middleware' => ['auth']], function () {
  Route::post('/auth/logout', [LoginController::class, 'destroy'])->name('auth.logout');

  // Website Content
  Route::get('/website/content/home-page', [HomePageController::class, 'create'])->name('website.content.home-page');
  Route::post('/website/content/home-page', [HomePageController::class, 'store'])->name('website.content.home-page');

  Route::get('/website/content/why-swayam-vidya', [WhySwayamVidyaController::class, 'create'])->name('website.content.why-swayam-vidya');
  Route::post('/website/content/why-swayam-vidya', [WhySwayamVidyaController::class, 'store'])->name('website.content.why-swayam-vidya');

  Route::get('/website/content/about-us', [AboutUsController::class, 'create'])->name('website.content.about-us');
  Route::post('/website/content/about-us', [AboutUsController::class, 'store'])->name('website.content.about-us');

  Route::get('/website/content/contact-us', [ContactUsController::class, 'create'])->name('website.content.contact-us');
  Route::post('/website/content/contact-us', [ContactUsController::class, 'store'])->name('website.content.contact-us');

  Route::get('/website/content/become-a-partner', [BecomeAPertnerController::class, 'create'])->name('website.content.become-a-partner');
  Route::post('/website/content/become-a-partner', [BecomeAPertnerController::class, 'store'])->name('website.content.become-a-partner');

  Route::get('/website/content/courses', [CoursesController::class, 'create'])->name('website.content.courses');
  Route::post('/website/content/courses', [CoursesController::class, 'store'])->name('website.content.courses');

  Route::get('/website/content/institutions-and-boards', [InstitutionsAndBoardsController::class, 'create'])->name('website.content.institutions-and-boards');
  Route::post('/website/content/institutions-and-boards', [InstitutionsAndBoardsController::class, 'store'])->name('website.content.institutions-and-boards');

  Route::get('/website/content/blogs', [BlogController::class, 'index'])->name('website.content.blogs');
  Route::get('/website/content/edit/{slug}', [BlogController::class, 'edit'])->name('website.content.edit');
  Route::get('/website/content/blogs/create', [BlogController::class, 'create'])->name('website.content.create');
  Route::post('/website/content/blogs', [BlogController::class, 'store'])->name('website.content.blogs');
  Route::put('/website/content/blogs/update/{id}', [BlogController::class, 'update'])->name('website.content.blogs.update');
  Route::get('website/blog/adbanner/create',[BlogController::class,'createAdBanner'])->name('website.blog.adbanner.create');
  Route::post('website/blog/adbanner/store',[BlogController::class,'storeAdBanner'])->name('website.blog.adbanner.store');

  Route::get('website/blog/success-talk/create',[BlogController::class,'createSuccessTalk'])->name('website.blog.success-talk.create');
  Route::post('website/blog/success-talk/store',[BlogController::class,'storeSuccessTalk'])->name('website.blog.success-talk.store');

  Route::get('/website/content/components', [ComponentController::class, 'create'])->name('website.content.components');
  Route::post('/website/content/components', [ComponentController::class, 'store'])->name('website.content.components');

  Route::get('/website/content/header', [HeaderController::class, 'create'])->name('website.content.header');
  Route::post('/website/content/header', [HeaderController::class, 'store'])->name('website.content.header');

  Route::get('/website/content/footer', [FooterController::class, 'create'])->name('website.content.footer');
  Route::post('/website/content/footer', [FooterController::class, 'store'])->name('website.content.footer');

  // Online and Distance Universties
  Route::get('/website/content/online-and-distance-universities/create', [ComponentController::class, 'onlineAndDistanceUniverstiesCreate'])->name('website.content.online-and-distance-universities.create');
  Route::post('/website/content/online-and-distance-universities/store', [ComponentController::class, 'onlineAndDistanceUniverstiesStore'])->name('website.content.online-and-distance-universities.store');
  Route::get('/website/content/online-and-distance-universities/edit/{id}', [ComponentController::class, 'onlineAndDistanceUniverstiesEdit'])->name('website.content.online-and-distance-universities.edit');
  Route::post('/website/content/online-and-distance-universities/update', [ComponentController::class, 'onlineAndDistanceUniverstiesUpdate'])->name('website.content.online-and-distance-universities.update');

  // Career Routes
  Route::get('/website/content/career',[CareerController::class,'index'])->name('website.content.career');
  Route::get('/website/content/career/create',[CareerController::class,'create'])->name('website.content.career.create');
  Route::post('/website/content/career/store',[CareerController::class,'store'])->name('website.content.career.store');
  Route::get('/website/content/career/edit/{id}',[CareerController::class,'edit'])->name('website.content.career.edit');
  Route::put('/website/content/career/update/{id}',[CareerController::class,'update'])->name('website.content.career.update');
  Route::post('/career-form/store', [CareerController::class, 'careerFormStore'])->name('career-form-store');


  // Career Testimonials Routess
  Route::get('/website/content/career/testimonial',[CareerTestimonialController::class,'index'])->name('website.content.career.testimonial');
  Route::get('/website/content/career/testimonial/create',[CareerTestimonialController::class,'create'])->name('website.content.career.testimonial.create');
  Route::post('/website/content/career/testimonial/store',[CareerTestimonialController::class,'store'])->name('website.content.career.testimonial.store');
  Route::get('/website/content/career/testimonial/edit/{id}',[CareerTestimonialController::class,'edit'])->name('website.content.career.testimonial.edit');
  Route::put('/website/content/career/testimonial/update/{id}',[CareerTestimonialController::class,'update'])->name('website.content.career.testimonial.update');
  Route::get('/website/content/career/testimonial/delete/{id}',[CareerTestimonialController::class,'delete'])->name('website.content.career.testimonial.delete');

  // Help center Routes
  Route::get('/website/content/help-center',[HelpCenterController::class,'create'])->name('website.content.help-center');
  Route::post('/website/content/help-center',[HelpCenterController::class,'store'])->name('website.content.help-center');
  Route::get('/website/help-center-feature',[HelpCenterFeatureController::class,'index'])->name('website.help-center-feature');
  Route::get('/website/help-center-feature/create',[HelpCenterFeatureController::class,'create'])->name('website.help-center-feature.create');
  Route::get('/website/help-center-feature-edit/{id}',[HelpCenterFeatureController::class,'edit'])->name('website.help-center-feature.edit');
  Route::post('/website/help-center-feature/store',[HelpCenterFeatureController::class,'store'])->name('website.help-center-feature.store');
  Route::put('/website/help-center-feature/update/{id}',[HelpCenterFeatureController::class,'update'])->name('website.help-center-feature.update');
  // CRM
  Route::get('/dashboard', [CRMController::class, 'index'])->name('dashboard');
  Route::post('/manage/leads', [LeadController::class, 'store'])->name('manage.leads');

  Route::get('website/contact-us/leads',[ContactUsController::class,'contactUsIndex'])->name('website.contact-us.leads');
});
Route::group(['middleware' => ['studentauth']], function () {
  Route::get('student/dashboard', [LMSController::class, 'index'])->name('student.dashboard');
  Route::get('student/skill', [LMSController::class, 'index'])->name('student.skill');
  Route::get('student/university', [LMSController::class, 'universityDashboard'])->name('student.university');
  // Route::get('student/profile', [LMSController::class, 'index'])->name('student.profile');
  Route::post('/auth/student/logout', [StudentLoginController::class, 'destroy'])->name('auth.logout.student');
});

include 'users.php';
include 'admission-settings.php';
include 'lms-settings.php';
include 'lead-settings.php';
include 'components.php';
include 'academics.php';
include 'leads.php';
include 'dependent-dropdowns.php';
include 'student-lms.php';
include 'accounts.php';

// Route::view('/signin', 'website.forms.signin')->name('signin');
// Route::view('/signup', 'website.forms.signup')->name('signup');
Route::view('/partner', 'website.forms.partnerRegistrationForm')->name('partner');
Route::view('/viewsyllabus', 'website.forms.viewsyllabus')->name('viewsyllabus');
Route::view('/enrollUgPg', 'website.forms.enroll_ug_pg')->name('enrollUgPg');
Route::view( '/forgetpassword', 'website.forms.forgetpassword')->name('forgetpassword');
Route::view('/welcomform', 'website.forms.welcomform')->name('welcomform');
Route::get('course/search',[CoursesController::class,'search'])->name('course.search');
Route::get('university/search',[VerticalController::class,'search'])->name('university.search');
Route::get('blog/search',[BlogController::class,'search'])->name('blog.search');
Route::get('help/search',[HelpCenterFeatureController::class,'search'])->name('help.search');
Route::get('/career/search', [CareerController::class, 'search'])->name('career.search');
Route::get('/career/refer',[CareerController::class,'referFriend'])->name('career.refer');
// Route::view('/coursedetails', 'website.forms.coursedetails')->name('coursedetails');
// Route::view('/univeristylist', 'website.forms.univeristylist')->name('univeristylist');
// Route::view('/univesityDetails', 'website.forms.univesityDetails')->name('univesityDetails');
Route::view('/partnerlogin', 'website.forms.partnerlogin')->name('partnerlogin');
// Route::view('/skilllist', 'website.forms.skilllist')->name('skilllist');
// Route::view('/upskill', 'website.forms.upskill')->name('upskill');
Route::view('/careerform', 'website.forms.carrerform')->name('careerform');
// Route::view('/about', 'website.about-us')->name('about');
Route::get('/help_center_home', [HelpCenterController::class,'view'])->name('help_center_home');
 Route::get('/help_center_feature',[HelpCenterFeatureController::class,'view'])->name('help_center_feature');
// Route::view('/about', 'website.about-us')->name('about');
Route::get('check-registered-user',[LMSController::class,'checkUser'])->name('cehck-registered-user');
