@props(['paginate' => ''])

<li {{ $attributes->merge(['class' => 'btn-group w-100']) }}>
    <a  class="dropdown-item" href="#" data-bs-toggle="dropdown" aria-expanded="false">
        Paginate ({{ $paginate }}) <i class="bi bi-caret-down-fill"></i>
    </a>
    <ul class="dropdown-menu">
        <x-molecules.dropdown-item w-click="$set('paginate', 10)" text="10"/>
        <x-molecules.dropdown-item w-click="$set('paginate', 15)" text="15"/>
        <x-molecules.dropdown-item w-click="$set('paginate', 30)" text="30"/>
        <x-molecules.dropdown-item w-click="$set('paginate', 50)" text="50"/>
        <x-molecules.dropdown-item w-click="$set('paginate', 70)" text="70"/>
        <x-molecules.dropdown-item w-click="$set('paginate', 100)" text="100"/>
        <x-molecules.dropdown-item w-click="$set('paginate', 150)" text="150"/>
        <x-molecules.dropdown-item w-click="$set('paginate', 200)" text="200"/>
    </ul>
</li>