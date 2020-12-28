<?php 
  // ob_start();
  // session_start();
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
	
    <link rel="stylesheet" type="text/css" href="css/animate.css" />
    <script
      src="https://kit.fontawesome.com/ae09c0f9d5.js"
      crossorigin="anonymous"
    ></script>
    <title>Home</title>
    <style>
      
    </style>
  </head>
  <body>
    <div class="container-fluid">
      <div class="overlay hidden"></div>
       <!-- sidebar -->
      <?php 
        include "_navbar.php"
      ?>
      <br /><br /><br />
      <div class="landing-home">
        <div class="mini-content">
          <div class="col-sm-6">
            <div class="inner-content">
              <h1 class="content-title">Get Started with AwesomePic</h1>
              <h6>Discover and follow the awesome pictures.</h6>
              <h6>Get awesome pictures in senconds</h6>
              <a class="btn-thao btn-primary gradient right" href="products.php">
                Get Started
              </a>
            </div>
          </div>
          <div class="col-sm-6">
            <img
              src="img/about-intro-bg-3.jpg"
              alt="start"
              class="animated fadeInUp inner-img"
            />
          </div>
          <div class="line"></div>
        </div>
        <br /><br /><br />
        <div class="mini-content">
          <div class="col-sm-6">
            <img
              src="img/simple.png"
              alt="simple"
              class="animated fadeInUp inner-img"
            />
          </div>
          <div class="col-sm-6">
            <div class="inner-content">
              <h1 class="content-title">Get photos simply</h1>
              <p>
                Your pictures says a lot about yourself. If it looks good, it
                leaves a good impression on your potential customers. If it
                looks bad, it could leave a bad impression, even if your
                products or services are top-notch. Best of all, you don’t have
                to have any greate picture you can be proud of – AwesomePic
                makes it easy.
              </p>
            </div>
          </div>
          <div class="line"></div>
        </div>
        <br /><br /><br />
        <div class="mini-content">
          <div class="col-sm-6">
            <div class="inner-content">
              <h1 class="content-title">Diverse Topics</h1>
              <p>
                Select from hundreds of unique pictures professionally designed
                with your industry in mind.
              </p>
            </div>
          </div>
          <div class="col-sm-6">
            <img
              src="img/variety.png"
              alt="variety"
              class="animated fadeInUp inner-img"
            />
          </div>
          <div class="line"></div>
        </div>
        <br /><br />

        <div>
          <h1 class="content-title">AwesomePic Partnerships</h1>
          <p class="partner-intro">
            Integrating the AwesomePic experience you already know and love.
          </p>
          <div class="partnership">
            <div class="partners">
              <div class="col-sm-6">
                <div class="partner">
                  <img src="img/freepik.png" alt="freepik" class="freepik" />
                  <br />
                  <h6 class="partner-title">This is FreePik.</h6>
                  <br />
                  <p>
                    Through the use of unlikely textures, intriguing subject
                    matter, and new formats — photography has the power to
                    challenge our perspectives and push creativity forward.
                    Whether it’s a peaceful bedroom or a cluttered kitchen —
                    photographs of our spaces tell the story of who we are.
                  </p>
                  <a
                    class="btn-thao btn-primary right"
                    href="https://www.freepik.com/"
                    >Learn More
                  </a>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="partner">
                  <img src="img/pixabay.png" alt="pixabay" class="pixabay" />
                  <br />
                  <h6 class="partner-title">This is PixaBay.</h6>
                  <br />
                  <p>
                    Real people, captured. Photography has the power to reflect
                    the world around us, give voice to individuals and groups
                    within our communities - tell their story. From epic drone
                    shots to inspiring moments in nature, find free HD
                    wallpapers worthy of your mobile and desktop screens.
                  </p>
                  <a
                    class="btn-thao btn-primary right"
                    href="https://pixabay.com/"
                    >Learn More</a
                  >
                </div>
              </div>
            </div>
          </div>
        </div>
        <br /><br />
        <div class="reviews">
          <h1 class="content-title">Trusted by 1,000+ users</h1>
          <br />
          <div class="row">
            <div class="col-sm-4">
              <div class="review">
                <h2 class="user">Captain</h2>
                <div class="rating">
                  <span class="fa fa-star checked"></span>
                  <span class="fa fa-star checked"></span>
                  <span class="fa fa-star checked"></span>
                  <span class="fa fa-star checked"></span>
                  <span class="fa fa-star checked"></span>
                </div>
                <p class="review-content">
                  Suuuuuper easy to use with suuuuuper creative photos, which
                  gives you quality designs.
                </p>
              </div>
            </div>
            <div class="col-sm-4">
              <div class="review">
                <h2 class="user">Spiderman</h2>
                <div class="rating">
                  <span class="fa fa-star checked"></span>
                  <span class="fa fa-star checked"></span>
                  <span class="fa fa-star checked"></span>
                  <span class="fa fa-star checked"></span>
                  <span class="fa fa-star checked"></span>
                </div>
                <p class="review-content">
                  Fun, quick and simple way to get photos for Facebook,
                  Instagram, and Pinterest!
                </p>
              </div>
            </div>
            <div class="col-sm-4">
              <div class="review">
                <h2 class="user">Ironman</h2>
                <div class="rating">
                  <span class="fa fa-star checked"></span>
                  <span class="fa fa-star checked"></span>
                  <span class="fa fa-star checked"></span>
                  <span class="fa fa-star checked"></span>
                  <span class="fa fa-star checked"></span>
                </div>
                <p class="review-content">
                  I was worried about how I would get a photo for my store, but
                  thanks to AwesomwPic it was so surprising and exciting.
                </p>
              </div>
            </div>
          </div>
        </div>
        <br /><br />
        <div class="ending">
          <h1 class="content-title">What are you waiting for?</h1>
          <p class="final-content">
            How do you get a great photo so you can launch your brand on the
            right foot? You could spend a lot of time and money getting one
            professionally photo. Or, you can hop online and try out AwesomePic.
          </p>
          <button class="btn-thao btn-primary right gradient">
            Get Started
          </button>
        </div>
        <br /><br />
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
    <script>
      document.getElementById("home").classList.add('active'); 
    </script>
    <script src="JS/scrollToTop.js"></script>

    
    <script src="JS/ddProfile.js"></script>
    <script src="JS/scrollToTop.js"></script>
    <script src="JS/sidebar.js"></script>
  </body>
</html>
