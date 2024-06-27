@extends('layouts.admin')
@section('title', 'Payments History')

@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-body">
                <div class="row">
                    <div class="col-12 col-md-6 col-lg-12">
                        <div class="card">
                            <x-alert-component />
                            <div class="card-header">
                                <h4> Payments History</h4>
                                <x-search-form :nameField="false"/>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-striped table-md">
                                        <tr> 
                                            <th>Sr.No.</th>
                                            <th>User</th>
                                            <th>Amount</th>
                                            <th>Status</th>
                                            <th>Date</th>
                                        </tr>
                                        @forelse ($payments as $payment)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td><a href="{{route('admin.users.show', [jsencode_userdata($payment->user->id)])}}">{{ $payment->user->name ?? ''}}</a></td>
                                                <td>$ {{$payment->amount ?? 0}}</td>
                                                <td>{{$payment->payment_status}}</td>
                                                <td>{{$payment->created_at ?? 'N/A'}}</td>
                                            </tr>
                                            @empty
                                            <tr>
                                                <td class="no-record-found">
                                                    <center>Did not found any Payment History </center>
                                                </td>
                                            </tr>
                                        @endforelse

                                    </table>
                                    <div class="card-footer"> 
                                        @if(count($payments))
                                            <div class="text-left">
                                                <a href="{{route('admin.payments.all',['export' => 'export'])}}" class="btn btn-primary">Download Report </a>
                                            </div>
                                       @endif
                                        <div class="text-right">
                                            <nav class="d-inline-block">           
                                                {!! $payments->links('admin.pagination') !!}
                                            </nav> 
                                       </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@push('scripts')

@endpush
