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
    @if (session('success'))
        <div class="alert alert-success">
            {!! session('success') !!}
        </div>
    @endif

    <div class="card">
        <div class="card-header">
            <div class="ms-auto d-flex justify-content-between align-items-center">
                <h6 class="mb-0 text-uppercase">{{ $title_page }}</h6>
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
                            {{-- <th>Status</th> --}}
                            <th>Ket</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($inovasi_revisi != null)
                            @foreach ($inovasi_revisi as $key => $list)
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td>{{ $list->innovation_title }}</td>
                                    <td>{{ $list->participant_category }}</td>
                                    <td>{{ \Carbon\Carbon::parse($list->created_at)->translatedFormat('d F Y') }}</td>
                                    {{-- <td>{{ $list->status == 1 ? 'Menunggu Konfirmasi' : '' }}</td> --}}
                                    <td>{{ $list->information }}</td>
                                    <td>
                                        <a href="{{ route('peserta.krenova.edit.daftar-inovasi', ['id' => $list->id]) }}"
                                            class="btn btn-sm"><i class='bx bx-edit-alt bg-warning px-1 rounded'></i></a>
                                        <a href="{{ route('peserta.krenova.delete.draft-inovasi', ['id' => $list->id]) }}"
                                            class="btn btn-sm" data-confirm-delete="true"><i
                                                class='bx bx-trash bg-danger rounded px-1' style="color: #fff"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        @endif

                        @forelse ($inovasi_draft as $key => $list)
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td>{{ $list->innovation_title }}</td>
                                <td>{{ $list->participant_category }}</td>
                                <td>{{ \Carbon\Carbon::parse($list->created_at)->translatedFormat('d F Y') }}</td>
                                {{-- <td>{{ $list->status == 1 ? 'Menunggu Konfirmasi' : '' }}</td> --}}
                                <td>{{ $list->information }}</td>
                                <td>
                                    <a href="{{ route('peserta.krenova.edit.daftar-inovasi', ['id' => $list->id]) }}"
                                        class="btn btn-sm"><i class='bx bx-edit-alt bg-warning px-1 rounded'></i></a>
                                    <a href="{{ route('peserta.krenova.delete.draft-inovasi', ['id' => $list->id]) }}"
                                        class="btn btn-sm" data-confirm-delete="true"><i
                                            class='bx bx-trash bg-danger rounded px-1' style="color: #fff"></i></a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">Not Found</td>
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
    @include('sweetalert::alert')
@endpush
