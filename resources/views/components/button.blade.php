<div class="col-12">
    <button {{ $attributes->merge(['type' => 'submit', 'class' => 'btn btn-primary w-100']) }}>
        {{ $slot }}
    </button>
</div>
