@extends('layouts.master')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">

                <div class="col-12 float-right">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Edit Agent</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="card col-lg-6 offset-lg-3 col-md-6 offset-md-3 col-sm-8 offset-sm-2 col-10 offset-1 " style="border-radius: 20px;">
                <div class="card-header mt-2">
                    <div class="card-title col-12">
                            <h3 class="d-inline">
                                Edit Agent
                            </h3>
                            <a href="{{ route('admin.agent.index') }}" class="btn btn-danger d-inline float-right">
                                <i class="fas fa-arrow-left mr-2"></i> Back
                            </a>

                        </div>
                </div>
                <div class="card-body">

                    <form role="form" method="POST" class="text-start"
                        action="{{ route('admin.agent.update', $agent->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                     <div class="col-lg-12 offset-lg-0 col-md-6 offset-md-3 col-sm-8 offset-sm-2 col-10 offset-1">
                        <div class="form-group">
                            <label for="title">Agent Id <span class="text-danger">*</span></label>
                            <input type="text" name="user_name" class="form-control" value="{{ $agent->user_name }}"
                                readonly>
                            @error('name')
                                <span class="text-danger d-block">*{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="title">Agent Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control" value="{{ $agent->name }}">
                            @error('player_name')
                                <span class="text-danger d-block">*{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="title">Phone No</label>
                            <input type="text" name="phone" class="form-control" value="{{ $agent->phone }}">
                            @error('phone')
                                <span class="text-danger d-block">*{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-success float-right" type="button">Update</button>
                        </div>
                     </div>
                    </form>
                </div>
            </div>

        </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.32/dist/sweetalert2.all.min.js"></script>

    <script src="{{ asset('admin_app/assets/js/plugins/choices.min.js') }}"></script>
    <script src="{{ asset('admin_app/assets/js/plugins/quill.min.js') }}"></script>

    <script>
        var errorMessage = @json(session('error'));
        var successMessage = @json(session('success'));
        @if (session()->has('success'))
            Swal.fire({
                title: successMessage,
                icon: "success",
                background: 'hsl(230, 40%, 10%)',
                showConfirmButton: false,
                showCloseButton: true,

            });
        @elseif (session()->has('error'))
            Swal.fire({
                icon: 'error',
                title: errorMessage,
                background: 'hsl(230, 40%, 10%)',
                showConfirmButton: false,
                timer: 1500
            })
        @endif
    </script>
@endsection
