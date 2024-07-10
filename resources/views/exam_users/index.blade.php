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

  <!-- Custom CSS -->
  <style>
    .alert-absolute {
      position: fixed;
      bottom: 20px;
      right: 20px;
      z-index: 9999;
      width: auto;
    }
    .sidebar {
      position: fixed;
      left: 0;
      top: 0;
      bottom: 0;
      width: 250px;
      background-color: #f8f9fa;
      padding-top: 20px;
      z-index: 1000;
    }
    .pagination {
      display: flex;
      flex-wrap: wrap;
      justify-content: flex-end;
      padding-right: 20px;
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
      margin: 2px;
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
      margin-left: 250px;
      padding: 20px;
      display: flex;
      flex-direction: column;
      flex-grow: 1;
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
    @media (max-width: 768px) {
      .sidebar {
        width: 100%;
        height: auto;
        position: relative;
      }
      .pagination {
        position: static;
        margin-top: 20px;
        justify-content: center;
        padding-right: 0;
      }
      .content {
        margin-left: 0;
      }
      .timer {
        position: static;
        margin-bottom: 20px;
      }
      .page-content {
        margin-left: 0;
      }
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
      @for ($i = 0; $i < $jml_soal->jml_soal; $i++)
        <li class="page-item">
          <a class="page-link {{ ($i + 1) == $num ? 'active' : '' }}" href="/running-exam/{{ $i + 1 }}">
            {{ $i + 1 }}
          </a>
        </li>
      @endfor
    </ul>
  </div>

  <div class="content">
    <div class="timer" id="timer">Time Left: <span id="time">10:00</span></div>
    <!-- Main content for displaying questions and answers -->
    <div id="content">
      <div id="page1" class="page-content">
        <h3>{{ ($i + 1) == $num ? 'Pertanyaan ' . ($i + 1) : '' }}</h3>
        {!! $data->question !!}
        @foreach($answers as $key => $row)
          <div class="form-check">
            @if($data->question_type_id == 1)
              <input class="form-check-input" type="radio" name="question1" id="q1a{{ $key }}" @if($row['is_true'] == 1) checked @endif>
            @elseif($data->question_type_id == 2)
              <input class="form-check-input" type="checkbox" name="question1[]" id="q1a{{ $key }}" @if($row['is_true'] == 1) checked @endif>
            @endif
            <label class="form-check-label" for="q1a{{ $key }}">
              {{ $row['answer'] }}
            </label>
          </div>
        @endforeach
      </div>
    </div>
  </div>

  <script>
    $(document).ready(function() {
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
