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
                        <li class="breadcrumb-item active">Create New Bank Account</li>
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
                            Create New Bank Account
                        </h3>
                        <a href="{{ route('admin.bank.index') }}" class="btn btn-danger d-inline float-right">
                            <i class="fas fa-arrow-left mr-2"></i> Back
                        </a>
                    </div>
                </div>
                <form role="form" method="POST" class="text-start" action="{{ route('admin.bank.update', $bank->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="title">Payment Type <span class="text-danger">*</span></label>
                        <select name="payment_type_id" id="">
                            <option value="">Select Payment Type</option>
                            @foreach ($paymentTypes as $paymentType)
                                <option value="{{ $paymentType->id }}"
                                    {{ $paymentType->id == $bank->payment_type_id ? 'selected' : '' }}>
                                    {{ $paymentType->name }}</option>
                            @endforeach
                        </select>
                        @error('payment_type_id')
                            <span class="text-danger d-block">*{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="title">Account Name <span class="text-danger">*</span></label>
                        <input type="text" name="account_name" class="form-control" value="{{ $bank->account_name }}"
                            placeholder="Enter Bank Account Name">
                        @error('account_name')
                            <span class="text-danger d-block">*{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="title">Account Number <span class="text-danger">*</span></label>
                        <input type="text" name="account_number" class="form-control" value="{{ $bank->account_number }}"
                            placeholder="Enter Bank Account Number">
                        @error('account_number')
                            <span class="text-danger d-block">*{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <button class="btn btn-info" type="button" id="resetFormButton">Cancel</button>

                        <button type="submit" class="btn btn-primary" type="button">Submit</button>
                    </div>
                </form>
            </div>

        </div>
        </div>
    </section>
@endsection


@section('scripts')
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
