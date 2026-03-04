@extends('layouts.main')

@section('content')
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show rounded-3" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card border-0 shadow-sm rounded">
        <div class="card-body p-0">
            <div class="d-flex justify-content-between align-items-center m-4">
                <h5 class="fw-bold text-dark mb-0">Manajemen Status Order</h5>
                <a href="{{ route('jenis.create') }}" class="btn btn-primary rounded-3 px-4">
                    <i class="bi bi-plus-lg me-1"></i> Tambah Status
                </a>
            </div>
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0" id="datatables">
                    <thead class="bg-light">
                        <tr>
                            <th class="ps-4 py-3" style="width: 50px;">No</th>
                            <th class="py-3">Nama Status</th>
                            <th class="pe-4 py-3 text-end" style="width: 200px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($jenis as $item)
                            <tr>
                                <td class="ps-4 fw-bold">{{ $loop->iteration }}</td>
                                <td>
                                    <p> {{ $item->name }} </p>
                                </td>
                                <td class="pe-4 text-end">
                                    <a href="{{ route('jenis.edit', $item->id) }}"
                                        class="btn btn-sm btn-warning text-white rounded-3 me-1">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <a href="{{ route('jenis.delete', $item->id) }}" class="btn btn-sm btn-danger rounded-3"
                                        onclick="return confirm('Yakin ingin menghapus status ini?')">
                                        <i class="bi bi-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center py-5 text-muted">Belum ada data status order.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('script')
    {{-- dataTables JS --}}
    <script>
        $(document).ready(function() {
            $('#datatables').DataTable({
                responsive: true,
                language: {
                    search: "_INPUT_",
                    searchPlaceholder: "Cari status...",
                    lengthMenu: "_MENU_ data per halaman",
                    zeroRecords: "Data tidak ditemukan",
                    info: "Menampilkan halaman _PAGE_ dari _PAGES_",
                    infoEmpty: "Tidak ada data tersedia",
                    infoFiltered: "(difilter dari _MAX_ total data)",
                    paginate: {
                        first: "Pertama",
                        last: "Terakhir",
                        next: '<i class="bi bi-chevron-right"></i>',
                        previous: '<i class="bi bi-chevron-left"></i>'
                    }
                },
                dom: '<"d-flex justify-content-between align-items-center p-3"<"text-muted"l><"text-muted"f>>rt<"d-flex justify-content-between align-items-center p-3"<"text-muted"i><"pagination-sm"p>>',
            });
        });
    </script>
@endsection
