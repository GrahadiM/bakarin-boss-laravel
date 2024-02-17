<!-- Feather icons -->
<script>
    feather.replace();
</script>
<!-- JavaScript Libraries -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
<!-- Feather icons -->
<script src="https://unpkg.com/feather-icons"></script>
<!-- Alpine.js -->
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
<!-- My Javascript -->
<script src="{{ asset('customer') }}/js/script.js"></script>
<!-- Bootstrap v.5 -->
{{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script> --}}
<!-- App -->
<script src="{{ asset('customer') }}/src/app.js"></script>
<!-- Midtrans App -->
<script type="text/javascript" src="https://app.stg.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>
