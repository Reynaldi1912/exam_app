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
                            <th>user</th>
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
                            <td><a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#verticalycentered">10 user</a></td>
                            <td>
                                <a href="{{route('exam.edit', $data->id)}}" class="btn btn-outline-primary pe-2"><i class="bi bi-pencil"></i></a>
                                <a href="{{route('exam.delete', $data->id)}}" class="btn btn-outline-danger"><i class="bi bi-trash"></i></a>
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

    <div class="modal fade" id="verticalycentered" tabindex="-1">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">User Exams</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="col-12">
                <div class="overflow-auto">
                    <table class="table table-borderless datatable">
                      <thead>
                          <tr>
                              <th>username</th>
                              <th>exams</th>
                              <th>action</th>
                          </tr>
                      </thead>
                      <tbody>
                          @foreach($exam AS $data)
                          <tr>
                              <td>{{$data->name}}</td>
                              <td>{{$data->description}}</td>
                              <td>
                                <div class="form-check form-switch text-center">
                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked="" onchange="">
                                </div>
                              </td>
                          </tr>
                          @endforeach
                      </tbody>
                    </table>
                </div>
              </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button>
          </div>
        </div>
      </div>
    </div><!-- End Vertically centered Modal-->
@endsection