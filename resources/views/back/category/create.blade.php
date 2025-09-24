@extends('back.template')

@section('title', 'Category Create')

@section('breadcrumb')
  <div class="container-fluid px-4">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb my-0">
        <li class="breadcrumb-item"><a href="#">Home</a>
        </li>
        <li class="breadcrumb-item active"><span>Categories Create</span>
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
            <a href="{{ route('category.index') }}" class="btn btn-sm btn-primary"><i class="fa-solid fa-reply"></i></a>
          </div>
        </div>
        <div class="card-body">
          <form action="{{ route('category.store') }}" method="post">
            @csrf
            <div class="mb-3">
              <label for="name" class="form-label">Nama Category</label>
              <input type="text" name="name" placeholder="Tuliskan nama kategori" class="form-control @error('name')
                is-invalid
              @enderror" autofocus value="{{ old('name') }}">

              @error('name')
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
