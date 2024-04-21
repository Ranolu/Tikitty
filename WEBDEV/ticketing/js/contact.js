$(document).ready(function() {
    var urlParams = new URLSearchParams(window.location.search);
    if (urlParams.get('sent') === 'success') {
        $('#contactSuccessModal').modal('show');
        removeQueryParams();
    }

    function removeQueryParams() {
        var urlWithoutParams = window.location.protocol + "//" + window.location.host + window.location.pathname;
        window.history.replaceState({ path: urlWithoutParams }, '', urlWithoutParams);
    }
});