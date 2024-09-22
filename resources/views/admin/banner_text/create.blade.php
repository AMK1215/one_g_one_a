@extends('layouts.master')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-12">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active">BannerText</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="d-flex justify-content-end mb-3">
                        <a class="btn btn-icon btn-2 btn-primary float-end me-5" href="{{ route('admin.text.index') }}">
                            <span class="btn-inner--icon mt-1"><i class="material-icons">arrow_back</i>Back</span>
                        </a>
                    </div>
                    <div class="card " style="border-radius: 20px;">
                        <div class="card-header">
                            <h3>Banner Text Create </h3>
                        </div>
                        <div class="card-body">
                            <form role="form" class="text-start" action="{{ route('admin.text.store') }}" method="post">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label text-dark fw-bold" for="inputEmail1">Banner Text</label>
                                    <input type="text" class="form-control border border-1 border-secondary px-2"
                                        id="inputEmail1" name="text" placeholder="Enter Text">
                                    @error('text')
                                        <span class="text-danger d-block">*{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="">
                                    <button class="btn btn-primary" type="submit">Create</button>
                                </div>
                            </form>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </section>
@endsection
