//selection and deselection
document.addEventListener('DOMContentLoaded', function() {
    const menuItems = document.querySelectorAll('.menu-item');

    menuItems.forEach(item => {
        item.addEventListener('click', () => {
            // Toggle the 'selected' class on click
            item.classList.toggle('selected');

            // Optional: Store selected items in an array or pass it to the backend
            const itemName = item.getAttribute('data-name');
            const itemPrice = item.getAttribute('data-price');

            if (item.classList.contains('selected')) {
                console.log(`Selected: ${itemName} - Price: RM ${itemPrice}`);
            } else {
                console.log(`Deselected: ${itemName}`);
            }
        });
    });
});
