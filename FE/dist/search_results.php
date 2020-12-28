<?php 
  ob_start();
  session_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Search Results</title>
    <link rel="stylesheet" type="text/css" href="css/products/products.css" />
    <link
      rel="stylesheet"
      type="text/css"
      href="css/products/search_results-style.css"
    />
    <link rel="stylesheet" type="text/css" href="css/style.min.css" />
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />
  </head>
  <body>
    <!-- menu -->
    <div class="overlay hidden"></div>
    <?php 
        include "_navbar.php"
      ?>
    <!-- end menu -->
    <!-- Search form -->
    <div>
      <div class="title-page pricing-title">
        <div class="main-title-page dark-blue">Search AwesomePic</div>
        <div class="typewriter">
          <h4>Find your inspiration.</h4>
        </div>
      </div>
      <form
        class="form-inline d-flex justify-content-center md-form form-sm active-cyan active-cyan-2 mt-2 search-form"
      >
        <i class="fas fa-search" aria-hidden="true"></i>
        <input
          class="form-control form-control-sm ml-3 w-75"
          type="text"
          placeholder="Search"
          aria-label="Search"
        />
      </form>
    </div>
    <!-- end search form -->
    <!-- container -->
    <div class="container">
      <!-- list search results -->
      <div id="search-results">
        <h1 class="aboutus-title pricing-title">Search Results</h1>
        <div class="grid-portfolio" id="portfolio">
          <div class="container">
            <div class="row">
              <div class="col-md-4 col-sm-6">
                <div class="portfolio-item">
                  <div class="thumb">
                    <a
                      href="img/products/search_results/big_portfolio_item_4.png"
                      data-lightbox="image-1"
                      ><div class="hover-effect">
                        <div class="hover-content">
                          <h1>Biodiesel <em>squid</em></h1>
                          <p>Awesome Subtittle Goes Here</p>
                        </div>
                      </div></a
                    >
                    <div class="image">
                      <a href="detail.php"
                        ><img
                          src="img/products/search_results/portfolio_item_4.png"
                          alt="image"
                      /></a>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-4 col-sm-6">
                <div class="portfolio-item">
                  <div class="thumb">
                    <a
                      href="img/products/search_results/big_portfolio_item_2.png"
                      data-lightbox="image-1"
                      ><div class="hover-effect">
                        <div class="hover-content">
                          <h1>raclette <em>taxidermy</em></h1>
                          <p>Awesome Subtittle Goes Here</p>
                        </div>
                      </div></a
                    >
                    <div class="image">
                      <a href="detail.php"
                        ><img
                          src="img/products/search_results/portfolio_item_2.png"
                          alt="image"
                      /></a>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-4 col-sm-6">
                <div class="portfolio-item">
                  <div class="thumb">
                    <a
                      href="img/products/search_results/big_portfolio_item_3.png"
                      data-lightbox="image-1"
                      ><div class="hover-effect">
                        <div class="hover-content">
                          <h1>humblebrag <em>brunch</em></h1>
                          <p>Awesome Subtittle Goes Here</p>
                        </div>
                      </div></a
                    >
                    <div class="image">
                      <a href="detail.php"
                        ><img
                          src="img/products/search_results/portfolio_item_3.png"
                          alt="image"
                      /></a>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-4 col-sm-6">
                <div class="portfolio-item">
                  <div class="thumb">
                    <a
                      href="img/products/search_results/big_portfolio_item_1.png"
                      data-lightbox="image-1"
                      ><div class="hover-effect">
                        <div class="hover-content">
                          <h1>Succulents <em>chambray</em></h1>
                          <p>Awesome Subtittle Goes Here</p>
                        </div>
                      </div></a
                    >
                    <div class="image">
                      <a href="detail.php"
                        ><img
                          src="img/products/search_results/portfolio_item_1.png"
                          alt="image"
                      /></a>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-4 col-sm-6">
                <div class="portfolio-item">
                  <div class="thumb">
                    <a
                      href="img/products/search_results/big_portfolio_item_5.png"
                      data-lightbox="image-1"
                      ><div class="hover-effect">
                        <div class="hover-content">
                          <h1>freegan <em>aesthetic</em></h1>
                          <p>Awesome Subtittle Goes Here</p>
                        </div>
                      </div></a
                    >
                    <div class="image">
                      <a href="detail.php"
                        ><img
                          src="img/products/search_results/portfolio_item_5.png"
                          alt="image"
                      /></a>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-4 col-sm-6">
                <div class="portfolio-item">
                  <div class="thumb">
                    <a
                      href="img/products/search_results/big_portfolio_item_6.png"
                      data-lightbox="image-1"
                      ><div class="hover-effect">
                        <div class="hover-content">
                          <h1>taiyaki <em>vegan</em></h1>
                          <p>Awesome Subtittle Goes Here</p>
                        </div>
                      </div></a
                    >
                    <div class="image">
                      <a href="detail.php"
                        ><img
                          src="img/products/search_results/portfolio_item_6.png"
                          alt="image"
                      /></a>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-4 col-sm-6">
                <div class="portfolio-item">
                  <div class="thumb">
                    <a
                      href="img/products/search_results/big_portfolio_item_7.png"
                      data-lightbox="image-1"
                      ><div class="hover-effect">
                        <div class="hover-content">
                          <h1>Thundercats <em>santo</em></h1>
                          <p>Awesome Subtittle Goes Here</p>
                        </div>
                      </div></a
                    >
                    <div class="image">
                      <a href="detail.php"
                        ><img
                          src="img/products/search_results/portfolio_item_7.png"
                          alt="image"
                      /></a>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-4 col-sm-6">
                <div class="portfolio-item">
                  <div class="thumb">
                    <a
                      href="img/products/search_results/big_portfolio_item_8.png"
                      data-lightbox="image-1"
                      ><div class="hover-effect">
                        <div class="hover-content">
                          <h1>wayfarers <em>yuccie</em></h1>
                          <p>Awesome Subtittle Goes Here</p>
                        </div>
                      </div></a
                    >
                    <div class="image">
                      <a href="detail.php"
                        ><img
                          src="img/products/search_results/portfolio_item_8.png"
                          alt="image"
                      /></a>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-4 col-sm-6">
                <div class="portfolio-item">
                  <div class="thumb">
                    <a
                      href="img/products/search_results/big_portfolio_item_9.png"
                      data-lightbox="image-1"
                      ><div class="hover-effect">
                        <div class="hover-content">
                          <h1>disrupt <em>street</em></h1>
                          <p>Awesome Subtittle Goes Here</p>
                        </div>
                      </div></a
                    >
                    <div class="image">
                      <a href="detail.php"
                        ><img
                          src="img/products/search_results/portfolio_item_9.png"
                          alt="image"
                      /></a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="load-more-button">
                  <a href="#">Load More</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!--end list search results -->
      <!-- list trending search -->
      <div class="row mt-5" id="trending-search">
        <h1 class="aboutus-title pricing-title">Trending Search</h1>
        <hr class="border-title" />
        <div class="trending-search-content">
          <div class="trending-search-list">
            <p><a href="search_results.php">Thanksgiving1</a></p>
            <p><a href="search_results.php">Motivational Quotes</a></p>
            <p><a href="search_results.php">Colorful Background</a></p>
            <p><a href="search_results.php">Baby Photos</a></p>
            <p><a href="search_results.php">Teleworking</a></p>
            <p><a href="search_results.php">White American Family</a></p>
          </div>
          <div class="trending-search-list">
            <p><a href="search_results.php">Thanksgiving</a></p>
            <p><a href="search_results.php">Motivational Quotes</a></p>
            <p><a href="search_results.php">Colorful Background</a></p>
            <p><a href="search_results.php">Baby Photos</a></p>
            <p><a href="search_results.php">Teleworking</a></p>
            <p><a href="search_results.php">White American Family</a></p>
          </div>
          <div class="trending-search-list">
            <p><a href="search_results.php">Thanksgiving</a></p>
            <p><a href="search_results.php">Motivational Quotes</a></p>
            <p><a href="search_results.php">Colorful Background</a></p>
            <p><a href="search_results.php">Baby Photos</a></p>
            <p><a href="search_results.php">Teleworking</a></p>
            <p><a href="search_results.php">White American Family</a></p>
          </div>
          <div class="trending-search-list">
            <p><a href="search_results.php">Thanksgiving</a></p>
            <p><a href="search_results.php">Motivational Quotes</a></p>
            <p><a href="search_results.php">Colorful Background</a></p>
            <p><a href="search_results.php">Baby Photos</a></p>
            <p><a href="search_results.php">Teleworking</a></p>
            <p><a href="search_results.php">White American Family</a></p>
          </div>
          <div class="trending-search-list">
            <p><a href="search_results.php">Thanksgiving</a></p>
            <p><a href="search_results.php">Motivational Quotes</a></p>
            <p><a href="search_results.php">Colorful Background</a></p>
            <p><a href="search_results.php">Baby Photos</a></p>
            <p><a href="search_results.php">Teleworking</a></p>
            <p><a href="search_results.php">White American Family</a></p>
          </div>
          <div class="trending-search-list">
            <p><a href="search_results.php">Thanksgiving</a></p>
            <p><a href="search_results.php">Motivational Quotes</a></p>
            <p><a href="search_results.php">Colorful Background</a></p>
            <p><a href="search_results.php">Baby Photos</a></p>
            <p><a href="search_results.php">Teleworking</a></p>
            <p><a href="search_results.php">White American Family</a></p>
          </div>
        </div>
      </div>
      <!--end trending search -->
    </div>
    <!-- end container -->
    <!-- footer -->
    <div class="powered">
      <h6>
        <a href="#" class="fa fa-facebook"></a>
        <a href="#" class="fa fa-twitter"></a>
        <a href="#" class="fa fa-instagram"></a>
        <a href="#" class="fa fa-snapchat-ghost"></a>
        Powered by
        <i class="awe">AwesomePic</i>
      </h6>
    </div>
    <div class="footer">
      <div class="private">
        <ul class="footer-list">
          <li>
            <a href="#"><div class="footer-head-list">Get in Touch</div></a>
          </li>
          <li><a href="aboutUs.php" class="policy">About Us</a></li>
          <li><a href="contact.php" class="policy">Contact Us</a></li>
        </ul>
        <ul class="footer-list">
          <li>
            <a href="#"><div class="footer-head-list">Policy</div></a>
          </li>
          <li><a href="#" class="policy">Term of Services</a></li>
          <li><a href="#" class="policy">Private Policy</a></li>
        </ul>
      </div>
    </div>
    <button onclick="topFunction()" id="myBtn" class="hidden" title="Go to top">
      <i class="fas fa-arrow-up"></i>
    </button>
    <script src="JS/scrollToTop.js"></script>
    <!-- end footer -->
    <script src="JS/products/search_results/modernizr-2.8.3-respond-1.4.2.min.js"></script>
    <script
      src="https://kit.fontawesome.com/ae09c0f9d5.js"
      crossorigin="anonymous"
    ></script>
    <script src="JS/ddProfile.js"></script>
    <script src="JS/sidebar.js"></script>
  </body>
</html>
