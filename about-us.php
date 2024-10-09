<?php
include 'user/config.php';
session_start();


// Query to retrieve data from the trip table
$sql = "SELECT * FROM trip";
$result = $conn->query($sql);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us Page</title>
<!-- include css all files -->
<?php
    include "components/files/css.php";
    ?>
</head>

<body>
        <!-- nav start -->
        <?php include ("components\header-footer\header.php"); ?>
        <!-- nav over -->
    
        <div class="container">
            <div class="section about-desc my-5">
                <h4>About Gujrat Tours</h4>
                <p>
                    Welcome to Gujrat Tours, your trusted partner in exploring the vibrant and diverse state of Gujarat! Whether you are looking for a cultural journey through its historic cities, a relaxing retreat along its stunning coastline, or an adventurous trek through its rugged landscapes, we are here to make your travel experience unforgettable.
                    With years of expertise in the travel industry, Gujrat Tours specializes in offering tailor-made itineraries to suit every traveler’s taste.
                    <br><br>
                    From heritage tours in Ahmedabad to wildlife safaris in Gir National Park, we curate experiences that showcase the best of Gujarat’s heritage, nature, and hospitality.
                    <br><br>
                    Our dedicated team of travel experts and local guides ensures that every trip is smooth, enjoyable, and memorable. We go the extra mile to provide personalized services, including comfortable accommodations, convenient transport, and insightful guidance, so you can focus on creating cherished memories.
                    <br><br>
                    At Gujrat Tours, we believe in responsible and sustainable tourism. We strive to protect the natural beauty and cultural richness of Gujarat while offering travelers an authentic and enriching experience.
                    Join us on a journey to discover Gujarat like never before. From hidden gems to iconic landmarks, let Gujrat Tours be your gateway to an extraordinary adventure.
                    Explore. Experience. Enjoy Gujarat with Gujrat Tours.
                </p>
            </div>
        </div>


<div class="container my-5">
    <!-- frequentily Asked Question's -->
    <h2 class="text-center my-5">Frequently Asked Questions (FAQ)</h2>
    <div class="accordion mb-3" id="faqAccordion">
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingOne">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    How do I book a trip with Gujrat Tours?
                </button>
            </h2>
            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    Booking a trip is easy! You can browse our wide range of trips on our website. Once you find the trip you like, click on the "Book Now" button and follow the instructions. You can also contact us directly for custom bookings.
                </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingTwo">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    What types of trips do you offer?
                </button>
            </h2>
            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    We offer a variety of trips, including cultural tours, adventure trips, wildlife safaris, and more. We also provide customized itineraries based on your preferences.
                </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingThree">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                    Are the tours customizable?
                </button>
            </h2>
            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    Yes! We offer tailor-made tours to suit your travel needs. Whether you want to focus on specific destinations, experiences, or themes, we’ll work with you to create the perfect trip.
                </div>
            </div>
        </div>
        <!-- Add more FAQ items here -->
    </div>

    <div class="row my-5">
        <div class="col-md-4" style="background-color: black; color:white; border-radius: 10px 0px 0px 10px;">
            <h2 class="my-3 text-start">Share Your Experience</h2>
            <form id="reviewForm" class="mb-4">
                <div class="mb-3">
                    <label for="reviewerName" class="form-label">Your Name</label>
                    <input type="text" class="form-control" id="reviewerName" required>
                </div>
                <div class="mb-3">
                    <label for="reviewText" class="form-label">Your Review</label>
                    <textarea class="form-control" id="reviewText" rows="3" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
        
        <div class="col-md-8" style="background-color:#FAF7F0; color:black; border-radius: 0px 10px 10px 0px;">
            <h2 class="my-5 text-center">User Reviews</h2>
            <div id="reviewCarousel" class="carousel slide review-slider" data-bs-ride="carousel">
                <div class="carousel-inner mt-5" id="carouselReviews">
                    <div class="carousel-item active">
                        <div class="d-flex flex-column align-items-center">
                            <h5>John Doe</h5>
                            <p>“My trip to Gujarat with Gujrat Tours was simply amazing! The itinerary was perfectly tailored to my interests, and the team ensured that everything went smoothly. Highly recommend!”</p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="d-flex flex-column align-items-center">
                            <h5>Sarah Patel</h5>
                            <p>“I explored the heritage of Gujarat with Gujrat Tours, and I was blown away by the rich history and beautiful sights. The guides were knowledgeable, and the services were top-notch.”</p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="d-flex flex-column align-items-center">
                            <h5>Rajiv Singh</h5>
                            <p>“From booking to the actual trip, everything was seamless. Gujrat Tours provided excellent customer service, and the hotels they booked for us were fantastic. Will definitely travel with them again!”</p>
                        </div>
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#reviewCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#reviewCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </div>

    <!-- Review Modal -->
    <div class="modal fade" id="reviewModal" tabindex="-1" aria-labelledby="reviewModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="reviewModalLabel">Submit Your Review</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="reviewerName" class="form-label">Your Name</label>
                            <input type="text" class="form-control" id="reviewerName" required>
                        </div>
                        <div class="mb-3">
                            <label for="reviewText" class="form-label">Your Review</label>
                            <textarea class="form-control" id="reviewText" rows="3" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>

        <!-- footer start -->
        <?php include ("components/header-footer/user-footer.php"); ?>
        <!-- footer over -->


<script>
    // Handle review form submission
    document.getElementById('reviewForm').addEventListener('submit', function (event) {
        event.preventDefault(); // Prevent form submission

        const name = document.getElementById('reviewerName').value;
        const review = document.getElementById('reviewText').value;

        // Create a new carousel item
        const newItem = document.createElement('div');
        newItem.classList.add('carousel-item');

        // Add content to the new item
        newItem.innerHTML = `
            <div class="d-flex flex-column align-items-center">
                <h5>${name}</h5>
                <p>“${review}”</p>
            </div>
        `;

        // Append the new item to the carousel
        document.getElementById('carouselReviews').appendChild(newItem);

        // Reset the form
        document.getElementById('reviewForm').reset();

        // If this is the first item, make it active
        if (document.getElementById('carouselReviews').children.length === 1) {
            newItem.classList.add('active');
        }

        // Restart the carousel
        const carousel = new bootstrap.Carousel(document.getElementById('reviewCarousel'));
        carousel.to(document.getElementById('carouselReviews').children.length - 1);
    });
</script>

</body>
    <!-- include css all files -->
    <?php
    include "components/files/js.php";
    ?></html>