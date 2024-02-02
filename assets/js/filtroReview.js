function orderReviews(order) {
    let container = document.getElementById('container');
    let reviews = Array.from(container.getElementsByClassName('review'));
    reviews.sort(function(a, b) {
        let ratingA = parseInt(a.className.match(/valoracion-(\d)/)[1]);
        let ratingB = parseInt(b.className.match(/valoracion-(\d)/)[1]);
        if (order === 'asc') {
            return ratingA - ratingB;
        } else {
            return ratingB - ratingA;
        }
    });
    reviews.forEach(function(review) {
        container.appendChild(review);
    });
}

document.getElementById('orderSelect').addEventListener('change', function(e) {
    orderReviews(e.target.value);
});

document.querySelectorAll('#filterForm input[type="checkbox"]').forEach(function(checkbox) {
    checkbox.addEventListener('change', function(e) {
        let selectedRatings = [];
        document.querySelectorAll('#filterForm input[type="checkbox"]:checked').forEach(function(checkbox) {
            selectedRatings.push('valoracion-' + checkbox.value);
        });
        document.querySelectorAll('.review').forEach(function(review) {
            let ratingClass = Array.from(review.classList).find(cls => cls.startsWith('valoracion-'));
            if (selectedRatings.includes(ratingClass)) {
                review.style.display = 'block';
            } else {
                review.style.display = 'none';
            }
        });
        orderReviews(document.getElementById('orderSelect').value);
    });
});