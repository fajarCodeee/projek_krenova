<div class="mb-3">
    {{-- label --}}
    @if ($label)
        <label for="{{ $name }}" class="form-label">{{ $label }} @if ($required != false)
                <span class="text-danger">*</span>
            @endif
        </label>
    @endif

    @if ($type == 'textarea')
        {{-- textarea --}}
        <textarea class="form-control @error($model)
    is-invalid @enderror" id="{{ $name }}" name="{{ $name }}"
            @if ($model) wire:model='{{ $model }}' @endif
            @if ($required == true) required @endif @if ($disable == true) disabled @endif></textarea>
    @else
        {{-- input form --}}
        <input class="form-control @error($model)
    is-invalid
    @enderror" type="{{ $type }}"
            placeholder="{{ $label }}" name="{{ $name }}" id="{{ $name }}"
            @if ($model) wire:model='{{ $model }}' value="{{ $model }}" @endif
            @if ($required == true) required @endif @if ($disable == true) disabled @endif>
    @endif

    @error($name)
        <span class="invalid-feedback">{{ $message }}</span>
    @enderror
</div>
