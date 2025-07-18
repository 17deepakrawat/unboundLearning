@extends('layouts/layoutMaster')

@section('title', 'Syllabus')

@section('vendor-style')
    @vite(['resources/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.scss', 'resources/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.scss', 'resources/assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.scss', 'resources/assets/vendor/libs/@form-validation/form-validation.scss'])
@endsection

@section('vendor-script')
    @vite(['resources/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js'])
@endsection

@section('page-script')
<script type="module">
    $('.form-select').select2({
        placeholder:"Choose"
    });
    $("#chapterForm").submit(function(e) {
      e.preventDefault();
      if ($("#chapterForm").valid()) {
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
            if (response.status == 'success') {
              toastr.success(response.message);
              $(".modal").modal('hide');
              $('#syllabus-table').DataTable().ajax.reload();
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
@endsection

@section('content')
    <form id="chapterForm" action="{{ route('academics.syllabus.configuration.store') }}" method="POST">
        <div class="card">
            <div class="card-body" id="chapter_body">
                <div class="card-title">
                    Create Chapters for {{$syllabus[0]->name}}
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <label for="syllabus_id">Syllabus</label>
                        <select class="form-select" name="syllabus_id" id="syllabus_id">
                            <option value=""></option>
                            <option value="{{$syllabus[0]->id}}" selected>{{$syllabus[0]->name}}</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="syllabus_code">Syllabus Code</label>
                        <select class="form-select" name="syllabus_code" id="syllabus_code">
                            <option value=""></option>
                            <option value="{{$syllabus[0]->code}}" selected>{{$syllabus[0]->code}}</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="specialization_id">Specialization</label>
                        <select class="form-select" name="specialization_id" id="specialization_id">
                            <option value=""></option>
                            <option value="{{$syllabus[0]->specialization->id}}" selected>{{$syllabus[0]->specialization->name}}</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-2 mt-2">
                        <input type="hidden" id="chapter_count" value="0">
                        <button type="button" class="add-new btn btn-primary mb-3 mb-md-0 waves-effect waves-light" onclick="addChapter('insert')">
                            Add Chapter
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary waves-effect waves-light">Save</button>
    </form>




@endsection
<script>
    function addChapter(query_type)
    {
        var chapterCount = parseInt($('#chapter_count').val())+1;
        $.ajax({
            url:'/academics/syllabus/configuration/add-chapter/'+query_type+'/'+chapterCount+'/0',
            type:"get",
            success:function(res)
            {
                $('#chapter_body').append(res);
                $('#chapter_count').val(chapterCount)
            }
        })
    }
    function addUnit(chapter_id,query_type)
    {
        var unitCount = parseInt($('#unit_id_'+chapter_id).val())+1;
        $.ajax({
            url:'/academics/syllabus/configuration/add-unit/'+query_type+'/'+unitCount+'/'+chapter_id+'/0',
            type:"get",
            success:function(res)
            {
                $('#row_'+chapter_id).append(res);
                $('#unit_id_'+chapter_id).val(unitCount)
            }
        })
    }
    function addTopic(unit_id,chapter_id,query_type)
    {
        var topicCount = parseInt($('#topic_id_'+chapter_id+'_'+unit_id).val())+1;
        $.ajax({
            url:'/academics/syllabus/configuration/add-topic/'+query_type+'/'+topicCount+'/'+unit_id+'/'+chapter_id+'/0',
            type:"get",
            success:function(res)
            {
                $('#unit_row_'+chapter_id+'_'+unit_id).append(res);
                $('#topic_id_'+chapter_id+'_'+unit_id).val(topicCount)
            }
        })
    }
    function removeDiv(id)
    {
        $('#'+id).remove();
    }
</script>