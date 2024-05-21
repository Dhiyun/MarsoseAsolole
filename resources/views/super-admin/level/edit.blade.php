@extends('super-admin.layouts.template')

@section('content')

<div class="app-main flex-column flex-row-fluid mt-5 mx-5 mb-5" id="kt_app_main">
    <!--begin::Content wrapper-->
    <div class="d-flex flex-column flex-column-fluid">
        <!--begin::Toolbar-->
        @include('super-admin.layouts.breadcrumb')
        <!--end::Toolbar-->
        <!--begin::Content-->
        <div id="kt_app_content" class="app-content flex-column-fluid">
            <!--begin::Content container-->
            <div id="kt_app_content_container" class="app-container container-fluid">
                <!--begin::Card-->
                <div class="card">
                    <!--begin::Card header-->
                    <div class="card-header border-0 pt-6">
                        <div class="card-title">
                            <h2 class="fw-bold">Edit Level</h2>
                        </div>
                    </div>
                    <!--end::Card header-->
                    <!--begin::Card body-->
                    <div class="card-body py-4">
                        <!--begin::Form-->
                        <form method="POST" action="{{ route('level.update', ['id' => $level->id_level]) }}" class="form">
                            @csrf
                            @method('PUT')
                            <!--begin::Input group-->
                            <div class="mb-4">
                                <label class="required fw-semibold fs-6 mb-2">Kode Level</label>
                                <input type="text" id="level_kode" name="level_kode" class="form-control form-control-solid" value="{{ $level->level_kode }}" required />
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="mb-4">
                                <label class="required fw-semibold fs-6 mb-2">Nama Level</label>
                                <input type="text" id="level_nama" name="level_nama" class="form-control form-control-solid" value="{{ $level->level_nama }}" required />
                            </div>
                            <!--end::Input group-->
                            <!--begin::Actions-->
                            <div class="d-flex justify-content-between">
                                <a href="{{ route('level.index') }}" class="btn btn-secondary">Back</a>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                            <!--end::Actions-->
                        </form>
                        <!--end::Form-->
                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Card-->
            </div>
            <!--end::Content container-->
        </div>
        <!--end::Content-->
    </div>
    <!--end::Content wrapper-->
</div>

@endsection
