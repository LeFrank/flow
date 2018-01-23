<?php ?>
<br/>
<div class="row expanded">
    <div class="large-12 columns">
        <div id="captureClient">
            <h3>New Client</h3>
            <div class="row expanded">
                <div class="large-12 columns">
                    <form action="/clients/<?php echo (!empty($client->id) ? "update" : "capture" ); ?>" method="post" accept-charset="utf-8" id="captureClientForm">
                        <input type="hidden" id="id" name="id" value="<?php echo (!empty($client->id) ? $client->id : "" ); ?>" />
                        <div class="error"><?php echo validation_errors(); ?></div>
                        <label for="title">Name *</label>
                        <input type="text" autofocus value="<?php echo (!empty($client->name) ? $client->name : "" ); ?>" name="name" id="name" placeholder="ACME Co."  />
                        <br/>
                        <label for="client_content">Description</label>
                        <textarea name="description" id="description" cols="40" rows="15" placeholder="ACME Co, producers of everything and anything"><?php echo (!empty($client->description) ? $client->description : "" ); ?></textarea>
                        <br/>
                        <label for="date">Date</label>
                        <input type="text" value="<?php echo (!empty($client->created_date) ? $client->created_date : date('Y/m/d H:i:s')); ?>" name="created_date" id="created_date"/>
                        <br/><br/>
                        <input type="submit" id="submit-client" value="<?php echo (!empty($client->id) ? "Update" : "Capture" ); ?>"  class="button"  />&nbsp;&nbsp;&nbsp;&nbsp;
                        <input id="cancel-new-client" type="button" value="Cancel" class="button secondary"/>
                    </form>
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
        </div>
    </div>
</div>
<?php
if (empty($clients)) {
    echo "No clients";
} else {
    ?>
    <table id="expense_history" class="tablesorter responsive">
        <thead>
            <tr>
                <th>id</th>
                <th>Name</th>
                <th>Description</th>
                <th>Became Client On</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>

            <?php
            foreach ($clients as $k => $v) {
                ?>
                <tr>
                    <td><?php echo $v["id"];?></td>
                    <td><?php echo $v["name"];?></td>
                    <td><?php echo $v["description"];?></td>
                    <td><?php echo $v["created_date"];?></td>
                    <td><?php echo $v["status"];?></td>
                    <td></td>
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>
    <?php
}
?>