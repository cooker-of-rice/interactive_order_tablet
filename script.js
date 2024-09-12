document.addEventListener('DOMContentLoaded', () => {
    const viewDetailsButtons = document.querySelectorAll('.view-details');
    const itemModal = document.getElementById('item-modal');
    const closeBtn = itemModal.querySelector('.close-btn');
    const addToCartBtn = document.getElementById('add-to-cart');
    const cartLink = document.getElementById('view-cart');
    let cartCount = 0;
  
    viewDetailsButtons.forEach(button => {
      button.addEventListener('click', () => {
        itemModal.classList.remove('hidden');
      });
    });
  
    closeBtn.addEventListener('click', () => {
      itemModal.classList.add('hidden');
    });
  
    addToCartBtn.addEventListener('click', () => {
      cartCount++;
      cartLink.textContent = `Cart (${cartCount})`;
      itemModal.classList.add('hidden');
    });
  });
  