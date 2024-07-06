<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>home page</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- font awesome cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css.css">
    <!-- custom css -->
    <link rel="stylesheet" href="components\css\site-css.css">
    <!-- swiper css -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

</head>

<body>

    <section class="trip-package">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-6 col-lg-3 my-3">
                    <div class="image"><img src="components\images\Destinations\abudhabi.png" style="width: 100%;"
                            alt="" srcset=""></div>
                    <div class="trip-img-detail mt-3">
                        <h3>Demo 1</h3>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nam similique veritatis officia.</p>
                        <input type="submit" value="Read More" class="btn btn-success">
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-3 my-3">
                    <div class="image"><img src="components\images\Destinations\abudhabi.png" style="width: 100%;"
                            alt="" srcset=""></div>
                    <div class="trip-img-detail mt-3">
                        <h3>Demo 2</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nulla quaerat nobis necessitatibus?
                        </p>
                        <input type="submit" value="Read More" class="btn btn-success">
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-3 my-3">
                    <div class="image"><img src="components\images\Destinations\abudhabi.png" style="width: 100%;"
                            alt="" srcset=""></div>
                    <div class="trip-img-detail mt-3">
                        <h3>Demo 3</h3>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Esse ab temporibus aspernatur.</p>
                        <input type="submit" value="Read More" class="btn btn-success">
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-3 my-3">
                    <div class="image"><img src="components\images\Destinations\abudhabi.png" style="width: 100%;"
                            alt="" srcset=""></div>
                    <div class="trip-img-detail mt-3">
                        <h3>Demo 4</h3>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Esse ab temporibus aspernatur.</p>
                        <input type="submit" value="Read More" class="btn btn-success">
                    </div>
                </div>
            </div>
            <!-- <button type="submit" class="btn btn-success">Show All Trip</button> -->
        </div>
    </section>

    <section class="trip"></section>
</body>
<!-- Swiper JS -->
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

<!-- Initialize Swiper -->
<script>
    var swiper = new Swiper(".mySwiper", {
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
    });
</script>
<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous"></script>

<!-- font awesome cdn js link -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/js/all.min.js"></script>

</html>