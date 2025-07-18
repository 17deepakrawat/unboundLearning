<section id="coursesSection" class="section-py bg-body landing-reviews pb-0">
        <div class="container">
            <h3 class="text-center mb-4">
                <span class="position-relative fw-bold z-1">Course
                    <img src="{{ asset('assets/img/front-pages/icons/section-title-icon.png') }}" alt=""
                        class="section-title-img position-absolute object-fit-contain bottom-0 z-n1">
                </span>
            </h3>
            <div class="row align-items-center gx-0 gy-4 g-lg-5">
                <div class="col-md-12 col-lg-12 col-xl-12">
                    <div class="swiper-reviews-carousel overflow-hidden mb-5 pb-md-2 pb-md-3">
                        <div class="swiper" id="swiper-program-types">
                            <div class="swiper-wrapper">
                                @foreach ($programTypes as $key => $programType)
                                    @php
                                        $content = !empty($programType->content)
                                            ? json_decode($programType->content, true)
                                            : [];
                                        $images = !empty($programType->images)
                                            ? json_decode($programType->images, true)
                                            : [];
                                    @endphp
                                    <div class="swiper-slide">
                                        <div class="card h-100">
                                            <div class="card-body p-2">
                                                <div class="bg-label-primary d-flex align-items-center justify-content-center rounded text-center mb-3 py-4"
                                                    style="{!! !empty($images) && array_key_exists(1, $images)
                                                        ? 'background: url(&#39;' . asset($images[1]) . '&#39;);background-repeat: no-repeat;background-size: cover;'
                                                        : '' !!} min-height: 190px; max-height: 190px;">
                                                    @if (empty($images))
                                                        <h3 class="mt-2 fs-16 fw-bolder text-truncate">
                                                            {{ $programType->name }}</h3>
                                                    @endif
                                                </div>
                                                <h6 class="fw-bold mb-0 p-0">{{ $programType->name }}</h6>
                                                <p class="small p-0 mt-2">{!! array_key_exists('section_1', $content)
                                                    ? Str::substr(strip_tags($content['section_1']), 0, 180) . '...'
                                                    : '' !!}</p>
                                                <a href="/program-types/{{ $programType->slug }}"
                                                    class="btn btn-primary w-100 waves-effect waves-light mt-3">Know
                                                    More <i class="ti ti-arrow-right ms-2"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="institutesAndBoardsSection" class="section-py">
        <div class="container">
            <h3 class="text-center mb-4">
                <span class="position-relative fw-bold z-1">Our Knowledge Partners
                    <img src="{{ asset('assets/img/front-pages/icons/section-title-icon.png') }}" alt=""
                        class="section-title-img position-absolute object-fit-contain bottom-0 z-n1">
                </span>
            </h3>
            <div class="row d-flex justify-content-center gy-3">
                @foreach ($verticals as $vertical)
                    <div class="col-12 col-sm-6 col-md-6 col-lg-3">
                        <div class="card border border-label-primary shadow-none">
                            <div class="card-body text-center">
                                <a href="/institutions-and-boards/{{ $vertical->slug }}">
                                    <img src="{{ asset($vertical->logo) }}" width="auto" height="85px"
                                        alt="{{ $vertical->name . ' (' . $vertical->vertical_name . ')' }}"
                                        class="ratio ratio-16x9 mb-3" />
                                    <h6 class="fw-medium fw-bold mb-0">
                                        {{ $vertical->short_name . ' (' . $vertical->vertical_name . ')' }}
                                    </h6>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section id="whySwayamVidyaSection" class="section-py bg-body-secondary">
        <div class="container">
            <div class="text-center mb-3 pb-1">
                <span class="badge bg-label-primary">Why {{ config('variables.templateName') }}</span>
            </div>
            @php
                $whatSetsUsApartContent = array_key_exists('what_sets_us_apart', $components)
                    ? $components['what_sets_us_apart']
                    : [
                        'heading' => 'What sets us apart',
                        'sub_heading' => 'Uniquely Distinct, Unmatched Excellence',
                        'card' => [
                            '1' => [
                                'icon' => 'ti ti-user-bolt',
                                'title' => 'Impartial Experts',
                                'description' => 'Trust our licensed counselors for expert advice.',
                            ],
                            '2' => [
                                'icon' => 'ti ti-users',
                                'title' => 'Total Assistance',
                                'description' =>
                                    'Comprehensive assistance will be extended throughout the duration leading to the successful completion of your degree.',
                            ],
                            '3' => [
                                'icon' => 'ti ti-clock-bolt',
                                'title' => 'Frequent Updates and Improvements',
                                'description' =>
                                    'Our courses receive regular content updates informed by valuable learner feedback.',
                            ],
                            '4' => [
                                'icon' => 'ti ti-wallet',
                                'title' => 'Inclusive and Affordable Education',
                                'description' =>
                                    'Committed to delivering top-notch education at an affordable rate, ensuring inclusivity for all.',
                            ],
                        ],
                    ];
                $title = explode(' ', $whatSetsUsApartContent['heading']);
            @endphp
            <h3 class="text-center mb-1">
                {{ implode(' ', array_slice($title, 0, -1)) }}
                <span class="position-relative fw-bold z-1"> {{ end($title) }}
                    <img src="{{ asset('assets/img/front-pages/icons/section-title-icon.png') }}" alt="laptop charging"
                        class="section-title-img position-absolute object-fit-contain bottom-0 z-n1">
                </span>
            </h3>
            <p class="text-center mb-3 mb-md-5 pb-3">
                {{ $whatSetsUsApartContent['sub_heading'] }}
            </p>
            <div class="row gy-4">
                <div class="col-lg-5 d-md-none d-lg-block">
                    <div class="text-center">
                        <img src="{{ asset('assets/img/website/home/why-sv.png') }}" alt="faq boy with logos"
                            width="100%" class="faq-image" />
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="features-icon-wrapper row gy-4">
                                <div class="col-lg-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="mb-3">
                                                @if (!empty($whatSetsUsApartContent['card'][1]['icon']))
                                                    <i class="{{ $whatSetsUsApartContent['card'][1]['icon'] }} ti-xl"></i>
                                                @elseif(!empty($whatSetsUsApartContent['card'][1]['image']))
                                                    <img src="{{ $whatSetsUsApartContent['card'][1]['image'] }}">
                                                @endif
                                            </div>
                                            <h5 class="mb-2">{{ $whatSetsUsApartContent['card'][1]['title'] }}</h5>
                                            <p class="features-icon-description">
                                                {{ $whatSetsUsApartContent['card'][1]['description'] }}
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="mb-3">
                                                @if (!empty($whatSetsUsApartContent['card'][2]['icon']))
                                                    <i class="{{ $whatSetsUsApartContent['card'][2]['icon'] }} ti-xl"></i>
                                                @elseif(!empty($whatSetsUsApartContent['card'][2]['image']))
                                                    <img src="{{ $whatSetsUsApartContent['card'][2]['image'] }}">
                                                @endif
                                            </div>
                                            <h5 class="mb-2">{{ $whatSetsUsApartContent['card'][2]['title'] }}</h5>
                                            <p class="features-icon-description">
                                                {{ $whatSetsUsApartContent['card'][2]['description'] }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-sm-none d-md-block mt-4"></div>
                            <div class="features-icon-wrapper row gy-4">
                                <div class="col-lg-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="mb-3">
                                                @if (!empty($whatSetsUsApartContent['card'][3]['icon']))
                                                    <i class="{{ $whatSetsUsApartContent['card'][3]['icon'] }} ti-xl"></i>
                                                @elseif(!empty($whatSetsUsApartContent['card'][3]['image']))
                                                    <img src="{{ $whatSetsUsApartContent['card'][3]['image'] }}">
                                                @endif
                                            </div>
                                            <h5 class="mb-2">{{ $whatSetsUsApartContent['card'][3]['title'] }}</h5>
                                            <p class="features-icon-description">
                                                {{ $whatSetsUsApartContent['card'][3]['description'] }}
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="mb-3">
                                                @if (!empty($whatSetsUsApartContent['card'][4]['icon']))
                                                    <i class="{{ $whatSetsUsApartContent['card'][4]['icon'] }} ti-xl"></i>
                                                @elseif(!empty($whatSetsUsApartContent['card'][4]['image']))
                                                    <img src="{{ $whatSetsUsApartContent['card'][4]['image'] }}">
                                                @endif
                                            </div>
                                            <h5 class="mb-2">{{ $whatSetsUsApartContent['card'][4]['title'] }}</h5>
                                            <p class="features-icon-description">
                                                {{ $whatSetsUsApartContent['card'][4]['description'] }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="infographySection" class="section-py landing-fun-facts">
        <div class="container">
            @php
                $statsComponent = array_key_exists('stats', $components)
                    ? $components['stats']
                    : [
                        'card' => [
                            '1' => [
                                'icon' => 'ti ti-building-bank',
                                'title' => '20+',
                                'description' => 'Educational Partner',
                            ],
                            '2' => ['icon' => 'ti ti-book-2', 'title' => '500+', 'description' => 'Courses Offered'],
                            '3' => [
                                'icon' => 'ti ti-user-check',
                                'title' => '25200+',
                                'description' => 'Enrolled Students',
                            ],
                            '4' => ['icon' => 'ti ti-school', 'title' => '11570+', 'description' => 'Alumni'],
                        ],
                    ];
            @endphp
            <div class="row gy-3">
                <div class="col-sm-6 col-lg-3">
                    <div class="card border border-label-primary shadow-none">
                        <div class="card-body text-center">
                            @if (!empty($statsComponent['card'][1]['icon']))
                                <i class="{{ $statsComponent['card'][1]['icon'] }} ti-xl"></i>
                            @elseif(!empty($statsComponent['card'][1]['image']))
                                <img src="{{ $statsComponent['card'][1]['image'] }}">
                            @endif
                            <h5 class="h2 mt-2 mb-1">{{ $statsComponent['card'][1]['title'] }}</h5>
                            <p class="fw-medium mb-0">
                                {{ $statsComponent['card'][1]['description'] }}
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="card border border-label-success shadow-none">
                        <div class="card-body text-center">
                            @if (!empty($statsComponent['card'][2]['icon']))
                                <i class="{{ $statsComponent['card'][2]['icon'] }} ti-xl"></i>
                            @elseif(!empty($statsComponent['card'][2]['image']))
                                <img src="{{ $statsComponent['card'][2]['image'] }}">
                            @endif
                            <h5 class="h2 mt-2 mb-1">{{ $statsComponent['card'][2]['title'] }}</h5>
                            <p class="fw-medium mb-0">
                                {{ $statsComponent['card'][2]['description'] }}
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="card border border-label-info shadow-none">
                        <div class="card-body text-center">
                            @if (!empty($statsComponent['card'][3]['icon']))
                                <i class="{{ $statsComponent['card'][3]['icon'] }} ti-xl"></i>
                            @elseif(!empty($statsComponent['card'][3]['image']))
                                <img src="{{ $statsComponent['card'][3]['image'] }}">
                            @endif
                            <h5 class="h2 mt-2 mb-1">{{ $statsComponent['card'][3]['title'] }}</h5>
                            <p class="fw-medium mb-0">
                                {{ $statsComponent['card'][3]['description'] }}
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="card border border-label-warning shadow-none">
                        <div class="card-body text-center">
                            @if (!empty($statsComponent['card'][4]['icon']))
                                <i class="{{ $statsComponent['card'][4]['icon'] }} ti-xl"></i>
                            @elseif(!empty($statsComponent['card'][4]['image']))
                                <img src="{{ $statsComponent['card'][4]['image'] }}">
                            @endif
                            <h5 class="h2 mt-2 mb-1">{{ $statsComponent['card'][4]['title'] }}</h5>
                            <p class="fw-medium mb-0">
                                {{ $statsComponent['card'][4]['description'] }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="reviewSection" class="section-py bg-body landing-reviews pb-0">
        @php
            $testimonials = array_key_exists('testimonials', $components)
                ? $components['testimonials']
                : [
                    'heading' => 'What students say',
                    'sub_heading' =>
                        'See what our customers have to<br class="d-none d-xl-block" />say about their experience.',
                    'card' => [],
                ];
        @endphp
        <div class="container">
            <div class="row align-items-center gx-0 gy-4 g-lg-5">
                <div class="col-md-6 col-lg-5 col-xl-3">
                    <div class="mb-3 pb-1">
                        <span class="badge bg-label-primary">Student Reviews</span>
                    </div>
                    <h3 class="mb-1">
                        <span class="position-relative fw-bold z-1">{{ $testimonials['heading'] }}
                            <img src="{{ asset('assets/img/front-pages/icons/section-title-icon.png') }}"
                                alt="laptop charging"
                                class="section-title-img position-absolute object-fit-contain bottom-0 z-n1">
                        </span>
                    </h3>
                    <p class="mb-3 mb-md-5">
                        {!! $testimonials['sub_heading'] !!}
                    </p>
                </div>
                <div class="col-md-6 col-lg-7 col-xl-9">
                    <div class="swiper-reviews-carousel overflow-hidden mb-5 pb-md-2 pb-md-3">
                        <div class="swiper" id="swiper-reviews">
                            <div class="swiper-wrapper">
                                @foreach ($testimonials['card'] as $testimonial)
                                    <div class="swiper-slide">
                                        <div class="card h-100">
                                            <div
                                                class="card-body text-body d-flex flex-column justify-content-between h-100">
                                                <p>
                                                    “{{ $testimonial['description'] }}”
                                                </p>
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar me-2 avatar-sm">
                                                        <img src="{{ asset('assets/img/avatars/student.png') }}"
                                                            alt="Avatar" class="rounded-circle" />
                                                    </div>
                                                    <div>
                                                        <h6 class="mb-0">{{ $testimonial['student']['name'] }}</h6>
                                                        <p class="small text-muted mb-0">
                                                            {{ $testimonial['student']['institute'] }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                            <div class="swiper-button-next"></div>
                            <div class="swiper-button-prev"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="coursesSection" class="section-py landing-reviews pb-0">
        <div class="container">
            <h3 class="text-center mb-4">
                <span class="position-relative fw-bold z-1">Our Trending Courses
                    <img src="{{ asset('assets/img/front-pages/icons/section-title-icon.png') }}" alt=""
                        class="section-title-img position-absolute object-fit-contain bottom-0 z-n1">
                </span>
            </h3>
            <div class="row align-items-center gx-0 gy-4 g-lg-5">
                <div class="col-md-12 col-lg-12 col-xl-12">
                    <div class="swiper-reviews-carousel overflow-hidden mb-5 pb-md-2 pb-md-3">
                        <div class="swiper" id="swiper-courses">
                            <div class="swiper-wrapper">
                                @foreach ($programs as $key => $program)
                                    <div class="swiper-slide">
                                        <div class="card mb-3">
                                            <a href="courses/{{ $program->slug }}">
                                                <div class="card-img-top">
                                                    <div class="col-md-12 text-center rounded-top bg-body-secondary p-4">
                                                        <h5 class="mt-3 fs-16 fw-bolder text-truncate">
                                                            {{ $program->name }}</h5>
                                                    </div>
                                                </div>
                                                <div class="card-body">
                                                    <h5 class="card-title fs-15 mb-1">{{ $program->name }}</h5>
                                                    <p class="fs-12 text-muted mb-0">
                                                        {{ implode(' | ', $program->programTypes->pluck('name')->toArray()) }}
                                                    </p>
                                                    <p class="fs-12 text-muted">{{ $program->duration }}</p>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="landingCTA" class="section-py landing-cta position-relative p-lg-0 pb-0">
        <img src="{{ asset('assets/img/front-pages/backgrounds/cta-bg-' . $configData['style'] . '.png') }}"
            class="position-absolute bottom-0 end-0 scaleX-n1-rtl h-100 w-100 z-n1" alt="cta image"
            data-app-light-img="front-pages/backgrounds/cta-bg-light.png"
            data-app-dark-img="front-pages/backgrounds/cta-bg-dark.png" />
        <div class="container">
            <div class="row align-items-center gy-5 gy-lg-0">
                <div class="col-lg-6 text-center text-lg-start">
                    <h6 class="h2 text-primary fw-bold mb-1">Ready to Get Started?</h6>
                    <p class="fw-medium mb-4">Start your project with a 14-day free trial</p>
                    <a href="{{ url('/front-pages/payment') }}" class="btn btn-lg btn-primary">Get Started</a>
                </div>
                <div class="col-lg-6 pt-lg-5 text-center text-lg-end">
                    <img src="{{ asset('assets/img/front-pages/landing-page/cta-dashboard.png') }}" alt="cta dashboard"
                        class="img-fluid" />
                </div>
            </div>
        </div>
    </section>

    <section id="" class="section-py landing-fun-facts">
        <div class="container">
            <h4 class="text-center fw-bolder mb-4">Approved
                <span class="position-relative fw-bold z-1">Online and Distance
                    <img src="{{ asset('assets/img/front-pages/icons/section-title-icon.png') }}" alt=""
                        class="section-title-img position-absolute object-fit-contain bottom-0 z-n1">
                </span>Education Universities
            </h4>
            <div class="row g-3 mt-4">
                @foreach ($onlineAndDistanceUniversities as $onlineAndDistanceUniversity)
                    <div class="col-3 col-sm-3 col-md-2 col-lg-2 text-center">
                        <a class="border border-1 rounded d-inline-block w-100 h-100 px-2" href="">
                            <span
                                style="box-sizing:border-box;display:inline-block;overflow:hidden;width:initial;height:initial;background:none;opacity:1;border:0;margin:0;padding:0;position:relative;max-width:100%">
                            </span>
                            <img class="my-2" alt="{{ $onlineAndDistanceUniversity->name }} logo"
                                src="{{ asset($onlineAndDistanceUniversity->image) }}" height="60px"
                                style="width: auto">
                            <p class="mb-1 text-secondary fs-12 text-truncate">{{ $onlineAndDistanceUniversity->name }}
                            </p>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
