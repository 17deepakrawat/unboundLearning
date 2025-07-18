@extends('layouts/studentLayoutMaster')

@section('title', 'Student | Dashboard')

@section('vendor-style')
    @vite(['resources/assets/vendor/libs/apex-charts/apex-charts.scss', 'resources/assets/vendor/libs/plyr/plyr.scss'])
@endsection

@section('vendor-script')
    @vite(['resources/assets/vendor/libs/apex-charts/apexcharts.js'])

@endsection
@include('panel.dashboards.lms.book-structure')
@section('page-script')

    @vite(['resources/assets/ebook/js/three_min.js'])
    {{-- @vite(['resources/assets/ebook/js/pdf_min.js']) --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.5.207/pdf.min.js"></script>
    @vite(['resources/assets/js/dashboards-crm.js'])
    <script type="module">
        window.PDFJS_LOCALE = {
            pdfJsWorker: 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.5.207/pdf.worker.min.js',
            pdfJsCMapUrl: 'cmaps'
        };
    </script>
    @vite(['resources/assets/ebook/js/edbook.js'])
    <script type="module">
        $(document).ready(function() {
            $('.sample-container').FlipBook({
                pdf: "{{ !empty($allEBooks)??$allEBooks[0]->file_path }}",
                template: function() {
                    return {
                        html: [{
                            url: '/assets/demo_book.html',
                            data: jsData.urls['/assets/demo_book.html']
                        }],
                        script: [{
                            url: '/assets/js/defualt_book.js',
                            data: jsData.urls['/assets/js/defualt_book.js']
                        }],
                        styles: [{
                            url: '/assets/css/default_book.css',
                            data: jsData.urls['/assets/css/default_book.css']
                        }, ],
                        init: undefined
                    };
                }
            });
        })
    </script>
@endsection

@section('content')
@include('layouts.sections.menu.studentHorizontalMenu')
    <div class="row g-6">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center flex-wrap mb-6 gap-2">
                        <div class="me-1">
                            <h5 class="mb-0">My E-Books</h5>
                        </div>
                    </div>
                    <div class="card academy-content shadow-none border">
                        <div class="p-2 ">
                            <div class="sample-container d-flex justify-content-center" style="height: 700px !important;">

                            </div>
                        </div>
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
                                                                        onclick="getEBook({{ $topic['syllabus']['id'] }})">
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
                                                            onclick="getEBook({{ $units['syllabus']['id'] }})">
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
                                        <a href="javascript:void(0)" onclick="getEBook({{ $book['syllabus']['id'] }})">
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
                                    <span class="h5 mb-0">{{ !empty($allEBooks)??$allEBooks[0]->name }}</span>
                                </span>
                            </button>
                        </div>
                        <div id="chapter_20" class="accordion-collapse collapse  " data-bs-parent="#courseContent">
                            <div class="accordion-body py-4">
                                <a href="javascript:void(0)" onclick="getEBook({{ !empty($allEBooks)??$allEBooks[0]->id }})">
                                    <div class="form-check d-flex align-items-center gap-1 mb-4">
                                        <i class="ti ti-eye"></i>
                                        <label for="defaultCheck1" class="form-check-label ms-4">
                                            <span class="mb-0 h6">{{ !empty($allEBooks)??$allEBooks[0]->name }}</span>
                                        </label>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12"></div>
    @endsection

    <script>
        function getEBook(id) {
            $.ajax({
                url: "/student/lms/ebook/link/" + id,
                type: 'get',
                success: function(res) {
                    $('.sample-container').FlipBook({
                        pdf: '/' + res.file_path,
                        template: function() {
                            return {
                                html: [{
                                    url: '/assets/demo_book.html',
                                    data: jsData.urls['/assets/demo_book.html']
                                }],
                                script: [{
                                    url: '/assets/js/defualt_book.js',
                                    data: jsData.urls['/assets/js/defualt_book.js']
                                }],
                                styles: [{
                                    url: '/assets/css/default_book.css',
                                    data: jsData.urls['/assets/css/default_book.css']
                                }, ],
                                init: undefined
                            };
                        }
                    });
                }
            })
        }
    </script>
