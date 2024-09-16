@extends('layouts.master')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Change Password</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
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
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <span>
                            <a href="{{ route('admin.player.index') }}" class="btn btn-success">
                                <i class="fas fa-arrow-left" style="font-size: 20px;"></i> Back
                            </a>
                        </span>
                    </h3>
                </div>
                <form role="form" method="POST" class="text-start"
                    action="{{ route('admin.player.makeChangePassword', $player->id) }}">
                    @csrf
                    <div class="custom-form-group">
                        <label for="title">New Password <span class="text-danger">*</span></label>
                        <input type="text" name="password" class="form-control">
                        @error('password')
                            <span class="text-danger d-block">*{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="custom-form-group">
                        <label for="title">Confirm Password <span class="text-danger">*</span></label>
                        <input type="text" name="password_confirmation" class="form-control">
                    </div>

                    <div class="custom-form-group">
                        <button type="submit" class="btn btn-primary" type="button">Confirm</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection


@section('scripts')
    <script>
        var errorMessage = @json(session('error'));
        var successMessage = @json(session('success'));
        var url = 'https://maxwinmyanmar.com/login';
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
    <td>Url</td>
    <td id=""> ${url}</td>
  </tr>
  <tr>
    <td>Username</td>
    <td id="tusername"> ${name}</td>
  </tr>
  <tr>
    <td>Password</td>
    <td id="tpassword"> ${pw}</td>
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
