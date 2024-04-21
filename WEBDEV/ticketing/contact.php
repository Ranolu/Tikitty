<?php require('layout/layout_top.php')?>
<link rel="stylesheet" href="assets/css/contact.css">

<section class="contact mt-5 pt-3 px-0 px-md-5">
        <div class="contact_container px-1 px-md-5 py-5">
            <br>
            <h1>Contact Us</h1>
            <div class="contact-wrapper">
                <div class="contact-form">
                <h3 class="text-center">Send us a message</h3>
                <form action="./?formSubmit=true" method="post">
                    <div class="form-group">
                        <input type="email" name="email" placeholder="Your email" class="form-control">
                    </div>
                        <input type="hidden" name="subject" value="Inquiry">
                    <div class="form-group">
                        <textarea name="message" placeholder="Your Message" class="form-control"></textarea>
                    </div>
                    <div class="text-center">
                        <button type="submit" name="contact-us" class="btn btn-primary text-center">Send Message</button>
                    </div>
                </form>
            </div>
            <div class="contact-info px-md-5">
                <h3 class="text-center">Contact Information</h3>
                <p><i class="fas fa-phone"></i> +639282264535</p>
                <p><i class="fas fa-envelope"></i> ti-kitty@gmail.com</p>
                <p><i class="fas fa-map-marker-alt"></i> Science City of Munoz, Philippines</p>
            </div>
        </div>
    </div>
</section>

<div class="modal fade" id="contactSuccessModal" tabindex="-1" aria-labelledby="contactSuccessModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-md-5">
            <div class="modal-body text-center">
                <h3>Success</h3>
                <p>Inquiry has been sent.</p>
                <a href="#"><button class="btn btn-danger btn-lg mt-5" data-bs-dismiss="modal">CLOSE</button></a>
            </div>
        </div>
    </div>
</div>

<?php require('layout/layout_bot.php')?>