<!-- answer's image -->
{!! Form::file("image[answers][$number][]", [
    'class' => 'hidden-image fileImgAnswer' . $number . $numberAnswer,
]) !!}
<!-- answer's image url -->
{!! Form::text("image-url[answers][$number][]", null, [
    'class' => 'hidden-image answer-img-url' . $number . $numberAnswer,
]) !!}
<!-- answer's video url -->
{!! Form::text("video-url[answers][$number][]", null, [
    'class' => 'hidden-image answer-video-url' . $number . $numberAnswer,
]) !!}
