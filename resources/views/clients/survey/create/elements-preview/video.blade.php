<h4 class="title-question">{{ $question->title }}</h4>

@if ($question->media)
    <div class="img-preview-question-survey videoWrapper">
        <iframe src="{{ $question->media }}"
            frameborder="0">
        </iframe>
    </div>
@endif

<div class="form-group form-group-description-section">
    <span>{{ $question->description }}</span>
</div>
