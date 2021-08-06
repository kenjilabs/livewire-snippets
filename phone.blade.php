@props([
        'id' => Str::slug($name,'_'),
        'name' => '',
        'label' => '',
        'errorName' => Str::replaceLast('state.', '', $name),
        'placeholder' => ''
    ]
)
@php($error = $errors->has($name) ? ' uk-form-danger ':'')


<div class="uk-form-controls">
    <x-input.error :for="$errorName ? $errorName : $name"/>

    @if($label)
        <x-input.label :label="$label"/>
    @endif
    <div
        wire:ignore
        x-data="{
            initPhoneInput: function (element) {
                let input = document.getElementById('{{ $id . '-input' }}');
                let iti = window.intlTelInput(input, {
                nationalMode: false,
                separateDialCode:false,
                utilsScript: '{{ asset('js/utils.js') }}',
                preferredCountries: ['ae','bh', 'sa', 'kw', 'om', 'qa' ],

                });
            }
        }"
    >
        <input
            x-ref="input"
            wire:model.lazy="{{$name}}"
            id="{{ $id }}-input"
            name="{{$name}}" autocomplete="{{$name}}"
            placeholder="{{$placeholder}}"
            value="{{ old($name) }}" {{--placeholder="{{$label}}"--}}
            {!!  $attributes->except('wire:model')->merge(['class'=>"uk-input " . $error])  !!}>
    </div>

</div>
