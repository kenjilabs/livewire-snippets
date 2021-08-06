@props(['for'])
@error($for)
    <p {!! $attributes->merge(['class' => 'uk-alert uk-form-item-error uk-alert-danger uk-margin-remove uk-text-small']) !!}>{{ $message }}</p>
@enderror
