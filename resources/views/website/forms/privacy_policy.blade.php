@extends('layouts/layoutFront')

<!-- Vendor Styles -->
@section('vendor-style')
    @vite(['resources/assets/vendor/libs/nouislider/nouislider.scss', 'resources/assets/vendor/libs/swiper/swiper.scss'])
@endsection

<!-- Page Styles -->
@section('page-style')
    @vite(['resources/assets/vendor/scss/pages/front-page-landing.scss', 'resources/assets/vendor/libs/toastr/toastr.scss', 'resources/assets/css/demo.css', 'resources/assets/vendor/scss/pages/ui-carousel.scss'])
    <style>
        p, strong, ::marker{
            color: black;
        }
    </style>
@endsection

<!-- Vendor Scripts -->
@section('vendor-script')
    @vite(['resources/assets/vendor/libs/nouislider/nouislider.js', 'resources/assets/vendor/libs/swiper/swiper.js', 'resources/assets/js/ui-carousel.js'])
@endsection

<!-- Page Scripts -->
@section('page-script')
    @vite(['resources/assets/js/front-page.js', 'resources/assets/vendor/libs/toastr/toastr.js'])
    <script type="module"></script>
@endsection

@section('content')
    <section class="">
        <div class="container terms_container">
            {{-- <div class="d-flex flex-row">
                <div class="terms_text_s"><span class="terms_text">Privacy Policy</span></div>
                <div class="terms_border_top"></div>
            </div> --}}
            <div class="">
                <div class="university_hr_sidebar_s"><span class="university_hr_sidebart">Privacy Policy</span></div>
                <div class="university_hr_sidebar"></div>
            </div>
            <div class="mt-2">
               <ol style="margin-bottom:0cm;margin-top:0cm;" start="1" type="1">
                    <li
                        style='margin-top:0cm;margin-right:0cm;margin-bottom:0cm;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;color:black;text-align:justify;border:none;'>
                        <strong><span style='font-family:"Arial",sans-serif;'>INTRODUCTION</span></strong>
                    </li>
                </ol>
                <p
                    style='margin-top:0cm;margin-right:0cm;margin-bottom:0cm;margin-left:36.0pt;font-size:11.0pt;font-family:"Calibri",sans-serif;text-align:justify;border:none;'>
                    <strong><span style='font-family:"Arial",sans-serif;color:black;'>&nbsp;</span></strong>
                </p>
                <p
                    style='margin-top:0cm;margin-right:0cm;margin-bottom:0cm;margin-left:36.0pt;font-size:11.0pt;font-family:"Calibri",sans-serif;text-align:justify;border:none;'>
                    <span style='font-size:16px;font-family:"Arial",sans-serif;'>We value your trust. In order to honour
                        that trust, Swayam vidya ( powered by Career line LLP) adheres to ethical standards in gathering,
                        using, and safeguarding any information you provide. This privacy policy governs your use of the
                        application &lsquo;Swayam vidya&apos; (&apos;Application&apos;), www.Swayam vidya.com
                        (&apos;Website&apos;) and the other associated applications, products, websites and services managed
                        by the Career line LLP</span><span
                        style='font-size:16px;line-height:107%;font-family:"Arial",sans-serif;'>.&nbsp;</span><span
                        style='font-family:"Arial",sans-serif;color:black;'>Please read this privacy policy
                        (&apos;Policy&apos;) carefully before using the Application, Website, our services and products,
                        along with the Terms of Use (&apos;ToU&apos;) provided on the Application and the Website. Your use
                        of the Website, Application, or services in connection with the Application, Website or products
                        (&apos;Services&apos;), or registrations with us through any modes or usage of any products
                        including through SD cards, tablets or other storage/transmitting device shall signify your
                        acceptance of this Policy and your agreement to be legally bound by the same. If you do not agree
                        with the terms of this Policy, do not use the Website, Application our products or avail any of our
                        Services.</span>
                </p>
                <p
                    style='margin-top:0cm;margin-right:0cm;margin-bottom:0cm;margin-left:36.0pt;font-size:11.0pt;font-family:"Calibri",sans-serif;text-align:justify;border:none;'>
                    <span style='font-family:"Arial",sans-serif;color:black;'>&nbsp;</span>
                </p>
                <p
                    style='margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:36.0pt;font-size:11.0pt;font-family:"Calibri",sans-serif;text-align:justify;border:none;'>
                    <span style='font-family:"Arial",sans-serif;color:black;'>Swayam Vidya (together with its subsidiaries,
                        and affiliates, hereinafter &quot;Swayam Vidya, &quot;us,&quot; &quot;we,&quot; &quot;our&quot; or
                        &quot;the Company&quot;) is committed to the security and management of personal data, to function
                        effectively and successfully for the benefit of our stakeholders who are primarily the students,
                        academicians, and the institutions. In doing so, it is essential that people&apos;s privacy is
                        protected through the lawful and appropriate means for handling the personal data. Therefore, we
                        have implemented this Privacy Policy (hereinafter referred to as &quot;Policy&quot;).</span>
                </p>
                <p
                    style='margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;text-align:justify;'>
                    <span style='font-family:"Arial",sans-serif;'>&nbsp;</span>
                </p>
                <ol style="margin-bottom:0cm;margin-top:0cm;" start="2" type="1">
                    <li
                        style='margin-top:0cm;margin-right:0cm;margin-bottom:0cm;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;color:black;text-align:justify;border:none;'>
                        <strong><span style='font-family:"Arial",sans-serif;'>PURPOSE</span></strong>
                    </li>
                </ol>
                <p
                    style='margin-top:0cm;margin-right:0cm;margin-bottom:0cm;margin-left:36.0pt;font-size:11.0pt;font-family:"Calibri",sans-serif;text-align:justify;border:none;'>
                    <span style='font-family:"Arial",sans-serif;color:black;'>&nbsp;</span>
                </p>
                <p
                    style='margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:36.0pt;font-size:11.0pt;font-family:"Calibri",sans-serif;text-align:justify;border:none;'>
                    <span style='font-family:"Arial",sans-serif;color:black;'>The purpose of this policy is to describe how
                        Swayam Vidya collects, uses, and shares information about you through our offline and online
                        interfaces (e.g., websites and mobile applications) owned and controlled by us, including but not
                        limited to
                        https:&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;..(hereinafter
                        the &quot;website&quot; or &quot;platform&quot;). This policy is also designed to provide
                        information on how Swayam Vidya ensures data security, conducts disclosures to third parties and
                        process requests from the Data Principals.</span>
                </p>
                <p
                    style='margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;text-align:justify;'>
                    <span style='font-family:"Arial",sans-serif;'>&nbsp;</span>
                </p>
                <ol style="margin-bottom:0cm;margin-top:0cm;" start="3" type="1">
                    <li
                        style='margin-top:0cm;margin-right:0cm;margin-bottom:0cm;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;color:black;text-align:justify;border:none;'>
                        <strong><span style='font-family:"Arial",sans-serif;'>SCOPE</span></strong>
                    </li>
                </ol>
                <p
                    style='margin-top:0cm;margin-right:0cm;margin-bottom:0cm;margin-left:36.0pt;font-size:11.0pt;font-family:"Calibri",sans-serif;text-align:justify;border:none;'>
                    <span style='font-family:"Arial",sans-serif;color:black;'>&nbsp;</span>
                </p>
                <p
                    style='margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:36.0pt;font-size:11.0pt;font-family:"Calibri",sans-serif;text-align:justify;border:none;'>
                    <span style='font-family:"Arial",sans-serif;color:black;'>This Policy applies to all website visitors,
                        including students, prospects, academia fraternity, affiliates and placement and loan partners. This
                        policy is intended to inform about how these stakeholders gather, use, disclose and manage the
                        related data information.</span>
                </p>
                <p
                    style='margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;text-align:justify;'>
                    <span style='font-family:"Arial",sans-serif;'>&nbsp;</span>
                </p>
                <ol style="margin-bottom:0cm;margin-top:0cm;" start="4" type="1">
                    <li
                        style='margin-top:0cm;margin-right:0cm;margin-bottom:0cm;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;color:black;text-align:justify;border:none;'>
                        <strong><span style='font-family:"Arial",sans-serif;'>PERSONAL DATA WE COLLECT</span></strong>
                    </li>
                </ol>
                <p
                    style='margin-top:0cm;margin-right:0cm;margin-bottom:0cm;margin-left:36.0pt;font-size:11.0pt;font-family:"Calibri",sans-serif;text-align:justify;border:none;'>
                    <span style='font-family:"Arial",sans-serif;color:black;'>&nbsp;</span>
                </p>
                <p
                    style='margin-top:0cm;margin-right:0cm;margin-bottom:0cm;margin-left:36.0pt;font-size:11.0pt;font-family:"Calibri",sans-serif;text-align:justify;border:none;'>
                    <span style='font-family:"Arial",sans-serif;color:black;'>We only collect relevant information about you
                        if we have a reason to do so-for example, to provide our Services on the Platform, to gauge your
                        interest for specific program/ institution, to communicate with you, to acquaint you with other
                        value added services amicable for your education progression, and also to ascertain feedback for
                        service improvisation.</span>
                </p>
              
                <p
                    style='margin-top:0cm;margin-right:0cm;margin-bottom:0cm;margin-left:36.0pt;font-size:11.0pt;font-family:"Calibri",sans-serif;text-align:justify;border:none;'>
                    <span style='font-family:"Arial",sans-serif;color:black;'>&nbsp;</span>
                </p>
                <div
                    style='margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;'>
                    <ul style="margin-bottom:0cm;">
                        <li
                            style='margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;'>
                            <span style='font-family:"Arial",sans-serif;color:black;'>Information we collect from
                                you.</span>
                        </li>
                    </ul>
                </div>
                <p
                    style='margin-top:0cm;margin-right:0cm;margin-bottom:0cm;margin-left:36.0pt;font-size:11.0pt;font-family:"Calibri",sans-serif;text-align:justify;border:none;'>
                    <span style='font-family:"Arial",sans-serif;color:black;'>&nbsp;</span>
                </p>
                <div
                    style='margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;'>
                    <ol style="margin-bottom:0cm;list-style-type: lower-alpha;margin-left: 26px;">
                        <li
                            style='margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;'>
                            <span style='font-family:"Arial",sans-serif;color:black;'>Basic Account Information: In order to
                                access certain features of the Platform, such as to book an expert career guidance session,
                                receive personalised recommendation(s), etc., you will need to create an account and
                                register with us. We ask for basic information which may include your Full Name, Email
                                address, Gender, State and City of residence and country of origin, Date of Birth, Phone/
                                Mobile Number, Education history, Job experience along with current Salary drawn if
                                any.</span>
                        </li>
                    </ol>
                </div>
                <p
                    style='margin-top:0cm;margin-right:0cm;margin-bottom:0cm;margin-left:36.0pt;font-size:11.0pt;font-family:"Calibri",sans-serif;text-align:justify;border:none;'>
                    <span style='font-family:"Arial",sans-serif;color:black;'>&nbsp;</span>
                </p>
                <div
                    style='margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;'>
                    <ol start="2" style="margin-bottom:0cm;list-style-type: lower-alpha;margin-left: 26px;">
                        <li
                            style='margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;'>
                            <span style='font-family:"Arial",sans-serif;color:black;'>Information when you communicate with
                                us When you voluntarily write to us with a question or to ask for help, we will keep that
                                correspondence, and the Email Address, for future reference; this may also include any
                                Phone/ Mobile Numbers if you have provided us the same as part of your communication either
                                in writing (emails included), over a phone call or otherwise.</span>
                        </li>
                    </ol>
                </div>
                <p
                    style='margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;text-align:justify;'>
                    <span style='font-family:"Arial",sans-serif;'>&nbsp;</span>
                </p>
                <div
                    style='margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;'>
                    <ol start="3" style="margin-bottom:0cm;list-style-type: lower-alpha;margin-left: 26px;">
                        <li
                            style='margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;'>
                            <span style='font-family:"Arial",sans-serif;color:black;'>Information when you register for
                                different seminars, webinars, or other outreach efforts by us: When you register with us for
                                our outreach efforts, we ask for basic information which may include your Full Name, Email
                                address, Gender, State and City of residence and country of origin, Date of Birth, Phone/
                                Mobile Number, Education history, Job experience along with current Salary drawn if
                                any.</span>
                        </li>
                    </ol>
                </div>
                <p
                    style='margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;text-align:justify;'>
                    <span style='font-family:"Arial",sans-serif;'>&nbsp;</span>
                </p>
                <div
                    style='margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;'>
                    <ol start="4" style="margin-bottom:0cm;list-style-type: lower-alpha;margin-left: 26px;">
                        <li
                            style='margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;'>
                            <span style='font-family:"Arial",sans-serif;color:black;'>Information when you collaborate with
                                us for marketing videos, testimonials and social media posts: When you collaborate with us
                                as an affiliate, we ask for Full Name, Phone/ Mobile Number, Email ID, disclosure on past
                                brand associations, and Financial and commercial data including bank account details. We
                                also collect sensitive personal information from individual/company including PAN Card
                                Number, Aadhar Card Number, GST Certificate, and website address (if any).</span>
                        </li>
                    </ol>
                </div>
                <p
                    style='margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;text-align:justify;'>
                    <span style='font-family:"Arial",sans-serif;'>&nbsp;</span>
                </p>
                <div
                    style='margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;'>
                    <ul style="margin-bottom:0cm;">
                        <li
                            style='margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;'>
                            <span style='font-family:"Arial",sans-serif;color:black;'>Information we collect
                                automatically.</span>
                        </li>
                    </ul>
                </div>
                <p
                    style='margin-top:0cm;margin-right:0cm;margin-bottom:0cm;margin-left:36.0pt;font-size:11.0pt;font-family:"Calibri",sans-serif;text-align:justify;border:none;'>
                    <span style='font-family:"Arial",sans-serif;color:black;'>&nbsp;</span>
                </p>
                <div
                    style='margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;'>
                    <ol style="margin-bottom:0cm;list-style-type: lower-alpha;margin-left: 26px;">
                        <li
                            style='margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;'>
                            <span style='font-family:"Arial",sans-serif;color:black;'>Device and Log information: When you
                                access our Platform, we collect information that web browsers, mobile devices, and servers
                                typically make available, including the browser type, IP address, unique device identifiers,
                                language preference, referring site, the date and time of access, operating system, and
                                mobile network information. We collect log information when you use our Platform -for
                                example, when you create or make changes to your account information
                                on&nbsp;the&nbsp;Platform.</span>
                        </li>
                    </ol>
                </div>
                <p
                    style='margin-top:0cm;margin-right:0cm;margin-bottom:0cm;margin-left:36.0pt;font-size:11.0pt;font-family:"Calibri",sans-serif;text-align:justify;border:none;'>
                    <span style='font-family:"Arial",sans-serif;color:black;'>&nbsp;</span>
                </p>
                <div
                    style='margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;'>
                    <ol start="2" style="margin-bottom:0cm;list-style-type: lower-alpha;margin-left: 26px;">
                        <li
                            style='margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;'>
                            <span style='font-family:"Arial",sans-serif;color:black;'>Usage information: We collect
                                information about your usage of our Platform. We also collect information about what happens
                                when you use our Platform (e.g, page views, interactions with other parts of our Services)
                                along with information about your Supported Device (e.g, mobile device manufacturer). We use
                                this information to provide our Platform to you, get insights on how people use our Platform
                                so that we can make our Platform better, and understand and make predictions about user
                                retention and interest showcased.</span>
                        </li>
                    </ol>
                </div>
                <p
                    style='margin-top:0cm;margin-right:0cm;margin-bottom:0cm;margin-left:36.0pt;font-size:11.0pt;font-family:"Calibri",sans-serif;text-align:justify;border:none;'>
                    <span style='font-family:"Arial",sans-serif;color:black;'>&nbsp;</span>
                </p>
                <p
                    style='margin-top:0cm;margin-right:0cm;margin-bottom:0cm;margin-left:36.0pt;font-size:11.0pt;font-family:"Calibri",sans-serif;text-align:justify;border:none;'>
                    <span style='font-family:"Arial",sans-serif;color:black;'>&nbsp;</span>
                </p>
                <div
                    style='margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;'>
                    <ol start="3" style="margin-bottom:0cm;list-style-type: lower-alpha;margin-left: 26px;">
                        <li
                            style='margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;'>
                            <span style='font-family:"Arial",sans-serif;color:black;'>Information from Cookies &amp; other
                                technologies: We may collect information about you through the use of cookies and other
                                similar technologies. A cookie is a string of information that a website stores on a
                                visitor&apos;s computer, and that the visitor&apos;s browser provides to the website each
                                time the visitor returns.</span>
                        </li>
                    </ol>
                </div>
                <p
                    style='margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;text-align:justify;'>
                    <span style='font-family:"Arial",sans-serif;'>&nbsp;</span>
                </p>
                <div
                    style='margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;'>
                    <ul style="margin-bottom:0cm;">
                        <li
                            style='margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;'>
                            <span style='font-family:"Arial",sans-serif;color:black;'>Information we collect from other
                                sources: We collect relevant information from third parties/ vendors/ referral which may
                                include Full Name, Email ID and Phone/&nbsp;Mobile&nbsp;Number.</span>
                        </li>
                    </ul>
                </div>
                <p
                    style='margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;text-align:justify;'>
                    <span style='font-family:"Arial",sans-serif;'>&nbsp;</span>
                </p>
                <ol style="margin-bottom:0cm;margin-top:0cm;" start="5" type="1">
                    <li
                        style='margin-top:0cm;margin-right:0cm;margin-bottom:0cm;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;color:black;text-align:justify;border:none;'>
                        <strong><span style='font-family:"Arial",sans-serif;'>HOW WE USE YOUR PERSONAL DATA</span></strong>
                    </li>
                </ol>
                <p
                    style='margin-top:0cm;margin-right:0cm;margin-bottom:0cm;margin-left:36.0pt;font-size:11.0pt;font-family:"Calibri",sans-serif;text-align:justify;border:none;'>
                    <span style='font-family:"Arial",sans-serif;color:black;'>&nbsp;</span>
                </p>
                <p
                    style='margin-top:0cm;margin-right:0cm;margin-bottom:0cm;margin-left:36.0pt;font-size:11.0pt;font-family:"Calibri",sans-serif;text-align:justify;border:none;'>
                    <span style='font-family:"Arial",sans-serif;color:black;'>We may collect, hold, use, and disclose
                        information for the following purposes including but not limited to following, and personal
                        information will not be further processed in a manner that is incompatible with these
                        purposes:</span>
                </p>
                <p
                    style='margin-top:0cm;margin-right:0cm;margin-bottom:0cm;margin-left:36.0pt;font-size:11.0pt;font-family:"Calibri",sans-serif;text-align:justify;border:none;'>
                    <span style='font-family:"Arial",sans-serif;color:black;'>&nbsp;</span>
                </p>
                <ul style="list-style-type: undefined margin-left: 26px;">
                    <li><span style='font-family:"Arial",sans-serif;color:black;'>To provide you with our platform&apos;s
                            core features and services in accordance with the legal &amp; contractual obligations.</span>
                    </li>
                    <li><span style='font-family:"Arial",sans-serif;color:black;'>To enable you to customize or personalize
                            your experience of our website.</span></li>
                    <li><span style='font-family:"Arial",sans-serif;color:black;'>To contact and communicate with
                            you.</span></li>
                    <li><span style='font-family:"Arial",sans-serif;color:black;'>Improving our products and
                            services.</span></li>
                    <li><span style='font-family:"Arial",sans-serif;color:black;'>Managing our operations with other
                            companies that provide services to us and our customers.</span></li>
                    <li><span style='font-family:"Arial",sans-serif;color:black;'>Developing new ways to meet our
                            customers&apos; needs and grow our business.</span></li>
                    <li><span style='font-family:"Arial",sans-serif;color:black;'>Marketing and events - related
                            communication.</span></li>
                    <li><span style='font-family:"Arial",sans-serif;color:black;'>Identifying, investigating, reporting and
                            preventing fraud, money laundering and other crime.</span></li>
                    <li><span style='font-family:"Arial",sans-serif;color:black;'>Managing risk for us and our
                            Users.</span></li>
                    <li><span style='font-family:"Arial",sans-serif;color:black;'>Complying with laws, regulations and
                            statutory compliances</span></li>
                    <li><span style='font-family:"Arial",sans-serif;color:black;'>Investigating and responding to
                            complaints, feedback and suggestions.</span></li>
                </ul>
                <p
                    style='margin-top:0cm;margin-right:0cm;margin-bottom:0cm;margin-left:36.0pt;font-size:11.0pt;font-family:"Calibri",sans-serif;text-align:justify;border:none;'>
                    <span style='font-family:"Arial",sans-serif;color:black;'>&nbsp;</span>
                </p>
                <p
                    style='margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:36.0pt;font-size:11.0pt;font-family:"Calibri",sans-serif;text-align:justify;border:none;'>
                    <span style='font-family:"Arial",sans-serif;color:black;'>We may combine voluntarily provided and
                        automatically collated personal data with general information or research data we receive from other
                        trusted sources. For example, our marketing and market research activities may uncover data and
                        insights, which we may combine with information about how visitors use our website as a medium for
                        solicit information and how he/ her/ they experience their journey on&nbsp;our&nbsp;platform.</span>
                </p>
                <p
                    style='margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;text-align:justify;'>
                    <span style='font-family:"Arial",sans-serif;'>&nbsp;</span>
                </p>
                <p
                    style='margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;text-align:justify;'>
                    <span style='font-family:"Arial",sans-serif;'>&nbsp;</span>
                </p>
                <ol style="margin-bottom:0cm;margin-top:0cm;" start="6" type="1">
                    <li
                        style='margin-top:0cm;margin-right:0cm;margin-bottom:0cm;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;color:black;text-align:justify;border:none;'>
                        <strong><span style='font-family:"Arial",sans-serif;'>COMMUNICATIONS FROM THE
                                WEBSITE</span></strong>
                    </li>
                </ol>
                <p
                    style='margin-top:0cm;margin-right:0cm;margin-bottom:0cm;margin-left:36.0pt;font-size:11.0pt;font-family:"Calibri",sans-serif;text-align:justify;border:none;'>
                    <span style='font-family:"Arial",sans-serif;color:black;'>&nbsp;</span>
                </p>
                <p
                    style='margin-top:0cm;margin-right:0cm;margin-bottom:0cm;margin-left:36.0pt;font-size:11.0pt;font-family:"Calibri",sans-serif;text-align:justify;border:none;'>
                    <span style='font-family:"Arial",sans-serif;color:black;'>We may use your email address and mobile
                        number to send our newsletters and/or marketing communications. If you no longer wish to receive
                        these communications, you can opt out by following the instructions contained in the emails you
                        receive or by contacting us at
                        &hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;.</span>
                </p>
                <p
                    style='margin-top:0cm;margin-right:0cm;margin-bottom:0cm;margin-left:36.0pt;font-size:11.0pt;font-family:"Calibri",sans-serif;text-align:justify;border:none;'>
                    <span style='font-family:"Arial",sans-serif;color:black;'>&nbsp;</span>
                </p>
                <p
                    style='margin-top:0cm;margin-right:0cm;margin-bottom:0cm;margin-left:36.0pt;font-size:11.0pt;font-family:"Calibri",sans-serif;text-align:justify;border:none;'>
                    <span style='font-family:"Arial",sans-serif;color:black;'>We will send you announcements related to the
                        Service(s) on occasions when it is necessary to do so. For instance, if our Service is temporarily
                        suspended for maintenance, we might send you an email. Generally, you may not opt-out of
                        communications which are not promotional in nature. If you do not wish to receive them, you may
                        delete your Account or unsubscribe.</span>
                </p>
                <p
                    style='margin-top:0cm;margin-right:0cm;margin-bottom:0cm;margin-left:36.0pt;font-size:11.0pt;font-family:"Calibri",sans-serif;text-align:justify;border:none;'>
                    <span style='font-family:"Arial",sans-serif;color:black;'>&nbsp;</span>
                </p>
                <ol style="margin-bottom:0cm;margin-top:0cm;" start="7" type="1">
                    <li
                        style='margin-top:0cm;margin-right:0cm;margin-bottom:0cm;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;color:black;text-align:justify;border:none;'>
                        <strong><span style='font-family:"Arial",sans-serif;'>MINOR DATA</span></strong>
                    </li>
                </ol>
                <p
                    style='margin-top:0cm;margin-right:0cm;margin-bottom:0cm;margin-left:36.0pt;font-size:11.0pt;font-family:"Calibri",sans-serif;text-align:justify;border:none;'>
                    <span style='font-family:"Arial",sans-serif;color:black;'>&nbsp;</span>
                </p>
                <p
                    style='margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:36.0pt;font-size:11.0pt;font-family:"Calibri",sans-serif;text-align:justify;border:none;'>
                    <span style='font-family:"Arial",sans-serif;color:black;'>We do not collect or process personal data of
                        individuals below the age of 18.</span>
                </p>
                <p
                    style='margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;text-align:justify;'>
                    <span style='font-family:"Arial",sans-serif;'>&nbsp;</span>
                </p>
                <ol style="margin-bottom:0cm;margin-top:0cm;" start="8" type="1">
                    <li
                        style='margin-top:0cm;margin-right:0cm;margin-bottom:0cm;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;color:black;text-align:justify;border:none;'>
                        <strong><span style='font-family:"Arial",sans-serif;'>USE OF COOKIES</span></strong>
                    </li>
                </ol>
                <p
                    style='margin-top:0cm;margin-right:0cm;margin-bottom:0cm;margin-left:36.0pt;font-size:11.0pt;font-family:"Calibri",sans-serif;text-align:justify;border:none;'>
                    <strong><span style='font-family:"Arial",sans-serif;color:black;'>&nbsp;</span></strong>
                </p>
                <p
                    style='margin-top:0cm;margin-right:0cm;margin-bottom:0cm;margin-left:36.0pt;font-size:11.0pt;font-family:"Calibri",sans-serif;text-align:justify;border:none;'>
                    <span style='font-family:"Arial",sans-serif;color:black;'>We use &quot;cookies&quot; to collect
                        information about you and your activity across our website. A cookie is a small piece of data that
                        our website stores on your computer, and accesses each time you visit, so we can understand how you
                        use our site. This helps us serve you content based on preferences you have specified.</span>
                </p>
                <p
                    style='margin-top:0cm;margin-right:0cm;margin-bottom:0cm;margin-left:36.0pt;font-size:11.0pt;font-family:"Calibri",sans-serif;text-align:justify;border:none;'>
                    <strong><span style='font-family:"Arial",sans-serif;color:black;'>&nbsp;</span></strong>
                </p>
                <ol style="margin-bottom:0cm;margin-top:0cm;" start="9" type="1">
                    <li
                        style='margin-top:0cm;margin-right:0cm;margin-bottom:0cm;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;color:black;text-align:justify;border:none;'>
                        <strong><span style='font-family:"Arial",sans-serif;'>HOW LONG WE KEEP YOUR PERSONAL
                                DATA</span></strong>
                    </li>
                </ol>
                <p
                    style='margin-top:0cm;margin-right:0cm;margin-bottom:0cm;margin-left:36.0pt;font-size:11.0pt;font-family:"Calibri",sans-serif;text-align:justify;border:none;'>
                    <span style='font-family:"Arial",sans-serif;color:black;'>&nbsp;</span>
                </p>
                <p
                    style='margin-top:0cm;margin-right:0cm;margin-bottom:0cm;margin-left:36.0pt;font-size:11.0pt;font-family:"Calibri",sans-serif;text-align:justify;border:none;'>
                    <span style='font-family:"Arial",sans-serif;color:black;'>We uphold the principle of retaining your
                        personal information only for the duration necessary to fulfil its intended purpose, as outlined in
                        our privacy policy. If your personal information is no longer required for such purposes, we will
                        promptly delete it or anonymize it by removing any identifiable details.</span>
                </p>
                <p
                    style='margin-top:0cm;margin-right:0cm;margin-bottom:0cm;margin-left:36.0pt;font-size:11.0pt;font-family:"Calibri",sans-serif;text-align:justify;border:none;'>
                    <span style='font-family:"Arial",sans-serif;color:black;'>&nbsp;</span>
                </p>
                <p
                    style='margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:36.0pt;font-size:11.0pt;font-family:"Calibri",sans-serif;text-align:justify;border:none;'>
                    <span style='font-family:"Arial",sans-serif;color:black;'>Nevertheless, there are certain circumstances
                        where we may need to retain your personal information for legitimate business or legal reasons or
                        provide substantial evidence of record or exemplify the case study or learner&apos;s experience for
                        giving insight to learners&apos; fraternity at large. These may include obligations related to
                        compliance with applicable laws, accounting or reporting requirements, statistical analysis, which
                        also includes case studies etc. Additionally, certain data may be retained for extended periods to
                        fulfil purposes such as ensuring security, preventing fraud and abuse, or maintaining
                        financial&nbsp;records.</span>
                </p>
                <p
                    style='margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;text-align:justify;'>
                    <span style='font-family:"Arial",sans-serif;'>&nbsp;</span>
                </p>
                <ol style="margin-bottom:0cm;margin-top:0cm;" start="10" type="1">
                    <li
                        style='margin-top:0cm;margin-right:0cm;margin-bottom:0cm;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;color:black;text-align:justify;border:none;'>
                        <strong><span style='font-family:"Arial",sans-serif;'>YOUR RIGHTS AND CONTROLLING YOUR PERSONAL
                                DATA</span></strong>
                    </li>
                </ol>
                <p
                    style='margin-top:0cm;margin-right:0cm;margin-bottom:0cm;margin-left:36.0pt;font-size:11.0pt;font-family:"Calibri",sans-serif;text-align:justify;border:none;'>
                    <span style='font-family:"Arial",sans-serif;color:black;'>&nbsp;</span>
                </p>
                <p
                    style='margin-top:0cm;margin-right:0cm;margin-bottom:0cm;margin-left:36.0pt;font-size:11.0pt;font-family:"Calibri",sans-serif;text-align:justify;border:none;'>
                    <span style='font-family:"Arial",sans-serif;color:black;'>Individuals in India have certain statutory
                        rights in relates to their personal data.</span>
                </p>
                <p
                    style='margin-top:0cm;margin-right:0cm;margin-bottom:0cm;margin-left:36.0pt;font-size:11.0pt;font-family:"Calibri",sans-serif;text-align:justify;border:none;'>
                    <span style='font-family:"Arial",sans-serif;color:black;'>&nbsp;</span>
                </p>
                <ul style="list-style-type: undefined margin-left: 26px;">
                    <li><span style='font-family:"Arial",sans-serif;color:black;'>Right to Access Information about
                            Personal Data: The right to obtain confirmation of whether personal data is being processed and,
                            if so, to access that data</span></li>
                    <li><span style='font-family:"Arial",sans-serif;color:black;'>Right to Withdraw Consent: The right to
                            withdraw consent given for the processing of personal data at any time.</span></li>
                    <li><span style='font-family:"Arial",sans-serif;color:black;'>Right to Correction: The right to request
                            the correction or amendment of inaccurate or incomplete personal data.</span></li>
                    <li><span style='font-family:"Arial",sans-serif;color:black;'>Right to Erasure: The right to request
                            the deletion or removal of personal data under certain circumstances.</span></li>
                    <li><span style='font-family:"Arial",sans-serif;color:black;'>Right to Grievance Redressal: The right
                            to easily access grievance resolution mechanisms against any action or failure on the part of
                            Swayam Vidya related to their responsibilities concerning the personal data.</span></li>
                    <li><span style='font-family:"Arial",sans-serif;color:black;'>Right to Nominate: The right to appoint
                            another person, to act on your behalf in case of mortality or incapacity, in this context,
                            &quot;incapacity&quot; refers to the inability to exercise rights due to mental unsoundness or
                            physical infirmity.</span></li>
                </ul>
                <p
                    style='margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;text-align:justify;'>
                    <span style='font-family:"Arial",sans-serif;'>&nbsp;</span>
                </p>
                <ol style="margin-bottom:0cm;margin-top:0cm;" start="11" type="1">
                    <li
                        style='margin-top:0cm;margin-right:0cm;margin-bottom:0cm;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;color:black;text-align:justify;border:none;'>
                        <strong><span style='font-family:"Arial",sans-serif;'>DUTIES OF THE DATA PRINCIPAL</span></strong>
                    </li>
                </ol>
                <p
                    style='margin-top:0cm;margin-right:0cm;margin-bottom:0cm;margin-left:36.0pt;font-size:11.0pt;font-family:"Calibri",sans-serif;text-align:justify;border:none;'>
                    <span style='font-family:"Arial",sans-serif;color:black;'>&nbsp;</span>
                </p>
                <p
                    style='margin-top:0cm;margin-right:0cm;margin-bottom:0cm;margin-left:36.0pt;font-size:11.0pt;font-family:"Calibri",sans-serif;text-align:justify;border:none;'>
                    <span style='font-family:"Arial",sans-serif;color:black;'>You, as the Data Principal are bound by
                        certain duties, and must ensure:</span>
                </p>
                <p
                    style='margin-top:0cm;margin-right:0cm;margin-bottom:0cm;margin-left:36.0pt;font-size:11.0pt;font-family:"Calibri",sans-serif;text-align:justify;border:none;'>
                    <span style='font-family:"Arial",sans-serif;color:black;'>&nbsp;</span>
                </p>
                <ul style="list-style-type: undefined margin-left: 26px;">
                    <li><span style='font-family:"Arial",sans-serif;color:black;'>Not to impersonate another person while
                            providing your personal data for a specified purpose;</span></li>
                    <li><span style='font-family:"Arial",sans-serif;color:black;'>Not to suppress any material information
                            while providing your personal data for any document, unique identifier, proof of identity or
                            proof of address issued by the State or any of its instrumentalities:</span></li>
                    <li><span style='font-family:"Arial",sans-serif;color:black;'>Not to register a false or frivolous
                            grievance or complaint with us or the Data Protection Board of India;</span></li>
                    <li><span style='font-family:"Arial",sans-serif;color:black;'>Furnish only such information as is
                            verifiably authentic, while exercising the right to correction or erasure under this
                            policy;</span></li>
                    <li><span style='font-family:"Arial",sans-serif;color:black;'>Compliance with the provisions of all
                            applicable laws for the time being in force while exercising rights under the
                            provisions&nbsp;of&nbsp;DPDP&nbsp;Act;</span></li>
                </ul>
                <p
                    style='margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;text-align:justify;'>
                    <span style='font-family:"Arial",sans-serif;'>&nbsp;</span>
                </p>
                <ol style="margin-bottom:0cm;margin-top:0cm;" start="12" type="1">
                    <li
                        style='margin-top:0cm;margin-right:0cm;margin-bottom:0cm;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;color:black;text-align:justify;border:none;'>
                        <strong><span style='font-family:"Arial",sans-serif;'>SECURITY OF YOUR PERSONAL
                                DATA</span></strong>
                    </li>
                </ol>
                <p
                    style='margin-top:0cm;margin-right:0cm;margin-bottom:0cm;margin-left:36.0pt;font-size:11.0pt;font-family:"Calibri",sans-serif;text-align:justify;border:none;'>
                    <strong><span style='font-family:"Arial",sans-serif;color:black;'>&nbsp;</span></strong>
                </p>
                <p
                    style='margin-top:0cm;margin-right:0cm;margin-bottom:0cm;margin-left:36.0pt;font-size:11.0pt;font-family:"Calibri",sans-serif;text-align:justify;border:none;'>
                    <span style='font-family:"Arial",sans-serif;color:black;'>At Swayam Vidya, the security of your data is
                        of utmost importance. We take extensive measures to safeguard the information you provide, ensuring
                        protection against loss, unauthorized access, disclosure, and misuse. These measures are designed to
                        align with the sensitivity of the data we collect, process, and store, as well as the current
                        advancements in technology.</span>
                </p>
                <p
                    style='margin-top:0cm;margin-right:0cm;margin-bottom:0cm;margin-left:36.0pt;font-size:11.0pt;font-family:"Calibri",sans-serif;text-align:justify;border:none;'>
                    <span style='font-family:"Arial",sans-serif;color:black;'>&nbsp;</span>
                </p>
                <p
                    style='margin-top:0cm;margin-right:0cm;margin-bottom:0cm;margin-left:36.0pt;font-size:11.0pt;font-family:"Calibri",sans-serif;text-align:justify;border:none;'>
                    <span style='font-family:"Arial",sans-serif;color:black;'>However, it is important to note that due to
                        the inherent nature of communication and information processing technology, we cannot guarantee
                        absolute security against external intrusions while transmitting data over the Internet or when it
                        is stored in our systems. Additionally, when you click on a link leading to a third- party website,
                        please be aware that you will be leaving our site, and we do not have control over or endorse the
                        content found on such third-party sites.</span>
                </p>
                <p
                    style='margin-top:0cm;margin-right:0cm;margin-bottom:0cm;margin-left:36.0pt;font-size:11.0pt;font-family:"Calibri",sans-serif;text-align:justify;border:none;'>
                    <strong><span style='font-family:"Arial",sans-serif;color:black;'>&nbsp;</span></strong>
                </p>
                <ol style="margin-bottom:0cm;margin-top:0cm;" start="13" type="1">
                    <li
                        style='margin-top:0cm;margin-right:0cm;margin-bottom:0cm;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;color:black;text-align:justify;border:none;'>
                        <strong><span style='font-family:"Arial",sans-serif;'>DISCLOSURE OF PERSONAL DATA TO THIRD
                                PARTIES</span></strong>
                    </li>
                </ol>
                <p
                    style='margin-top:0cm;margin-right:0cm;margin-bottom:0cm;margin-left:36.0pt;font-size:11.0pt;font-family:"Calibri",sans-serif;text-align:justify;border:none;'>
                    <span style='font-family:"Arial",sans-serif;color:black;'>&nbsp;</span>
                </p>
                <p
                    style='margin-top:0cm;margin-right:0cm;margin-bottom:0cm;margin-left:36.0pt;font-size:11.0pt;font-family:"Calibri",sans-serif;text-align:justify;border:none;'>
                    <span style='font-family:"Arial",sans-serif;color:black;'>We may disclose personal information
                        to:</span>
                </p>
                <p
                    style='margin-top:0cm;margin-right:0cm;margin-bottom:0cm;margin-left:36.0pt;font-size:11.0pt;font-family:"Calibri",sans-serif;text-align:justify;border:none;'>
                    <span style='font-family:"Arial",sans-serif;color:black;'>&nbsp;</span>
                </p>
                <ul style="list-style-type: undefined margin-left: 26px;">
                    <li><span style='font-family:"Arial",sans-serif;color:black;'>Our parent and subsidiary company,
                            affiliate, or collaborated institutions.</span></li>
                    <li><span style='font-family:"Arial",sans-serif;color:black;'>Third-party service providers for the
                            purpose of enabling them to provide their services, including (without limitation) IT service
                            providers, data storage, hosting and server providers, analytics, error loggers, debt
                            collectors, maintenance or problem-solving providers, professional advisors, payment systems
                            operators, and financial institutions</span></li>
                    <li><span style='font-family:"Arial",sans-serif;color:black;'>Our employees and senior management of
                            our Company.</span></li>
                    <li><span style='font-family:"Arial",sans-serif;color:black;'>Our existing or potential agents or
                            business partners.</span></li>
                    <li><span style='font-family:"Arial",sans-serif;color:black;'>Regulatory authorities in the event you
                            fail to pay for goods or services we have provided to you.</span></li>
                    <li><span style='font-family:"Arial",sans-serif;color:black;'>Courts, tribunals, regulatory
                            authorities, and law enforcement officers, as required by law, in connection with any actual or
                            prospective legal proceedings, or in order to establish, exercise, or defend our legal
                            rights.</span></li>
                    <li><span style='font-family:"Arial",sans-serif;color:black;'>Third parties, including agents or
                            sub-contractors, who assist us in providing information, products, services, or direct marketing
                            to you.</span></li>
                    <li><span style='font-family:"Arial",sans-serif;color:black;'>Third parties to collect and process
                            data</span></li>
                    <li><span style='font-family:"Arial",sans-serif;color:black;'>An entity that buys, or to which we
                            transfer all or substantially all of our assets&nbsp;and&nbsp;business.</span></li>
                </ul>
                <p
                    style='margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;text-align:justify;'>
                    <span style='font-family:"Arial",sans-serif;'>&nbsp;</span>
                </p>
                <ol style="margin-bottom:0cm;margin-top:0cm;" start="14" type="1">
                    <li
                        style='margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;color:black;text-align:justify;border:none;'>
                        <strong><span style='font-family:"Arial",sans-serif;'>UPDATES TO PRIVACY POLICY</span></strong>
                    </li>
                </ol>
                <p
                    style='margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:18.0pt;font-size:11.0pt;font-family:"Calibri",sans-serif;text-align:justify;'>
                    <span style='font-family:"Arial",sans-serif;'>At our discretion, we may change our privacy policy to
                        reflect updates to our business processes, current acceptable practices, or legislative or
                        regulatory changes, and inclusion/ exclusion of target audience and stakeholders. If we decide to
                        change this privacy policy, we will post the changes here at the same link by which you are
                        accessing this privacy policy.</span>
                </p>
                <p
                    style='margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:18.0pt;font-size:11.0pt;font-family:"Calibri",sans-serif;text-align:justify;'>
                    <span style='font-family:"Arial",sans-serif;'>If the changes are significant, or if required by
                        applicable law, we will contact you (based on your selected preferences for communications from us)
                        and all our registered users with the new details and links to the updated or changed policy.</span>
                </p>
                <p
                    style='margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;text-align:justify;'>
                    <span style='font-family:"Arial",sans-serif;'>&nbsp;</span>
                </p>
                <p
                    style='margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;text-align:justify;'>
                    <span style='font-family:"Arial",sans-serif;'>&nbsp;</span>
                </p>
                <ol style="margin-bottom:0cm;margin-top:0cm;" start="15" type="1">
                    <li
                        style='margin-top:0cm;margin-right:0cm;margin-bottom:0cm;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;color:black;text-align:justify;border:none;'>
                        <strong><span style='font-family:"Arial",sans-serif;'>INFORMATION COLLECTED FROM INTERACTIVE
                                FORMS</span></strong>
                    </li>
                </ol>
                <p
                    style='margin-top:0cm;margin-right:0cm;margin-bottom:0cm;margin-left:36.0pt;font-size:11.0pt;font-family:"Calibri",sans-serif;text-align:justify;border:none;'>
                    <span style='font-family:"Arial",sans-serif;color:black;'>&nbsp;</span>
                </p>
                <p
                    style='margin-top:0cm;margin-right:0cm;margin-bottom:0cm;margin-left:36.0pt;font-size:11.0pt;font-family:"Calibri",sans-serif;text-align:justify;border:none;'>
                    <span style='font-family:"Arial",sans-serif;color:black;'>When you voluntarily send us electronic mail
                        / fill up the form, we will keep a record of this information so that we can respond to you. We only
                        collect information from you when you register on our site or fill out a form. Also, when filling
                        out a form on our site, you may be asked to enter your name, e-mail address or phone number. You
                        may, however, visit our site anonymously, in case you have submitted your personal information and
                        contact details, we reserve the rights to Call, SMS, Email or WhatsApp about our products and
                        offers, even if your number has DND activated on it.</span>
                </p>
                <p
                    style='margin-top:0cm;margin-right:0cm;margin-bottom:0cm;margin-left:36.0pt;font-size:11.0pt;font-family:"Calibri",sans-serif;text-align:justify;border:none;'>
                    <span style='font-family:"Arial",sans-serif;'>&nbsp;</span>
                </p>
                <p
                    style='margin-top:0cm;margin-right:0cm;margin-bottom:0cm;margin-left:36.0pt;font-size:11.0pt;font-family:"Calibri",sans-serif;text-align:justify;border:none;'>
                    <span style='font-family:"Arial",sans-serif;'>&nbsp;</span>
                </p>
                <p
                    style='margin-top:0cm;margin-right:0cm;margin-bottom:0cm;margin-left:36.0pt;font-size:11.0pt;font-family:"Calibri",sans-serif;text-align:justify;border:none;'>
                    <span style='font-family:"Arial",sans-serif;'>&nbsp;</span>
                </p>
                <p
                    style='margin-top:0cm;margin-right:0cm;margin-bottom:0cm;margin-left:36.0pt;font-size:11.0pt;font-family:"Calibri",sans-serif;text-align:justify;border:none;'>
                    <span style='font-family:"Arial",sans-serif;'>&nbsp;</span>
                </p>
                <p
                    style='margin-top:0cm;margin-right:0cm;margin-bottom:0cm;margin-left:36.0pt;font-size:11.0pt;font-family:"Calibri",sans-serif;text-align:justify;border:none;'>
                    <span style='font-family:"Arial",sans-serif;color:black;'>&nbsp;</span>
                </p>
                <ol style="margin-bottom:0cm;margin-top:0cm;" start="16" type="1">
                    <li
                        style='margin-top:0cm;margin-right:0cm;margin-bottom:0cm;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;color:black;text-align:justify;border:none;'>
                        <strong><span style='font-family:"Arial",sans-serif;'>YOUR CONSENT</span></strong>
                    </li>
                </ol>
                <p
                    style='margin-top:0cm;margin-right:0cm;margin-bottom:0cm;margin-left:36.0pt;font-size:11.0pt;font-family:"Calibri",sans-serif;text-align:justify;border:none;'>
                    <strong><span style='font-family:"Arial",sans-serif;'>&nbsp;</span></strong>
                </p>
                <p
                    style='margin-top:0cm;margin-right:0cm;margin-bottom:0cm;margin-left:36.0pt;font-size:11.0pt;font-family:"Calibri",sans-serif;text-align:justify;'>
                    <span style='font-family:"Arial",sans-serif;'>We believe that every user of our
                        Application/Services/products/Website must be in a position to provide an informed consent prior to
                        providing any Information required for the use of the Application/Services/products/Website. By
                        registering with us, you are expressly consenting to our collection, processing, storing, disclosing
                        and handling of your information as set forth in this Policy now and as amended by us. Processing
                        your information in any way, including, but not limited to, collecting, storing, deleting, using,
                        combining, sharing, transferring and disclosing information, all of which activities will take place
                        in India. If you reside outside India your information will be transferred, processed and stored in
                        accordance with the applicable data protection laws of India.</span>
                </p>
                <ol style="margin-bottom:0cm;margin-top:0cm;" start="17" type="1">
                    <li
                        style='margin-top:12.0pt;margin-right:0cm;margin-bottom:12.0pt;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;text-align:     justify;'>
                        <strong><span style='font-family:"Arial",sans-serif;'>LIMITATION OF LIABILITY FOR THIRD-PARTY
                                SERVICES</span></strong>
                    </li>
                </ol>
                <p
                    style='margin-top:12.0pt;margin-right:0cm;margin-bottom:12.0pt;margin-left:36.0pt;font-size:11.0pt;font-family:"Calibri",sans-serif;text-align:justify;'>
                    <span style='font-family:"Arial",sans-serif;'>Our Service may contain links or connections to
                        third-party services (including social media platforms, payment processors, and data analytics
                        tools,) that are not owned or controlled by us. We are not responsible for the privacy practices or
                        content of these third-party services. By using the Service, you acknowledge and agree that we shall
                        not be liable for any loss, damage, or other liability arising out of Your use of or reliance on any
                        third-party services or the actions, errors, or omissions of such third parties, including but not
                        limited to the unauthorized handling or disclosure of Your information by such third parties.</span>
                </p>
                <p
                    style='margin-top:0cm;margin-right:0cm;margin-bottom:0cm;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;text-align:justify;border:none;'>
                    <strong><span style='font-family:"Arial",sans-serif;'>&nbsp;</span></strong>
                </p>
                <ol style="margin-bottom:0cm;margin-top:0cm;" start="18" type="1">
                    <li
                        style='margin-top:0cm;margin-right:0cm;margin-bottom:0cm;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;color:black;text-align:justify;border:none;'>
                        <strong><span style='font-family:"Arial",sans-serif;'>PRIVACY GRIEVANCES</span></strong>
                    </li>
                </ol>
                <p
                    style='margin-top:0cm;margin-right:0cm;margin-bottom:0cm;margin-left:36.0pt;font-size:11.0pt;font-family:"Calibri",sans-serif;text-align:justify;border:none;'>
                    <span style='font-family:"Arial",sans-serif;color:black;'>&nbsp;</span>
                </p>
                <p
                    style='margin-top:0cm;margin-right:0cm;margin-bottom:0cm;margin-left:36.0pt;font-size:11.0pt;font-family:"Calibri",sans-serif;text-align:justify;border:none;'>
                    <span style='font-family:"Arial",sans-serif;color:black;'>If you have any questions about this Policy,
                        wish to exercise your rights, have concerns about privacy of your data or any privacy related
                        grievances in respect of the Website, then please write an email to&nbsp;</span><a
                        href="#"><span
                            style='font-family:"Arial",sans-serif;color:#0563C1;'>grievance@</span></a><a
                        href="#"><span
                            style='font-family:"Arial",sans-serif;color:#0563C1;'>swayamvidya</span></a><a
                        href="#"><span
                            style='font-family:"Arial",sans-serif;color:#0563C1;'>com</span></a><span
                        style='font-family:"Arial",sans-serif;color:black;'>.</span>
                </p>
                <p
                    style='margin-top:0cm;margin-right:0cm;margin-bottom:0cm;margin-left:36.0pt;font-size:11.0pt;font-family:"Calibri",sans-serif;text-align:justify;border:none;'>
                    <span style='font-family:"Arial",sans-serif;color:black;'>&nbsp;</span>
                </p>
                <p
                    style='margin-top:0cm;margin-right:0cm;margin-bottom:0cm;margin-left:36.0pt;font-size:11.0pt;font-family:"Calibri",sans-serif;text-align:justify;border:none;'>
                    <span style='font-family:"Arial",sans-serif;color:black;'>If you are an Indian resident and you have a
                        complaint, you may refer it to the Data Protection Board (DPB) of India under the relevant
                        provisions of Digital Personal Data Protection Act, 2023, The DPB serves as&nbsp;</span><span
                        style='font-family:"Arial",sans-serif;'>India&apos;s<span style="color:black;"> primary authority
                            in matters relating to personal data protection.</span></span>
                </p>
                <p
                    style='margin-top:0cm;margin-right:0cm;margin-bottom:0cm;margin-left:36.0pt;font-size:11.0pt;font-family:"Calibri",sans-serif;text-align:justify;border:none;'>
                    <span style='font-family:"Arial",sans-serif;color:black;'>&nbsp;</span>
                </p>
                <p
                    style='margin-top:0cm;margin-right:0cm;margin-bottom:0cm;margin-left:36.0pt;font-size:11.0pt;font-family:"Calibri",sans-serif;text-align:justify;border:none;'>
                    <strong><span style='font-family:"Arial",sans-serif;color:black;'>Grievance Redressal
                            Officer</span></strong><span
                        style='font-family:"Arial",sans-serif;color:black;'><br>&nbsp;Name:&nbsp;<br>&nbsp;e-mail:&nbsp;</span><a
                        href="#"><span
                            style='font-family:"Arial",sans-serif;color:#0563C1;'>grievance@swayamvidyacom</span></a><span
                        style='font-family:"Arial",sans-serif;'>.<span style="color:black;">&nbsp;&nbsp;</span></span>
                </p>
                <p
                    style='margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:36.0pt;font-size:11.0pt;font-family:"Calibri",sans-serif;text-align:justify;border:none;'>
                    <span style='font-family:"Arial",sans-serif;color:black;'>&nbsp;</span>
                </p>
            </div>
        </div>
    </section>
@endsection
