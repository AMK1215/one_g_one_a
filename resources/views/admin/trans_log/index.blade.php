@extends('layouts.master')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-12">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active">TransferLog</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="d-flex justify-content-end mb-3">
                        <a href="{{ route('home') }}" class="btn btn-danger " style="width: 100px;"><i
                                class="fas fa-arrow-left text-white  mr-2"></i>back</a>
                    </div>
                    <div class="card " style="border-radius: 20px;">
                        <div class="card-header">
                            <h3>TransferLog</h3>
                        </div>
                        <div class="card-body">
                            <table id="mytable" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>To User</th>
                                        <th>Amount</th>
                                        <th>Type</th>
                                        <th>Note</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($transferLogs as $log)
                                        <tr>
                                            <td>
                                                {{ $log->created_at }}
                                            </td>
                                            <td>{{ $log->targetUser->name }}</td>
                                            <td>
                                                <div
                                                    class="d-flex align-items-center text-{{ $log->type == 'deposit' ? 'success' : 'danger' }} text-gradient text-sm font-weight-bold ms-auto">
                                                    {{ $log->type == 'deposit' ? '+' : '' }}{{ number_format($log->amountFloat) }}
                                                </div>
                                            </td>
                                            <td>
                                                @if ($log->type == 'withdraw')
                                                    <p class="text-danger font-weight-bold">Withdraw</p>
                                                @else
                                                    <p class="text-success font-weight-bold">Deposit</p>
                                                @endif
                                            </td>
                                            <td>{{ $log->note }}</td>
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
