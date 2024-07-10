<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Dashboard - NiceAdmin Bootstrap Template</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="/niceadmin/assets/img/favicon.png" rel="icon">
  <link href="/niceadmin/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="/niceadmin/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="/niceadmin/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="/niceadmin/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="/niceadmin/assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="/niceadmin/assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="/niceadmin/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="/niceadmin/assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="/niceadmin/assets/css/style.css" rel="stylesheet">

  <style>
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
      margin: 2px;
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
    .pagination-container {
      display: flex;
      flex-direction: column;
      align-items: flex-end;
    }
    .pagination-container.pagination-below {
      align-items: flex-start;
    }
  </style>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body>
  <div class="container-fluid">
    <div class="row p-3 text-white bg-primary">
      <div class="col-6">
        <h3><b>EXAM</b></h3>
      </div>
      <div class="col-6 text-end">
        <h3><b>12:00:00</b></h3>
      </div>
    </div>
    <div class="row p-2">
      <div class="col-9 ms-5 p-5 border">
        @for ($i = 0; $i < $jml_soal->jml_soal; $i++) 
          <h1><b>{{ ($i + 1) == $num ? 'Pertanyaan ' . ($i + 1) : '' }}</b></h1>
        @endfor
        <br>
        <hr>
        <div class="pt-3 pb-5 pe-5 ps-5">
            <div style="font-size:25px;">
                {!! $data->question !!}
            </div>
            @foreach($answers as $key => $row)
            <div class="form-check mb-2">
              @if($data->question_type_id == 1)
              <input class="form-check-input" type="radio" name="question1" id="q1a{{ $key }}" @if($row['is_true'] == 1) checked @endif>
              @elseif($data->question_type_id == 2)
              <input class="form-check-input" type="checkbox" name="question1[]" id="q1a{{ $key }}" @if($row['is_true'] == 1) checked @endif>
              @elseif($data->question_type_id == 4)
              <textarea name="content" class="form-control">
                
              </textarea>
              @endif
              <label class="form-check-label" for="q1a{{ $key }}">
              {{ $row['answer'] }}
              </label>
            </div>
            @endforeach
        </div>
        <hr>
        <div class="row">
            <div class="col text-center">
                <button class="btn btn-primary"><</button>
                &nbsp&nbsp&nbsp&nbsp
                <button class="btn btn-primary">></button>
            </div>
        </div>
      </div>
      <div class="col-xl-2 col-sm-12 border me-3 p-5">
        <div class="pagination-container" id="pagination-container">
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
      </div>
    </div>
  </div>

  <script>
    $(document).ready(function() {
      var $paginationContainer = $('#pagination-container');
      var $paginationItems = $('#pagination .page-item');

      if ($paginationItems.length > 5) {
        $paginationContainer.addClass('pagination-below');
      }
    });
  </script>
  <!-- Vendor JS Files -->
  <script src="/niceadmin/assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="/niceadmin/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="/niceadmin/assets/vendor/chart.js/chart.umd.js"></script>
  <script src="/niceadmin/assets/vendor/echarts/echarts.min.js"></script>
  <script src="/niceadmin/assets/vendor/quill/quill.js"></script>
  <script src="/niceadmin/assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="/niceadmin/assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="/niceadmin/assets/js/main.js"></script>
</body>
</html>
