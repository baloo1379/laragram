@php
    echo preg_replace_callback(
        '/\#\w+/m',
        function($matches) {
            return ' <a href="/t/'.substr($matches[0], 1).'">'.$matches[0].'</a>';
        },
        e($desc ?? '')
    );
@endphp
