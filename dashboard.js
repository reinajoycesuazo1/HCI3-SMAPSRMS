document.addEventListener('DOMContentLoaded', function() {
    // Get the canvas element
    const ctx = document.getElementById('recordsChart').getContext('2d');
    
    // Create the chart
    const recordsChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Baptism', 'Communion', 'Confirmation', 'Marriage'],
            datasets: [{
                label: 'Sacramental Records',
                data: [
                    parseInt(document.querySelector('.baptism .stat-value').textContent),
                    parseInt(document.querySelector('.communion .stat-value').textContent),
                    parseInt(document.querySelector('.confirmation .stat-value').textContent),
                    parseInt(document.querySelector('.marriage .stat-value').textContent)
                ],
                backgroundColor: [
                    '#3498db', // Baptism blue
                    '#2ecc71', // Communion green
                    '#9b59b6', // Confirmation purple
                    '#e74c3c'  // Marriage red
                ],
                borderColor: [
                    '#2980b9',
                    '#27ae60',
                    '#8e44ad',
                    '#c0392b'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                title: {
                    display: true,
                    text: 'Sacramental Records Distribution',
                    align: 'center' // Center the title
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Number of Records'
                    }
                }
            }
        }
    });

    // Add animation to stat cards
    const statCards = document.querySelectorAll('.stat-card');
    statCards.forEach((card, index) => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(20px)';
        card.style.transition = `all 0.5s ease ${index * 0.1}s`;
        
        setTimeout(() => {
            card.style.opacity = '1';
            card.style.transform = 'translateY(0)';
        }, 100);
    });
});
