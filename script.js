document.addEventListener('DOMContentLoaded', () => {
  const menuItems = document.querySelectorAll('.menu-item');
  const searchBar = document.getElementById('search-bar');
  const cancelOrderButton = document.querySelector('.cancel-order');

  // Filter items based on search input
  searchBar.addEventListener('keyup', () => {
      const searchValue = searchBar.value.toLowerCase();
      menuItems.forEach(item => {
          const itemName = item.querySelector('h3').textContent.toLowerCase();
          if (itemName.includes(searchValue)) {
              item.style.display = 'block';  // Show the item if it matches
          } else {
              item.style.display = 'none';   // Hide the item if it doesn't match
          }
      });
  });

  // Add event listeners to menu items for selection
  menuItems.forEach(item => {
      item.addEventListener('click', () => {
          const itemName = item.querySelector('h3').textContent;
          const itemPrice = item.querySelector('p').textContent;

          // For demo purposes, we'll just log the selection.
          // You could implement functionality like adding the item to the order.
          alert(`You selected: ${itemName} - ${itemPrice}`);
      });
  });

  // Handle Cancel Order Button click
  cancelOrderButton.addEventListener('click', () => {
      // For now, just show an alert message.
      // In a real system, you might clear the order summary or reset the interface.
      if (confirm('Are you sure you want to cancel the order?')) {
          alert('Order has been canceled.');
      }
  });
});
