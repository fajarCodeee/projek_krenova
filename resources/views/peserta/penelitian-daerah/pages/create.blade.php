@extends('peserta.layout')
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

    @livewire('penelitian-daerah.form-create', [
        'title_page' => $title_page,
        'form_id' => $form_id ?? null,
    ])
@endsection
