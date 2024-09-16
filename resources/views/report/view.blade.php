@extends('layouts.master')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-12">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Player Win/Lose Report</li>
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
                        <a href="{{ route('admin.player.index') }}" class="btn btn-success " style="width: 100px;"><i
                                class="fas fa-plus text-white  mr-2"></i>Back</a>
                    </div>
                    <div class="card " style="border-radius: 20px;">
                        <div class="card-header">
                            <h3>Win/lose Report</h3>
                        </div>

                        <div class="card-body">
                            <div>
                                <div class="container">
                                    <form action="">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="input-group input-group-static my-3">
                                                    <label>From</label>
                                                    <input type="date" class="form-control" id="fromDate"
                                                        name="fromDate">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="input-group input-group-static my-3">
                                                    <label>To</label>
                                                    <input type="date" class="form-control" id="toDate"
                                                        name="toDate">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="input-group input-group-static my-3">
                                                    <label>Player</label>
                                                    <input type="text" class="form-control" id="player_name"
                                                        name="player_name" value="{{ Request::query('player_name') }}">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <button class="btn btn-sm btn-primary" id="search">Search</button>
                                            </div>

                                    </form>
                                </div>
                                {{-- table --}}
                                <div class="table-responsive">
                                    <table id="mytable" class="table table-bordered table-hover">

                                        <thead>
                                            <th>PlayerId</th>
                                            <th>Product Name</th>
                                            <th>Total Valid Bet</th>
                                            <th>Total Bet</th>
                                            <th>Total Payout</th>
                                            <th>Win/Lose</th>
                                            <th>Action</th>
                                        </thead>
                                        <tbody>
                                            @foreach ($reports as $rep)
                                                <tr>
                                                    <td>{{ $rep->user_name }}</td>
                                                    <td>{{ $rep->product_name }}</td>
                                                    <td>{{ $rep->total_valid_bet_amount }}</td>
                                                    <td>{{ $rep->total_bet_amount }}</td>
                                                    <td>{{ $rep->total_payout_amount }}</td>
                                                    @php
                                                        $result =
                                                            $rep->total_payout_amount - $rep->total_valid_bet_amount;
                                                    @endphp
                                                    @if ($result > 0)
                                                        <td class="text-sm text-success font-weight-bold">
                                                            {{ $result }}</td>
                                                    @else
                                                        <td class="text-sm text-danger font-weight-bold">{{ $result }}
                                                        </td>
                                                    @endif
                                                    <td><a href="{{ route('admin.report.detail', [$rep->user_id, $rep->product_code]) }}"
                                                            class="btn btn-sm btn-info">Detail</a></td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                            </div>
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
    <script src="{{ asset('admin_app/assets/js/plugins/datatables.js') }}"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.min.js"></script> --}}
    <script>
        $(document).ready(function() {
            $(document).on('click', '#search', function(event) {
                event.preventDefault();
                const fromDate = $('#fromDate').val();
                const toDate = $('#toDate').val();
                const playerName = $('#player_name').val();
                const gameTypeId = $('.game-type-btn.active').data('id');
                $('.game-type-btn').removeClass('btn_primary');
                $('.game-type-btn[data-id="' + gameTypeId + '"]').addClass('btn_primary');
                $.ajax({
                    url: "{{ route('admin.report.index') }}",
                    type: "GET",
                    data: {
                        fromDate: fromDate,
                        toDate: toDate,
                        playerName: playerName,
                        gameTypeId: gameTypeId,
                    },
                    success: function(response) {
                        console.log(response);
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    },
                });
            });

            $('.game-type-btn').on('click', function() {
                $('.game-type-btn').removeClass('btn-primary');
                $(this).addClass('btn-primary active');
                var gameTypeId = $(this).data('id');
            });

        });
    </script>
    <script>
        if (document.getElementById('users-search')) {
            const dataTableSearch = new simpleDatatables.DataTable("#users-search", {
                searchable: true,
                fixedHeight: false,
                perPage: 7
            });

            document.querySelectorAll(".export").forEach(function(el) {
                el.addEventListener("click", function(e) {
                    var type = el.dataset.type;

                    var data = {
                        type: type,
                        filename: "material-" + type,
                    };

                    if (type === "csv") {
                        data.columnDelimiter = "|";
                    }

                    dataTableSearch.export(data);
                });
            });
        };
    </script>
    <script>
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })
    </script>
@endsection
