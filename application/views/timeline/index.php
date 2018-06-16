<?php
//echo "<pre>";
//print_r($events);
//echo "projects <br/>";
//print_r($projects);
//echo "teams <br/>";
//print_r($teams);
//echo "team members <br/>";
//print_r($team_members);
//echo "</pre>";
?>
<script>try {
        Typekit.load({async: true});
    } catch (e) {
    }</script>
<script >
    var data = "";

    function getData() {
        var data = <?php echo json_encode($events) ?>;
    }
    /*
     console.log("here2");
     $.getJSON( "http://localhost/simple-responsive-timeline/data.json", function( data ) {
     console.log(data);
     });*/
</script>

<?php
/*
 *                       var splitEnd = '    </h2>' +
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
 */
?>
<!--<header class="example-header" style="width:100%;">
    <h1 class="text-center">OpenCollab TLP Timeline ( Online Learning, Sakai, TRACs )</h1>
</header>-->
<div class="row expanded">
    <?php echo form_open('/timeline') ?>
    <div class="large-4 columns" >
        <label>
            from<input type="text" name="fromDate" id="fromDate" value="<?php echo $startDate; ?>"/>
        </label>
    </div>
    <div class="large-4 columns" >
        <label>
            To<input type="text" name="toDate" id="toDate" value="<?php echo $endDate; ?>"/> 
        </label>
    </div>
    <div class="large-4 columns" style="vertical-align: central;margin-top:15px;" >
        <input type="submit" name="filter" value="Filter" id="filter"  class="button"/>
    </div>
    <?php echo form_close(); ?>
</div>
<div class="container-fluid" style="width:100%;">
    <div class="row example-split">
        <div class="col-md-12 example-title">
            <h2>Journey Begins</h2>
        </div>
        <div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2">
            <ul class="timeline timeline-split" id="content-body">
<?php
$firstYear = date_format(date_create($events[0]["start_date"]), "Y");
$pastYear = "";
$pastMonth = "";
$count = 0;
foreach ($events as $k => $v) {
    $curYear = date_format(date_create($v["start_date"]), "Y");
    $curMonth = date_format(date_create($v["start_date"]), "m");
    if (
            ($firstYear == $curYear && $count == 0) ||
            ($pastYear != $curYear)
    ) {
        ?>
                        <li class="timeline-item period"> 
                            <div class="timeline-info"></div>
                            <div class="timeline-marker"></div>
                            <div class="timeline-content">
                                <h1 class="timeline-title">
                                    <span   style="font-size:2em; color:Tomato"><i class="fab fa-gripfire"></i></span> 
                                    <?php echo date_format(date_create($v["start_date"]), "Y");?><span   style="font-size:2em; color:Tomato"><i class="fab fa-gripfire"></i></span> 
                                </h1>
                            </div>
                        </li>
        <?php
    }
    if (( $pastMonth != $curMonth)) {
        ?>
                        <li class="timeline-item period"> 
                            <div class="timeline-info"></div>
                            <div class="timeline-marker"></div>
                            <div class="timeline-content">
                                <h2 class="timeline-title">
                                    <?php echo date_format(date_create($v["start_date"]), "M Y");?>
                                </h2>
                            </div>
                        </li>
        <?php
    }
    ?>
                    <li class="timeline-item">
                        <div class="timeline-info">
                            <span>
                    <?php echo date_format(date_create($v["start_date"]), "d M Y"); ?>
                            </span>
                        </div>
                        <div class="timeline-marker"></div>
                        <div class="timeline-content">
                            <h3 class="timeline-title">
                                <?php echo $v["title"]; ?>
                            </h3>
                            <?php 
                                echo "<p>Client: ".(($v["project_id"] != "" && isset($clients[$v["client_id"]]))?$clients[$v["client_id"]]["name"] : "None Assigned")."</p>";
                                echo "<p>Project: ". (($v["project_id"] != "" && isset($projects[$v["project_id"]]))?$projects[$v["project_id"]]["name"] : "None Assigned")."</p>";
                                echo "<br/><p>".$v["content"]."</p>"; ?>
                        </div>
                    </li>
    <?php
    $pastMonth = $curMonth;
    $pastYear = $curYear;
    $count+=1;
}
?>
            </ul>
        </div>
    </div>
</div>
<p>Timeline code copied from <a href="http://overflowdg.com" target="_blank">Overflow</a></p>
<p>CodePen Example <a href="https://codepen.io/brady_wright/pen/NNOvrW" target="_blank">here</a></p>
<link rel="stylesheet" type="text/css" href="/css/jquery.datetimepicker.css" />
<script src="/js/jquery.datetimepicker.js"></script>
<script type="text/javascript">
    try {
        $("document").ready(function () {
            getData();

        });
    } catch (e) {
        console.log(e);
    }
        $("#fromDate").datetimepicker();
        $("#toDate").datetimepicker();
</script>