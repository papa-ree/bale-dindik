<div>
    <div data-aos="fade-down">
        <livewire:bale-dindik.landing-page.hero.index />
    </div>

    <div data-aos="fade-up">
        <livewire:bale-dindik.landing-page.application.index />
    </div>

    <div data-aos="fade-up">
        <livewire:bale-dindik.landing-page.post.index />
    </div>

    <div data-aos="fade-up">
        <livewire:bale-dindik.landing-page.event.index />
    </div>

    <div data-aos="fade-up">
        <livewire:bale-dindik.landing-page.featured-program.index />
    </div>

    <div data-aos="fade-up">
        <livewire:bale-dindik.landing-page.about.index />
    </div>
</div>

@assets
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
@endassets

@script
<script>
    // Initialize AOS immediately when script loads
    AOS.init( {
        duration: 800,
        once: false, // Allow re-animation on navigate
    } );

    // Reinitialize AOS after Livewire navigation
    document.addEventListener( 'livewire:navigated', () =>
    {
        AOS.refresh();
    } );
</script>
@endscript