<?php ?>
        <script>try {
                Typekit.load({async: true});
            } catch (e) {
            }</script>
        <script >
            var data = "";

            function getData() {
                $.ajax({
                    dataType: "json",
                    async: true, // Makes sure to wait for load
                    url: "/js/temp/data.json", //  https://www.dropbox.com/s/fmw63i4v7dtnx6t/package.json
                    'success': function (json) {
                        var data = json;
                        // console.log(data);  // object Object
                        // Finishes loading before js starts using it, and works as intended
                    }
                });
            }
            /*
             console.log("here2");
             $.getJSON( "http://localhost/simple-responsive-timeline/data.json", function( data ) {
             console.log(data);
             });*/
        </script>
        <header class="example-header">
            <h1 class="text-center">OpenCollab TLP Timeline ( Online Learning, Sakai, TRACs )</h1>
        </header>
        <div class="container-fluid">
            <div class="row example-split">
                <div class="col-md-12 example-title">
                    <h2>Journey Begins</h2>
                </div>
                <div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2">
                    <ul class="timeline timeline-split" id="content-body">

                        <script type="text/javascript">
                            var splitStart = '<li class="timeline-item period"> ' +
                                    ' <div class="timeline-info"></div> ' +
                                    ' <div class="timeline-marker"></div> ' +
                                    ' <div class="timeline-content"> ' +
                                    '    <h2 class="timeline-title">';
                            var splitEnd = '    </h2>' +
                                    ' </div> ' +
                                    '   </li>';

                            var itemStart = '<li class="timeline-item"> ' +
                                    '<div class="timeline-info"> ' +
                                    '    <span>';
                            var itemMid = '               </span>' +
                                    '  </div>' +
                                    '  <div class="timeline-marker"></div>' +
                                    '  <div class="timeline-content">' +
                                    '      <h3 class="timeline-title">';
                            var itemMidHead = '             </h3>';
                            var itemEnd = '</div></li>';
                            try {

                                $("document").ready(function () {
                                    $.ajax({
                                        dataType: "json",
                                        async: true, // Makes sure to wait for load
                                        url: "/js/temp/data.json", //  https://www.dropbox.com/s/fmw63i4v7dtnx6t/package.json
                                        'success': function (json) {
                                            var data = json;
                                            // console.log(data);  // object Object
                                            // Finishes loading before js starts using it, and works as intended
                                            // console.log(data);
                                            $.each(data, function (key, val) {
                                                // console.log('key ='+key);
                                                // console.log('value ='+val);
                                                // console.log(val.type);
                                                if (val.type == 'period') {
                                                    $("#content-body").append(splitStart + val.title + splitEnd);
                                                    if (val.items.length > 0) {
                                                        for (var i = 0; i < val.items.length; i++) {
                                                            var obj = val.items[i];
                                                            // console.log(obj.date);
                                                            // console.log(obj.title);
                                                            $("#content-body").append(itemStart + obj.date + itemMid + obj.title + itemMidHead + obj.content + itemEnd);
                                                        }
                                                    }
                                                }
                                            });
                                            var sHeight = document.body.scrollHeight;
                                            window.scrollTo(0, document.body.scrollHeight - ((sHeight / 100) * 8.5));
                                        }
                                    });
                                });
                            } catch (e) {
                                console.log(e);
                            }
                        </script>
                    </ul>
                </div>
            </div>
        </div>

<p>Timeline code copied from <a href="http://overflowdg.com" target="_blank">Overflow</a></p>
<p>CodePen Example <a href="https://codepen.io/brady_wright/pen/NNOvrW" target="_blank">here</a></p>
<script type="text/javascript">
    try {
        $("document").ready(function () {
            getData();

        });
    } catch (e) {
        console.log(e);
    }
</script>