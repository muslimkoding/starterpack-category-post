@extends('back.template')

@section('title', 'Dashboard')

@section('breadcrumb')
<div class="container-fluid px-4">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb my-0">
        <li class="breadcrumb-item"><a href="#">Home</a>
        </li>
        <li class="breadcrumb-item active"><span>Dashboard</span>
        </li>
      </ol>
    </nav>
  </div>
@endsection

@section('content')
    <h1>Dashboard</h1>
@endsection