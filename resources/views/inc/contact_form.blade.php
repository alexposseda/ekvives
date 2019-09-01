<h3 class="line-bottom mt-0 mb-30">@lang('contactform.title')</h3>
<!-- Contact Form -->
<form id="contact_form" name="contact_form" action="/contact" method="post">
{{csrf_field()}}
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label>@lang('contactform.name.label')
                    <small>*</small>
                </label>
                <input name="name" class="form-control" type="text" placeholder="@lang('contactform.name.placeholder')" required="">
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label>@lang('contactform.email.label')
                    <small>*</small>
                </label>
                <input name="email" class="form-control required email" type="email" placeholder="@lang('contactform.email.placeholder')">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label>@lang('contactform.subject.label')
                    <small>*</small>
                </label>
                <input name="subject" class="form-control required" type="text" placeholder="@lang('contactform.subject.placeholder')">
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label>@lang('contactform.phone.label')</label>
                <input name="phone" class="form-control" type="text" placeholder="@lang('contactform.phone.placeholder')">
            </div>
        </div>
    </div>
    <div class="form-group">
        <label>@lang('contactform.message.label')</label>
        <textarea name="message" class="form-control required" rows="5" placeholder="@lang('contactform.message.placeholder')"></textarea>
    </div>
    <div class="form-group">
        <input name="botcheck" class="form-control" type="hidden" value="" />
        <button type="submit" class="btn btn-dark btn-theme-colored btn-flat mr-5" data-loading-text="@lang('contactform.buttons.please_wait')">@lang('contactform.buttons.send')</button>
        <button type="reset" class="btn btn-default btn-flat btn-theme-colored">@lang('contactform.buttons.clear')</button>
    </div>
</form>
<!-- Contact Form Validation-->
@push('scripts')
<script type="text/javascript">
    $("#contact_form").validate({
        submitHandler: function (form) {
            var form_btn = $(form).find('button[type="submit"]');
            var form_result_div = '#form-result';
            $(form_result_div).remove();
            form_btn.before(
                '<div id="form-result" class="alert alert-success" role="alert" style="display: none;"></div>'
            );
            var form_btn_old_msg = form_btn.html();
            form_btn.html(form_btn.prop('disabled', true).data("loading-text"));
            $(form).ajaxSubmit({
                dataType: 'json',
                success: function (data) {
                    if (data.status == 'true') {
                        $(form).find('.form-control').val('');
                    }
                    form_btn.prop('disabled', false).html(form_btn_old_msg);
                    $(form_result_div).html(data.message).fadeIn('slow');
                    setTimeout(function () {
                        $(form_result_div).fadeOut('slow')
                    }, 6000);
                }
            });
        }
    });
</script>
@endpush