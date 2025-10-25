<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <title>Bds Frontend | Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" type="text/css" href="flaticon_component-fitness-icon.css">
    <link rel="stylesheet" type="text/css" href="{{asset('public/user/css')}}/datatables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <link href="{{asset('public/user/css')}}/menu-style.css" rel="stylesheet">
    <link href="{{asset('public/user/css')}}/style.css" rel="stylesheet">
    <style type="text/css">
    	body{
    		height: 100vh;
    		
    		background: var(--blue-color);
    		padding: 30px 20px 20px 20px;
    	}
    	.white-box{
    		height: 100%;
    		background: #f0f2f5;
    		border-radius: 8px;
    	}
    </style>
</head>
<body>
	
  <div class="white-box">
    <?php 

  

  // Function to find the difference  

  // between two dates. 

  function dateDiffInDays($date1, $date2)  

  { 

      // Calculating the difference in timestamps 
      $diff = strtotime($date2) - strtotime($date1); 
      // 1 day = 24 hours 
      // 24 * 60 * 60 = 86400 seconds 
      return abs(round($diff / 86400)); 

  } 

  // Creates DateTime objects 
  /*$datetime1 = date_create('17-09-2019'); 
  $datetime2 = date_create('25-09-2018'); 
  // Calculates the difference between DateTime objects 
  $interval = date_diff($datetime1, $datetime2); 
  // Display the result 
  echo $interval->format('Difference between two dates: %R%a days');*/

  //$dateDiff = dateDiffInDays($date1, $date2); 
?>

    <div class="container">
      <div class="choose-category">
        <div class="teaching-type">
          <h3>Select Teaching Type</h3>
        </div>
      </div>
      <div class="swiper mySwiper">
                <div class="swiper-wrapper">
                  @if(isset($getUsercourse) && !empty($getUsercourse))
                        @foreach($getUsercourse as $assignCourse)
                  <div class="swiper-slide">
                  <div class="card">
                        <div class="card-img">
                            <img src="{{asset('public/uploads/product')}}/{{$assignCourse->course_img}}" width="100%">
                        </div>
                        <div class="card-info">
                            <p class="text-title">{{$assignCourse->course_name}} <?php 

                                    $fdate = date('d-m-Y');
                                    $tdate =date('d-m-Y',strtotime($assignCourse->valid_date_time));
                                    $datetime1 = new DateTime($fdate);
                                    $datetime2 = new DateTime($tdate);
                                    $interval = $datetime1->diff($datetime2);
                                    $days = $interval->format('%R%a');//now do whatever you like with $days
                                    
                                    
                                      ?></p>
                                      @if($days>=1 || $days<=1)
                                    <a href="" onclick="event.preventDefault();
                                                     document.getElementById('paidform_{{$assignCourse->id}}').submit();"><div class="button no-border">Read Course</div></a>
                                    @else
                                    <a href="#"><div class="button no-border">Exipred Course</div></a>
                                    @endif
                        </div>
                    </div>
                  </div>
                    <form id="paidform_{{$assignCourse->id}}" action="{{ route('PaidForm') }}" method="POST" class="d-none">
                                        @csrf
                                        <input type="hidden" name="teach_id" id="teach_id" value="{{$assignCourse->teaching_id}}">
                                        <input type="hidden" name="product_id" id="product_id" value="{{$assignCourse->id}}">
                                    </form>
                   @endforeach
                    @endif
                    <!-- loop end -->
                  
                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-pagination"></div>
              </div>
      <!--<div class="product-slider">
          <div>
              <div class="card">
                            <div class="card-img">
                                <img src="https://bds.swastihomedecor.com/public/uploads/product/1672767101_airblock.jpg" width="100%">
                            </div>
                            <div class="card-info">
                                <p class="text-title">Teaching With Something</p>
                                <a href=""><div class="button no-border">Read Course</div></a>
                                
                            </div>
                        </div>
          </div>
      </div>-->
    </div>
  </div>
<script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
    <script type="text/javascript" src="{{asset('public/user/js')}}/datatables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
    <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>-->
    <script type="text/javascript" src="{{asset('public/user/js')}}/menu-script.js"></script>
    <script type="text/javascript" src="{{asset('public/user/js')}}/script.js"></script>

    <script>
    var swiper = new Swiper(".mySwiper", {
      slidesPerView: 1,
      spaceBetween: 10,
      pagination: {
        el: ".swiper-pagination",
        clickable: true,
      },
      navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
      },
      breakpoints: {
        640: {
          slidesPerView: 1,
          spaceBetween: 20,
        },
        768: {
          slidesPerView: 2,
          spaceBetween: 40,
        },
        1024: {
          slidesPerView: 2,
          spaceBetween: 50,
        },
      },
    });
  </script>
    <script>
    $('.product-slider').slick({
      dots: true,
      infinite: false,
      speed: 300,
      slidesToShow: 4,
      slidesToScroll: 4,
      responsive: [
        {
          breakpoint: 1024,
          settings: {
            slidesToShow: 3,
            slidesToScroll: 3,
            infinite: true,
            dots: true
          }
        },
        {
          breakpoint: 600,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 2
          }
        },
        {
          breakpoint: 480,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1
          }
        }
        // You can unslick at a given breakpoint now by adding:
        // settings: "unslick"
        // instead of a settings object
        
      ]
    });
  </script>
</body>
</html>