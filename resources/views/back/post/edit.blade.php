@extends('back.template')

@push('meta')
    <script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.css">
@endpush

@section('title', 'Posts Edit')

@section('breadcrumb')
    <div class="container-fluid px-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb my-0">
                <li class="breadcrumb-item"><a href="#">Home</a>
                </li>
                <li class="breadcrumb-item active"><span>Posts Edit</span>
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
                        <button onclick="window.history.back()" class="btn btn-sm btn-primary"><i class="fa-solid fa-reply"></i> Kembali</button>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('post.update', $post->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        

                        <div class="mb-3">
                            <label for="title" class="form-label">Judul Konten<span class="text-danger">*</span></label>
                            <input type="text" name="title" placeholder="Tuliskan judul kontent"
                                class="form-control @error('title')
                    is-invalid
                @enderror"
                                value="{{ old('title', $post->title) }}">

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
                                        {{ $item->id === old('category_id', $post->category_id) ? 'selected' : '' }}>{{ $item->name }}
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
                            <img id="imagePreview" src="{{ asset('storage/' . $post->image) }}" alt="Preview"
                                style="max-width: 200px; margin-top: 10px; display: none;">

                                <p class="mt-3">Gambar eksisting :</p>
                                <img style="max-width: 200px; margin-top: 10px;" class="img-fluid" src="{{ asset('storage/' . $post->image) }}" alt="">
                        </div>

                        <div class="mb-3">
                            <label for="content" class="form-label">Kontent</label>
                            <textarea name="content" id="content" cols="30" rows="10"
                                class="form-control @error('content')
                                is-invalid
                            @enderror">{{ old('content', $post->content) }}</textarea>

                            @error('content')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="tags" class="form-label">Tags Konten</label>
                            <input id="tags" class="form-control" name="tags" value="@foreach(json_decode($post->tags, true) as $tag){{ $tag['value'] }},@endforeach" placeholder="Ketik lalu tekan enter/koma"/>
                        </div>

                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select name="status" id="status" class="form-control @error('status')
                                is-invalid
                            @enderror">
                            
                            <option value="" hidden>-- Pilih --</option>
                            <option value="publish" {{ old('status', $post->status === 'publish' ? 'selected' : '') }}>Publish</option>
                            <option value="draft" {{ old('status', $post->status === 'draft' ? 'selected' : '') }}>Draft</option>
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

{{-- client side tombol back --}}
<script>
    function goBack() {
        window.history.back();
    }
</script>
@endpush
