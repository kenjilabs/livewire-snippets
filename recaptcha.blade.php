@props([
    'name' => '',
    'errorName' => Str::replaceLast('state.','',$name),
    ])
@php($error = $errors->has($name) ? ' uk-form-danger ':'')


<div class="uk-form-controls">
    <x-input.error :for="$errorName ? $errorName : $name"/>
    <div
        wire:model="{{$name}}"
        x-data="{
                    init() {
                        grecaptcha.ready(() => {
                            grecaptcha.render(this.$el, {
                                sitekey: '{{ env('CAPTCHA_SITEKEY') }}',
                                callback: this.onComplete.bind(this)
                            });
                        });
                    },
                    execute() {
                        grecaptcha.execute();
                    },
                    reset(){
                        grecaptcha.reset();
                        console.log('dfdsfd')
                    },
                    onComplete(response) {
                        @this.set('{{$name}}', response);
                    }
                }"
        x-init="init"
        @recaptcha.window="execute"
        @refresh.window="reset"
        wire:ignore
    ></div>
</div>
@once
    @push('scripts')
        <script src="https://www.google.com/recaptcha/api.js?render=explicit"></script>
    @endpush
@endonce
