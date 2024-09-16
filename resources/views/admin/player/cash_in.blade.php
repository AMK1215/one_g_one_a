@extends('layouts.master')

@section('content')
    <div class="row justify-content-center ">
        <div class="col-lg-12">
            <div class=" mt-2">
                <div
                    class="d-flex justify-content-end col-lg-8 col-md-8 col-sm-10 col-10  offset-lg-2 offset-md-2 offset-sm-1 offset-1 pb-3 pt-3">
                    <a href="{{ route('admin.player.index') }}" class="btn btn-danger" style="width: 100px;font-size: 16px;">
                        <i class="fas fa-arrow-left"></i> Back
                    </a>
                </div>
                <div class="card col-lg-8 col-md-8 col-sm-10 col-10  offset-lg-2 offset-md-2 offset-sm-1 offset-1 "
                    style="border-radius: 20px;">
                    <div class="card-header ">
                        <h3 class="ms-3 my-3 fw-bold">Player Information </h3>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-items-center mb-0">
                            <tbody>
                                <tr>
                                    <th>ID</th>
                                    <td>{!! $player->id !!}</td>
                                </tr>
                                <tr>
                                    <th>User Name</th>
                                    <td>{!! $player->name ?? '' !!}</td>
                                </tr>
                                <tr>
                                    <th>Phone</th>
                                    <td>{!! $player->phone !!}</td>
                                </tr>
                                <tr></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-lg-12">
            <div class="card col-lg-8 col-md-8 col-sm-10 col-10  offset-lg-2 offset-md-2 offset-sm-1 offset-1 "
                style="border-radius: 20px;">
                <!-- Card header -->
                <div class="card-header pb-0">
                    <div class="d-lg-flex my-3">
                        <div>
                            <h3 class="mb-0 fw-bold">Deposit</h3>
                        </div>
                        <div class="ms-auto my-auto mt-lg-0 mt-4">
                            <div class="ms-auto my-auto">


                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.player.makeCashIn', $player->id) }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="input-group input-group-outline is-valid my-3">
                                    <label class="form-label">Player Name</label>
                                    <input type="text" class="form-control" name="name"
                                        value="{{ $player->name ?? '' }}" readonly>

                                </div>
                                @error('name')
                                    <span class="d-block text-danger">*{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <div class="input-group input-group-outline is-valid my-3">
                                    <label class="form-label">Current Balance</label>
                                    <input type="text" class="form-control" name="phone"
                                        value="{{ number_format($player->balanceFloat, 2) }}" readonly>

                                </div>
                                @error('phone')
                                    <span class="d-block text-danger">*{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="input-group input-group-outline is-valid my-3">
                                    <label class="form-label">Amount</label>
                                    <input type="text" class="form-control" name="amount" required>
                                </div>
                                @error('amount')
                                    <span class="d-block text-danger">*{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <div class="input-group input-group-outline is-valid my-3">
                                    <label class="form-label">Addition Note (optional)</label>
                                    <input type="text" class="form-control" name="note">

                                </div>
                                @error('note')
                                    <span class="d-block text-danger">*{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        {{-- submit button --}}
                        <div class="row">
                            <div class="col-md-12">
                                <div class="input-group input-group-outline is-valid my-3">
                                    <button type="submit" class="btn btn-primary">Confirm</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var errorMessage = @json(session('error'));
            var successMessage = @json(session('success'));


            @if (session()->has('success'))
                Swal.fire({
                    icon: 'success',
                    title: successMessage,
                    text: '{{ session('
                                                                              SuccessRequest ') }}',
                    background: 'hsl(230, 40%, 10%)',
                    timer: 3000,
                    showConfirmButton: false
                });
            @elseif (session()->has('error'))
                Swal.fire({
                    icon: 'error',
                    title: '',
                    text: errorMessage,
                    background: 'hsl(230, 40%, 10%)',
                    timer: 3000,
                    showConfirmButton: false
                });
            @endif
        });
    </script>

    <script>
        if (document.getElementById('choices-tags-edit')) {
            var tags = document.getElementById('choices-tags-edit');
            const examples = new Choices(tags, {
                removeItemButton: true
            });
        }
    </script>
    <script>
        var d = new Date();
        var date = d.getDate();
        var month = d.getMonth() + 1;
        var year = d.getFullYear();
        var output = date + '-' + (month < 10 ? '0' : '') + month + '-' + year;
        document.getElementById('current_date').innerHTML = output;
    </script>
@endsection
