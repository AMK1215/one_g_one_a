@extends('layouts.master')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                {{-- <div class="col-sm-6">
                    <h1>Create Agent</h1>
                </div> --}}
                <div class="col-12">
                    <ol class="breadcrumb  float-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Create Player</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="card col-lg-6 offset-lg-3 col-md-6 offset-md-3 col-sm-8 offset-sm-2 col-10 offset-1"
                style="border-radius: 20px;">
                <div class="card-header mt-2">
                    <div class="card-title col-12">
                        <h3 class="d-inline">
                            Create Player
                        </h3>
                        <a href="{{ route('admin.player.index') }}" class="btn btn-primary d-inline float-right">
                            <i class="fas fa-arrow-left mr-2"></i> Back
                        </a>
                    </div>
                </div>
                

                <div class="card-body col-lg-12 offset-lg-0 col-md-6 offset-md-3 col-sm-8 offset-sm-2 col-10 offset-1 ">
                    <form role="form" method="POST" class="text-start" action="{{ route('admin.player.store') }}">
                        @csrf
                        <div class="form-group">
                            <label for="title">Player ID <span class="text-danger">*</span></label>
                            <input type="text" name="user_name" class="form-control" value="{{ $player_name }}" readonly>
                            @error('name')
                                <span class="text-danger d-block">*{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="title">Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control" value="{{ old('name') }}"
                                placeholder="Enter Name">
                            @error('name')
                                <span class="text-danger d-block">*{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="title">Password <span class="text-danger">*</span></label>
                            <input type="text" name="password" class="form-control" value="{{ old('password') }}"
                                placeholder="Enter Password">
                            @error('password')
                                <span class="text-danger d-block">*{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="title">Phone No<span class="text-danger">*</span></label>
                            <input type="text" name="phone" class="form-control" value="{{ old('phone') }}"
                                placeholder="Enter Phone Number">
                            @error('phone')
                                <span class="text-danger d-block">*{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <p>Max Balance : </p>
                            <span class="badge badge-sm bg-gradient-success">{{ auth()->user()->balanceFloat }}</span>
                        </div>
                        <div class="form-group">
                            <label for="title">Amount</label>
                            <input type="text" name="amount" class="form-control" value="{{ old('amount') }}"
                                placeholder="0.00">
                            @error('amount')
                                <span class="text-danger d-block">*{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group float-right">
                            <button class="btn btn-danger" type="button" id="resetFormButton">Reset</button>
                            <button type="submit" class="btn btn-success" type="button">Submit</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
        </div>
    </section>
@endsection


@section('scripts')
    <script>
        var errorMessage = @json(session('error'));
        var successMessage = @json(session('success'));
        var url = 'https://www.luckym.pro';
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
  <table class="table table-bordered" style="color: #fff;">
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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('resetFormButton').addEventListener('click', function() {
                var form = this.closest('form');
                form.querySelectorAll('input[type="text"]').forEach(input => {
                    // Resets input fields to their default values
                    input.value = '';
                });
                form.querySelectorAll('select').forEach(select => {
                    // Resets select fields to their default selected option
                    select.selectedIndex = 0;
                });
                // Add any additional field resets here if necessary
            });
        });
    </script>
@endsection
