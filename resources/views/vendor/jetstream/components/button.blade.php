<button {{ $attributes->merge(['type' => 'submit', 'class' => 'btn btn-primary btn-user btn-block']) }}>
    {{ $slot }}
</button>
