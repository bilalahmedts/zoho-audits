@extends('layouts.app')

@section('title', 'Audits')


@section('content')
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    <div class="search-area">
        <div class="row">

            <div class="col-md-6">
                <h4 class="mb-0">Search</h4>
            </div>
            <div class="col-md-6">
                <div class="button-area">
                    <button type="button" id="btn-search" class="btn btn-primary"><i class="fas fa-filter"></i></button>
                </div>
            </div>

        </div>

        <form action="{{ route('audits.index') }}" method="get" autocomplete="off">
            <input type="hidden" name="search" value="1">
            @php
                $zoho_id = '';
                $user_id = '';
                $evaluationStatus = '';
                $start_date = '';
                $end_date = '';

                if (isset($_GET['search'])) {
                    if (!empty($_GET['zoho_id'])) {
                        $zoho_id = $_GET['zoho_id'];
                    }
                }
                if (isset($_GET['search'])) {
                    if (!empty($_GET['user_id'])) {
                        $user_id = $_GET['user_id'];
                    }
                }
                if (isset($_GET['search'])) {
                    if (!empty($_GET['evaluationStatus'])) {
                        $evaluationStatus = $_GET['evaluationStatus'];
                    }
                }
                if (isset($_GET['search'])) {
                    if (!empty($_GET['start_date'])) {
                        $start_date = $_GET['start_date'];
                    }
                    if (!empty($_GET['end_date'])) {
                        $end_date = $_GET['end_date'];
                    }
                }
                
            @endphp

            <div class="card card-primary card-outline mt-3" id="search"
                @if (isset($_GET['search'])) style="display: block;" @endif>
                <div class="card-body">
                    <div class="row">

                        <div class="form-group col-md-4">
                            <label for="">Zoho ID</label>
                            <input type="text" name="zoho_id" value="{{ $zoho_id }}" class="form-control">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="">Agent Name</label>
                            <select name="user_id" class="form-control select2">
                                <option value="">Select Option</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}" @if ($user->id == $user_id) selected @endif>
                                        {{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="">Select Evaluation Status</label>
                            <select name="evaluationStatus" class="form-control select2">
                                <option value="">Select</option>
                                <option value="Passed" @if ($evaluationStatus == 'Passed') selected @endif>Passed</option>
                                <option value="Failed" @if ($evaluationStatus == 'Failed') selected @endif>Failed</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label>Start Date</label>
                            <input type="text" class="form-control datetimepicker-input datepicker1"
                                data-toggle="datetimepicker" data-target=".datepicker1" name="start_date"
                                placeholder="Enter Start Date" value="{{ $start_date }}">
                        </div>
                        <div class="col-md-4">
                            <label>End Date</label>
                            <input type="text" class="form-control datetimepicker-input datepicker2"
                                data-toggle="datetimepicker" data-target=".datepicker2" name="end_date"
                                placeholder="Enter End Date" value="{{ $end_date }}">
                        </div>
                        {{-- <div class="form-group col-md-4">
                            <label for="">Campaign</label>
                            <select name="campaign_id" id="campaign_id" class="form-control select2">
                                <option value="">Select Option</option>
                                @foreach ($campaigns as $campaign)
                                    <option value="{{ $campaign->id }}" @if ($campaign->id == $campaign_id) selected @endif>{{ $campaign->name }}</option>
                                @endforeach
                            </select>
                        </div> --}}

                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Search</button>
                    <a href="{{ route('audits.index') }}" class="ml-5">Clear Search</a>
                </div>
            </div>
        </form>

    </div>
    <div class="card card-primary card-outline">
        <div class="card-header">
            <h3 class="card-title">Audits List</h3>
            <div class="card-tools">
                <a href="{{ route('audits.create') }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-plus"></i> Add Audit
                </a>
            </div>
        </div>

        <div class="card-body">

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ZOHO ID</th>
                        <th>Agent Name</th>
                        <th>Campaign</th>
                        <th>Evaluation Status</th>
                        <th>Comments</th>
                        <th>Evaluated By</th>
                        <th>Evaluation Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($audits) > 0)

                        @foreach ($audits as $audit)
                            <tr>
                                <td>{{ $audit->zoho_id ?? '-' }}</td>
                                <td>{{ $audit->user->name ?? '-' }}</td>
                                <td>{{ $audit->user->campaign->name ?? '-' }}</td>
                                <td>
                                    @if ($audit->evaluationStatus == 'Passed')
                                        <span class="badge bg-success">Passed</span>
                                    @else
                                        <span class="badge bg-danger">Failed</span>
                                    @endif
                                </td>
                                <td>{{ $audit->comments ?? '-' }}</td>
                                <td>{{ $audit->evaluator->name ?? '-' }}</td>
                                <td>{{ $audit->created_at }}</td>
                                <td class="action">
                                    <a href="{{ route('audits.edit', $audit) }}" class="btn btn-primary btn-sm"><i
                                            class="fas fa-edit"></i></a>
                                    <form action="{{ route('audits.delete', $audit) }}" method="post">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn btn-danger btn-sm"><i
                                                class="fas fa-trash"></i></button>
                                    </form>
                                </td>
                                {{-- <td>
                                    <a href="{{ route('audits.edit', $audit) }}" class="btn btn-primary btn-sm"><i
                                            class="fas fa-edit"></i></a>
                                            
                                    <a href="{{ route('audits.destroy', $audit) }}" class="btn btn-primary btn-sm"><i
                                            class="fas fa-trash"></i></a>
                                            
                                </td> --}}
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="7" class="text-center">No record found!</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
        @if ($audits->total() > 4)
            <div class="card-footer clearfix">
                {{ $audits->appends(request()->input())->links() }}
            </div>
        @endif

    </div>
@endsection
@section('scripts')
    <script>
        $("#btn-search").click(function() {
            $("#search").toggle();
        });
        $('.datepicker1').datetimepicker({
            format: 'L',
            format: 'DD/MM/YYYY',
            keepInvalid: false
        });
        $('.datepicker2').datetimepicker({
            format: 'L',
            format: 'DD/MM/YYYY',
            keepInvalid: false
        });
    </script>

@endsection
