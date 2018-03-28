<div class="modal fade" id="modalForgotPassword" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content form-elegant">
            <div class="modal-header text-center">
                <h3 class="modal-title w-100 dark-grey-text font-weight-bold my-3" id="myModalLabel">
                    <strong>@lang('lang.reset_password')</strong>
                </h3>
                <button type="button" class="close btn-close-form" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body mx-4">
                <div class="md-form mb-5">
                    {{ Form::email('email', old('email'), [
                        'class' => 'form-control validate',
                        'placeholder' => trans('lang.email_placeholder'),
                    ]) }}
                    <label data-error="wrong" data-success="right" for="elegantFormModalInput1" >@lang('lang.email')</label>
                </div>
                <div class="text-center mb-3">
                    {{ Form::button(trans('lang.reset_password'), [
                        'type' => 'button',
                        'class' => 'btn blue-gradient btn-block btn-rounded z-depth-1a',
                    ]) }}
                </div>
            </div>
            <div class="modal-footer mx-5 pt-3 mb-1">
                <p class="font-small grey-text d-flex justify-content-end">@lang('lang.not_a_member')
                    <a href="#" data-toggle="modal" data-dismiss="modal" data-target="#modalRegister" class="blue-text ml-1">
                        @lang('lang.sign_up')
                    </a>
                </p>
            </div>
        </div>
    </div>
</div>
