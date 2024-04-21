<?php require('layout/layout_top.php')?>
<link rel="stylesheet" href="assets/css/transaction.css">
<section class="mt-5 pt-3 transactionContainer">
    <main class="container ">
        <div class="card mx-auto my-5 d-flex flex-wrap overflow-auto">
            <h5 class="card-header d-flex justify-content-between align-items-center">
                Transaction History
            </h5>
            <table class="table">
                <thead>
                    <tr>
                        <th>Event Name</th>
                        <th>Ticket Type</th>
                        <th>Quantity</th>
                        <th>Price</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data as $order) : ?>
                        <tr>
                            <td>
                                <?php foreach ($data2 as $event) {
                                    if ($event['event_id'] == $order['event_id']) {
                                        echo $event['title'];
                                    }
                                } ?>
                            </td>
                            <td>
                                <?php foreach ($data3 as $ticket) {
                                    if ($ticket['ticket_id'] == $order['ticket_id']) {
                                        echo $ticket['type'];
                                    }
                                } ?>
                            </td>
                            <td><?php echo $order['buy_quant']; ?></td>
                            <td><?php echo $order['total_price']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </main>
</section>
    

<?php require('layout/layout_bot.php')?>