@extends('layouts.app')

@section('title', 'Detalhes do Papel: ' . $role->name)

@section('content')
<!-- BEGIN Page Content -->
                    <!-- the #js-page-content id is needed for some plugins to initialize -->
                    <main id="js-page-content" role="main" class="page-content">
                        <ol class="breadcrumb page-breadcrumb">
                            <li class="breadcrumb-item"><a href="/usuarios">Papeis</a></li>
                            <li class="breadcrumb-item">Detalhes Papel</li>
                            <li class="breadcrumb-item active">{{$role->name}}</li>
                            <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
                        </ol>
                        <div class="subheader">
                            <h1 class="subheader-title">
                                <i class='subheader-icon fal fa-plus-circle'></i> {{$role->name}}
                                <small>
                                    Detalhes do papel
                                </small>
                            </h1>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-xl-3 order-lg-1 order-xl-1">
                                <!-- profile summary -->
                                <div class="card mb-g rounded-top">
                                    <div class="row no-gutters row-grid">
                                        <div class="col-12">
                                            <div class="d-flex flex-column align-items-center justify-content-center p-4">
                                                <span class="fa-5x d-inline l-h-n">
                                                    <i class="fal fa-user"></i>
                                                </span>
                                                <h5 class="mb-0 fw-700 text-center mt-3">
                                                    {{$role->name}}
                                                    <small class="text-muted mb-0">{{$role->name}}</small>
                                                </h5>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="p-3 text-center">
                                                <a href="javascript:void(0);" class="btn-link font-weight-bold">{{$role->name}}</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- photos
                                <div class="card mb-g">
                                    <div class="row row-grid no-gutters">
                                        <div class="col-12">
                                            <div class="p-3">
                                                <h2 class="mb-0 fs-xl">
                                                    Photos
                                                </h2>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <a href="javascript:void(0);" class="text-center px-3 py-4 d-flex position-relative height-10 border">
                                                <span class="position-absolute pos-top pos-left pos-right pos-bottom" style="background-image: url('img/demo/gallery/thumb/1.jpg');background-size: cover;"></span>
                                            </a>
                                        </div>
                                        <div class="col-4">
                                            <a href="javascript:void(0);" class="text-center px-3 py-4 d-flex position-relative height-10 border">
                                                <span class="position-absolute pos-top pos-left pos-right pos-bottom" style="background-image: url('img/demo/gallery/thumb/2.jpg');background-size: cover;"></span>
                                            </a>
                                        </div>
                                        <div class="col-4">
                                            <a href="javascript:void(0);" class="text-center px-3 py-4 d-flex position-relative height-10 border">
                                                <span class="position-absolute pos-top pos-left pos-right pos-bottom" style="background-image: url('img/demo/gallery/thumb/3.jpg');background-size: cover;"></span>
                                            </a>
                                        </div>
                                        <div class="col-4">
                                            <a href="javascript:void(0);" class="text-center px-3 py-4 d-flex position-relative height-10 border">
                                                <span class="position-absolute pos-top pos-left pos-right pos-bottom" style="background-image: url('img/demo/gallery/thumb/4.jpg');background-size: cover;"></span>
                                            </a>
                                        </div>
                                        <div class="col-4">
                                            <a href="javascript:void(0);" class="text-center px-3 py-4 d-flex position-relative height-10 border">
                                                <span class="position-absolute pos-top pos-left pos-right pos-bottom" style="background-image: url('img/demo/gallery/thumb/5.jpg');background-size: cover;"></span>
                                            </a>
                                        </div>
                                        <div class="col-4">
                                            <a href="javascript:void(0);" class="text-center px-3 py-4 d-flex position-relative height-10 border">
                                                <span class="position-absolute pos-top pos-left pos-right pos-bottom" style="background-image: url('img/demo/gallery/thumb/6.jpg');background-size: cover;"></span>
                                            </a>
                                        </div>
                                        <div class="col-4">
                                            <a href="javascript:void(0);" class="text-center px-3 py-4 d-flex position-relative height-10 border">
                                                <span class="position-absolute pos-top pos-left pos-right pos-bottom" style="background-image: url('img/demo/gallery/thumb/7.jpg');background-size: cover;"></span>
                                            </a>
                                        </div>
                                        <div class="col-4">
                                            <a href="javascript:void(0);" class="text-center px-3 py-4 d-flex position-relative height-10 border">
                                                <span class="position-absolute pos-top pos-left pos-right pos-bottom" style="background-image: url('img/demo/gallery/thumb/8.jpg');background-size: cover;"></span>
                                            </a>
                                        </div>
                                        <div class="col-4">
                                            <a href="javascript:void(0);" class="text-center px-3 py-4 d-flex position-relative height-10 border">
                                                <span class="position-absolute pos-top pos-left pos-right pos-bottom" style="background-image: url('img/demo/gallery/thumb/9.jpg');background-size: cover;"></span>
                                            </a>
                                        </div>
                                        <div class="col-12">
                                            <div class="p-3 text-center">
                                                <a href="javascript:void(0);" class="btn-link font-weight-bold">View all</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- contacts
                                <div class="card mb-g">
                                    <div class="row row-grid no-gutters">
                                        <div class="col-12">
                                            <div class="p-3">
                                                <h2 class="mb-0 fs-xl">
                                                    Contacts
                                                </h2>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <a href="javascript:void(0);" class="text-center p-3 d-flex flex-column hover-highlight">
                                                <span class="profile-image rounded-circle d-block m-auto" style="background-image:url('img/demo/avatars/avatar-b.png'); background-size: cover;"></span>
                                                <span class="d-block text-truncate text-muted fs-xs mt-1">Oliver Kopyov</span>
                                            </a>
                                        </div>
                                        <div class="col-4">
                                            <a href="javascript:void(0);" class="text-center p-3 d-flex flex-column hover-highlight">
                                                <span class="profile-image rounded-circle d-block m-auto" style="background-image:url('img/demo/avatars/avatar-c.png'); background-size: cover;"></span>
                                                <span class="d-block text-truncate text-muted fs-xs mt-1">Sesha Gray</span>
                                            </a>
                                        </div>
                                        <div class="col-4">
                                            <a href="javascript:void(0);" class="text-center p-3 d-flex flex-column hover-highlight">
                                                <span class="profile-image rounded-circle d-block m-auto" style="background-image:url('img/demo/avatars/avatar-a.png'); background-size: cover;"></span>
                                                <span class="d-block text-truncate text-muted fs-xs mt-1">Preny Amdaney</span>
                                            </a>
                                        </div>
                                        <div class="col-4">
                                            <a href="javascript:void(0);" class="text-center p-3 d-flex flex-column hover-highlight">
                                                <span class="profile-image rounded-circle d-block m-auto" style="background-image:url('img/demo/avatars/avatar-e.png'); background-size: cover;"></span>
                                                <span class="d-block text-truncate text-muted fs-xs mt-1">Dr. John Cook PhD</span>
                                            </a>
                                        </div>
                                        <div class="col-4">
                                            <a href="javascript:void(0);" class="text-center p-3 d-flex flex-column hover-highlight">
                                                <span class="profile-image rounded-circle d-block m-auto" style="background-image:url('img/demo/avatars/avatar-h.png'); background-size: cover;"></span>
                                                <span class="d-block text-truncate text-muted fs-xs mt-1">Sarah McBrook</span>
                                            </a>
                                        </div>
                                        <div class="col-4">
                                            <a href="javascript:void(0);" class="text-center p-3 d-flex flex-column hover-highlight">
                                                <span class="profile-image rounded-circle d-block m-auto" style="background-image:url('img/demo/avatars/avatar-i.png'); background-size: cover;"></span>
                                                <span class="d-block text-truncate text-muted fs-xs mt-1">Jimmy Fellan</span>
                                            </a>
                                        </div>
                                        <div class="col-4">
                                            <a href="javascript:void(0);" class="text-center p-3 d-flex flex-column hover-highlight">
                                                <span class="profile-image rounded-circle d-block m-auto" style="background-image:url('img/demo/avatars/avatar-j.png'); background-size: cover;"></span>
                                                <span class="d-block text-truncate text-muted fs-xs mt-1">Arica Grace</span>
                                            </a>
                                        </div>
                                        <div class="col-4">
                                            <a href="javascript:void(0);" class="text-center p-3 d-flex flex-column hover-highlight">
                                                <span class="profile-image rounded-circle d-block m-auto" style="background-image:url('img/demo/avatars/avatar-k.png'); background-size: cover;"></span>
                                                <span class="d-block text-truncate text-muted fs-xs mt-1">Jim Ketty</span>
                                            </a>
                                        </div>
                                        <div class="col-4">
                                            <a href="javascript:void(0);" class="text-center p-3 d-flex flex-column hover-highlight">
                                                <span class="profile-image rounded-circle d-block m-auto" style="background-image:url('img/demo/avatars/avatar-g.png'); background-size: cover;"></span>
                                                <span class="d-block text-truncate text-muted fs-xs mt-1">Ali Grey</span>
                                            </a>
                                        </div>
                                        <div class="col-12">
                                            <div class="p-3 text-center">
                                                <a href="javascript:void(0);" class="btn-link font-weight-bold">View all</a>
                                            </div>
                                        </div>
                                    </div>
                                </div-->
                            </div>
                            <!--div class="col-lg-12 col-xl-6 order-lg-3 order-xl-2">
                                <div class="card border mb-g">
                                    <div class="card-body pl-4 pt-4 pr-4 pb-0">
                                        <div class="d-flex flex-column">
                                            <div class="border-0 flex-1 position-relative shadow-top">
                                                <div class="pt-2 pb-1 pr-0 pl-0 rounded-0 position-relative" tabindex="-1">
                                                    <span class="profile-image rounded-circle d-block position-absolute" style="background-image:url('img/demo/avatars/avatar-admin.png'); background-size: cover;"></span>
                                                    <div class="pl-5 ml-5">
                                                        <textarea class="form-control border-0 p-0 fs-xl bg-transparent" rows="4" placeholder="What's on your mind Codex?..."></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="height-8 d-flex flex-row align-items-center flex-wrap flex-shrink-0">
                                                <a href="javascript:void(0);" class="btn btn-icon fs-xl width-1 mr-1" data-toggle="tooltip" data-original-title="More options" data-placement="top">
                                                    <i class="fal fa-ellipsis-v-alt color-fusion-300"></i>
                                                </a>
                                                <a href="javascript:void(0);" class="btn btn-icon fs-xl mr-1" data-toggle="tooltip" data-original-title="Attach files" data-placement="top">
                                                    <i class="fal fa-paperclip color-fusion-300"></i>
                                                </a>
                                                <a href="javascript:void(0);" class="btn btn-icon fs-xl mr-1" data-toggle="tooltip" data-original-title="Insert photo" data-placement="top">
                                                    <i class="fal fa-camera color-fusion-300"></i>
                                                </a>
                                                <button class="btn btn-info shadow-0 ml-auto">Post</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- post comment
                                <div class="card mb-g">
                                    <div class="card-body pb-0 px-4">
                                        <div class="d-flex flex-row pb-3 pt-2  border-top-0 border-left-0 border-right-0">
                                            <div class="d-inline-block align-middle status status-success mr-3">
                                                <span class="profile-image rounded-circle d-block" style="background-image:url('img/demo/avatars/avatar-e.png'); background-size: cover;"></span>
                                            </div>
                                            <h5 class="mb-0 flex-1 text-dark fw-500">
                                                Dr. John Cook PhD
                                                <small class="m-0 l-h-n">
                                                    Human Resources & Psychiatry Division
                                                </small>
                                            </h5>
                                            <span class="text-muted fs-xs opacity-70">
                                                3 hours
                                            </span>
                                        </div>
                                        <div class="pb-3 pt-2 border-top-0 border-left-0 border-right-0 text-muted">
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
                                        </div>
                                        <div class="d-flex align-items-center demo-h-spacing py-3">
                                            <a href="javascript:void(0);" class="d-inline-flex align-items-center text-dark">
                                                <i class="fas fa-heart fs-xs mr-1 text-danger"></i> <span>2 Likes</span>
                                            </a>
                                            <a href="javascript:void(0);" class="d-inline-flex align-items-center text-dark">
                                                <i class="fal fa-comment fs-xs mr-1"></i> <span>2 Comments</span>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="card-body py-0 px-4 border-faded border-right-0 border-bottom-0 border-left-0">
                                        <div class="d-flex flex-column align-items-center">
                                            <!-- comment
                                            <div class="d-flex flex-row w-100 py-4">
                                                <div class="d-inline-block align-middle status status-sm status-success mr-3">
                                                    <span class="profile-image profile-image-md rounded-circle d-block mt-1" style="background-image:url('img/demo/avatars/avatar-c.png'); background-size: cover;"></span>
                                                </div>
                                                <div class="mb-0 flex-1 text-dark">
                                                    <div class="d-flex">
                                                        <a href="javascript:void(0);" class="text-dark fw-500">
                                                            Test name
                                                        </a><span class="text-muted fs-xs opacity-70 ml-auto">
                                                            15 minutes
                                                        </span>
                                                    </div>
                                                    <p class="mb-0">
                                                        Excellent work, looking forward to it.
                                                    </p>
                                                </div>
                                            </div>
                                            <hr class="m-0 w-100">
                                            <!-- comment end
                                            <!-- comment
                                            <div class="d-flex flex-row w-100 py-4">
                                                <div class="d-inline-block align-middle status status-sm status-success mr-3">
                                                    <span class="profile-image profile-image-md rounded-circle d-block mt-1" style="background-image:url('img/demo/avatars/avatar-admin.png'); background-size: cover;"></span>
                                                </div>
                                                <div class="mb-0 flex-1 text-dark">
                                                    <div class="d-flex">
                                                        <a href="javascript:void(0);" class="text-dark fw-500">
                                                            Dr. Codex Lantern
                                                        </a><span class="text-muted fs-xs opacity-70 ml-auto">
                                                            3 minutes
                                                        </span>
                                                    </div>
                                                    <p class="mb-0">
                                                        Congrats mate!
                                                    </p>
                                                    <div class="pl-0 d-flex flex-row w-100 pb-0 pt-4">
                                                        <div class="d-inline-block align-middle status status-sm status-success mr-3">
                                                            <span class="profile-image profile-image-md rounded-circle d-block mt-1" style="background-image:url('img/demo/avatars/avatar-e.png'); background-size: cover;"></span>
                                                        </div>
                                                        <div class="mb-0 flex-1 text-dark">
                                                            <div class="d-flex">
                                                                <a href="javascript:void(0);" class="text-dark fw-500">
                                                                    Dr. John Cook PhD
                                                                </a><span class="text-muted fs-xs opacity-70 ml-auto">
                                                                    30 seconds
                                                                </span>
                                                            </div>
                                                            <p class="mb-0">
                                                                Thanks!
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr class="m-0 w-100">
                                            <!-- comment end
                                            <!-- add comment
                                            <div class="py-3 w-100">
                                                <textarea class="form-control border-0 p-0 bg-transparent" rows="2" placeholder="add a comment..."></textarea>
                                            </div>
                                            <!-- add comment end
                                        </div>
                                    </div>
                                </div>
                                <!-- post comment - end
                                <!-- post picture
                                <div class="card mb-g">
                                    <div class="card-body pb-0 px-4">
                                        <div class="d-flex flex-row pb-3 pt-2  border-top-0 border-left-0 border-right-0">
                                            <div class="d-inline-block align-middle status status-success mr-3">
                                                <span class="profile-image rounded-circle d-block" style="background-image:url('img/demo/avatars/avatar-admin.png'); background-size: cover;"></span>
                                            </div>
                                            <h5 class="mb-0 flex-1 text-dark fw-500">
                                                Dr. Codex Lantern
                                                <small class="m-0 l-h-n">
                                                    Chief of Surgery
                                                </small>
                                            </h5>
                                            <span class="text-muted fs-xs opacity-70">
                                                1 day
                                            </span>
                                        </div>
                                        <div class="pb-3 pt-2 border-top-0 border-left-0 border-right-0 text-muted">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt</p>
                                            <img src="img/demo/gallery/46.jpg" class="img-fluid" alt="">
                                        </div>
                                        <div class="d-flex align-items-center demo-h-spacing py-3">
                                            <a href="javascript:void(0);" class="d-inline-flex align-items-center text-dark">
                                                <i class="fal fa-heart fs-xs mr-1"></i> <span>37 Likes</span>
                                            </a>
                                            <a href="javascript:void(0);" class="d-inline-flex align-items-center text-dark">
                                                <i class="fal fa-comment fs-xs mr-1"></i> <span>1 Comment</span>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="card-body py-0 px-4 border-faded border-right-0 border-bottom-0 border-left-0">
                                        <div class="d-flex flex-column align-items-center">
                                            <!-- comment
                                            <div class="d-flex flex-row w-100 py-4">
                                                <div class="d-inline-block align-middle status status-sm status-success mr-3">
                                                    <span class="profile-image profile-image-md rounded-circle d-block mt-1" style="background-image:url('img/demo/avatars/avatar-h.png'); background-size: cover;"></span>
                                                </div>
                                                <div class="mb-0 flex-1 text-dark">
                                                    <div class="d-flex">
                                                        <a href="javascript:void(0);" class="text-dark fw-500">
                                                            Sarah McBrook
                                                        </a><span class="text-muted fs-xs opacity-70 ml-auto">
                                                            10 minutes
                                                        </span>
                                                    </div>
                                                    <p class="mb-0">
                                                        Nice shot! When are you going again?
                                                    </p>
                                                </div>
                                            </div>
                                            <hr class="m-0 w-100">
                                            <!-- comment end
                                            <!-- add comment
                                            <div class="py-3 w-100">
                                                <textarea class="form-control border-0 p-0 bg-transparent" rows="2" placeholder="add a comment..."></textarea>
                                            </div>
                                            <!-- add comment end
                                        </div>
                                    </div>
                                </div>
                                <!-- post picture - end
                                <!-- post article
                                <div class="card mb-g">
                                    <div class="card-body pb-0 px-4">
                                        <div class="d-flex flex-row pb-3 pt-2  border-top-0 border-left-0 border-right-0">
                                            <div class="d-inline-block align-middle status status-success mr-3">
                                                <span class="profile-image rounded-circle d-block" style="background-image:url('img/demo/avatars/avatar-admin.png'); background-size: cover;"></span>
                                            </div>
                                            <h5 class="mb-0 flex-1 text-dark fw-500">
                                                Dr. Codex Lantern
                                                <small class="m-0 l-h-n">
                                                    Chief of Surgery
                                                </small>
                                            </h5>
                                            <span class="text-muted fs-xs opacity-70">
                                                2 days
                                            </span>
                                        </div>
                                        <div class="pb-3 pt-2 border-top-0 border-left-0 border-right-0 text-muted">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt</p>
                                            <!-- URL post
                                            <div class="d-flex overflow-hidden rounded w-100 border">
                                                <div class="row no-gutters">
                                                    <div class="col-2 col-sm-3" style="background-image:url('img/demo/profile/article-healthyfood.png'); background-size: cover;"></div>
                                                    <div class="col">
                                                        <div class="bg-faded flex-1 p-4 h-100">
                                                            <h6 class="text-dark fw-500">
                                                                Healthy food
                                                            </h6>
                                                            <p class="m-0">sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center demo-h-spacing py-3">
                                            <a href="javascript:void(0);" class="d-inline-flex align-items-center text-dark">
                                                <i class="fal fa-heart fs-xs mr-1"></i> <span>1 Likes</span>
                                            </a>
                                            <a href="javascript:void(0);" class="d-inline-flex align-items-center text-dark">
                                                <i class="fal fa-comment fs-xs mr-1"></i> <span>0 Comments</span>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="card-body py-0 px-4 border-faded border-right-0 border-bottom-0 border-left-0">
                                        <div class="d-flex flex-column align-items-center">
                                            <!-- add comment
                                            <div class="py-3 w-100">
                                                <textarea class="form-control border-0 p-0 bg-transparent" rows="2" placeholder="add a comment..."></textarea>
                                            </div>
                                            <!-- add comment end
                                        </div>
                                    </div>
                                </div>
                                <!-- post article - end
                            </div -->
                            <div class="col-lg-6 col-xl-3 order-lg-2 order-xl-3">
                                <div class="card" style="width: 18rem;">
                                    <div class="card-header">
                                        Permissões do Papel
                                    </div>
                                    <ul class="list-group list-group-flush">
                                        @if ($role->permissions)
                                            @foreach ($role->permissions as $role_permission)
                                                <li class="list-group-item">{{$role_permission->name}}</li>
                                            @endforeach
                                        @else
                                            <li class="list-group-item">Não há Permissões</li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </main>
                    <!-- this overlay is activated only when mobile menu is triggered -->
                    <div class="page-content-overlay" data-action="toggle" data-class="mobile-nav-on"></div> <!-- END Page Content -->
@endsection
