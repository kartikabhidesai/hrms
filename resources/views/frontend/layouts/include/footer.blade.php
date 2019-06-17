<script src="{{ asset('frontend/js/jquery-min.js') }}"></script>
<script src="{{ asset('frontend/js/popper.min.js') }}"></script>
<script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('frontend/js/classie.js') }}"></script>
<script src="{{ asset('frontend/js/jquery.mixitup.js') }}"></script>
<script src="{{ asset('frontend/js/nivo-lightbox.js') }}"></script>
<script src="{{ asset('frontend/js/owl.carousel.js') }}"></script>
<script src="{{ asset('frontend/js/jquery.stellar.min.js') }}"></script>
<script src="{{ asset('frontend/js/jquery.nav.js') }}"></script>
<script src="{{ asset('frontend/js/scrolling-nav.js') }}"></script>
<script src="{{ asset('frontend/js/jquery.easing.min.js') }}"></script>
<script src="{{ asset('frontend/js/wow.js') }}"></script>
<script src="{{ asset('frontend/js/menu.js') }}"></script>
<script src="{{ asset('frontend/js/jquery.vide.js') }}"></script>
<script src="{{ asset('frontend/js/jquery.counterup.min.js') }}"></script>
<script src="{{ asset('frontend/js/jquery.magnific-popup.min.js') }}"></script>
<script src="{{ asset('frontend/js/waypoints.min.js') }}"></script>
<script src="{{ asset('frontend/js/form-validator.min.js') }}"></script>
<script src="{{ asset('frontend/js/contact-form-script.js') }}"></script>
<script src="{{ asset('frontend/js/main.js') }}"></script>

@if (!empty($js)) 
@foreach ($js as $value) 
<script src="{{ asset('js/'.$value) }}" type="text/javascript"></script>
@endforeach
@endif
<script>
        jQuery(document).ready(function() {
        @if (!empty($funinit))
                @foreach ($funinit as $value)
        {{  $value }}
        @endforeach
                @endif
        });
</script>
@section('scripts')
@show