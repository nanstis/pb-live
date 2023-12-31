<x-service.list>
    <div class="position-relative">
        {{$slot}}
        <h6 class="text-uppercase">{{__('service.rates')}}</h6>

        <x-service.price :details="$details"/>
        <x-service.payment :details="$details"/>
        <x-service.budget :details="$details->budget"/>
        <x-service.deposit :details="$details->deposit"/>
    </div>


</x-service.list>
