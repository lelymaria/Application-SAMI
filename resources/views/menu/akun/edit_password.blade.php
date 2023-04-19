@extends('layouts.main')
@section('content')
    @include('layouts.navbar')

    <div class="row page-titles">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Account</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0)">Edit Password</a></li>
        </ol>
    </div>

    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="basic-form">
                    <form class="form-valide-with-icon needs-validation" novalidate="">
                        <div class="mb-3">
                            <label class="text-label form-label" for="dlab-password">Password Baru *</label>
                            <div class="input-group transparent-append">
                                <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
                                <input type="password" class="form-control" id="dlab-password"
                                    placeholder="Choose a safe one.." required="">
                                <span class="input-group-text show-pass">
                                    <i class="fa fa-eye-slash"></i>
                                    <i class="fa fa-eye"></i>
                                </span>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="text-label form-label" for="dlab-password">Konfirmasi Password *</label>
                            <div class="input-group transparent-append">
                                <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
                                <input type="password" class="form-control" id="dlab-password"
                                    placeholder="Choose a safe one.." required="">
                                <span class="input-group-text show-pass">
                                    <i class="fa fa-eye-slash"></i>
                                    <i class="fa fa-eye"></i>
                                </span>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <div class="col-lg-3 ms-auto">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <button type="submit" class="btn btn-light">cancel</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
    </div>
@endsection
