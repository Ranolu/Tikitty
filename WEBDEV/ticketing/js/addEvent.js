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

let currentIndex = 1; 

function addTypeField() {
    const container = document.getElementById("type_fields");
    const newField = document.createElement("div");
    const fieldId = `ticket_field_${currentIndex}`;

    newField.innerHTML = `
        <div id="${fieldId}">
            <div class='mb-3'>
                <label class='form-label'>Type</label>
                <input type='text' name='ticket_type[${currentIndex}]' class='form-control' required>
            </div>
            <div class='mb-3'>
                <label class='form-label'>Price</label>
                <input type='number' name='ticket_price[${currentIndex}]' class='form-control' required>
            </div>
            <div class='mb-3'>
                <label class='form-label'>Quantity</label>
                <input type='number' name='ticket_quant[${currentIndex}]' class='form-control' required>
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
