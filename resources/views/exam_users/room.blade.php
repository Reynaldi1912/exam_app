@extends('layouts.app')

@section('content')
    <div class="pagetitle">
        <h1>Waiting Room Exam</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a></li>
                <li class="breadcrumb-item active">Exam Room</li>
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
                                <h5 class="card-title">list Room Exam</h5>
                            </div>
                        </div>
                        <p>merupakan ruangan untuk peserta sebelum mengikuti ujian</p>

                        <div class="col-12">
                            <div class="overflow-auto">
                                <table class="table table-borderless datatable">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Name</th>
                                            <th>Description</th>
                                            <th>Duration</th>
                                            <th>Start Exam</th>
                                            <th>Status Exam</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                       @foreach($data AS $row)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$row->name}}</td>
                                            <td>{{$row->description}}</td>
                                            <td>{{$row->duration}} Minute</td>
                                            <td>{{$row->start_at_exam}}</td>
                                            <td>{{$row->status_exam}}</td>
                                            @if($row->status_exam == 'RUNNING')
                                            <td><a href="/running-exam/{{$row->exam_id}}/1" class="btn btn-success">Masuk Ujian</a></td>
                                            @else
                                            <td><a href="#" class="btn btn-secondary" disabled>Masuk Ujian</a></td>
                                            @endif
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
