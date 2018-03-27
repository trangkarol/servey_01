<div class="modal fade" id="modalRegister" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content form-elegant">
            <div class="modal-header text-center">
                <h3 class="modal-title w-100 dark-grey-text font-weight-bold my-3" id="myModalLabel">
                    <strong>@lang('lang.sign_up')</strong>
                </h3>
                <button type="button" class="close btn-close-form" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body mx-4">
                <div class="md-form mb-5">
                    {{ Form::email('name', old('name'), [
                        'class' => 'form-control validate',
                        'placeholder' => trans('lang.name_placeholder'),
                    ]) }}
                    {{ Form::label('name', trans('lang.name'), ['data-error' => ' ', 'data-success' => ' ', ]) }}
                </div>
                <div class="md-form mb-5">
                    {{ Form::email('email', old('email'), [
                        'class' => 'form-control validate',
                        'placeholder' => trans('lang.email_placeholder'),
                    ]) }}
                    {{ Form::label('email', trans('lang.email'), ['data-error' => ' ', 'data-success' => ' ', ]) }}
                </div>
                <div class="md-form mb-5">
                    {{ Form::password('password', [
                        'class' => 'form-control validate',
                        'placeholder' => trans('lang.password_placeholder'),
                    ]) }}
                    {{ Form::label('password', trans('lang.password'), ['data-error' => ' ', 'data-success' => ' ', ]) }}
                </div>
                <div class="md-form mb-3">
                    {{ Form::password('password_confirmation', [
                        'class' => 'form-control validate',
                        'placeholder' => trans('lang.password_placeholder'),
                    ]) }}
                    {{ Form::label('password_confirmation', trans('lang.password'), ['data-error' => ' ', 'data-success' => ' ', ]) }}
                </div>
                <div class="text-center mb-3">
                    {{ Form::button(trans('lang.sign_up'), ['class' => 'btn blue-gradient btn-block btn-rounded z-depth-1a', ]) }}
                </div>
                <p class="font-small dark-grey-text text-right d-flex justify-content-center mb-3 pt-2"> @lang('lang.or_sign_in_with')</p>
                <div class="row my-3 d-flex justify-content-center">
                    {{ Form::button('<i class="fa fa-facebook text-center"></i>', ['class' => 'btn btn-blue btn-rounded mr-md-3 z-depth-1a', ]) }}
                    {{ Form::button('<i class="fa fa-twitter"></i>', ['class' => 'btn btn-white btn-rounded mr-md-3 z-depth-1a', ]) }}
                    {{ Form::button(' ', ['class' => 'btn btn-orange btn-rounded mr-md-3 z-depth-1a', 'id' => 'bt-login-wsm', ]) }}
                    {{ Form::button('<i class="fa fa-google-plus"></i>', ['class' => 'btn btn-red btn-rounded z-depth-1a', ]) }}
                </div>
            </div>
            <div class="modal-footer mx-5 pt-3 mb-1">
                <p class="font-small grey-text d-flex justify-content-end">
                    @lang('lang.already_has_an_account')
                    <a href="#" data-toggle="modal" data-dismiss="modal" data-target="#modalLogin" class="blue-text ml-1">
                        @lang('lang.sign_in')
                    </a>
                </p>
            </div>
        </div>
    </div>
</div>
