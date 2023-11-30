function search() {
    const searchTerm = document.getElementById('searchInput').value.toLowerCase();
    const coats = ['coat', 'jacket', 'parka', 'puffer', 'trench', 'windbreaker'];
    const hats = ['hat', 'cap', 'beanie', 'headgear', 'headwear'];

    if (coats.some(coat => searchTerm.includes(coat))) {
        const coatsSection = document.getElementById('Coats');
        coatsSection.scrollIntoView({ behavior: 'smooth', block: 'start', inline: 'start' });
    } else if (hats.some(hat => searchTerm.includes(hat))) {
        const hatsSection = document.getElementById('Hats');
        hatsSection.scrollIntoView({ behavior: 'smooth', block: 'start', inline: 'start' });
    }

}


;
