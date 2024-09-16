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
                        <li class="breadcrumb-item active">Withdraw Requested Lists</li>
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
                            Withdraw Requested Lists
                        </h3>
                        <a href="{{ route('home') }}" class="btn btn-danger d-inline float-right">
                            <i class="fas fa-arrow-left mr-2"></i> Back
                        </a>
                    </div>
                </div>
                <form action="{{ route('admin.agent.withdraw') }}" method="GET">
                    <div class="row mt-3">
                        <div class="col-md-3">
                            <div class="input-group input-group-static mb-4">
                                <label for="exampleFormControlSelect1" class="ms-0">Select Status</label>
                                <select class="form-control" id="" name="status">
                                    <option value="all" {{ request()->get('status') == 'all' ? 'selected' : '' }}>All
                                    </option>
                                    <option value="0" {{ request()->get('status') == '0' ? 'selected' : '' }}>Pending
                                    </option>
                                    <option value="1" {{ request()->get('status') == '1' ? 'selected' : '' }}>Approved
                                    </option>
                                    <option value="2" {{ request()->get('status') == '2' ? 'selected' : '' }}>Rejected
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <button class="btn btn-sm btn-primary" id="search" type="submit">Search</button>
                            <a href="{{ route('admin.agent.withdraw') }}" class="btn btn-link text-primary ms-auto border-0"
                                data-bs-toggle="tooltip" data-bs-placement="bottom" title="Refresh">
                                <i class="material-icons text-lg">refresh</i>
                            </a>
                        </div>
                    </div>
                </form>

            </div>

        </div>
        </div>
    </section>


    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">

                    <div class="card " style="border-radius: 20px;">

                        <div class="card-body">
                            <table id="mytable" class="table table-bordered table-hover">
                                <thead>
                                    <th>#</th>
                                    <th>PlayerName</th>
                                    <th>Requested Amount</th>
                                    <th>Payment Method</th>
                                    <th>Bank Account Name</th>
                                    <th>Bank Account Number</th>
                                    <th>Status</th>
                                    <th>Created_at</th>
                                    <th>Action</th>
                                </thead>
                                <tbody>
                                    @foreach ($withdraws as $withdraw)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                <span class="d-block">{{ $withdraw->user->name }}</span>
                                            </td>
                                            <td>{{ number_format($withdraw->amount) }}</td>
                                            <td>{{ $withdraw->bank->paymentType->name }}</td>
                                            <td>{{ $withdraw->account_name }}</td>
                                            <td>{{ $withdraw->account_number }}</td>
                                            <td>
                                                @if ($withdraw->status == 0)
                                                    <span class="badge text-bg-warning text-white mb-2">Pending</span>
                                                @elseif ($withdraw->status == 1)
                                                    <span class="badge text-bg-success text-white mb-2">Approved</span>
                                                @elseif ($withdraw->status == 2)
                                                    <span class="badge text-bg-danger text-white mb-2">Rejected</span>
                                                @endif
                                            </td>

                                            <td>{{ $withdraw->created_at->format('d-m-Y') }}</td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <form
                                                        action="{{ route('admin.agent.withdrawStatusUpdate', $withdraw->id) }}"
                                                        method="post">
                                                        @csrf
                                                        <input type="hidden" name="amount"
                                                            value="{{ $withdraw->amount }}">
                                                        <input type="hidden" name="status" value="1">
                                                        <input type="hidden" name="player"
                                                            value="{{ $withdraw->user_id }}">
                                                        @if ($withdraw->status == 0)
                                                            <button class="btn btn-success p-1 me-1" type="submit">
                                                                <i class="fas fa-check"></i>
                                                            </button>
                                                        @endif
                                                    </form>
                                                    <form
                                                        action="{{ route('admin.agent.withdrawStatusreject', $withdraw->id) }}"
                                                        method="post">
                                                        @csrf
                                                        <input type="hidden" name="status" value="2">
                                                        @if ($withdraw->status == 0)
                                                            <button class="btn btn-danger p-1 me-1" type="submit">
                                                                <i class="fas fa-xmark"></i>
                                                            </button>
                                                        @endif
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>

                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </section>
@endsection
@section('scripts')
@endsection
