document.addEventListener('DOMContentLoaded', function () {
    const toggleButton = document.querySelector('[data-bb-toggle="toggle-guests-and-rooms"]');
    const dropdownMenu = document.getElementById('toggle-guests-and-rooms');

    if (toggleButton && dropdownMenu) {
        toggleButton.addEventListener('click', function () {
            dropdownMenu.style.display = dropdownMenu.style.display === 'block' ? 'none' : 'block';
        });

        document.addEventListener('click', function (event) {
            if (!toggleButton.contains(event.target) && !dropdownMenu.contains(event.target)) {
                dropdownMenu.style.display = 'none';
            }
        });
    }

    const decrementButtons = document.querySelectorAll('[data-bb-toggle="decrement-room"]');
    const incrementButtons = document.querySelectorAll('[data-bb-toggle="increment-room"]');

    decrementButtons.forEach(button => {
        button.addEventListener('click', function () {
            const input = this.parentElement.querySelector('input[type="number"]');
            const currentValue = parseInt(input.value, 10);
            const minValue = parseInt(input.min, 10);
            if (currentValue > minValue) {
                input.value = currentValue - 1;
                updateSummary();
            }
        });
    });

    incrementButtons.forEach(button => {
        button.addEventListener('click', function () {
            const input = this.parentElement.querySelector('input[type="number"]');
            const currentValue = parseInt(input.value, 10);
            const maxValue = parseInt(input.max, 10);
            if (currentValue < maxValue) {
                input.value = currentValue + 1;
                updateSummary();
            }
        });
    });

    function updateSummary() {
        const adults = document.getElementById('adults').value;
        const children = document.getElementById('children').value;
        const rooms = document.getElementById('rooms').value;

        document.querySelector('[data-bb-toggle="filter-adults-count"]').textContent = adults;
        document.querySelector('[data-bb-toggle="filter-children-count"]').textContent = children;
        document.querySelector('[data-bb-toggle="filter-rooms-count"]').textContent = rooms;
    }
});
