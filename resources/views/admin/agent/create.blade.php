@extends('layouts.master')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Create Agent</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active">create Agent</li>
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
                            <a href="{{ route('admin.agent.index') }}" class="btn btn-success">
                                <i class="fas fa-arrow-left" style="font-size: 20px;"></i> Back
                            </a>
                        </span>
                    </h3>
                </div>
                <form role="form" method="POST" class="text-start" action="{{ route('admin.agent.store') }}"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="card-body mt-2">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="title">Agent ID <span class="text-danger">*</span></label>
                                    <input type="text" name="user_name" class="form-control" value="{{ $agent_name }}"
                                        readonly>
                                    @error('user_name')
                                        <span class="text-danger d-block">*{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="title">Referal Code <span class="text-danger">*</span></label>
                                    <input type="text" name="referral_code" class="form-control"
                                        value="{{ $referral_code }}">
                                    @error('referral_code')
                                        <span class="text-danger d-block">*{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="title">Agent Name <span class="text-danger">*</span></label>
                                    <input type="text" name="name" class="form-control" value="{{ old('name') }}"
                                        placeholder="Enter Agent Name">
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
                                    <label>Max Balance : </label>
                                    <span
                                        class="badge badge-sm bg-gradient-success">{{ auth()->user()->balanceFloat }}</span>
                                </div>

                            </div>
                            <div class="col-md-6">

                                <div class="form-group">
                                    <label for="title">Amount</label>
                                    <input type="text" name="amount" class="form-control" value="{{ old('amount') }}"
                                        placeholder="0.00">
                                    @error('amount')
                                        <span class="text-danger d-block">*{{ $message }}</span>
                                    @enderror
                                </div>

                            </div>
                        </div>

                    </div>
                    <div class="card-footer">
                        <div class="form-group">
                            <button class="btn btn-info" type="button" id="resetFormButton">Cancel</button>

                            <button type="submit" class="btn btn-primary" type="button">Submit</button>
                        </div>
                    </div>
                </form>
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
        var url = 'https://www.luckym.online/login';
        var name = @json(session('username'));
        var pw = @json(session('password'));
        var deposit_amount = @json(session('amount'));

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
    <td>Transfer Amount</td>
    <td id="tdeposit">${deposit_amount ?? '0'}</td>
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
            var tdeposit = $('#tdeposit').text();
            var copy = "url : " + url + "\nusername : " + username + "\npw : " + password + "\nTransfer Amount :" +
                tdeposit;
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
