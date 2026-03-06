@extends('layouts.main')

@section('content')
    <div class="container-fluid px-4">
        {{-- <h1 class="mt-4">Manajemen Area</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Area</li>
    </ol> --}}

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div><i class="fas fa-map-marker-alt me-1"></i> Data Area</div>
                {{-- kembali ke meja --}}
                <div class="">
                    <a href="{{ route('manajement.meja') }}" class="btn btn-outline-secondary btn-sm me-2">
                        <i class="fas fa-arrow-left me-1"></i> Kembali ke Meja
                    </a>
                    <a href="{{ route('area.create') }}" class="btn btn-outline-primary btn-sm"><i class="fas fa-plus me-1"></i>
                        Tambah Area</a>
                </div>
            </div>
            <div class="card-body">
                <table id="datatablesSimple" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th style="width: 50px;">No</th>
                            <th>Nama Area</th>
                            <th style="width: 150px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($areas as $index => $area)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $area->name }}</td>
                                <td>
                                    <a href="{{ route('area.show', $area->id) }}" class="btn btn-info btn-sm text-white"
                                        title="Lihat"><i class="fas fa-eye"></i></a>
                                    <a href="{{ route('area.edit', $area->id) }}" class="btn btn-warning btn-sm text-white"
                                        title="Edit"><i class="fas fa-edit"></i></a>
                                    <a href="{{ route('area.delete', $area->id) }}" class="btn btn-danger btn-sm"
                                        onclick="return confirm('Yakin ingin menghapus area ini?')" title="Hapus"><i
                                            class="fas fa-trash"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"
        crossorigin="anonymous"></script>
    <script>
        window.addEventListener('DOMContentLoaded', event => {
            const datatablesSimple = document.getElementById('datatablesSimple');
            if (datatablesSimple) {
                new simpleDatatables.DataTable(datatablesSimple);
            }
        });
    </script>
@endsection
