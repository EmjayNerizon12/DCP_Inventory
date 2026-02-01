<div>

    <label class="form-label" for="{{ $name }}">{{ $label }}
        @if ($required)
            <span class="text-red-600">(required)</span>
        @endif
    </label>

    <input type="{{ $type }}" name="{{ $name }}" @if ($required) required @endif
        @if ($type == 'number') step="0.01" @endif
        @if ($edit) id="{{ $name }}" @endif value="{{ old($name) }}"
        class="form-input @error($name)  border-red-600 @enderror">
    <div class="error text-red-500 text-sm" data-error="{{ $name }}"></div>
    <x-input-error name="{{ $name }}" />

</div>
