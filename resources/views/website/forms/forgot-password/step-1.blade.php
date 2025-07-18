 <div class="forget_form p-3 step1_forgetform">
     <div class="text-center">
         <a href="/"> <img src="{{ asset('assets/img/website/logo/logo.png') }}" class="text-center forget_web_logo"
                 alt=""></a>
     </div>
     <div class="row forget_row justify-content-center ms-0">
         <div class="col-lg-3 col-md-3 col-sm-3 pe-0">
             {{-- <img src="{{ asset('assets/img/front-pages/icons/vector14.svg') }}" class="vector_icon_1" alt=""> --}}
             <svg xmlns="http://www.w3.org/2000/svg" width="68" height="88" class="vector_icon_1"
                 viewBox="0 0 68 88" fill="none">
                 <path
                     d="M60.3943 35.462H60.2075V26.9943C60.2075 12.2693 48.1598 -0.245394 33.4659 0.00365448C19.1768 0.252703 7.59599 11.958 7.59599 26.3094V27.1188C7.59599 28.333 8.59218 29.3291 9.8063 29.3291H16.8731C18.0872 29.3291 19.0834 28.333 19.0834 27.1188V26.8698C19.0834 18.9625 25.0294 12.0203 32.9367 11.5222C41.5289 10.9929 48.689 17.8106 48.689 26.2783V35.4308H26.8973V35.462H6.75545C3.01972 35.5865 0 38.6062 0 42.3731V80.6643C0 84.4934 3.11311 87.6066 6.94223 87.6066H60.3632C64.1923 87.6066 67.3054 84.4934 67.3054 80.6643V42.4042C67.3366 38.5751 64.2235 35.462 60.3943 35.462ZM37.7932 63.262C37.2639 63.6356 37.1083 64.0403 37.1083 64.6629C37.1394 67.4647 37.1394 70.2665 37.1083 73.0995C37.1705 74.2825 36.579 75.4032 35.5206 75.9324C33.0612 77.1777 30.6019 75.4343 30.6019 73.0995C30.6019 73.0995 30.6019 73.0995 30.6019 73.0683C30.6019 70.2665 30.6019 67.4336 30.6019 64.6318C30.6019 64.0715 30.4773 63.6667 29.9792 63.2932C27.4265 61.4253 26.586 58.2188 27.8623 55.3859C29.1076 52.6463 32.1273 51.0275 34.9602 51.619C38.1356 52.2416 40.3459 54.8255 40.377 57.9698C40.4704 60.1801 39.5676 61.9857 37.7932 63.262Z"
                     fill="grey" />
             </svg>

         </div>
         <div class="col-lg-6 col-md-6 col-sm-6 d-flex flex-row ps-0">
             <div class="forget_form_img_s me-2">
                 <img src="{{ asset('assets/img/front-pages/icons/vector12.svg') }}"
                     class="mob_star_forget forget_form_img_s" alt=""><br>
                 <img src="{{ asset('assets/img/front-pages/icons/vector13.svg') }}"
                     class=" mob_star_forget1 forget_form_img_s" alt="">
             </div>
             <div class="forget_form_img_s me-2">
                 <img src="{{ asset('assets/img/front-pages/icons/vector12.svg') }}"class=" mob_star_forget forget_form_img_s"
                     alt=""><br>
                 <img src="{{ asset('assets/img/front-pages/icons/vector13.svg') }}"class=" mob_star_forget1 forget_form_img_s"
                     alt="">
             </div>
             <div class="forget_form_img_s me-2">
                 <img src="{{ asset('assets/img/front-pages/icons/vector12.svg') }}"class=" mob_star_forget forget_form_img_s"
                     alt=""><br>
                 <img src="{{ asset('assets/img/front-pages/icons/vector13.svg') }}"
                     class=" mob_star_forget1 forget_form_img_s" alt="">
             </div>
             <div class="forget_form_img_s me-2">
                 <img src="{{ asset('assets/img/front-pages/icons/vector12.svg') }}"
                     class=" mob_star_forget forget_form_img_s" alt=""><br>
                 <img src="{{ asset('assets/img/front-pages/icons/vector13.svg') }}"
                     class=" mob_star_forget1 forget_form_img_s" alt="">
             </div>
         </div>
     </div>
     <div class="forgetpassword_t_section p-2">
         <p class="mb-0 forgetpassword_t text-start">Reset your Password</p>
         <p class="mb-0 forgetpassword_subt">Enter your registered email address to reset your account’s password.</p>
         <form id="findEmail" action="{{ route('student.password.forgot') }}" method="POST" style="width: 100%">
             <input type="email" style="width: 100%" class="mt-3 form-control forget_form_field  mb-3 forget_form_field_step1"
                 name="email" id="email" placeholder="Email Address" required>
             <div class="d-flex justify-content-center algin_forget_btn">
                 <button onclick="javascript:history.back()" type="button"
                     class="forget_form_btn border-none bg-white me-3"><span
                         class="forget_form_btn_t">Cancel</span></button>
                 <button type="submit" class="forget_form_btn1 border-none"><span class="forget_form_btn_t1">Find
                         Account <img src="{{ asset('assets/img/front-pages/icons/frame_12.svg') }}"
                             class="find_btn_mob" alt=""></span></button>
             </div>
         </form>
         <hr class="forget_hr">
         <p class="text-center form_footer_forget_t">Don’t have an account? <a href="{{ route('student.sign-up') }}"
                 class="form_footer_forget_subt">Sign Up</a></p>
     </div>
 </div>

 <script>
     $("#findEmail").validate({
         rules: {
             email: {
                 required: true,
                 email: true
             }
         },
         messages: {
             email: {
                 required: "Please enter your email address",
                 email: "Please enter a valid email address"
             }
         }
     });
     $('#findEmail').submit(function(e) {
         e.preventDefault();
         if ($('#findEmail').valid()) {
             $(':input[type="submit"]').prop('disabled', true);
             var formData = new FormData(this);
             formData.append("_token", "{{ csrf_token() }}");
             $.ajax({
                 url: $(this).attr('action'),
                 type: $(this).attr('method'),
                 data: formData,
                 processData: false,
                 contentType: false,
                 dataType: 'json',
                 success: function(response) {
                     if (response.status == 'success') {
                         $.ajax({
                             url: '/student/login/forgot-password/2',
                             type: 'POST',
                             data: {
                                 "_token": "{{ csrf_token() }}",
                                 "data": response
                             },
                             success: function(data) {
                                 $('#forgotPasswordSteps').html(data);
                             }
                         })
                     } else {
                         $(':input[type="submit"]').prop('disabled', false);
                         toastr.error(response.message, response.title);
                     }
                 },
                 error: function(response) {
                     $(':input[type="submit"]').prop('disabled', false);
                     toastr.error(response.responseJSON.message);
                 }
             });
         }
     })
 </script>
