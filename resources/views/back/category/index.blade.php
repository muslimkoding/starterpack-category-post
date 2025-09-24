@extends('back.template')

@section('title', 'Categories')

@section('breadcrumb')
    <div class="container-fluid px-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb my-0">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a>
                </li>
                <li class="breadcrumb-item active"><span>Categories</span>
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
            <div class="">List Data</div>
            <a href="{{ route('category.create') }}" class="btn btn-sm btn-primary"><i
                class="fa-solid fa-square-plus"></i></a>
          </div>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table border mb-0">
              <thead class="fw-semibold text-nowrap">
                <tr class="align-middle">
                  <th class="bg-body-secondary ">No</th>
                  <th class="bg-body-secondary">Nama Kategori</th>
                  <th class="bg-body-secondary ">Slug</th>
                  <th class="bg-body-secondary">Aksi</th>
                </tr>
              </thead>
              <tbody>
                @forelse ($categories as $item)
                <tr class="align-middle">
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->slug }}</td>
                    <td>
                      <a href="{{ route('category.edit', $item->id) }}" class="btn btn-sm btn-primary"><i class="fa-solid fa-pen-to-square"></i></a>

                      <form id="delete-form-{{ $item->id }}" action="{{ route('category.destroy', $item->id) }}"
                        method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="button" onclick="confirmDelete({{ $item->id }})" class="btn btn-sm btn-danger text-white">
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