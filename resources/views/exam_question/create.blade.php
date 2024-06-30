@extends('layouts.app')

@section('content')
<div class="pagetitle">
    <h1>Add Question</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item active">Add Questions</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section dashboard">
    <form action="{{ route('question.post') }}" method="post" enctype="multipart/form-data" onsubmit="return validateForm()">
        @csrf
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Pertanyaan</h5>
                        <input type="hidden" name="exam_id" value="{{$exam_id}}">
                        <textarea name="content" class="tinymce-editor">
                            <p>Tuliskan Pertanyaan Anda</p>
                        </textarea>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="row">
                    <div class="col">
                        <label for="answerType">Tipe Jawaban</label>
                    </div>
                    <div class="col text-end">
                        <input type="checkbox" id="isImage" class="form-check-input" disabled onchange="toggleAnswerType()"> Jawaban Gambar
                    </div>
                </div>
                <select id="answerType" name="answerType" class="form-control mt-2" onchange="updateAnswerInputs()" required>
                    <option value=""></option>
                    <option value="pilgan">Pilihan Ganda</option>
                    <option value="pilgan_com">Pilihan Ganda Kompleks</option>
                    <option value="menjodohkan">Menjodohkan</option>
                    <option value="uraian">Uraian</option>
                </select>
                <div id="answerContainer" class="mt-3"></div>
            </div>
            <div class="col-12 mt-3">
                <button type="submit" class="btn btn-success">Simpan</button>
            </div>
        </div>
    </form>
</section>

<script>
    var index = 0;
    tinymce.init({
        selector: 'textarea.tinymce-editor',
        height: 300,
        menubar: false,
        plugins: [
            'advlist autolink lists link image charmap print preview anchor',
            'searchreplace visualblocks code fullscreen',
            'insertdatetime media table paste code help wordcount'
        ],
        toolbar: 'undo redo | formatselect | bold italic backcolor | ' +
            'alignleft aligncenter alignright alignjustify | ' +
            'bullist numlist outdent indent | removeformat | help'
    });

    function updateAnswerInputs() {
        const answerType = document.getElementById('answerType').value;
        const answerContainer = document.getElementById('answerContainer');
        const checkbox = document.getElementById('isImage');
        answerContainer.innerHTML = '';

        if (answerType === 'pilgan' || answerType === 'pilgan_com') {
            checkbox.disabled = false; 

            addChoice(answerType, index++);
            addChoice(answerType, index++);

            const addButton = document.createElement('button');
            addButton.type = 'button';
            addButton.classList.add('btn', 'btn-primary', 'mt-3');
            addButton.textContent = 'Tambah Pilihan';
            addButton.onclick = () => addChoice(answerType, index++);

            answerContainer.appendChild(addButton);
            checkbox.checked = false; 

        } else if (answerType === 'menjodohkan') {
            checkbox.disabled = false; 

            addMatching();
            addMatching();

            const addButton = document.createElement('button');
            addButton.type = 'button';
            addButton.classList.add('btn', 'btn-primary', 'mt-3');
            addButton.textContent = 'Tambah Pasangan';
            addButton.onclick = addMatching;

            answerContainer.appendChild(addButton);
            checkbox.checked = false; 

        }else{
            checkbox.disabled = true; 
            checkbox.checked = false; 
        }
    }

    function addChoice(type, index) {
        const answerContainer = document.getElementById('answerContainer');

        const choiceWrapper = document.createElement('div');
        choiceWrapper.classList.add('form-group', 'mt-2', 'position-relative');

        choiceWrapper.innerHTML = `
            <hr>
            <label for="option${index}">Pilihan</label>
            <div class="input-group mb-3">
                <textarea name="options[]" class="form-control" required></textarea>
            </div>
            <div class="input-group mb-3 d-none">
                <input type="file" name="option_images[]" accept="image/*" class="form-control" onchange="previewImage(this)">
                <button type="button" class="btn btn-outline-danger ml-2" onclick="clearFileInput(this.previousElementSibling)">Hapus</button>
            </div>
            <img id="preview${index}" class="img-fluid d-none" alt="Preview Image" style="max-width: 200px; max-height: 200px">
            <div class="row align-items-center">
                <div class="col-6">
                    <div class="form-check">
                        <input type="${type === 'pilgan' ? 'radio' : 'checkbox'}" class="form-check-input correct-answer" name="correct_answers[]" value="${index}">
                        <input type="hidden" name="index[]" value="${index}">
                        <label class="form-check-label">Jawaban Benar</label>
                    </div>
                </div>
                <div class="col-6 text-right">
                    <button type="button" class="btn btn-danger mt-2" onclick="removeElement(this)"><i class="bi bi-trash-fill"></i></button>
                </div>
            </div>
        `;

        answerContainer.appendChild(choiceWrapper);

        toggleAnswerType();
        toggleAnswerType();
    }

    function addMatching() {
        const answerContainer = document.getElementById('answerContainer');
        const matchIndex = answerContainer.querySelectorAll('.form-group').length + 1;

        const matchWrapper = document.createElement('div');
        matchWrapper.classList.add('form-group', 'mt-2');

        matchWrapper.innerHTML = `
            <label for="statement${matchIndex}">Pernyataan</label>
            <textarea name="statement[]" class="form-control"></textarea>
            <div class="input-group mb-3 d-none">
                <label for="match${matchIndex}">Pasangan</label>
                <textarea name="match_text[]" class="form-control" placeholder="Teks Jawaban"></textarea>
            </div>
            <label for="match${matchIndex}">Pasangan</label>
            <div class="input-group mb-3 d-none">
                <input type="file" name="match_image[]" accept="image/*" class="form-control" onchange="previewImage(this)">
                <button type="button" class="btn btn-outline-danger ml-2" onclick="clearFileInput(this.previousElementSibling)">Hapus</button>
            </div>
            <img id="preview${matchIndex}" class="img-fluid d-none" alt="Preview Image" style="max-width: 200px; max-height: 200px">
            <div class="row align-items-center mt-2">
                <div class="col-6">
                    <button type="button" class="btn btn-danger" onclick="removeElement(this)"><i class="bi bi-trash-fill"></i></button>
                </div>
            </div>
        `;

        answerContainer.appendChild(matchWrapper);

        toggleAnswerType();
        toggleAnswerType();
    }

    function toggleInput(matchIndex) {
        const isImageCheckbox = document.getElementById('isImage').checked;

        if (isImageCheckbox) {
            return `
                <label for="match${matchIndex}">Pasangan</label>
                <div class="input-group mb-3">
                    <input type="file" name="match_image[]" accept="image/*" class="form-control" onchange="previewImage(this)">
                    <button type="button" class="btn btn-outline-danger ml-2" onclick="clearFileInput(this.previousElementSibling)">Hapus</button>
                </div>
            `;
        } else {
            return `
                <label for="match${matchIndex}">Pasangan</label>
                <textarea name="match_text[]" class="form-control" placeholder="Teks Jawaban"></textarea>
            `;
        }
    }

    function toggleAnswerType() {
        const isImageCheckbox = document.getElementById('isImage');
        const answerInputs = document.querySelectorAll('textarea[name="options[]"],textarea[name="match_text[]"], input[type="file"][name="option_images[]"],input[type="file"][name="match_image[]"]');

        if (isImageCheckbox.checked) {
            console.log(answerInputs);
            answerInputs.forEach(input => {
                console.log(input.tagName.toLowerCase());
                if (input.tagName.toLowerCase() === 'textarea') {
                    input.parentNode.classList.add('d-none');
                    input.required = false; // Tidak wajib diisi
                } else if (input.tagName.toLowerCase() === 'input') {
                    input.parentNode.classList.remove('d-none');
                    input.required = true; // Wajib diisi
                }
            });
        } else {
            answerInputs.forEach(input => {
                if (input.tagName.toLowerCase() === 'textarea') {
                    input.parentNode.classList.remove('d-none');
                    input.required = true; // Wajib diisi
                } else if (input.tagName.toLowerCase() === 'input') {
                    input.parentNode.classList.add('d-none');
                    input.required = false; // Tidak wajib diisi
                }
            });
        }
    }

    function validateForm() {
        const matchWrappers = document.querySelectorAll('.form-group');
        let hasFilledImage = false;

        for (let i = 0; i < matchWrappers.length; i++) {
            const matchWrapper = matchWrappers[i];
            const imageInput = matchWrapper.querySelector('input[type="file"]');
            const textAreaInput = matchWrapper.querySelector('textarea[name="match_text[]"]');
            const previewImage = matchWrapper.querySelector('img');

            if (imageInput.files.length > 0) {
                hasFilledImage = true;

                if (previewImage.src.trim() === '') {
                    alert('Harap pilih gambar dengan benar.');
                    return false;
                }
            } else {
                textAreaInput.value = '';
                previewImage.src = '';

                if (textAreaInput.value.trim() !== '') {
                    alert('Hapus teks jawaban karena gambar belum dipilih.');
                    return false;
                }
            }
        }

        if (hasFilledImage) {
            return true;
        }

        return true;
    }

    function previewImage(input) {
        const matchIndex = input.name.match(/\d+/)[0];
        const preview = document.getElementById(`preview${matchIndex}`);

        if (input.files && input.files[0]) {
            const reader = new FileReader();

            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.classList.remove('d-none');
            };

            reader.readAsDataURL(input.files[0]);
        }
    }

    function clearFileInput(input) {
        input.value = '';
        const matchIndex = input.name.match(/\d+/)[0];
        const preview = document.getElementById(`preview${matchIndex}`);
        preview.src = '';
        preview.classList.add('d-none');
    }

    function removeElement(element) {
        element.parentNode.parentNode.parentNode.remove();
    }
</script>
@endsection
