<?php require('layout/layout_top.php') ?>
<link rel="stylesheet" href="assets/css/organizerDashboard.css">

<section class="dashboardContainer">
    <div class="container-lg mt-5 py-5">
        <div class="container px-md-5 py-4 elementContainer">
        <div class="row align-items-center">
            <div class="col-12 col-md-8">
                <h1 class="text-center text-md-start">Welcome<br>Organizer<br><?php echo $_SESSION['username'] ?>!</h1>
            </div>
            <div class="col-12 col-md-4">
                <div class="container p-3 overflow-auto elementContainer" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);">
                    <h3 class="text-center">View Orders</h3>
                    <a href="orders.php" style="text-decoration: none; color: white"><button class="btn btn-lg btn-primary w-100">Orders</button></a>
                </div>
            </div>
        </div>
        </div>
        <div class="container my-3 w-100" style="--bs-gutter-x: 0rem;">
            <div class="row g-10 align-items-start">
                <div class="col-12 col-md-7 overflow-auto">
                    <div class="container p-3 elementContainer" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);">
                            <div class="d-flex justify-content-between align-items-center flex-wrap">
                                <h1>Active Events</h1>
                                <a href="addEvent.php"><button class="btn btn-lg btn-primary">Add Event</button></a>
                            </div>
                            <div class="row mt-3 px-3">
                            <?php
                                $dataActiveFiltered = array_filter($data, function($item) {
                                    return $item['approval'] == 'approved' && $item['status'] != 'ended' && ($item['status'] == 'selling' || $item['status'] == 'upcoming');
                                });
                                // Paginate the data array
                                $perPage = 5;
                                $totalItems = count($dataActiveFiltered);
                                $totalPages = ceil($totalItems / $perPage);
                                $page = isset($_GET['page']) ? max(1, min($_GET['page'], $totalPages)) : 1;
                                $start = ($page - 1) * $perPage;
                                $itemsToShow = array_slice($dataActiveFiltered, $start, $perPage);

                                // Display the items
                                foreach ($itemsToShow as $item) {
                                    if ($item['approval'] == 'approved' && $item['status'] != 'ended') {
                            ?>
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
                                <?php
                                    }
                                }

                                // Pagination navigation
                                ?>
                                <nav aria-label="Page navigation">
                                    <ul class="pagination justify-content-center">
                                        <li class="page-item <?php echo $page <= 1 ? 'disabled' : '' ?>">
                                            <a class="page-link" href="?page=<?php echo $page - 1 ?>" aria-label="Previous">
                                                <span aria-hidden="true">&laquo;</span>
                                            </a>
                                        </li>
                                        <?php for ($i = 1; $i <= $totalPages; $i++) { ?>
                                            <li class="page-item <?php echo $i == $page ? 'active' : '' ?>"><a class="page-link" href="?page=<?php echo $i ?>"><?php echo $i ?></a></li>
                                        <?php } ?>
                                        <li class="page-item <?php echo $page >= $totalPages ? 'disabled' : '' ?>">
                                            <a class="page-link" href="?page=<?php echo $page + 1 ?>" aria-label="Next">
                                                <span aria-hidden="true">&raquo;</span>
                                            </a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                    </div>
                    <div class="container mt-3 mb-2 mb-md-3 p-3 overflow-auto elementContainer" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);">
                        <h1>Archives</h1>
                        <div class="row mt-3 px-3">
                        <?php
                            $dataArchiveFiltered = array_filter($data, function($item) {
                                return $item['status'] == 'ended';
                            });
                            $perPageArchive = 5;
                            $totalItemsArchive = count($dataArchiveFiltered);
                            $totalPagesArchive = max(1, ceil($totalItemsArchive / $perPageArchive));
                            $pageArchive = isset($_GET['page_archive']) ? max(1, min($_GET['page_archive'], $totalPagesArchive)) : 1;
                            $startArchive = ($pageArchive - 1) * $perPageArchive;
                            $itemsToShowArchive = array_slice($dataArchiveFiltered, $startArchive, $perPageArchive);

                            foreach ($itemsToShowArchive as $item) {
                                if ($item['status'] == 'ended') {
                            ?>
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
                                                    <li class="list-group-item">Sell Until: <?php echo $item['sell_from_date'] ?></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php
                                }
                            }
                            ?>
                            <nav aria-label="Page navigation">
                                <ul class="pagination justify-content-center">
                                    <li class="page-item <?php echo $pageArchive <= 1 ? 'disabled' : '' ?>">
                                        <a class="page-link" href="?page_archive=<?php echo $pageArchive - 1 ?>" aria-label="Previous">
                                            <span aria-hidden="true">&laquo;</span>
                                        </a>
                                    </li>
                                    <?php for ($i = 1; $i <= $totalPagesArchive; $i++) { ?>
                                        <li class="page-item <?php echo $i == $pageArchive ? 'active' : '' ?>"><a class="page-link" href="?page_archive=<?php echo $i ?>"><?php echo $i ?></a></li>
                                    <?php } ?>
                                    <li class="page-item <?php echo $pageArchive >= $totalPagesArchive ? 'disabled' : '' ?>">
                                        <a class="page-link" href="?page_archive=<?php echo $pageArchive + 1 ?>" aria-label="Next">
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
                            <h3>Pending</h3>
                            <ul class="list-group list-group-flushed">
                                <?php 
                                foreach($data as $item) { 
                                    if($item['approval'] == 'pending') {
                                ?>
                                    <li class="list-group-item">
                                        <div class="row">
                                            <?php 
                                                echo "<div class='col-12 col-lg-7'>";
                                                echo "<a href='eventView.php?event_id=".$item['event_id']."'><h5>".$item['title']."</h5></a>"; 
                                                echo "</div>";
                                                echo "<div class='col-12 col-lg-5 text-center'>";
                                                echo "<a href='editEvent.php?event_id=".$item['event_id']."' style='text-decoration: none; color: white' > <button class='btn btn-secondary me-3'>Edit</a><br>";
                                                echo "<a href='#' id='deleteLink".$item['event_id']."' style='text-decoration: none; color: white'> <button class='btn btn-danger' onclick='updateDeleteLink(".$item['event_id'].")' data-bs-toggle='modal' data-bs-target='#deleteModal'>Delete</button></a><br>";
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
                            <h3>Rejected</h3>
                            <ul class="list-group list-group-flushed">
                                <?php 
                                foreach($data as $item) { 
                                    if($item['approval'] == 'rejected') {
                                ?>
                                    <li class="list-group-item">
                                        <div class="row">
                                            <?php 
                                                echo "<div class='col-12 col-lg-7'>";
                                                echo "<a href='eventView.php?event_id=".$item['event_id']."'><h5>".$item['title']."</h5></a>"; 
                                                echo "</div>";
                                                echo "<div class='col-12 col-lg-5 text-center'>";
                                                echo "<a href='editEvent.php?event_id=".$item['event_id']."' style='text-decoration: none; color: white' > <button class='btn btn-secondary me-3'>Edit</a><br>";
                                                echo "<a href='#' id='deleteLink".$item['event_id']."' style='text-decoration: none; color: white'> <button class='btn btn-danger' onclick='updateDeleteLink(".$item['event_id'].")'>Delete</button></a><br>";
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

<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-md-5">
            <div class="modal-body text-center">
                <h3>Are you sure you want to delete this Event?</h3>
                <a id="deleteModalLink" href="#"><button class="btn btn-danger btn-lg mt-5">DELETE</button></a>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="makeEventModal" tabindex="-1" aria-labelledby="makeEventModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-md-5">
            <div class="modal-body text-center">
                <h3>Success</h3>
                <p>Event has been created and submitted for approval.</p>
                <a href="#"><button class="btn btn-danger btn-lg mt-5" data-bs-dismiss="modal">CLOSE</button></a>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editEventModal" tabindex="-1" aria-labelledby="editEventModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-md-5">
            <div class="modal-body text-center">
                <h3>Success</h3>
                <p>Event has been created and edited and submitted for approval.</p>
                <a href="#"><button class="btn btn-danger btn-lg mt-5" data-bs-dismiss="modal">CLOSE</button></a>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="deleteEventModal" tabindex="-1" aria-labelledby="deleteEventModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-md-5">
            <div class="modal-body text-center">
                <h3>Success</h3>
                <p>Event has been deleted.</p>
                <a href="#"><button class="btn btn-danger btn-lg mt-5" data-bs-dismiss="modal">CLOSE</button></a>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="notFoundEventModal" tabindex="-1" aria-labelledby="notFoundEventModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-md-5">
            <div class="modal-body text-center">
                <h3>Error</h3>
                <p>Event not found.</p>
                <a href="#"><button class="btn btn-danger btn-lg mt-5" data-bs-dismiss="modal">CLOSE</button></a>
            </div>
        </div>
    </div>
</div>

<script src="js/organizerDashboard.js"></script>
<?php require('layout/layout_bot.php') ?>