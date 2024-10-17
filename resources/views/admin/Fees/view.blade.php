@extends('admin.layouts.master')
@push('links')

@endpush




@section('main')



        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">{{Str::title(str_replace('-', ' ', request()->segment(2)))}}</h4>
                    @can('add_client')
                    <div class="page-title-right">
                        <a href="{{ route('admin.'.request()->segment(2).'.create') }}"  class="btn-sm btn btn-primary btn-label rounded-pill">
                            <i class="bx bx-plus label-icon align-middle rounded-pill fs-16 me-2"></i>
                            Add {{Str::title(str_replace('-', ' ', request()->segment(2)))}}
                        </a>
                    </div>
                    @endcan

                </div>
            </div>
        </div>
        <!-- end page title -->




        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    
                    <div class="card-body">
                        <h4 class="mt-4">Transaction Details of  <b> {{$name}}</b></h4>
                <table class="table align-middle" style="width:100%">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Type</th>
                            <th>Doc. No</th>
                            <th>Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $totalFees = 0;
                            $totalPayments = 0;
                        @endphp
                        @foreach($data['transactions'] as $transaction)
                            <tr>
                                <td>{{  $transaction['date'] }}</td>
                                <td>{{ $transaction['type'] }}</td>
                                <td>{{ $transaction['doc_no'] ?? 'N/A' }}</td>

                                <td>{{ number_format($transaction['amount'], 2) }}</td>
                            </tr>

                            @if($transaction['type'] == 'debit')
                                @php $totalFees += $transaction['amount']; @endphp
                            @elseif($transaction['type'] == 'credit')
                                @php $totalPayments += $transaction['amount']; @endphp
                            @endif
                        @endforeach
                    </tbody>
                </table>

                <h4 class="mt-4">Summary</h4>
                <table class="table align-middle" style="width:100%">
                    <tr>
                        <th>Total Amount</th>
                        <td>{{ number_format($totalFees, 2) }}</td>
                    </tr>
                    <tr>
                        <th>Total Received Payments</th>
                        <td>{{ number_format($totalPayments, 2) }}</td>
                    </tr>
                    <tr>
                        <th>Total Fees (Pending)</th>
                        <td>{{ number_format($totalFees - $totalPayments, 2) }}</td>
                    </tr>
                </table>
                        
                        
                    </div>
                </div>
            </div><!--end col-->
        </div><!--end row-->



@endsection


@push('scripts')


@endpush