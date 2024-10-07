// Document ready function
document.addEventListener("DOMContentLoaded", function() {
    // Update quantities in the custom blend form
    const quantityInputs = document.querySelectorAll("input[type='range']");
    const totalWarning = document.getElementById('total-warning');

    if (quantityInputs.length > 0) {
        // Function to validate total quantity
        const validateQuantities = () => {
            let totalQuantity = 0;
            quantityInputs.forEach(input => {
                totalQuantity += parseInt(input.value);
            });

            if (totalQuantity !== 100) {
                totalWarning.style.display = 'block';
            } else {
                totalWarning.style.display = 'none';
            }
        };

        // Attach event listeners to each range input
        quantityInputs.forEach(input => {
            input.addEventListener('input', validateQuantities);
        });

        // Initial validation
        validateQuantities();
    }
});

// Add to Cart Confirmation
const cartForms = document.querySelectorAll("form[action='cart.php']");
cartForms.forEach(form => {
    form.addEventListener('submit', function(event) {
        event.preventDefault();
        const product = form.querySelector("input[name='product']").value;
        alert(product + " has been added to your cart!");
        form.submit(); // Continue form submission
    });
});
