// Validación del formulario
(function () {
    'use strict'
    var forms = document.querySelectorAll('.needs-validation')
    Array.prototype.slice.call(forms)
        .forEach(function (form) {
            form.addEventListener('submit', function (event) {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                }
                form.classList.add('was-validated')
            }, false)
        })
})();

function initializeStoryNavigation() {
    const storiesContainer = document.getElementById('storiesContainer');
    const storyPrev = document.getElementById('storyPrev');
    const storyNext = document.getElementById('storyNext');
    const scrollAmount = 200;

    if (!storiesContainer || !storyPrev || !storyNext) {
        console.error('One or more story navigation elements not found');
        return;
    }

    storyPrev.addEventListener('click', function() {
        storiesContainer.scrollBy({
            left: -scrollAmount,
            behavior: 'smooth'
        });
    });

    storyNext.addEventListener('click', function() {
        storiesContainer.scrollBy({
            left: scrollAmount,
            behavior: 'smooth'
        });
    });

    function checkScrollPosition() {
        const scrollLeft = storiesContainer.scrollLeft;
        const scrollWidth = storiesContainer.scrollWidth;
        const clientWidth = storiesContainer.clientWidth;

        storyPrev.style.display = scrollLeft > 0 ? 'flex' : 'none';
        storyNext.style.display = scrollLeft < scrollWidth - clientWidth ? 'flex' : 'none';
    }

    storiesContainer.addEventListener('scroll', checkScrollPosition);
    window.addEventListener('resize', checkScrollPosition);
    checkScrollPosition();
}

// Run the initialization function when the DOM is fully loaded
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initializeStoryNavigation);
} else {
    initializeStoryNavigation();
}