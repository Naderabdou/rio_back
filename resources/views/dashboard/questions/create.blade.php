@extends('dashboard.layouts.app')

@section('title', transWord('إضافة الاسئله المكرره '))

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
                                            href="{{ route('admin.questions.index') }}">{{ transWord(' الاسئله المكرره') }}</a>
                                    </li>
                                    <li class="breadcrumb-item"><a
                                            href="#">{{ transWord('إضافة الاسئله المكرره ') }}</a>
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
                                    <h2 class="card-title">{{ transWord('إضافة الاسئله المكرره ') }}</h2>
                                </div>
                                <div class="card-body">
                                    <form class="form form-vertical" action="{{ route('admin.questions.store') }}"
                                        method="POST" id="createQuestionsForm" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">

                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="question_ar">{{ transWord('السؤال بالعربي') }}</label>
                                                    <input type="text" id="question_ar" class="form-control"
                                                        name="question_ar" value="{{ old('question_ar') }}" />
                                                    @error('question_ar')
                                                        <span class="alert alert-danger">
                                                            <small class="errorTxt">{{ $message }}</small>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="question_en">{{ transWord('السؤال بالإنجليزي') }}</label>
                                                    <input type="text" id="question_en" class="form-control"
                                                        name="question_en" value="{{ old('question_en') }}" />
                                                    @error('question_en')
                                                        <span class="alert alert-danger">
                                                            <small class="errorTxt">{{ $message }}</small>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="answer_ar">{{ transWord('الاجابه بالعربية') }}</label>
                                                    <textarea class="form-control " name="answer_ar" rows="10">{{ old('answer_ar') }}</textarea>
                                                    @error('answer_ar')
                                                        <span class="alert alert-danger">
                                                            <small class="errorTxt">{{ $message }}</small>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="answer_en">{{ transWord('الاجابه بالإنجليزي') }}</label>
                                                    <textarea class="form-control " name="answer_en" rows="10">{{ old('answer_en') }}</textarea>
                                                    @error('answer_en')
                                                        <span class="alert alert-danger">
                                                            <small class="errorTxt">{{ $message }}</small>
                                                        </span>
                                                    @enderror
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

        <script src="{{ asset('dashboard/assets/js/custom/validation/QuestionsForm.js') }}"></script>
    @endpush
@endsection
