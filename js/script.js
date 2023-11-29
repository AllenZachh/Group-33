function search() {
    const searchTerm = document.getElementById('searchInput').value.toLowerCase();
  
    if (searchTerm === 'coats') {
        const coatsSection = document.getElementById('Coats');
        coatsSection.scrollIntoView({ behavior: 'smooth', block: 'start' });
    } 
}
