document.addEventListener('DOMContentLoaded', () => {
    const products = document.querySelectorAll('.towar');

    const options = {
        root: null,
        rootMargin: '0px',
        threshold: 0.3
    };

    const observer = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const childElements = entry.target.querySelectorAll('*');
                childElements.forEach(child => {
                    child.style.display = 'block';
                    if (child.classList.contains('add_to_cart')) {
                        child.style.display = 'flex';
                        child.style.justifyContent = 'center';
                    }
                });

                observer.unobserve(entry.target);
            }
        });
    }, options);

    products.forEach(product => {
        observer.observe(product);
    });
});