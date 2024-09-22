@extends('layouts.master')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-12">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active">BannerEdit</li>
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
                        <a href="{{ route('admin.banners.index') }}" class="btn btn-success " style="width: 100px;"><i
                                class="fas fa-plus text-white  mr-2"></i>Back</a>
                    </div>
                    <div class="card " style="border-radius: 20px;">
                        <div class="card-header">
                            <h3>Banner Update</h3>
                        </div>
                        <div class="card-body">
                            <form role="form" class="text-start"
                                action="{{ route('admin.banners.update', $banner->id) }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="custom-form-group">
                                    <label for="title">Banner Image</label>
                                    <input type="file" class="form-control" id="inputEmail3" name="image">
                                    <img src="{{ $banner->img_url }}" width="150px" class="img-thumbnail" alt="">
                                </div>
                                <div class="custom-form-group">
                                    <button class="btn btn-primary" type="submit">Edit</button>
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
