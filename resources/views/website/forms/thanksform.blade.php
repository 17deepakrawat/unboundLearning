{{-- <div class="modal-header">
  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div> --}}
<style>
    .modal-content {
        border-radius: 20px;
    }
</style>
<div class="modal-header p-0">
    <div class=" w-100 text-end brochure_close_p">
        <button type="button" class="bg-white shadow-none border-none pe-0 " data-bs-dismiss="modal"
            aria-label="Close"><img src="{{ asset('assets/img/front-pages/icons/close.svg') }}" alt=""></button>
    </div>
</div>
<div class="modal-body m-3 justify-content-center">

    <div class="text-center thanks_icon_form">
        <img src="{{ asset('assets/img/front-pages/icons/rectangle.svg') }}" alt="">
        <div class="success_check">
            <img src="{{ asset('assets/img/front-pages/icons/check.svg') }}" alt="">
        </div>
        <div class=" vector_line">
            <div class=""> <img src="{{ asset('assets/img/front-pages/icons/vector 306.svg') }}" alt="">
            </div>
            <div class=""> <img src="{{ asset('assets/img/front-pages/icons/vector 307.svg') }}" alt="">
            </div>
            <div class=""> <img src="{{ asset('assets/img/front-pages/icons/vector 308.svg') }}" alt="">
            </div>
        </div>
        <img class="star_1" src="{{ asset('assets/img/front-pages/icons/Star_3.svg') }}" alt="">
        <img class="star_2" src="{{ asset('assets/img/front-pages/icons/Star_4.svg') }}" alt="">
        <img class="star_3" src="{{ asset('assets/img/front-pages/icons/Star_5.svg') }}" alt="">
        <img class="star_4" src="{{ asset('assets/img/front-pages/icons/Star_6.svg') }}" alt="">
        <img class="star_5" src="{{ asset('assets/img/front-pages/icons/Star_7.svg') }}" alt="">
        <img class="star_6" src="{{ asset('assets/img/front-pages/icons/Star_8.svg') }}" alt="">

    </div>
    <div class="thank_content">
        <div class="thank_you_message text-center">
            <p class="thank_you_t mb-0">Thank You</p>
            <p class="thank_you_sub_t mb-0" id="successMessage">Your query submitted successfully. Our academic
                specialist
                will assist you.</p>
        </div>
        <div class="thankyou_btn d-flex  justify-content-center ">
            <button class="ok_btn me-3 mt-3" data-bs-dismiss="modal"><span class="ok_text_btn">Ok</span></button>
            {{-- <button class="back_home_btn mt-3"><span class="back_home_btn_t"><img class="me-3" src="{{ asset('assets/img/front-pages/icons/arrow-right_6.svg') }}" alt="">Back to Home</span></button> --}}
        </div>
    </div>
</div>
