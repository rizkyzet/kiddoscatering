<script>
    $(document).ready(function() {
        $(window).scroll(function() {
            var wScroll = $(this).scrollTop();



            $('.jumbotron h1').css({
                'transform': 'translate(0px,' + wScroll / 3.5 + '%)'
            });

            if (wScroll > $('.working-1').offset().top - 650) {
                $('.working-1').addClass('muncul');
            }
            if (wScroll > $('.working-2').offset().top - 650) {
                $('.working-2').addClass('muncul');
            }
            if (wScroll > $('.working-3').offset().top - 650) {
                $('.working-3').addClass('muncul');
            }

        });
    });
</script>