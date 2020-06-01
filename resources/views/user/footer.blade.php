</div>
<script type="text/javascript">
    $('#input1').change(function() {
        var $this = $(this),
            value = $this.val();
        alert(value);
    });
    $('#textbox1').change(function() {
        var $this = $(this),
            value = $this.val();
        alert(value);
    });
    $('[data-name="disable-button"]').click(function() {
        $('[data-mddatetimepicker="true"][data-targetselector="#input1"]').MdPersianDateTimePicker('disable', true);
    });
    $('[data-name="enable-button"]').click(function() {
        $('[data-mddatetimepicker="true"][data-targetselector="#input1"]').MdPersianDateTimePicker('disable', false);
    });
</script>


<script src="/as/js/jalaali.js" type="text/javascript"></script>
<script src="/as/js/jquery.Bootstrap-PersianDateTimePicker.js" type="text/javascript"></script>

<script src="/user/js/bootstrap.min.js"></script>
<script src="/user/js/jquery.min.js"></script>
<script src="/user/js/popper.js"></script>
<script src="/user/js/main.js"></script>
<script src="/js/app.js"></script>
</body>

</html>