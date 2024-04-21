<?php require('layout/layout_top.php') ?>

<div class="container-lg my-5 pt-5 px-md-5">
        <div class="card pb-5">
            <div class="card-header">
                <h1>Add Event</h1>
            </div>
            <form action="./?formSubmit=true" method="post" enctype="multipart/form-data" class="m-auto pt-5">
                <div class="mb-3">
                    <label class="form-label">Title</label>
                    <input type="text" name="title" id="title" class="form-control" required>
                </div>
                <div class="mx-md-3">
                    <p name="titleStatus" id="titleStatus" style="display: none; color: red;" class="text-start">Title is already taken!</p>
                </div>
                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea name="description" rows="4" cols="50" class="form-control" style="resize: none;" required></textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Venue</label>
                    <input type="text" name="venue" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Start Date</label>
                    <input type="date" name="start_date" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">End Date</label>
                    <input type="date" name="end_date" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Sell From Date</label>
                    <input type="date" name="sell_from" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Sell Until Date</label>
                    <input type="date" name="sell_until" class="form-control" required>
                </div>
                <span class="lead">Media</span>
                <div class="mb-3">
                    <label for="formFile" class="form-label">Poster</label>
                    <input class="form-control" type="file" name="poster" id="formFile" accept="image/*" required>
                </div>
                <div class="mb-3">
                    <label for="formFile" class="form-label">Thumbnail</label>
                    <input class="form-control" type="file" name="thumbnail" id="formFile" accept="image/*" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Video Link</label>
                    <input type="url" name="video_link" class="form-control" required>
                </div>
                <span class="lead">Ticket Types</span>

                <div id="type_fields" class="card">
                    <div class='mb-3'>
                        <label class='form-label'>Type</label>
                        <input type='text' name='ticket_type[0]' class='form-control' required>
                    </div>
                    <div class='mb-3'>
                        <label class='form-label'>Price</label>
                        <input type='number' name='ticket_price[0]' class='form-control' required>
                    </div>
                    <div class='mb-3'>
                        <label class='form-label'>Quantity</label>
                        <input type='number' name='ticket_quant[0]' class='form-control' required>
                    </div>
                </div>
                <button class="btn btn-secondary w-100 my-2" type="button" onclick="addTypeField()">Add Type</button>

                <button type="submit" name="add-Event" class="btn btn-primary w-100">Submit</button>
                <div class="mb-3">
                    <a class='btn btn-danger w-100 mt-2' href='organizerDashboard.php'>Cancel</a>
                </div>
            </form>
        </div>
    </div>

<script src="js/addEvent.js"></script>    
<?php require('layout/layout_bot.php') ?>