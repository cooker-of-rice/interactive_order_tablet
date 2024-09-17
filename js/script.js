// js/script.js

let selectedMaterial = 'glass'; // Default to glass
const materialsData = {}; // Store JSON data

// Fetch the materials data from the JSON file
fetch('data/data.json')
    .then(response => response.json())
    .then(data => {
        materialsData = data.materials;
    });

document.addEventListener('DOMContentLoaded', () => {
    const floors = [];
    let totalCost = 0;

    const addFloorBtn = document.getElementById('addFloorBtn');
    const floorList = document.getElementById('floorList');
    const roomButtons = document.querySelectorAll('.room-btn');
    const summaryList = document.getElementById('summaryList');
    const totalCostDisplay = document.getElementById('totalCost');

    // Handle material selection
    const materialSelect = document.getElementById('materialSelect'); // Assuming this is on a form
    materialSelect.addEventListener('change', (e) => {
        selectedMaterial = e.target.value;
        updateRoomImages(); // Update images when material changes
    });

    // Add floor logic
    addFloorBtn.addEventListener('click', () => {
        const floorNumber = floors.length + 1;
        floors.push({ floor: floorNumber, room: null });
        const floorBtn = document.createElement('button');
        floorBtn.textContent = `Floor ${floorNumber}`;
        floorBtn.classList.add('floor-btn');
        floorBtn.setAttribute('data-floor', floorNumber);
        floorList.appendChild(floorBtn);
        activateFloor(floorBtn);
    });

    // Activate floor button
    function activateFloor(btn) {
        document.querySelectorAll('.floor-btn').forEach(floorBtn => {
            floorBtn.classList.remove('active');
        });
        btn.classList.add('active');
    }

    // Room selection
    roomButtons.forEach(button => {
        button.addEventListener('click', () => {
            const room = button.getAttribute('data-room');
            const activeFloor = document.querySelector('.floor-btn.active').getAttribute('data-floor');
            const floorIndex = floors.findIndex(floor => floor.floor == activeFloor);

            // Update floor with room selection
            floors[floorIndex].room = room;

            // Update summary and calculate cost based on selected material
            const roomCost = materialsData[selectedMaterial].rooms[room].cost;
            totalCost += roomCost;
            const summaryItem = document.createElement('li');
            summaryItem.textContent = `Floor ${activeFloor}: ${room} ............ ${roomCost}€`;
            summaryList.appendChild(summaryItem);
            totalCostDisplay.textContent = totalCost;
        });
    });

    // Discard selection
    document.getElementById('discardBtn').addEventListener('click', () => {
        floors.length = 0;
        summaryList.innerHTML = '';
        totalCost = 0;
        totalCostDisplay.textContent = totalCost;
    });

    // Update room images based on selected material
    function updateRoomImages() {
        roomButtons.forEach(button => {
            const room = button.getAttribute('data-room');
            const imagePath = materialsData[selectedMaterial].rooms[room].image;
            button.style.backgroundImage = `url(${imagePath})`;
        });
    }
});
