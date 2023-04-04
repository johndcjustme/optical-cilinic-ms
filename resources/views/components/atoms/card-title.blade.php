@prop([
    'title' => ''
])
<h5 {{ $attribute->merge(['class' => 'card-title', 'style' => '']) }}>{{ $title ? $slot }}</h5>
