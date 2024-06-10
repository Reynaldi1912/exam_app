@extends('layouts.app')

@section('content')
    <div class="pagetitle">
      <h1>Edit Exams</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item active">Edit Exams</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <h5 class="card-title">Edit New Exam</h5>
                    </div>
                </div>
                <p>Menu ini digunakan untuk menambahkan ujian <b>(peserta ujian)</b> <b>SuApps</b></p>
                <hr class="mt-4">
                <form action="{{route('exam.update')}}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-6">
                            <label class="pb-2">name <span class="text-danger">*</span></label>
                            <input type="hidden" class="form-control" value="{{$exam_app->id}}" placeholder="ex : Ujian Sesi 1" name="id">
                            <input type="text" class="form-control" value="{{$exam_app->name}}" placeholder="ex : Ujian Sesi 1" name="name">
                        </div>

                        <div class="col-6">
                            <label class="pb-2">description <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" placeholder="...." value="{{$exam_app->description}}"  name="description">
                        </div>

                        <div class="col-6 pt-2">
                            <label class="pb-2">duration <b>(minute)</b> <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" placeholder="ex : 90" value="{{$exam_app->duration}}"  name="duration">
                        </div>

                        <div class="col-6 pt-2">
                            <label class="pb-2">start at <span class="text-danger">*</span></label>
                            <div class="row">
                                <div class="col">
                                    <input type="date" class="form-control" name="date_start" value="{{$exam_app->date_start_at}}" >
                                </div>
                                <div class="col">
                                    <input type="time" class="form-control" name="time" value="{{$exam_app->time_start_at}}" >
                                </div>
                            </div>
                        </div>
                        <div class="col pt-2">
                            <label class="pb-2">Exam App</label>
                            <input type="hidden" value="{{$exam_app->id}}" class="form-control" name="exam_app" readonly>
                            <input type="text" value="{{$exam_app->name}}" class="form-control" readonly>
                        </div>
                        <div class="col-12 pt-4">
                            <button type="submit" class="btn btn-success btn-block">Edit Now</button>
                        </div>
                    </div>
                </form>
            </div>
          </div>

        </div>
      </div>
    </section>
@endsection