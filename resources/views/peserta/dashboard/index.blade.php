@extends('peserta.layout')
@section('content')
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Dashboard</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    {{-- <li class="breadcrumb-item active" aria-current="page">Calendar</li> --}}
                </ol>
            </nav>
        </div>
    </div>

    {{-- stats --}}
    <div class="row row-cols-1 row-cols-lg-3">
        <div class="col">
            <div class="card radius-10">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <p class="mb-0">Sessions</p>
                            <h4 class="font-weight-bold">32,842 <small class="text-success font-13">(+40%)</small></h4>
                            <p class="text-success mb-0 font-13">Analytics for last week</p>
                        </div>
                        <div class="widgets-icons bg-gradient-cosmic text-white"><i class='bx bx-refresh'></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card radius-10">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <p class="mb-0">Users</p>
                            <h4 class="font-weight-bold">16,352 <small class="text-success font-13">(+22%)</small></h4>
                            <p class="text-secondary mb-0 font-13">Analytics for last week</p>
                        </div>
                        <div class="widgets-icons bg-gradient-burning text-white"><i class='bx bx-group'></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card radius-10">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <p class="mb-0">Time on Site</p>
                            <h4 class="font-weight-bold">34m 14s <small class="text-success font-13">(+55%)</small></h4>
                            <p class="text-secondary mb-0 font-13">Analytics for last week</p>
                        </div>
                        <div class="widgets-icons bg-gradient-lush text-white"><i class='bx bx-time'></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card radius-10">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <p class="mb-0">Goal Completions</p>
                            <h4 class="font-weight-bold">1,94,2335</h4>
                            <p class="text-secondary mb-0 font-13">Analytics for last month</p>
                        </div>
                        <div class="widgets-icons bg-gradient-kyoto text-white"><i class='bx bxs-cube'></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card radius-10">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <p class="mb-0">Bounce Rate</p>
                            <h4 class="font-weight-bold">58% <small class="text-danger font-13">(-16%)</small></h4>
                            <p class="text-secondary mb-0 font-13">Analytics for last week</p>
                        </div>
                        <div class="widgets-icons bg-gradient-blues text-white"><i class='bx bx-line-chart'></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card radius-10">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <p class="mb-0">New Sessions</p>
                            <h4 class="font-weight-bold">96% <small class="text-danger font-13">(+54%)</small></h4>
                            <p class="text-secondary mb-0 font-13">Analytics for last week</p>
                        </div>
                        <div class="widgets-icons bg-gradient-moonlit text-white"><i class='bx bx-bar-chart'></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
