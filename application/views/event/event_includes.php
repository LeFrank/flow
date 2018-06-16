<?php ?>
<script src="/js/third_party/ckeditor/ckeditor.js"></script>
<link rel="stylesheet" type="text/css" href="/css/jquery.datetimepicker.css" />
<script src="/js/jquery.datetimepicker.js"></script>
<script src="/js/third_party/jquery-ui.min.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript">
    CKEDITOR.replace( 'content' );
    $(function() {
        $("#start_date").datetimepicker();
        $("#end_date").datetimepicker();
    });
 
</script>
<script type="text/javascript" src="/js/client/index.js" ></script>