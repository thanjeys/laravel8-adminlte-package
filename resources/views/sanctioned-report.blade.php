@extends('layouts.app')

@section('content')
<div class="container">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Sanctioned Loan Month</h1>
                </div>
            </div>
        </div>
    </div>

    @php $total_sanctioned_amount = 0; @endphp
        @foreach ($all_report as $report)
            @php $total_sanctioned_amount += $report['sanctioned_amount']; @endphp
        @endforeach
    <div class="row">
        <div class="col-lg-12 col-6">
            <div class="small-box bg-success">
                <div class="inner text-center">
                    <h3>{{ $total_sanctioned_amount }}</h3>
                    <p>All Banks</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person-add"></i>
                </div>
                <a href="#" class="small-box-footer">of the Month Cycle </a>
            </div>
        </div>
    </div>

    <div class="row">
        @foreach ($all_report as $report)
            <div class="col-lg-3 col-6">
                <div class="small-box {{ $loop->even ? 'bg-info' : 'bg-warning' }}">
                    <div class="inner">
                        <h3>{{ $report['sanctioned_amount'] }}</h3>
                        <p>{{ $report['bank_name'] }} </p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                    <a href="#" class="small-box-footer">Cycle Date : {{ $report['monthly_cycle'] }} </a>
                    {{-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> --}}
                </div>
            </div>
        @endforeach
    </div>


</div>
@endsection
