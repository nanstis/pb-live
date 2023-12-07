@props([
    'accordion',
    'class'
])

<div class="welcome {{$class}}">
    <div class="accordion" id="{{$accordion}}">
        <div class="card-group">
            <div class="card-container">
                {{$slot}}
            </div>
        </div>
    </div>
</div>
