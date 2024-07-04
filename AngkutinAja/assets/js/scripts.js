// Toggle sidebar
document.addEventListener('DOMContentLoaded', function() {
    const openSidebarBtn = document.getElementById('openSidebarBtn');
    const closeSidebarBtn = document.getElementById('closeSidebarBtn');
    const sidebar = document.getElementById('sidebar');

    openSidebarBtn.addEventListener('click', function() {
        sidebar.classList.add('open');
    });

    closeSidebarBtn.addEventListener('click', function() {
        sidebar.classList.remove('open');
    });

    // Close sidebar when clicking outside of it
    window.addEventListener('click', function(event) {
        if (!sidebar.contains(event.target) && event.target !== openSidebarBtn) {
            sidebar.classList.remove('open');
        }
    });
});

// Toggle profile menu
document.addEventListener('DOMContentLoaded', function() {
    const profileIcon = document.getElementById('profileIcon');
    const profileMenu = document.getElementById('profile-menu');

    profileIcon.addEventListener('click', function() {
        profileMenu.classList.toggle('open');
    });

    // Close profile menu if clicking outside of it
    window.addEventListener('click', function(event) {
        if (event.target !== profileIcon && !profileMenu.contains(event.target)) {
            profileMenu.classList.remove('open');
        }
    });
});

// Chart.js - Chart configuration
const ctx = document.getElementById('itemChart') ? document.getElementById('itemChart').getContext('2d') : null;
if (ctx) {
    const itemChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['May 17', 'May 18', 'May 19', 'May 20', 'May 21', 'May 22', 'May 23', 'May 24', 'May 25', 'May 26', 'May 27', 'May 28'],
            datasets: [{
                label: 'Jumlah Sampah Harian',
                data: [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    max: 120
                }
            }
        }
    });
}

// Modal functionality
document.addEventListener('DOMContentLoaded', function() {
    const openModalBtn = document.getElementById('openModalBtn');
    const modal = document.getElementById('modal');
    const closeModalBtn = document.getElementById('closeModalBtn');

    openModalBtn.addEventListener('click', function() {
        modal.style.display = 'block';
    });

    closeModalBtn.addEventListener('click', function() {
        modal.style.display = 'none';
    });

    window.addEventListener('click', function(event) {
        if (event.target === modal) {
            modal.style.display = 'none';
        }
    });
});
