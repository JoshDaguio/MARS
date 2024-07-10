<canvas id="pieChart" width="400" height="400"></canvas>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    
    // Get data passed from the controller
    var data = <?php echo json_encode($data); ?>;

    // Set up the pie chart
    var ctx = document.getElementById('pieChart').getContext('2d');
    var myPieChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: Object.keys(data),
            datasets: [{
                data: Object.values(data),
                backgroundColor: [
                    'rgba(0, 128, 128, 0.9)',   // Teal
                    'rgba(0, 191, 255, 0.9)',   // Deep Sky Blue
                    'rgba(32, 178, 170, 0.9)',  // Light Sea Green
                    'rgba(60, 179, 113, 0.9)',  // Medium Sea Green
                    'rgba(0, 255, 127, 0.9)',   // Spring Green
                ],
            }],
        },
    });
</script>
