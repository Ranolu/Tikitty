<?php require('layout/layout_top.php') ?>
<link rel="stylesheet" href="assets/css/adminDashboard.css">

<section class="dashboardContainer">
    <div class="container-lg mt-5 py-5">
        <div class="container px-md-5 py-4 elementContainer" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);">
            <div class="row align-items-center">
                <div class="col-12 col-md-8">
                    <h1 class="text-center text-md-start">Welcome<br>Administrator<br><?php echo $_SESSION['username'] ?>!</h1>
                </div>
                <div class="col-12 col-md-4">
                    <div class="container p-3 overflow-auto elementContainer" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);">
                        <h3 class="text-center">View Users</h3>
                        <a href="accountlist.php" style="text-decoration: none; color: white"><button class="btn btn-lg btn-primary w-100">Users</button></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="container my-3 w-100" style="--bs-gutter-x: 0rem;">
        <div class="row g-10 align-items-start">
            <div class="col-12 col-md-7 overflow-auto">
                <div class="container mb-2 mb-md-3 p-3 overflow-auto elementContainer" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);">
                    <div class="d-flex justify-content-between align-items-center flex-wrap">
                        <h1>Active Events</h1>
                    </div>
                    <div class="row mt-3 px-3">
                    <?php
                        // Filter data array
                        $filteredData = array_filter($data, function($item) {
                            return $item['approval'] == 'approved' && $item['status'] != 'ended' && $item['status'] != 'sold_out';
                        });

                        // Paginate the filtered data array
                        $perPage = 5;
                        $totalItems = count($filteredData);
                        $totalPages = ceil($totalItems / $perPage);
                        $page = isset($_GET['page']) ? max(1, min($_GET['page'], $totalPages)) : 1;
                        $start = ($page - 1) * $perPage;
                        $itemsToShow = array_slice($filteredData, $start, $perPage);
                        ?>
                        <!-- Display the items -->
                        <?php foreach ($itemsToShow as $item): ?>
                        <div class="card mb-3 col-12 px-0" style="max-width: 100%;">
                            <div class="row g-0 overflow-auto">
                                <div class="col-md-4 align-items-center overflow-hidden">
                                    <img src="<?php echo $item['thumbnail_path'] ?>" class="img-fluid rounded-start" style="width: 100%; height: 100%; object-fit: cover;" alt="...">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h5 class="card-title"><a href="eventView.php?event_id=<?php echo $item['event_id']; ?>"><?php echo $item['title']; ?></a></h5>
                                        <p class="card-text"><?php echo $item['status'] ?></p>
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item">Sell Start: <?php echo $item['sell_from_date'] ?></li>
                                            <li class="list-group-item">Sell Until: <?php echo $item['sell_until_date'] ?></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>

                        <!-- Pagination navigation -->
                        <nav aria-label="Page navigation">
                        <ul class="pagination justify-content-center">
                            <li class="page-item <?php echo $page <= 1 ? 'disabled' : '' ?>">
                                <a class="page-link" href="?page=<?php echo $page - 1 ?>" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                </a>
                            </li>
                            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                                <li class="page-item <?php echo $i == $page ? 'active' : '' ?>"><a class="page-link" href="?page=<?php echo $i ?>"><?php echo $i ?></a></li>
                            <?php endfor; ?>
                            <li class="page-item <?php echo $page >= $totalPages ? 'disabled' : '' ?>">
                                <a class="page-link" href="?page=<?php echo $page + 1 ?>" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                </a>
                            </li>
                        </ul>
                        </nav>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-5 mt-1 mt-md-0">
                <div class="container" style="--bs-gutter-x: 0rem;">
                    <div class="container p-3 overflow-auto elementContainer" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2); max-height: 600px;">
                        <h3>Pending Approval</h3>
                        <ul class="list-group list-group-flushed">
                            <?php 
                            foreach($data as $item) { 
                                if($item['approval'] == 'pending') {
                            ?>
                                <li class="list-group-item">
                                    <div class="row">
                                        <?php 
                                            echo "<div class='col-12 col-lg-8 d-flex align-items-center'>";
                                            echo "<h5>".$item['title']."</h5>"; 
                                            echo "</div>";
                                            echo "<div class='col-12 col-lg-4 text-center'>";
                                            echo "<a href='eventView.php?event_id=".$item['event_id']."' style='text-decoration: none; color: white' > <button class='btn btn-success me-3'>View Event</a><br>";
                                            echo "</div>";
                                        ?>
                                    </div>
                                </li>
                            <?php
                                }    
                            } 
                            ?>
                        </ul>
                            
                    </div>
                    <div class="container mt-3 p-3 overflow-auto elementContainer" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2); max-height: 600px;">
                            <h3>Archives</h3>
                            <ul class="list-group list-group-flushed">
                            <?php 
                            foreach($data as $item) { 
                                if($item['approval'] == 'approved' && $item['status'] == 'ended') {
                            ?>
                                <li class="list-group-item">
                                    <div class="row">
                                        <?php 
                                            echo "<div class='col-12 col-lg-8 d-flex align-items-center'>";
                                            echo "<h5>".$item['title']."</h5>"; 
                                            echo "</div>";
                                            echo "<div class='col-12 col-lg-4 text-center'>";
                                            echo "<a href='eventView.php?event_id=".$item['event_id']."' style='text-decoration: none; color: white' > <button class='btn btn-success me-3'>View Event</a><br>";
                                            echo "</div>";
                                        ?>
                                    </div>
                                </li>
                            <?php
                                }    
                            } 
                            ?>
                            </ul>
                        </div>
                </div>
            </div>
        </div>
        </div>
    </div>
</section>

<div class="modal fade" id="approveEventModal" tabindex="-1" aria-labelledby="approveEventModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-md-5">
            <div class="modal-body text-center">
                <h3>Success</h3>
                <p>Event has been Approved.</p>
                <a href="#"><button class="btn btn-danger btn-lg mt-5" data-bs-dismiss="modal">CLOSE</button></a>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="rejectEventModal" tabindex="-1" aria-labelledby="rejectEventModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-md-5">
            <div class="modal-body text-center">
                <h3>Success</h3>
                <p>Event has been Rejected.</p>
                <a href="#"><button class="btn btn-danger btn-lg mt-5" data-bs-dismiss="modal">CLOSE</button></a>
            </div>
        </div>
    </div>
</div>

<script src="js/adminDashboard.js"></script>
<?php require('layout/layout_bot.php') ?>