<x-service.list>
    <div class="position-relative">
        {{$slot}}
        <h6 class="text-uppercase">{{__('service.schedule')}}</h6>

        <x-service.working-days :days="$details->working_days"/>
        <x-service.shift :details="$details"/>
        <x-service.holidays :details="$details->holidays"/>
        <x-service.extension :details="$details"/>

        <x-service.list-item :title="__('partner.opening_upon_appointment')">
            <x-service.list-bool :value="$details->opening_upon"/>
        </x-service.list-item>
    </div>

</x-service.list>
