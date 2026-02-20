<!doctype html>
<html>

<head>
  <?php $this->theme->head('theme_default'); ?>
  <style>
  .cursor {
    cursor: pointer;
  }

  /* Six columns side by side */
  .column {
    float: left;
    width: 16.66%;
  }

  /* Add a transparency effect for thumnbail images */
  .demo {
    opacity: 0.6;
  }

  .active,
  .demo:hover {
    opacity: 1;
  }

  @media (min-width: 768px) {
    .carousel-multi-item-2 .col-sm-2 {
      float: left;
      width: 16%;
      max-width: 100%;
    }
  }

  .card {
    padding: 0;
  }

  .black-text {
    margin-left: 15px;
    position: absolute;
    top: 50%;
    -ms-transform: translateY(-50%);
    transform: translateY(-50%);
  }
  </style>
</head>

<body>

  <!--Carousel Wrapper-->
  <div id="multi-item-example" class="carousel slide carousel-multi-item carousel-multi-item-2" data-ride="carousel"
    data-interval="false">

    <div class="mySlides">
      <img src="img_woods_wide.jpg" style="width:100%">
    </div>

    <div class="row">

      <div class="col-md-1">
        <a class="black-text" href="#multi-item-example" data-slide="prev">
          <img class="img-fluid" src="<?php echo base_url('assets/img/prev.png'); ?>" alt="Card image cap">
        </a>
      </div>

      <div class="col-md-10">
        <!--Slides-->

        <div class="carousel-inner" role="listbox">

          <!--First slide-->
          <div class="carousel-item active">

            <div class="col-sm-2 mb-3">
              <div class="column">
                <img class="demo cursor" src="https://mdbootstrap.com/img/Photos/Horizontal/Nature/4-col/img%20(10).jpg"
                  style="width:100%" onclick="currentSlide(1)" alt="The Woods">
              </div>
            </div>

            <div class="col-sm-2 mb-3">
              <div class="column">
                <img class="demo cursor" src="https://mdbootstrap.com/img/Photos/Horizontal/Nature/4-col/img%20(10).jpg"
                  style="width:100%" onclick="currentSlide(1)" alt="The Woods">
              </div>
            </div>

            <div class="col-sm-2 mb-3">
              <div class="column">
                <img class="demo cursor" src="https://mdbootstrap.com/img/Photos/Horizontal/Nature/4-col/img%20(10).jpg"
                  style="width:100%" onclick="currentSlide(1)" alt="The Woods">
              </div>
            </div>

            <div class="col-sm-2 mb-3">
              <div class="column">
                <img class="demo cursor" src="https://mdbootstrap.com/img/Photos/Horizontal/Nature/4-col/img%20(10).jpg"
                  style="width:100%" onclick="currentSlide(1)" alt="The Woods">
              </div>
            </div>

            <div class="col-sm-2 mb-3">
              <div class="column">
                <img class="demo cursor" src="https://mdbootstrap.com/img/Photos/Horizontal/Nature/4-col/img%20(10).jpg"
                  style="width:100%" onclick="currentSlide(1)" alt="The Woods">
              </div>
            </div>

          </div>
          <!--/.First slide-->

          <!--Second slide-->
          <div class="carousel-item">

            <div class="col-sm-2 mb-3">
              <div class="card">
                <img class="img-fluid" src="https://mdbootstrap.com/img/Photos/Horizontal/Nature/4-col/img%20(53).jpg"
                  alt="Card image cap" onclick="currentSlide(7)">
              </div>
            </div>

            <div class="col-sm-2 mb-3">
              <div class="card">
                <img class="img-fluid" src="https://mdbootstrap.com/img/Photos/Horizontal/Nature/4-col/img%20(25).jpg"
                  alt="Card image cap" onclick="currentSlide(8)">
              </div>
            </div>

            <div class="col-sm-2 mb-3">
              <div class="card">
                <img class="img-fluid" src="https://mdbootstrap.com/img/Photos/Horizontal/Nature/4-col/img%20(47).jpg"
                  alt="Card image cap" onclick="currentSlide(9)">
              </div>
            </div>

            <div class="col-sm-2 mb-3">
              <div class="card">
                <img class="img-fluid" src="https://mdbootstrap.com/img/Photos/Horizontal/Nature/4-col/img%20(26).jpg"
                  alt="Card image cap" onclick="currentSlide(10)">
              </div>
            </div>

            <div class="col-sm-2 mb-3">
              <div class="card">
                <img class="img-fluid" src="https://mdbootstrap.com/img/Photos/Horizontal/Nature/4-col/img%20(25).jpg"
                  alt="Card image cap" onclick="currentSlide(11)">
              </div>
            </div>

            <div class="col-sm-2 mb-3">
              <div class="card">
                <img class="img-fluid" src="https://mdbootstrap.com/img/Photos/Horizontal/Nature/4-col/img%20(47).jpg"
                  alt="Card image cap" onclick="currentSlide(12)">
              </div>
            </div>

          </div>
          <!--/.Second slide-->

          <!--Third slide-->
          <div class="carousel-item">

            <div class="col-sm-2 mb-3">
              <div class="card">
                <img class="img-fluid" src="https://mdbootstrap.com/img/Photos/Horizontal/Nature/4-col/img%20(64).jpg"
                  alt="Card image cap" onclick="currentSlide(13)">
              </div>
            </div>

            <div class="col-sm-2 mb-3">
              <div class="card">
                <img class="img-fluid" src="https://mdbootstrap.com/img/Photos/Horizontal/Nature/4-col/img%20(51).jpg"
                  alt="Card image cap" onclick="currentSlide(14)">
              </div>
            </div>

            <div class="col-sm-2 mb-3">
              <div class="card">
                <img class="img-fluid" src="https://mdbootstrap.com/img/Photos/Horizontal/Nature/4-col/img%20(59).jpg"
                  alt="Card image cap" onclick="currentSlide(15)">
              </div>
            </div>

            <div class="col-sm-2 mb-3">
              <div class="card">
                <img class="img-fluid" src="https://mdbootstrap.com/img/Photos/Horizontal/Nature/4-col/img%20(63).jpg"
                  alt="Card image cap" onclick="currentSlide(16)">
              </div>
            </div>

            <div class="col-sm-2 mb-3">
              <div class="card">
                <img class="img-fluid" src="https://mdbootstrap.com/img/Photos/Horizontal/Nature/4-col/img%20(51).jpg"
                  alt="Card image cap" onclick="currentSlide(17)">
              </div>
            </div>

            <div class="col-sm-2 mb-3">
              <div class="card">
                <img class="img-fluid" src="https://mdbootstrap.com/img/Photos/Horizontal/Nature/4-col/img%20(59).jpg"
                  alt="Card image cap" onclick="currentSlide(18)">
              </div>
            </div>

          </div>
          <!--/.Third slide-->

        </div>
        <!--/.Slides-->

      </div>

      <div class="col-md-1">
        <a class="black-text" href="#multi-item-example" data-slide="next">
          <img class="img-fluid" src="<?php echo base_url('assets/img/next.png'); ?>" alt="Card image cap">
        </a>
      </div>
    </div>
  </div>
  <!--/.Carousel Wrapper-->

  <?php $this->theme->script('theme_default'); ?>
  <script>
  function currentSlide(n) {
    showSlides(slideIndex = n);
  }

  function showSlides(n) {
    var i;
    var slides = document.getElementsByClassName("mySlides");
    var dots = document.getElementsByClassName("demo");
    var captionText = document.getElementById("caption");
    if (n > slides.length) {
      slideIndex = 1
    }
    if (n < 1) {
      slideIndex = slides.length
    }
    for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";
    }
    for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" active", "");
    }
    slides[slideIndex - 1].style.display = "block";
    dots[slideIndex - 1].className += " active";
    captionText.innerHTML = dots[slideIndex - 1].alt;
  }
  </script>
</body>

</html>