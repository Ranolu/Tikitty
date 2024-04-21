$(document).ready(function(){
    $('#title').keyup(function(){
        console.log('Keyup event triggered'); 
        var title = $(this).val();
        console.log('Event Name: ', title); 
        $.ajax({
            url: 'jQuery/check_event_title.php', 
            method: 'POST',
            data: { title: title },
            dataType: 'json',
            success: function(response){
                console.log('Response from server:', response); 
                if(response){
                    $('#titleStatus').css('display', 'block'); 
                } else {
                    $('#titleStatus').css('display', 'none'); 
                }
            },
            error: function(xhr, status, error){
                console.log('Error occurred while checking title name:', error); 
            }
        });
    });

    $('form').on('submit', function(event) {
        if ($('#titleStatus').css('display') === 'block') {
            event.preventDefault();
            alert('Fix form issues first!');
        }
    });
});

$(document).ready(function() {
    function fetchTickets(eventId) {
        $.ajax({
            url: './jQuery/fetch_ticket.php', 
            method: 'POST',
            data: { event_id: eventId },
            dataType: 'json',
            success: function(response) {
                $('#edit_tickets').empty();
                response.forEach(function(ticket, index) {
                    var ticketHtml = `
                        <div class="card mb-3 ticket" data-ticket-id="${ticket.ticket_id}">
                            <input type="hidden" name="ticket_id[${index}]" value="${ticket.ticket_id}" required>
                            <div class='mb-3'>
                                <label class='form-label'>Type</label>
                                <input type='text' name='type[${index}]' class='form-control' value="${ticket.type}" required>
                            </div>
                            <div class='mb-3'>
                                <label class='form-label'>Price</label>
                                <input type='number' name='price[${index}]' class='form-control' value="${ticket.price}" required>
                            </div>
                            <div class='mb-3'>
                                <label class='form-label'>Quantity</label>
                                <input type='number' name='quantity[${index}]' class='form-control' value="${ticket.quantity}" required>
                            </div>
                            <div class='mb-3 text-center'>
                                <button type='button' class="btn btn-danger delete-type">Delete Type</button>
                            </div>
                        </div>
                    `;
                    $('#edit_tickets').append(ticketHtml);
                });
            },
            error: function(xhr, status, error) {
                console.error('Error fetching tickets:', error);
            }
        });
    }

    function updateTicket(ticketId, updatedData) {
        $.ajax({
            url: './jQuery/edit_ticket.php',
            method: 'POST',
            data: {
                ticket_id: ticketId,
                updated_data: updatedData
            },
            success: function(response) {
                console.log('Ticket updated successfully:', response);
            },
            error: function(xhr, status, error) {
                console.error('Error updating ticket:', error);
            }
        });
    }

    var urlParams = new URLSearchParams(window.location.search);
    var eventId = urlParams.get('event_id');

    fetchTickets(eventId);

    $('#edit_tickets').on('click', '.delete-type', function() {
        var ticketId = $(this).closest('.ticket').data('ticket-id');
        var button = $(this); 
        $.ajax({
            url: './jQuery/delete_ticket.php', 
            method: 'POST',
            data: { ticket_id: ticketId },
            success: function(response) {
                button.closest('.ticket').remove(); 
                fetchTickets(eventId); 
            },
            error: function(xhr, status, error) {
                console.error('Error deleting ticket:', error);
            }
        });
    });

    $('#edit_tickets').on('change', '.ticket input', function() {
        var ticketId = $(this).closest('.ticket').data('ticket-id');
        var updatedData = {
            type: $(this).closest('.ticket').find('input[name^="type"]').val(),
            price: $(this).closest('.ticket').find('input[name^="price"]').val(),
            quantity: $(this).closest('.ticket').find('input[name^="quantity"]').val()
        };
        updateTicket(ticketId, updatedData);
    });
});

let currentIndex = 1; 

function addTypeField() {
    const container = document.getElementById("type_fields");
    const newField = document.createElement("div");
    const fieldId = `ticket_field_${currentIndex}`;

    newField.innerHTML = `
        <div id="${fieldId}">
            <div class='mb-3'>
                <label class='form-label'>Type</label>
                <input type='text' name='ticket_type[${currentIndex}]' class='form-control'>
            </div>
            <div class='mb-3'>
                <label class='form-label'>Price</label>
                <input type='number' name='ticket_price[${currentIndex}]' class='form-control'>
            </div>
            <div class='mb-3'>
                <label class='form-label'>Quantity</label>
                <input type='number' name='ticket_quant[${currentIndex}]' class='form-control'>
            </div>
            <div class="text-center">
            <button type="button" class="btn btn-danger mt-2" onclick="removeTypeField('${fieldId}')">Close</button>
            </div>
        </div>
        
    `;
    container.appendChild(newField);
    
    currentIndex++; 
}

function removeTypeField(fieldId) {
    const ticketField = document.getElementById(fieldId);
    ticketField.remove();
    currentIndex--;
}


