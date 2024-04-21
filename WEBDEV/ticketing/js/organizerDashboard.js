$(document).ready(function() {
    var urlParams = new URLSearchParams(window.location.search);
    if (urlParams.get('delete') === 'success') {
        $('#deleteEventModal').modal('show');
        removeQueryParams();
    } else if (urlParams.get('addEvent') === 'success') {
        $('#makeEventModal').modal('show');
        removeQueryParams();
    } else if (urlParams.get('editEvent') === 'success') {
        $('#editEventModal').modal('show');
        removeQueryParams();
    } else if (urlParams.get('eventNotFound') === 'true') {
        $('#notFoundEventModal').modal('show');
        removeQueryParams();
    }

    function removeQueryParams() {
        var urlWithoutParams = window.location.protocol + "//" + window.location.host + window.location.pathname;
        window.history.replaceState({ path: urlWithoutParams }, '', urlWithoutParams);
    }
});

function updateDeleteLink(eventId) {
    var deleteLink = document.getElementById('deleteModalLink');
    deleteLink.href = 'organizerDashboard.php?event_id=' + eventId + '&deleteEvent=true';
}