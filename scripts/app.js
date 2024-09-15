document.addEventListener('DOMContentLoaded', () => {
    const menuItems = document.querySelectorAll('.menu-item');
    const orderSummaryList = document.getElementById('order-items-list');
    const totalPriceElement = document.getElementById('total-price');
    const placeOrderButton = document.getElementById('place-order');

    let selectedItems = [];
    let totalPrice = 0;

    menuItems.forEach(item => {
        item.addEventListener('click', () => {
            const itemName = item.getAttribute('data-name');
            const itemPrice = parseFloat(item.getAttribute('data-price'));

            // Toggle selection
            if (item.classList.contains('selected')) {
                item.classList.remove('selected');
                selectedItems = selectedItems.filter(i => i.name !== itemName);
                totalPrice -= itemPrice;
            } else {
                item.classList.add('selected');
                selectedItems.push({ name: itemName, price: itemPrice });
                totalPrice += itemPrice;
            }

            updateOrderSummary();
        });
    });

    function updateOrderSummary() {
        orderSummaryList.innerHTML = ''; // Clear the current list

        if (selectedItems.length > 0) {
            selectedItems.forEach(item => {
                const li = document.createElement('li');
                li.textContent = `${item.name} - RM ${item.price.toFixed(2)}`;
                orderSummaryList.appendChild(li);
            });
        } else {
            const li = document.createElement('li');
            li.textContent = 'No items selected';
            orderSummaryList.appendChild(li);
        }

        totalPriceElement.textContent = totalPrice.toFixed(2);

        placeOrderButton.disabled = selectedItems.length === 0;
    }

    placeOrderButton.addEventListener('click', () => {
        alert(`Order placed! Total amount: RM ${totalPrice.toFixed(2)}`);
        selectedItems = [];
        totalPrice = 0;
        updateOrderSummary();

        menuItems.forEach(item => {
            item.classList.remove('selected');
        });
    });
});
