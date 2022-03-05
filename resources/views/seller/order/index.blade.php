@extends("layouts.seller")
@section("seller_title","DPG Seller| Order List")
@section("seller_breadcrumb",trans('seller.order_list'))
@section("seller_content")
  <div class="row">
      <div class="col-12">
          <div class="card">
              <div class="card-body">
                  
                   <h4 class="mt-0 header-title">@lang('seller.order_list')</h4>
                  <table id="tables_item" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                      <thead>
                      <tr>
                          <th>@lang('seller.serial')</th>
                          <th>@lang('seller.order_number')</th>
                          <th>@lang('seller.sub_total')</th>
                          <th>@lang('seller.quantity')</th>
                          <th>@lang('seller.order_at')</th>
                          <th>@lang('seller.status')</th>
                          <th>@lang('seller.action')</th>
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
             ajax: '{{ route('seller.load_order') }}',
             columns: [
                 { data: 'id',name:'id' },
                 { data: 'order_number',name:'order_number'},
                 { data: 'grand_total',name:'grand_total'},
                 { data: 'quantity',name:'quantity'},
                 { data: 'created_at',name:'created_at'},
                 { data: 'status',name:'status'}, 
                 { data: 'action',name:'action'},   
             ],

              language : {
                   processing: '@lang('seller.processing')'
               },
              
         });
    </script>
@endsection()
