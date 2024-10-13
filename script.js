// Empty array to hold cart items
let cart = [];

// Function to filter menu items by category
function filterMenu(category) {
    const filteredItems = menuItems.filter(item => item.category === category);
    const menuContainer = document.getElementById('menuItems');
    menuContainer.innerHTML = '';

    filteredItems.forEach(item => {
        const itemElement = `
            <div class="menu-item">
                <img src="images/${item.img}" alt="${item.name}">
                <h3>${item.name}</h3>
                <p>$${item.price.toFixed(2)}</p>
                <button onclick="addToCart(${item.id})">Add to Cart</button>
            </div>
        `;
        menuContainer.innerHTML += itemElement;
    });

    // Highlight the active category button
    document.querySelectorAll('.category-btn').forEach(btn => btn.classList.remove('active'));
    document.querySelector(`.category-btn[onclick="filterMenu('${category}')"]`).classList.add('active');
}

// Function to add item to the cart
function addToCart(itemId) {
    const item = menuItems.find(item => item.id === itemId);
    cart.push(item);
    document.getElementById('checkoutBtn').style.display = 'block'; // Show checkout button when item is added
}

// Function to proceed to checkout page
function showCheckoutPage() {
    window.location.href = "checkout.php";  // Redirect to checkout.php page
}
