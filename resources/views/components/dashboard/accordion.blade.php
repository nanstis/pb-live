@props([
    'open' => false,
    'title',
    'name',
])

<div class="accordion" id="{{$name}}">
    <div class="accordion-item">
        <h2 class="accordion-header border-0">
            <button class="accordion-button w-100 text-uppercase fw-bold" type="button" data-bs-toggle="collapse"
                    data-bs-target="{{'#collapse' . $name}}"
                    aria-expanded="false" aria-controls="collapseOne">
                {{$title}}
            </button>
        </h2>
        <div id="{{'collapse' . $name}}" class="accordion-collapse collapse {{$open ? 'show' : ''}}"
             data-bs-parent="{{'#'. $name}}">
            <div class="accordion-body h-100 w-100">
                {{$slot}}
            </div>
        </div>
    </div>
</div>
