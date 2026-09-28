document.addEventListener('DOMContentLoaded', () => {
    
    // Inisialisasi ikon Lucide
    if (window.lucide) {
        lucide.createIcons();
    }

    // Realtime Search / Filter untuk Mitra Industri
    const searchInput = document.getElementById('searchInput');
    const partnerGrid = document.getElementById('partnerGrid');
    
    if (searchInput && partnerGrid) {
        const cards = partnerGrid.querySelectorAll('.group');
        
        searchInput.addEventListener('input', function(e) {
            const searchTerm = e.target.value.toLowerCase();
            
            cards.forEach(card => {
                const textContent = card.innerText.toLowerCase();
                
                if (textContent.includes(searchTerm)) {
                    card.style.display = 'flex';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    }

    // Smooth Scroll untuk tombol navigasi internal
    const smoothLinks = document.querySelectorAll('a[href^="#"]');
    for (let link of smoothLinks) {
        link.addEventListener('click', function(e) {
            const targetId = this.getAttribute('href');
            
            if(targetId.startsWith('#') && targetId.length > 1) {
                const targetElement = document.querySelector(targetId);
                
                if (targetElement) {
                    e.preventDefault();
                    targetElement.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            }
        });
    }
});