@extends('layouts.master')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12 ">
                    <ol class="breadcrumb float-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Change Password</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="card col-lg-6 offset-lg-3 col-md-6 offset-md-3 col-sm-8 offset-sm-2 col-10 offset-1" style="border-radius: 15px;">
                <div class="card-header">
                    <div class="card-title col-12">
                            <h3 class="d-inline">Change Password</h3>
                            <a href="{{ route('admin.agent.index') }}" class="btn btn-danger d-inline float-right ">
                                <i class="fas fa-arrow-left" style="font-size: 20px;"></i> Back
                            </a>
                    </div>
                </div>
                <form role="form" method="POST" class="text-start"
                    action="{{ route('admin.agent.makeChangePassword', $agent->id) }}">
                    @csrf
                    <div class="card-body ">
                        <div class="row">
                            <div class="col-lg-8 offset-lg-2 col-md-8 offset-md-2 col-sm-8 offset-sm-2 col-10 offset-1">
                                <div class="form-group">
                                    <label>New Password<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="password">
                                </div>
                                <div class="form-group">
                                    <label>Confirm Password<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="password_confirmation">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer  bg-white col-12">
                        <button type="submit" class="btn btn-success float-right">Update</button>
                    </div>
                </form>
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
        var url = 'https://maxwinagent.online/login';
        var name = @json(session('username'));
        var pw = @json(session('password'));

        @if (session()->has('success'))
            Swal.fire({
                title: successMessage,
                icon: "success",
                background: 'hsl(230, 40%, 10%)',
                showConfirmButton: false,
                showCloseButton: true,
                html: `
  <table class="table table-bordered" style="background:#eee;">
  <tbody>
  <tr>
    <td>username</td>
    <td id="tusername"> ${name}</td>
  </tr>
  <tr>
    <td>pw</td>
    <td id="tpassword"> ${pw}</td>
  </tr>
  <tr>
    <td>url</td>
    <td id=""> ${url}</td>
  </tr>
  <tr>
    <td></td>
    <td><a href="#" onclick="copy()" class="btn btn-sm btn-primary">copy</a></td>
  </tr>
 </tbody>
  </table>
  `
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
        function copy() {
            var username = $('#tusername').text();
            var password = $('#tpassword').text();
            var copy = "url : " + url + "\nusername : " + username + "\npw : " + password;
            copyToClipboard(copy)
        }

        function copyToClipboard(v) {
            var $temp = $("<textarea>");
            $("body").append($temp);
            var html = v;
            $temp.val(html).select();
            document.execCommand("copy");
            $temp.remove();
        }
    </script>
@endsection
