<h4 class="title-question">{{ $question->title }}</h4>
<div class="img-preview-question-survey videoWrapper">
    <iframe src="{{ $question->url_media }}"
        frameborder="0">
    </iframe>
</div>
<div class="form-group form-group-description-section">
    <span class="description-question">{!! $question->description !!}</span>
</div>
