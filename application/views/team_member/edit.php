<br/>
<div class="row expanded">
    <div class="large-12 columns">
        <div id="captureTeamMember">
            <h3>New Team</h3>
            <div class="row expanded">
                <div class="large-12 columns">
                    <form action="/team-member/<?php echo $team_member->id;?>/<?php echo (!empty($team_member->id) ? "update" : "capture" ); ?>" method="post" accept-charset="utf-8" id="captureteam_memberForm">
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