@extends('site.app')
@section('conteudo')
        <!-- slider area start here -->
        <section class="bd-slider-area fix">
            <div class="bd-slider-actives">
                <div class="swiper-wrappers">
                    <div class="bd-single-slider gray-bg bd-slider-height pt-200 w-full position-relative">
                        <img src="{{ asset('assets.site/img/slider/slider-shape-5.png') }}" class="bd-slider-six-img-shape5" alt="img not found">
                        <div class="container">
                            <div class="row align-items-center">
                                <div class="col-xl-7">
                                    <div class="bd-slider-six">
                                        <h1 class="bd-slider-six-title mb-30 wow fadeInUp" data-wow-delay=".2s">Take Your <span>Business</span> to <br>The Next Level</h1>
                                        <div class="bd-slider-video-spacing mb-90">
                                            <div class="bd-slider-five-btn wow fadeInUp" data-wow-delay=".4s">
                                                <a href="contact.html" class="theme-btn">Say Hello <i class="flaticon-email-1"></i></a>
                                            </div>
                                            <div class="bd-slider-five-video">
                                                <div class="bd-slider-five-video-icon wow fadeInUp" data-wow-delay=".6s">
                                                    <a href="https://www.youtube.com/watch?v=jdkWIdJobSA" class="play_btn popup-video"><i class="flaticon-play"></i></a>
                                                </div>
                                                <div class="bd-slider-five-video-text wow fadeInUp" data-wow-delay=".8s">
                                                    <span>Watch</span>
                                                    <h5>How I work</h5>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="bd-slider-facts bd-slider-facts-six">
                                            <ul>
                                                <li>
                                                    <div class="bd-slider-fact wow fadeInUp" data-wow-delay="1s">
                                                        <h4 class="bd-slider-fact-title text-heading"><span class="odometer" data-count="5"></span>K+</h4>
                                                        <span class="bd-slider-fact-subtitle text-heading">Global Happy Clients</span>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="bd-slider-fact wow fadeInUp" data-wow-delay="1.2s">
                                                        <h4 class="bd-slider-fact-title text-heading"><span class="odometer" data-count="18"></span>K</h4>
                                                        <span class="bd-slider-fact-subtitle text-heading">Project Cmpleted</span>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-5">
                                    <div class="bd-slider-six-img">
                                        <img src="{{ asset('assets.site/img/slider/slider-img-1.jpg') }}" class="rounded-10" alt="img not found">
                                        <img src="{{ asset('assets.site/img/slider/slider-shape-3.png') }}" class="bd-slider-six-img-shape1" alt="img not found">
                                        <img src="{{ asset('assets.site/img/slider/slider-shape-4.png') }}" class="bd-slider-six-img-shape2" alt="img not found">
                                        <img src="{{ asset('assets.site/img/slider/slider-shape-6.png') }}" class="bd-slider-six-img-shape3" alt="img not found">
                                        <img src="{{ asset('assets.site/img/slider/slider-shape-7.png') }}" class="bd-slider-six-img-shape4" alt="img not found">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- slider area end here -->

        <!-- service area start here -->
        <section class="bd-service-area pt-145 pb-120">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="bd-section-title-wrapper text-center mb-50">
                            <h5 class="bd-section-subtitle mb-15 subtitle-without-border">Creative Service</h5>
                            <h2 class="bd-section-title mb-25">Solution we offer you</h2>
                            <p>Experiences that keep your customers coming back for more information about <br>services Makes best effort</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-md-6">
                        <div class="bd-service bd-service-four mb-30">
                            <div class="bd-service-icon mb-20">
                                <i class="flaticon-help"></i>
                            </div>
                            <h4 class="bd-service-title mb-20"><a href="service-details.html">Consultancy</a></h4>
                            <p>Experiences that keep your customers coming back for more information about services Makes best effort</p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="bd-service bd-service-four mb-30">
                            <div class="bd-service-icon mb-20">
                                <i class="flaticon-coding"></i>
                            </div>
                            <h4 class="bd-service-title mb-20"><a href="service-details.html">Web Development</a></h4>
                            <p>Reach new audiences with omnichannel commerce anywhere in the world and surpass industry</p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="bd-service bd-service-four mb-30">
                            <div class="bd-service-icon mb-20">
                                <i class="flaticon-notes"></i>
                            </div>
                            <h4 class="bd-service-title mb-20"><a href="service-details.html">Content Writing</a></h4>
                            <p>Use drag-and-drop functionality, custom product recommendations and headless customize your website.</p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="bd-service bd-service-four mb-30">
                            <div class="bd-service-icon mb-20">
                                <i class="flaticon-curve"></i>
                            </div>
                            <h4 class="bd-service-title mb-20"><a href="service-details.html">Creative Design</a></h4>
                            <p>Faceted search built off of Elasticsearch, including custom field support for refined searchable partner.</p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="bd-service bd-service-four mb-30">
                            <div class="bd-service-icon mb-20">
                                <i class="flaticon-seo"></i>
                            </div>
                            <h4 class="bd-service-title mb-20"><a href="service-details.html">Consultancy</a></h4>
                            <p>SEO where your customers are shopping by integrating with top marketplaces such as business ranking.</p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="bd-service bd-service-four mb-30">
                            <div class="bd-service-icon mb-20">
                                <i class="flaticon-bullhorn"></i>
                            </div>
                            <h4 class="bd-service-title mb-20"><a href="service-details.html">Digital MArketing</a></h4>
                            <p>Make it easier for your customers to pay with a broad spectrum of flexible payment methods and credit authorization.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- service area end here -->

        <!-- about area start here -->
        <section class="bd-about-six-area gray-bg pt-150 pb-150">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-8">
                        <div class="bd-about-six-img">
                            <img src="{{ asset('assets.site/img/about/about-img-7.jpg') }}" class="pl-60" alt="img not found">
                            <img src="{{ asset('assets.site/img/about/about-img-8.jpg') }}" class="bd-about-six-img-second" alt="img not found">
                            <img src="{{ asset('assets.site/img/about/about-img-9.jpg') }}" class="bd-about-six-img-third" alt="img not found">
                            <div class="bd-about-six-img-expe">
                                <h2>25+</h2>
                                <span>Years Experience</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="bd-about-six-text">
                            <div class="bd-section-title-wrapper mb-25">
                                <h5 class="bd-section-subtitle mb-15 subtitle-without-border">About Company</h5>
                                <h2 class="bd-section-title mb-25">We always work Passionately</h2>
                                <p>Digital marketing spans across a massive network of digital touchpoints that customers interact with many times a day. To properly utilize these channels. You need to have an understanding of each engine specific set of keyword research with proper terms.</p>
                            </div>
                            <div class="bd-about-six-feature">
                                <h5 class="bd-about-six-feature-title mb-20">Key Features</h5>
                                <ul class="mb-45">
                                    <li><i class="far fa-check"></i> Marketing Data Environment</li>
                                    <li><i class="far fa-check"></i> Content Personalization</li>
                                    <li><i class="far fa-check"></i> Corporate Business Impact Analytics</li>
                                    <li><i class="far fa-check"></i> Experience Automation</li>
                                </ul>
                            </div>
                            <div class="bd-about-six-btn">
                                <a href="about.html" class="theme-btn">Know More</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- about area end here -->

        <!-- portfolio area start here -->
        <section class="bd-portfolio-area pt-145 pb-120">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="bd-section-title-wrapper text-center mb-50">
                            <h5 class="bd-section-subtitle mb-15 subtitle-without-border">Creative Portfolio</h5>
                            <h2 class="bd-section-title mb-25">Recent work example</h2>
                            <p>Experiences that keep your customers coming back for more information about <br>services Makes best effort</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-md-6">
                        <div class="bd-portfolio mb-30">
                            <img src="{{ asset('assets.site/img/portfolio/portfolio-img-1.jpg') }}" alt="porfolio not found">
                            <div class="bd-portfolio-text">
                                <span>Development</span>
                                <h5 class="bd-portfolio-title"><a href="portfolio-details.html">Web Business Plan</a></h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="bd-portfolio mb-30">
                            <img src="{{ asset('assets.site/img/portfolio/portfolio-img-2.jpg') }}" alt="porfolio not found">
                            <div class="bd-portfolio-text">
                                <span>Consultancy</span>
                                <h5 class="bd-portfolio-title"><a href="portfolio-details.html">Web Consultancy Plan</a></h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="bd-portfolio mb-30">
                            <img src="{{ asset('assets.site/img/portfolio/portfolio-img-3.jpg') }}" alt="porfolio not found">
                            <div class="bd-portfolio-text">
                                <span>Content Writing</span>
                                <h5 class="bd-portfolio-title"><a href="portfolio-details.html">Content Writing Plan</a></h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- portfolio area end here -->

        <!-- testimonial area start here -->
        <section class="bd-testimonial-area-four pb-145">
            <div class="container">
                <div class="bd-testimonial-four-active swiper-container">
                    <div class="swiper-wrapper pb-40">
                        <div class="swiper-slide">
                            <div class="bd-testimonial-four">
                                <div class="bd-testimonial-four-img">
                                    <img src="{{ asset('assets.site/img/testimonial/testimonial-author-3.png') }}" alt="img not found">
                                </div>
                                <div class="bd-testimonial-four-text">
                                    <i class="fas fa-quote-left mb-20"></i>
                                    <h3 class="bd-testimonial-four-text-title mb-15">Build content-rich and secure customer experiences with Drupal on the front-end and BigCommerce on the back-end.</h3>
                                    <h6>David Johnson</h6>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="bd-testimonial-four">
                                <div class="bd-testimonial-four-img">
                                    <img src="{{ asset('assets.site/img/testimonial/testimonial-author-4.png') }}" alt="img not found">
                                </div>
                                <div class="bd-testimonial-four-text">
                                    <i class="fas fa-quote-left mb-20"></i>
                                    <h3 class="bd-testimonial-four-text-title mb-15">Build content-rich and secure customer experiences with Drupal on the front-end and BigCommerce on the back-end.</h3>
                                    <h6>David Warner</h6>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="bd-testimonial-four">
                                <div class="bd-testimonial-four-img">
                                    <img src="{{ asset('assets.site/img/testimonial/testimonial-author-5.png') }}" alt="img not found">
                                </div>
                                <div class="bd-testimonial-four-text">
                                    <i class="fas fa-quote-left mb-20"></i>
                                    <h3 class="bd-testimonial-four-text-title mb-15">Build content-rich and secure customer experiences with Drupal on the front-end and BigCommerce on the back-end.</h3>
                                    <h6>Steve Smith</h6>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- If we need pagination -->
                    <div class="testimonial-pagination testimonial-dots"></div>
                </div>
            </div>
        </section>
        <!-- testimonial area end here -->

        <!-- pricing area start here -->
        <section class="bd-pricing-area gray-bg pt-145 pb-120">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="bd-section-title-wrapper mb-50 z-index text-center">
                            <h5 class="bd-section-subtitle mb-15">Price Table</h5>
                            <h2 class="bd-section-title mb-25">Pricing & Packaging</h2>
                            <p>Experiences that keep your customers coming back for more information <br>about services Makes best effort</p>
                        </div>
                    </div>
                </div>
                    <nav class="text-center mb-60">
                    <div class="nav bd-pricing-tabs justify-content-center" id="nav-tab" role="tablist">
                      <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Montly</button>
                      <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Yearly</button>
                    </div>
                  </nav>
                  <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                        <div class="row">
                            <div class="col-lg-4 col-md-6">
                                <div class="bd-pricing mb-30">
                                    <div class="bd-pricing-title-wrapper text-center mb-65">
                                        <h6 class="bd-pricing-subtitle mb-15">Startup Plan</h6>
                                        <h6 class="bd-pricing-price">$19<span>.00/Month</span></h6>
                                    </div>
                                    <ul class="mb-80">
                                        <li><i class="fal fa-check"></i> 10 GB Data</li>
                                        <li><i class="fal fa-check"></i> Marketing Calendar</li>
                                        <li><i class="fal fa-check"></i> Personalization</li>
                                        <li><i class="fal fa-check"></i> 3 Sandboxs</li>
                                        <li><i class="fal fa-check"></i> Secure Domains</li>
                                        <li><i class="fal fa-check"></i> Dynamic Content</li>
                                    </ul>
                                    <div class="bd-pricing-btn">
                                        <a href="contact.html" class="theme-btn">Select Plan</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="bd-pricing mb-30 bd-pricing-active">
                                    <div class="bd-pricing-title-wrapper text-center mb-65">
                                        <h6 class="bd-pricing-subtitle mb-15">Premium Plan</h6>
                                        <h6 class="bd-pricing-price">$49<span>.00/Month</span></h6>
                                    </div>
                                    <ul class="mb-80">
                                        <li><i class="fal fa-check"></i> 20 GB Data</li>
                                        <li><i class="fal fa-check"></i> Marketing Calendar</li>
                                        <li><i class="fal fa-check"></i> Personalization</li>
                                        <li><i class="fal fa-check"></i> 10 Sandboxs</li>
                                        <li><i class="fal fa-check"></i> Secure Domains</li>
                                        <li><i class="fal fa-check"></i> Dynamic Content</li>
                                    </ul>
                                    <div class="bd-pricing-btn">
                                        <a href="contact.html" class="theme-btn-black">Select Plan</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="bd-pricing mb-30">
                                    <div class="bd-pricing-title-wrapper text-center mb-65">
                                        <h6 class="bd-pricing-subtitle mb-15">Enterprise</h6>
                                        <h6 class="bd-pricing-price">$79<span>.00/Month</span></h6>
                                    </div>
                                    <ul class="mb-80">
                                        <li><i class="fal fa-check"></i> 100 GB Data</li>
                                        <li><i class="fal fa-check"></i> Marketing Calendar</li>
                                        <li><i class="fal fa-check"></i> Personalization</li>
                                        <li><i class="fal fa-check"></i> 20 Sandboxs</li>
                                        <li><i class="fal fa-check"></i> Secure Domains</li>
                                        <li><i class="fal fa-check"></i> Dynamic Content</li>
                                    </ul>
                                    <div class="bd-pricing-btn">
                                        <a href="contact.html" class="theme-btn">Select Plan</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                        <div class="row">
                            <div class="col-lg-4 col-md-6">
                                <div class="bd-pricing mb-30">
                                    <div class="bd-pricing-title-wrapper text-center mb-65">
                                        <h6 class="bd-pricing-subtitle mb-15">Startup Plan</h6>
                                        <h6 class="bd-pricing-price">$29<span>.00/Year</span></h6>
                                    </div>
                                    <ul class="mb-80">
                                        <li><i class="fal fa-check"></i> 10 GB Data</li>
                                        <li><i class="fal fa-check"></i> Marketing Calendar</li>
                                        <li><i class="fal fa-check"></i> Personalization</li>
                                        <li><i class="fal fa-check"></i> 3 Sandboxs</li>
                                        <li><i class="fal fa-check"></i> Secure Domains</li>
                                        <li><i class="fal fa-check"></i> Dynamic Content</li>
                                    </ul>
                                    <div class="bd-pricing-btn">
                                        <a href="contact.html" class="theme-btn">Select Plan</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="bd-pricing mb-30 bd-pricing-active">
                                    <div class="bd-pricing-title-wrapper text-center mb-65">
                                        <h6 class="bd-pricing-subtitle mb-15">Premium Plan</h6>
                                        <h6 class="bd-pricing-price">$79<span>.00/Year</span></h6>
                                    </div>
                                    <ul class="mb-80">
                                        <li><i class="fal fa-check"></i> 20 GB Data</li>
                                        <li><i class="fal fa-check"></i> Marketing Calendar</li>
                                        <li><i class="fal fa-check"></i> Personalization</li>
                                        <li><i class="fal fa-check"></i> 10 Sandboxs</li>
                                        <li><i class="fal fa-check"></i> Secure Domains</li>
                                        <li><i class="fal fa-check"></i> Dynamic Content</li>
                                    </ul>
                                    <div class="bd-pricing-btn">
                                        <a href="contact.html" class="theme-btn-black">Select Plan</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="bd-pricing mb-30">
                                    <div class="bd-pricing-title-wrapper text-center mb-65">
                                        <h6 class="bd-pricing-subtitle mb-15">Enterprise</h6>
                                        <h6 class="bd-pricing-price">$89<span>.00/Year</span></h6>
                                    </div>
                                    <ul class="mb-80">
                                        <li><i class="fal fa-check"></i> 100 GB Data</li>
                                        <li><i class="fal fa-check"></i> Marketing Calendar</li>
                                        <li><i class="fal fa-check"></i> Personalization</li>
                                        <li><i class="fal fa-check"></i> 20 Sandboxs</li>
                                        <li><i class="fal fa-check"></i> Secure Domains</li>
                                        <li><i class="fal fa-check"></i> Dynamic Content</li>
                                    </ul>
                                    <div class="bd-pricing-btn">
                                        <a href="contact.html" class="theme-btn">Select Plan</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                  </div>
            </div>
        </section>
        <!-- pricing area end here -->

        <!-- team area start here -->
        <section class="bd-team-area pb-145 pt-145">
            <div class="container">
                <div class="row align-items-center pb-25">
                    <div class="col-lg-6">
                        <div class="bd-section-title-wrapper mb-20">
                            <h5 class="bd-section-subtitle mb-15 subtitle-without-border">Creative Team</h5>
                            <h2 class="bd-section-title">Our experienced team</h2>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="bd-section-title-wrapper mb-20">
                            <p class="m-0">Experiences that keep your customers coming back for more information about services Makes best effort. The most completed powerful experience automation.</p>
                        </div>
                    </div>
                </div>

                <div class="bd-team-active swiper-container">
                    <div class="swiper-wrapper pb-40">
                        <div class="swiper-slide">
                            <div class="bd-portfolio bd-team-four mb-30">
                                <img src="{{ asset('assets.site/img/team/team-img-1.jpg') }}" alt="porfolio not found">
                                <div class="bd-team-four-text">
                                    <h5 class="bd-team-four-title"><a href="portfolio-details.html">Dallas Anderson</a></h5>
                                    <span>Web Developer</span>
                                    <div class="bd-team-four-social">
                                        <ul>
                                            <li><a href="#" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
                                            <li><a href="#" target="_blank"><i class="fab fa-twitter"></i></a></li>
                                            <li><a href="#" target="_blank"><i class="fab fa-vimeo-v"></i></a></li>
                                            <li><a href="#" target="_blank"><i class="fab fa-linkedin-in"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="bd-portfolio bd-team-four mb-30">
                                <img src="{{ asset('assets.site/img/team/team-img-2.jpg') }}" alt="porfolio not found">
                                <div class="bd-team-four-text">
                                    <h5 class="bd-team-four-title"><a href="portfolio-details.html">Shane Watson</a></h5>
                                    <span>Web Designer</span>
                                    <div class="bd-team-four-social">
                                        <ul>
                                            <li><a href="#" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
                                            <li><a href="#" target="_blank"><i class="fab fa-twitter"></i></a></li>
                                            <li><a href="#" target="_blank"><i class="fab fa-vimeo-v"></i></a></li>
                                            <li><a href="#" target="_blank"><i class="fab fa-linkedin-in"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="bd-portfolio bd-team-four mb-30">
                                <img src="{{ asset('assets.site/img/team/team-img-3.jpg') }}" alt="porfolio not found">
                                <div class="bd-team-four-text">
                                    <h5 class="bd-team-four-title"><a href="portfolio-details.html">David Warner</a></h5>
                                    <span>React Developer</span>
                                    <div class="bd-team-four-social">
                                        <ul>
                                            <li><a href="#" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
                                            <li><a href="#" target="_blank"><i class="fab fa-twitter"></i></a></li>
                                            <li><a href="#" target="_blank"><i class="fab fa-vimeo-v"></i></a></li>
                                            <li><a href="#" target="_blank"><i class="fab fa-linkedin-in"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="bd-portfolio bd-team-four mb-30">
                                <img src="{{ asset('assets.site/img/team/team-img-1.jpg') }}" alt="porfolio not found">
                                <div class="bd-team-four-text">
                                    <h5 class="bd-team-four-title"><a href="portfolio-details.html">Steve Long</a></h5>
                                    <span>Vue Developer</span>
                                    <div class="bd-team-four-social">
                                        <ul>
                                            <li><a href="#" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
                                            <li><a href="#" target="_blank"><i class="fab fa-twitter"></i></a></li>
                                            <li><a href="#" target="_blank"><i class="fab fa-vimeo-v"></i></a></li>
                                            <li><a href="#" target="_blank"><i class="fab fa-linkedin-in"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="bd-portfolio bd-team-four mb-30">
                                <img src="{{ asset('assets.site/img/team/team-img-2.jpg') }}" alt="porfolio not found">
                                <div class="bd-team-four-text">
                                    <h5 class="bd-team-four-title"><a href="portfolio-details.html">Williamson</a></h5>
                                    <span>Angular Developer</span>
                                    <div class="bd-team-four-social">
                                        <ul>
                                            <li><a href="#" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
                                            <li><a href="#" target="_blank"><i class="fab fa-twitter"></i></a></li>
                                            <li><a href="#" target="_blank"><i class="fab fa-vimeo-v"></i></a></li>
                                            <li><a href="#" target="_blank"><i class="fab fa-linkedin-in"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- If we need pagination -->
                    <div class="team-pagination team-dots"></div>
                </div>
            </div>
        </section>
        <!-- team area end here -->

        <!-- blog area start here -->
        <section class="bd-blog-area pt-145 pb-120 gray-bg">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="bd-section-title-wrapper text-center mb-50">
                            <h5 class="bd-section-subtitle mb-15">Creative Blog</h5>
                            <h2 class="bd-section-title mb-25">News insight</h2>
                            <p>Experiences that keep your customers coming back for more information about <br>services Makes best effort</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-md-6">
                        <div class="bd-blog mb-30">
                            <div class="bd-blog-img">
                                <a href="blog-details.html"><img src="{{ asset('assets.site/img/blog/blog-img-1.jpg') }}" alt="blog image not found"></a>
                            </div>
                            <div class="bd-blog-text bd-blog-text-six">
                                <div class="bd-blog-meta mb-15">
                                    <ul>
                                        <li><a href="blog-details.html"><i class="flaticon-calendar"></i>21 Feb 2022</a></li>
                                        <li><a href="blog-details.html"><i class="flaticon-chat"></i>12 Comments</a></li>
                                    </ul>
                                </div>
                                <h4 class="bd-blog-title mb-40"><a href="blog-details.html">Getting started with business level improved</a></h4>
                                <div class="bd-blog-author">
                                    <div class="bd-blog-author-info">
                                        <img src="{{ asset('assets.site/img/blog/blog-author-1.jpg') }}" alt="author image not found">
                                        <h6 class="bd-blog-author-info-title">Daniyel</h6>
                                    </div>
                                    <div class="bd-blog-author-link">
                                        <a href="blog-details.html">Read More <i class="far fa-arrow-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="bd-blog mb-30">
                            <div class="bd-blog-img">
                                <a href="blog-details.html"><img src="{{ asset('assets.site/img/blog/blog-img-2.jpg') }}" alt="blog image not found"></a>
                            </div>
                            <div class="bd-blog-text bd-blog-text-six">
                                <div class="bd-blog-meta mb-15">
                                    <ul>
                                        <li><a href="blog-details.html"><i class="flaticon-calendar"></i>22 Feb 2022</a></li>
                                        <li><a href="blog-details.html"><i class="flaticon-chat"></i>8 Comments</a></li>
                                    </ul>
                                </div>
                                <h4 class="bd-blog-title mb-40"><a href="blog-details.html">Modern fluid typography used in website Clamp</a></h4>
                                <div class="bd-blog-author">
                                    <div class="bd-blog-author-info">
                                        <img src="{{ asset('assets.site/img/blog/blog-author-2.jpg') }}" alt="author image not found">
                                        <h6 class="bd-blog-author-info-title">Saimon</h6>
                                    </div>
                                    <div class="bd-blog-author-link">
                                        <a href="blog-details.html">Read More <i class="far fa-arrow-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="bd-blog mb-30">
                            <div class="bd-blog-img">
                                <a href="blog-details.html"><img src="{{ asset('assets.site/img/blog/blog-img-3.jpg') }}" alt="blog image not found"></a>
                            </div>
                            <div class="bd-blog-text bd-blog-text-six">
                                <div class="bd-blog-meta mb-15">
                                    <ul>
                                        <li><a href="blog-details.html"><i class="flaticon-calendar"></i>24 Feb 2022</a></li>
                                        <li><a href="blog-details.html"><i class="flaticon-chat"></i>5 Comments</a></li>
                                    </ul>
                                </div>
                                <h4 class="bd-blog-title mb-40"><a href="blog-details.html">New fresh mobile template for business</a></h4>
                                <div class="bd-blog-author">
                                    <div class="bd-blog-author-info">
                                        <img src="{{ asset('assets.site/img/blog/blog-author-1.jpg') }}" alt="author image not found">
                                        <h6 class="bd-blog-author-info-title">Daniyel</h6>
                                    </div>
                                    <div class="bd-blog-author-link">
                                        <a href="blog-details.html">Read More <i class="far fa-arrow-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- blog area end here -->

        <!-- brand area start here -->
        <section class="bd-brand-area-four pt-145 pb-150">
            <div class="container"> 
                <div class="row">
                    <div class="col-12">
                        <div class="bd-brand-area-four-title text-center mb-55">
                            <h4>Global brands we worked with</h4>
                        </div>
                    </div>
                </div>
                <div class="bd-brand-active swiper-container">
                    <div class="swiper-wrapper">
                        <div class="bd-brand-single swiper-slide">
                            <a href="#"><img src="{{ asset('assets.site/img/brand/brand-1.png') }}" alt="brand img not found"></a>
                        </div>
                        <div class="bd-brand-single swiper-slide">
                            <a href="#"><img src="{{ asset('assets.site/img/brand/brand-2.png') }}" alt="brand img not found"></a>
                        </div>
                        <div class="bd-brand-single swiper-slide">
                            <a href="#"><img src="{{ asset('assets.site/img/brand/brand-3.png') }}" alt="brand img not found"></a>
                        </div>
                        <div class="bd-brand-single swiper-slide">
                            <a href="#"><img src="{{ asset('assets.site/img/brand/brand-4.png') }}" alt="brand img not found"></a>
                        </div>
                        <div class="bd-brand-single swiper-slide">
                            <a href="#"><img src="{{ asset('assets.site/img/brand/brand-5.png') }}" alt="brand img not found"></a>
                        </div>
                        <div class="bd-brand-single swiper-slide">
                            <a href="#"><img src="{{ asset('assets.site/img/brand/brand-6.png') }}" alt="brand img not found"></a>
                        </div>
                        <div class="bd-brand-single swiper-slide">
                            <a href="#"><img src="{{ asset('assets.site/img/brand/brand-1.png') }}" alt="brand img not found"></a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- brand area end here -->

        <!-- footer area start here -->
        <footer class="gray-bg">
            <div class="bd-footer-area pt-100 pb-60">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-4 col-sm-6">
                            <div class="bd-footer-widget bd-footer-widget-six footer-col-5 mb-30">
                                <div class="bd-footer-info">
                                    <div class="bd-footer-info-logo mb-35">
                                        <a href="index.html"><img src="{{ asset('assets.site/img/logo/Logo-black.png') }}" class="img-fluid" alt="img not found"></a>
                                    </div>
                                    <p class="mb-30">Deliver exceptional experiences across every stage of the customer journey to drive efficient growth in concert with Sales.</p>
                                    <div class="bd-footer-widget-six-social">
                                        <a href="#" target="_blank"><i class="fab fa-facebook-f"></i></a>
                                        <a href="#" target="_blank"><i class="fab fa-twitter"></i></a>
                                        <a href="#" target="_blank"><i class="fab fa-instagram"></i></a>
                                        <a href="#" target="_blank"><i class="fab fa-google"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6">
                            <div class="bd-footer-widget bd-footer-widget-six footer-col-6 mb-30">
                                <h5 class="bd-footer-widget-title bd-footer-widget-title-six mb-35">Information</h5>
                                <ul>
                                    <li><a href="service-details.html">Agency Overview</a></li>
                                    <li><a href="service-details.html">Services</a></li>
                                    <li><a href="service-details.html">Developer Tools</a></li>
                                    <li><a href="service-details.html">Contact Tech</a></li>
                                    <li><a href="service-details.html">Careers</a></li>
                                    <li><a href="service-details.html">Global Partner</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-2 col-sm-6">
                            <div class="bd-footer-widget bd-footer-widget-six footer-col-7 mb-30">
                                <h5 class="bd-footer-widget-title bd-footer-widget-title-six mb-35">Quick Links</h5>
                                <ul>
                                    <li><a href="about.html">About Company</a></li>
                                    <li><a href="team.html">Team</a></li>
                                    <li><a href="service-details.html">Features</a></li>
                                    <li><a href="contact.html">Documentation</a></li>
                                    <li><a href="contact.html">Resource</a></li>
                                    <li><a href="contact.html">Store Example</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6">
                            <div class="bd-footer-widget bd-footer-widget-six footer-col-8 mb-30">
                                <h5 class="bd-footer-widget-title bd-footer-widget-title-six mb-40">Get in Touch</h5>
                                <div class="bd-footer-info">
                                    <div class="bd-footer-info-item bd-footer-info-item-six mb-10">
                                        <h6>Phone : </h6>
                                        <a href="tel:(+88)258-241-302">(+88) 258 - 241 - 302</a>
                                    </div>
                                    <div class="bd-footer-info-item bd-footer-info-item-six mb-10">
                                        <h6>Email : </h6>
                                        <a href="https://themepure.net/cdn-cgi/l/email-protection#93fafdf5fcd3f6ebf2fee3fff6bdf0fcfe"><span class="__cf_email__" data-cfemail="563f38303916332e373b263a337835393b">[email&#160;protected]</span></a>
                                    </div>
                                    <div class="bd-footer-info-item bd-footer-info-item-six">
                                        <h6>Location :</h6>
                                        <a href="#">258712 Street Park, New York, USA</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bd-copyright-area-six">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6 order-2 order-lg-1">
                            <div class="bd-copyright-six pb-10 text-center text-lg-start">
                                <p class="m-0">© 2022 All rights reserved | Design & Develop by <a href="https://themeforest.net/user/bdevs/portfolio">BDevs</a></p>
                            </div>
                        </div>
                        <div class="col-lg-6 order-1 order-lg-2">
                            <div class="bd-copyright-six pb-10 text-lg-end text-center">
                                <ul>
                                    <li><a href="contact.html">Privacy</a></li>
                                    <li><a href="contact.html">Terms</a></li>
                                    <li><a href="contact.html">Contact</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- footer area end here -->
@stop
