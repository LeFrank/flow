<?php ?>
<br/>
<div class="row expanded">
    <div class="large-12 columns">
        <div id="captureEvent">
            <h3>New Event</h3>
            <form action="/event/<?php echo (!empty($event->id) ? "update" : "capture" ); ?>" method="post" accept-charset="utf-8" id="captureEventForm">
                <div class="row expanded">
                    <div class="large-4 columns">
                        <label for="title">Client</label>
                        <select id="clientId" name="clientId">
                            <option id="" name="" value="0">None</option>
                            <?php foreach ($clients as $k => $v) { ?>
                                <option name="" id="" value="<?php echo $v["id"]; ?>" >
                                    <?php echo $v["name"]; ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="large-4 columns">
                        <label for="title">Project</label>
                        <select id="projectId" name="projectId">
                            <option id="" name="" value="0">None</option>
                            <?php foreach ($projects as $k => $v) { ?>
                                <option name="" id="" value="<?php echo $v["id"]; ?>" >
                                    <?php echo $v["name"]; ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="large-4 columns">
                        <label for="title">Team</label>
                        <select id="teamId" name="teamId">
                            <option id="" name="" value="0">None</option>
                            <?php foreach ($teams as $k => $v) { ?>
                                <option name="" id="" value="<?php echo $v["id"]; ?>" >
                                    <?php echo $v["name"]; ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="row expanded">
                    <div class="large-12 columns">
                        &nbsp;
                    </div>
                </div>
                <div class="row expanded">
                    <div class="large-12 columns">
                        <input type="hidden" id="id" name="id" value="<?php echo (!empty($event->id) ? $event->id : "" ); ?>" />
                        <div class="error"><?php echo validation_errors(); ?></div>
                        <label for="title">Name *</label>
                        <input type="text" autofocus value="<?php echo (!empty($event->title) ? $event->title : "" ); ?>" name="title" id="title" placeholder="ACME Co."  />
                    </div>
                </div>
                <div class="row expanded">
                    <div class="large-12 columns">
                        &nbsp;
                    </div>
                </div>
                <div class="row expanded">
                    <div class="large-12 columns">
                        <label for="client_content">Description</label>
                        <textarea name="content" id="content" cols="40" rows="15" placeholder="ACME Co, producers of everything and anything"><?php echo (!empty($event->content) ? $event->content : "" ); ?></textarea>
                    </div>
                </div>
                <div class="row expanded">
                    <div class="large-12 columns">
                        &nbsp;
                    </div>
                </div>
                <div class="row expanded">
                    <div class="large-6 columns">
                        <label for="date">Start Date</label>
                        <input type="text" value="<?php echo (!empty($event->start_date) ? $event->start_date : date('Y/m/d H:i:s')); ?>" name="start_date" id="start_date"/>
                    </div>
                    <div class="large-6 columns">
                        <label for="date">End Date</label>
                        <input type="text" value="<?php echo (!empty($event->end_date) ? $event->end_date : date('Y/m/d H:i:s')); ?>" name="end_date" id="end_date"/>
                    </div>
                </div>
                <div class="row expanded">
                    <div class="large-12 columns">
                        &nbsp;
                    </div>
                </div>
                <div class="row expanded">
                    <div class="large-12 columns">
                        <input type="submit" id="submit-client" value="<?php echo (!empty($client->id) ? "Update" : "Capture" ); ?>"  class="button"  />&nbsp;&nbsp;&nbsp;&nbsp;
                        <input id="cancel-new-client" type="button" value="Cancel" class="button secondary"/>
                    </div>
                </div>
                <script type="text/javascript">
                    $("#submit-client").click(function () {
                        window.onbeforeunload = null;
                    });
<?php
if (isset($exitCheck) && $exitCheck == true) {
    ?>
                        window.onbeforeunload = confirmOnPageExit;
                        console.log("Check before exiting!");
    <?php
}
if (!empty($client->tagg)) {
    ?>
                        var tagsVar = "[<?php echo $client->tagg; ?>]";
<?php } else { ?>
                        var tagsVar = "";
<?php } ?>
                </script>
            </form>
        </div>
    </div>
</div>
<?php
//echo "<pre>";
//print_r(array($clients, $projects, $teams, $teamMembers));
//echo "</pre>";

if (empty($clients)) {
    echo "No events";
} else {
    ?>
    <table id="event_list" class="tablesorter responsive">
        <thead>
            <tr>
                <th>id</th>
                <th>Title</th>
                <th>Content</th>
                <th>Client</th>
                <th>Project</th>
                <th>Team</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>

            <?php
            foreach ($events as $k => $v) {
                ?>
                <tr>
                    <td><?php echo $v["id"]; ?></td>
                    <td><?php echo $v["title"]; ?></td>
                    <td><?php echo $v["content"]; ?></td>
                    <td><?php echo ($v["client_id"] != 0 )? $clients[$v["client_id"]]["name"] : "None"; ?></td>
                    <td><?php echo ($v["project_id"] != 0 )?$projects[$v["project_id"]]["name"] : "None"; ?></td>
                    <td><?php echo ($v["team_id"] != 0 )?$teams[$v["team_id"]]["name"] : "None"; ?></td>
                    <td><?php echo $v["start_date"]; ?></td>
                    <td><?php echo $v["end_date"]; ?></td>
                    <td>
                        <a href="/event/<?php echo $v["id"]; ?>/edit">Edit</a>
                        &nbsp;|&nbsp;
                        <a href="/event/<?php echo $v["id"]; ?>/delete" onclick="return confirm_delete()">Delete</a>
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