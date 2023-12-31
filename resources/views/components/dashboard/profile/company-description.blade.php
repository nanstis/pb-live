@props([
    'partner'
])

<form method="POST"
      action="{{\Illuminate\Support\Facades\Auth::user()->type === 'admin'
       ? route('company-description.update.admin')
       : route('company-description.update')}}">
    @csrf
    <div class="edit-company-description">
        <x-partner-category-tab :tabs="[
            ucfirst(__('become_partner.french')),
            ucfirst(__('become_partner.english'))
    ]">
            <!-- French -->
            <x-tab.item>


                <div class="edit-company-section">
                    <div class="description-card-title" id="companyDescription">
                        <img src="{{Vite::image('icons/france.svg')}}" alt="english" class="me-2"/>
                    </div>


                    <div class="mt-2">
                        <div>

                            <div class="w-100">
                                <label for="fr_short_descr">{{__('partybooker-cp.short_description')}}
                                    <span class="text-danger">*</span></label>
                                <textarea name="fr_short_descr" id="editor" maxlength="350"
                                          rows="10"
                                          class="editor">{{$partner->fr_short_descr}}</textarea>

                            </div>

                            <div class="w-100">
                                <label for="fr_full_descr">{{__('partybooker-cp.full_description')}}
                                    <span class="text-danger">*</span></label>
                                <textarea name="fr_full_descr" id="fr_full_descr" maxlength="3000"
                                          rows="10"
                                          class="editor">{{$partner->fr_full_descr}}</textarea>
                            </div>
                        </div>
                    </div>

                    <x-dashboard.textarea name="fr_slogan"
                                          :label="__('partybooker-cp.slogan')"
                                          icon="heroicon-o-chat-bubble-bottom-center-text"
                                          :required="false"
                                          :max="250">{{$partner->fr_slogan}}
                    </x-dashboard.textarea>

                    <x-dashboard.profile.seo lang="fr" :partner="$partner"/>
                </div>


            </x-tab.item>

            <!-- English -->
            <x-tab.item>
                <div class="edit-company-section">
                    <div class="description-card-title">
                        <img src="{{Vite::image('icons/uk-flag.svg')}}" alt="english"/>
                    </div>


                    <div class="mt-2">
                        <label for="en_short_descr">{{__('partybooker-cp.short_description')}}
                            <span class="text-danger">*</span></label>
                        <textarea name="en_short_descr" id="en_short_descr" maxlength="350"
                                  class="editor">{{$partner->en_short_descr}}</textarea>

                        <label for="en_full_descr">{{__('partybooker-cp.full_description')}}
                            <span class="text-danger">*</span></label>
                        <textarea name="en_full_descr" id="en_full_descr" maxlength="3000"
                                  class="editor">{{$partner->en_full_descr}}</textarea>

                    </div>

                    <x-dashboard.textarea name="en_slogan"
                                          :label="__('partybooker-cp.slogan')"
                                          icon="heroicon-o-chat-bubble-bottom-center-text"
                                          :required="false"
                                          :max="250">{{$partner->en_slogan}}</x-dashboard.textarea>

                    <x-dashboard.profile.seo lang="en" :partner="$partner"/>
                </div>
            </x-tab.item>
        </x-partner-category-tab>
    </div>

    <input type="hidden" name="id_partner" value="{{$partner->id_partner}}" hidden/>


    <div class="d-flex">
        <button type="submit" class="btn btn-accent mx-3 mb-3 w-100">{{__('partner.save')}}</button>
    </div>
</form>

<script type="module">
    tinymce.init({
        selector: 'textarea.editor',
        plugins: 'advlist code emoticons link lists table',
        toolbar: 'bold italic | bullist numlist | link emoticons',
    });
</script>

