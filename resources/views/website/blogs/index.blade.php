@php
    $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Blogs')

<!-- Vendor Styles -->
@section('vendor-style')
    @vite(['resources/assets/vendor/libs/nouislider/nouislider.scss', 'resources/assets/vendor/libs/swiper/swiper.scss'])
@endsection

<!-- Page Styles -->
@section('page-style')
    @vite(['resources/assets/vendor/scss/pages/front-page-landing.scss'])


@endsection
<style>

</style>
<!-- Vendor Scripts -->
@section('vendor-script')
    @vite(['resources/assets/vendor/libs/nouislider/nouislider.js', 'resources/assets/vendor/libs/swiper/swiper.js'])
@endsection

<!-- Page Scripts -->
@section('page-script')
    @vite(['resources/assets/js/front-page.js'])
@endsection
@section('content')
    <section class="breadcrumb-py  pb-5">
        <div class="container">
            <nav aria-label="breadcrumb ">
                <ol class="breadcrumb mx-3 my-4">
                </ol>
            </nav>
            <div class="row d-flex align-items-end justify-content-end text-end mb-3 ">

                <div class="col-md-5 d-flex flex-row justify-content-end" style="gap: 10px;">
                    @can('create blog-banner')
                        <a href="javascript:void(0)" onclick="add('{{ route('website.blog.adbanner.create') }}','modal-lg')" class="btn btn-primary">Add Ad Banner</a>
                    @endcan
                    @can('create blog-success-talk')
                        <a href="javascript:void(0)" onclick="add('{{ route('website.blog.success-talk.create') }}','modal-lg')"  class="btn btn-primary">Add Success Talk</a>
                    @endcan
                    @can('view website-blogs')
                        <a href="{{ route('website.content.create') }}" class="btn btn-primary">Add Blog</a>
                    @endcan
                </div>


            </div>
            <div class="row justify-content-center">

                @foreach ($blogs as $key => $value)
                    <div class="col-md-4 col-lg-4 col-xl-3 col-sm-12 mb-3">
                        <a href="{{ route('website.content.edit', [$value->slug]) }}">
                            <div class="card ">
                                <div class="card-body">
                                    <img class="img-fluid d-flex mx-auto mb-3 rounded blog_img"
                                        src="{{ asset($value->images ? json_decode($value->images, true)[1] : '') }}"
                                        alt="Card image cap ">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0 me-2">
                                            <span class="avatar-initial rounded text-primary"><i
                                                    class="ti ti-clock ti log-clock"></i></span>
                                        </div>
                                        <div>
                                            <h6 class="mb-0 text-nowrap course_bl"><small
                                                    class="course_bl">{{ $value->created_at }}</small></h6>
                                        </div>
                                    </div>
                                    <h5 class="card-title mb-1 fw-bold course_bl">{{ $value->name }}</h5>
                                    <p class="card-text course_bl">
                                        {{ Str::limit(json_decode($value->content, true)['meta']['description']) }}</p>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>




@endsection
