<?php require('layout/layout_top.php') ?>
<link rel="stylesheet" href="assets/css/eventView.css">
<?php
function getYoutubeVideoId($url) {
    $query_params = [];
    parse_str(parse_url($url, PHP_URL_QUERY), $query_params);

    if (isset($query_params['v'])) {
        return $query_params['v'];
    } elseif (preg_match('/(?:https?:\/\/)?(?:www\.)?youtu\.be\/([^"&?\/ ]{11})/i', $url, $matches)) {
        return $matches[1];
    } else {
        return ''; 
    }
}

$youtube_url = $data['video_link'];
$video_id = getYoutubeVideoId($youtube_url);
$embed_code = '<iframe class="embed-responsive-item" src="https://www.youtube.com/embed/' . $video_id . '" allowfullscreen></iframe>';
?>
<section class="eventViewContainer p-md-5 pb-5">
<section class="container mt-5 pt-5 pt-md-0 ">
    <header class="d-flex p-md-5 mb-5 align-items-center justify-content-center text-center">
        <div class="pt-md-5" style="color: white">
            <h2><?php echo $data['start_date']." - ".$data['end_date'] ?></h2>
            <h1 class="py-2 display-3"><?php echo $data['title']?></h1>
            <h3><?php echo $data['venue'] ?></h3>
            <h3><?php echo $data4['name']?></h3>
        </div>
    </header>
    <article class="card m-auto p-3 mb-5">
        <h5 class="lead d-flex justify-content-between align-items-center">
            Description
        </h5>
        <p class="mx-5"><?php echo $data['description']?></p>
    </article>
    <main class="container">
        <div class="row">
            <div class="col-12 col-md-6">
                <div class="card m-2">
                    <img src="<?php echo $data['poster_path']?>" alt="poster" class="card-img img-fluid">
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="card m-2">
                    <img src="<?php echo $data['thumbnail_path']?>" alt="thumbnail" class="card-img">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-6">
            <div class="card m-2">
                <div class="card-body d-flex align-items-center justify-content-center overflow-hidden">
                    <div class="embed-responsive embed-responsive-16by9">
                        <?php echo $embed_code ?>
                    </div>
                </div>
            </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="card m-2">
                    <h5 class="card-header d-flex justify-content-between align-items-center">
                        Tickets
                    </h5>
                    <ul class="list-group list-group-flush">
                        <?php foreach ($data2 as $ticket) {
                            echo "
                            <li class='list-group-item'>
                            <div class='row g-0'>
                                <div class='col-md-8'>
                                    <div class='card-body p-0'>
                                    <h5 class='card-title'>".$ticket['type']."</h5>
                                    <p class='card-subtitle'>".$ticket['price']."</p>
                                    </div>
                                    
                                </div>
                            </div>
                            </li>";
                        }
                        ?>
                    </ul>
                    <?php if (!isset($_SESSION['role'])) { ?>
                            <?php if($data['status'] == 'ended' || $data['status'] == 'sold_out' || $data['status'] == 'upcoming' || $data4['name'] == 'Organizer Deleted') {    
                        ?>
                        <div class='card-footer text-body-secondary text-center'>
                                <button class='btn btn-primary btn-lg' disabled>Unavailable</button>
                        </div>
                        <?php   } else { ?>
                        <div class='card-footer text-body-secondary text-center'>
                                <button class='btn btn-primary btn-lg' data-bs-toggle="modal" data-bs-target="#loginModal" >BUY NOW</button>
                        </div>
                        <?php    } ?>
                    <?php } else if ($_SESSION['role'] == '3') { 
                            if($data['status'] == 'ended' || $data['status'] == 'sold_out' || $data['status'] == 'upcoming' || $data4['name'] == 'Organizer Deleted') {    
                    ?>
                            <div class='card-footer text-body-secondary text-center'>
                                <button class='btn btn-primary btn-lg' disabled>Unavailable</button>
                            </div>
                    <?php   } else { ?>
                            <div class='card-footer text-body-secondary text-center'>
                                <a href="checkout.php?event_id=<?php echo $data['event_id'] ?>"><button class='btn btn-primary btn-lg'>BUY NOW</button></a>
                            </div>
                    <?php    }
                        } ?>
                </div>
            </div>
        </div>
        <?php if(isset($_SESSION['role']) && $_SESSION['role'] == '1') {
                if($data['approval'] != 'approved') {?>
            <div class="d-flex flex-wrap text-center w-100 align-items-center justify-content-evenly mx-auto">
                <div class="w-100">
                    <a href="./?formSubmit=true&event_id=<?php echo $data['event_id']?>&eventApprove=true"><button class='btn btn-success my-3 my-sm-4 w-100 py-4' >Approve</button></a>
                </div>
                <div class="w-100">
                    <a href="#"><button class='btn btn-danger mb-3 mt-sm-0 mb-sm-4 w-100 py-4' data-bs-toggle="modal" data-bs-target="#rejectModal">Reject</button></a>
                </div>
            </div>
        <?php }} ?>
        <?php if(isset($_SESSION['role']) && $_SESSION['role'] == '2') { ?>
            <div class="container my-5 py-3 px-md-3 w-100">
                <h3 class="text-center" style="color: white;">Statistics</h3>
                <div class="row">
                    <?php foreach($data2 as $ticket) {
                        if($ticket['status'] != 0) {
                            $status = 'Available';
                        } else { $status = 'Sold Out'; }
                        echo "
                        <div class='col-12 col-sm-12 col-md-4 mx-auto'>
                        <div class='card m-2'>
                            <div class='card-header'>".$status."</div>
                            <div class='card-body'>
                                <h5 class='card-title'>".$ticket['type']."</h5>
                                <p class='card-text lead'>Price: ".$ticket['price']."</p> 
                                <p class='card-text lead'>Remaining Quantity: ".$ticket['quantity']."</p> 
                                <p class='card-text lead'>Amount Sold: ".$ticket['sold']."</p> 
                                <p class='card-text lead'>Earnings: ".$ticket['earnings']."</p>
                            </div>
                        </div>
                </div>";
                    } ?>
                </div>
                <div class="container p-3 overflow-auto mt-3" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2); background-color: white; border-radius: 5px;">
                    <h3 class="text-center">View Orders</h3>
                    <a href="orders.php?event_id=<?php echo $data['event_id']?>" style="text-decoration: none; color: white"><button class="btn btn-lg btn-primary w-100">Orders</button></a>
                </div>
            </div>
        <?php } ?>
    </main>
</section>
</section>


<div class="modal fade" id="rejectModal" tabindex="-1" aria-labelledby="rejectModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="rejectModalLabel">Rejection Form</h5>
        </div>
        <div class="modal-body">
            <form action="./?formSubmit=true&event_id=<?php echo $data['event_id']?>&eventApprove=false" method="post">
            <div class="mb-3">
                <label for="rejectMessage" class="form-label">Reason for Rejection of Approval</label>
                <textarea class="form-control" id="rejectMessage" name="message" rows="4" required></textarea>
                <input type="hidden" name="subject" value="Your Event Application has been rejected">
                <input type="hidden" name="email" value="<?php echo $data4['email'] ?>">
                <input type="hidden" name="event_name" value="<? echo $data['title'] ?>">
                <div class="text-center">
                    <button type="submit" class="btn btn-danger mt-3" name="rejectionLetter">Submit</button>
                </div>
            </div>
            </form>
        </div>
        </div>
    </div>
</div>
<?php require('layout/layout_bot.php') ?>