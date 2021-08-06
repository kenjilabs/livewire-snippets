@props([
    'name' => '',
    'class' => 'uk-select',
    'options' => 'Select',
    'label' => '',
    'icon' => '',
    'errorName' => Str::replaceLast('state.','',$name),
    'blockClass' => 'uk-form-controls',
])
@php($error = $errors->has($name) ? ' uk-form-danger ' : '')
<div class="{{ $blockClass }} uk-position-relative uk-select2 {{$icon?'has--icon':''}}" wire:ignore>
    <div class="select2-wrapper" x-data="{
                    selected: [],
                    $el: null,
                    init() {
                        this.$el = $(this.$refs.select);
                        this.select2 = this.$el.select2({
                            placeholder: 'Select',
                            minimumResultsForSearch: -1,
                            allowClear: true
                        });
                        this.select2.on('select2:select', (event) => {
                            this.selected = this.$el.val();
                        });
                        this.select2.on('select2:clear', (event) => {
                            this.selected = event.target.value = '';
                        });
                        this.select2.on('select2:unselect', (event) => {
                            this.selected = event.target.value = this.$el.val();
                        });
                        this.$watch('selected', (value) => {
                            @this.set('{{$name}}', value);
                            this.select2.val(value).trigger('change');
                        });
                    }
                }" x-init="init">
        <x-input.error :for="$errorName ? $errorName : $name"/>
        <span>{{$icon}}</span>
        <select wire:model.lazy="{{$name}}" x-ref="select" data-placeholder="{{$label}}"
                {!!  $attributes->except(['wire:model','option'])->merge(['class'=>"" . $error . $class])  !!}
                name="{{ $name }}"  value="{{ old($name) }}"
        >
            <option></option>
            @foreach($options as $key => $option)
                <option value="{{ $key }}" @if(old($name) == $option) selected="selected" @endif>
                    {{ __($option) }}
                </option>
            @endforeach
        </select>
    </div>
</div>
