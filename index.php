<?php
$title = 'Office of Blue Team Management';
$curnav = 'Home';

include './includes/session.php';
include './includes/header.php';
?>
<section id="main-slider" class="no-margin">
    <div class="carousel slide wet-asphalt">
        <div class="carousel-inner">
            <div class="item active" style="background-image: url(/assets/images/hacker.jpg)">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="carousel-content center centered">
                                <h2 class="animation animated-item-1">Cyber Security Resource Center</h2>
                                <p class="animation animated-item-2">Stay informed; Get Protected.</p>
                                <br>
                                <a class="btn btn-md animation animated-item-3" href="/security.php">Learn More</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="services" class="emerald">
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-sm-6">
                <div class="media">
                    <div class="media-body">
                        <h3 class="media-heading">Telecommuting</h3>
                        <p>OBM is focused on Improving Operation Continuity, Implementing Effective Management and Promoting Work/Life Balance.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-6">
                <div class="media">
                    <div class="media-body">
                        <h3 class="media-heading">Healthcare</h3>
                        <p>Learn more about the healthcare coverage that is available for Blue-Team employees, retirees and your families.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-6">
                <div class="media">
                    <div class="media-body">
                        <h3 class="media-heading">Career Development</h3>
                        <p>Take your career to the next level with our personal and professional development goals.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php include './includes/footer.php'; ?>