<?php ?>
<script src="/js/third_party/ckeditor/ckeditor.js"></script>
<link rel="stylesheet" type="text/css" href="/css/jquery.datetimepicker.css" />
<script src="/js/jquery.datetimepicker.js"></script>
<script src="/js/third_party/jquery-ui.min.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript">
    CKEDITOR.replace( 'description' );
    $(function() {
        $("#created_date").datetimepicker();
    });
 
</script>
<script type="text/javascript" src="/js/project/index.js" ></script>