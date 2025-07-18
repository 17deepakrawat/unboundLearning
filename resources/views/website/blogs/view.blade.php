@php
$configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Blogs')

<!-- Vendor Styles -->
@section('vendor-style')
@vite([
'resources/assets/vendor/libs/nouislider/nouislider.scss',
'resources/assets/vendor/libs/swiper/swiper.scss'
])
@endsection

<!-- Page Styles -->
@section('page-style')
@vite(['resources/assets/vendor/scss/pages/front-page-landing.scss'])
@endsection


<!-- Vendor Scripts -->
@section('vendor-script')
@vite([
'resources/assets/vendor/libs/nouislider/nouislider.js',
'resources/assets/vendor/libs/swiper/swiper.js'
])

@endsection


@section('page-script')
@vite(['resources/assets/js/front-page.js'])

@endsection


@section('content')


<section class="breadcrumb-py webiste-bg pb-5">
    <div class="container">
        <nav aria-label="breadcrumb ">
            <ol class="breadcrumb mx-3 my-4">
                <li class="breadcrumb-item" style="margin-top: 1.5px;">
                    <a href="/" class="course_bl text-dark fw-bold"><i class="ti ti-home"></i></a>
                </li>
                <li class="breadcrumb-item mt-1">
                    <a href="/course" class="course_bl text-dark fw-bold">Blogs</a>
                </li>
                <li class="breadcrumb-item mt-1">
                    <a href="/course" class="text-black fw-bold"> Name</a>
                </li>
            </ol>
        </nav>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <!-- <img src="../../assets/img/elements/4.jpg" class="card-img-top" alt=""> -->
                        <div class="coure-img-main text-center">
                            <img src="../../assets/img/elements/4.jpg" alt="" class="card-img-top  img-fluid">
                        </div>
                        <div class="row px-0 px-lg-4">
                            <div class="col-lg-8 col-xl-8 col-md-12 col-sm-12 course_bl  mt-2">
                                <p class="h2 course_bl blog_title-sm">Lorem ipsum dolor sit amet consectetur adipisicing elit. Aspernatur, saepe!</p>
                                <p class="text-justify">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quod necessitatibus, animi commodi mollitia recusandae distinctio vitae, illum nobis eos amet molestias excepturi in reiciendis. Quae quos aspernatur reiciendis fugiat ab officiis aliquid maxime ipsum voluptates. Minus provident eveniet eaque? Ratione fuga adipisci hic, dicta necessitatibus veniam earum, numquam iusto amet debitis quod, maiores suscipit magnam sapiente! Laudantium dolorem voluptate reiciendis facere aliquid eaque soluta tenetur obcaecati assumenda excepturi molestias perspiciatis consequatur a sed facilis sequi quia dolor voluptas dolorum, fugiat, aliquam dolores deserunt sit. Aspernatur tempore blanditiis impedit. Ipsum tempora facilis id incidunt velit assumenda expedita. Libero dignissimos vitae natus.</p>
                                <p class="text-justify">Lorem ipsum dolor sit amet consectetur adipisicing elit. Repellat repellendus voluptate, id itaque incidunt ipsam temporibus assumenda optio iusto excepturi nihil deleniti recusandae, aliquid nulla in autem voluptates? Dolorem natus, reiciendis cum, sapiente ab, quidem tempora praesentium exercitationem perspiciatis ex placeat reprehenderit? Obcaecati eius, iure ullam iusto aliquid pariatur dolores voluptatum officia rem facilis velit aperiam quod veniam molestiae consequuntur quae dolorum architecto ipsam cum odio fugiat labore eum? Quam suscipit ab, maxime soluta, cum earum quo pariatur illum amet ratione accusamus eum minima delectus maiores esse recusandae nulla in, sint dicta distinctio ipsa totam voluptatibus? Molestias, odio obcaecati. Earum.</p>
                                <p class="text-justify">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Iure provident soluta autem quam! Quasi magnam iste, fuga quia nulla sunt. Pariatur delectus eum, fugit vero iste expedita odio eligendi voluptates. Labore sequi dolor repellendus magnam ex id eligendi alias quas quaerat eaque, consequatur dolore animi tempora veniam voluptatibus magni provident cupiditate iste fugit, debitis omnis ut, similique beatae. Iusto, deserunt! Dolor sit nulla minima quos nihil! Incidunt, reiciendis autem, repellendus repellat veniam quas vel perspiciatis at, cupiditate quisquam blanditiis. Laudantium, earum sint. Quo in quia quidem consectetur autem eaque suscipit, repudiandae minus facere nobis temporibus assumenda sunt nam eius inventore pariatur facilis quaerat maxime enim non qui harum dolor? Sint, est quam odit fugiat asperiores provident consequatur omnis voluptatum facilis? Cupiditate ad quod aliquid numquam explicabo alias distinctio maiores temporibus asperiores consectetur! Voluptatem veniam expedita officia! Ullam nulla harum aliquam, delectus corporis ipsam nobis exercitationem atque consequuntur! Delectus, labore sint esse similique, aperiam veritatis quae illum cumque officiis architecto qui maiores harum laudantium neque! Odio porro, numquam omnis aliquam error, et enim minima suscipit veritatis ipsam, id vel illo aut aliquid hic sunt eaque reiciendis tempore eum in harum excepturi obcaecati fugit? Natus reiciendis nisi alias fugit. Veniam, possimus perferendis!</p>
                                <p class="text-justify">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatibus excepturi et impedit maxime dicta amet aspernatur cupiditate a nihil modi in harum ea maiores molestias ab doloribus, consectetur hic dolores repellat adipisci temporibus nobis iste magni necessitatibus? Adipisci cum sint commodi dolorum, itaque quibusdam, nobis, dolor necessitatibus fuga tenetur magni inventore illum recusandae. Fuga ea voluptatibus illum, esse autem ipsum, aut eos consequatur cupiditate, pariatur placeat eveniet! Voluptas perferendis sapiente eaque quibusdam maiores dicta delectus magni. Voluptatum et veritatis, esse ducimus nisi ipsam deserunt praesentium inventore vitae eius necessitatibus distinctio. Maxime, voluptates. Dolores iusto eveniet in, ad facilis corporis est.</p>
                                <p class="text-justify">Lorem ipsum dolor sit amet consectetur adipisicing elit. Ducimus repudiandae eos eius voluptatem earum dolorum, nulla excepturi minima, aut laborum, quo eaque consequatur fugiat nihil vero? Quas necessitatibus minus atque iusto error blanditiis autem repellendus nisi praesentium fugit esse libero vero hic consequuntur aliquid culpa exercitationem voluptate obcaecati nesciunt, dolorem officiis maxime iste. Molestias dolore temporibus sint tempora ducimus harum inventore architecto qui officiis, tenetur deleniti similique ut libero in nam tempore laboriosam laudantium, optio rerum pariatur, voluptates provident. Dicta ipsum ipsam, corporis aliquam, a accusantium explicabo quo dolore quasi tempore eum soluta omnis consequuntur quia dolores consequatur pariatur unde.</p>
                                <p class="text-justify">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Veniam sint aliquam fugit, eveniet dicta nostrum quas soluta nihil facere eligendi. Labore voluptate assumenda aut cupiditate placeat id corporis consectetur adipisci soluta doloribus harum accusantium cumque, tenetur deleniti, odit excepturi accusamus. Accusantium, veniam? Dolorem at repellendus voluptates esse impedit, expedita facere tempore omnis, laudantium ut eius illum nulla deleniti pariatur necessitatibus, ex iure quis autem quae totam dolores accusantium! Impedit reiciendis magni quo eveniet minus eius commodi recusandae perferendis tempore harum placeat iste modi soluta odio, earum possimus ab libero atque? Explicabo, temporibus enim. Ducimus porro ipsam quo iusto reprehenderit dolorem?</p>

                            </div>
                            <div class="col-lg-4 col-xl-4 col-md-12 col-sm-12 mt-3 center_s_blog">
                                <div class="card rececnt-sticy-blog">
                                    <div class="card-body">
                                        <div class="r-side-bar ">
                                            <div class="text-center">
                                                <p class="h4 fw-bold text-black course_bl">Recent Blogs</p>
                                            </div>
                                            <ul class="list-unstyled ">
                                                <li>
                                                    <div class=" rececnt-s-card mb-3">
                                                        <a href="/blog-details">
                                                            <div class="row g-0">
                                                                <div class="col-md-3">
                                                                    <img class="card-img card-img-left recent-md-img" src="../../assets/img/elements/9.jpg" alt="Card image">
                                                                </div>
                                                                <div class="col-md-9">
                                                                    <div class=" p-0 px-2 py-1">
                                                                        <h5 class="card-title mb-1 course_bl">Card title</h5>
                                                                        <p class="card-text mb-1 course_bl">
                                                                            Lorem ipsum dolor sit amet.
                                                                        </p>
                                                                        <p class="card-text mb-1"><small class="text-muted course_bl">Last updated 3 mins ago</small></p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class=" rececnt-s-card mb-3">
                                                        <a href="/blog-details">
                                                            <div class="row g-0">
                                                                <div class="col-md-3">
                                                                    <img class="card-img card-img-left recent-md-img" src="../../assets/img/elements/9.jpg" alt="Card image">
                                                                </div>
                                                                <div class="col-md-9">
                                                                    <div class=" p-0 px-2 py-1 course_bl">
                                                                        <h5 class="card-title mb-1">Card title</h5>
                                                                        <p class="card-text mb-1">
                                                                            Lorem ipsum dolor sit amet.
                                                                        </p>
                                                                        <p class="card-text mb-1"><small class="text-muted">Last updated 3 mins ago</small></p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class=" rececnt-s-card mb-3">
                                                        <a href="/blog-details">
                                                            <div class="row g-0">
                                                                <div class="col-md-3">
                                                                    <img class="card-img card-img-left recent-md-img" src="../../assets/img/elements/9.jpg" alt="Card image">
                                                                </div>
                                                                <div class="col-md-9">
                                                                    <div class=" p-0 px-2 py-1 course_bl">
                                                                        <h5 class="card-title mb-1">Card title</h5>
                                                                        <p class="card-text mb-1">
                                                                            Lorem ipsum dolor sit amet.
                                                                        </p>
                                                                        <p class="card-text mb-1"><small class="text-muted">Last updated 3 mins ago</small></p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class=" rececnt-s-card mb-3">
                                                        <a href="/blog-details">
                                                            <div class="row g-0">
                                                                <div class="col-md-3">
                                                                    <img class="card-img card-img-left recent-md-img" src="../../assets/img/elements/9.jpg" alt="Card image">
                                                                </div>
                                                                <div class="col-md-9">
                                                                    <div class=" p-0 px-2 py-1 course_bl">
                                                                        <h5 class="card-title mb-1">Card title</h5>
                                                                        <p class="card-text mb-1">
                                                                            Lorem ipsum dolor sit amet.
                                                                        </p>
                                                                        <p class="card-text mb-1"><small class="text-muted">Last updated 3 mins ago</small></p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class=" rececnt-s-card mb-3">
                                                        <a href="/blog-details">
                                                            <div class="row g-0">
                                                                <div class="col-md-3">
                                                                    <img class="card-img card-img-left recent-md-img" src="../../assets/img/elements/9.jpg" alt="Card image">
                                                                </div>
                                                                <div class="col-md-9 course_bl">
                                                                    <div class=" p-0 px-2 py-1">
                                                                        <h5 class="card-title mb-1">Card title</h5>
                                                                        <p class="card-text mb-1">
                                                                            Lorem ipsum dolor sit amet.
                                                                        </p>
                                                                        <p class="card-text mb-1"><small class="text-muted">Last updated 3 mins ago</small></p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class=" rececnt-s-card mb-3">
                                                        <a href="/blog-details">
                                                            <div class="row g-0">
                                                                <div class="col-md-3">
                                                                    <img class="card-img card-img-left recent-md-img" src="../../assets/img/elements/9.jpg" alt="Card image">
                                                                </div>
                                                                <div class="col-md-9 course_bl">
                                                                    <div class=" p-0 px-2 py-1">
                                                                        <h5 class="card-title mb-1">Card title</h5>
                                                                        <p class="card-text mb-1">
                                                                            Lorem ipsum dolor sit amet.
                                                                        </p>
                                                                        <p class="card-text mb-1"><small class="text-muted">Last updated 3 mins ago</small></p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
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
@endsection