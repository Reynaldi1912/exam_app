@extends('layouts.app')

@section('content')
    <div class="pagetitle">
        <h1>Data Exams Quesiton</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a></li>
                <li class="breadcrumb-item active">Exams Question</li>
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
                                <h5 class="card-title">Table Exams Question</h5>
                            </div>
                        </div>
                        <p>Tabel exams digunakan untuk menambahkan ujian baru</p>

                        <div class="col-12">
                            <div class="overflow-auto">
                                <table class="table table-borderless datatable">
                                    <thead>
                                        <tr>
                                            <th>Exam Name</th>
                                            <th>Description</th>
                                            <th>Duration</th>
                                            <th>Start At</th>
                                            <th>User</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($exam as $exam)
                                        <tr>
                                            <td>{{ $exam->name }}</td>
                                            <td>{{ $exam->description }}</td>
                                            <td>{{ $exam->duration }}</td>
                                            <td>{{ $exam->start_at }}</td>
                                            <td><a href="#" class="btn btn-primary show-users-modal" data-bs-toggle="modal" onclick="showUsersModal({{ json_encode($exam->users) }} , {{$exam->id}});" data-bs-target="#verticalycentered">{{ $exam->total_user }} participant</a></td>
                                            <td>
                                                <a href="{{ route('exam.edit', $exam->id) }}" class="btn btn-outline-primary pe-2"><i class="bi bi-pencil"></i></a>
                                                <a href="{{ route('exam.delete', $exam->id) }}" class="btn btn-outline-danger"><i class="bi bi-trash"></i></a>
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
