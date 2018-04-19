<!-- The Modal -->
<div class="modal fade setting-survey" id="setting-survey">
    <div class="modal-dialog">
        <div class="modal-content modal-content-setting-create-survey">
            <div class="modal-header modal-header-setting-survey">
                <h4 class="modal-title title-setting-survey">@lang('lang.settings')</h4>
            </div>
            <ul class="nav nav-tabs nav-setting-survey" role="tablist">
                <li class="nav-item nav-item-setting-survey">
                    <a class="nav-link active" data-toggle="tab" role="tab" href="#general_settings">@lang('lang.general_settings')</a>
                </li>
                 <li class="nav-item nav-item-setting-survey">
                    <a class="nav-link" data-toggle="tab" role="tab" href="#tab-send-mails">@lang('lang.send_survey')</a>
                </li>
                 <li class="nav-item nav-item-setting-survey">
                    <a class="nav-link" data-toggle="tab" role="tab" href="#tab-add-manager">@lang('lang.add_manager')</a>
                </li>
            </ul>

            <!-- start tab settings -->
            <div class="tab-content tab-content-setting">
                <div id="general_settings" class="container tab-pane active"><br>
                    {!! Form::open() !!}
                        <div class="setting-email-create-survey">
                            <div class="item-setting">
                                <div class="setting-confirm-reply">
                                    <label class="container-checkbox-setting-survey">
                                        <span>@lang('lang.required_infomation')</span>
                                        {!! Form::checkbox('confirm_reply', '', false,
                                            ['class' => 'confirm-reply', 'id' => 'confirm-reply']) !!}
                                        <span class="checkmark-setting-survey"></span>
                                </div>
                                <div class="setting-choose-confirm-reply">
                                    <label class="container-radio-setting-survey">@lang('lang.login')
                                        {!! Form::radio('radio_request_login', '', true, ['class' => 'setting-radio-request', 'disabled']) !!}
                                        <span class="checkmark-radio"></span>
                                    </label><br>
                                    <label class="container-radio-setting-survey">@lang('lang.login_by_wsm')
                                        {!! Form::radio('radio_request_login', '', false, ['class' => 'setting-radio-request', 'disabled']) !!}
                                        <span class="checkmark-radio"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="item-setting">
                                <label class="container-checkbox-setting-survey">
                                    <span>@lang('lang.limit_replies')</span>
                                    {!! Form::checkbox('limit_number_answer', '', false,
                                        ['class' => 'limit-number-answer', 'id' => 'limit-number-answer']) !!}
                                    <span class="checkmark-setting-survey"></span>
                                </label>
                                <div class="number-limit-number-answer content-quantity">
                                    <div class="numbers-row">
                                        <div id="btn-minus-quantity" class="dec qtybutton"><i class="fa fa-minus">&nbsp;</i></div>
                                        <input type="number" class="quantity-answer" value="{{ config('settings.quantity_answer.default') }}"
                                            min="{{ config('settings.quantity_answer.min') }}"
                                            max="{{ config('settings.quantity_answer.max') }}" id="quantity-answer" name="quantity-answer">
                                        <div id="btn-plus-quantity" class="inc qtybutton"><i class="fa fa-plus">&nbsp;</i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="item-setting">
                                <div class="setting-confirm-reply">
                                    <label class="container-checkbox-setting-survey">
                                        <span>@lang('lang.send_a_reminder_email_periodically')</span>
                                        {!! Form::checkbox('checkbox_mail_remind', '', false,
                                            ['class' => 'checkbox-mail-remind', 'id' => 'checkbox-mail-remind']) !!}
                                        <span class="checkmark-setting-survey"></span>
                                </div>
                                <div class="setting-mail-remind">
                                    <label class="container-radio-setting-survey">@lang('lang.by_week')
                                        {!! Form::radio('radio_mail_remind', '', true, ['class' => 'radio-mail-remind', 'disabled']) !!}
                                        <span class="checkmark-radio"></span>
                                    </label><br>
                                    <label class="container-radio-setting-survey">@lang('lang.by_month')
                                        {!! Form::radio('radio_mail_remind', '', false, ['class' => 'radio-mail-remind', 'disabled']) !!}
                                        <span class="checkmark-radio"></span>
                                    </label><br>
                                    <label class="container-radio-setting-survey">@lang('lang.by_quarter')
                                        {!! Form::radio('radio_mail_remind', '', false, ['class' => 'radio-mail-remind', 'disabled']) !!}
                                        <span class="checkmark-radio"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="item-setting">
                                <label class="container-checkbox-setting-survey">
                                    <span>@lang('lang.private_this_survey')</span>
                                    {!! Form::checkbox('security_survey', '', false, ['class' => 'security_survey']) !!}
                                    <span class="checkmark-setting-survey"></span>
                                </label>
                            </div>
                            <div class="div-action-send-survey">
                                <a href="#" class="btn-cancel" data-dismiss="modal">@lang('lang.cancel')</a>
                                <a href="#" class="btn-send-survey">@lang('lang.save')</a>
                            </div>
                        </div>
                    {!! Form::close() !!}
                </div>
                <div id="tab-send-mails" class="container tab-pane"><br>
                    {!! Form::open() !!}
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-8">
                                    <label for="" class="label-email">@lang('lang.email')</label>
                                </div>
                                <div class="col-md-4">
                                    <label class="container-checkbox-setting-survey send-to-all">
                                        <span>@lang('lang.send_to_all')</span>
                                        {!! Form::checkbox('send_all', '', false, ['class' => 'send-to-all-wsm-acc']) !!}
                                        <span class="checkmark-setting-survey"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 div-show-all-email">
                                    {!! Form::hidden('emails_invite', '', ['class' => 'emails-invite-hidden']) !!}
                                </div>
                                <div class="col-md-12">
                                    {!! Form::text('email', null, [
                                        'class' => 'form-control input-email-send',
                                        'data-url' => route('ajax-suggest-email'),
                                        'autocomplete' => 'off',
                                        'placeholder' => trans('lang.email_placeholder'),
                                    ]) !!}
                                    <ul class="live-suggest-email">
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="label-subject">@lang('lang.subject')</label>
                            {!! Form::text('subjectEmail', trans('lang.subject_default_email'), [
                                'class' => 'form-control input-subject-email',
                            ]) !!}
                        </div>
                        <div class="form-group">
                            <label for="" class="label-message">@lang('lang.message')</label>
                            {!! Form::textarea('messageEmail', trans('lang.message_default_email'), [
                                'class' => 'form-control input-area auto-resize input-email-message',
                                'data-autoresize',
                                'rows' => 1,
                            ]) !!}
                        </div>
                        <div class="div-action-send-survey">
                            <a href="#" class="btn-cancel" data-dismiss="modal">@lang('lang.cancel')</a>
                            <a href="#" class="btn-send-survey">@lang('lang.send')</a>
                        </div>
                    {!! Form::close() !!}
                </div>
                <div id="tab-add-manager" class="container tab-pane"><br>
                    {!! Form::open() !!}
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-8">
                                    <label for="" class="label-email">@lang('lang.add_manager')</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    {!! Form::hidden('emails_member', '', ['class' => 'emails-member-hidden']) !!}
                                </div>
                                <div class="col-md-12">
                                    {!! Form::text('email', null, [
                                        'class' => 'form-control input-email-member',
                                        'id' => 'input-email-member',
                                        'data-url' => route('ajax-suggest-email'),
                                        'autocomplete' => 'off',
                                        'placeholder' => trans('lang.email_placeholder'),
                                    ]) !!}
                                    <ul class="live-suggest-member-email">
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="form-group table-member-div">
                            <table class="table-show-email-manager" border="1" cellspacing="0">
                                <thead>
                                    <tr>                                            
                                        <th>@lang('lang.email')</th>
                                        <th>@lang('lang.role')</th>
                                        <th><i class="fa fa-trash"></i></th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                        <div class="div-action-send-survey">
                            <a href="#" class="btn-cancel" data-dismiss="modal">@lang('lang.cancel')</a>
                            <a href="#" class="btn-add-member" id="btn-add-member">@lang('lang.save')</a>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
            <!-- end tab settings -->
        </div>
    </div>
</div>
