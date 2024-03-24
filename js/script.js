function search() {
    const searchTerm = document.getElementById('searchInput').value.toLowerCase();
    const coats = ['coat', 'jacket', 'parka', 'puffer', 'trench', 'windbreaker'];
    const hats = ['hat', 'cap', 'beanie', 'headgear', 'headwear'];
    const accessories = ['accessory', 'scarf', 'shawl'];
    const boots = ['boot', 'shoe', 'footwear'];
    const gloves = ['glove', 'handwear', 'mitten'];

    if (coats.some(coat => searchTerm.includes(coat))) {
        const coatsSection = document.getElementById('Coats');
        coatsSection.scrollIntoView({ behavior: 'smooth', block: 'start', inline: 'start' });
    } else if (hats.some(hat => searchTerm.includes(hat))) {
        const hatsSection = document.getElementById('Hats');
        hatsSection.scrollIntoView({ behavior: 'smooth', block: 'start', inline: 'start' });
    } else if (accessories.some(accessory => searchTerm.includes(accessory))) {
        const accessoriesSection = document.getElementById('Accessories');
        accessoriesSection.scrollIntoView({ behavior: 'smooth', block: 'start', inline: 'start' });
    } else if (boots.some(boot => searchTerm.includes(boot))) {
        const bootsSection = document.getElementById('Boots');
        bootsSection.scrollIntoView({ behavior: 'smooth', block: 'start', inline: 'start' });
    } else if (gloves.some(glove => searchTerm.includes(glove))) {
        const glovesSection = document.getElementById('Gloves');
        glovesSection.scrollIntoView({ behavior: 'smooth', block: 'start', inline: 'start' });
    }
}

const radioButtons = document.querySelectorAll('input[type="radio"]');
let slideInterval;

radioButtons.forEach(radioButton => {
    radioButton.addEventListener('click', event => {
        event.preventDefault();
        
        clearInterval(slideInterval);
        
        slideInterval = setInterval(changeSlide, 5000);
    });
});

function changeSlide() {
    let counter = 1;
    const maxSlides = 4;
    
    return function () {
        document.getElementById('radio' + counter).checked = true;
        counter++;
        if (counter > maxSlides) {
            counter = 1;
        }
    };
}

slideInterval = setInterval(changeSlide(), 4000);
window.onscroll = function() { scrollFunction() };

function scrollFunction() {
    var scrollToTopBtn = document.getElementById("scrollToTopBtn");
    if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
        scrollToTopBtn.style.display = "block";
    } else {
        scrollToTopBtn.style.display = "none";
    }
}

function scrollToTop() {
    var currentScroll = document.documentElement.scrollTop || document.body.scrollTop;

    if (currentScroll > 0) {
        window.requestAnimationFrame(scrollToTop);
        window.scrollTo(0, currentScroll - (currentScroll / 8)); 
    }
}
document.addEventListener("DOMContentLoaded", function() {
    const productTableBody = document.getElementById("productTableBody");

    function fetchProducts() {
        fetch('fetch_products.php')
            .then(response => response.json())
            .then(data => {
                productTableBody.innerHTML = '';
                
                data.forEach(product => {
                    const { productid, colour, size, imageFilePath } = product;
                    addProductToTable(productid, colour, size, imageFilePath);
                });
            })
            .catch(error => console.error('Error fetching products:', error));
    }

    fetchProducts();

    function addProductToTable(productid, colour, size, imageURL) {
        const row = `
            <tr>
                <td><img src="${imageURL}" alt="Product Image"></td>
                <td>${productid}</td>
                <td>${colour}</td>
                <td>${size}</td>
                <td>
                    <button class="edit-btn">Edit</button>
                    <button class="remove-btn">Remove</button>
                </td>
            </tr>
        `;
        productTableBody.insertAdjacentHTML("beforeend", row);
    }

});
