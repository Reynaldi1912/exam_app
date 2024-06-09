@extends('layouts.app')

@section('content')
    <div class="pagetitle">
      <h1>Add Exams</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item active">Add Exams</li>
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
                        <h5 class="card-title">Add New Exam</h5>
                    </div>
                </div>
                <p>Menu ini digunakan untuk menambahkan ujian <b>(peserta ujian)</b> <b>SuApps</b></p>
                <hr class="mt-4">
                <form action="{{route('exam.post')}}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-6">
                            <label class="pb-2">name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" placeholder="ex : Ujian Sesi 1" name="name">
                        </div>

                        <div class="col-6">
                            <label class="pb-2">description <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" placeholder="...." name="description">
                        </div>

                        <div class="col-6 pt-2">
                            <label class="pb-2">duration <b>(minute)</b> <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" placeholder="ex : 90" name="duration">
                        </div>

                        <div class="col-6 pt-2">
                            <label class="pb-2">start at <span class="text-danger">*</span></label>
                            <div class="row">
                                <div class="col">
                                    <input type="date" class="form-control" name="date_start">
                                </div>
                                <div class="col">
                                    <input type="time" class="form-control" name="time">
                                </div>
                            </div>
                        </div>
                        <div class="col pt-2">
                            <label class="pb-2">Exam App</label>
                            <input type="hidden" value="{{$exam_app->id}}" class="form-control" name="exam_app" readonly>
                            <input type="text" value="{{$exam_app->name}}" class="form-control" readonly>
                        </div>
                        <div class="col-12 pt-4">
                            <button type="submit" class="btn btn-success btn-block">Add Now</button>
                        </div>
                    </div>
                </form>
            </div>
          </div>

        </div>
      </div>
    </section>
@endsection