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
                        <a class="btn btn-icon btn-2 btn-primary float-end me-5"
                            href="{{ route('admin.adsbanners.index') }}">
                            <span class="btn-inner--icon mt-1"><i class="material-icons">arrow_back</i>Back</span>
                        </a>
                    </div>
                    <div class="card " style="border-radius: 20px;">
                        <div class="card-header">
                            <h3>Banner Ads Create </h3>
                        </div>
                        <div class="card-body">
                            <form role="form" class="text-start" action="{{ route('admin.adsbanners.store') }}"
                                method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="custom-form-group">
                                    <label for="title">Ads Banner Image</label>
                                    <input type="file" class="form-control" id="inputEmail3" name="image">
                                </div>
                                <div class="custom-form-group">
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
