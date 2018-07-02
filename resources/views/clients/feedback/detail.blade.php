<div class="modal fade" id="modal-feedback-detail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content form-elegant">
            <div class="modal-header text-center">
                <h3 class="modal-title w-100 dark-grey-text font-weight-bold my-3" id="myModalLabel">
                    <strong>@lang('lang.feedback_detail')</strong>
                </h3>
                <button type="button" class="close btn-close-form" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body mx-4">
                <div class="md-form mb-5">
                    {{ Form::text('name', '', [
                        'class' => 'form-control validate feedback-detail-name',
                        'disable',
                        'readonly',
                    ]) }}
                    {{ Form::label('name', trans('lang.name'), ['data-error' => ' ', 'data-success' => ' ', 'class' => 'feedback-detail-label']) }}
                </div>
                <div class="md-form mb-5">
                    {{ Form::email('email', '', [
                        'class' => 'form-control validate feedback-detail-email',
                        'disable',
                        'readonly',
                    ]) }}
                    {{ Form::label('name', trans('lang.email'), ['data-error' => ' ', 'data-success' => ' ', 'class' => 'feedback-detail-label']) }}
                </div>
                <div class="md-form pb-3">
                    {{ Form::textarea('content', '', [
                        'class' => 'form-control validate md-textarea feedback-detail-content',
                        'rows' => 8,
                        'disable',
                        'readonly',
                    ]) }}
                    {{ Form::label('name', trans('lang.feedback_content'), ['data-error' => ' ', 'data-success' => ' ', 'class' => 'feedback-detail-label']) }}
                </div>
            </div>
        </div>
    </div>
</div>
