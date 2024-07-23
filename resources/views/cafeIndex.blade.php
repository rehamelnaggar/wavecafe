<!DOCTYPE html>
<html lang="en">
<head>
  @include('includes.head')
</head>
<body>
  <div class="tm-container">
    <div class="tm-row">
      <!-- Site Header -->
      @include('includes.siteHeader')
            <!-- Drink Menu Page -->
            @include('includes.drinkMenu')
            <!-- end Drink Menu Page -->
          </div>

          <!-- About Us Page -->
          @include('includes.aboutUs')
          <!-- end About Us Page -->

          <!-- Special Items Page -->
          @include('includes.specialItems')
       
          <!-- end Special Items Page -->

          <!-- Contact Page -->
          @include('includes.contact')
          <!-- end Contact Page -->
        </main>
      </div>    
    </div>
    <footer class="tm-site-footer">
      <p class="tm-black-bg tm-footer-text">Copyright 2020 Wave Cafe
      
      | Design: <a href="https://www.tooplate.com" class="tm-footer-link" rel="sponsored" target="_parent">Tooplate</a></p>
    </footer>
  </div>
    
 <!-- Background video -->
 @include('includes.backgroundVideo')
</body>
</html>