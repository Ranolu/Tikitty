<?php require('layout/layout_top.php') ?>
<link rel="stylesheet" href="assets/css/index.css">
<!-- Dito Index Code -->
<section id="intro">
    <div class="container-fluid  mt-5 pt-4">
        <div class="row justify-content-center align-items-center">
            <div class="col-md-5 text-center text-md-start">
                <h1>
                    <div class="display-1 fw-bold">TiKitty</div>
                    <div class="display-5">Your online ticket provider</div>
                </h1>
                <a href="#events" class="btn btn-primary btn-lg mt-5">Browse Events</a>
            </div>
            <div class="col-md-5 text-center d-none d-md-block">
                <img class="img-fluid bigLogo" src="assets/images/intro.png" alt="lol">
            </div>
        </div>
    </div>
</section>

<section id="events">
    <div class="contianer-lg overflow-hidden">
        <div class="text-center" id="event-container">
            <h2>Events</h2>
        </div>
        <div class="overflow-auto row g-3 mt-2 pb-2 mx-2 flex-nowrap scrollContainer">
        <?php foreach($data as $event){ 
                if($event['status'] == 'selling' && $event['status'] != 'sold_out') {
            ?>
            <div class="col-sm-6 col-md-5 col-lg-3">
                <div class="card border-0 shadow" style="z-index: 1;">
                <div class="card-img-top aspect-ratio-1x1" style="height: 300px">
                        <img class="card-img-top aspect-ratio-1x1" style="height: 100%; width: 100%; object-fit: cover; object-position: center; " src="<?php echo $event['thumbnail_path']?>" alt="img here">
                    </div>
                    <div class="card-body text-center py-4" style="height: 250px;">
                        <h4 class="card-title">
                            <?php echo $event['title']?>
                        </h4>
                        <ul class="list-group list-group-flush text-start" style="font-size: 0.7rem;">
                            <li class="list-group-item">Start Date: <?php echo $event['start_date']?></li>
                            <li class="list-group-item">End Date: <?php echo $event['end_date']?></li>
                            <li class="list-group-item">Venue: <?php echo $event['venue']?></li>
                        </ul>                        
                    </div>
                    <div class="card-footer text-center">
                        <a href="eventView.php?event_id=<?php echo $event['event_id'] ?>" class="btn btn-primary">More Info</a>
                    </div>
                </div>
            </div>
        <?php }}?>
        </div>
        
        <div class="text-center m-5">
            <h2>Upcoming</h2>
        </div>
        <div class="overflow-auto row g-3 mt-2 pb-2 mx-2 flex-nowrap scrollContainer">
        <?php foreach($data as $event){ 
                if($event['status'] == 'upcoming') {
            ?>
            <div class="col-sm-6 col-md-5 col-lg-3">
                <div class="card border-0 shadow" style="z-index: 1;">
                    <div class="card-img-top aspect-ratio-1x1" style="height: 300px">
                        <img class="card-img-top aspect-ratio-1x1" style="height: 100%; width: 100%; object-fit: cover; object-position: center; " src="<?php echo $event['thumbnail_path']?>" alt="img here">
                    </div>
                    <div class="card-body text-center py-4" style="height: 250px;">
                        <h4 class="card-title">
                            <?php echo $event['title']?>
                        </h4>
                        <ul class="list-group list-group-flush text-start" style="font-size: 0.7rem;">
                            <li class="list-group-item">Start Date: <?php echo $event['start_date']?></li>
                            <li class="list-group-item">End Date: <?php echo $event['end_date']?></li>
                            <li class="list-group-item">Venue: <?php echo $event['venue']?></li>
                        </ul>                        
                    </div>
                    <div class="card-footer text-center">
                        <a href="eventView.php?event_id=<?php echo $event['event_id'] ?>" class="btn btn-primary">More Info</a>
                    </div>
                </div>
            </div>
        <?php }}?>
        </div>

        <div class="text-center m-5">
            <h2>Ended/Sold Out</h2>
        </div>
        <div class="overflow-auto row g-3 mt-2 pb-2 mx-2 flex-nowrap scrollContainer">
        <?php foreach($data2 as $event){ 
                if($event['status'] == 'ended' || $event['status'] == 'sold_out') {
            ?>
            <div class="col-sm-6 col-md-5 col-lg-3">
                <div class="card border-0 shadow" style="z-index: 1; ">
                    <div class="card-img-top aspect-ratio-1x1" style="height: 300px">
                        <img class="card-img-top aspect-ratio-1x1" style="height: 100%; width: 100%; object-fit: cover; object-position: center; " src="<?php echo $event['thumbnail_path']?>" alt="img here">
                    </div>
                    <div class="card-body text-center py-4" style="height: 250px;">
                        <h4 class="card-title">
                            <?php echo $event['title']?>
                        </h4>
                        <ul class="list-group list-group-flush text-start" style="font-size: 0.7rem;">
                            <li class="list-group-item">Start Date: <?php echo $event['start_date']?></li>
                            <li class="list-group-item">End Date: <?php echo $event['end_date']?></li>
                            <li class="list-group-item">Venue: <?php echo $event['venue']?></li>
                        </ul>                        
                        
                    </div>
                    <div class="card-footer text-center">
                        <a href="eventView.php?event_id=<?php echo $event['event_id'] ?>" class="btn btn-primary">More Info</a>
                    </div>
                </div>
            </div>
        <?php }}?>
        </div>
    </div>
</section>

<section id="partnership">
    <div class="container-fluid  mt-2 py-2">
        <div class="row justify-content-center align-items-center">
            <div class="col-md-5 text-center d-none d-md-block">
                <img class="img-fluid bigLogo" src="assets/images/partnerships.png" alt="lol">
            </div>
            <div class="col-md-5 text-center text-md-end">
                <h2>
                    <div class="display-3">Partnerships</div>
                    <div class="display-5">Become one of our partners</div>
                </h2>
                <p class="lead my-4">Join us to host your own ticket shop online</p>
                <a href="partnership.php" class="btn btn-primary btn-lg">More Info</a>
            </div>
        </div>
    </div>
</section>

<div class="modal fade" id="sessionExpiredModal" tabindex="-1" aria-labelledby="sessionExpiredModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-md-5">
            <div class="modal-body text-center">
                <h3>Your Session has expired</h3>
                <p>Please login again</p>
                <a href="#"><button class="btn btn-danger btn-lg mt-5" data-bs-toggle="modal" data-bs-target="#loginModal">LOGIN</button></a>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="makeuserModal" tabindex="-1" aria-labelledby="makeuserModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-md-5">
            <div class="modal-body text-center">
                <h3>Success</h3>
                <p>Your account has been created.</p>
                <a href="#"><button class="btn btn-danger btn-lg mt-5" data-bs-toggle="modal" data-bs-target="#loginModal">LOGIN</button></a>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="loginFailModal" tabindex="-1" aria-labelledby="loginFailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-md-5">
            <div class="modal-body text-center">
                <h3>Error</h3>
                <p>Incorrect Username or Password.</p>
                <a href="#"><button class="btn btn-danger btn-lg mt-5" data-bs-toggle="modal" data-bs-target="#loginModal">RETRY</button></a>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="orderModal" tabindex="-1" aria-labelledby="orderModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-md-5">
            <div class="modal-body text-center">
                <h3>Success</h3>
                <p>Your order has been confirmed. <br> A receipt letter will be sent to your inbox.</p>
                <button type="button" class="btn btn-primary btn-lg mt-5" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script src="js/index.js"></script>
<?php require('layout/layout_bot.php') ?>