document.addEventListener('DOMContentLoaded', function() {
    var myModal = new bootstrap.Modal(document.getElementById('agreement'), {});
    myModal.show();

    var countdown = 300;
    var timerDisplay = document.getElementById('timer');
    var countdownInterval = setInterval(function() {
        var minutes = Math.floor(countdown / 60);
        var seconds = countdown % 60;

        timerDisplay.textContent = minutes + ':' + (seconds < 10 ? '0' : '') + seconds;

        if (countdown === 0) {
            clearInterval(countdownInterval);
            window.location.href = "eventView.php" + (eventId ? "?event_id=" + eventId : "");
        } else {
            countdown--;
        }
    }, 1000);

    var ticketSelect = document.getElementById('ticket_id');
    var buyQuantityInput = document.getElementById('buy_quantity');
    var checkoutButton = document.getElementById('checkout_button');

    function handleTicketSelectChange() {
        var ticketId = ticketSelect.value;
        if (ticketId !== '') {
            getMaxQuantity(ticketId);
            buyQuantityInput.removeAttribute('disabled');
            checkoutButton.setAttribute('disabled', 'disabled');
        } else {
            buyQuantityInput.setAttribute('disabled', 'disabled');
            checkoutButton.setAttribute('disabled', 'disabled');
            buyQuantityInput.value = ''; 
        }
    }

    handleTicketSelectChange();

    ticketSelect.addEventListener('change', handleTicketSelectChange);

    buyQuantityInput.addEventListener('input', function() {
        var maxQuantity = parseInt(this.getAttribute('max'));
        var enteredValue = parseInt(this.value);

        if (enteredValue <= 0 || isNaN(enteredValue)) {
            this.value = ''; 
            checkoutButton.setAttribute('disabled', 'disabled');
            return;
        }

        if (enteredValue < 0 || isNaN(enteredValue)) {
            alert("Please enter a valid number greater than zero.");
            this.value = ''; 
            return;
        }

        if (enteredValue > maxQuantity) {
            alert("Quantity cannot exceed the maximum available: " + maxQuantity);
            this.value = '0';
        }

        if (enteredValue > 0 || !isNaN(enteredValue)) {
            checkoutButton.removeAttribute('disabled');
            return;
        }

    });

    document.getElementById("ticket_id").addEventListener("change", updateTotalPrice);
    document.getElementById("buy_quantity").addEventListener("input", updateTotalPrice);

    document.getElementById("order_form").addEventListener("submit", function(event) {
        event.preventDefault();

        var email = document.getElementById("email").value;
        var ticketType = document.getElementById("ticket_type").value;
        var buyQuantity = document.getElementById("buy_quant").value;
        var totalPrice = document.getElementById("total_price_modal").value;

        if (email.trim() === '' || ticketType.trim() === '' || buyQuantity.trim() === '' || totalPrice.trim() === '') {
            alert("Choose a ticket type and quantity.");
            return false;
        }

        this.submit();
    });

    function getMaxQuantity(ticketId) {
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (this.status == 200) {
                var maxQuantity = parseInt(this.responseText);
                console.log("Max Quantity:", maxQuantity);
                buyQuantityInput.setAttribute('max', maxQuantity);
            } else {
                console.error("Request failed with status:", this.status);
            }
        };
        xhr.open('GET', './jQuery/getMaxQuantity.php?ticket_id=' + ticketId, true);
        xhr.send();
    }

    function updateTotalPrice() {
        var ticketId = document.getElementById("ticket_id").value;
        var quantity = document.getElementById("buy_quantity").value;

        if (quantity === '' || parseInt(quantity) === 0) {
            document.getElementById("total_price").textContent = '0';
            return;
        }

        var maxQuantity = parseInt(document.getElementById('buy_quantity').getAttribute('max'));
        var enteredValue = parseInt(quantity);

        if (enteredValue > maxQuantity) {
            this.value = '';
            alert("Quantity cannot exceed the maximum available: " + maxQuantity);
            document.getElementById("total_price").textContent = '0'; 
            return;
        }

        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                if (this.responseText.trim() !== '') {
                    var totalPrice = this.responseText;
                    document.getElementById("total_price").textContent = totalPrice;

                    var ticketType = document.getElementById("ticket_id").options[document.getElementById("ticket_id").selectedIndex].text;
                    var buyQuantity = document.getElementById("buy_quantity").value;
                    document.getElementById("ticket_type").value = ticketType;
                    document.getElementById("buy_quant").value = buyQuantity;
                    document.getElementById("ticket_id_modal").value = ticketId;
                    document.getElementById("total_price_modal").value = totalPrice;
                }
            }
        };
        xhr.open("GET", "./jQuery/calculate_price.php?ticket_id=" + ticketId + "&quantity=" + quantity, true);
        xhr.send();
    }
});
