@extends('layouts.app')

@section('content')
    <div class="pagetitle">
        <h1>Data Exams</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a></li>
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
                                <a href="{{ route('exam.create') }}" class="btn btn-outline-success text-end">Tambahkan Exams <i class="bi bi-person-plus"></i></a>
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

    <!-- Modal -->
    <div class="modal fade" id="verticalycentered" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">User Exams</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered" class="p-3">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="userTableBody">
                            <!-- Data users akan di-generate melalui JavaScript -->
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- End Modal -->

    <script>
       function showUsersModal(users, id) {
            var userTableBody = document.getElementById('userTableBody');
            userTableBody.innerHTML = '';
            users = JSON.parse(users);

            console.log(users);
            if (users && users.length > 0) {
                users.forEach(function(user, index) {
                    var row = document.createElement('tr');
                    var checkboxId = 'userExamStatus_' + index; // Unique ID for each checkbox
                    row.innerHTML = '<td>' + user.id + '</td>' +
                                    '<td>' + user.username + '</td>' +
                                    '<td>' + user.email + '</td>' +
                                    '<td>' +
                                    '<div class="form-check form-switch">' +
                                    '<input class="form-check-input" type="checkbox" onchange="changeStatusUser(this, '+id+', '+user.id+');" id="' + checkboxId + '" ' + (user.status ? 'checked' : '') + '>' +
                                    '</div>' +
                                    '</td>';
                    userTableBody.appendChild(row);
                });

            } else {
                var row = document.createElement('tr');
                row.innerHTML = '<td colspan="4">No users available.</td>';
                userTableBody.appendChild(row);
            }
        }

        function changeStatusUser(checkbox, id, user_id) {
            var changeUserExamStatus = checkbox.checked ? 1 : 0;
            console.log(changeUserExamStatus + '|' + id + '|' + user_id);
            $.ajax({
                url: '/exam-user-update',
                type: 'POST',
                data: {
                    id: id,
                    user_id: user_id,
                    status: changeUserExamStatus,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    location.reload();
                },
                error: function(xhr, status, error) {
                    alert('Terjadi kesalahan: ' + xhr.responseText);
                }
            });
        }

</script>

@endsection
