@extends('back.template')

@push('meta')
    <script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.css">
@endpush

@section('title', 'Posts Create')

@section('breadcrumb')
    <div class="container-fluid px-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb my-0">
                <li class="breadcrumb-item"><a href="#">Home</a>
                </li>
                <li class="breadcrumb-item active"><span>Posts Create</span>
                </li>
            </ol>
        </nav>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <a href="{{ $previousUrl }}" class="btn btn-sm btn-primary"><i class="fa-solid fa-reply"></i></a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('post.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        {{-- <div class="mb-3">
              <label for="name" class="form-label">Nama Category</label>
              <input type="text" name="name" placeholder="Tuliskan judul kontent" class="form-control @error('name')
                is-invalid
              @enderror" autofocus value="{{ old('name') }}">

              @error('name')
                <div class="alert alert-danger mt-2">
                  {{ $message }}
                </div>
              @enderror
            </div> --}}

                        <div class="mb-3">
                            <label for="title" class="form-label">Judul Konten<span class="text-danger">*</span></label>
                            <input type="text" name="title" placeholder="Tuliskan judul kontent"
                                class="form-control @error('title')
                    is-invalid
                @enderror"
                                value="{{ old('title') }}">

                            @error('title')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="category_id" class="form-label">Kategori<span class="text-danger">*</span></label>
                            <select name="category_id" id=""
                                class="form-control @error('category_id')
                    is-invalid
                @enderror">
                                <option value="" hidden>-- Pilih --</option>
                                @forelse ($categories as $item)
                                    <option value="{{ $item->id }}"
                                        {{ "$item->id" === old('category_id') ? 'selected' : '' }}>{{ $item->name }}
                                    </option>
                                @empty
                                    <option value="">Tidak ada data</option>
                                @endforelse
                            </select>

                            @error('category_id')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="image" class="form-label">Gambar<span class="text-danger">*</span></label>
                            <input type="file" name="image" id="image" onchange="previewImage(this)"
                                class="form-control @error('image')
                    is-invalid
                @enderror">

                            @error('image')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror

                            <!-- kasih style biar rapi -->
                            <img id="imagePreview" src="" alt="Preview"
                                style="max-width: 200px; margin-top: 10px; display: none;">
                        </div>

                        <div class="mb-3">
                            <label for="content" class="form-label">Kontent</label>
                            <textarea name="content" id="content" cols="30" rows="10"
                                class="form-control @error('content')
                                is-invalid
                            @enderror">{{ old('content') }}</textarea>

                            @error('content')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="tags" class="form-label">Tags Konten</label>
                            <input id="tags" class="form-control" name="tags"
                                placeholder="Ketik lalu tekan enter/koma" />
                        </div>

                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select name="status" id="status"
                                class="form-control @error('status')
                                is-invalid
                            @enderror">

                                <option value="" hidden>-- Pilih --</option>
                                <option value="publish" {{ old('status' === 'publish' ? 'selected' : '') }}>Publish
                                </option>
                                <option value="draft" {{ old('status' === 'draft' ? 'selected' : '') }}>Draft</option>
                            </select>

                            @error('status')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="text-end">
                            <button type="reset" class="btn btn-warning btn-sm ">Reset</button>
                            <button type="submit" class="btn btn-primary btn-sm ">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        function previewImage(input) {
            const preview = document.getElementById('imagePreview');

            if (input.files && input.files[0]) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = "block"; // tampilkan setelah ada file
                }

                reader.readAsDataURL(input.files[0]);
            } else {
                preview.src = "";
                preview.style.display = "none";
            }
        }
    </script>

    {{-- CK EDITOR --}}
    <script src="https://cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('content');
    </script>

    {{-- Tagify --}}
    <script>
        // aktifkan tagify
        new Tagify(document.querySelector('#tags'));
    </script>
@endpush
