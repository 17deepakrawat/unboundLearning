@extends('layouts/studentLayoutMaster')

@section('title', 'Student | Dashboard')

@section('vendor-style')
    @vite(['resources/assets/vendor/libs/apex-charts/apex-charts.scss', 'resources/assets/vendor/libs/plyr/plyr.scss', 'resources/assets/vendor/libs/quill/typography.scss', 'resources/assets/vendor/libs/quill/katex.scss', 'resources/assets/vendor/libs/quill/editor.scss'])
@endsection

@section('vendor-script')
    @vite(['resources/assets/vendor/libs/apex-charts/apexcharts.js', 'resources/assets/vendor/libs/plyr/plyr.js', 'resources/assets/vendor/libs/quill/katex.js', 'resources/assets/vendor/libs/quill/quill.js','resources/js/app.js'])
@endsection
@section('page-script')
    @vite(['resources/assets/js/dashboards-crm.js'])
    <script type="module">
        $(document).ready(function() {
            if ("{{ !empty($allVideos)??$allVideos[0]->video_type }}" == 'link') {
                $('#youtubelink').show();
                $('#uploadedvideo').hide();
                $('iframe').attr('src', "{{ !empty($allVideos)??$allVideos[0]->video_path }}")
            } else {
                $('#uploadedvideo').show();
                $('#youtubelink').hide();
                $('source').attr('src', "{{ !empty($allVideos)??$allVideos[0]->video_path }}")
            }
        })
    </script>
@endsection

@section('content')
@include('layouts.sections.menu.studentHorizontalMenu')
    <div class="row g-6">
        @if (!empty($allVideos) && $allVideos->count()>0)
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center flex-wrap mb-6 gap-2">
                        <div class="me-1">
                            <h5 class="mb-0" id="chapter_name">{{ $allVideos[0]->name }}</h5>
                            <input type="hidden" id="video_id" value="{{$allVideos[0]->id}}">
                        </div>
                    </div>
                    <div class="card academy-content shadow-none border">
                        <p style="display: none;" id="youtubelink"><iframe width="750" height="400"
                                src="/{{ $allVideos[0]->video_path }}" title="" frameBorder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                allowFullScreen></iframe></p>
                        <div class="p-2" style="display: none;" id="uploadedvideo">
                            <div class="cursor-pointer">
                                <video class="w-100" id="plyr-video-player" playsinline controls controlsList="nodownload">
                                    <source src="/{{ $allVideos[0]->video_path }}" type="video/mp4" />
                                </video>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center flex-wrap mb-6 gap-2">
                        <div class="me-1">
                            <h5 class="mb-0">Ask A Question</h5>
                        </div>
                    </div>
                    <div class="card academy-content shadow-none border" id="messages">
                        @foreach ($videoQuestions as $question)
                            <div class="col-md-6" id="question_{{$question->id}}">Raised by: {{$question->student->first_name}} {{$question->student->last_name}}<br>Issue at: {{$question->time}}<br><strong>Title:</strong>{{$question->title}}<br><span><strong>Issue:</strong>{!!$question->description!!}</span>
                            @foreach ($question->answer as $answer)
                                <div style="margin-left: 50px;" id="answerId_{{$answer->id}}">
                                <strong>Answered by: </strong> {{$answer->student->first_name}} {{$answer->student->last_name}}<br>
                                <strong>Answer: </strong> {{$answer->answer}}
                            </div>
                            @endforeach
                            <p style="display: inline-flex;"><input type="text" class="form-control" name="answer[{{$question->id}}]" id="answer_{{$question->id}}"><button class="btn btn-primary" style="width:50px;" onclick="saveReply({{$question->id}})">Reply</button></p></div>
                        @endforeach
                    </div>
                    <div class="col-md-3">
                        <button class="btn btn-primary" id="timebutton" onclick="addQuestion()">As a new
                            question</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="accordion stick-top accordion-custom-button" id="courseContent">
                @if (isset($chapterArr) && !empty($chapterArr))
                    @foreach ($chapterArr as $key => $book)
                        <div class="accordion-item {{ $key == 0 ? 'active' : '' }} mb-0"
                            style="border: solid 1px #80808073;border-radius: 2px;">
                            <div class="accordion-header" id="heading_{{ $key }}">
                                <button type="button" class="accordion-button " data-bs-toggle="collapse"
                                    data-bs-target="#{{ $key }}" aria-expanded="true"
                                    aria-controls="{{ $key }}">
                                    <span class="d-flex flex-column">
                                        <span class="h5 mb-0">{{ $book['name'] }}</span>
                                    </span>
                                </button>
                            </div>
                            <div id="{{ $key }}"
                                class="accordion-collapse collapse {{ $key == 0 ? 'show' : '' }} "
                                data-bs-parent="#courseContent">
                                @if (array_key_exists('unit', $book))
                                    @foreach ($book['unit'] as $key1 => $units)
                                        <div class="accordion-item {{ $key1 == 0 ? 'active' : '' }} mb-0">
                                            <div class="accordion-header" id="heading_{{ $key1 }}">
                                                <button type="button" class="accordion-button " data-bs-toggle="collapse"
                                                    style="background: #8080802b;  border: solid 1px #80808026; border-radius: 2px;"
                                                    data-bs-target="#{{ $key1 }}" aria-expanded="true"
                                                    aria-controls="{{ $key1 }}">
                                                    <span class="d-flex flex-column">
                                                        <span class="h5 mb-0">{{ $units['name'] }}</span>
                                                    </span>
                                                </button>
                                            </div>
                                            <div id="{{ $key1 }}"
                                                class="accordion-collapse collapse {{ $key1 == 0 ? 'show' : '' }} "
                                                data-bs-parent="#{{ $key }}">
                                                @if (array_key_exists('topic', $units))
                                                    @foreach ($units['topic'] as $key2 => $topic)
                                                        <div class="accordion-item {{ $key2 == 0 ? 'active' : '' }} mb-0">
                                                            <div class="accordion-header" id="heading_{{ $key2 }}">
                                                                <button type="button" class="accordion-button "
                                                                    data-bs-toggle="collapse"
                                                                    data-bs-target="#{{ $key2 }}"
                                                                    aria-expanded="true"
                                                                    aria-controls="{{ $key2 }}">
                                                                    <span class="d-flex flex-column">
                                                                        <span class="h5 mb-0">{{ $topic['name'] }}</span>
                                                                    </span>
                                                                </button>
                                                            </div>
                                                            <div id="{{ $key2 }}"
                                                                class="accordion-collapse collapse {{ $key2 == 0 ? 'show' : '' }} "
                                                                data-bs-parent="#{{ $key1 }}">
                                                                <div class="accordion-body py-4">
                                                                    <a href="javascript:void(0)"
                                                                        onclick="getVideo({{ $topic['syllabus']['id'] }})">
                                                                        <div
                                                                            class="form-check d-flex align-items-center gap-1 mb-4">
                                                                            <i class="ti ti-eye"></i>
                                                                            <label for="defaultCheck1"
                                                                                class="form-check-label ms-4">
                                                                                <span class="mb-0 h6">1.
                                                                                    {{ $topic['syllabus']['name'] }}</span>
                                                                            </label>
                                                                        </div>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @else
                                                    <div class="accordion-body py-4">
                                                        <a href="javascript:void(0)"
                                                            onclick="getVideo({{ $units['syllabus']['id'] }})">
                                                            <div class="form-check d-flex align-items-center gap-1 mb-4">
                                                                <i class="ti ti-eye"></i>
                                                                <label for="defaultCheck1" class="form-check-label ms-4">
                                                                    <span class="mb-0 h6">1.
                                                                        {{ $units['syllabus']['name'] }}</span>
                                                                </label>
                                                            </div>
                                                        </a>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="accordion-body py-4">
                                        <a href="javascript:void(0)" onclick="getVideo({{ $book['syllabus']['id'] }})">
                                            <div class="form-check d-flex align-items-center gap-1 mb-4">
                                                <i class="ti ti-eye"></i>
                                                <label for="defaultCheck1" class="form-check-label ms-4">
                                                    <span class="mb-0 h6">1. {{ $book['syllabus']['name'] }}</span>
                                                </label>
                                            </div>
                                        </a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="accordion-item  mb-0" style="border: solid 1px #80808073;border-radius: 2px;">
                        <div class="accordion-header" id="heading_chapter_20">
                            <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse"
                                data-bs-target="#chapter_20" aria-expanded="false" aria-controls="chapter_20">
                                <span class="d-flex flex-column">
                                    <span class="h5 mb-0">{{ $allVideos[0]->name }}</span>
                                </span>
                            </button>
                        </div>
                        <div id="chapter_20" class="accordion-collapse collapse  " data-bs-parent="#courseContent">
                            <div class="accordion-body py-4">
                                <a href="javascript:void(0)" onclick="getNote({{ $allVideos[0]->id }})">
                                    <div class="form-check d-flex align-items-center gap-1 mb-4">
                                        <i class="ti ti-eye"></i>
                                        <label for="defaultCheck1" class="form-check-label ms-4">
                                            <span class="mb-0 h6">{{ $allVideos[0]->name }}</span>
                                        </label>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
        @endif
    </div>

    </div>
    <!-- / Content -->

@endsection

<script>
    function getVideo(id) {
        $.ajax({
            url: "/student/lms/video/link/" + id,
            type: 'get',
            success: function(res) {
                $('#chapter_name').text(res['video']['name'])
                $('#video_id').val(res['video']['id'])
                if (res['video']['video_type'] == 'link') {
                    $('#youtubelink').show();
                    $('#uploadedvideo').hide();
                    $('iframe').attr('src', res['video']['video_path']);
                } else {
                    $('#uploadedvideo').show();
                    $('#youtubelink').hide();
                    $('source').attr('src', "/" + res['video']['video_path'])
                }
                var questiondiv = '';
                $.each(res.videoQuestions,function(key,question){
                    questiondiv += `<div class="col-md-6" id="question_${question.id}">Raised by: ${question.student.first_name} ${question.student.last_name}<br>Issue at: ${question.time}<br><strong>Title:</strong>${question.title}<br><span><strong>Issue:</strong>${question.description}</span>
                        `+
                            $.each(question.answer,function(key1,answer){
                                `<div style="margin-left: 50px;" id="answerId_${answer.id}">
                                <strong>Answered by: </strong> ${answer.student.first_name} ${answer.student.last_name}<br>
                                <strong>Answer: </strong> ${answer.answer}
                            </div>`
                            })
                        +`    
                            <p style="display: inline-flex;"><input type="text" class="form-control" name="answer[${question.id}]" id="answer_${question.id}"><button class="btn btn-primary" style="width:50px;" onclick="saveReply(${question.id})">Reply</button></p></div>`;
                });
                $('#messages').html(questiondiv);
            }
        });
    }
    function addQuestion()
    {
        var video_id = $('#video_id').val();
        $.ajax({
            url:"/student/question/create/"+video_id,
            type:'get',
            success:function(res)
            {
                $('#modal-xl-content').html(res);
                $('#modal-xl').modal('show');
            }
        })
    }
    function saveReply(questionId)
    {
        var answer = $('#answer_'+questionId).val();
        if(answer && answer!='')
        {
            $.ajax({
                url:'/student/answer/store',
                type:'post',
                data:{answer:answer,_token:"{{csrf_token()}}",questionId:questionId},
                success:function(response)
                {
                    var answer = `
                        <div style="margin-left: 50px;" id="answerId_${response['data']['answer_id']}">
                            <strong>Answered by: </strong> ${response['data']['userData']['first_name']} ${response['data']['userData']['last_name']}<br>
                            <strong>Answer: </strong> ${response['data']['answer']}
                        </div>
                    `;
                    $('#answer_'+questionId).parent().before(answer);
                    $('#answer_'+questionId).val('');
                }
            })
        }
    }
    document.addEventListener('DOMContentLoaded', function () {
    window.Echo.channel('question').listen('MessageSent', (response) => {
            console.log(response);
            console.log("question");
            
            const messages = document.getElementById('messages');
            const messageElement = document.createElement('div');
            messageElement.innerHTML = ` <div class="col-md-6" id="question_${response.question_id}">Raised by: ${response.studentName} <br>issue at: ${response.time}<br><strong>Title:</strong>${response.title}<br><span><strong>Issue:</strong>${JSON.parse(response.description)}</span>
                <p style="display: inline-flex;"><input type="text" class="form-control" name="answer[${response.question_id}]" id="answer_${response.question_id}"><button class="btn btn-primary" style="width:50px;" onclick="saveReply(${response.question_id})">Reply</button></p>
                </div>`;
            messages.appendChild(messageElement);
        });
    window.Echo.channel('answer').listen('AnswerSent', (response1) => {
                    var answer = `
                        <div style="margin-left: 50px;" id="answerId_${response1['answerData']['answer_id']}">
                            <strong>Answered by: </strong> ${response1['answerData']['userData']['first_name']} ${response1['answerData']['userData']['last_name']}<br>
                            <strong>Answer: </strong> ${response1['answerData']['answer']}
                        </div>
                    `;
                    $('#answer_'+response1['answerData']['questions_id']).parent().before(answer);
        });

});
     
</script>
