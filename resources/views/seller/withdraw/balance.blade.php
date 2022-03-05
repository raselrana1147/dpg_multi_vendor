@extends("layouts.seller")
@section("seller_title","DPG Seller| Seller Balance")
@section("seller_breadcrumb",trans('seller.seller_balance'))
@section("seller_content")
  <div class="row">
      <div class="col-6 offset-3">
          <div class="card">
            <div class="card-header">
              <h4>@lang('seller.my_balance')</h4>
            </div>
              <div class="card-body">
                <button type="button" data-toggle="modal" data-target="#withmoney" class="btn btn-primary btn-icon float-right mb-2">
                <span class="btn-icon-label"><i class="fas fa-arrow-left mr-2"></i></span>@lang('seller.withdrawal')</button>
                  <div class="row">
                    <div class="col-12">
                      <h5>@lang('seller.main_balance'): {{$seller->main_balance}}</h5>
                    </div>
                    <div class="col-12">
                      <h5>@lang('seller.pending_balance'):0.00</h5>
                    </div>
                  </div>
              </div>
             
              
              <div class="modal fade" id="withmoney" tabindex="-1" role="dialog" aria-labelledby="withmoneyModal" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-scrollable">
                      <div class="modal-content">
                          <div class="modal-header">
                              <h5 class="modal-title mt-0" id="withmoneyModal">@lang('seller.bank_info')</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                              </button>
                          </div>
                          <div class="modal-body">
                              <form id="submit_form" class="custom-validation" data-action="{{ route('seller.withdraw.submit') }}"  method="POST">
                               @csrf
                                  <div class="form-group">
                                      <label>@lang('seller.withdrawal_amount')</label>
                                      <input type="number" class="form-control" name="withdraw_amount" required  />
                                  </div>

                                  <div class="form-group">
                                      <label>@lang('seller.account_number')</label>
                                      <input type="text" class="form-control" name="account_number" required  />
                                  </div>

                                   <div class="form-group">
                                      <label>@lang('seller.account_holder_name')</label>
                                      <input type="text" class="form-control" name="account_holder_name" required  />
                                  </div>

                                  <div class="form-group">
                                      <label>@lang('seller.bank_name')</label>
                                      <input type="text" class="form-control" name="bank_name" required  />
                                  </div>

                                  <div class="form-group">
                                      <label>@lang('seller.branch_name')</label>
                                      <input type="text" class="form-control" name="branch_name" required  />
                                  </div>

                                   <div class="form-group">
                                      <label>@lang('seller.note')</label>
                                      <textarea name="note" class="form-control"></textarea>
                                  </div>

                                  <div class="form-group mb-0">
                                      <div>
                                          <button type="submit" class="submit_button btn btn-primary waves-effect waves-light mr-1">
                                              @lang('seller.withdrawal')
                                          </button>
                                      </div>
                                  </div>
                              </form>
                          </div>
                          
                      </div><!-- /.modal-content -->
                  </div><!-- /.modal-dialog -->
              </div><!-- /.modal -->
          </div>
      </div> <!-- end col -->
  </div> <!-- end row -->
@endsection

@section('seller_js')
  <script>
    $(document).ready(function(){
        $('body').on('submit','#submit_form',function(e){
            
                  e.preventDefault();

                  let formDta = new FormData(this);
                 $(".submit_button").html("Processing...").prop('disabled', true)
            
                  $.ajax({
                    url: $(this).attr('data-action'),
                    method: "POST",
                    data: formDta,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success:function(data){
                        if (data.status_code==200)
                        {
                          $("#submit_form")[0].reset();
                          $(".submit_button").text("Withdraw").prop('disabled', false)
                          toastr.success(data.message);             
                        }else{
                            $(".submit_button").text("Withdraw").prop('disabled', false)
                            toastr.info(data.message);   
                          }
                       
                    },

                    error:function(response){
                        
                    }

                  });
            });
    })
</script>

@endsection
