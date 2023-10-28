@if (Auth::user()->type == 'admin')
    @if (app()->getLocale() == 'en')
        <h1 class="text-uppercase text-center fw-bold display-4 mb-5">{{$user->partnerInfo->en_company_name}}</h1>
    @else
        <h1 class="text-uppercase text-center fw-bold display-4 mb-5">{{$user->partnerInfo->fr_company_name}}</h1>
    @endif

@else
    <h1 class="text-uppercase text-center fw-bold display-4 mb-5">Dashboard</h1>
@endif
