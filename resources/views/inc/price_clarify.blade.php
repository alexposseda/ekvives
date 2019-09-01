<div class="orderFormItem noPaddingTop priceInfo">
    <button class="orderFormBtn" data-toggle="modal" data-target="#priceModal">@lang('priceclarify.buttons.open_modal')</button>
</div>
<!-- Small modal start -->
@push('scripts')
<script>
    $("#price_clarify_form").validate({
        submitHandler: function (form) {
            var form_btn = $(form).find('button[type="submit"]');
            var form_result_div = '#form-result';
            $(form_result_div).remove();
            form_btn.before(
                '<div id="form-result" class="alert alert-success" role="alert" style="display: none;"></div>'
            );
            var form_btn_old_msg = form_btn.html();
            form_btn.html(form_btn.prop('disabled', true).data(
                "loading-text"));
            $(form).ajaxSubmit({
                dataType: 'json',
                success: function (data) {
                    if (data.status == 'true') {
                        $(form).find('.form-control').val('');
                    }
                    form_btn.prop('disabled', false).html(
                        form_btn_old_msg);
                    $(form_result_div).html(data.message).fadeIn(
                        'slow');
                    setTimeout(function () {
                        $(form_result_div).fadeOut(
                            'slow')
                    }, 6000);
                }
            });
        }
    });
</script>
@endpush
<div id="priceModal" class="modal fade">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="text-theme-colored modal-title" id="myModalLabel">@lang('priceclarify.title')</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>@lang('priceclarify.description')</p>
                <form id="price_clarify_form" name="job_apply_form" action="/price_clarify" method="post">
                {{csrf_field()}}                    
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>@lang('priceclarify.name.label')
                                    <small>*</small>
                                </label>
                                <input name="name" type="text" placeholder="@lang('priceclarify.name.placeholder')" required="" class="form-control">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>@lang('priceclarify.email.label')
                                    <small>*</small>
                                </label>
                                <input name="email" class="form-control required email" type="email" placeholder="@lang('priceclarify.email.placeholder')">
                            </div>
                        </div>
                    </div>
                    <div class="row">                        
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>@lang('priceclarify.phone.label')
                                </label>
                                <input id="telNo" name="phone" type="tel" placeholder="@lang('priceclarify.phone.placeholder')" class="form-control required">
                            </div>
                        </div>
                    </div>                    
                    <div class="form-group">
                        <input name="botcheck" class="form-control" type="hidden" value="" />
                        <button type="submit" class="btn btn-block btn-dark btn-theme-colored btn-sm mt-20 pt-10 pb-10" data-loading-text="@lang('priceclarify.buttons.please_wait')">@lang('priceclarify.buttons.send')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>