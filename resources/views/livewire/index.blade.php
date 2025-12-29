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
<script>
    document.addEventListener( 'livewire:navigated', () =>
    {
        AOS.init( {
            duration: 800,
            once: true,
        } );
    } );
    // Init on first load too
    document.addEventListener( 'DOMContentLoaded', () =>
    {
        AOS.init( {
            duration: 800,
            once: true,
        } );
    } );
</script>
@endassets