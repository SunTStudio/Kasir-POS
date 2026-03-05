@extends('layouts.main')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Detail Area</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('area') }}">Area</a></li>
        <li class="breadcrumb-item active">Detail</li>
    </ol>

    <div class="card mb-4" style="max-width: 600px;">
        <div class="card-header">
            <i class="fas fa-info-circle me-1"></i> Informasi Area
        </div>
        <div class="card-body">
            <table class="table table-borderless">
                <tr>
                    <th style="width: 150px;">Nama Area</th>
                    <td>: {{ $area->name }}</td>
                </tr>
                <tr>
                    <th>Dibuat Pada</th>
                    <td>: {{ $area->created_at ? $area->created_at->format('d M Y H:i') : '-' }}</td>
                </tr>
                <tr>
                    <th>Terakhir Update</th>
                    <td>: {{ $area->updated_at ? $area->updated_at->format('d M Y H:i') : '-' }}</td>
                </tr>
            </table>
            <hr>
            <a href="{{ route('area') }}" class="btn btn-secondary"><i class="fas fa-arrow-left me-1"></i> Kembali</a>
            <a href="{{ route('area.edit', $area->id) }}" class="btn btn-warning text-white"><i class="fas fa-edit me-1"></i> Edit</a>
        </div>
    </div>
</div>
@endsection
