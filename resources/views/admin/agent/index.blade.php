@extends('layouts.master')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-12">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Agent List</li>
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
                    <div class="card-header">
                        <a href="{{ route('admin.agent.create') }}" class="btn btn-primary float-right" style="width: 80px;">Create</a>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h3>Agent Lists</h3>
                        </div>
                        <div class="card-body">
                            <table id="mytable" class="table table-bordered table-hover">
                                <thead>
                                    <th>#</th>
                                    <th>AgentName</th>
                                    <th>AgentID</th>
                                    <th>ReferralCode</th>
                                    <th>Phone</th>
                                    <th>Status</th>
                                    <th>Balance</th>
                                    <th>Action</th>
                                    <th>Transfer</th>
                                </thead>
                                <tbody>
                                    {{-- kzt --}}
                                    @if (isset($users))
                                        @if (count($users) > 0)
                                            @foreach ($users as $user)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>
                                                        <span class="d-block">{{ $user->name }}</span>
                                                    </td>
                                                    <td>
                                                        <span class="d-block">{{ $user->user_name }}</span>
                                                    </td>
                                                    <td>{{ $user->referral_code }}</td>
                                                    <td>{{ $user->phone }}</td>
                                                    <td>
                                                        <small
                                                            class="badge bg-gradient-{{ $user->status == 1 ? 'success' : 'danger' }}">{{ $user->status == 1 ? 'active' : 'inactive' }}</small>

                                                    </td>
                                                    <td>{{ number_format($user->balanceFloat) }}</td>

                                                    <td>
                                                        @if ($user->status == 1)
                                                            <a onclick="event.preventDefault(); document.getElementById('banUser-{{ $user->id }}').submit();"
                                                                class="me-2" href="#" data-bs-toggle="tooltip"
                                                                data-bs-original-title="Active Player">
                                                                <i class="fas fa-user-check text-success"
                                                                    style="font-size: 20px;"></i>
                                                            </a>
                                                        @else
                                                            <a onclick="event.preventDefault(); document.getElementById('banUser-{{ $user->id }}').submit();"
                                                                class="me-2" href="#" data-bs-toggle="tooltip"
                                                                data-bs-original-title="InActive Player">
                                                                <i class="fas fa-user-slash text-danger"
                                                                    style="font-size: 20px;"></i>
                                                            </a>
                                                        @endif
                                                        <form class="d-none" id="banUser-{{ $user->id }}"
                                                            action="{{ route('admin.agent.ban', $user->id) }}"
                                                            method="post">
                                                            @csrf
                                                            @method('PUT')
                                                        </form>

                                                        <a class="me-1"
                                                            href="{{ route('admin.agent.getChangePassword', $user->id) }}"
                                                            data-bs-toggle="tooltip"
                                                            data-bs-original-title="Change Password">
                                                            <i class="fas fa-lock text-info" style="font-size: 20px;"></i>
                                                        </a>
                                                        <a class="me-1" href="{{ route('admin.agent.edit', $user->id) }}"
                                                            data-bs-toggle="tooltip" data-bs-original-title="Edit Agent">
                                                            <i class="fas fa-pen-to-square text-info"
                                                                style="font-size: 20px;"></i>
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('admin.agent.getCashIn', $user->id) }}"
                                                            data-bs-toggle="tooltip"
                                                            data-bs-original-title="Deposit To Agent"
                                                            class="btn btn-info btn-sm">
                                                            <i class="fas fa-plus text-white me-1"></i>Deposit
                                                        </a>
                                                        <a href="{{ route('admin.agent.getCashOut', $user->id) }}"
                                                            data-bs-toggle="tooltip"
                                                            data-bs-original-title="WithDraw To Agent"
                                                            class="btn btn-info btn-sm">
                                                            <i class="fas fa-minus text-white me-1"></i>
                                                            Withdrawl
                                                        </a>
                                                        <a href="{{ route('admin.logs', $user->id) }}"
                                                            data-bs-toggle="tooltip" data-bs-original-title="Agent logs"
                                                            class="btn btn-info btn-sm">
                                                            <i class="fas fa-right-left text-white me-1"></i>
                                                            Logs
                                                        </a>
                                                        <a href="{{ route('admin.transferLogDetail', $user->id) }}"
                                                            data-bs-toggle="tooltip" data-bs-original-title="Reports"
                                                            class="btn btn-info btn-sm">
                                                            <i class="fas fa-right-left text-white me-1"></i>
                                                            transferLogs
                                                        </a>


                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td col-span=8>
                                                    There was no Agents.
                                                </td>
                                            </tr>
                                        @endif
                                    @endif
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
