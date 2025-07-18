@extends('layouts/layoutFront')

<!-- Vendor Styles -->
@section('vendor-style')
    @vite(['resources/assets/vendor/libs/nouislider/nouislider.scss', 'resources/assets/vendor/libs/swiper/swiper.scss'])
@endsection

<!-- Page Styles -->
@section('page-style')
    @vite(['resources/assets/vendor/scss/pages/front-page-landing.scss', 'resources/assets/vendor/libs/toastr/toastr.scss', 'resources/assets/css/demo.css', 'resources/assets/vendor/scss/pages/ui-carousel.scss'])
    <style>
        .list-group-numbered>.list-group-item::before {
            font-size: 18px;
            font-weight: 700;
            color: black
        }

        @media (max-width: 435px) {
            .nest_ul_li {
                /* padding: 0rem !important; */
                padding-left: 0.5rem !important;
            }
        }

        p,
        ul,
        ol, ::marker {
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
                <div class="terms_text_s"><span class="terms_text">Terms and Conditions</span></div>
                <div class="terms_border_top"></div>
            </div> --}}
            <div class="">
                <div class="university_hr_sidebar_s"><span class="university_hr_sidebart">Term & Conditions</span></div>
                <div class="university_hr_sidebar"></div>
            </div>
            <div class="">
                <p
                    style='margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;text-align:justify;line-height:150%;'>
                    <strong><span style='font-family:"Arial",sans-serif;'>Introduction</span></strong>
                </p>
                <p
                    style='margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;text-align:justify;line-height:150%;'>
                    <span style='font-family:"Arial",sans-serif;'>These Terms &amp; Conditions (&ldquo;Terms&rdquo;) of (a)
                        use of our website www. Swayam vidya.com (&ldquo;Website&rdquo;), our applications
                        (&ldquo;Application&rdquo;) or any products or services in connection with the Application/,
                        Website/products (&ldquo;Services&rdquo;) or (b) any modes of registrations or usage of products,
                        including through SD cards, tablets or other storage/transmitting device are
                        between&nbsp;</span><span
                        style='font-size:16px;line-height:150%;font-family:"Arial",sans-serif;'>Swayam vidya (powered by
                        Career line LLP)&nbsp;</span><span style='font-family:"Arial",sans-serif;'>(&ldquo;We/Us/Our&rdquo;)
                        and its users (&ldquo;User/You/Your&rdquo;).<strong>&nbsp;Registration and
                            Acceptance</strong></span>
                </p>
                <p
                    style='margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;text-align:justify;line-height:150%;'>
                    <span style='font-family:"Arial",sans-serif;'>These Terms constitute an electronic record in accordance
                        with the provisions of the Information Technology Act, 2000 and the Information Technology
                        (Intermediaries guidelines) Rules, 2011 thereunder, as amended from time to time. Please read the
                        Terms and the privacy policy of Us (&ldquo;Privacy
                        Policy&rdquo;) with respect to registration with us, the use of the Application, Website, Services
                        and products carefully before using the Application, Website, Services or products. In the event of
                        any discrepancy between the Terms and any other policies with respect to the Application or Website
                        or Services or products, the provisions of the Terms shall prevail. Your use/access/browsing of the
                        Application or Website or the Services or products or registration (with or without payment/with or
                        without subscription) through any means shall signify Your acceptance of the Terms and Your
                        agreement to be legally bound by the same.</span>
                </p>
                <p
                    style='margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;text-align:justify;line-height:150%;'>
                    <span style='font-family:"Arial",sans-serif;'>If You are under the age of 18 (Eighteen), it is mandatory
                        that your parent or guardian has read and accepted the Terms on your behalf before using the
                        Website.</span>
                </p>
                <p
                    style='margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;text-align:justify;line-height:150%;'>
                    <strong><span style='font-family:"Arial",sans-serif;'>User-Generated Content Policy</span></strong>
                </p>
                <p
                    style='margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;text-align:justify;line-height:150%;'>
                    <span style='font-family:"Arial",sans-serif;'>Please read this User Generated Content Policy carefully
                        before you submit UGC to Swayamvidya App, as this policy and our Website &amp; App Terms of Use will
                        apply to your use of our Website, our Apps and the UGC you submit to them. By using our platforms
                        and submitting UGC to our Web App or via our Mobile Apps you confirm that you accept this User
                        Generated Content Policy, our&nbsp;</span><a href="#"><span
                            style='font-family:"Arial",sans-serif;color:#0563C1;'>Privacy Policy</span></a><span
                        style='font-family:"Arial",sans-serif;'>&nbsp;and our&nbsp;</span><a href="#"><span
                            style='font-family:"Arial",sans-serif;color:#0563C1;'>Terms of
                            Use&nbsp;</span></a><span style='font-family:"Arial",sans-serif;'>and that you agree to comply
                        with them. If you do not agree to these terms and policies, you must not use our Website or Apps or
                        submit UGC to (or via) it (or them).</span>
                </p>
                <ol style="margin-bottom:0cm;margin-top:0cm;" start="1" type="1">
                    <li
                        style='margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;text-align:justify;line-height:150%;'>
                        <span style='font-family:"Arial",sans-serif;'>Your UGC</span>
                        <ol style="margin-bottom:0cm;margin-top:0cm;" start="1" type="i">
                            <li
                                style="margin-top: 0cm;margin-right: 0cm;margin-bottom: 8pt;font-size:15px;font-family: Calibri, sans-serif;text-align: justify;line-height: 150%;">
                                <span style='font-family:"Arial",sans-serif;'>All content submitted to www.Swayamvidya.com
                                    and Swayamvidya mobile app, including without limitation, your name, biographical
                                    information and all other names, usernames, pseudonyms, text, graphics, images,
                                    photographs, forum comments, and all other information and material shall be called your
                                    &quot;UGC&quot; for short.</span>
                            </li>
                            <li
                                style="margin-top: 0cm;margin-right: 0cm;margin-bottom: 8pt;font-size:15px;font-family: Calibri, sans-serif;text-align: justify;line-height: 150%;">
                                <span style='font-family:"Arial",sans-serif;'>You agree to submit UGC to the Swayamvidya app
                                    and Swayamvidya website per the following rules (in particular, the Legal Standards and
                                    the Review Guidelines, as those terms, are defined below). Please use caution and common
                                    sense when submitting UGC to the Website or via our App.</span>
                            </li>
                            <li
                                style="margin-top: 0cm;margin-right: 0cm;margin-bottom: 8pt;font-size:15px;font-family: Calibri, sans-serif;text-align: justify;line-height: 150%;">
                                <span style='font-family:"Arial",sans-serif;'>Publication of your UGC will be at our sole
                                    discretion and we are entitled to make additions or deletions to your UGC before
                                    publication, after publication or to refuse publication.</span>
                            </li>
                            <li
                                style="margin-top: 0cm;margin-right: 0cm;margin-bottom: 8pt;font-size:15px;font-family: Calibri, sans-serif;text-align: justify;line-height: 150%;">
                                <span style='font-family:"Arial",sans-serif;'>Please note, any UGC you submit to our Website
                                    or via our Apps will be considered non-confidential and non-proprietary.</span>
                            </li>
                        </ol>
                    </li>
                </ol>
                <p
                    style='margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;text-align:justify;line-height:150%;'>
                    <span style='font-family:"Arial",sans-serif;'>&nbsp;</span>
                </p>
                <p
                    style='margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;text-align:justify;line-height:150%;'>
                    <span style='font-family:"Arial",sans-serif;'>&nbsp;</span>
                </p>
                <ol style="margin-bottom:0cm;margin-top:0cm;" start="2" type="1">
                    <li
                        style='margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;text-align:justify;line-height:150%;'>
                        <span style='font-family:"Arial",sans-serif;'>Rights, permissions &amp; waivers</span>
                    </li>
                </ol>
                <ol style="list-style-type: upper-roman;margin-left: 62px;">
                    <li><span style='font-family:"Arial",sans-serif;'>You hereby grant to Swayam vidya and any of our
                            affiliates a non-exclusive, perpetual, irrevocable, transferable, royalty-free licence
                            (including full rights to sub-license) to use, reproduce and publish your UGC (including,
                            without limitation, the right to adapt, alter, amend or change your UGC) in any media or format
                            (whether known now or invented in the future) throughout the world without restriction.</span>
                    </li>
                    <li><span style='font-family:"Arial",sans-serif;'>You warrant, represent and undertake to us that all
                            UGC you submit is your own work or that you have obtained all necessary rights and permissions
                            of the relevant owner of the work and that you have all relevant rights in your UGC to enable
                            you to grant the rights and permissions in this clause 2.</span></li>
                    <li><span style='font-family:"Arial",sans-serif;'>Where your UGC contains images of people or names or
                            identifies individuals, you warrant, represent and undertake to us as follows:</span></li>
                </ol>
                <p
                    style='margin-top:0cm;margin-right:0cm;margin-bottom:0cm;margin-left:72.0pt;font-size:11.0pt;font-family:"Calibri",sans-serif;text-align:justify;line-height:150%;'>
                    <span style='font-family:"Arial",sans-serif;'>&nbsp;</span>
                </p>
                <ol style="list-style-type: upper-alpha;margin-left: 62px;">
                    <li><span style='font-family:"Arial",sans-serif;'>That all featured or identified individuals that are
                            over the age of 18 and have expressly consented to their appearance in the UGC, and to you
                            submitting the UGC to our Website or via our Apps, and</span></li>
                    <li><span style='font-family:"Arial",sans-serif;'>where featured or identified individuals are under the
                            age of 18, that you either:</span></li>
                </ol>
                <p
                    style='margin-top:0cm;margin-right:0cm;margin-bottom:0cm;margin-left:72.0pt;font-size:11.0pt;font-family:"Calibri",sans-serif;text-align:justify;line-height:150%;'>
                    <span style='font-family:"Arial",sans-serif;'>&nbsp;</span>
                </p>
                <ol style="list-style-type: lower-alpha;margin-left: 62px;">
                    <li><span style='font-family:"Arial",sans-serif;'>are the parent or legal guardian or such featured or
                            identified individuals, or</span></li>
                    <li><span style='font-family:"Arial",sans-serif;'>have obtained the express consent from a parent or
                            legal guardian of such featured or identified individuals to their appearance in the UGC, and to
                            you submitting the UGC to our Website or via our Apps.</span></li>
                    <li><span style='font-family:"Arial",sans-serif;'>You hereby unconditionally and irrevocably waive and
                            agree not to assert (or procure the same from any third party where applicable) any and all
                            moral rights and any other similar rights and all right of publicity and privacy in any country
                            in the world in connection with your UGC, to the maximum extent permissible by law.</span></li>
                </ol>
                <ol style="margin-bottom:0cm;margin-top:0cm;" start="3" type="1">
                    <li
                        style='margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;text-align:justify;line-height:150%;'>
                        <span style='font-family:"Arial",sans-serif;'>Content standards &ndash; legal standards</span>
                    </li>
                </ol>
                <ol style="list-style-type: upper-roman;">
                    <li><span style='font-family:"Arial",sans-serif;'>You warrant, represent and undertake to us that your
                            UGC (including its use, publication and/or exploitation by us) shall not:</span></li>
                    <li><span style='font-family:"Arial",sans-serif;'>infringe the copyrights or database rights,
                            trademarks, rights of privacy, publicity or other intellectual property or other rights of any
                            other person or entity; and/or</span></li>
                    <li><span style='font-family:"Arial",sans-serif;'>contain any material which is defamatory of any person
                            and/or entity; and/or</span></li>
                    <li><span style='font-family:"Arial",sans-serif;'>contain misleading or deceptive statements or
                            omissions or misrepresentation as to your identity (for example, by impersonating another
                            person) or your affiliation with any person or entity; and/or</span></li>
                    <li><span style='font-family:"Arial",sans-serif;'>breach any legal or fiduciary duty owed to a third
                            party, such as a contractual duty or a duty of confidence; and/or</span></li>
                    <li><span style='font-family:"Arial",sans-serif;'>advocate, promote, or assist discrimination based on
                            race, sex, religion, nationality, disability, sexual orientation or age; and/or</span></li>
                    <li><span style='font-family:"Arial",sans-serif;'>contain any malicious code, such as viruses, worms,
                            Trojan horses or other potentially harmful programmes, codes or material; and/or</span></li>
                    <li><span style='font-family:"Arial",sans-serif;'>violate any other applicable law, statute, ordinance,
                            rule or regulation, (together, or individually the &quot;Legal Standards&quot;).</span></li>
                    <li><span style='font-family:"Arial",sans-serif;'>If your UGC contains any material that is not owned by
                            or licensed to you and/or which is subject to third party rights, you are responsible for
                            obtaining, before submission of your UGC, all releases, consents and/or licenses necessary to
                            permit use and exploitation of your UGC by us without additional compensation. Please see clause
                            2 above for further details.</span></li>
                </ol>
                <ol style="margin-bottom:0cm;margin-top:0cm;" start="4" type="1">
                    <li
                        style='margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;text-align:justify;line-height:150%;'>
                        <span style='font-family:"Arial",sans-serif;'>Content standards &ndash; review guidelines</span>
                    </li>
                </ol>
                <ol style="list-style-type: lower-roman;">
                    <li><span style='font-family:"Arial",sans-serif;'>You warrant, represent and undertake to us that your
                            UGC:</span></li>
                    <li><span style='font-family:"Arial",sans-serif;'>is accurate, where it states facts; and/or</span></li>
                    <li><span style='font-family:"Arial",sans-serif;'>is genuinely held, where it states opinions (for
                            example, in product or services reviews).</span></li>
                    <li><span style='font-family:"Arial",sans-serif;'>Any UGC which is in breach of our Review Guidelines or
                            is otherwise:</span></li>
                    <li><span style='font-family:"Arial",sans-serif;'>is obscene, hateful, inflammatory, offensive or in any
                            other way falls below commonly accepted standards of taste and decency in India; and/or</span>
                    </li>
                    <li><span style='font-family:"Arial",sans-serif;'>is reasonably likely to harass, upset, embarrass or
                            alarm a person (including, by way of example only, so-called &quot;trolling&quot; or
                            cyber-bullying); and/or</span></li>
                    <li><span style='font-family:"Arial",sans-serif;'>is threatening, abusive or invades another&apos;s
                            privacy, or causes annoyance, inconvenience or anxiety; and/or</span></li>
                    <li><span style='font-family:"Arial",sans-serif;'>is sexually explicit; and/or</span></li>
                    <li><span style='font-family:"Arial",sans-serif;'>advocates, promotes, assists or depicts violence;
                            and/or</span></li>
                    <li><span style='font-family:"Arial",sans-serif;'>advocates, promotes or assists any illegal activity or
                            unlawful act or omission; and/or</span></li>
                    <li><span style='font-family:"Arial",sans-serif;'>could be deemed to be unsolicited or unauthorised
                            advertising, promotional material, junk mail, or spam (including without limitation chain
                            letters, pyramid schemes or other forms of solicitation or advertisements, commercial or
                            otherwise); and/or will be removed from the platform.</span></li>
                </ol>
                <ol style="margin-bottom:0cm;margin-top:0cm;" start="5" type="1">
                    <li
                        style='margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;text-align:justify;line-height:150%;'>
                        <span style='font-family:"Arial",sans-serif;'>Consequences of breach</span>
                    </li>
                </ol>
                <ol style="margin-bottom:0cm;margin-top:0cm;" start="1" type="1">
                    <ol style="margin-bottom:0cm;margin-top:0cm;" start="1" type="A">
                        <li
                            style="margin-top: 0cm;margin-right: 0cm;margin-bottom: 8pt;font-size:15px;font-family: Calibri, sans-serif;text-align: justify;line-height: 150%;">
                            <span style='font-family:"Arial",sans-serif;'>We will determine, at our discretion, whether you
                                have failed to comply with this UGC Policy when submitting UGC to our platform. If you have
                                failed to comply, we reserve the right in our sole discretion to suspend you from using the
                                Website and/or our Apps without notice to you and/or to edit or remove (in whole or part)
                                any of your UGC from our Website and our Apps on a temporary or permanent basis.</span>
                        </li>
                        <li
                            style="margin-top: 0cm;margin-right: 0cm;margin-bottom: 8pt;font-size:15px;font-family: Calibri, sans-serif;text-align: justify;line-height: 150%;">
                            <span style='font-family:"Arial",sans-serif;'>Notwithstanding clause 5.A above, if you or your
                                UGC does not comply with this UGC Policy, and as a result of this, we suffer any loss or
                                damage, you will be liable to us and hereby agree to indemnify us for any such loss or
                                damage. This means that you will be responsible for any loss or damage we suffer as a result
                                of your failure to comply with this UGC Policy, including but not limited to our Legal
                                Standards and/or Review Guidelines.</span>
                        </li>
                        {{-- <li
                            style="margin-top: 0cm;margin-right: 0cm;margin-bottom: 8pt;font-size:15px;font-family: Calibri, sans-serif;text-align: justify;line-height: 150%;">
                            <span style='font-family:"Arial",sans-serif;'>We also reserve the right:</span></li> --}}
                
                    <li
                        style="margin-top: 0cm;margin-right: 0cm;margin-bottom: 8pt;font-size:15px;font-family: Calibri, sans-serif;text-align: justify;line-height: 150%;">
                        <span style='font-family:"Arial",sans-serif;'>We also reserve the right:</span>
                        <ol style="margin-bottom:0cm;margin-top:0cm;" start="1" type="1">
                            <ol style="margin-bottom:0cm;margin-top:0cm;" start="1" type="a">
                                <li
                                    style="margin-top: 0cm;margin-right: 0cm;margin-bottom: 8pt;font-size:15px;font-family: Calibri, sans-serif;text-align: justify;line-height: 150%;">
                                    <span style='font-family:"Arial",sans-serif;'>to pass on any UGC that gives us concern
                                        to the relevant authorities; and</span>
                                </li>
                                <li
                                    style="margin-top: 0cm;margin-right: 0cm;margin-bottom: 8pt;font-size:15px;font-family: Calibri, sans-serif;text-align: justify;line-height: 150%;">
                                    <span style='font-family:"Arial",sans-serif;'>to disclose your identity to any third
                                        party (or their professional advisor) who claims that any of your UGC constitutes a
                                        violation of their intellectual property rights, or of their right to privacy to the
                                        extent that is permitted by law.</span>
                                </li>
                            </ol>
                        </ol>
                    </li>
                </ol>
                <p
                    style='margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;text-align:justify;line-height:150%;'>
                    <strong><span style='font-family:"Arial",sans-serif;'>Course Materials</span></strong>
                </p>
                <p
                    style='margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;text-align:justify;line-height:150%;'>
                    <span style='font-family:"Arial",sans-serif;'>As a part of our Services offered through our Website, We
                        shall grant you access to our content, course materials, practice tests, and other information, data
                        which may be in audio/video, written, graphic, recorded, photographic or any machine-readable format
                        in relation to the package subscribed by You (&quot;course materials&quot;).</span>
                </p>
                <p
                    style='margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;text-align:justify;line-height:150%;'>
                    <span style='font-family:"Arial",sans-serif;'>We reserve the right to amend or update the course
                        materials offered to You. In the event such amendment or updation occurs, We may require you pay an
                        additional amount of fees to access such amended or updated course materials.</span>
                </p>
                <p
                    style='margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;text-align:justify;line-height:150%;'>
                    <strong><span style='font-family:"Arial",sans-serif;'>Grant of License</span></strong>
                </p>
                <p
                    style='margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;text-align:justify;line-height:150%;'>
                    <span style='font-family:"Arial",sans-serif;'>We grant you a personal, restricted, non-transferable,
                        non-exclusive and revocable license to use the Services and the course materials offered through the
                        Website for a limited time period. The time period will be as specified in the product package you
                        are purchasing. The Services and the course materials are provided solely for Your personal and
                        non-commercial use (&quot;Restricted Purpose&quot;). You may not use, download, save or print the
                        course materials for commercial use without written permission.</span>
                </p>
                <p
                    style='margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;text-align:justify;line-height:150%;'>
                    <span style='font-family:"Arial",sans-serif;'>The Services are personal to You and You may not assign
                        your rights and obligation under the Terms to any person. You are not permitted to reproduce,
                        distribute, sub-license, disseminate or prepare derivative works of the course materials, or any
                        part thereof, in any manner or means, without Our prior written consent.</span>
                </p>
                <p
                    style='margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;text-align:justify;line-height:150%;'>
                    <strong><span style='font-family:"Arial",sans-serif;'>Ownership of course materials &amp; Intellectual
                            Property Rights</span></strong>
                </p>
                <p
                    style='margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;text-align:justify;line-height:150%;'>
                    <span style='font-family:"Arial",sans-serif;'>You are granted a limited and non-exclusive right to use
                        the Website, the Services and the course materials for the Restricted Purpose as aforesaid. You
                        acknowledge and agree that We are the sole and exclusive owner of the Website, the Services and the
                        course materials and hence are vested with all intellectual property rights and other proprietary
                        rights in relation thereto, and no right, title or interest of a proprietary or any other nature in
                        the Website, the Services or the course materials is conveyed or granted other than permitting You
                        to use the Website, the Services and the course materials for the Restricted Purpose.</span>
                </p>
                <p
                    style='margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;text-align:justify;line-height:150%;'>
                    <span style='font-family:"Arial",sans-serif;'>We are the owner and/or the licensee of all the
                        trademarks, logos or other intellectual property on the Website.</span>
                </p>
                <p
                    style='margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;text-align:justify;line-height:150%;'>
                    <strong><span style='font-family:"Arial",sans-serif;'>Referrals</span></strong>
                </p>
                <p
                    style='margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;text-align:justify;line-height:150%;'>
                    <span style='font-family:"Arial",sans-serif;'>You will win the referral reward only if the user you
                        referred signs up and pays for one of the course. You will not win any reward if the user only signs
                        up on Swayam vidya.app without paying for any course, which can include simply trying the free
                        trial.</span>
                </p>
                <p
                    style='margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;text-align:justify;line-height:150%;'>
                    <strong><span style='font-family:"Arial",sans-serif;'>Communication</span></strong>
                </p>
                <p
                    style='margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;text-align:justify;line-height:150%;'>
                    <span style='font-family:"Arial",sans-serif;'>The Company may, based on any form of access to the
                        Application (including free trials and paid subscriptions) or Services or Website or registrations
                        through any source whatsoever, contact the User through sms, email, call and Whatsapp, to give
                        information about its products as well as notifications on various important updates and/or to seek
                        permission for demonstration of its products. The User expressly grants such permission to contact
                        him/her through telephone, SMS, e-mail and holds the Company indemnified against any liabilities
                        including financial penalties, damages, expenses in case the User&rsquo;s mobile number is
                        registered with Do not Call (DNC) database. By registering yourself, you agree to make your contact
                        details available to our academic counselors and associates so that you may be contacted for
                        educational purposes, to provide information regarding our services and promotions through
                        telephone, SMS, email, whatsapp etc.</span>
                </p>
                <p
                    style='margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;text-align:justify;line-height:150%;'>
                    <strong><span style='font-family:"Arial",sans-serif;'>Disclaimer</span></strong>
                </p>
                <p
                    style='margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;text-align:justify;line-height:150%;'>
                    <span style='font-family:"Arial",sans-serif;'>Our content is created by experts and goes through strict
                        quality checks. The Website is available to users, including you, on an &ldquo;as is&rdquo; basis,
                        without any warranties as to accuracy, fitness for use for a particular purpose, merchantability,
                        freedom from any errors, defects or non-infringement, and the Company does not makes any warranties
                        that the Website shall always be running and free of downtime, or that it shall be error-free, or
                        any representations regarding the availability and performance of its Website or any of the websites
                        to which links may be provided in the Website.</span>
                </p>
                <p
                    style='margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;text-align:justify;line-height:150%;'>
                    <span style='font-family:"Arial",sans-serif;'>Our site may be temporarily unavailable at any point of
                        time due to maintenance, up-gradation or any other reason.</span>
                </p>
                <p
                    style='margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;text-align:justify;line-height:150%;'>
                    <span style='font-family:"Arial",sans-serif;'>We reserve the right to modify without prior notice and
                        in Our sole discretion to refuse Service to any person. We reserve the right to accept or reject
                        registrations on Swayam vidya.app. We reserve the right to change prices for all our Services,
                        offers or deals.</span>
                </p>
                <p
                    style='margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;text-align:justify;line-height:150%;'>
                    <strong><span style='font-family:"Arial",sans-serif;'>Cancellation and Refund Policy</span></strong>
                </p>
                <p
                    style='margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;text-align:justify;line-height:150%;'>
                    <span style='font-family:"Arial",sans-serif;'>All purchases and payments made will be final and
                        non-refundable, except where explicitly it is stated as part of an ongoing marketing promotion.
                        Users can evaluate the Services through the free trial provided on the Website.</span>
                </p>
                <p
                    style='margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;text-align:justify;line-height:150%;'>
                    <span style='font-family:"Arial",sans-serif;'>All refunds, if eligible, will be processed within 14
                        (Fourteen) business days of receiving cancellation requests.</span>
                </p>
                <p
                    style='margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;text-align:justify;line-height:150%;'>
                    <strong><span style='font-family:"Arial",sans-serif;'>Privacy Policy</span></strong>
                </p>
                <p
                    style='margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;text-align:justify;line-height:150%;'>
                    <span style='font-family:"Arial",sans-serif;'>We use cookies to store and gather certain data to enable
                        a smoother user experience. Our Privacy Policy explains how such information may be collected and
                        used.<br>&nbsp;Please find the elaborated privacy policy.&nbsp;</span>
                </p>
                <p
                    style='margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;text-align:justify;line-height:150%;'>
                    <strong><span style='font-family:"Arial",sans-serif;'>Applicable Law and Jurisdiction</span></strong>
                </p>
                <p
                    style='margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;text-align:justify;line-height:150%;'>
                    <span style='font-family:"Arial",sans-serif;'>These Terms are governed by the laws of India and You
                        agree that the courts of Calicut will have exclusive jurisdiction over any dispute (contractual or
                        non-contractual) concerning these Terms.</span>
                </p>
                <p
                    style='margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;text-align:justify;line-height:150%;'>
                    <strong><span style='font-family:"Arial",sans-serif;'>Indemnity</span></strong>
                </p>
                <p
                    style='margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;text-align:justify;line-height:150%;'>
                    <span style='font-family:"Arial",sans-serif;'>You agree to indemnify and hold the Company and (as
                        applicable) its parent, subsidiaries, affiliates, officers, directors, agents, and employees,
                        harmless from any claim or demand, including reasonable attorneys&apos; fees, made by any third
                        party due to or arising out of your breach of the Terms, your violation of any law, or your
                        violation of the rights of a third party, including the infringement by you of any intellectual
                        property or other right of any person or entity. These obligations will survive any termination of
                        the Terms.</span>
                </p>
                <p
                    style='margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;text-align:justify;line-height:150%;'>
                    <span style='font-family:"Arial",sans-serif;'>&nbsp;</span>
                </p>
                <p
                    style='margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;text-align:justify;line-height:150%;'>
                    <strong><span style='font-family:"Arial",sans-serif;'>Limitation of Liability</span></strong>
                </p>
                <p
                    style='margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;text-align:justify;line-height:150%;'>
                    <span style='font-family:"Arial",sans-serif;'>You expressly agree that use of the Website, the Services
                        and the course materials is at your sole risk. We do not warrant that the Website, the Services or
                        access to the course materials will be uninterrupted or error free; nor is there any warranty as to
                        the results that may be obtained from the use of the Website, the Services or the course materials
                        or as to the accuracy or reliability of any information provided through the Website, the Services
                        or the course materials. We do not guarantee any particular outcome regarding the results of the
                        users during the entrance exams.</span>
                </p>
                <p
                    style='margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;text-align:justify;line-height:150%;'>
                    <span style='font-family:"Arial",sans-serif;'>In no event will We, or Our affiliates will be liable for
                        any direct, indirect, incidental, special or consequential damages arising out of the use of or
                        inability to use the Website, the Services or the course materials. You agree that Our liability or
                        the liability of Our affiliates, directors, officers, employees, agents and licensors, if any,
                        arising out of any kind of legal claim (whether in contract, tort or otherwise) in any way connected
                        with the Services or the course materials shall not exceed the fee You paid to Us for the
                        particular/relevant package.</span>
                </p>
                <p
                    style='margin-top:12.0pt;margin-right:0cm;margin-bottom:12.0pt;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;text-align:justify;line-height:150%;'>
                    <strong><span style='font-family:"Arial",sans-serif;'>Third-Party Services</span></strong>
                </p>
                <p
                    style='margin-top:12.0pt;margin-right:0cm;margin-bottom:12.0pt;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;text-align:justify;line-height:150%;'>
                    <span style='font-family:"Arial",sans-serif;'>As part of the Service, we may provide links or other
                        connections to third-party services or websites. We are not responsible for the privacy practices or
                        the content of such third parties. We encourage You to review the privacy policies of these third
                        parties before using their services or providing them with Your information.</span>
                </p>
                <p
                    style='margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;text-align:justify;line-height:150%;'>
                    <strong><span style='font-family:"Arial",sans-serif;'>Revision of Terms</span></strong>
                </p>
                <p
                    style='margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;text-align:justify;line-height:150%;'>
                    <span style='font-family:"Arial",sans-serif;'>Information on the Website including the Terms is subject
                        to change at Our discretion at any time, without any prior notice or obligation to notify
                        You.</span>
                </p>
                <p
                    style='margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:0cm;font-size:11.0pt;font-family:"Calibri",sans-serif;text-align:justify;line-height:150%;'>
                    <span style='font-family:"Arial",sans-serif;'>&nbsp;</span>
                </p>
            </div>
        </div>
    </section>
@endsection
