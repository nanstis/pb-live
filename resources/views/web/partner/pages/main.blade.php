@php use App\Models\Advert; @endphp
@php use App\Http\Middleware\LocaleMiddleware; @endphp

@extends('web.main')
@section('page')
    page="cp"
@endsection

@section('title')
    <title>CP | {{ __('partybooker-cp.www')}}</title>
@endsection

@section('content')
    <div class="tab" tab="main" style="display: block">

        @if (Auth::user()->type == 'admin')
            <x-dashboard.card title="Administration">
                <div class="admin">
                    @include('web.partner.partials.dashboard.discount')
                </div>
            </x-dashboard.card>
        @endif


        <div class="col-12">
            <div class="dashboard-item">

            </div>
        </div>


        <div class="card">
            @if ($user->partnerInfo->discount)
                <ul>
                    <li><span>{{ __('partybooker-cp.discount') }}:</span>
                        {{ $user->partnerInfo->discount }} %
                    </li>
                </ul>
            @endif
        </div>


        @if ($user->partnerInfo->vipPlan)
            <ul>
                <li><span>{{ __('partner.plan_up') }}:</span>
                    VIP
                </li>
                <li><span>{{ __('partner.payment') }}: </span>
                    @if (
                        !$user->partnerInfo->vipPlan->is_payed ||
                            ($user->partnerInfo->vipPlan->end_date && date('Y-m-d') > $user->partnerInfo->vipPlan->end_date))
                        N/A
                    @else
                        {{ __('partner.paid_on') }} {{ $user->partnerInfo->vipPlan->start_date }}
                    @endif
                </li>
                <li><span>{{ __('partner.expire') }}: </span>
                    {{ $user->partnerInfo->vipPlan->end_date ?? 'N/A' }}
                </li>

                @if (
                    !$user->partnerInfo->vipPlan->is_payed ||
                        ($user->partnerInfo->vipPlan->end_date && date('Y-m-d') > $user->partnerInfo->vipPlan->end_date))
                    <li class="topay"><a href="#plan" class="button">{{ __('partner.make_payment') }}</a></li>
                @endif
            </ul>
        @endif
    </div>

@endsection
