<?php require('layout/layout_top.php')?>
<link rel="stylesheet" href="assets/css/eventlist.css">
<section class="eventlistContainer pb-5">
    <section class="mt-5 pt-5 mb-4 pb-4 px-mb-5">
        <div class="container">
            <?php
                if (!empty($data)) {
                    $eventsPerPage = 5;
                    $page = isset($_GET['page']) ? $_GET['page'] : 1;
                    $start = ($page - 1) * $eventsPerPage;
                    $selling_events = [];
                    $other_events = [];

                    foreach ($data as $events) {
                        if ($events['approval'] == 'approved' && ($events['status'] == 'selling' || $events['status'] == 'upcoming')) {
                            $selling_events[] = $events;
                        } elseif ($events['approval'] == 'approved' && ($events['status'] == 'ended' || $events['status'] == 'sold_out')) {
                            $other_events[] = $events;
                        }
                    }
                    $total_events = array_merge($selling_events, $other_events);
                    $totalPages = ceil(count($total_events) / $eventsPerPage);
                    $events_to_display = array_slice($total_events, $start, $eventsPerPage);
                    $selling_events = array_filter($events_to_display, function ($event) {
                        return $event['status'] == 'selling' || $event['status'] == 'upcoming';
                    });
                    $other_events = array_filter($events_to_display, function ($event) {
                        return $event['status'] == 'ended' || $event['status'] == 'sold_out';
                    });
                    function displayEvents($events)
                    {
                        foreach ($events as $event) {
                            echo "
                                <a href='eventView.php?event_id=" . $event['event_id'] . "' style='text-decoration: none; color: black;'>
                                    <div class='container p-3 mt-3' style='box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2); width: 100%; background-color: white;'>
                                        <div class='d-flex align-items-center'>
                                            <div class='d-none d-sm-block overflow-hidden' style='width: 300px; height: 300px;'>
                                                <img src='" . $event['thumbnail_path'] . "' style='overflow: hidden; width: 100%; height: 100%; object-fit: cover; object-position: center;' alt='Event Thumbnail'>
                                            </div>
                                            <div class='px-3 py-2' style='max-height: 100%'>
                                                <div class='p-2 flex-grow-1'><h2>Event Name: " . $event['title'] . "</h2></div>
                                                <div class='p-2 flex-grow-1'>Status: " . $event['status'] . "</div>
                                                <div class='p-2 flex-grow-1'>Start Date: " . $event['start_date'] . "</div>
                                                <div class='p-2 flex-grow-1'>End Date: " . $event['end_date'] . "</div>
                                                <div class='p-2 flex-grow-1'>Venue: " . $event['venue'] . "</div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            ";
                        }
                    }
                    displayEvents($selling_events);
                    displayEvents($other_events);
                    echo "<div class='pagination-container text-center mt-5'>";
                    echo "<ul class='pagination justify-content-center'>";
                    if ($page > 1) {
                        echo "<li class='page-item'><a class='page-link' href='?page=" . ($page - 1) . "'>Previous</a></li>";
                    }
                    for ($i = 1; $i <= $totalPages; $i++) {
                        echo "<li class='page-item'><a class='page-link' href='?page=" . $i . "'>" . $i . "</a></li>";
                    }
                    if ($page < $totalPages) {
                        echo "<li class='page-item'><a class='page-link' href='?page=" . ($page + 1) . "'>Next</a></li>";
                    }
                    echo "</ul>";
                    echo "</div>";
                } else {
                    echo "<div class='container p-3 mt-3 text-center align-content-center' style='box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2); width: 100%; min-height: 400px;'><h3>No event of that name</h3></div>";
                }
            ?>
        </div>
    </section>
</section>

    
<?php require('layout/layout_bot.php')?>