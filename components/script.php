<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://unpkg.com/toastmejs@latest/dist/js/toastme.min.js"></script>

<!-- Project level js links -->
<script>
    class link {
        static domain() {
            return '<?= home_path() ?>';
        }
    }
</script>

<script src="<?= get_file('classes/function.js'); ?>"></script>
<script src="<?= get_file('classes/server.js') ?>"></script>
<script src="<?= get_file('script.js') ?>"></script>
<script src="<?= get_file('pop-up.js') ?>"></script>