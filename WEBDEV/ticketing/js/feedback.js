$(document).ready(function() {
    var urlParams = new URLSearchParams(window.location.search);
    if (urlParams.get('feedBack') === 'true') {
        $('#makeFeedbackModal').modal('show');
        removeQueryParams();
    } else if (urlParams.get('feedBackUpdate') === 'true') {
        $('#editFeedbackModal').modal('show');
        removeQueryParams();
    }

    function removeQueryParams() {
        var urlWithoutParams = window.location.protocol + "//" + window.location.host + window.location.pathname;
        window.history.replaceState({ path: urlWithoutParams }, '', urlWithoutParams);
    }
});

$(document).ready(function() {
    var offset = 0; 
    var limit = 5; 

    function fetchFeedbacks() {
        $.ajax({
            url: './jQuery/get_feedbacks.php',
            method: 'POST',
            data: { offset: offset, limit: limit },
            success: function(response) {
                var feedbacks = JSON.parse(response);
                feedbacks.forEach(function(feedback) {
                    var feedbackHtml = '<div class="list-group list-group-flush" style="--bs-list-group-bg: transparent;">';
                    feedbackHtml += '<div class="list-group-item py-3">';
                    feedbackHtml += '<div class="px-md-5 mx-md-5 mb-3">';
                    for (var i = 0; i < feedback.rate; i++) {
                        feedbackHtml += '<i class="fa-solid fa-star" style="color: #f5a201;"></i>';
                    }
                    for (var j = feedback.rate; j < 5; j++) {
                        feedbackHtml += '<i class="fa-solid fa-star" style="color: #cccccc;"></i>';
                    }
                    feedbackHtml += '</div>';
                    feedbackHtml += '<p class="px-md-5 mx-md-5 mb-0 flex-wrap" style="color: white;">' + feedback.feedback + '<br>' + feedback.username +'</p>';
                    feedbackHtml += '</div></div>';
                    
                    $('#feedbacksContainer').append(feedbackHtml);
                });

                offset += limit; 
                if (feedbacks.length < limit) {
                    $('#loadMoreBtn').hide();
                } else {
                    $('#loadMoreBtn').show();
                }
            }
        });
    }

    fetchFeedbacks();

    $('#loadMoreBtn').click(function() {
        fetchFeedbacks();
    });
});