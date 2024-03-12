<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Upress</title>

    <!-- Bootstrap core CSS -->
    <link href="../../landingpage/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
<!--



-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha384-nfF0pACuL6Df1PEHsuvQa3dxj1qSfWdI6YlY8+NO1L7SdLEqdXt1sGgE4IkuPwKc" crossorigin="anonymous">

    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="../landingpage/assets/css/fontawesome.css">
    <link rel="stylesheet" href="../landingpage/assets/css/templatemo-sixteen.css">
    <link rel="stylesheet" href="../landingpage/assets/css/owl.css">
    <link rel="shortcut icon" href="../../../assets/logo/upress-logo.png" />
  </head>

  <body>
    <div class="main-wrapper">
    
    {{-- <!-- ***** Preloader Start ***** -->
    <div id="preloader">
      <div class="jumper">
          <div></div>
          <div></div>
          <div></div>
      </div>
  </div>
  <!-- ***** Preloader End ***** -->

     --}}
    <footer>
        @include('customer.body.footers')
      </footer>
    </div>
        <!-- Bootstrap core JavaScript -->
        <script src="../landingpage/vendor/jquery/jquery.min.js"></script>
        <script src="../landingpage/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    
    
        <!-- Additional Scripts -->
        <script src="../landingpage/assets/js/custom.js"></script>
        <script src="../landingpage/assets/js/owl.js"></script>
        <script src="../landingpage/assets/js/slick.js"></script>
        <script src="../landingpage/assets/js/isotope.js"></script>
        <script src="../landingpage/assets/js/accordions.js"></script>
    
    
        <script language = "text/Javascript"> 
          cleared[0] = cleared[1] = cleared[2] = 0; //set a cleared flag for each field
          function clearField(t){                   //declaring the array outside of the
          if(! cleared[t.id]){                      // function makes it static and global
              cleared[t.id] = 1;  // you could use true and false, but that's more typing
              t.value='';         // with more chance of typos
              t.style.color='#fff';
              }
          }
        </script>
     <script>
        document.addEventListener('DOMContentLoaded', function () {
            const profileDropdown = document.getElementById('profileDropdown');
            const dropdownMenu = profileDropdown.nextElementSibling;
    
            profileDropdown.addEventListener('click', function () {
                dropdownMenu.classList.toggle('show');
            });
    
            window.addEventListener('click', function (e) {
                if (!profileDropdown.contains(e.target)) {
                    dropdownMenu.classList.remove('show');
                }
            });
        });
    </script>
    
      </body>
    
    </html>
    