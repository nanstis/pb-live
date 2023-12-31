@php use App\Http\Middleware\LocaleMiddleware; @endphp
@extends('web.main')
@section('page')
    page="cp"
@endsection

@section('title')
    <title>Advert | {{ __('partybooker-cp.www')}}</title>
@endsection


@push('header')
    <link rel="stylesheet" href="{{ asset('/plugins/kendo/kendo.common.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/plugins/kendo/kendo.default.min.css') }}">
@endpush

@push('footer')
@endpush

@section('content')

    @php
        $planUrl = url(LocaleMiddleware::getLocale().'/partner-cp/'.$user->id_partner) . '/plans'
    @endphp

    @if(\Illuminate\Support\Facades\Auth::user()->type === 'admin')
        <a href="/cp" class="btn btn-orange">
            CP
        </a>
    @endif

    <div class="dashboard-top-options">
        @if(!in_array(strtolower($user->partnerInfo->plan), ['basic', 'commission']))
            <div class="d-flex justify-content-between">
                <div class="d-flex align-items-center">
                    <h5 class="text-uppercase fw-bold">{{__('partner.plan_options')}}</h5>
                </div>

                <x-dashboard.profile.options
                    :partner="$user->partnerInfo"
                    :partner-options="$partnerPlanOptions"
                    :options="$planOptions"
                />
            </div>
        @endif

        <div class="d-flex justify-content-between">
            <div class="d-flex align-items-center">
                <h5 class="text-uppercase fw-bold">{{__('partner.statistics')}}</h5>
            </div>
            <x-dashboard.profile.statistics :statistics="$user->partnerInfo->statistic"/>
        </div>
    </div>

    <div class="dashboard-body">
        <div class="row">
            <div class="col-xl-8 col-lg-7 col-md-12">
                <x-dashboard.header :user="$user" :plans="$plans">
                    <div class="advert-preview profile-info advert-info">
                        @if(!$advertService->canPublish($user->id_partner))
                            <x-partner.publication-matrix :partner="$user->partnerInfo" :matrix="$canPublishMatrix"/>
                        @endif
                    </div>
                </x-dashboard.header>

                <div class="category-card">
                    <x-dashboard.card :title="__('partner.categories')">
                        <x-dashboard.profile.category
                            :partner="$user->partnerInfo"
                            :partner-categories="$currentCategories"
                            :active-options="$planOptions"
                            :partner-options="$partnerPlanOptions"
                            :categories="$categoriesList"/>
                    </x-dashboard.card>
                </div>

                <x-dashboard.profile.pages
                    :gallery-images="$categoryImages"
                    :event-types="$eventTypes"
                    :partner-et="$partnerEventTypes"
                    :user="$user"/>
            </div>

            <div class="col-xl-4 col-lg-5 col-md-12">
                <x-dashboard.profile.thumbnail
                    :partner="$user->partnerInfo"
                    :thumbnail="$thumbnail"/>

                <x-dashboard.profile.publish :partner="$user->partnerInfo" :service="$advertService"/>

                <x-dashboard.card
                    :title="__('partner.based_on') . ' ' . ($user->partnerInfo->votes ?? 0) . ' ' . Str::plural(__('partner.rates'), $user->partnerInfo->votes ? $user->partnerInfo->votes : 1)">
                    <div class="advert-review">
                        @include('web.partner.partials.dashboard.evaluation')
                    </div>
                </x-dashboard.card>

                <div class="company-card-top">
                    <x-dashboard.card :title="__('become_partner.company_info')">
                        <x-dashboard.profile.company :partner="$user->partnerInfo" :location="$location"/>
                    </x-dashboard.card>
                </div>

                <x-dashboard.card :title="__('partner.socials')">
                    <x-dashboard.profile.networks :partner="$user->partnerInfo"/>
                </x-dashboard.card>

                <x-dashboard.card :title="__('become_partner.contact_details')">
                    <x-dashboard.profile.contact-details :user="$user"/>
                </x-dashboard.card>

            </div>
        </div>
    </div>
@endsection
