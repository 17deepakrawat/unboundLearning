<div class="card mt-2 m-4" id="topic_row_{{$topicCount}}_{{$chapterId}}_{{$unitCount}}">
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <h4>Topic ({{$topicCount}})</h4>
            </div>
            <div class="col-md-4">
                <label for="topic_name">Topic Name</label>
                <input type="text" class="form-control" name="topic_name[{{$queryType}}][chapter_{{$chapterId}}][unit_{{$unitCount}}][topic_{{$topicCount}}][{{$queryType=='update'?$topicId:""}}]" id="chapter_{{$chapterId}}_unit_{{$unitCount}}_topic_name_{{$topicCount}}">
            </div>
            <div class="col-md-4">
                <label for="topic_name">Topic Code</label>
                <input type="text" class="form-control" name="topic_code[{{$queryType}}][chapter_{{$chapterId}}][unit_{{$unitCount}}][topic_{{$topicCount}}][{{$queryType=='update'?$topicId:""}}]" id="chapter_{{$chapterId}}_unit_{{$unitCount}}_topic_code_{{$topicCount}}">
            </div>
            <div class="col-md-4 mt-4 text-end">
                <button class="btn btn-danger" type="button" onclick="removeDiv('topic_row_{{$topicCount}}_{{$chapterId}}_{{$unitCount}}',{{$queryType=='update'?$topicId:''}},'topic')">Delete</button>
            </div>
        </div>
    </div>
</div>