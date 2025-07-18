@extends('layouts/studentLayoutMaster')

@section('title', 'Student | Dashboard')

@section('vendor-style')
    @vite(['resources/assets/vendor/libs/apex-charts/apex-charts.scss'])
@endsection

@section('vendor-script')
    @vite(['resources/assets/vendor/libs/apex-charts/apexcharts.js'])
@endsection

@section('page-script')
    @vite(['resources/assets/js/dashboards-crm.js'])

    <script type="module">
        $(document).ready(function(){
            var studentData = {!!$wholeStudentData!!};
            console.log(studentData);
            $('#avatar').attr('src','/'+JSON.parse(studentData['avatar'])[0]);
                $.each(studentData,function(key,val){
                $(key).text(val);
            });
        });
        
    </script>

@endsection

@section('content')
@include('layouts.sections.menu.studentHorizontalMenu')
   <div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-center" style="">
            @if (!empty($idCardTemplate))
            <div class="row">
                <div class="col-md-12 d-md-flex d-block align-items-center justify-content-center mb-3">
                    <div class="" id="idCardDiv">
                        
                        {!!$idCardTemplate[0]['design']!!}
                        
                    </div>
                </div>
                <div class="col-md-12 mt-3 d-flex justify-content-center">
                    <button class="btn btn-primary" onclick="printIdCard()">Download</button>
                </div>
            </div>
            @endif
        </div>
    </div>
   </div>
    <script>
        function printIdCard()
        {
            var divName = 'idCardDiv';
			var printContents = document.getElementById(divName).innerHTML;
			var originalContents = document.body.innerHTML;

			document.body.innerHTML = printContents;

			window.print();

			setTimeout(() => {
                document.body.innerHTML = originalContents;
            }, 500);
        }
    </script>
@endsection
