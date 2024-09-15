@extends('layouts.master')

@section('content')
    <div class="row justify-content-center ">
        <div class="col-lg-12">
            <div class=" mt-2">
                <div class="d-flex justify-content-end col-lg-8 col-md-8 col-sm-10 col-10  offset-lg-2 offset-md-2 offset-sm-1 offset-1 pb-3 pt-3">
                    <a href="{{ route('admin.agent.index') }}" class="btn btn-danger" style="width: 100px;font-size: 16px;">
                        <i class="fas fa-arrow-left" ></i> Back
                    </a>
                </div>
                <div class="card col-lg-8 col-md-8 col-sm-10 col-10  offset-lg-2 offset-md-2 offset-sm-1 offset-1 " style="border-radius: 20px;">
                    <div class="card-header ">
                        <h3 class="ms-3 my-3 fw-bold">Agent Information </h3>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-items-center mb-0">
                            <tbody>
                                <tr>
                                    <th>ID</th>
                                    <td>{!! $agent->id !!}</td>
                                </tr>
                                <tr>
                                    <th>Agent Name</th>
                                    <td>{!! $agent->name !!}</td>
                                </tr>
                                <tr>
                                    <th>Phone</th>
                                    <td>{!! $agent->phone !!}</td>
                                </tr>
                                <tr></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        {{-- kzt --}}
    </div>

    <div class="row mt-4">
        <div class="col-lg-12">
            <div class="card col-lg-8 col-md-8 col-sm-10 col-10  offset-lg-2 offset-md-2 offset-sm-1 offset-1 " style="border-radius: 20px;">
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
                    <form action="{{ route('admin.agent.makeCashIn', $agent->id) }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                <label class="form-label">Name</label>
                                <div class="input-group input-group-outline is-valid mb-3">
                                    <input type="text" class="form-control" name="name" value="{{ $agent->name }}"
                                        readonly>

                                </div>
                                @error('name')
                                    <span class="d-block text-danger">*{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                <label class="form-label">Current Balance</label>
                                <div class="input-group input-group-outline is-valid mb-3">
                                    <input type="text" class="form-control" name="blance"
                                        value="{{ $agent->balanceFloat }}" readonly>
                                </div>
                                @error('phone')
                                    <span class="d-block text-danger">*{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <input type="hidden" name="from_user_id" value="{{ Auth::id() }}">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                <label class="form-label">Amount</label>
                                <div class="input-group input-group-outline is-valid mb-3">
                                    <input type="text" class="form-control" name="amount" required>
                                    @error('amount')
                                        <span class="d-block text-danger">*{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                <label class="form-label ">Addition Note (optional)</label>
                                <div class="input-group input-group-outline is-valid mb-3">
                                    <input type="text" class="form-control" name="note">
                                    @error('note')
                                        <span class="d-block text-danger">*{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        {{-- submit button --}}
                        <div class="row">
                            <div class="col-12">
                                <div class="input-group input-group-outline is-valid mb-3 d-flex justify-content-end" >
                                    <button type="submit" class="btn btn-success" style="width: 100px;">Confirm</button>
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
    {{-- <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.min.js"></script>

    <script src="{{ asset('admin_app/assets/js/plugins/choices.min.js') }}"></script>
    <script src="{{ asset('admin_app/assets/js/plugins/quill.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.32/dist/sweetalert2.all.min.js"></script> --}}

    {{-- <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.32/dist/sweetalert2.all.min.js"></script> --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var errorMessage = @json(session('error'));
            var successMessage = @json(session('success'));
            console.log(successMessage);
            @if (session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: successMessage,
                    background: 'hsl(230, 40%, 10%)',
                    timer: 3000,
                    showConfirmButton: false
                });
            @elseif (session('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
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
@endsection
