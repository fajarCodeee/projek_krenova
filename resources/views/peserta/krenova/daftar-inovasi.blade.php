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

    {{-- table --}}

    <div class="card">
        <div class="card-header">
            <div class="ms-auto d-flex justify-content-between align-items-center">
                <h6 class="mb-0 text-uppercase">{{ $title_page }}</h6>

                <div class="btn-group">
                    <a href="{{ route('peserta.krenova.create.daftar-inovasi') }}"
                        class="btn btn-primary d-flex align-items-center p-3 p-md-2"><i class='bx bx-plus-circle'></i>
                        <span class="d-none d-md-block">Buat Inovasi</span>
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
                            <th>Jenis Peserta</th>
                            <th>Tanggal dibuat </th>
                            <th>Status</th>
                            <th>Ket</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($inovasi as $key => $list)
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td>{{ $list->innovation_title }}</td>
                                <td>{{ $list->participant_category }}</td>
                                <td>{{ \Carbon\Carbon::parse($list->created_at)->translatedFormat('d F Y') }}</td>
                                <td>{{ $list->status == 1 ? 'Menunggu Konfirmasi' : '' }}
                                    @if ($list->status == 1)
                                        Menunggu Konfirmasi
                                    @elseif ($list->status == 2)
                                        Dilombakan
                                    @else
                                        Meminta Revisi
                                    @endif
                                </td>
                                <td>{{ $list->information }}</td>
                                <td>
                                    <a href="{{ route('peserta.krenova.show.daftar-inovasi', ['id' => $list->id]) }}"
                                        class="btn btn-sm btn-secondary"><i class='bx bx-show-alt'></i>Detail</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">Not Found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    {{-- ./table --}}
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
