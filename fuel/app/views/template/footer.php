<div id="l-footer">
    &copy; Copyright todoリスト <?= date('Y') ?>. All Rights Reserved.
</div>
<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<!-- <?= Asset::js('fixfooter.js') ?> -->
<script>
    $(function() {

        var $toggleMsg = $('.js-toggle-msg');
        if ($toggleMsg.length) {
            $toggleMsg.slideDown();
            setTimeout(function() {
                $toggleMsg.slideUp();
            }, 3000);
        }
    });
</script>