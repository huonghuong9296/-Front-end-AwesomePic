<?php 
  ob_start();
  session_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="css/style.min.css" />
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <script
      src="https://kit.fontawesome.com/ae09c0f9d5.js"
      crossorigin="anonymous"
    ></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <title>Welcome to AwesomePic</title>
  </head>

  <body>
    <div class="wrapper" id="wrapper">
      <div class="overlay hidden"></div>
      <!-- sidebar -->
      <?php 
        include "_navbar.php"
      ?>
      <!-- page content -->
      <div id="content">
        <!-- header -->
       
        <section class="landing">
          <div class="dark-overlay lighten"></div>
          <div class="landing-inner">
            <div class="title-page pricing-title">
              <div class="main-title-page dark-blue">
                Pricing & Subscriptions
              </div>

              <div class="typewriter">
                <h4>Choose a plan that is right for you.</h4>
              </div>
            </div>
            <!-- tab-mobile -->
            <div class="container tab-mobile mt-3">
              <ul class="nav nav-tabs">
                <li class="nav-item">
                  <a class="nav-link" data-toggle="tab" href="#FREE">FREE</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" data-toggle="tab" href="#PRO">PRO</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link active" data-toggle="tab" href="#TEAM"
                    >TEAM</a
                  >
                </li>
                <li class="nav-item">
                  <a class="nav-link" data-toggle="tab" href="#LARGE">LARGE</a>
                </li>
              </ul>

              <!-- Tab panes -->
              <div class="tab-content">
                <div id="FREE" class="container-thao tab-pane fade">
                  <div class="pricing-column pricing-column-1">
                    <div class="subheader">FOR EVERYBODY</div>
                    <ul class="feature-list">
                      <li class="infinity">
                        <i class="m1 fas fa-infinity icon-feature"></i>Unlimited
                        public pic
                      </li>
                      <li class="checkmark">
                        <i class="fas m1 fa-check icon-feature"></i>1 team and 3
                        team members
                      </li>
                      <li class="checkmark">
                        <i class="fas m1 fa-check icon-feature"></i>20 download
                        per day
                      </li>
                      <li class="checkmark">
                        <i class="fas m1 fa-check icon-feature"></i>Two-factor
                        authentication
                      </li>
                    </ul>
                    <div class="price">$0 /month</div>
                    <a
                      href="signUp.php"
                      class="btn-thao btn-primary buy-now-button right free-button"
                    >
                      Sign Up</a
                    >
                  </div>
                </div>

                <div id="PRO" class="container-thao tab-pane fade">
                  <div class="pricing-column pricing-column-2">
                    <div class="subheader">FOR INDIVIDUALS</div>
                    <ul class="feature-list">
                      <li class="infinity">
                        <i class="m2 fas fa-infinity icon-feature"></i>Unlimited
                        public pic
                      </li>
                      <li class="checkmark">
                        <i class="m2 fas fa-check icon-feature"></i>3 team and
                        50 team members
                      </li>
                      <li class="checkmark">
                        <i class="m2 fas fa-check icon-feature"></i>1000
                        download per day
                      </li>
                      <li class="checkmark">
                        <i class="m2 fas fa-check icon-feature"></i>Unused
                        downloads to next month
                      </li>
                    </ul>
                    <div class="price">$25 /month</div>
                    <a
                      href="home.php"
                      class="btn-thao btn-primary buy-now-button right pro-button"
                    >
                      Buy Now</a
                    >
                  </div>
                </div>

                <div id="TEAM" class="container-thao tab-pane active">
                  <div class="pricing-column pricing-column-1">
                    <div class="subheader">FOR TEAM</div>
                    <ul class="feature-list">
                      <li class="infinity">
                        <i class="fas fa-infinity icon-feature"></i>Unlimited
                        public pictures
                      </li>
                      <li class="checkmark">
                        <i class="fas fa-check icon-feature"></i>Print or
                        digital use
                      </li>
                      <li class="checkmark">
                        <i class="fas fa-check icon-feature"></i>200 download
                        per day
                      </li>
                      <li class="checkmark">
                        <i class="fas fa-check icon-feature"></i>Two-factor
                        authentication
                      </li>
                    </ul>
                    <div class="price">$50 /month</div>
                    <a
                      href="home.php"
                      class="btn-thao btn-primary buy-now-button right gradient"
                    >
                      Buy Now</a
                    >
                  </div>
                </div>

                <div id="LARGE" class="container-thao tab-pane fade">
                  <div class="pricing-column pricing-column-1">
                    <div class="subheader">FOR COMPANY</div>
                    <ul class="feature-list">
                      <li class="infinity">
                        <i class="m1 fas fa-infinity icon-feature"></i>Unlimited
                        downloads
                      </li>
                      <li class="checkmark">
                        <i class="fas m1 fa-check icon-feature"></i>Life-long
                        rights images
                      </li>
                      <li class="checkmark">
                        <i class="fas m1 fa-check icon-feature"></i>Use for
                        advertising
                      </li>
                      <li class="checkmark">
                        <i class="fas m1 fa-check icon-feature"></i>Two-factor
                        authentication
                      </li>
                    </ul>
                    <div class="price">$100 /month</div>
                    <a
                      href="contact.php"
                      class="btn-thao btn-primary buy-now-button right free-button"
                    >
                      Contact Sales</a
                    >
                  </div>
                </div>
              </div>
            </div>

            <!-- tab desktop -->
            <div class="container-thao tab-desktop">
              <div class="pricing-column pricing-column-1">
                <h4 class="main-title">Free</h4>
                <div class="subheader">FOR EVERYBODY</div>
                <ul class="feature-list">
                  <li class="infinity">
                    <i class="m1 fas fa-infinity icon-feature"></i>Unlimited
                    public pic
                  </li>
                  <li class="checkmark">
                    <i class="fas m1 fa-check icon-feature"></i>1 team and 3
                    team members
                  </li>
                  <li class="checkmark">
                    <i class="fas m1 fa-check icon-feature"></i>20 download per
                    day
                  </li>
                  <li class="checkmark">
                    <i class="fas m1 fa-check icon-feature"></i>Two-factor
                    authentication
                  </li>
                </ul>
                <div class="price">$0 /month</div>
                <a
                  href="signUp.php"
                  class="btn-thao btn-primary buy-now-button right free-button"
                >
                  Sign Up</a
                >
              </div>
              <div class="pricing-column pricing-column-2">
                <h4 class="main-title">Pro</h4>
                <div class="subheader">FOR INDIVIDUALS</div>
                <ul class="feature-list">
                  <li class="infinity">
                    <i class="m2 fas fa-infinity icon-feature"></i>Unlimited
                    public pic
                  </li>
                  <li class="checkmark">
                    <i class="m2 fas fa-check icon-feature"></i>Additional
                    images $1 each
                  </li>
                  <li class="checkmark">
                    <i class="m2 fas fa-check icon-feature"></i>100 download per
                    day
                  </li>
                  <li class="checkmark">
                    <i class="m2 fas fa-check icon-feature"></i>Transfer unused
                    downloads
                  </li>
                </ul>
                <div class="price">$25 /month</div>
                <a
                  href="home.php"
                  class="btn-thao btn-primary buy-now-button right pro-button"
                >
                  Buy Now</a
                >
              </div>
              <div class="pricing-column pricing-column-3">
                <div class="top-banner-bar-pricing gradient">
                  <i class="far fa-thumbs-up"></i> DESIGNER FAVORITE
                </div>
                <h4 class="main-title">Team</h4>
                <div class="subheader">FOR TEAM</div>
                <ul class="feature-list">
                  <li class="infinity">
                    <i class="fas fa-infinity icon-feature"></i>Unlimited public
                    pictures
                  </li>
                  <li class="checkmark">
                    <i class="fas fa-check icon-feature"></i>Print or digital
                    use
                  </li>
                  <li class="checkmark">
                    <i class="fas fa-check icon-feature"></i>200 download per
                    day
                  </li>
                  <li class="checkmark">
                    <i class="fas fa-check icon-feature"></i>Two-factor
                    authentication
                  </li>
                </ul>
                <div class="price">$50 /month</div>
                <a
                  href="signUp.php"
                  class="btn-thao btn-primary buy-now-button right gradient"
                >
                  Buy Now</a
                >
              </div>

              <div class="pricing-column pricing-column-4">
                <h4 class="main-title">Large</h4>
                <div class="subheader">FOR COMPANY</div>
                <ul class="feature-list">
                  <li class="infinity">
                    <i class="m1 fas fa-infinity icon-feature"></i>Unlimited
                    downloads
                  </li>
                  <li class="checkmark">
                    <i class="fas m1 fa-check icon-feature"></i>Life-long rights
                    images
                  </li>
                  <li class="checkmark">
                    <i class="fas m1 fa-check icon-feature"></i>Use for
                    advertising
                  </li>
                  <li class="checkmark">
                    <i class="fas m1 fa-check icon-feature"></i>Two-factor
                    authentication
                  </li>
                </ul>
                <div class="price">$100 /month</div>
                <a
                  href="contact.php"
                  class="btn-thao btn-primary buy-now-button right free-button"
                >
                  Contact Sales</a
                >
              </div>
            </div>
          </div>
          <div class="container-thao">
            <div class="pricing-column-big">
              <h2 class="content-title head-text center">
                Stock Photo Subscription
              </h2>
              <div class="sub-text center">
                The access to all the photos you will need, as well as the
                lowest price. Annual plans give you the best deal in pricing.
                With images at only a few cents each.
              </div>

              <a href="#signup" class="scale-hover nav-page">
                <i class="fas scale-hover fa-arrow-right"></i>Signup now</a
              >
            </div>

            <div class="pricing-column-big">
              <p class="content-title head-text center">
                Single Image Purchasing
              </p>
              <div class="sub-text center">
                8,698,937 Single stock photos, vectors, and illustrations. Good
                enough if you're only looking for a handful of photos every now
                and then.
              </div>

              <a href="products.php" class="scale-hover nav-page">
                <i class="fas scale-hover fa-arrow-right"></i>Shop now</a
              >
            </div>
          </div>
          <div class="container-thao direction-column">
            <div class="color-bold dark-blue">Image Packs</div>

            <div class="sub-text">
              Download images anytime as you need them, with no expiry date
            </div>
            <div
              class="container-thao-image-package align-space-between bg-light box-shadow"
            >
              <div class="align-left direction-row">
                <div class="option-square" id="option-1">5</div>
                <div class="option-square option-choose" id="option-2">15</div>
                <div class="option-square" id="option-3">30</div>
              </div>

              <div class="image-package" id="pricing-package">$30</div>
              <a
                href="products.php"
                class="btn-thao btn-primary right get-image-package bg-light dark-blue scale-hover"
                >Get Image Package</a
              >
            </div>
          </div>
          <div
            class="container-thao pricing-column direction-column center fit-content"
          >
            <ul class="sub-end-section">
              <li>
                <h4 class="main-title dark-blue">Included In All Plans</h4>
              </li>
              <li>
                <label>
                  <input type="radio" class="option-input radio" checked />
                  Total access to our collection of 6,905,756 curated photos,
                  vectors and fonts.
                </label>
              </li>

              <li>
                <label>
                  <input type="radio" class="option-input radio" checked />
                  100,000 new files added monthly.
                </label>
              </li>
              <li>
                <label>
                  <input type="radio" class="option-input radio" checked />
                  Download at any size.
                </label>
              </li>
              <li>
                <label>
                  <input type="radio" class="option-input radio" checked />
                  No hidden extra fee to obtain the highest resolution files.
                </label>
              </li>
              <li>
                <label>
                  <input type="radio" class="option-input radio" checked />
                  Commercial royalty free license for print, web & social media.
                </label>
              </li>
            </ul>
          </div>
          <!-- main content
          </div> -->
        </section>
      </div>
    </div>
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
            <div class="footer-head-list">Get in Touch</div>
          </li>
          <li>
            <a href="aboutUs.php" class="policy">About Us</a>
          </li>
          <li>
            <a href="contact.php" class="policy">Contact Us</a>
          </li>
        </ul>
        <ul class="footer-list">
          <li>
            <div class="footer-head-list">Policy</div>
          </li>
          <li>
            <a href="#" class="policy">Term of Services</a>
          </li>
          <li>
            <a href="#" class="policy">Private Policy</a>
          </li>
        </ul>
      </div>
    </div>
    <button onclick="topFunction()" id="myBtn" class="hidden" title="Go to top">
      <i class="fas fa-arrow-up"></i>
    </button>
    <script>
      document.getElementById("pricing").classList.add('active'); 
    </script>
    <script src="JS/ddProfile.js"></script>
    <script src="JS/typingText.js"></script>
    <script src="JS/sidebar.js"></script>
    <script src="JS/optiion.js"></script>
    <script src="JS/scrollToTop.js"></script>
  </body>
</html>
