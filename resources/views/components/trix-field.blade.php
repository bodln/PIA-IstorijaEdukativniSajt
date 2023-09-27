@props(['id', 'name', 'value' => ''])

<input
    type="hidden"
    name="{{ $name }}"
    id="{{ $id }}_input"
    value="{{ $value }}"
/>
<trix-editor
    id="{{ $id }}"
    input="{{ $id }}_input"
    style="overflow: scroll; padding: 0px 15px; height: 400px;"
    {{ $attributes->merge(['class' => 'trix-content rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50']) }}
    data-controller="trix"
    data-action="trix-attachment-add->trix#upload"
></trix-editor>
