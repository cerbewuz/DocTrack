document.addEventListener('DOMContentLoaded', function () {
    const profileButton = document.querySelector('.profile-button');
    const dropdownMenu = document.querySelector('.dropdown-menu');
    const darkModeToggle = document.getElementById('dark-mode-toggle');
    let isDropdownVisible = false;

    profileButton.addEventListener('click', function (e) {
        e.stopPropagation();
        isDropdownVisible = !isDropdownVisible;
        dropdownMenu.style.display = isDropdownVisible ? 'block' : 'none';
    });

    window.addEventListener('click', function () {
        if (isDropdownVisible) {
            isDropdownVisible = false;
            dropdownMenu.style.display = 'none';
        }
    });

    profileButton.addEventListener('mouseover', function () {
        if (!isDropdownVisible) {
            profileButton.classList.add('hover');
        }
    });

    profileButton.addEventListener('mouseout', function () {
        if (!isDropdownVisible) {
            profileButton.classList.remove('hover');
        }
    });

    const isDarkMode = localStorage.getItem('dark-mode') === 'enabled';
    if (isDarkMode) {
        document.body.classList.add('dark-mode');
        darkModeToggle.textContent = 'Light mode';
    }

    darkModeToggle.addEventListener('click', function () {
        document.body.classList.toggle('dark-mode');
        if (document.body.classList.contains('dark-mode')) {
            localStorage.setItem('dark-mode', 'enabled');
            darkModeToggle.textContent = 'Light mode';
        } else {
            localStorage.setItem('dark-mode', 'disabled');
            darkModeToggle.textContent = 'Dark mode';
        }
    });
});
