<?php ?>
<br/>
<div class="row expanded">
    <div class="large-12 columns">
        <div id="captureteam">
            <h3>New team</h3>
            <div class="row expanded">
                <div class="large-12 columns">
                    <form action="/teams/<?php echo (!empty($team->id) ? "update" : "capture" ); ?>" method="post" accept-charset="utf-8" id="captureteamForm">
                        <input type="hidden" id="id" name="id" value="<?php echo (!empty($team->id) ? $team->id : "" ); ?>" />
                        <div class="error"><?php echo validation_errors(); ?></div>
                        <label for="title">Name *</label>
                        <input type="text" autofocus value="<?php echo (!empty($team->name) ? $team->name : "" ); ?>" name="name" id="name" placeholder="ACME Co."  />
                        <br/>
                        <label for="team_content">Description *</label>
                        <textarea name="description" id="description" cols="40" rows="15" placeholder="ACME Co, producers of everything and anything"><?php echo (!empty($team->description) ? $team->description : "" ); ?></textarea>
                        <br/>
                        <label for="date">Date</label>
                        <input type="text" value="<?php echo (!empty($team->created_date) ? $team->created_date : date('Y/m/d H:i:s')); ?>" name="created_date" id="created_date"/>
                        <br/><br/>
                        <input type="submit" id="submit-team" value="<?php echo (!empty($team->id) ? "Update" : "Capture" ); ?>"  class="button"  />&nbsp;&nbsp;&nbsp;&nbsp;
                        <input id="cancel-new-team" type="button" value="Cancel" class="button secondary"/>
                    </form>
                </div>
            </div>
            <script type="text/javascript">
                $("#submit-team").click(function () {
                    window.onbeforeunload = null;
                });
<?php
if (isset($exitCheck) && $exitCheck == true) {
    ?>
                    window.onbeforeunload = confirmOnPageExit;
                    console.log("Check before exiting!");
    <?php
}
if (!empty($team->tagg)) {
    ?>
                    var tagsVar = "[<?php echo $team->tagg; ?>]";
<?php } else { ?>
                    var tagsVar = "";
<?php } ?>
            </script>
        </div>
    </div>
</div>
<?php
if (empty($teams)) {
    echo "No teams";
} else {
    ?>
    <table id="expense_history" class="tablesorter responsive">
        <thead>
            <tr>
                <th>id</th>
                <th>Name</th>
                <th>Description</th>
                <th>team Initiated On</th>
                <th>Linked To</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>

            <?php
            foreach ($teams as $k => $v) {
                ?>
                <tr >
                    <td><?php echo $v["id"]; ?></td>
                    <td><?php echo $v["name"]; ?></td>
                    <td><?php echo $v["description"]; ?></td>
                    <td><?php echo $v["created_date"]; ?></td>
                    <td>
                        <?php
                        if (empty($teamMap[$v["id"]])) {
                            echo "No Project Linked";
                        } else {
                            ?>
                            <ul>
                                    <?php 
                                    foreach ($teamMap[$v["id"]] as $key=>$val) { 
                                        ?>
                                    <li>
                                    <?php echo $projects[$val]["name"]; ?>
                                    </li>
                            <?php } ?>
                            </ul>
                        <?php 
                        } ?>
                    </td>
                    <td><?php echo $v["status"]; ?></td>
                    <td>
                        <a href="/team/<?php echo $v["id"]; ?>/link-to-project">Link to project(s)</a>
                        &nbsp;|&nbsp;
                        <a href="/team/<?php echo $v["id"]; ?>/update">Edit</a>
                        &nbsp;|&nbsp;
                        <a href="/team/<?php echo $v["id"]; ?>/delete">Delete</a>
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