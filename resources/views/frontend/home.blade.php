@extends('frontend.layouts.homepage')
@section('content')
 <header id="slider-area">  
      <nav class="navbar navbar-expand-md fixed-top scrolling-navbar bg-white">
        <div class="container">          
          <a class="navbar-brand" href="index.html"><span class="lni-bulb"></span>ESSENCE</a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <i class="lni-menu"></i>
          </button>
          <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav mr-auto w-100 justify-content-end">
              <li class="nav-item">
                <a class="nav-link page-scroll" href="#slider-area">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link page-scroll" href="#services">Services</a>
              </li>  
              <li class="nav-item">
                <a class="nav-link page-scroll" href="#features">Features</a>
              </li>                            
              <li class="nav-item">
                <a class="nav-link page-scroll" href="#portfolios">Works</a>
              </li>            
              <li class="nav-item">
                <a class="nav-link page-scroll" href="#pricing">Pricing</a>
              </li> 
              <li class="nav-item">
                <a class="nav-link page-scroll" href="#team">Team</a>
              </li>    
              <li class="nav-item">
                <a class="nav-link page-scroll" href="#subscribe">Subscribe</a>
              </li>
              <li class="nav-item">
                <a class="nav-link page-scroll" href="#blog">Blog</a>
              </li> 
              <li class="nav-item">
                <a class="nav-link page-scroll" href="#contact">Contact</a>
              </li> 
            </ul>              
          </div>
        </div>
      </nav> 

      <!-- Main Carousel Section -->
      <div id="carousel-area">
        <div id="carousel-slider" class="carousel slide carousel-fade" data-ride="carousel">
          <ol class="carousel-indicators">
            <li data-target="#carousel-slider" data-slide-to="0" class="active"></li>
            <li data-target="#carousel-slider" data-slide-to="1"></li>
            <li data-target="#carousel-slider" data-slide-to="2"></li>
          </ol>
          <div class="carousel-inner" role="listbox">
            <div class="carousel-item active">
              <img src="{{ asset('frontend/img/slider/bg-1.jpg')}}" alt="">
              <div class="carousel-caption text-left">
                <h3 class="wow fadeInRight" data-wow-delay="0.2s">Handcrafted</h1>  
                <h2 class="wow fadeInRight" data-wow-delay="0.4s">Bootstrap 4 Template</h2>
                <h4 class="wow fadeInRight" data-wow-delay="0.6s">Comes with All Essential Sections & Elements</h4>
                <a href="#" class="btn btn-lg btn-common btn-effect wow fadeInRight" data-wow-delay="0.9s">Download</a>
                <a href="#" class="btn btn-lg btn-border wow fadeInRight" data-wow-delay="1.2s">Get Started!</a>
              </div>
            </div>
            <div class="carousel-item">
              <img src="{{ asset('frontend/img/slider/bg-3.jpg') }}" alt="">
              <div class="carousel-caption text-center">
                <h3 class="wow fadeInDown" data-wow-delay="0.3s">Bundled With Tons of</h3>
                <h2 class="wow bounceIn" data-wow-delay="0.6s">Cutting-edge Features</h2> 
                <h4 class="wow fadeInUp" data-wow-delay="0.9s">Parallax, Video, Product, Premium Addons and More...</h4>
                <a href="#" class="btn btn-lg btn-common btn-effect wow fadeInUp" data-wow-delay="1.2s">View Works</a>
              </div>
            </div>
            <div class="carousel-item">
              <img src="{{ asset('frontend/img/slider/bg-2.jpg') }}" alt="">
              <div class="carousel-caption text-center">
                <h3 class="wow fadeInDown" data-wow-delay="0.3s">Ready For</h3>
                <h2 class="wow fadeInRight" data-wow-delay="0.6s">Multi-purpose Websites</h2> 
                <h4 class="wow fadeInUp" data-wow-delay="0.6s">App, Business, SaaS and Landing Pages</h4>
                <a href="#" class="btn btn-lg btn-border wow fadeInUp" data-wow-delay="0.9s">Purchase</a>
              </div>
            </div>
          </div>
          <a class="carousel-control-prev" href="#carousel-slider" role="button" data-slide="prev">
            <span class="carousel-control" aria-hidden="true"><i class="lni-chevron-left"></i></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#carousel-slider" role="button" data-slide="next">
            <span class="carousel-control" aria-hidden="true"><i class="lni-chevron-right"></i></span>
            <span class="sr-only">Next</span>
          </a>
        </div>
      </div>  

    </header>
    <!-- Header Section End --> 

    <!-- Services Section Start -->
    <section id="services" class="section">
      <div class="container">
        <div class="section-header">          
          <h2 class="section-title">Our Services</h2>
          <span>Services</span>
          <p class="section-subtitle">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy</p>
        </div>
        <div class="row">
          <div class="col-lg-4 col-md-6 col-xs-12">
            <div class="item-boxes services-item wow fadeInDown" data-wow-delay="0.2s">
              <div class="icon color-1">
                <i class="lni-pencil"></i>
              </div>
              <h4>Content Writing</h4>
              <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut.</p>
            </div>
          </div>
          <div class="col-lg-4 col-md-6 col-xs-12">
            <div class="item-boxes services-item wow fadeInDown" data-wow-delay="0.4s">
              <div class="icon color-2">
                <i class="lni-cog"></i>
              </div>
              <h4>Web Development</h4>
              <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut.</p>
            </div>
          </div>
          <div class="col-lg-4 col-md-6 col-xs-12">
            <div class="item-boxes services-item wow fadeInDown" data-wow-delay="0.6s">
              <div class="icon color-3">
                <i class="lni-stats-up"></i>
              </div>
              <h4>Graphic Design</h4>
              <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut.</p>
            </div>
          </div>
          <div class="col-lg-4 col-md-6 col-xs-12">
            <div class="item-boxes services-item wow fadeInDown" data-wow-delay="0.8s">
              <div class="icon color-4">
                <i class="lni-layers"></i>
              </div>
              <h4>UI/UX Design</h4>
              <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut.</p>
            </div>
          </div>
          <div class="col-lg-4 col-md-6 col-xs-12">
            <div class="item-boxes services-item wow fadeInDown" data-wow-delay="1s">
              <div class="icon color-5">
                <i class="lni-tab"></i>
              </div>
              <h4>App Development</h4>
              <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut.</p>
            </div>
          </div>
          <div class="col-lg-4 col-md-6 col-xs-12">
            <div class="item-boxes services-item wow fadeInDown" data-wow-delay="1.2s">
              <div class="icon color-6">
                <i class="lni-briefcase"></i>
              </div>
              <h4>Digital Marketing</h4>
              <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut.</p>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- Services Section End -->

    <!-- Call to Action Start -->
    <section class="call-action section">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-10">
            <div class="cta-trial text-center">
              <h3>Are You Ready To Get Started?</h3>
              <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod<br> Lorem ipsum dolor sit amet, consectetuer</p>
              <a href="#" class="btn btn-common btn-effect">Purchase Now!</a>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- Call to Action End -->

    <!-- Features Section Start -->
    <section id="features" class="section">
      <div class="container">
        <div class="section-header">          
          <h2 class="section-title">Why Choose Us</h2>
          <span>Why</span>
          <p class="section-subtitle">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dignissimos debitis.</p>
        </div>
        <div class="row">
          <!-- Start featured -->
          <div class="col-lg-4 col-md-6 col-xs-12">
            <div class="featured-box">
              <div class="featured-icon">
                <i class="lni-layout"></i>
              </div>
              <div class="featured-content">
                <div class="icon-o"><i class="lni-layout"></i></div>
                <h4>Refreshing Design</h4>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et magna aliqua.</p>
              </div>
            </div>
          </div>
          <!-- End featured -->
          <!-- Start featured -->
          <div class="col-lg-4 col-md-6 col-xs-12">
            <div class="featured-box">
              <div class="featured-icon">
                <i class="lni-tab"></i>
              </div>
              <div class="featured-content">
                <div class="icon-o"><i class="lni-tab"></i></div>
                <h4>Fully Responsive</h4>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et magna aliqua.</p>
              </div>
            </div>
          </div>
          <!-- End featured -->
          <!-- Start featured -->
          <div class="col-lg-4 col-md-6 col-xs-12">
            <div class="featured-box">
              <div class="featured-icon">
                <i class="lni-rocket"></i>
              </div>
              <div class="featured-content">
                <div class="icon-o"><i class="lni-rocket"></i></div>
                <h4>Fast & Smooth</h4>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et magna aliqua.</p>
              </div>
            </div>
          </div>
          <!-- End featured -->
          <!-- Start featured -->
          <div class="col-lg-4 col-md-6 col-xs-12">
            <div class="featured-box">
              <div class="featured-icon">
                <i class="lni-database"></i>
              </div>
              <div class="featured-content">
                <div class="icon-o"><i class="lni-database"></i></div>
                <h4>SEO Optimized</h4>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et magna aliqua.</p>
              </div>
            </div>
          </div>
          <!-- End featured -->
          <!-- Start featured -->
          <div class="col-lg-4 col-md-6 col-xs-12">
            <div class="featured-box">
              <div class="featured-icon">
                <i class="lni-leaf"></i>
              </div>
              <div class="featured-content">
                <div class="icon-o"><i class="lni-leaf"></i></div>
                <h4>Clean Code</h4>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et magna aliqua.</p>
              </div>
            </div>
          </div>
          <!-- End featured -->
          <!-- Start featured -->
          <div class="col-lg-4 col-md-6 col-xs-12">
            <div class="featured-box">
              <div class="featured-icon">
                <i class="lni-pencil"></i>
              </div>
              <div class="featured-content">
                <div class="icon-o"><i class="lni-pencil"></i></div>
                <h4>Free 24/7 Support</h4>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et magna aliqua.</p>
              </div>
            </div>
          </div>
          <!-- End featured -->
        </div>
      </div>
    </section>
    <!-- Features Section End -->    

    <!-- Start Video promo Section -->
    <section class="video-promo section">
      <div class="overlay"></div>
      <div class="container">
        <div class="row">
          <div class="col-md-12 col-sm-12">
              <div class="video-promo-content text-center">
                <a href="https://www.youtube.com/embed/LSgBpbgTlhw" class="video-popup"><i class="lni-film-play"></i></a>
                <h2 class="wow zoomIn" data-wow-duration="1000ms" data-wow-delay="100ms">Our Introductory Video</h2>
                <p class="wow zoomIn" data-wow-duration="1000ms" data-wow-delay="100ms">Learn more about us, its only 30mins</p>
              </div>
          </div>
        </div>
      </div>
    </section>
    <!-- End Video Promo Section -->

    <!-- Portfolio Section -->
    <section id="portfolios" class="section">
      <!-- Container Starts -->
      <div class="container">
        <div class="section-header">          
          <h2 class="section-title">Our Works</h2>
          <span>Works</span>
          <p class="section-subtitle">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dignissimos debitis.</p>
        </div>
        <div class="row">          
          <div class="col-md-12">
            <!-- Portfolio Controller/Buttons -->
            <div class="controls text-center">
              <a class="filter active btn btn-common btn-effect" data-filter="all">
                All 
              </a>
              <a class="filter btn btn-common btn-effect" data-filter=".design">
                Design 
              </a>
              <a class="filter btn btn-common btn-effect" data-filter=".development">
                Development
              </a>
              <a class="filter btn btn-common btn-effect" data-filter=".print">
                Print 
              </a>
            </div>
            <!-- Portfolio Controller/Buttons Ends-->
          </div>
        </div>

        <!-- Portfolio Recent Projects -->
        <div id="portfolio" class="row">
          <div class="col-lg-4 col-md-6 col-xs-12 mix development print">
            <div class="portfolio-item">
              <div class="shot-item">
                <img src="{{ asset('frontend/img/portfolio/img-1.jpg') }}" alt="" />  
                <div class="single-content">
                  <div class="fancy-table">
                    <div class="table-cell">
                      <div class="zoom-icon">
                        <a class="lightbox" href="img/portfolio/img-1.jpg"><i class="lni-zoom-in item-icon"></i></a>
                      </div>
                      <a href="#">View Project</a>
                    </div>
                  </div>
                </div>
              </div>               
            </div>
          </div>
          <div class="col-lg-4 col-md-6 col-xs-12 mix design print">
            <div class="portfolio-item">
              <div class="shot-item">
                <img src="{{ asset('frontend/img/portfolio/img-2.jpg')}}" alt="" /> 
                <div class="single-content">
                  <div class="fancy-table">
                    <div class="table-cell">
                      <div class="zoom-icon">
                        <a class="lightbox" href="img/portfolio/img-2.jpg"><i class="lni-zoom-in item-icon"></i></a>
                      </div>
                      <a href="#">View Project</a>
                    </div>
                  </div>
                </div>
              </div>               
            </div>
          </div>
          <div class="col-lg-4 col-md-6 col-xs-12 mix development">
            <div class="portfolio-item">
              <div class="shot-item">
                <img src="{{ asset('frontend/img/portfolio/img-3.jpg')}}" alt="" />  
                <div class="single-content">
                  <div class="fancy-table">
                    <div class="table-cell">
                      <div class="zoom-icon">
                        <a class="lightbox" href="img/portfolio/img-3.jpg"><i class="lni-zoom-in item-icon"></i></a>
                      </div>
                      <a href="#">View Project</a>
                    </div>
                  </div>
                </div>
              </div>               
            </div>
          </div>
          <div class="col-lg-4 col-md-6 col-xs-12 mix development design">
            <div class="portfolio-item">
              <div class="shot-item">
                <img src="{{ asset('frontend/img/portfolio/img-4.jpg') }}" alt="" /> 
                <div class="single-content">
                  <div class="fancy-table">
                    <div class="table-cell">
                      <div class="zoom-icon">
                        <a class="lightbox" href="img/portfolio/img-4.jpg"><i class="lni-zoom-in item-icon"></i></a>
                      </div>
                      <a href="#">View Project</a>
                    </div>
                  </div>
                </div>
              </div>               
            </div>
          </div>
          <div class="col-lg-4 col-md-6 col-xs-12 mix development">
            <div class="portfolio-item">
              <div class="shot-item">
                <img src="{{ asset('frontend/img/portfolio/img-5.jpg') }}" alt="" />  
                <div class="single-content">
                  <div class="fancy-table">
                    <div class="table-cell">
                      <div class="zoom-icon">
                        <a class="lightbox" href="img/portfolio/img-5.jpg"><i class="lni-zoom-in item-icon"></i></a>
                      </div>
                      <a href="#">View Project</a>
                    </div>
                  </div>
                </div>
              </div>               
            </div>
          </div>
          <div class="col-lg-4 col-md-6 col-xs-12 mix print design">
            <div class="portfolio-item">
              <div class="shot-item">
                <img src="{{ asset('frontend/img/portfolio/img-6.jpg') }}" alt="" />  
                <div class="single-content">
                  <div class="fancy-table">
                    <div class="table-cell">
                      <div class="zoom-icon">
                        <a class="lightbox" href="img/portfolio/img-6.jpg"><i class="lni-zoom-in item-icon"></i></a>
                      </div>
                      <a href="#">View Project</a>
                    </div>
                  </div>
                </div>
              </div>               
            </div>
          </div>
        </div>
      </div>
      <!-- Container Ends -->
    </section>
    <!-- Portfolio Section Ends --> 

    <!-- Start Pricing Table Section -->
    <div id="pricing" class="section pricing-section">
      <div class="container">
        <div class="section-header">          
          <h2 class="section-title">Pricing Plans</h2>
          <span>Pricing</span>
          <p class="section-subtitle">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dignissimos debitis.</p>
        </div>

        <div class="row pricing-tables">
          <div class="col-lg-4 col-md-4 col-xs-12">
            <div class="pricing-table">
              <div class="pricing-details">
                <h2>Starter Plan</h2>
                <div class="price">49$ <span>/mo</span></div>
                <ul>
                  <li>Consectetur adipiscing</li>
                  <li>Nunc luctus nulla et tellus</li>
                  <li>Suspendisse quis metus</li>
                  <li>Vestibul varius fermentum erat</li>
                  <li> - </li>
                </ul>
              </div>
              <div class="plan-button">
                <a href="#" class="btn btn-common btn-effect">Get Plan</a>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-4 col-xs-12">
            <div class="pricing-table pricing-big">
              <div class="pricing-details">
                <h2>Popular Plan</h2>
                <div class="price">99$ <span>/mo</span></div>
                <ul>
                  <li>Consectetur adipiscing</li>
                  <li>Nunc luctus nulla et tellus</li>
                  <li>Suspendisse quis metus</li>
                  <li>Vestibul varius fermentum erat</li>
                  <li> - </li>
                </ul>
              </div>
              <div class="plan-button">
                <a href="#" class="btn btn-common btn-effect">Buy Now</a>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-4 col-xs-12">
            <div class="pricing-table">
              <div class="pricing-details">
                <h2>Premium Plan</h2>
                <div class="price">199$ <span>/mo</span></div>
                <ul>
                  <li>Consectetur adipiscing</li>
                  <li>Nunc luctus nulla et tellus</li>
                  <li>Suspendisse quis metus</li>
                  <li>Vestibul varius fermentum erat</li>
                  <li>Suspendisse quis metus</li>
                </ul>
              </div>
              <div class="plan-button">
                <a href="#" class="btn btn-common btn-effect">Buy Now</a>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
    <!-- End Pricing Table Section -->

    <!-- Counter Section Start -->
    <div class="counters section bg-defult">
      <div class="container">
        <div class="row"> 
          <div class="col-sm-6 col-md-6 col-lg-3">
            <div class="facts-item"> 
              <div class="icon">
                <i class="lni-rocket"></i>
              </div>                
              <div class="fact-count">
                <h3><span class="counter">100</span>%</h3>
                <h4>Faster</h4>
              </div>
            </div>
          </div>
          <div class="col-sm-6 col-md-6 col-lg-3">
            <div class="facts-item">
              <div class="icon">
                <i class="lni-coffee-cup"></i>
              </div>                
              <div class="fact-count">
                <h3><span class="counter">700</span></h3>
                <h4>Cup of Coffee</h4>
              </div>
            </div>
          </div>
          <div class="col-sm-6 col-md-6 col-lg-3">
            <div class="facts-item">
              <div class="icon">
                <i class="lni-user"></i>
              </div>                
              <div class="fact-count">
                <h3><span class="counter">10000</span>+</h3>
                <h4>Active Clients</h4>
              </div>
            </div>
          </div>
          <div class="col-sm-6 col-md-6 col-lg-3">
            <div class="facts-item">
              <div class="icon">
                <i class="lni-heart"></i>
              </div>                
              <div class="fact-count">
                <h3><span class="counter">1689</span></h3>
                <h4>Peoples Love</h4>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Counter Section End -->

    <!-- Testimonial Section Start -->
    <section class="testimonial section">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div id="testimonials" class="touch-slider owl-carousel">
              <div class="item">
                <div class="testimonial-item">
                  <div class="author">
                    <div class="img-thumb">
                    <img src="{{ asset('frontend/img/testimonial/img1.jpg')}}" alt="">
                    </div>
                    <div class="author-info">
                      <h2><a href="#">Johnathan Doe</a></h2>
                      <span>Marketing Head Matrix media</span>
                    </div>
                  </div>
                  <div class="content-inner">
                    <p class="description">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Explicabo quidem, excepturi facere magnam illum, at accusantium doloremque odio.</p>
                    <span><i class="lni-star-filled"></i></span>
                    <span><i class="lni-star-filled"></i></span>
                    <span><i class="lni-star-filled"></i></span>
                    <span><i class="lni-star"></i></span>
                    <span><i class="lni-star"></i></span>
                  </div>
                </div>
              </div>
              <div class="item">
                <div class="testimonial-item">
                  <div class="author">
                    <div class="img-thumb">
                    <img src="{{ asset('frontend/img/testimonial/img2.jpg') }}" alt="">
                    </div>
                    <div class="author-info">
                      <h2><a href="#">Oidila Matik</a></h2>
                      <span>President Lexo Inc</span>
                    </div>
                  </div>
                  <div class="content-inner">
                    <p class="description">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Explicabo quidem, excepturi facere magnam illum, at accusantium doloremque odio.</p>
                    <span><i class="lni-star-filled"></i></span>
                    <span><i class="lni-star-filled"></i></span>
                    <span><i class="lni-star-filled"></i></span>
                    <span><i class="lni-star-filled"></i></span>
                    <span><i class="lni-star-filled"></i></span>
                  </div>
                </div>
              </div>
              <div class="item">
                <div class="testimonial-item">
                  <div class="author">
                    <div class="img-thumb">
                    <img src="{{ asset('frontend/img/testimonial/img3.jpg') }}" alt="">
                    </div>
                    <div class="author-info">
                      <h2><a href="#">- Alex Dattilo</a></h2>
                      <span>CEO Optima Inc</span>
                    </div>
                  </div>
                  <div class="content-inner">
                    <p class="description">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Explicabo quidem, excepturi facere magnam illum, at accusantium doloremque odio.</p>
                    <span><i class="lni-star-filled"></i></span>
                    <span><i class="lni-star-filled"></i></span>
                    <span><i class="lni-star-filled"></i></span>
                    <span><i class="lni-star-filled"></i></span>
                    <span><i class="lni-star"></i></span>
                  </div>
                </div>
              </div>
              <div class="item">
                <div class="testimonial-item">
                  <div class="author">
                    <div class="img-thumb">
                    <img src="{{ asset('frontend/img/testimonial/img2.jpg') }}" alt="">
                    </div>
                    <div class="author-info">
                      <h2><a href="#">Oidila Matik</a></h2>
                      <span>President Lexo Inc</span>
                    </div>
                  </div>
                  <div class="content-inner">
                    <p class="description">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Explicabo quidem, excepturi facere magnam illum, at accusantium doloremque odio.</p>
                    <span><i class="lni-star-filled"></i></span>
                    <span><i class="lni-star-filled"></i></span>
                    <span><i class="lni-star-filled"></i></span>
                    <span><i class="lni-star-filled"></i></span>
                    <span><i class="lni-star-filled"></i></span>
                  </div>
                </div>
              </div>
              <div class="item">
                <div class="testimonial-item">
                  <div class="author">
                    <div class="img-thumb">
                    <img src="{{ asset('frontend/img/testimonial/img1.jpg') }}" alt="">
                    </div>
                    <div class="author-info">
                      <h2><a href="#">- Alex Dattilo</a></h2>
                      <span>CEO Optima Inc</span>
                    </div>
                  </div>
                  <div class="content-inner">
                    <p class="description">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Explicabo quidem, excepturi facere magnam illum, at accusantium doloremque odio.</p>
                    <span><i class="lni-star-filled"></i></span>
                    <span><i class="lni-star-filled"></i></span>
                    <span><i class="lni-star"></i></span>
                    <span><i class="lni-star"></i></span>
                    <span><i class="lni-star"></i></span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    

    

    <!-- Clients Section -->
    <div id="clients" class="section">
      <!-- Container Ends -->
      <div class="container">
        <!-- Row and Scroller Wrapper Starts -->
        <div class="row" id="clients-scroller">
          <div class="client-item-wrapper">
            <img src="{{ asset('frontend/img/clients/img1.png')}}" alt="">
          </div>
          <div class="client-item-wrapper">
            <img src="{{ asset('frontend/img/clients/img2.png') }}" alt="">
          </div>
          <div class="client-item-wrapper">
            <img src="{{ asset('frontend/img/clients/img3.png') }}" alt="">
          </div>
          <div class="client-item-wrapper">
            <img src="{{ asset('frontend/img/clients/img4.png') }}" alt="">
          </div>
          <div class="client-item-wrapper">
            <img src="{{ asset('frontend/img/clients/img5.png')}}" alt="">
          </div>
          <div class="client-item-wrapper">
            <img src="{{ asset('frontend/img/clients/img6.png')}}" alt="">
          </div>
        </div>
      </div>
    </div>
    <!-- Client Section End --> 

    <!-- Contact Section Start -->
    <section id="contact" class="section">      
      <div class="contact-form">
        <div class="container">
          <div class="section-header">          
            <h2 class="section-title">Get In Touch</h2>
            <span>Contact</span>
            <p class="section-subtitle">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dignissimos debitis.</p>
          </div>
          <div class="row">          
            <div class="col-lg-9 col-md-9 col-xs-12">
              <div class="contact-block">
<div class="text-center">
                  <h2>You are using Free Version</h2>
                  <h4>Please, purchase full version to get all features and pages</h4><br>
                  <b>Including:</b>
                  <p>- 4 Homepage Variations</p>
                  <p>- All Elements and Features</p>
                  <p>- Amazing Slider</p>
                  <p>- Documentation File</p>
                  <p>- Quick Support</p>
                  <p>- Permission to Use in Commercial Projects</p>
                  <p>- Footer Credit Removal</p>
                  <p>- SASS Files</p>
                  <br>
                  <a href="https://rebrand.ly/essence-purchase-ud" target="_blank" class="btn btn-common btn-lg">Purchase Now</a>
</div>
              </div>
            </div>



            <div class="col-lg-3 col-md-3 col-xs-12">
              <div class="contact-deatils">
                <!-- Content Info -->
                <div class="contact-info_area">
                  <div class="contact-info">
                    <i class="lni-map"></i>
                    <h5>Location</h5>
                    <p>1900 Pico Blvd, New York br Centernial, colorado</p>
                  </div>
                  <!-- Content Info -->
                  <div class="contact-info">
                    <i class="lni-star"></i>
                    <h5>E-mail</h5>
                    <p>info@example.com</p>
                  </div>
                  <!-- Content Info -->
                  <div class="contact-info">
                    <i class="lni-phone"></i>
                    <h5>Phone</h5>
                    <p>+48 123 456 789</p>
                  </div>
                  <!-- Icon -->
                  <ul class="footer-social">
                    <li><a class="facebook" href="#"><i class="lni-facebook-filled"></i></a></li>
                    <li><a class="twitter" href="#"><i class="lni-twitter-filled"></i></a></li>
                    <li><a class="linkedin" href="#"><i class="lni-linkedin-fill"></i></a></li>
                    <li><a class="google-plus" href="#"><i class="lni-google-plus"></i></a></li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>            
    </section>
    <!-- Contact Section End -->
    
    <!-- Map Section Start -->
    
    <!-- Map Section End -->

    <!-- Footer Section Start -->
    <footer>
      <!-- Footer Area Start -->
      <section class="footer-Content">
        <div class="container">
          <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6 col-mb-12">
              <h3>Essence</h3>
              <div class="textwidget">
                <p>If you think you have the passion, 
                attitude and capability to join us 
                the next big software company
                s so that we can get the convers.</p>
              </div>
              <ul class="footer-social">
                <li><a class="facebook" href="#"><i class="lni-facebook-filled"></i></a></li>
                <li><a class="twitter" href="#"><i class="lni-twitter-filled"></i></a></li>
                <li><a class="linkedin" href="#"><i class="lni-linkedin-fill"></i></a></li>
                <li><a class="google-plus" href="#"><i class="lni-google-plus"></i></a></li>
              </ul> 
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6 col-mb-12">
              <div class="widget">
                <h3 class="block-title">Short Link</h3>
                <ul class="menu">
                  <li><a href="#">Service</a></li>
                  <li><a href="#">Wishlist</a></li>
                  <li><a href="#">FAQ</a></li>
                  <li><a href="#">Advance Sarch</a></li>
                  <li><a href="#">Site Map</a></li>
                </ul>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6 col-mb-12">
              <div class="widget">
                <h3 class="block-title">Contact Us</h3>
                <ul class="contact-footer">
                  <li>
                    <strong>Address :</strong> <span>1900 Pico Blvd, New York br Centernial, colorado</span>
                  </li>
                  <li>
                    <strong>Phone :</strong> <span>+48 123 456 789</span>
                  </li>
                  <li>
                    <strong>E-mail :</strong> <span><a href="#">info@example.com</a></span>
                  </li>
                </ul> 
              </div>
            </div>
            
          </div>
        </div>
      </section>
      <!-- Footer area End -->
      
      <!-- Copyright Start  -->
      <div id="copyright">
        <div class="container">
          <div class="row">
            <div class="col-md-12">
              <div class="site-info float-left">
                <p>Crafted by <a href="http://uideck.com" rel="nofollow">UIdeck</a></p>
              </div>              
              <div class="float-right">  
                <ul class="nav nav-inline">
                  <li class="nav-item">
                    <a class="nav-link active" href="#">About Prime</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#">TOS</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#">Return Policy</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#">FAQ</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#">Contact</a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Copyright End -->

    </footer>
    <!-- Footer Section End --> 

    <!-- Go To Top Link -->
    <a href="#" class="back-to-top">
      <i class="lni-arrow-up"></i>
    </a>

    <div id="loader">
      <div class="spinner">
        <div class="double-bounce1"></div>
        <div class="double-bounce2"></div>
      </div>
    </div> 
@endsection
