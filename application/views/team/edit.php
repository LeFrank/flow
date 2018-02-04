<br/>
<div class="row expanded">
    <div class="large-12 columns">
        <div id="captureTeam">
            <h3>New Team</h3>
            <div class="row expanded">
                <div class="large-12 columns">
                    <form action="/team/<?php echo $team->id; ?>/update" method="post" accept-charset="utf-8" id="captureTeamForm">
                        <input type="hidden" id="id" name="id" value="<?php echo (!empty($team->id) ? $team->id : "" ); ?>" />
                        <div class="error"><?php echo validation_errors(); ?></div>
                        <label for="title">Name *</label>
                        <input type="text" autofocus value="<?php echo (!empty($team->name) ? $team->name : "" ); ?>" name="name" id="name" placeholder="ACME Co."  />
                        <br/>
                        <label for="team_content">Description</label>
                        <textarea name="description" id="description" cols="40" rows="15" placeholder="ACME Co, producers of everything and anything"><?php echo (!empty($team->description) ? $team->description : "" ); ?></textarea>
                        <br/>
                        <label for="date">Date</label>
                        <input type="text" value="<?php echo (!empty($team->created_date) ? $team->created_date : date('Y/m/d H:i:s')); ?>" name="created_date" id="created_date"/>
                        <br/><br/>
                        <input type="submit" id="submit-team" value="<?php echo (!empty($team->id) ? "Update" : "Capture" ); ?>"  class="button"  />&nbsp;&nbsp;&nbsp;&nbsp;
<!--                        <input id="cancel-new-team" type="button" value="Cancel" class="button secondary"/>-->
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