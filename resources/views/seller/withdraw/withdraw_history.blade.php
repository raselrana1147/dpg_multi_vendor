@extends("layouts.seller")
@section("seller_title","DPG Seller| Seller Withdraw History")
@section("seller_breadcrumb",trans('seller.seller_withdrawal_history'))
@section("seller_content")

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                
                 <h4 class="mt-0 header-title">@lang('seller.withdrawal_list')</h4>
                <table id="tables_item" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                    <tr>
                        <th>@lang('seller.serial')</th>
                        <th>@lang('seller.withdrawal_amount')</th>
                        <th>@lang('seller.account_number')</th>
                        <th>@lang('seller.bank_name')</th>
                        <th>@lang('seller.branch_name')</th>
                        <th>@lang('seller.comment')</th>
                        <th>@lang('seller.node')</th>
                        <th>@lang('seller.status')</th>
                        <th>@lang('seller.withdrawal_at')</th>
                    </tr>
                    </thead>
                </table>

            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->

@endsection

@section('seller_js')
<script>
        var table = $("#tables_item").DataTable({
            processing: true,
            responsive: true,
            serverSide: true,
            ordering: false,
            pagingType: "full_numbers",
            ajax: '{{ route('seller.load_withdraw.history') }}',
            columns: [
                { data: 'id',name:'id' },
                { data: 'withdraw_amount',name:'withdraw_amount'},
                { data: 'account_number',name:'account_number'},
                { data: 'bank_name',name:'bank_name'},
                { data: 'branch_name',name:'branch_name'}, 
                { data: 'comment',name:'comment'}, 
                { data: 'note',name:'note'}, 
                { data: 'status',name:'status'}, 
                { data: 'created_at',name:'created_at'},   
            ],

             language : {
                  processing: '@lang('seller.processing')'
              },
             
        });
   </script>

@endsection
