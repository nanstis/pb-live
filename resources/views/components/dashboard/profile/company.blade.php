@props([
    'partner',
    'location'
])


<div>
    @if($partner->logo)
        <div class="logo-image">
            <img src="{{ asset('/storage/logos/'.$partner->logo)}}" alt="logo"
                 class="cp-company-logo">
        </div>
    @else
        <div class="pt-3">
            <x-dashboard.card-info>
                {{__('partner.choose_logo')}}
            </x-dashboard.card-info>
        </div>
    @endif
    <hr>

    <div>
        <x-dashboard.company-info :tooltip="__('become_partner.company_name')" icon="heroicon-o-home-modern">
            @if (app()->getLocale() == 'en')
                {{$partner->en_company_name}}
            @else
                {{$partner->fr_company_name}}
            @endif
        </x-dashboard.company-info>

        <x-dashboard.company-info :tooltip="__('become_partner.phone')" icon="heroicon-o-phone">
            {{$partner->company_phone}}
        </x-dashboard.company-info>
    </div>
</div>


<hr>
<div class="locale-card">
    <x-dashboard.profile.locale
        :location="$location"
        :partner="$partner"/>
</div>

<div class="company-details">
    <div class="company-details-languages">
        <h5 class="text-uppercase">
            {{__('become_partner.languages')}}
        </h5>
        <div class="d-flex">
            @foreach(json_decode($partner->language) as $language)
                @if($language != 'other')
                    <img src="{{Vite::image(trim($language . '.svg'))}}" alt="{{$language}}" width="20"/>
                @endif
            @endforeach
        </div>
    </div>

    <div class="d-flex justify-content-end">
        <small>
            {{__('become_partner.fax')}}
            @if($partner->fax)
                {{$partner->fax}}
            @else
                @svg('heroicon-o-no-symbol')
            @endif
        </small>
    </div>
</div>


@include('web.partner.popup.edit-company')


