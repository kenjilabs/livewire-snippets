# livewire-snippets

### blade component with intlTel jquery plugin and Alpine.js
<x-input.phone name="phone" placeholder="{{__('Phone')}}"/>

### blade component with select2 plugin and Alpine.js
<x-input.select2 name="category" multiple="multiple"  :options="$categories" label="{{__('Categories')}}" />

### blade component with recaptcha plugin and Alpine.js
<x-input.recaptcha name="g-recaptcha-response"/>
