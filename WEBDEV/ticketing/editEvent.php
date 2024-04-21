<?php require('layout/layout_top.php') ?>

<div class="container-lg my-5 pt-5 px-md-5">
        <div class="card pb-5">
            <div class="card-header">
                <h1>Edit Event</h1>
            </div>
            <form action="./?formSubmit=true" method="post" enctype="multipart/form-data" class="m-auto pt-5">
                    <input type="hidden" name="event_id" value="<?php echo $data['event_id'] ?>">
                <div class="mb-3">
                    <label class="form-label">Title</label>
                    <input type="text" name="title" id="title" class="form-control" value="<?php echo $data['title'] ?>" required>
                </div>
                <div class="mx-md-3">
                    <p name="titleStatus" id="titleStatus" style="display: none; color: red;" class="text-start">Title is already taken!</p>
                </div>
                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea name="description" rows="4" cols="50" class="form-control" style="resize: none;" required><?php echo $data['description']?></textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Venue</label>
                    <input type="text" name="venue" class="form-control" value="<?php echo $data['venue'] ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Start Date</label>
                    <input type="date" name="start_date" class="form-control" value="<?php echo $data['start_date'] ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">End Date</label>
                    <input type="date" name="end_date" class="form-control" value="<?php echo $data['end_date'] ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Sell From Date</label>
                    <input type="date" name="sell_from" class="form-control" value="<?php echo $data['sell_from_date'] ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Sell Until Date</label>
                    <input type="date" name="sell_until" class="form-control" value="<?php echo $data['sell_until_date'] ?>" required>
                </div>
                <span class="lead">Media</span>
                <div class="mb-3">
                    <label for="formFile" class="form-label">Poster</label>
                    <input class="form-control" type="file" name="poster" id="formFile" accept="image/*">
                </div>
                <div class="mb-3 text-center">
                    <img src="<?php echo $data['poster_path'] ?>" alt="" class="image-fluid" style="height: 100%; width: 200px">
                </div>
                <div class="mb-3">
                    <label for="formFile" class="form-label">Thumbnail</label>
                    <input class="form-control" type="file" name="thumbnail" id="formFile" accept="image/*">
                </div>
                <div class="mb-3 text-center">
                    <img src="<?php echo $data['thumbnail_path'] ?>" alt="" class="image-fluid" style="height: 100%; width: 200px">
                </div>
                <div class="mb-3">
                    <label class="form-label">Video Link</label>
                    <input type="url" name="video_link" class="form-control" value="<?php echo $data['video_link'] ?>" required>
                </div>
                <span class="lead">Edit Ticket Types</span>
                <div class="card mb-3" id="edit_tickets">
                        
                </div>

                <span class="lead ">Add Ticket Types</span>
                <div id="type_fields" class="card">
                    <div class='mb-3'>
                        <label class='form-label'>Type</label>
                        <input type='text' name='ticket_type[0]' class='form-control'>
                    </div>
                    <div class='mb-3'>
                        <label class='form-label'>Price</label>
                        <input type='number' name='ticket_price[0]' class='form-control'>
                    </div>
                    <div class='mb-3'>
                        <label class='form-label'>Quantity</label>
                        <input type='number' name='ticket_quant[0]' class='form-control'>
                    </div>
                </div>
                <button class="btn btn-secondary w-100 my-2" type="button" onclick="addTypeField()">Add Type</button>

                <button type="submit" name="edit-Event" class="btn btn-primary w-100">Submit</button>
                <div class="mb-3">
                    <a class='btn btn-danger w-100 mt-2' href='organizerDashboard.php'>Cancel</a>
                </div>
            </form>
        </div>
    </div>

<script>
    var ticketData = <?php echo json_encode($data2); ?>;
</script>
<script src="js/editEvent.js"></script>    

<?php require('layout/layout_bot.php') ?>