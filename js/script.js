// js/script.js
document.addEventListener("DOMContentLoaded", () => {
    // Load data dynamically from the JSON file
    fetch('data/data.json')
        .then(response => response.json())
        .then(data => {
            const buildingTypeSelect = document.getElementById('buildingType');
            data.buildingTypes.forEach(type => {
                const option = document.createElement('option');
                option.value = type;
                option.textContent = type.charAt(0).toUpperCase() + type.slice(1);
                buildingTypeSelect.appendChild(option);
            });
        })
        .catch(err => console.error("Failed to load building types:", err));

    // Handle form submission
    document.getElementById('buildForm').addEventListener('submit', function (e) {
        e.preventDefault();

        const landSize = document.getElementById('landSize').value;
        const buildingType = document.getElementById('buildingType').value;

        if (landSize && buildingType) {
            // Send data to the server (mocked here)
            console.log("Submitting form data:", { landSize, buildingType });
            alert("Form submitted successfully!");
        } else {
            alert("Please fill in all the fields.");
        }
    });
});
