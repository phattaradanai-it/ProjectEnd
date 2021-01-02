<style>
  @media screen and (min-width: 425px) and (max-width: 767px) {
    .carousel {
      max-width: 65vw;
    }

    /* left or forward direction */
    .active.carousel-item-left+.carousel-item-next.carousel-item-left,
    .carousel-item-next.carousel-item-left+.carousel-item {
      position: absolute;
    }

    /* farthest right hidden item must be abso position for animations */
    .carousel-inner .carousel-item-prev.carousel-item-right {
      position: absolute;
    }

    /* right or prev direction */
    .active.carousel-item-right+.carousel-item-prev.carousel-item-right,
    .carousel-item-prev.carousel-item-right+.carousel-item {
      position: relative;
    }

  }

  /* Tablet and up */
  @media screen and (min-width: 768px) {

    .carousel-inner .active,
    .carousel-inner .active+.carousel-item {
      display: block;
    }

    .carousel-inner .carousel-item.active:not(.carousel-item-right):not(.carousel-item-left),
    .carousel-inner .carousel-item.active:not(.carousel-item-right):not(.carousel-item-left)+.carousel-item {
      -webkit-transition: none;
      transition: none;
    }

    .carousel-inner .carousel-item-next,
    .carousel-inner .carousel-item-prev {
      position: relative;
      -webkit-transform: translate3d(0, 0, 0);
      transform: translate3d(0, 0, 0);
    }

    .carousel-inner .active.carousel-item+.carousel-item+.carousel-item+.carousel-item {
      position: absolute;
      top: 0;
      right: -50%;
      z-index: -1;
      display: block;
      visibility: visible;
    }

    /* left or forward direction */
    .active.carousel-item-left+.carousel-item-next.carousel-item-left,
    .carousel-item-next.carousel-item-left+.carousel-item {
      /* position: relative; */
      -webkit-transform: translate3d(-100%, 0, 0);
      transform: translate3d(-100%, 0, 0);
      visibility: visible;
    }

    /* farthest right hidden item must be abso position for animations */
    .carousel-inner .carousel-item-prev.carousel-item-right {
      position: absolute;
      top: 0;
      left: 0;
      z-index: -1;
      display: block;
      visibility: visible;
    }

    /* right or prev direction */
    .active.carousel-item-right+.carousel-item-prev.carousel-item-right,
    .carousel-item-prev.carousel-item-right+.carousel-item {
      position: relative;
      -webkit-transform: translate3d(100%, 0, 0);
      transform: translate3d(100%, 0, 0);
      visibility: visible;
      display: block;
      visibility: visible;
    }
  }

  /* Desktop and up */

  @media screen and (min-width: 992px) {

    .carousel-inner .active,
    .carousel-inner .active+.carousel-item,
    .carousel-inner .active+.carousel-item+.carousel-item {
      display: block;
    }

    .carousel-inner .carousel-item.active:not(.carousel-item-right):not(.carousel-item-left),
    .carousel-inner .carousel-item.active:not(.carousel-item-right):not(.carousel-item-left)+.carousel-item,
    .carousel-inner .carousel-item.active:not(.carousel-item-right):not(.carousel-item-left)+.carousel-item+.carousel-item {
      -webkit-transition: none;
      transition: none;
    }

    .carousel-inner .carousel-item-next,
    .carousel-inner .carousel-item-prev {
      position: relative;
      -webkit-transform: translate3d(0, 0, 0);
      transform: translate3d(0, 0, 0);
    }

    .carousel-inner .active.carousel-item+.carousel-item+.carousel-item+.carousel-item {
      position: absolute;
      top: 0;
      right: -33.3333%;
      z-index: 1;
      display: block;
      visibility: visible;
    }

    /* left or forward direction */
    .active.carousel-item-left+.carousel-item-next.carousel-item-left,
    .carousel-item-next.carousel-item-left+.carousel-item,
    .carousel-item-next.carousel-item-left+.carousel-item+.carousel-item,
    .carousel-item-next.carousel-item-left+.carousel-item+.carousel-item+.carousel-item {
      position: relative;
      -webkit-transform: translate3d(-100%, 0, 0);
      transform: translate3d(-100%, 0, 0);
      visibility: visible;
    }

    /* farthest right hidden item must be abso position for animations */
    .carousel-inner .carousel-item-prev.carousel-item-right {
      position: absolute;
      top: 0;
      left: 0;
      z-index: 0;
      display: block;
      visibility: visible;
    }

    /* right or prev direction */
    .active.carousel-item-right+.carousel-item-prev.carousel-item-right,
    .carousel-item-prev.carousel-item-right+.carousel-item,
    .carousel-item-prev.carousel-item-right+.carousel-item+.carousel-item,
    .carousel-item-prev.carousel-item-right+.carousel-item+.carousel-item+.carousel-item {
      position: relative;
      -webkit-transform: translate3d(100%, 0, 0);
      transform: translate3d(100%, 0, 0);
      visibility: visible;
      /* display: block;
      visibility: visible; */
    }

  }

  .card-body {
    background-color: white;
    margin-top: -40%;
    padding-top: 45%;
    text-align: center;
    margin-bottom: 1vh;
    min-height: 48vh;
    box-shadow: 5px 5px 5px #9898982c;
    background-image: url("img/cert_img/background.jpg");
    background-size: cover; 
}

.card-sub-title {
    font-size: 1.4vh !important;
}

.card-title {
    font-size: 2.2vh !important;
}

</style>
<?php

$conn = new mysqli("localhost", "root", "", "digitech");
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql2 = "SELECT * FROM student where std_firstname = '" . $_SESSION["user_firstname"] . "'";
$query2 = mysqli_query($conn, $sql2)  or die($mysqli->error);
$result2 = mysqli_fetch_assoc($query2); //query get degree


$sql = "SELECT * FROM program LIMIT 8"; // ค้นหา
    $query = mysqli_query($conn, $sql)  or die($mysqli->error);
 // query fetch cert order by degree of student

$i = 0;
?>

<div class="container-fluid align-center">
  <div id="myCarousel" class="carousel slide " data-ride="carousel">
    <div class="row">

      <!-- left arrow -->
      <div class="col-1 align-center p-0" id="left-arrow">
        <a class="mx-1 prev" id="prev" title="Previous">
          <i class="fa fa-chevron-left main-color arrows"></i>
        </a>
      </div>

      <!-- main card -->
      <div class="col-10" id="badge-card">
        <div class="carousel-inner row w-100 mx-auto">
          <?php  while ($result = mysqli_fetch_assoc($query)) {   ?>
            <div class="carousel-item col-md-4  <?php echo $i == 0 ? 'active' : '' ?> ">

              <div class="card2">
                <!-- img -->
                <div class="card-body">

                  <!-- title -->
                  <div class="card-head-title">
                    <p class="card-title"><?php echo $result['program_name_en'] ?></p>
                    <p class="card-title"><?php echo $result['program_name_th'] ?></p><br>
                    <p class="card-sub-title"> <?php echo"Approved by : DIGITECH, Suranaree University of Technology" ?></p>
                  </div>
                <div>

                </div>
      
                  <!-- submit button -->
                  <div class="form">
                    <form action="course_detail.php" method="post">
                      <input type="hidden" name="course" value="<?php echo htmlspecialchars(serialize($value)) ?>">
                      <button type="submit"> Detail > </button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          <?php $i++;
          } ?>

        </div>

      </div>

      <!-- right arrow -->
      <div class="col-1 align-center p-0" id="right-arrow">
        <a class="mx-1 next" id="next" title="Next">
          <i class="fa fa-chevron-right main-color arrows"></i>
        </a>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  window.addEventListener("load", calBadgeAnimation);
  window.addEventListener("resize", calBadgeAnimation);

  function calBadgeAnimation() {
    var itemsPerSlide = parseInt($(window).width()) <= 991 ? (parseInt($(window).width()) <= 768 ? 1 : 2) : 3;
    var totalItems = $(".carousel-item").length;
    document.getElementById("prev").classList.add("arrow-disabled");

    if (totalItems <= itemsPerSlide) {
      document.getElementById("next").classList.add("arrow-disabled");
    } else {
      document.getElementById("next").classList.remove("arrow-disabled");
    }
  }


  (function($) {

    "use strict";
    // Auto-scroll
    $("#myCarousel").carousel({
      interval: 0
    });

    // Control buttons
    $(".next").click(function() {
      $(".carousel").carousel("next");
      return false;
    });
    $(".prev").click(function() {
      $(".carousel").carousel("prev");
      return false;
    });

    // On carousel scroll
    $("#myCarousel").on("slide.bs.carousel", function(e) {
      var $e = $(e.relatedTarget);
      var idx = $e.index();
      var itemsPerSlide = parseInt($(window).width()) <= 991 ? (parseInt($(window).width()) <= 768 ? 1 : 2) : 3;
      var totalItems = $(".carousel-item").length;

      if (idx == 0) {
        document.getElementById("next").classList.remove("arrow-disabled");
        document.getElementById("prev").classList.add("arrow-disabled");
      } else if (idx == totalItems - (itemsPerSlide)) {
        document.getElementById("next").classList.add("arrow-disabled");
        document.getElementById("prev").classList.remove("arrow-disabled");
      } else {
        document.getElementById("next").classList.remove("arrow-disabled");
        document.getElementById("prev").classList.remove("arrow-disabled");
      }
      // if (idx >= totalItems - (itemsPerSlide - 1)) {
      //   var it = itemsPerSlide - (totalItems - idx);
      //   for (var i = 0; i < it; i++) {
      //     // append slides to end
      //     if (e.direction == "left") {
      //       $(".carousel-item")
      //         .eq(i)
      //         .appendTo(".carousel-inner");
      //     } else {
      //       $(".carousel-item")
      //         .eq(0)
      //         .appendTo(".carousel-inner");
      //     }
      //   }
      // }
    });

  })(jQuery);
</script>