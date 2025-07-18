<div class="card mt-2 m-4" id="unit_row_{{$chapterId}}_{{$unitCount}}">
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <h4>Unit ({{$unitCount}})</h4>
            </div>
            <div class="col-md-4">
                <label for="unit_name">Unit Name</label>
                <input type="text" class="form-control" name="unit_name[{{$queryType}}][chapter_{{$chapterId}}][unit_{{$unitCount}}][{{$queryType=='update'?$unitId:""}}]" id="chapter_{{$chapterId}}_unit_name_{{$unitCount}}">
            </div>
            <div class="col-md-4">
                <label for="unit_code">Unit Code</label>
                <input type="text" class="form-control" name="unit_code[{{$queryType}}][chapter_{{$chapterId}}][unit_{{$unitCount}}][{{$queryType=='update'?$unitId:""}}]" id="chapter_{{$chapterId}}_unit_code_{{$unitCount}}">
            </div>
            <div class="col-md-4 mt-4 text-end">
                <input type="hidden" id="topic_id_{{$chapterId}}_{{$unitCount}}" value="0">
                <button class="btn btn-danger" type="button" onclick="removeDiv('unit_row_{{$chapterId}}_{{$unitCount}}',{{$queryType=='update'?$unitId:''}},'unit')">Delete</button>
                <button class="btn btn-primary" type="button" onclick="addTopic({{$unitCount}},{{$chapterId}},'insert')">Add Topic</button>
            </div>
        </div>
    </div>
</div>