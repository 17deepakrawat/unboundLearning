<!-- BEGIN: Vendor JS-->
@vite(['resources/assets/vendor/libs/jquery/jquery.js', 'resources/assets/vendor/js/dropdown-hover.js', 'resources/assets/vendor/js/mega-dropdown.js', 'resources/assets/vendor/libs/node-waves/node-waves.js', 'resources/assets/vendor/libs/popper/popper.js', 'resources/assets/vendor/js/bootstrap.js', 'resources/assets/vendor/libs/intl-tel-input/intl-tel-input.js'])

@yield('vendor-script')
<!-- END: Page Vendor JS-->
<!-- BEGIN: Theme JS-->
@vite(['resources/assets/js/front-main.js'])
<!-- END: Theme JS-->
<!-- Pricing Modal JS-->
@stack('pricing-script')
<!-- END: Pricing Modal JS-->
<!-- BEGIN: Page JS-->
@yield('page-script')
<!-- END: Page JS-->

<script>
  function downloadFile(url, name) {
    const link = document.createElement('a');
    link.href = url;
    link.download = name
    link.click();
  }
</script>

<script>
  function registerForm(slug) {
    var isLoggedIn = '{{ auth('student')->check() ? 1 : 0 }}';
    isLoggedIn = isLoggedIn == 1 ? '{{ !empty(auth('student')->user()->phone) ? 1 : 0 }}' : isLoggedIn;
    isLoggedIn = parseInt(isLoggedIn);
    if (isLoggedIn == 1) {
      window.location.href = "/courses/" + slug;
    } else {
      $.ajax({
        url: '/enquiry-form-program/' + slug,
        type: 'GET',
        success: function(data) {
          $("#modal-lg-content").html(data);
          $("#modal-lg").modal('show');
        }
      })
    }
  }
  
</script>

<script type="module">
  $(function() {
    $("#subscribeForm").validate();
    $("#subscribeForm").submit(function(e) {
      e.preventDefault();
      if ($("#subscribeForm").valid()) {
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
            $(':input[type="submit"]').prop('disabled', false);
            $("#subscribeForm").trigger("reset");
            $.ajax({
              url: '/thanksform',
              type: 'GET',
              success: function(response) {
                $("#modal-sm-content").html(response);
                setTimeout(() => {
                  $("#successMessage").html(
                    'Your request submitted successfully!<br>You will be notified.'
                  );
                  $("#modal-sm").modal('show');
                }, 100);
              }
            })
          },
          error: function(response) {
            $(':input[type="submit"]').prop('disabled', false);
            $("#subscribeForm").trigger("reset");
            $.ajax({
              url: '/thanksform',
              type: 'GET',
              success: function(response) {
                $("#modal-sm-content").html(response);
                setTimeout(() => {
                  $("#successMessage").html(
                    'Your request submitted successfully!<br>You will be notified.'
                  );
                  $("#modal-sm").modal('show');
                }, 100);
              }
            })
          }
        });
      }
    })
  })
</script>
<script type="module">
  $(document).ready(function() {
       $('#course-search').on('input', function(e) {
           e.preventDefault();
           var title = $('#course-search').val();
           if(title.length>=3)
           {
               var url = "{{route('course.search')}}";
               console.log(title);
               $.ajax({
                   method: "GET",
                   url: url,
                   data: {
                       title: title
                   },
                   success: function(response) {
                       $('.web-search').empty();
                       if (response.status === 200 && response.data.length > 0) {
                           var webHtml = '';
                           response.data.forEach(function(course) {
                               // console.log(course);
                               webHtml += '<button class="nav-link navfront_text1 categories-tab d-flex justify-content-start dropdown-item p-2 web-search-input-text"  onclick=$("#course-search").val($(this).text());$(".web-search").removeClass("show");>' + course.name + '</button>';
                           });
                           $('.web-search').html(webHtml);
                           $('.web-search').addClass('show');
                       } else {
                           $('.web-search').html("No course found");
                           $('.web-search').addClass('show');
                           if(title=='')
                          {
                              $('.web-search').removeClass('show');
                              $('.web-search').empty();
                          }
                       }
                   },

               });   
           }
           else
           {
               if(title=='')
               {
                   $('.web-search').removeClass('show');
                   $('.web-search').empty();
               }
           }
       });
   });
   $(document).on("click", function(event){
      var $trigger = $(".web-search");
      if($trigger !== event.target && !$trigger.has(event.target).length){
          $(".web-search").removeClass("show");
      }            
  });
   $(document).on("click", function(event){
      var $trigger = $(".course-area-search-mob");
      if($trigger !== event.target && !$trigger.has(event.target).length){
          $(".course-area-search-mob").removeClass("show");
      }            
  });
   $('.course-search-button').click(function(){
      window.location.href = '/courses?keyword='+$('#course-search').val();
   })
</script>