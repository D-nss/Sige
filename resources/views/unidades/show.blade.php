@extends('layouts.app')

@section('title', 'Detalhes da Unidade: ' . $unidade->nome)

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">
<div id="c_1" class="card border shadow-0 mb-g shadow-sm-hover" data-filter-tags="oliver kopyov">
    <div class="card-body border-faded border-top-0 border-left-0 border-right-0 rounded-top">
        <div class="d-flex flex-row align-items-center">
            <span class="status status-success mr-3">
                <span class="rounded-circle profile-image d-block " style="background-image:url('img/demo/avatars/avatar-b.png'); background-size: cover;"></span>
            </span>
            <div class="info-card-text flex-1">
                <a href="javascript:void(0);" class="fs-xl text-truncate text-truncate-lg text-info" data-toggle="dropdown" aria-expanded="false">
                    {{ $unidade->nome }}
                    <i class="fal fa-angle-down d-inline-block ml-1 fs-md"></i>
                </a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="#">Send Email</a>
                    <a class="dropdown-item" href="#">Create Appointment</a>
                    <a class="dropdown-item" href="#">Block User</a>
                </div>
                <span class="text-truncate text-truncate-xl"> {{ $unidade }}</span>
            </div>
            <button class="js-expand-btn btn btn-sm btn-default d-none waves-effect waves-themed" data-toggle="collapse" data-target="#c_1 > .card-body + .card-body" aria-expanded="false">
                <span class="collapsed-hidden">+</span>
                <span class="collapsed-reveal">-</span>
            </button>
        </div>
    </div>
    <div class="card-body p-0 collapse show">
        <div class="p-3">
            <a href="tel:+13174562564" class="mt-1 d-block fs-sm fw-400 text-dark">
                <i class="fas fa-mobile-alt text-muted mr-2"></i> +1 317-456-2564</a>
            <a href="mailto:oliver.kopyov@smartadminwebapp.com" class="mt-1 d-block fs-sm fw-400 text-dark">
                <i class="fas fa-mouse-pointer text-muted mr-2"></i> oliver.kopyov@smartadminwebapp.com</a>
            <address class="fs-sm fw-400 mt-4 text-muted">
                <i class="fas fa-map-pin mr-2"></i> 15 Charist St, Detroit, MI, 48212, USA</address>
            <div class="d-flex flex-row">
                <a href="javascript:void(0);" class="mr-2 fs-xxl" style="color:#3b5998">
                    <i class="fab fa-facebook-square"></i>
                </a>
                <a href="javascript:void(0);" class="mr-2 fs-xxl" style="color:#38A1F3">
                    <i class="fab fa-twitter-square"></i>
                </a>
                <a href="javascript:void(0);" class="mr-2 fs-xxl" style="color:#0077B5">
                    <i class="fab fa-linkedin"></i>
                </a>
            </div>
        </div>
    </div>
</div>

</div>
<!-- /.container-fluid -->

@endsection
