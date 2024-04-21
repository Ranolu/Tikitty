$(document).ready(function() {
    var urlParams = new URLSearchParams(window.location.search);
    if (urlParams.get('sessionExpired') === 'true') {
        $('#sessionExpiredModal').modal('show');
        removeQueryParams();
    } else if (urlParams.get('makeUser') === 'success' || urlParams.get('makeOrganizer') === 'success') {
        $('#makeuserModal').modal('show');
        removeQueryParams();
    } else if (urlParams.get('loginSuccess') === 'false') {
        $('#loginFailModal').modal('show');
        removeQueryParams();
    } else if (urlParams.get('order') === 'success') {
        $('#orderModal').modal('show');
        removeQueryParams();
    }

    function removeQueryParams() {
        var urlWithoutParams = window.location.protocol + "//" + window.location.host + window.location.pathname;
        window.history.replaceState({ path: urlWithoutParams }, '', urlWithoutParams);
    }
});

const containers = document.querySelectorAll('.scrollContainer');
containers.forEach(container => {
    let isDown = false;
    let startX;
    let scrollLeft;

    container.addEventListener('mousedown', (e) => {
        isDown = true;
        startX = e.pageX - container.offsetLeft;
        scrollLeft = container.scrollLeft;
    });

    container.addEventListener('mouseleave', () => {
        isDown = false;
    });

    container.addEventListener('mouseup', () => {
        isDown = false;
    });

    container.addEventListener('mousemove', (e) => {
        if (!isDown) return;
        e.preventDefault();
        const x = e.pageX - container.offsetLeft;
        const walk = (x - startX) * 1.5;
        container.scrollLeft = scrollLeft - walk;
    });
});

document.addEventListener("DOMContentLoaded", function() {
    const containers = document.querySelectorAll('.scrollContainer');

    containers.forEach(container => {
        container.addEventListener('scroll', () => {
            container.classList.add('scroll-detected');
            clearTimeout(container.dataset.scrollTimeout);
            container.dataset.scrollTimeout = setTimeout(() => {
                container.classList.remove('scroll-detected');
            }, 1000); 
        });
    });
});