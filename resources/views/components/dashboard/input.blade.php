@props([
    'type' => 'text',
    'name',
    'placeholder' => '',
    'value' => '',
    'id' => '',
    'icon' => null,
    'image' => null,
    'required' => true,
    'max' => null,
    'label' => null,
    'disabled' => false
])

<div class="dashboard-input">
    @if($label)
        <label for="{{$id}}" class="form-label text-dark text-uppercase pt-2">{{$label}}</label>
    @endif

    <div class="input-group">
    <span class="input-group-text" id="{{$id}}">
        @if($icon)
            @svg($icon)
        @elseif($image)
            <img src="{{Vite::image($image . '.svg')}}" class="icon" alt="{{$image}}"/>
        @endif
    </span>

        <input
            type="{{ $type }}"
            name="{{ $name }}"
            value="{{ $value }}"
            class="form-control"
            {{$disabled ? 'disabled' : ''}}
            id="{{$id}}"
            placeholder="{{ $placeholder }}"
            aria-label="{{ $placeholder }}"
            aria-describedby="{{$id}}"
            {{$required ? 'required' : ''}}
            {{$max ? 'max-length="' . $max . '"' : ''}}>
    </div>
</div>
