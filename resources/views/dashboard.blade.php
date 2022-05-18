@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')
<div class="row">

    <div class="col">
        <div class="row">
            <div class="col-md-4">
                <!-- small box -->
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{ $passedEvaluations }}</h3>
                        <p>Number of Passed Evaluations</p>
                    </div>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-md-4">
                <!-- small box -->
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>{{ $failedEvaluations }}</h3>
                        <p>Number of Failed Evaluations</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{ $totalEvaluations }}</h3>
                        <p>Number of Total Evaluations</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

  </div>


@endsection

