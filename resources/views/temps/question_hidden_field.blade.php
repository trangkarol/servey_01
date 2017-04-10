<!-- question's image-->
{!! Form::file("image[question][$number]", [
    'class' => 'hidden-image fileImg' . $number,
]) !!}
<!-- question's image url-->
{!! Form::text("image-url[question][$number]", null, [
    'class' => 'hidden-image question-img-url' . $number,
]) !!}
<!-- question's video url-->
{!! Form::text("video-url[question][$number]", null, [
    'class' => 'hidden-image question-video-url' . $number,
]) !!}
