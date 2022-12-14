@if (session()->has('unschedule'))
    <div class="uk-alert-warning uk-margin-remove-top" uk-alert>
        <a class="uk-alert-close" uk-close></a>
        <p>{{ session('unschedule') }}</p>
    </div>
@elseif (session()->has('inserted'))
    <div class="uk-alert-success uk-margin-remove-top" uk-alert>
        <a class="uk-alert-close" uk-close></a>
        <p>{{ session('inserted') }}</p>
    </div>
@elseif (session()->has('filled'))
    <div class="uk-alert-primary uk-margin-remove-top" uk-alert>
        <a class="uk-alert-close" uk-close></a>
        <p>{{ session('filled') }}</p>
    </div>
@endif