@extends('layouts/layoutFrontForm')

@section('title', 'Content | Why Swayam Vidya')

@section('vendor-style')
@vite(['resources/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.scss', 'resources/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.scss', 'resources/assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.scss', 'resources/assets/vendor/libs/select2/select2.scss', 'resources/assets/vendor/libs/@form-validation/form-validation.scss', 'resources/assets/vendor/libs/quill/typography.scss', 'resources/assets/vendor/libs/quill/katex.scss', 'resources/assets/vendor/libs/quill/editor.scss'])
@endsection

@section('vendor-script')
@vite(['resources/assets/vendor/libs/moment/moment.js', 'resources/assets/vendor/libs/select2/select2.js', 'resources/assets/vendor/libs/@form-validation/popular.js', 'resources/assets/vendor/libs/@form-validation/bootstrap5.js', 'resources/assets/vendor/libs/@form-validation/auto-focus.js', 'resources/assets/vendor/libs/cleavejs/cleave.js', 'resources/assets/vendor/libs/cleavejs/cleave-phone.js', 'resources/assets/vendor/libs/quill/katex.js', 'resources/assets/vendor/libs/quill/quill.js', 'resources/assets/vendor/libs/cleavejs/cleave.js', 'resources/assets/vendor/libs/cleavejs/cleave-phone.js'])

@endsection
@section('content')
<div style="justify-content: center; display: flex;align-items:center;">
  <div class="thanks_modal" style=" ">
    <div class="modal-header d-flex flex-column  m-3 ">
      <div class="text-end w-100">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
    </div>
    <form id="E-BookForm" method="POST">
      <div class="modal-body m-3 justify-content-center">
        <div class="text-center">
          <img src="{{ asset('assets/img/front-pages/icons/rectangle.svg') }}" alt="">
          <div class="success_check">
            <img src="{{ asset('assets/img/front-pages/icons/check.svg') }}" alt="">
          </div>
          <div class=" vector_line">
            <div class=""> <img src="{{ asset('assets/img/front-pages/icons/vector 306.svg') }}" alt=""></div>
            <div class=""> <img src="{{ asset('assets/img/front-pages/icons/vector 307.svg') }}" alt=""></div>
            <div class=""> <img src="{{ asset('assets/img/front-pages/icons/vector 308.svg') }}" alt=""></div>
          </div>
          <img class="star_1" src="{{ asset('assets/img/front-pages/icons/Star_3.svg') }}" alt="">
          <img class="star_2" src="{{ asset('assets/img/front-pages/icons/Star_4.svg') }}" alt="">
          <img class="star_3" src="{{ asset('assets/img/front-pages/icons/Star_5.svg') }}" alt="">
          <img class="star_4" src="{{ asset('assets/img/front-pages/icons/Star_6.svg') }}" alt="">
          <img class="star_5" src="{{ asset('assets/img/front-pages/icons/Star_7.svg') }}" alt="">
          <img class="star_6" src="{{ asset('assets/img/front-pages/icons/Star_8.svg') }}" alt="">
          <div class="thank_content">
            <div class="thank_you_message text-center">
              <p class="thank_you_t mb-0">Thank You</p>
              <p class="thank_you_sub_t mb-0">Your query submitted successfully. Our academic specialist
                will assist you</p>
            </div>
            <div class="thankyou_btn d-flex  justify-content-center ">
              <button class="ok_btn me-3 mt-3"><span class="ok_text_btn">Ok</span></button>
              <button class="back_home_btn mt-3"><span class="back_home_btn_t"><img class="me-3" src="{{ asset('assets/img/front-pages/icons/arrow-right_6.svg') }}" alt="">Back to Home</span></button>
            </div>
          </div>
        </div>
      </div>
    </form>
  </div>
</div>
@endsection