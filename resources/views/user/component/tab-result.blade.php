<div class="tab-content">
    <div id="home" class="home{{ $survey->id }} tab-pane fade in active">
        @include('user.result.chart')
    </div>
    <div id="menu1" class="menu1{{ $survey->id }} tab-pane fade in">
        @include('user.result.detail-result')
    </div>
    @if ($listUserAnswer)
        <div id="menu3" class="menu3{{ $survey->id }} tab-pane fade in">
            @include('user.result.users-answer')
        </div>
    @endif
    @if ($history)
        <div id="menu2" class="tab-pane fade in">
            @include('user.result.history')
        </div>
    @endif
</div>
