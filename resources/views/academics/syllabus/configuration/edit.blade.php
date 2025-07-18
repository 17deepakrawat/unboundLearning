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
    });
    $(document).ready(function(){
        var chapterArray =  $("<div/>").html("{{json_encode($chapters,true)}}").text();
        $.each(JSON.parse(chapterArray),function(key,chapter){
            addChapter(chapter,'update');
        })
    })
</script>
@endsection
{{-- {{dd($chapters->toArray())}} --}}
@section('content')
    <form id="chapterForm" action="{{ route('academics.syllabus.configuration.update',[$syllabus[0]->id]) }}" method="POST">
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
                        <button type="button" class="add-new btn btn-primary mb-3 mb-md-0 waves-effect waves-light" onclick="addChapter('','insert')">
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
    function addChapter(chapter,query_type)
    {
        console.log(chapter['id']);
        var chapterId = 0;
        if(query_type=='update' && chapter!='' && chapter['id']!='')
        {
            chapterId = chapter['id'];   
        }
        var chapterCount = parseInt($('#chapter_count').val())+1;
        $('#chapter_count').val(chapterCount)
        $.ajax({
            url:'/academics/syllabus/configuration/add-chapter/'+query_type+'/'+chapterCount+'/'+chapterId,
            type:"get",
            success:function(res)
            {
                $('#chapter_body').append(res);
                if(query_type=='update')
                {
                    $.each(chapter['units'],function(key,unit)
                    {
                        addUnit(chapterCount,'update',unit);
                    });
                    $('#chapter_name_'+chapterCount).val(chapter['name'])
                    $('#chapter_code_'+chapterCount).val(chapter['code'])   
                }
            }
        })
    }
    function addUnit(chapter_id,query_type,unit)
    {
        var unitId = 0;
        if(query_type=='update' && unit!='' && unit['id']!='')
        {
            unitId = unit['id'];   
        }
        var unitCount = parseInt($('#unit_id_'+chapter_id).val())+1;
        $('#unit_id_'+chapter_id).val(unitCount)
        $.ajax({
            url:'/academics/syllabus/configuration/add-unit/'+query_type+'/'+unitCount+'/'+chapter_id+'/'+unitId,
            type:"get",
            success:function(res)
            {
                $('#row_'+chapter_id).append(res);
                if(query_type=='update')
                {
                    $.each(unit['topics'],function(key,topic)
                    {
                        addTopic(unitCount,chapter_id,'update',topic);
                    })
                    $('#chapter_'+chapter_id+'_unit_name_'+unitCount).val(unit['name'])
                    $('#chapter_'+chapter_id+'_unit_code_'+unitCount).val(unit['code'])   
                }
            }
        })
    }
    function addTopic(unit_id,chapter_id,query_type,topic)
    {
        var topicId = 0;
        if(query_type=='update' && topic!='' && topic['id']!='')
        {
            topicId = topic['id'];   
        }
        var topicCount = parseInt($('#topic_id_'+chapter_id+'_'+unit_id).val())+1;
        $('#topic_id_'+chapter_id+'_'+unit_id).val(topicCount)
        $.ajax({
            url:'/academics/syllabus/configuration/add-topic/'+query_type+'/'+topicCount+'/'+unit_id+'/'+chapter_id+'/'+topicId,
            type:"get",
            success:function(res)
            {
                $('#unit_row_'+chapter_id+'_'+unit_id).append(res);
                if(query_type=='update')
                {
                    $('#chapter_'+chapter_id+'_unit_'+unit_id+'_topic_name_'+topicCount).val(topic['name'])
                    $('#chapter_'+chapter_id+'_unit_'+unit_id+'_topic_code_'+topicCount).val(topic['code'])   
                }
            }
        })
    }
    function removeDiv(rowId,recordId,type)
    {
        if(recordId!='')
        {
            $.ajax({
                url:"/academics/syllabus/delete/"+type+"/"+recordId,
                type:"get",
                success:function(res)
                {
                    if(res.status=='success')
                    {
                        toastr.success(res.message);
                    }
                    else
                    {
                        toastr.error(res.message);
                    }
                }
            });   
        }
        $('#'+rowId).remove();

    }
</script>