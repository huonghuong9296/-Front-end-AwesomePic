<?php 
  ob_start();
  session_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
    />
    <link rel="stylesheet" href="css/style.min.css" />
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script
      src="https://kit.fontawesome.com/ae09c0f9d5.js"
      crossorigin="anonymous"
    ></script>
    <title>About Us</title>
  </head>

  <body>
    <div class="overlay hidden"></div>
    <!-- sidebar -->
    <?php 
        include "_navbar.php"
      ?>
        <div class="main-canvas">
          <div class="container margin-top-bot-0">
            <div class="title-page pricing-title">
              <div class="main-title-page dark-blue">Our Company</div>
              <!-- <div class="sub-title-page">
                Beautiful gallery products for modern life.
              </div> -->
              <div class="typewriter">
                <h4>Beautiful gallery products for modern life.</h4>
              </div>
            </div>
            <div style="display: flex">
              <a
                style="margin: 10px auto"
                class="btn-thao btn-primary right free-button buy-now-button"
                href="signUp.php"
                >Join Us</a
              >
            </div>

            <div class="contentContact">
              <div class="col-sm-12">
                <div class="section-2-wrap">
                  <h1 class="aboutus-title pricing-title center">
                    About AwesomePic
                  </h1>
                  <p class="sub-content sub-text-aboutus">
                    We're a hardworking, passionate group of people working on
                    making the lives of photographers easier. Our mission is to
                    equip and inspire everyone on the journey towards running
                    their own photography business. Launched in 2013, AwesomPic
                    is one of the fastest growing companies in the photography
                    industry. Today, hundreds of thousands of photographers
                    around the world use AwesomePic to make their business
                    simpler, more professional, and more streamlined.
                  </p>
                </div>
              </div>
            </div>
          </div>
          <div class="main-canvas contentContact">
            <div class="container margin-top-bot-0">
              <div class="section-img"></div>
            </div>
          </div>

          <div class="container contentContact margin-top-bot-0">
            <div class="side-icon-outer">
              <div class="columns-4">
                <div class="icon-wrap text-transform">
                  <i class="fas fa-handshake font-fas-aboutUs"></i>
                </div>
                <div class="inner-text">
                  <h4>Why Images?</h4>
                  <p class="sub-text">
                    Whether you’re a blogger or write articles for an online
                    magazine or newspaper, chances are you’ll find yourself
                    asking whether your article needs an image or not. The
                    answer is always “Yes”. Images bring an article to life and
                    also contribute to your website’s SEO. Because informative
                    images convey a concept or information that can't be
                    expressed in a short phrase or sentence.
                  </p>
                </div>
              </div>

              <div class="columns-4">
                <div class="icon-wrap text-transform">
                  <i class="fas fa-praying-hands font-fas-aboutUs"></i>
                </div>
                <div class="inner-text">
                  <h4>Who We Support?</h4>
                  <p class="sub-text">
                    People trust AwesomePic as a source of quality visual
                    content they can use with confidence. We take pride in
                    providing resources and information to build knowledge on
                    issues which not only drive our business, but which impact
                    everyone. This is who we support.
                  </p>
                </div>
              </div>

              <div class="columns-4">
                <div class="icon-wrap text-transform">
                  <i class="fas fa-fist-raised font-fas-aboutUs"></i>
                </div>
                <div class="inner-text">
                  <h4>Where We Stand?</h4>
                  <p class="sub-text">
                    Our images move hearts, minds and opinions; they power
                    commerce, ideas and perceptions. We are keenly aware that
                    every day, our business affects individuals and society on
                    many levels. That’s why we stand for creative rights that
                    help power creative careers, for freedom of the press and
                    the protection of journalists—both essential to a free
                    society—and for generosity that helps communities flourish.
                    Creativity. Freedom. Community. This is what we believe in.
                  </p>
                </div>
              </div>

              <div class="columns-4">
                <div class="icon-wrap text-transform">
                  <i class="fas fa-hands font-fas-aboutUs"></i>
                </div>
                <div class="inner-text">
                  <h4>How We Work?</h4>
                  <p class="sub-text">
                    From being environmentally aware to upholding strong ethical
                    standards and nurturing a diverse, positive workplace, we
                    work to embody values that are fundamental for doing well by
                    doing good.
                  </p>
                </div>
              </div>
            </div>
          </div>
          <div class="container contentContact margin-top-bot-0">
            <div class="number-section">
              <h1 class="aboutus-title pricing-title center">
                AwesomePic by the numbers
              </h1>
              <div class="number-row">
                <div class="number-item">
                  <div class="text-wrap text-transform">
                    <i class="fas fa-image font-fas-aboutUs fas-color"></i>
                    <p>
                      <span>500M</span>
                      <br />
                    </p>
                    <h2>Gallery</h2>
                  </div>
                </div>

                <div class="number-item">
                  <div class="text-wrap text-transform">
                    <i class="fas fa-camera font-fas-aboutUs fas-color"></i>
                    <p>
                      <span>5M</span>
                      <br />
                    </p>
                    <h2>Photographers</h2>
                  </div>
                </div>

                <div class="number-item">
                  <div class="text-wrap text-transform">
                    <i
                      class="fas fa-address-card font-fas-aboutUs fas-color"
                    ></i>
                    <p>
                      <span>20M</span>
                      <br />
                    </p>
                    <h2>User</h2>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="container contentContact margin-top-bot-0">
            <div class="row row-wrap">
              <div class="aboutus-img col-md-6">
                <img
                  src="./img/ximg_2.jpg.pagespeed.ic.PM5e-rTip9.webp"
                  alt=""
                />
              </div>
              <div class="aboutus-img col-md-5">
                <h2>Our Mission</h2>
                <p>
                  At AwesomePic, we take thousands of editorial photos a year to
                  cover the daily news. Our team aspires to make these photos
                  discoverable and available to the public for purchase. So we
                  built a platform to showcase them.
                  <br /><br />
                  Together with a growing community of contributors, we have
                  built up a small pool of carefully curated photos for all your
                  creative and editorial needs.
                </p>
              </div>
            </div>
          </div>
          <div class="container contentContact fit-content margin-top-bot-0">
            <h1 class="aboutus-title pricing-title center">Management</h1>
            <div class="row-wrap row-margin maxwidth960">
              <div class="col-md-3-aboutus">
                <div>
                  <img class="aboutus-img" src="./img/person_1.jpg" alt="" />
                </div>
                <div class="text-wrap">
                  <h2>Jean Smith</h2>
                  <p>VP of Engineering</p>
                </div>
                <p class="text-wrap">
                  <a class="text-transform2" href="#">
                    <i class="fab fa-facebook-square fab-color"></i>
                  </a>
                  <a class="text-transform2" href="#">
                    <i class="fab fa-instagram fab-color"></i>
                  </a>
                  <a class="text-transform2" href="#">
                    <i class="fab fa-twitter fab-color"></i>
                  </a>
                </p>
              </div>

              <div class="col-md-3-aboutus">
                <div>
                  <img class="aboutus-img" src="./img/person_2.jpg" alt="" />
                </div>
                <div class="text-wrap">
                  <h2>Claire Smith</h2>
                  <p>Chief Marketing Officer</p>
                </div>
                <p>
                  <a class="text-transform2" href="#">
                    <i class="fab fa-facebook-square fab-color"></i>
                  </a>
                  <a class="text-transform2" href="#">
                    <i class="fab fa-instagram fab-color"></i>
                  </a>
                  <a class="text-transform2" href="#">
                    <i class="fab fa-twitter fab-color"></i>
                  </a>
                </p>
              </div>
              <div class="col-md-3-aboutus">
                <div>
                  <img class="aboutus-img" src="./Img/person-4.jpg" alt="" />
                </div>
                <div class="text-wrap">
                  <h2>Claire Smith</h2>
                  <p>Chief Marketing Officer</p>
                </div>
                <p>
                  <a class="text-transform2" href="#">
                    <i class="fab fa-facebook-square fab-color"></i>
                  </a>
                  <a class="text-transform2" href="#">
                    <i class="fab fa-instagram fab-color"></i>
                  </a>
                  <a class="text-transform2" href="#">
                    <i class="fab fa-twitter fab-color"></i>
                  </a>
                </p>
              </div>
              <div class="col-md-3-aboutus">
                <div>
                  <img class="aboutus-img" src="./Img/person-5.jpeg" alt="" />
                </div>
                <div class="text-wrap">
                  <h2>Claire Smith</h2>
                  <p>Chief Marketing Officer</p>
                </div>
                <p>
                  <a class="text-transform2" href="#">
                    <i class="fab fa-facebook-square fab-color"></i>
                  </a>
                  <a class="text-transform2" href="#">
                    <i class="fab fa-instagram fab-color"></i>
                  </a>
                  <a class="text-transform2" href="#">
                    <i class="fab fa-twitter fab-color"></i>
                  </a>
                </p>
              </div>
              <div class="col-md-3-aboutus">
                <div>
                  <img class="aboutus-img" src="./Img/person-6.jpg" alt="" />
                </div>
                <div class="text-wrap">
                  <h2>Claire Smith</h2>
                  <p>Chief Marketing Officer</p>
                </div>
                <p class="text-wrap">
                  <a class="text-transform2" href="#">
                    <i class="fab fa-facebook-square fab-color"></i>
                  </a>
                  <a class="text-transform2" href="#">
                    <i class="fab fa-instagram fab-color"></i>
                  </a>
                  <a class="text-transform2" href="#">
                    <i class="fab fa-twitter fab-color"></i>
                  </a>
                </p>
              </div>
              <div class="col-md-3-aboutus">
                <div>
                  <img class="aboutus-img" src="./img/person_4.jpg" alt="" />
                </div>
                <div class="text-wrap">
                  <h2>Jean Smith</h2>
                  <p>General Counsel</p>
                </div>
                <p class="text-wrap">
                  <a class="text-transform2" href="#">
                    <i class="fab fa-facebook-square fab-color"></i>
                  </a>
                  <a class="text-transform2" href="#">
                    <i class="fab fa-instagram fab-color"></i>
                  </a>
                  <a class="text-transform2" href="#">
                    <i class="fab fa-twitter fab-color"></i>
                  </a>
                </p>
              </div>
            </div>
          </div>
          <div class="container contentContact margin-top-bot-0">
            <div class="row row-margin">
              <div class="col-sm-7">
                <p>
                  <iframe
                    src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d1584.1849407223663!2d-122.14482200000002!3d37.428366!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x808fbae435fe542f%3A0x507cec9581f778f7!2s318%20Cambridge%20Ave%2C%20Palo%20Alto%2C%20CA%2094306!5e0!3m2!1svi!2sus!4v1605561439321!5m2!1svi!2sus"
                    width="600"
                    height="450"
                    style="border: 0"
                    allowfullscreen=""
                    aria-hidden="false"
                    tabindex="0"
                  ></iframe>
                </p>
              </div>
              <div class="col-sm-5">
                <div>
                  <h1 class="aboutus-title">Contact Us</h1>
                  <p class="text-wrap">
                    Awesome, Inc.
                    <br />
                    318 Cambrige Avenue
                    <br />
                    Paolo Alto, Ca 9406
                    <br />
                    (415) 941-0376
                  </p>
                  <div class="joinUs text-wrap">
                    <a
                      class="btn-thao btn-primary gradient buy-now-button right"
                      href="contact.php"
                      target="_blank"
                      >Contact Us</a
                    >
                  </div>
                </div>
              </div>
            </div>
          </div>
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
            <li><div class="footer-head-list">Get in Touch</div></li>
            <li><a href="aboutUs.php" class="policy">About Us</a></li>
            <li><a href="contact.php" class="policy">Contact Us</a></li>
          </ul>
          <ul class="footer-list">
            <li><div class="footer-head-list">Policy</div></li>
            <li><a href="#" class="policy">Term of Services</a></li>
            <li><a href="#" class="policy">Private Policy</a></li>
          </ul>
        </div>
      </div>
    </div>
    <button onclick="topFunction()" id="myBtn" class="hidden" title="Go to top">
      <i class="fas fa-arrow-up"></i>
    </button>
    <script>
      document.getElementById("aboutus").classList.add('active'); 
    </script>
    <script src="JS/ddProfile.js"></script>
    <script src="JS/scrollToTop.js"></script>
    <script src="JS/sidebar.js"></script>
  </body>
</php>
