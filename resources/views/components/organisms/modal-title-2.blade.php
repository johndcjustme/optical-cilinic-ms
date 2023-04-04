@props([
    'text' => '',
])

<p {{ $attributes->merge(['class' => 'lead', 'style' => '']) }}>{{ !empty($text) ? $text : $slot }}</p>