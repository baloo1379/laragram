@php
    echo preg_replace_callback(
        '/\#\w+/m',
        function($matches) {
            return ' <a href="/t/'.urlencode($matches[0]).'">'.$matches[0].'</a>';
        },
        e($desc ?? '')
    );
@endphp
