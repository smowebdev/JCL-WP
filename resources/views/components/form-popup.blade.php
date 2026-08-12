@props([
    'forms' => [],
])<div class="popup-form " data-form-popup>
    <div class="popup-form__overlay absolute inset-0 bg-black/45 js-form-close"></div>

    <aside class="popup-form__panel absolute top-0 right-0 h-full overflow-y-auto bg-white w-full md:w-[min(600px,100%)]"
        role="dialog" aria-modal="true">
        <button type="button"
            class="cursor-pointer absolute top-5 right-5 w-8 h-8 flex flex-col items-center justify-center z-2 popup-form__close js-form-close"
            aria-label="Close form">
            <span class="w-6 h-px bg-primary"></span>
            <span class="w-6 h-px bg-primary"></span>
        </button>

        <div class="popup-form__content w-full relative px-page-x py-section-y-s">

            @foreach ($forms as $form)
                @if (!empty($form['shortcode']))
                    <div class="form-content my-6 md:my-10 hidden" data-form-content="{{ $form['type'] }}">
                        {!! do_shortcode($form['shortcode']) !!}
                    </div>
                @endif
            @endforeach

        </div>
    </aside>
</div>
