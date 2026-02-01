 <div>
     <label class="form-label" for="{{ $name }}">{{ $label }}
         @if ($required)
             <span class="text-red-600">(required)
             </span>
         @endif
     </label>
     <select name="{{ $name }}" @if ($edit) id="{{ $name }}" @endif
         @if ($required) required @endif class="form-input @error($name) border-red-600 @enderror">
         <option value="">Select</option>
         @foreach ($options as $option)
             <option {{ old($name) == ($option[$valueField] ?? $option->$valueField) ? 'selected' : '' }}
                 value="{{ $option[$valueField] ?? $option->$valueField }}">
                 {{ $option[$textField] ?? $option->$textField }}</option>
         @endforeach
     </select>
     <div class="error text-red-500 text-sm" data-error="{{ $name }}"></div>
     <x-input-error name="{{ $name }}" />

 </div>
