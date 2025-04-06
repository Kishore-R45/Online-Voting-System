<?php
session_start();
if(!isset($_SESSION['id'])){
    header('location:../');
}
$data = $_SESSION['data'];
$status = $_SESSION['status'] == 1 ? '<b class="status voted">Voted</b>' : '<b class="status not-voted">Not Voted</b>';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Voting system - Dashboard</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: linear-gradient(to right, #1e3c72, #2a5298);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #f0f0f0;
            padding: 40px 20px;
        }

        .container {
            max-width: 1100px;
            margin: auto;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 0 25px rgba(0, 0, 0, 0.2);
        }

        h1 {
            font-size: 2.5rem;
            margin-bottom: 30px;
            text-align: center;
            color: #fff;
        }

        .button {
            background-color: #121212;
            color: #f0f0f0;
            border: none;
            padding: 12px 25px;
            margin: 10px 10px 10px 0;
            border-radius: 10px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .button:hover {
            background-color: #2f2f2f;
        }

        .voted {
            color: #4caf50;
            font-weight: bold;
        }

        .not-voted {
            color: #f44336;
            font-weight: bold;
        }

        .row {
            display: flex;
            flex-wrap: wrap;
            margin-bottom: 30px;
        }

        .candidate-card {
            background: rgba(255, 255, 255, 0.08);
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 25px;
            transition: transform 0.3s ease;
        }

        .candidate-card:hover {
            transform: translateY(-5px);
        }

        .candidate-img,
        .voter-img {
            width: 100%;
            max-width: 180px;
            height: auto;
            border-radius: 10px;
            margin-bottom: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.5);
        }

        .col {
            flex: 1;
            padding: 10px;
        }

        .info-label {
            font-weight: bold;
            color: #ddd;
        }

        .vote-button {
            padding: 10px 20px;
            border-radius: 8px;
            cursor: pointer;
            border: none;
            font-weight: bold;
            transition: all 0.3s ease;
        }

        .vote-button[type="submit"] {
            background-color: #e91e63;
            color: white;
        }

        .vote-button[type="submit"]:hover {
            background-color: #d81b60;
        }

        .vote-button.voted {
            background-color: #4caf50;
            color: white;
            cursor: not-allowed;
        }

        hr {
            border-color: rgba(255,255,255,0.2);
            margin: 20px 0;
        }

        @media(max-width: 768px){
            .row {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <a href="../"><button class="button">Back</button></a>
        <a href="logout.php"><button class="button">Logout</button></a>
        <button class="button" onclick="toggleResults()">Vote Result</button>

        <h1>Voting System</h1>

        <div class="row">
            <div class="col">
                <?php 
                if(isset($_SESSION['candidates'])){
                    $candidates = $_SESSION['candidates'];
                    for($i = 0; $i < count($candidates); $i++){
                        ?>
                        <div class="candidate-card">
                            <div class="row">
                                <div class="col">
                                    <img class="candidate-img" src="../uploads/<?php echo $candidates[$i]['photo'] ?>" alt="Candidate image">
                                </div>
                                <div class="col">
                                    <p><span class="info-label">Candidate Name:</span> <?php echo $candidates[$i]['username'] ?></p>
                                    <p><span class="info-label">Votes:</span> <?php echo $candidates[$i]['votes'] ?></p>
                                </div>
                            </div>

                            <form action="../actions/voting.php" method="post">
                                <input type="hidden" name="candidatevotes" value="<?php echo $candidates[$i]['votes'] ?>">
                                <input type="hidden" name="candidateid" value="<?php echo $candidates[$i]['id'] ?>">

                                <?php 
                                if($_SESSION['status'] == 1){
                                    echo '<button class="vote-button voted" disabled>Voted</button>';
                                } else {
                                    echo '<button class="vote-button" type="submit">Vote</button>';
                                }
                                ?>
                            </form>
                        </div>
                        <hr>
                        <?php
                    }
                } else {
                    echo "<p>No Candidates to display</p>";
                }
                ?>
            </div>
            <div class="col">
                <img class="voter-img" src="../uploads/<?php echo $data['photo']?>" alt="Voter image">
                <br><br>
                <p><span class="info-label">Name:</span> <?php echo $data['username']; ?></p>
                <p><span class="info-label">Mobile:</span> <?php echo $data['mobile']; ?></p>
                <p><span class="info-label">Status:</span> <?php echo $status; ?></p>
            </div>
        </div>
    </div>
    <div id="resultChartContainer" style="display: none; margin-top: 40px; max-width: 600px; margin-left: auto; margin-right: auto;">
    <canvas id="voteChart" height="300"></canvas>
</div>

<script>
    const voteData = <?php echo json_encode($_SESSION['candidates']); ?>;
    const labels = voteData.map(c => c.username);
    const votes = voteData.map(c => c.votes);

    let chartVisible = false;

    function toggleResults() {
        const chartContainer = document.getElementById('resultChartContainer');
        if (!chartVisible) {
            chartContainer.style.display = 'block';
            renderChart();
        } else {
            chartContainer.style.display = 'none';
        }
        chartVisible = !chartVisible;
    }

    function renderChart() {
        const ctx = document.getElementById('voteChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Votes',
                    data: votes,
                    backgroundColor: [
                        '#e91e63', '#4caf50', '#3f51b5', '#ff9800', '#00bcd4'
                    ],
                    borderRadius: 8
                }]
            },
            options: {
    plugins: {
        legend: { display: false },
        title: {
            display: true,
            text: 'Voting Results',
            color: '#fff',
            font: { size: 18 }  // made smaller
        }
    },
    scales: {
        x: {
            ticks: { color: '#fff', font: { size: 12 } },
            grid: { color: 'rgba(255,255,255,0.1)' }
        },
        y: {
            beginAtZero: true,
            ticks: { color: '#fff', font: { size: 12 } },
            grid: { color: 'rgba(255,255,255,0.1)' }
        }
    }
}

        });
    }
</script>


</body>
<?php include 'footer.php'; ?>
</html>
