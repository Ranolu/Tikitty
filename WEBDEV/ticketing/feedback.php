<?php require('layout/layout_top.php')?>
<link rel="stylesheet" href="assets/css/feedback.css">

<section class="mt-5 pt-5 feedbackContainer mb-0"> 
    <div class="container-lg mt-5">
        <?php if(isset($_SESSION['role']) && $_SESSION['role'] != '1' && empty($data)) {?>
        <h1 class="text-center" style="color: white;">Your feedback is important</h1>
        <p class="text-center" style="color: white;">Rate our services</p>
        <form action="feedback.php?formSubmit=true" method="post" class="mb-5">
            <div class="row justify-content-center mb-5">
                <div class="col-auto">
                    <div class="rating">
                        <input type="radio" id="star1" name="rating" value="1" required>
                        <label class="text-center" for="star1">★</label>
                        <input type="radio" id="star2" name="rating" value="2">
                        <label class="text-center" for="star2">★</label>
                        <input type="radio" id="star3" name="rating" value="3">
                        <label class="text-center" for="star3">★</label>
                        <input type="radio" id="star4" name="rating" value="4">
                        <label class="text-center" for="star4">★</label>
                        <input type="radio" id="star5" name="rating" value="5" checked>
                        <label class="text-center" for="star5">★</label>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center mt-4 mb-5">
                <div class="col-md-6">
                    <div class="comment-box">
                        <textarea class="form-control" name="feedback" id="comment" placeholder="Enter your feedback here..." rows="4" maxlength="500" style="resize: none;" required></textarea>
                    </div>
                    <div class="text-center mt-3">
                        <button type="submit" class="btn btn-primary" name="feedbackSubmit">Submit</button>
                    </div>
                </div>
            </div>
        </form>
        <?php } ?>

        <?php if(!empty($data)) {?>
            <h1 class="text-center" style="color: white;">Your Feedback</h1>
            <form action="feedback.php?formSubmit=true" method="post">
                <div class="row justify-content-center">
                    <div class="col-auto">
                        <div class="rating">
                            <input type="radio" id="star1" name="rating" value="1" <?php echo ($data['rate'] == '1') ? 'checked' : ''; ?> required>
                            <label class="text-center" for="star1">★</label>
                            <input type="radio" id="star2" name="rating" value="2" <?php echo ($data['rate'] == '2') ? 'checked' : ''; ?> >
                            <label class="text-center" for="star2">★</label>
                            <input type="radio" id="star3" name="rating" value="3" <?php echo ($data['rate'] == '3') ? 'checked' : ''; ?> >
                            <label class="text-center" for="star3">★</label>
                            <input type="radio" id="star4" name="rating" value="4" <?php echo ($data['rate'] == '4') ? 'checked' : ''; ?> >
                            <label class="text-center" for="star4">★</label>
                            <input type="radio" id="star5" name="rating" value="5" <?php echo ($data['rate'] == '5') ? 'checked' : ''; ?> >
                            <label class="text-center" for="star5">★</label>
                        </div>
                    </div>
                </div>

                <div class="row justify-content-center mt-4 mb-5">
                    <div class="col-md-6">
                        <div class="comment-box">
                            <textarea class="form-control" name="feedback" id="comment" placeholder="Enter your feedback here..." rows="4" maxlength="500" style="resize: none;" required><?php echo $data['feedback']?></textarea>
                        </div>
                        <div class="text-center mt-3">
                            <button type="submit" class="btn btn-primary" name="feedbackEdit">Update</button>
                        </div>
                    </div>
                </div>
            </form>
        <?php }?>

        <h1 class="text-center" style="color: white;">User Feedbacks</h1>
        <div id="feedbacksContainer" class="container px-md-5 mt-5"></div>
        <div class="text-center pb-5">
            <button id="loadMoreBtn" class="btn btn-lg btn-primary" style="display: none;">Show More</button>
        </div>
        
        
    </div>
</section>

<div class="modal fade" id="makeFeedbackModal" tabindex="-1" aria-labelledby="makeFeedbackModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-md-5">
            <div class="modal-body text-center">
                <h3>Success</h3>
                <p>Feedback has been submitted.</p>
                <a href="#"><button class="btn btn-danger btn-lg mt-5" data-bs-dismiss="modal">CLOSE</button></a>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editFeedbackModal" tabindex="-1" aria-labelledby="editFeedbackModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-md-5">
            <div class="modal-body text-center">
                <h3>Success</h3>
                <p>Feedback has been edited.</p>
                <a href="#"><button class="btn btn-danger btn-lg mt-5" data-bs-dismiss="modal">CLOSE</button></a>
            </div>
        </div>
    </div>
</div>
    
<script src="js/feedback.js"></script>
<?php require('layout/layout_bot.php')?>