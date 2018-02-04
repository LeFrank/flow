<?php ?>
<br/>
<div class="row expanded">
    <div class="large-12 columns">
        <div id="captureteam_member">
            <h3>New Team Member</h3>
            <div class="row expanded">
                <div class="large-12 columns">
                    <form action="/team-members/<?php echo (!empty($team_member->id) ? "update" : "capture" ); ?>" method="post" accept-charset="utf-8" id="captureteam_memberForm">
                        <input type="hidden" id="id" name="id" value="<?php echo (!empty($team_member->id) ? $team_member->id : "" ); ?>" />
                        <div class="error"><?php echo validation_errors(); ?></div>
                        <label for="title">Name *</label>
                        <input type="text" autofocus value="<?php echo (!empty($team_member->name) ? $team_member->name : "" ); ?>" name="name" id="name" placeholder="Rick Hunter"  />
                        <br/>
                        <label for="team_member_content">Description *</label>
                        <textarea name="description" id="description" cols="40" rows="15" placeholder="ACME Co, producers of everything and anything"><?php echo (!empty($team_member->description) ? $team_member->description : "" ); ?></textarea>
                        <br/>
                        <label for="date">Start Date</label>
                        <input type="text" value="<?php echo (!empty($team_member->start_date) ? $team_member->start_date : date('Y/m/d H:i:s')); ?>" name="start_date" id="start_date"/>
                        <br/><br/>
                        <input type="submit" id="submit-team_member" value="<?php echo (!empty($team_member->id) ? "Update" : "Capture" ); ?>"  class="button"  />&nbsp;&nbsp;&nbsp;&nbsp;
                        <input id="cancel-new-team_member" type="button" value="Cancel" class="button secondary"/>
                    </form>
                </div>
            </div>
            <script type="text/javascript">
                $("#submit-team_member").click(function () {
                    window.onbeforeunload = null;
                });
<?php
if (isset($exitCheck) && $exitCheck == true) {
    ?>
                    window.onbeforeunload = confirmOnPageExit;
                    console.log("Check before exiting!");
    <?php
}
if (!empty($team_member->tagg)) {
    ?>
                    var tagsVar = "[<?php echo $team_member->tagg; ?>]";
<?php } else { ?>
                    var tagsVar = "";
<?php } ?>
            </script>
        </div>
    </div>
</div>
<?php
if (empty($team_members)) {
    echo "No team_members";
} else {
    ?>
    <table id="team_member_list" class="tablesorter responsive">
        <thead>
            <tr>
                <th>id</th>
                <th>Name</th>
                <th>Description</th>
                <th>Team Member Started On</th>
                <th>Linked To</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>

            <?php
            foreach ($team_members as $k => $v) {
                ?>
                <tr >
                    <td><?php echo $v["id"]; ?></td>
                    <td><?php echo $v["name"]; ?></td>
                    <td><?php echo $v["description"]; ?></td>
                    <td><?php echo $v["start_date"]; ?></td>
                    <td>
                        <?php
                        if (empty($team_memberMap[$v["id"]])) {
                            echo "No Team Linked";
                        } else {
                            ?>
                            <ul>
                                    <?php 
                                    foreach ($team_memberMap[$v["id"]] as $key=>$val) { 
                                        ?>
                                    <li>
                                    <?php echo $teams[$val]["name"]; ?>
                                    </li>
                            <?php } ?>
                            </ul>
                        <?php 
                        } ?>
                    </td>
                    <td><?php echo $v["status"]; ?></td>
                    <td>
                        <a href="/team-member/<?php echo $v["id"]; ?>/link-to-team">Link to team(s)</a>
                        &nbsp;|&nbsp;
                        <a href="/team-member/<?php echo $v["id"]; ?>/update">Edit</a>
                        &nbsp;|&nbsp;
                        <a href="/team-member/<?php echo $v["id"]; ?>/delete">Delete</a>
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