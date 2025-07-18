@isset($pageConfigs)
{!! Helper::updatePageConfig($pageConfigs) !!}
@endisset
@php
$configData = Helper::appClasses();
@endphp

@isset($configData["layout"])
@include((( $configData["layout"] === 'horizontal') ? 'layouts.horizontalLayout' :
(( $configData["layout"] === 'blank') ? 'layouts.blankLayout' :
(($configData["layout"] === 'front') ? 'layouts.layoutFront' : 'layouts.studentContentNavbarLayout') )))
@endisset

<script>
    function changeCourse(id)
    {
       $.ajax({
        url:"/student/lms/set-specialization-in-session/"+id,
        type:"get",
        success:function(res)
        {
            toastr.success('Course changed successfull');
            window.location.reload();
        }
       })
    }
</script>