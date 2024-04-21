$(document).ready(function() {
    var urlParams = new URLSearchParams(window.location.search);
    if (urlParams.get('deleteAcc') === 'true') {
        $('#deleteUserModal').modal('show');
        removeQueryParams();
    }

    function removeQueryParams() {
        var urlWithoutParams = window.location.protocol + "//" + window.location.host + window.location.pathname;
        window.history.replaceState({ path: urlWithoutParams }, '', urlWithoutParams);
    }
});

function updateDeleteLink(profileId) {
    var deleteLink = document.getElementById('deleteLink');
    deleteLink.href = 'accountlist.php?profile_id=' + profileId + '&delete=true';
}