@extends('layouts.app')

@section('content')
    <div class="pagetitle">
      <h1>Add User</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item active">Add User</li>
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
                        <h5 class="card-title">Add New User</h5>
                    </div>
                </div>
                <p>Menu ini digunakan untuk menambahkan user <b>(peserta ujian)</b> untuk mendapatkan akses ujian pada aplikasi <b>SuApps</b></p>
                <hr class="mt-4">
                <form action="{{route('user.update')}}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-6">
                            <label class="pb-2">username <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" placeholder="ex : johndoe123" value="{{$data->username}}" name="username">
                            <input type="hidden" class="form-control" placeholder="ex : johndoe123" value="{{$data->id}}" name="id">
                        </div>
                        <div class="col-6">
                            <label class="pb-2">email <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" placeholder="ex : johndoe123.exam.com" value="{{$data->email}}" name="email">
                        </div>
                        <div class="col-6 pt-2">
                            <label class="pb-2">password <span class="text-danger">*</span></label>
                            <input type="password" class="form-control" placeholder="ex : ****" name="password">
                        </div>
                        <div class="col-6 pt-2">
                            <label class="pb-2">confirm password <span class="text-danger">*</span></label>
                            <input type="password" class="form-control" placeholder="ex : ****" name="password_confirm">
                        </div>

                        <div class="col pt-2">
                            <label class="pb-2">Exam App </label>
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