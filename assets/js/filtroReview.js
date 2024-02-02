document.querySelectorAll('#filterForm input[type="checkbox"]').forEach(function(checkbox) {
    checkbox.addEventListener('change', function(e) {
        let selectedRatings = [];
        document.querySelectorAll('#filterForm input[type="checkbox"]:checked').forEach(function(checkbox) {
            selectedRatings.push('rating-' + checkbox.value);
        });

        document.querySelectorAll('.review').forEach(function(review) {
            let ratingClass = Array.from(review.classList).find(cls => cls.startsWith('rating-'));
            if (selectedRatings.includes(ratingClass)) {
                review.style.display = 'block';
            } else {
                review.style.display = 'none';
            }
        });
    });
});