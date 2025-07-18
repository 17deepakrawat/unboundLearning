<style>
    @media(min-width: 300px) and (max-width: 346px) {
        .enrol_ug_pg_field {
            width: 100%;
        }

       
    }

    .enrol_ug_pg_field {
        width: 100% !important;
        height: 52px !important;
    }

 

    .modal-content,
    #enrollNowForm {
        border-radius: 20px !important;
    }
    .check_point_s{
      width: 100%;
    }
    .note_enroll_m1{
      margin-bottom: 30px;
    }
    .note_enroll_m2{
      margin-top: 30px;
    }
    .enroll-now_form{
      margin-top: 30px !important;
    }
    .enroll_ug_pg_modal {
      margin-bottom: 26px;   }
@media (min-width: 300px) and (max-width: 322px) {
  .modal .modal-dialog:not(.modal-fullscreen) {
    margin: 3px !important
  }
}
</style>
{{-- <div class="modal-header">
  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div> --}}
<form id="enrollNowForm" action="{{ route('enroll-now-form-store') }}" method="POST">
    <div class=" w-100 text-end mt-2 enrollnow_closebtn">
        <button type="button" class="bg-white shadow-none border-none " data-bs-dismiss="modal" aria-label="Close"><img
                src="{{ asset('assets/img/front-pages/icons/close.svg') }}" alt=""></button>
    </div>
    <div class="modal-body enrollnow_modalbody justify-content-center">
        <h5 class="modal-title enroll_ug_pg_modal mb-3">Register to Start Your Learning Journey Now !</h5>
        <select class="form-select enrol_ug_pg_field mb-3" name="specialization_id" id="enroll_now_specialization_id"
            aria-label="" required>
            <option value="">Select a Specialisation</option>
            @foreach ($specializations as $specialization)
                <option value="{{ $specialization->id }}">
                    {{ $specialization->name . ' | ' . $specialization->programType->name }}</option>
            @endforeach
        </select>
        <select class="form-select enrol_ug_pg_field mb-3" name="planning_to_start_in"
            id="enroll_now_planning_to_start_in" aria-label="Default select example">
            <option value="">When you are planning to start?</option>
            <option value="Now">Now</option>
            <option value="After 1 Month">After 1 Month</option>
            <option value="After 2 Month">After 2 Month</option>
            <option value="Not decided yet!">Not decided yet!</option>
        </select>
        <div class="d-flex flex-row check_w_s justify-content-center w-100 enroll-now_form">
            <div class="check_s_enrolls">
                <div class="form-check">
                    <input class="form-check-input single-checkbox" name="for_whom" value="For My-Self" checked
                        type="checkbox" id="checkbox1">
                    <label class="form-check-label enroll_check_t" for="checkbox1">
                        For myself
                    </label>
                </div>
            </div>
            <div class="check_s_enroll">
                <div class="form-check">
                    <input class="form-check-input single-checkbox" name="for_whom" value="For Friend/Family"
                        type="checkbox" id="checkbox2">
                    <label class="form-check-label enroll_check_t" for="checkbox2">
                        For Friend/Family
                    </label>
                </div>
            </div>
        </div>
        <div class="point_section">
            <div class="d-flex flex-row check_point_s note_enroll_m2">
                <div class=" check_point_img">
                    <img src="{{ asset('assets/img/front-pages/icons/check 1.svg') }}" alt="">
                </div>
                <div class="">
                    <p class="enroll_check_point mb-0">We’ll reach out you between 10 am and 9 pm</p>
                </div>
            </div>
            <div class="d-flex flex-row check_point_s">
                <div class="check_point_img">
                    <img src="{{ asset('assets/img/front-pages/icons/check 1.svg') }}" alt="">
                </div>
                <div class="">
                    <p class="enroll_check_point mb-0">Unbiased career guidance</p>
                </div>
            </div>
            <div class="d-flex flex-row check_point_s note_enroll_m1">
                <div class="check_point_img">
                    <img src="{{ asset('assets/img/front-pages/icons/check 1.svg') }}" alt="">
                </div>
                <div class="">
                    <p class="enroll_check_point mb-0">Personalized guidance based on your skills and interests</p>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-center">
            <button type="submit" class="enrollugpg_btn border-none w-100"><span class="enrollugpg_btn_t" id="enrollNowFormButton">
                    {{ $campaign == 'Connect with University Expert' ? 'Connect with University Expert' : 'Enroll Now' }}
                </span></button>
        </div>
    </div>
</form>

<script type="module">
    const checkboxes = document.querySelectorAll('.single-checkbox');
    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            if (this.checked) {
                checkboxes.forEach(cb => {
                    if (cb !== this) cb.checked = false;
                });
            }
        });
    });
</script>

<script>
    $("#enrollNowForm").validate();
    $("#enrollNowForm").submit(function(e) {
        e.preventDefault();
        if ($("#enrollNowForm").valid()) {
            $(':input[type="submit"]').prop('disabled', true);
            $("#enrollNowFormButton").html('Please wait...');
            var formData = new FormData(this);
            formData.append('vertical_id', '{{ $vertical_id }}');
            formData.append('campaign', '{{ $campaign }}');
            formData.append('leadId', '{{ $leadId }}');
            formData.append('program_id', '{{ $program_id }}');
            formData.append("_token", "{{ csrf_token() }}");
            $.ajax({
                url: $(this).attr('action'),
                type: $(this).attr('method'),
                data: formData,
                processData: false,
                contentType: false,
                dataType: 'json',
                success: function(response) {
                    $(':input[type="submit"]').prop('disabled', false);
                    if (response.status == 'success') {
                        $(".modal").modal('hide');
                        setTimeout(function() {
                            $.ajax({
                                url: '/thanksform',
                                type: 'GET',
                                success: function(response) {
                                    $("#modal-sm-content").html(response);
                                    $("#modal-sm").modal('show');
                                }
                            })
                        }, 100)
                    } else {
                        toastr.error(response.message);
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
