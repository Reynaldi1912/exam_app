@extends('layouts.app')

@section('content')
    <div class="pagetitle">
      <h1>Data Exams</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item active">Exams</li>
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
                        <h5 class="card-title">Table Exams</h5>
                    </div>
                    <div class="col text-end align-self-center">
                        <a href="{{route('exam.create')}}" class="btn btn-outline-success text-end">Tambahkan Exams <i class="bi bi-person-plus"></i></a>
                    </div>
                </div>
                <p>Tabel exams digunakan untuk menambahkan ujian baru</p>



            <div class="col-12">
              <div class="overflow-auto">
                  <table class="table table-borderless datatable">
                    <thead>
                        <tr>
                            <th>exam name</th>
                            <th>description</th>
                            <th>duration</th>
                            <th data-type="date" data-format="YYYY/DD/MM">start at</th>
                            <th>action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($exam AS $data)
                        <tr>
                            <td>{{$data->name}}</td>
                            <td>{{$data->description}}</td>
                            <td>{{$data->duration}}</td>
                            <td>{{$data->start_at}}</td>
                            <td>
                                <a href="{{route('user.edit', $data->id)}}" class="btn btn-outline-primary pe-2"><i class="bi bi-pencil"></i></a>
                                <a href="{{route('user.delete', $data->id)}}" class="btn btn-outline-danger"><i class="bi bi-trash"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                  </table>
              </div>
            </div>
            </div>
          </div>

        </div>
      </div>
    </section>
@endsection