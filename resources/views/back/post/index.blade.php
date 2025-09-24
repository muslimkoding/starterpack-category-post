@extends('back.template')

@section('title', 'Post')

@section('breadcrumb')
    <div class="container-fluid px-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb my-0">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a>
                </li>
                <li class="breadcrumb-item active"><span>Post</span>
                </li>
            </ol>
        </nav>
    </div>
@endsection

@section('content')
    {{-- <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <div class="">List Data</div>
                        <a href="{{ route('post.create') }}" class="btn btn-sm btn-primary"><i
                                class="fa-solid fa-square-plus"></i></a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="category_filter" class="form-label">Kategori</label>
                                <select name="category_filter" id="category_filter" class="form-control">
                                    <option value="" hidden>-- Pilih --</option>
                                    @foreach ($categories as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="status_filter" class="form-label">Status</label>
                                    <select name="status_filter" id="status_filter" class="form-control">
                                        <option value="" hidden>-- Pilih --</option>
                                        <option value="publish">Publish</option>
                                        <option value="draft">Draft</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <table class="table border mb-0">
                            <thead class="fw-semibold text-nowrap">
                                <tr class="align-middle">
                                    <th class="bg-body-secondary ">No</th>
                                    <th class="bg-body-secondary">Judul Konten</th>
                                    <th class="bg-body-secondary ">Slug</th>
                                    <th class="bg-body-secondary ">Kategori</th>
                                    <th class="bg-body-secondary ">Status</th>
                                    <th class="bg-body-secondary ">Tags</th>
                                    <th class="bg-body-secondary">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($posts as $item)
                                    <tr class="align-middle">
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->title }}</td>
                                        <td>{{ $item->slug }}</td>
                                        <td>{{ $item->category->name }}</td>
                                        <td>
                                            @if ($item->status === 'publish')
                                            <span class="badge bg-primary">{{ $item->status }}</span>
                                            @else
                                            <span class="badge bg-warning">{{ $item->status }}</span>
                                                
                                            @endif
                                        </td>
                                        <td>
                                            @foreach (json_decode($item->tags, true) as $tag)
                                                <span class="badge bg-secondary">{{ $tag['value'] }}</span>
                                            @endforeach
                                        </td>
                                        <td>
                                            <a href="{{ route('post.edit', $item->id) }}" class="btn btn-sm btn-primary"><i
                                                    class="fa-solid fa-pen-to-square"></i></a>

                                            <form id="delete-form-{{ $item->id }}"
                                                action="{{ route('post.destroy', $item->id) }}" method="POST"
                                                style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" onclick="confirmDelete({{ $item->id }})"
                                                    class="btn btn-sm btn-danger text-white">
                                                    <i class="fa-solid fa-trash-can"></i>
                                                </button>
                                            </form>
                                        </td>

                                    </tr>
                                @empty
                                    <div class="alert alert-warning">
                                        Belum ada data
                                    </div>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}

    {{-- <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="">List Data</div>
                        <a href="{{ route('post.create') }}" class="btn btn-sm btn-primary">
                            <i class="fa-solid fa-square-plus"></i> Tambah
                        </a>
                    </div>
                </div>
                <div class="card-body">


                    <form id="filter-form" method="GET" action="{{ route('post.index') }}">
                        <div class="row mb-4">
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="search" class="form-label">Pencarian</label>
                                    <input type="text" name="search" id="search" class="form-control" 
                                           placeholder="Cari judul..." value="{{ request('search') }}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="category_filter" class="form-label">Kategori</label>
                                    <select name="category_filter" id="category_filter" class="form-control">
                                        <option value="">-- Semua Kategori --</option>
                                        @foreach ($categories as $item)
                                            <option value="{{ $item->id }}" 
                                                {{ request('category_filter') == $item->id ? 'selected' : '' }}>
                                                {{ $item->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="status_filter" class="form-label">Status</label>
                                    <select name="status_filter" id="status_filter" class="form-control">
                                        <option value="">-- Semua Status --</option>
                                        <option value="publish" {{ request('status_filter') == 'publish' ? 'selected' : '' }}>Publish</option>
                                        <option value="draft" {{ request('status_filter') == 'draft' ? 'selected' : '' }}>Draft</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="" class="form-label">Aksi</label>
                                    <div class="">
                                        <button type="submit" class="btn btn-primary me-2">
                                            <i class="fa-solid fa-filter"></i> Filter
                                        </button>
                                        <a href="{{ route('post.index') }}" class="btn btn-secondary">
                                            <i class="fa-solid fa-refresh"></i> Reset
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
    
                    <div class="table-responsive">
                        <table class="table border mb-0">
                            <thead class="fw-semibold text-nowrap">
                                <tr class="align-middle">
                                    <th class="bg-body-secondary text-center">No</th>
                                    <th class="bg-body-secondary">Judul Konten</th>
                                    <th class="bg-body-secondary">Slug</th>
                                    <th class="bg-body-secondary">Kategori</th>
                                    <th class="bg-body-secondary">Status</th>
                                    <th class="bg-body-secondary">Tags</th>
                                    <th class="bg-body-secondary">Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="posts-table-body">
                                @forelse ($posts as $item)
                                    <tr class="align-middle">
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td>{{ $item->title }}</td>
                                        <td>{{ $item->slug }}</td>
                                        <td>{{ $item->category->name }}</td>
                                        <td>
                                            @if ($item->status === 'publish')
                                                <span class="badge bg-primary">{{ $item->status }}</span>
                                            @else
                                                <span class="badge bg-warning">{{ $item->status }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($item->tags)
                                                @foreach (json_decode($item->tags, true) as $tag)
                                                    <span class="badge bg-secondary">{{ $tag['value'] }}</span>
                                                @endforeach
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('post.edit', $item->id) }}" class="btn btn-sm btn-primary">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </a>
    
                                            <form id="delete-form-{{ $item->id }}"
                                                action="{{ route('post.destroy', $item->id) }}" method="POST"
                                                style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" onclick="confirmDelete({{ $item->id }})"
                                                    class="btn btn-sm btn-danger text-white">
                                                    <i class="fa-solid fa-trash-can"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center">
                                            <div class="alert alert-warning mb-0">
                                                Belum ada data
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}

    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="">List Data</div>
                        <a href="{{ route('post.create') }}" class="btn btn-sm btn-primary">
                            <i class="fa-solid fa-square-plus"></i> Tambah
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    {{-- Filter dan Pencarian Form --}}
                    <form id="filter-form" method="GET" action="{{ route('post.index') }}">
                        <div class="row mb-4">
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="search" class="form-label">Pencarian</label>
                                    <input type="text" name="search" id="search" class="form-control" 
                                           placeholder="Cari judul..." value="{{ request('search') }}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="category_filter" class="form-label">Kategori</label>
                                    <select name="category_filter" id="category_filter" class="form-control">
                                        <option value="">-- Semua Kategori --</option>
                                        @foreach ($categories as $item)
                                            <option value="{{ $item->id }}" 
                                                {{ request('category_filter') == $item->id ? 'selected' : '' }}>
                                                {{ $item->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="status_filter" class="form-label">Status</label>
                                    <select name="status_filter" id="status_filter" class="form-control">
                                        <option value="">-- Semua Status --</option>
                                        <option value="publish" {{ request('status_filter') == 'publish' ? 'selected' : '' }}>Publish</option>
                                        <option value="draft" {{ request('status_filter') == 'draft' ? 'selected' : '' }}>Draft</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3 d-flex align-items-end" style="height: 100%;">
                                    <button type="submit" class="btn btn-primary me-2">
                                        <i class="fa-solid fa-filter"></i> Filter
                                    </button>
                                    <a href="{{ route('post.index') }}" class="btn btn-secondary">
                                        <i class="fa-solid fa-refresh"></i> Reset
                                    </a>
                                </div>
                            </div>
                        </div>
                    </form>
    
                    <div class="table-responsive">
                        <table class="table border mb-0">
                            <thead class="fw-semibold text-nowrap">
                                <tr class="align-middle">
                                    <th class="bg-body-secondary">No</th>
                                    <th class="bg-body-secondary">Judul Konten</th>
                                    <th class="bg-body-secondary">Slug</th>
                                    <th class="bg-body-secondary">Kategori</th>
                                    <th class="bg-body-secondary">Status</th>
                                    <th class="bg-body-secondary">Tags</th>
                                    <th class="bg-body-secondary">Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="posts-table-body">
                                @forelse ($posts as $item)
                                    <tr class="align-middle">
                                        <td>{{ ($posts->currentPage() - 1) * $posts->perPage() + $loop->iteration }}</td>
                                        <td>{{ $item->title }}</td>
                                        <td>{{ $item->slug }}</td>
                                        <td>{{ $item->category->name }}</td>
                                        <td>
                                            @if ($item->status === 'publish')
                                                <span class="badge bg-primary">{{ $item->status }}</span>
                                            @else
                                                <span class="badge bg-warning">{{ $item->status }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($item->tags)
                                                @foreach (json_decode($item->tags, true) as $tag)
                                                    <span class="badge bg-secondary">{{ $tag['value'] }}</span>
                                                @endforeach
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('post.edit', $item->id) }}" class="btn btn-sm btn-primary">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </a>
    
                                            <form id="delete-form-{{ $item->id }}"
                                                action="{{ route('post.destroy', $item->id) }}" method="POST"
                                                style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" onclick="confirmDelete({{ $item->id }})"
                                                    class="btn btn-sm btn-danger text-white">
                                                    <i class="fa-solid fa-trash-can"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center">
                                            <div class="alert alert-warning mb-0">
                                                Belum ada data
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
    
                    {{-- Pagination --}}
                    <div id="pagination-container" class="d-flex justify-content-between align-items-center mt-3">
                        <div class="text-muted">
                            Menampilkan {{ $posts->firstItem() }} sampai {{ $posts->lastItem() }} dari {{ $posts->total() }} data
                        </div>
                        <nav>
                            {{ $posts->links() }}
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    


@endsection

@push('js')
    {{-- sweet alert --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @include('sweetalert2::index')

    <script>
        function confirmDelete(id) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data yang dihapus tidak dapat dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + id).submit();
                }
            });
        }
    </script>
@endpush
