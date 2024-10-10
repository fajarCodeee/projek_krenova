@extends('peserta.layout')

@push('css')
    <link href="{{ asset('assets') }}/plugins/datatable/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
@endpush

@section('content')
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">{{ $title ?? config('app.name') }}</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $title_page ?? '' }}</li>
                </ol>
            </nav>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success">
            {!! session('success') !!}
        </div>
    @endif

    <div class="card">
        <div class="card-header">
            <div class="ms-auto d-flex justify-content-between align-items-center">
                <h6 class="mb-0 text-uppercase">{{ $title_page }}</h6>

                <div class="btn-group">
                    <a href="{{ route('peserta.penelitian.create.daftar-penelitian-daerah') }}"
                        class="btn btn-primary d-flex align-items-center p-3 p-md-2"><i class='bx bx-plus-circle'></i>
                        <span class="d-none d-md-block">Tambah Penelitian</span>
                    </a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive p-2">
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Judul Inovasi</th>
                            <th>Institusi</th>
                            <th>Lokasi Riset</th>
                            <th>Tanggal dibuat </th>
                            <th>Status</th>
                            <th>Ket</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        {{-- @dd($daftar_penelitian) --}}
                        @forelse ($daftar_penelitian as $penelitian)
                            <tr>
                                <td>
                                    {{ $loop->iteration }}
                                </td>

                                <td>{{ $penelitian->research_title }}</td>
                                <td>{{ $penelitian->institution }}</td>
                                <td>{{ $penelitian->research_location }}</td>
                                <td>{{ \Carbon\Carbon::parse($penelitian->created_at)->translatedFormat('d F Y') }}</td>
                                <td>{{ $penelitian->status == '1' ? 'Menunggu Konfimasi' : 'Meminta Revisi' }}</td>
                                <td>{{ $penelitian->information }}</td>
                                <td>
                                    <a href="{{ route('peserta.penelitian.show.daftar-penelitian-daerah', ['id' => $penelitian->id]) }}"
                                        class="btn btn-sm {{ $penelitian->status == '3' ? 'btn-warning' : 'btn-secondary' }}">{{ $penelitian->status == '3' ? 'Edit' : 'Detail' }}</a>
                                    <a href="#" class="btn btn-sm btn-danger">Delete</a>
                                </td>
                            </tr>
                        @empty
                        @endforelse
                    </tbody>

                </table>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script src="{{ asset('assets') }}/plugins/datatable/js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('assets') }}/plugins/datatable/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        });
    </script>
    <script>
        $(document).ready(function() {
            var table = $('#example2').DataTable({
                lengthChange: false,
                buttons: ['copy', 'excel', 'pdf', 'print']
            });

            table.buttons().container()
                .appendTo('#example2_wrapper .col-md-6:eq(0)');
        });
    </script>
@endpush
