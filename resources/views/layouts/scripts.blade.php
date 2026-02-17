@push('scripts')
<script>
    // Initialisation des composants
    document.addEventListener('DOMContentLoaded', function() {
        @stack('page-scripts')
    });
</script>
@endpush