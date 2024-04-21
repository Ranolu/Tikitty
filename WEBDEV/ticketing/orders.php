<?php require('layout/layout_top.php')?>
<link rel="stylesheet" href="assets/css/orders.css">

<section class="mt-5 pt-3 ordersContainer pb-5">
    <main class="container ">
        <div class="card mx-auto mt-5 mb-3 d-flex flex-wrap overflow-auto p-md-3">
            <h5 class="card-header d-flex justify-content-between align-items-center">
                All Orders
            </h5>
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Buyer Email</th>
                        <th>Event Name</th>
                        <th>Ticket Type</th>
                        <th>Quantity</th>
                        <th>Price</th>
                    </tr>
                </thead>
                <tbody>
            <?php
                $perPage = 10;
                $totalOrders = count($data2); 
                $totalPages = ceil($totalOrders / $perPage); 
                $currentPage = isset($_GET['page']) ? $_GET['page'] : 1; 
                $start = ($currentPage - 1) * $perPage; 
                $end = min($start + $perPage, $totalOrders); 

                for ($i = $start; $i < $end; $i++) {
                    $order = $data2[$i];
                    foreach ($data as $event) {
                        if ($order['event_id'] == $event['event_id']) {
            ?>
                            <tr>
                                <td><?php echo $i + 1; ?></td> 
                                <td>
                                    <?php
                                        foreach ($data4 as $user) {
                                            if ($order['user_id'] == $user['user_id']) {
                                                foreach ($data5 as $profile) {
                                                    if ($user['profile_id'] == $profile['profile_id']) {
                                                        echo $profile['email'];
                                                    }
                                                }
                                            }
                                        }
                                    ?>
                                </td>
                                <td><?php echo $event['title']; ?></td>
                                <td>
                                    <?php
                                        foreach ($data3 as $ticket) {
                                            if ($order['ticket_id'] == $ticket['ticket_id']) {
                                                echo $ticket['type'];
                                            }
                                        }
                                    ?>
                                </td>
                                <td><?php echo $order['buy_quant']; ?></td>
                                <td><?php echo $order['total_price']; ?></td>
                            </tr>
            <?php
                        }
                    }
                }
            ?>
            </tbody>
            </table>
            </div>
            <nav aria-label="Page navigation py-3">
            <ul class="pagination justify-content-center mb-5">
                <?php if ($currentPage > 1) : ?>
                    <li class="page-item">
                        <a class="page-link" href="?page=<?php echo $currentPage - 1; ?>" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                <?php endif; ?>
                <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
                    <li class="page-item <?php echo $currentPage == $i ? 'active' : ''; ?>">
                        <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                    </li>
                <?php endfor; ?>
                <?php if ($currentPage < $totalPages) : ?>
                    <li class="page-item">
                        <a class="page-link" href="?page=<?php echo $currentPage + 1; ?>" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
            </nav>
        
    </main>
</section>

<?php require('layout/layout_bot.php')?>