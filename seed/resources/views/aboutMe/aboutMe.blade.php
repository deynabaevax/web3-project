@extends('layouts.app')
@section('content')
<!--Section: Testimonials v.1-->
<section class="section pb-3 text-center">
    <!--Section heading-->
    <h3 class="section-heading h3 pt-4" style="text-align:center">Welcome to my blog!</h3><p><br>
<!-- Grid row -->
<div class="row">

    <!-- Grid column -->
    <div class="col-lg-4 col-md-12">
  
      <!--Card Wider-->
      <div class="card card-cascade wider">
  
        <!--Card image-->
        <div class="view view-cascade overlay">
          <img src="/storage/cover_images/profile.jpg" alt="wider" class="card-img-top">
          <a href="#!">
            <div class="mask rgba-white-slight"></div>
          </a>
        </div>
        <!--/Card image-->
  
        <!--Card content-->
        <div class="card-body card-body-cascade text-center">
          <!--Title-->
          <h4 class="card-title"><strong>Jane Doe</strong></h4>
          <h5 class="indigo-text"><strong>Adventurer</strong></h5>
  
          <p class="card-text">I am Jane my passion is traveling, capturing moments and exploring new places around the world!</p>
  
  
          <!--Linkedin-->
          <a class="icons-sm li-ic" href="https://www.linkedin.com/"><i class="fab fa-linkedin-in"> </i></a>
          <!--Dribbble-->
          <a class="icons-sm fb-ic" style="color:black" href="https://www.facebook.com/mustdotravels/"><i class="fab fa-facebook-f"> </i></a>
  
        </div>
        <!--/.Card content-->
  
      </div>
      <!--/.Card Wider-->
  
    </div>
    <!-- Grid column -->
  <div class="col-md-4">

    <!--Card Narrower-->
    {{-- <div class="card card-cascade narrower"> --}}

      <!--Card image-->
      <div class="view overlay">
        <img src="/storage/cover_images/img1.jpg" class="img-fluid rounded-circle" alt="">
      </div>
      <!--/.Card image-->

  </div>
  <!-- Grid column -->
  <div class="col-md-4">

    <!--Card Narrower-->
    {{-- <div class="card card-cascade narrower"> --}}

      <!--Card image-->
      <div class="view overlay">
        <img src="/storage/cover_images/img3.jpg" class="img-fluid rounded-circle" alt="">
    </div>
      <!--/.Card image-->

  </div>
</div>
<p>
</section>
  
  @endsection