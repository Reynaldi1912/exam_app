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


<style>

        .container_target {
            display: flex;
            flex-direction: column;
            margin-top: 50px;
        }

        .row_target {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #f0f0f0;
            border: 1px solid #ccc;
            padding: 10px;
            margin: 5px;
        }

        .source {
            flex: 1;
        }

        .target {
          color : white;
            background-color: #8FCF00
            ;
            border: 1px solid #ccc;
            padding: 10px;
            margin-left: 10px;
            cursor: pointer;
            width: 100px;
            text-align: center;
        }

        .target:hover {
            background-color: #8FCF00
            ;
        }

        .hide {
            display: none;
        }
    </style>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body>
  <div class="container-fluid">
    <div class="row p-3 text-white bg-primary">
      <div class="col-6">
        <h3><b>EXAM : {{$exam->name}}</b></h3>
      </div>
      <div class="col-6 text-end">
        <h3>{{$exam->start_date}} &nbsp&nbsp&nbsp|&nbsp&nbsp&nbsp <b id="countdown">00:00:00</b></h3>
      </div>
    </div>

    <form id="exam-form">
      @csrf
      <input type="hidden" value="{{$exam->id}}" id="exam_id">
      <input type="hidden" value="{{$question->id}}" name="question_id">
      <div class="row p-2">
        <div class="col-9 ms-5 p-5 border">
          @for ($i = 0; $i < $jml_soal->jml_soal; $i++) 
            <h1><b>{{ ($i + 1) == $num ? 'Pertanyaan ' . ($i + 1) : '' }}</b></h1>
          @endfor
          <div  style="font-size:15px;font-weight:bold;">
            @if($question->question_type_id == 1)
                Single Type
              @elseif($question->question_type_id == 2)
                Multiple Type
              @elseif($question->question_type_id == 3)
                Matching Type
              @elseif($question->question_type_id == 4)
                Input Text Type
              @endif
          </div>
          <div class="pb-3"></div>
          <hr>
          <div class="pt-3 pe-5">
              <div style="font-size:25px;">
                  {!! $question->question !!}
              </div>
              @if($question->question_type_id == 3)
                  <div class="container_target">
              @endif
              @foreach($answers as $key => $row)
              <div class="form-check mb-2">
                @if ($row->id !== null)
                  @if($question->question_type_id == 1)
                    <input class="form-check-input" type="radio"  for="q1a{{ $key }}" value="{{$key}}" name="choose_option"  @if($row->key_user == 1) checked @endif>
                    <label class="form-check-label" for="q1a{{ $key }}">
                      {{ $row->answer }}
                    </label>
                  @elseif($question->question_type_id == 2)
                  <input class="form-check-input" type="checkbox"  for="q1a{{ $key }}" value="{{$key}}" name="choose_option[]"  @if($row->key_user == 1) checked @endif>
                  <label class="form-check-label" for="q1a{{ $key }}">
                    {{ $row->answer }}
                  </label>
                  @elseif($question->question_type_id == 3)
                    <div class="row_target">
                        <div class="source">{{$row->answer}}</div>
                        <div class="target" draggable="true" id="target{{$key}}">
                          <input type="hidden" value="{{$target[$key]->id}}" name="target[]">
                          {{$target[$key]->answer}}
                        </div>
                    </div>
                  @endif
                @endif
                @if($question->question_type_id == 4)
                  <textarea name="answer_text" class="form-control">{{$row->key_text}}</textarea>
                @endif
                <input type="hidden" name="index_option[]" value="{{$row->id}}">
              </div>
              @endforeach
              @if($question->question_type_id == 3)
                </div>
              @endif
             
          </div>
          <hr>
          <div class="row">
              <div class="col text-center">
              @if($num > 1)
                  <button type="submit" class="btn btn-primary prev-page" data-page="{{ $num - 1 }}"><</button>
              @else
                  <button class="btn btn-primary" type="button" disabled><</button>
              @endif
              &nbsp&nbsp&nbsp&nbsp
              @if($num < $jml_soal->jml_soal)
                  <button type="submit" class="btn btn-primary next-page" data-page="{{ $num + 1 }}">></button>
              @else
                  <button class="btn btn-primary" type="button" disabled>></button>
              @endif
              </div>
          </div>
        </div>

      <div class="col-xl-2 col-sm-12 border me-3 p-5">
        <div class="pagination-container" id="pagination-container">
          <ul class="pagination" id="pagination">
            @for ($i = 0; $i < $jml_soal->jml_soal; $i++)
              <li class="page-item">
                <a class="page-link {{ ($i + 1) == $num ? 'active' : '' }}" href="#" data-page="{{ $i + 1 }}">
                  {{ $i + 1 }}
                </a>
              </li>
            @endfor
          </ul>
        </div>
      </div>

      </form>
    </div>
  </div>

  <script>
    $(document).ready(function() {
      updateCountdown();
      var exam_id = document.getElementById('exam_id').value;

      var $paginationContainer = $('#pagination-container');
      var $paginationItems = $('#pagination .page-item');

      if ($paginationItems.length > 5) {
        $paginationContainer.addClass('pagination-below');
      }

      function saveAndNavigate(page) {
        var formData = $('#exam-form').serialize() + '&page=' + page;
        
        $.ajax({
          url: '{{ route("save.answer", $question->id) }}',
          type: 'POST',
          data: formData,
          success: function(response) {
            // return false;
            window.location.href = '/running-exam/'+exam_id + '/' + page;
          },
          error: function(xhr) {
            alert('An error occurred while saving your answer.');
          }
        });
      }

      $('#exam-form').on('submit', function(e) {
        e.preventDefault();
        var page = $('.next-page').data('page') || $('.prev-page').data('page');
        saveAndNavigate(page);
      });

      $('.page-link').on('click', function(e) {
        e.preventDefault();
        var page = $(this).data('page');
        saveAndNavigate(page);
      });

      $('.prev-page, .next-page').on('click', function(e) {
        e.preventDefault();
        var page = $(this).data('page');
        saveAndNavigate(page);
      });
    });
  </script>

  <script>
    var startAt = new Date('{{ $exam->start_at }}');
    var duration = {{ $exam->duration }} * 60 * 1000; 

    // Waktu berakhir ujian
    var endAt = new Date(startAt.getTime() + duration);

    function updateCountdown() {
      var now = new Date().getTime();
      var distance = endAt - now;

      var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
      var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
      var seconds = Math.floor((distance % (1000 * 60)) / 1000);

      document.getElementById("countdown").innerHTML = hours.toString().padStart(2, '0') + ":" + minutes.toString().padStart(2, '0') + ":" + seconds.toString().padStart(2, '0');

      if (distance < 0) {
        clearInterval(countdownInterval);
        document.getElementById("countdown").innerHTML = "EXAM ENDED";
        alert('The exam has ended. You will be redirected to the waiting room.');
        window.location.href = '/waiting-room';
      }
    }
    var countdownInterval = setInterval(updateCountdown, 1000);
  </script>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const targets = document.querySelectorAll('.target');

      targets.forEach(target => {
          target.addEventListener('dragstart', dragStart);
          target.addEventListener('dragover', dragOver);
          target.addEventListener('drop', drop);
          target.addEventListener('dragenter', dragEnter);
          target.addEventListener('dragleave', dragLeave);
      });

      function dragStart(e) {
          // Menyimpan informasi parent asli dan indeks
          const originalParent = e.target.parentNode;
          const originalIndex = Array.from(originalParent.children).indexOf(e.target);

          e.dataTransfer.setData('text/plain', e.target.id);
          e.target.dataset.originalParent = originalParent.dataset.row; // Memasukkan dataset untuk parent asli
          e.target.dataset.originalIndex = originalIndex; // Memasukkan dataset untuk indeks asli
      }

      function dragOver(e) {
          e.preventDefault();
      }

      function drop(e) {
          e.preventDefault();
          const id = e.dataTransfer.getData('text/plain');
          const draggableElement = document.getElementById(id);
          const dropzone = e.target;

          // Menyimpan informasi parent asli dan indeks
          const originalParent = draggableElement.dataset.originalParent;
          const originalIndex = draggableElement.dataset.originalIndex;

          // Cek apakah dropzone adalah target yang valid
          if (dropzone.classList.contains('target')) {
              // Swap the positions of the two elements
              const draggableParent = draggableElement.parentNode;
              const dropzoneParent = dropzone.parentNode;

              draggableParent.appendChild(dropzone);
              dropzoneParent.appendChild(draggableElement);

              // Hapus kelas hide
              draggableElement.classList.remove('hide');
          } else {
              // Jika dropped di luar target valid, kembalikan ke posisi semula
              const parentElement = document.querySelector(`[data-row="${originalParent}"]`);
              const siblingElement = parentElement.children[originalIndex];

              parentElement.insertBefore(draggableElement, siblingElement);
              draggableElement.classList.remove('hide');
          }
      }

      function dragEnter(e) {
          e.preventDefault();
          e.target.classList.add('drag-over');
      }

      function dragLeave(e) {
          e.target.classList.remove('drag-over');
      }

      // Tambahkan event listener untuk dragend untuk menghapus kelas hide
      document.addEventListener('dragend', function(e) {
          const id = e.dataTransfer.getData('text/plain');
          const draggableElement = document.getElementById(id);
          draggableElement.classList.remove('hide');

          // Pastikan elemen dikembalikan ke posisi semula jika di-drop di luar target valid
          const originalParent = draggableElement.dataset.originalParent;
          const originalIndex = draggableElement.dataset.originalIndex;
          const parentElement = document.querySelector(`[data-row="${originalParent}"]`);
          const siblingElement = parentElement.children[originalIndex];

          parentElement.insertBefore(draggableElement, siblingElement);
      });
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
