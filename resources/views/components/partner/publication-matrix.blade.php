@props([
    'partner',
    'matrix'
])

@php($canPublish = [])
@foreach($matrix as $key => $value)
    @php($canPublish[] = $value)
@endforeach


<div class="d-flex mb-4">
    <div class="matrix-card">
        <div class="d-flex flex-column">

            @if(!$matrix['choosePlan'])
                <x-dashboard.card-info :targets="[
                        'editPlanAdmin-button',
                    ]">
                    {{__('partner.choose_yearly_plan')}}
                </x-dashboard.card-info>
            @else
                <div class="publish-matrix-check">
                    <div>
                        @svg('heroicon-o-check-circle')
                    </div>
                    <div class="matrix-check-content">
                        <span>{{__('partner.matrix_thumbnail_good')}}</span>
                    </div>
                </div>
            @endif

            @if(!$matrix['chooseThumbnail'])
                <x-dashboard.card-info :targets="[
                        'editMainImageModel-button',
                    ]">
                    {{__('partner.choose_thumbnail')}}
                </x-dashboard.card-info>
            @else
                <div class="publish-matrix-check">
                    <div>
                        @svg('heroicon-o-check-circle')
                    </div>
                    <div class="matrix-check-content">
                        <span>{{__('partner.matrix_thumbnail_good')}}</span>
                    </div>
                </div>
            @endif


            @if(!$matrix['chooseCategory'])
                <x-dashboard.card-info :targets="[
                        'tab-1-2',
                        'editCategory-button',
                    ]">
                    {{__('partner.choose_category')}}
                </x-dashboard.card-info>
            @else
                <div class="publish-matrix-check">
                    <div>
                        @svg('heroicon-o-check-circle')
                    </div>
                    <div class="matrix-check-content">
                        <span>{{__('partner.matrix_category_good')}}</span>
                    </div>
                </div>
            @endif

            @if(!$matrix['serviceDetails'])
                <x-dashboard.card-info :targets="[
                        'tab-1-2',
                        'create0'
                    ]">
                    {{__('partner.fill_service_details')}}
                </x-dashboard.card-info>
            @else
                <div class="publish-matrix-check">
                    <div>
                        @svg('heroicon-o-check-circle')
                    </div>
                    <div class="matrix-check-content">
                        <span>{{__('partner.matrix_service_good')}}</span>
                    </div>
                </div>
            @endif
            @if(!$matrix['companyDetails'])
                <x-dashboard.card-info :targets="[
                        'tab-2-2',
                        'companyDescription'
                    ]">
                    {{__('partner.fill_company_details')}}
                </x-dashboard.card-info>
            @else
                <div class="publish-matrix-check">
                    <div>
                        @svg('heroicon-o-check-circle')
                    </div>
                    <div class="matrix-check-content">
                        <span>{{__('partner.matrix_company_good')}}</span>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>


