<style>
    .blog_share_s_icon a {
        height: inherit;
        width: inherit;
        border-radius: 50%;
    }
</style>
<script type="module">
    $('.copyButton').click(function() {
        const text = document.getElementById("textForCopy").innerText;
        navigator.clipboard.writeText(text).then(() => {
            toastr.success('Link copy to clipboard');
        }).catch(err => {
            console.error("Failed to copy text: ", err);
        });
    })
</script>
<div class=" w-100 text-end mt-2">
    <button type="button" class="bg-white shadow-none border-none me-1" data-bs-dismiss="modal" aria-label="Close"><img
            src="{{ asset('assets/img/front-pages/icons/close.svg') }}" alt=""></button>
</div>
<div class="modal-body">


    <div>
        <h5 class="modal-title view_popup_modal view_pop_text">Refer a friend</h5>
    </div>

    <div class="row mb-2 justify-content-center">
        <div class="col-md-12">
            <b>
                <p>Link: <span id="textForCopy">{{ url()->current() }}?position={{ $careerData->name }}</span></p>
            </b>
        </div>
    </div>
    <div class="row d-block d-lg-none d-xl-none">
        <div class="col-md-4 mb-4">
            <button class="bg-white shadow-none border-none me-1" style="font-weight: 700; background-color: #1E47A1;"><i class="ti ti-copy"></i></button>
        </div>
    </div>
    <div class="row g-3  justify-content-center career refer_career_form">
        <div class="col-lg-12 blog_col1 blog_share_s_m  d-none d-lg-block d-xl-block">
            <div class="d-flex flex-row align-items-center" style="column-gap:30px ;">
                <div class="">
                    <p class="blog_share_s mb-0">Share</p>
                </div>
                <div class="blog_share_s_icon mt-0">
                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}?position={{ $careerData->name }}"
                        target="_blank" class="btn btn-facebook"><i class="ti ti-brand-facebook-filled"></i></a>
                </div>
                <div class="blog_share_s_icon mt-0 ">
                    <a href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}?position={{ $careerData->name }}&text="
                        target="_blank" class="btn btn-twitter"><i class="ti ti-brand-twitter"></i></a>
                </div>
                <div class="blog_share_s_icon mt-0">
                    <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(url()->current()) }}?position={{ $careerData->name }}"
                        target="_blank" class="btn btn-linkedin"><i class="ti ti-brand-linkedin"></i></a>
                </div>
                <div class="blog_share_s_icon mt-0"><a
                        href="https://wa.me/?text={{ urlencode(url()->current()) }}?position={{ $careerData->name }}"
                        target="_blank" class="btn btn-whatsapp" style="color:white;background:#0080007a"><i
                            class="ti ti-brand-whatsapp"></i></a></div>
                            <div class="blog_share_s_icon mt-0">
            <button class="btn btn-primary copyButton" style="font-weight: 700; background-color: #1E47A1;"><i class="ti ti-copy"></i></button>

                            </div>
            </div>
        </div>
    </div>
</div>
