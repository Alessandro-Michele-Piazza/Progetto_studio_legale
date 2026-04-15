document.querySelector('.button-home').addEventListener('click', function(e) {
    e.preventDefault();
    const targetId = this.getAttribute('href');
    const targetElement = document.querySelector(targetId);
    
    if (targetElement) {
        window.scrollTo({
            top: targetElement.offsetTop - 80, // Sottrae l'altezza dell'header se fisso
            behavior: 'smooth'
        });
    }
});