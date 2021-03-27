<script src="js/config.js" type="text/javascript"></script>
<script src="css/global/plugins.bundle.js" type="text/javascript"></script>
<script src="js/scripts.bundle.js" type="text/javascript"></script>
<script>
    var _token = "{{ csrf_token() }}";
</script>
@stack('scripts') <!-- Load Scripts Dynamically -->
