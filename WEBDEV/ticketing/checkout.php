<?php require('layout/layout_top.php')?>
<link rel="stylesheet" href="assets/css/checkout.css">
<section class="checkoutContainer pb-5">
<section class="mt-5 pt-5 pt-md-0">
    <header class="d-flex px-md-5 pt-md-5 align-items-start justify-content-center text-center">
        <div class="p-md-5" style="color: white">
            <div id="timer"></div>
            <h2><?php echo $data['start_date']." - ".$data['end_date'] ?></h2>
            <h1 class="py-2 display-3"><?php echo $data['title']?></h1>
            <h3><?php echo $data['venue'] ?></h3>
            <h3><?php echo $data4['name']?></h3>
        </div>
        
    </header>

    <main class="container my-5">
        <section class="row text-center mx-auto">
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
                        <p class='card-text lead'>".$ticket['price']."</p> 
                    </div>
                </div>
                </div>";
            }
            ?>
        </section>
    </main>

    <section class="container px-md-5 mb-5">
    <div class="card p-5 mx-auto" style="width: 100%;">
        <h3 class="text-primary text-center">Your Order</h3>
        <div class="row">
            <div class="col-12 col-md-6">
            <div>
                <label for="ticket_id"><h3>Ticket Type</h3></label>
                <select name="ticket_id" id="ticket_id" class="form-control">
                    <option value=""> Select Ticket </option>
                    <?php foreach ($data2 as $ticket) { 
                            if($ticket['status'] != '0') {?>
                        <option value="<?php echo $ticket['ticket_id']; ?>">
                            <?php echo $ticket['type']; ?>
                        </option>
                    <?php }} ?>
                </select>
            </div>
            <div>
                <h3>Quantity: <input type="number" name="buy_quantity" id="buy_quantity" class="form-control"></h3>
            </div>
            </div>
            <div class="col-12 col-md-6">
                <h3 class="text-primary text-center">Total Price: </h3><br> 
                <h3 class="text-center"><span id="total_price"></span></h3>
            </div>
            <div class="card-footer text-center">
                <button type='button' id="checkout_button" class='btn btn-success btn-lg' data-bs-toggle='modal' data-bs-target='#check_outModal'>
                    Check Out
                </button>
            </div>
        </div>
    </div>
    </section>

    
</section>
    <article>
        <div id="agreement" class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Ticket Purchase Agreement</h5>
                    </div>
                    <div class="modal-body">
                        <strong class="text-danger">WARNING! DO NOT OPEN MULTIPLE BROWSER TABS. Doing so will result in errors. Stick to this window until the end of your transaction.</strong>
                        <p>Before you proceed:</p>
                        <ol>
                            <li>Do you agree that <strong>ALL SALES ARE FINAL</strong> and will not be able to get a refund nor exchange your tickets, unless the event was cancelled or postponed?</li>
                            <li>Do you also agree to Tikitty's Terms of Use and Privacy Policy?</li>
                        </ol>
                    </div>
                    <div class="modal-footer text-center m-3">
                        <a href="eventView.php?event_id=<?php echo $_GET['event_id']?>" class="btn btn-secondary">I DON'T AGREE</a>
                        <a href="" class="btn btn-primary" data-bs-dismiss="modal">I AGREE</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="check_outModal" tabindex="-1" aria-labelledby="check_outModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        <h2>Confirm Order Details</h2>
                        <form action="./?formSubmit=true" method="post" id="order_form">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" class="form-control" value="<?php echo $data5['email']?>" readonly required>
                            <input type="hidden" name="event_id" id="event_id" value="<?php echo $_GET['event_id']?>" required>
                            <input type="hidden" name="event_name" id="event_name" value="<?php echo $data['title']?>" required>
                            <input type="hidden" name="ticket_id" id="ticket_id_modal" required>
                            <label for="ticket_type">Ticket</label>
                            <input type="text" name="ticket_type" id="ticket_type" class="form-control" readonly required>
                            <label for="buy_quant">Quantity</label>
                            <input type="number" name="buy_quant" id="buy_quant" class="form-control" min='1' readonly required>
                            <label for="total_price">Total Price</label>
                            <input type="number" name="total_price" id="total_price_modal" class="form-control" step="0.01" readonly required> 
                            <div class="text-center mt-3">
                                <input type="hidden" name="user-order" required>
                                <button type="submit" class="text-center btn btn-lg btn-success" name="user-order">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </article>
</section>


<script>
    var eventId = "<?php echo isset($_GET['event_id']) ? $_GET['event_id'] : ''; ?>";
</script>
<script src="js/checkout.js"></script>
<?php require('layout/layout_bot.php')?>