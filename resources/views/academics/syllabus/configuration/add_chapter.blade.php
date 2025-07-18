<div class="card mt-2" id="row_{{$chapterCount}}">
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <h4>Chapter ({{$chapterCount}})</h4>
            </div>
            <div class="col-md-4">
                <label for="chapter_name">Chapter Name</label>
                <input type="text" class="form-control" name="chapter_name[{{$queryType}}][chapter_{{$chapterCount}}][{{$queryType=='update'?$chapterId:""}}]" id="chapter_name_{{$chapterCount}}">
            </div>
            <div class="col-md-4">
                <label for="chapter_name">Chapter Code</label>
                <input type="text" class="form-control" name="chapter_code[{{$queryType}}][chapter_{{$chapterCount}}][{{$queryType=='update'?$chapterId:""}}]" id="chapter_code_{{$chapterCount}}">
            </div>
            <div class="col-md-4 mt-4 text-end">
                <input type="hidden" id="unit_id_{{$chapterCount}}" value="0">
                <button class="btn btn-danger" type="button" onclick="removeDiv('row_{{$chapterCount}}',{{$queryType=='update'?$chapterId:''}},'chapter')">Delete</button>
                <button class="btn btn-primary" type="button" onclick="addUnit({{$chapterCount}},'insert')">Add Unit</button>
            </div>
        </div>
    </div>
</div>