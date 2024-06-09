@extends('layouts.app')

@section('content')
    <div class="pagetitle">
      <h1>Data User</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item active">Data</li>
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
                        <h5 class="card-title">Table User</h5>
                    </div>
                    <div class="col text-end align-self-center">
                        <a href="{{route('user.create')}}" class="btn btn-outline-success text-end">Tambahkan User <i class="bi bi-person-plus"></i></a>
                    </div>
                </div>
                <p>Tabel user digunakan untuk manajemen user <b>(termasuk peserta ujian)</b> yang akan dikelola oleh admin ujian secara langsung</p>



            <div class="col-12">
              <div class="overflow-auto">
                  <table class="table table-borderless datatable">
                    <thead>
                        <tr>
                            <th>username</th>
                            <th>email</th>
                            <th>role</th>
                            <th data-type="date" data-format="YYYY/DD/MM">exam contribution</th>
                            <th>action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($user AS $data)
                        <tr>
                            <td>{{$data->username}}</td>
                            <td>{{$data->email}}</td>
                            <td>{{$data->role}}</td>
                            <td>2005/02/11</td>
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