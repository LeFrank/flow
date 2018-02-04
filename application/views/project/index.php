<?php ?>
<br/>
<div class="row expanded">
    <div class="large-12 columns">
        <div id="captureProject">
            <h3>New Project</h3>
            <div class="row expanded">
                <div class="large-12 columns">
                    <form action="/projects/<?php echo (!empty($project->id) ? "update" : "capture" ); ?>" method="post" accept-charset="utf-8" id="captureProjectForm">
                        <input type="hidden" id="id" name="id" value="<?php echo (!empty($project->id) ? $project->id : "" ); ?>" />
                        <div class="error"><?php echo validation_errors(); ?></div>
                        <label for="title">Name *</label>
                        <input type="text" autofocus value="<?php echo (!empty($project->name) ? $project->name : "" ); ?>" name="name" id="name" placeholder="ACME Co."  />
                        <br/>
                        <label for="project_content">Description *</label>
                        <textarea name="description" id="description" cols="40" rows="15" placeholder="ACME Co, producers of everything and anything"><?php echo (!empty($project->description) ? $project->description : "" ); ?></textarea>
                        <br/>
                        <label for="date">Date</label>
                        <input type="text" value="<?php echo (!empty($project->created_date) ? $project->created_date : date('Y/m/d H:i:s')); ?>" name="created_date" id="created_date"/>
                        <br/><br/>
                        <input type="submit" id="submit-project" value="<?php echo (!empty($project->id) ? "Update" : "Capture" ); ?>"  class="button"  />&nbsp;&nbsp;&nbsp;&nbsp;
                        <input id="cancel-new-project" type="button" value="Cancel" class="button secondary"/>
                    </form>
                </div>
            </div>
            <script type="text/javascript">
                $("#submit-project").click(function () {
                    window.onbeforeunload = null;
                });
<?php
if (isset($exitCheck) && $exitCheck == true) {
    ?>
                    window.onbeforeunload = confirmOnPageExit;
                    console.log("Check before exiting!");
    <?php
}
if (!empty($project->tagg)) {
    ?>
                    var tagsVar = "[<?php echo $project->tagg; ?>]";
<?php } else { ?>
                    var tagsVar = "";
<?php } ?>
            </script>
        </div>
    </div>
</div>
<?php
if (empty($projects)) {
    echo "No projects";
} else {
    ?>
    <table id="project_list" class="tablesorter responsive">
        <thead>
            <tr>
                <th>id</th>
                <th>Name</th>
                <th>Description</th>
                <th>Project Initiated On</th>
                <th>Linked To</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>

            <?php
            foreach ($projects as $k => $v) {
                ?>
                <tr >
                    <td><?php echo $v["id"]; ?></td>
                    <td><?php echo $v["name"]; ?></td>
                    <td><?php echo $v["description"]; ?></td>
                    <td><?php echo $v["created_date"]; ?></td>
                    <td>
                        <?php
                        if (empty($projectMap[$v["id"]])) {
                            echo "No Client Linked";
                        } else {
                            ?>
                            <ul>
                                    <?php 
                                    foreach ($projectMap[$v["id"]] as $key=>$val) { 
                                        ?>
                                    <li>
                                    <?php echo $clients[$val]["name"]; ?>
                                    </li>
                            <?php } ?>
                            </ul>
                        <?php 
                        } ?>
                    </td>
                    <td><?php echo $v["status"]; ?></td>
                    <td>
                        <a href="/project/<?php echo $v["id"]; ?>/link-to-client">Link to client(s)</a>
                        &nbsp;|&nbsp;
                        <a href="/project/<?php echo $v["id"]; ?>/edit">Edit</a>
                        &nbsp;|&nbsp;
                        <a href="/project/<?php echo $v["id"]; ?>/delete" onclick="return confirm_delete()">Delete</a>
                    </td>
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>
    <?php
}
?>