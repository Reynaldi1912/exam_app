<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Exam Website</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="/niceadmin/assets/img/favicon.png" rel="icon">
  <link href="/niceadmin/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="/niceadmin/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="/niceadmin/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="/niceadmin/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="/niceadmin/assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="/niceadmin/assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="/niceadmin/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="/niceadmin/assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <style>
    .alert-absolute {
        position: fixed;
        bottom: 20px; /* Sesuaikan jarak dari bawah sesuai kebutuhan */
        right: 20px; /* Sesuaikan jarak dari kanan sesuai kebutuhan */
        z-index: 9999; /* Pastikan nilai z-index lebih tinggi dari elemen lain */
        width: auto; /* Sesuaikan lebar sesuai kebutuhan */
    }
    .sidebar {
        position: fixed;
        left: 0;
        top: 0;
        bottom: 0;
        width: 450px !important;
        background-color: #f8f9fa;
        padding-top: 20px;
        z-index: 1000;
    }
    .pagination {
        display: grid;
        grid-template-columns: repeat(10, 1fr);
        gap: 5px;
    }
    .pagination .page-item {
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .pagination .page-link {
        padding: 5px;
        width: 35px;
        height: 35px;
        display: flex;
        justify-content: center;
        align-items: center;
        text-decoration: none;
        color: #000;
        background-color: #e9ecef;
        border-radius: 4px;
    }
    .pagination .page-link:hover,
    .pagination .page-link.active {
        background-color: #007bff;
        color: #fff;
    }
    .pagination .page-link.red {
        background-color: #ff0000;
        color: #fff;
    }
    .pagination .page-link.green {
        background-color: #3cb371;
        color: #fff;
    }
    .content {
        margin-left: 120px;
        padding: 20px;
    }
    .timer {
        position: fixed;
        top: 20px;
        right: 20px;
        font-size: 18px;
        font-weight: bold;
        background-color: #fff;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 5px;
        z-index: 1000;
    }
    .page-content {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        height: 100vh;
    }
    .page-content h3 {
        margin-bottom: 20px;
    }
    .form-check {
        margin-bottom: 10px;
    }
    .matching-question {
        width: 100%;
        max-width: 500px;
    }
    .matching-pair {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 10px;
    }
    .matching-pair select {
        width: 45%;
    }
  </style>
  <!-- Template Main CSS File -->
  <link href="/niceadmin/assets/css/style.css" rel="stylesheet">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

</head>

<body>
    <div class="sidebar">
        <!-- Pagination Navigation -->
        <ul class="pagination" id="pagination">
            <li class="page-item"><a class="page-link" href="#" data-page="page1">1</a></li>
            <li class="page-item"><a class="page-link" href="#" data-page="page2">2</a></li>
            <li class="page-item"><a class="page-link" href="#" data-page="page3">3</a></li>
            <li class="page-item"><a class="page-link" href="#" data-page="page4">4</a></li>
            <li class="page-item"><a class="page-link" href="#" data-page="page5">5</a></li>
            <li class="page-item"><a class="page-link" href="#" data-page="page6">6</a></li>
            <li class="page-item"><a class="page-link" href="#" data-page="page7">7</a></li>
            <li class="page-item"><a class="page-link" href="#" data-page="page8">8</a></li>
            <li class="page-item"><a class="page-link" href="#" data-page="page9">9</a></li>
            <li class="page-item"><a class="page-link" href="#" data-page="page10">10</a></li>
            <li class="page-item"><a class="page-link" href="#" data-page="page11">11</a></li>
            <li class="page-item"><a class="page-link" href="#" data-page="page12">12</a></li>
            <li class="page-item"><a class="page-link" href="#" data-page="page13">13</a></li>
            <li class="page-item"><a class="page-link" href="#" data-page="page14">14</a></li>
            <li class="page-item"><a class="page-link" href="#" data-page="page15">15</a></li>
            <li class="page-item"><a class="page-link" href="#" data-page="page16">16</a></li>
            <li class="page-item"><a class="page-link" href="#" data-page="page17">17</a></li>
            <li class="page-item"><a class="page-link" href="#" data-page="page18">18</a></li>
            <li class="page-item"><a class="page-link" href="#" data-page="page19">19</a></li>
            <li class="page-item"><a class="page-link" href="#" data-page="page20">20</a></li>
        </ul>
    </div>

    <div class="content">
        <div class="timer" id="timer">Time Left: <span id="time">10:00</span></div>
        <!-- Main content for displaying questions and answers -->
        <div id="content">
            <div id="page1" class="page-content">
                <h3>Question 1</h3>
                <p>What is the capital of France?</p>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="question1" id="q1a1">
                    <label class="form-check-label" for="q1a1">
                        Paris
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="question1" id="q1a2">
                    <label class="form-check-label" for="q1a2">
                        London
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="question1" id="q1a3">
                    <label class="form-check-label" for="q1a3">
                        Rome
                    </label>
                </div>
            </div>
            <div id="page2" class="page-content d-none">
                <h3>Question 2</h3>
                <p>What is the largest planet in our solar system?</p>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="question2" id="q2a1">
                    <label class="form-check-label" for="q2a1">
                        Earth
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="question2" id="q2a2">
                    <label class="form-check-label" for="q2a2">
                        Jupiter
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="question2" id="q2a3">
                    <label class="form-check-label" for="q2a3">
                        Mars
                    </label>
                </div>
            </div>
            <div id="page3" class="page-content d-none">
                <h3>Question 3</h3>
                <p>What is the boiling point of water?</p>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="question3" id="q3a1">
                    <label class="form-check-label" for="q3a1">
                        100°C
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="question3" id="q3a2">
                    <label class="form-check-label" for="q3a2">
                        50°C
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="question3" id="q3a3">
                    <label class="form-check-label" for="q3a3">
                        0°C
                    </label>
                </div>
            </div>
            <div id="page4" class="page-content d-none">
                <h3>Question 4</h3>
                <p>What is the speed of light?</p>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="question4" id="q4a1">
                    <label class="form-check-label" for="q4a1">
                        3x10^8 m/s
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="question4" id="q4a2">
                    <label class="form-check-label" for="q4a2">
                        3x10^6 m/s
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="question4" id="q4a3">
                    <label class="form-check-label" for="q4a3">
                        3x10^4 m/s
                    </label>
                </div>
            </div>
            <div id="page5" class="page-content d-none">
                <h3>Question 5 (Matching)</h3>
                <div class="matching-question">
                    <div class="matching-pair">
                        <label>Match A:</label>
                        <select class="form-select" name="match1">
                            <option value="">Select</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                        </select>
                    </div>
                    <div class="matching-pair">
                        <label>Match B:</label>
                        <select class="form-select" name="match2">
                            <option value="">Select</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                        </select>
                    </div>
                    <div class="matching-pair">
                        <label>Match C:</label>
                        <select class="form-select" name="match3">
                            <option value="">Select</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                        </select>
                    </div>
                </div>
            </div>
            <!-- Add additional pages here -->
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#pagination a').click(function(e) {
                e.preventDefault();
                $('#pagination a').removeClass('active');
                $(this).addClass('active');
                
                var page = $(this).data('page');
                $('.page-content').addClass('d-none');
                $('#' + page).removeClass('d-none');
            });

            // Timer functionality
            var timeLeft = 600; // 10 minutes in seconds
            var timer = setInterval(function() {
                var minutes = Math.floor(timeLeft / 60);
                var seconds = timeLeft % 60;
                if (seconds < 10) seconds = '0' + seconds;
                $('#time').text(minutes + ':' + seconds);
                timeLeft--;
                if (timeLeft < 0) {
                    clearInterval(timer);
                    alert('Time is up!');
                }
            }, 1000);
        });
    </script>
    <!-- Bootstrap JS and dependencies -->
  <script src="/niceadmin/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
