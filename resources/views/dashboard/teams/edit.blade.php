@extends('dashboard.layouts.app')

@section('title', transWord('تعديل فريق العمل '))

@section('content')
    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a
                                            href="{{ route('admin.teams.index') }}">{{ transWord(' فريق العمل') }}</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">{{ transWord('تعديل فريق العمل ') }}</a>
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- Basic Vertical form layout section start -->
                <section id="basic-vertical-layouts">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">

                                    <h2 class="card-title">{{ transWord('تعديل العضو'. ' - ' . $team->name )   }}</h2>
                                </div>
                                <div class="card-body">
                                    <form class="form form-vertical"
                                        action="{{ route('admin.teams.update',$team->id) }}" method="POST"
                                        enctype="multipart/form-data" id="updateForm">
                                        @method('PUT')
                                        @csrf
                                        <div class="row">

                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="name">{{ transWord('الأسم') }}</label>
                                                    <input type="text" id="team" class="form-control" name="name"
                                                        value="{{ old('name',$team->name) }}" />
                                                    @error('name')
                                                        <span class="alert alert-danger">
                                                            <small class="errorTxt">{{ $message }}</small>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="role">{{ transWord('الدور') }}</label>
                                                    <select id="role" class="form-control" name="role">
                                                        <option disabled selected value="">
                                                            {{ transWord('اختر الدور') }}</option>
                                                        <!-- Add your options here -->
                                                        <option value="Ui Ux Designer" {{ $team->role === "Ui Ux Designer" ? "selected" : "" }}>{{ 'Ui Ux Designer' }}</option>
                                                        <option  value="Fornt End Developer" {{ $team->role === "Fornt End Developer" ? "selected" : "" }} >{{ 'Fornt End Developer' }}</option>
                                                        <option value="Back End Developer" {{ $team->role === "Back End Developer" ? "selected" : "" }}>{{ 'Back End Developer' }}</option>
                                                        <option value="Flutter Developer" {{ $team->role  === "Flutter Developer" ? "selected" : ""}}>{{ 'Flutter Developer' }}</option>
                                                        <option value="Testing" {{ $team->role  === "Testing"  ? "selected" : ""}}>{{ 'Testing' }}</option>
                                                        <!-- etc. -->
                                                    </select>
                                                    @error('role')
                                                        <span class="alert alert-danger">
                                                            <small class="errorTxt">{{ $message }}</small>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="formFile"
                                                        class="form-label">{{ transWord('الصورة') }}</label>
                                                    <input class="form-control image" type="file" id="formFile"
                                                        name="image" accept=".png, .jpg, .jpeg" >
                                                    @error('image')
                                                        <span class="alert alert-danger">
                                                            <small class="errorTxt">{{ $message }}</small>
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="form-group prev">
                                                    <img src="{{ $team->image_path }}" style="width: 100px"
                                                        class="img-thumbnail preview-formFile" alt="">
                                                </div>
                                            </div>


                                            <div class="col-12">
                                                <button type="submit"
                                                    class="btn btn-primary mr-1">{{ transWord('save') }}</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- Basic Vertical form layout section end -->
            </div>
        </div>
    </div>
    <!-- END: Content-->

    @push('js')
    <script src="{{ asset('dashboard/app-assets/js/custom/preview-image.js') }}"></script>

        <script src="{{ asset('dashboard/assets/js/custom/validation/articleForm.js') }}"></script>
    @endpush
@endsection
