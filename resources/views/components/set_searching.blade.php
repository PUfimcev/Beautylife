
<div class="searching__popup">
    <div class="container_wrap d-flex flex-column justify-content-flex-start align-items-flex-start">

            <div id="searching__popup_elements" class="searching__popup_elements d-flex flex-row justify-content-between align-items-center">

                <div class="searching__group d-flex flex-row justify-content-start align-items-center">
                    <div class="searching__group__magnify-glass"></div>
                    <input class="searching__group__input" type="text" name="popup-searching" placeholder="{{ __('Search') }}">
                    <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                    <input type="hidden" name="lang" id="search_lang" value="{{ session('locale') }}">
                </div>
                <div class="searching__popup__remove-icon"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16"><path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8z"/>
                  </svg>
                </div>
            </div>
            <div class="searching__box d-flex flex-column justify-content-flex-start align-items-flex-start">
                <div class="searching__box_result">
                    <ul class="searching__box_result-list">

                    </ul>
                </div>
                <div class="result_not_found">{{ __('Data not found') }}</div>
            </div>
    </div>
</div>
