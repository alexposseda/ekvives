<div class="orderFormItem noPaddingTop">
    <button class="orderFormBtn" data-toggle="modal" data-target=".bs-example-modal-sm">@lang('productform.buttons.open_modal')</button>
</div>
<!-- Small modal start -->
@push('scripts')
<script>
    $("#job_apply_form").validate({
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
<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="text-theme-colored modal-title" id="myModalLabel">@lang('productform.title')</h4>
            </div>
            <div class="modal-body">
                <p>@lang('productform.description')</p>
                <form id="job_apply_form" name="job_apply_form" action="/product" method="post" enctype="multipart/form-data">
                {{csrf_field()}}
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>@lang('productform.product_title.label')
                                    <small>*</small>
                                </label>
                                <input name="title" type="text" placeholder="@lang('productform.product_title.placeholder')" required="" value="{{$product->title}}"class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>@lang('productform.name.label')
                                    <small>*</small>
                                </label>
                                <input name="name" type="text" placeholder="@lang('productform.name.placeholder')" required="" class="form-control">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>@lang('productform.email.label')
                                    <small>*</small>
                                </label>
                                <input name="email" class="form-control required email" type="email" placeholder="@lang('productform.email.placeholder')">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>@lang('productform.company.label')
                                    <small>*</small>
                                </label>
                                <input name="company" type="text" placeholder="@lang('productform.company.placeholder')" required="" class="form-control">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>@lang('productform.phone.label')
                                    <small>*</small>
                                </label>
                                <input id="telNo" name="phone" type="tel" placeholder="@lang('productform.phone.placeholder')" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>@lang('productform.message.label')
                            <small>*</small>
                        </label>
                        <textarea name="message" class="form-control required" rows="5" placeholder="@lang('productform.message.placeholder')"></textarea>
                    </div>
                    <div class="form-group">
                        <input name="botcheck" class="form-control" type="hidden" value="" />
                        <button type="submit" class="btn btn-block btn-dark btn-theme-colored btn-sm mt-20 pt-10 pb-10" data-loading-text="@lang('productform.buttons.please_wait')">@lang('productform.buttons.send')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>