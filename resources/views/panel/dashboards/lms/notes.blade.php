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
@endsection

@section('content')
@include('layouts.sections.menu.studentHorizontalMenu')
    <div class="row g-6">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center flex-wrap mb-6 gap-2">
                        <div class="me-1">
                            <h5 class="mb-0">My Notes</h5>
                            {{-- <p class="mb-0">Prof. <span class="fw-medium text-heading"> Devonne Wallbridge </span></p> --}}
                        </div>
                        {{-- <div class="d-flex align-items-center">
            <span class="badge bg-label-danger">UI/UX</span>
            <i class='ti ti-share ti-lg mx-4'></i>
            <i class='ti ti-bookmarks ti-lg'></i>
          </div> --}}
                    </div>
                    {{-- {{dd($allNotes[0]->file_path)}} --}}
                    @if (!empty($allNotes) && $allNotes->count())
                        <div class="card academy-content shadow-none border">
                            <div class="p-2">
                                <div class="cursor-pointer">
                                    <iframe class="w-100" src="/{{ $allNotes[0]->file_path }}" id="plyr-video-player"
                                        frameborder="0"></iframe>
                                </div>
                            </div>
                            {{-- <div class="card-body pt-4">
                                <h5>About this course</h5>
                                <p class="mb-0">Learn web design in 1 hour with 25+ simple-to-use rules and guidelines — tons
                                of amazing web design resources included!</p>
                                <hr class="my-6">
                                <h5>By the numbers</h5>
                                <div class="d-flex flex-wrap row-gap-2">
                                <div class="me-12">
                                    <p class="text-nowrap mb-2"><i class='ti ti-check me-2 align-bottom'></i>Skill level: All Levels</p>
                                    <p class="text-nowrap mb-2"><i class='ti ti-users me-2 align-top'></i>Students: 38,815</p>
                                    <p class="text-nowrap mb-2"><i class='ti ti-world me-2 align-bottom'></i>Languages: English</p>
                                    <p class="text-nowrap mb-0"><i class='ti ti-file me-2 align-bottom'></i>Captions: Yes</p>
                                </div>
                                <div>
                                    <p class="text-nowrap mb-2"><i class='ti ti-video me-2 align-top ms-50'></i>Lectures: 19</p>
                                    <p class="text-nowrap mb-0"><i class='ti ti-clock me-2 align-top'></i>Video: 1.5 total hours</p>
                                </div>
                                </div>
                                <hr class="my-6">
                                <h5>Description</h5>
                                <p class="mb-6">
                                The material of this course is also covered in my other course about web design and development
                                with HTML5 & CSS3. Scroll to the bottom of this page to check out that course, too!
                                If you're already taking my other course, you already have all it takes to start designing beautiful
                                websites today!
                                </p>
                                <p class="mb-6">
                                "Best web design course: If you're interested in web design, but want more than
                                just a "how to use WordPress" course,I highly recommend this one." — Florian Giusti
                                </p>
                                <p> "Very helpful to us left-brained people: I am familiar with HTML, CSS, JQuery,
                                and Twitter Bootstrap, but I needed instruction in web design. This course gave me practical,
                                impactful techniques for making websites more beautiful and engaging." — Susan Darlene Cain
                                </p>
                                <hr class="my-6">
                                <h5>Instructor</h5>
                                <div class="d-flex justify-content-start align-items-center user-name">
                                <div class="avatar-wrapper">
                                    <div class="avatar me-4"><img src="../../assets/img/avatars/11.png" alt="Avatar" class="rounded-circle"></div>
                                </div>
                                <div class="d-flex flex-column">
                                    <h6 class="mb-1">Devonne Wallbridge</h6>
                                    <small>Web Developer, Designer, and Teacher</small>
                                </div>
                                </div>
                            </div> --}}
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="accordion stick-top accordion-custom-button" id="courseContent">
                @if (isset($chapterArr) && !empty($chapterArr) && count($chapterArr)>0)
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
                            <div id="{{ $key }}" class="accordion-collapse collapse {{ $key == 0 ? 'show' : '' }} "
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
                                                                        onclick="getNote({{ $topic['syllabus']??$topic['syllabus']['id'] }})">
                                                                        <div
                                                                            class="form-check d-flex align-items-center gap-1 mb-4">
                                                                            <i class="ti ti-eye"></i>
                                                                            <label for="defaultCheck1"
                                                                                class="form-check-label ms-4">
                                                                                <span class="mb-0 h6">1.
                                                                                    {{ $topic['syllabus']??$topic['syllabus']['name'] }}</span>
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
                                                            onclick="getNote({{ $units['syllabus']??$units['syllabus']['id'] }})">
                                                            <div class="form-check d-flex align-items-center gap-1 mb-4">
                                                                <i class="ti ti-eye"></i>
                                                                <label for="defaultCheck1" class="form-check-label ms-4">
                                                                    <span class="mb-0 h6">1.
                                                                        {{ $units['syllabus']??$units['syllabus']['name'] }}</span>
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
                                        <a href="javascript:void(0)" onclick="getNote({{ array_key_exists('syllabus',$book)??$book['syllabus']['id'] }})">
                                            <div class="form-check d-flex align-items-center gap-1 mb-4">
                                                <i class="ti ti-eye"></i>
                                                <label for="defaultCheck1" class="form-check-label ms-4">
                                                    <span class="mb-0 h6">1. {{ array_key_exists('syllabus',$book)??$book['syllabus']['name'] }}</span>
                                                </label>
                                            </div>
                                        </a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                @else
                @if (!empty($allNotes) && $allNotes->count()>0)
                    <div class="accordion-item  mb-0" style="border: solid 1px #80808073;border-radius: 2px;">
                        <div class="accordion-header" id="heading_chapter_20">
                            <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse"
                                data-bs-target="#chapter_20" aria-expanded="false" aria-controls="chapter_20">
                                <span class="d-flex flex-column">
                                    <span class="h5 mb-0">{{$allNotes[0]->name}}</span>
                                </span>
                            </button>
                        </div>
                        <div id="chapter_20" class="accordion-collapse collapse  " data-bs-parent="#courseContent">
                            <div class="accordion-body py-4">
                                <a href="javascript:void(0)" onclick="getNote({{$allNotes[0]->id}})">
                                    <div class="form-check d-flex align-items-center gap-1 mb-4">
                                        <i class="ti ti-eye"></i>
                                        <label for="defaultCheck1" class="form-check-label ms-4">
                                            <span class="mb-0 h6">{{$allNotes[0]->name}}</span>
                                        </label>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                @endif
                @endif
            </div>
        </div>
    </div>



    </div>
    <!-- / Content -->
@endsection
<script>
    function getNote(id) {
        $.ajax({
            url: "/student/lms/note/link/" + id,
            type: 'get',
            success: function(res) {
                $('iframe').attr('src', '/' + res.file_path);
            }
        })
    }
</script>
