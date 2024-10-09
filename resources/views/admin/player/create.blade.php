@extends('layouts.master')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Create Player</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                        <li class="breadcrumb-item active">create Player</li>
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
                <form action="{{route('admin.player.store')}}" method="POST">
                    @csrf
                    <div class="card-body mt-2">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>PlayerId<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="user_name" value="{{$player_name}}" readonly>
                                    @error('user_name')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label>Name<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="name" value="{{old('name')}}">
                                    @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Phone<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="phone" value="{{old('phone')}}">
                                    @error('phone')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Password<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="password" value="{{old('password')}}">
                                    @error('password')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Amount</label>
                                    <span class="badge badge-sm bg-gradient-success">{{ auth()->user()->balanceFloat }}</span>
                                    <input type="text" class="form-control" name="amount" value="{{old('amount')}}">
                                </div>

                            </div>
                        </div>

                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
        </div>
    </section>
@endsection
@section('script')
<script>
    var successMessage = @json(session('successMessage'));
    var userName = @json(session('user_name'));
    var password = @json(session('password'));
    var amount = @json(session('amount'));

    @if(session()->has('successMessage'))
    toastr.success(successMessage +
        `
    <div>
        <button class="btn btn-primary btn-sm" data-toggle="modal"
            data-username="${userName}"
            data-password="${password}"
            data-amount="${amount}" 
            data-url="https://pandashan.online/login" 
            onclick="copyToClipboard(this)">Copy</button>
    </div>`, {
        allowHtml: true
    });
    @endif

    function copyToClipboard(button) {
        var username = $(button).data('username');
        var password = $(button).data('password');
        var amount = $(button).data('amount');
        var url = $(button).data('url');

        var textToCopy = "Username: " + username + "\nPassword: " + password + "\nAmount: " + amount + "\nURL: " + url;

        navigator.clipboard.writeText(textToCopy).then(function() {
            toastr.success("Credentials copied to clipboard!");
        }).catch(function(err) {
            toastr.error("Failed to copy text: " + err);
        });
    }
</script>

@endsection