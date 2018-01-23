<?php ?>
<input type="hidden" value="<?php echo $projectId; ?>" name="project_id" id="project_id" />
<div class="row expanded">
    <div class="large-12 columns">
        <div id="linkProjectToClient">
            <h3><?php echo $project->name; ?> is Currently Linked to the following Clients:</h3>
            <?php
            if (empty($linkedClients)) {
                echo "<h4>This project has not been linked to any clients yet.</h4>";
            } else {
                //Show list of linked clients and option to unlink per client.
                ?>
                <h4><?php echo $project->name; ?> is linked to the following clients:</h4>
                <div class="row expanded">
                    <div class="large-12 columns">
                        <br/>
                        <?php foreach ($clients as $k => $v) { 
                            if(in_array($v["id"] , $linkedClientArr)){
                            ?>
                            <div class="row expanded">
                                <div class="large-4 columns">
                                    <?php echo $v["name"]; ?>
                                </div>
                                <div class="large-4 columns low-row">
                                    <?php echo $v["description"]; ?>
                                </div>
                                <div class="large-4 columns">
                                    <button class="button" value="<?php echo $v["id"]?>" id="unlink_project_from_client" name="unlink_project_from_client"
                                            >UnLink<button>
                                </div>
                            </div>
                        <?php 
                                }
                            } ?>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
</div>
<br/>
<hr/>
<div class="row expanded">
    <div class="large-12 columns">
        <div id="linkProjectToClient">
            <h3>Link Project: <?php echo $project->name; ?>, to one or more of the following clients:</h3>
            <div class="row expanded">
                <div class="large-12 columns">
                    <br/>
                    <?php 
                        if(empty($unlinkedClients)){
                            echo "<h4>There are no unlinked clients.</h4>";
                        }else{
                        foreach ($unlinkedClients as $k => $v) { ?>
                        <div id="client_<?php echo $v["id"]; ?>" class="row expanded">
                            <div class="large-4 columns">
                                <?php echo $v["name"]; ?>
                            </div>
                            <div class="large-4 columns low-row">
                                <?php echo $v["description"]; ?>
                            </div>
                            <div class="large-4 columns">
                                <button class="button" value="<?php echo $v["id"]?>" id="link_project_to_client" name="link_project_to_client"
                                        onclick="linkProjectToClient(this);">Link<button>
                            </div>
                        </div>
                        <?php 
                            }
                        } 
                        ?>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="/js/third_party/ckeditor/ckeditor.js"></script>
<link rel="stylesheet" type="text/css" href="/css/jquery.datetimepicker.css"/ >
<script src="/js/jquery.datetimepicker.js"></script>
<script type="text/javascript">
    $(function () {
        $('form').attr('autocomplete', 'on');
        $("#targetDate").datetimepicker();
//        CKEDITOR.replace('description');
//        CKEDITOR.replace('reason');
    });
</script>
<script type="text/javascript" src="/js/project/link_to_client.js">