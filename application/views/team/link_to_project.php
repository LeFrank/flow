<?php ?>
<input type="hidden" value="<?php echo $teamId; ?>" name="team_id" id="team_id" />
<div class="row expanded">
    <div class="large-12 columns">
        <div id="linkTeamToProject">
            <h3><?php echo $team->name; ?> is Currently Linked to the following Projects:</h3>
            <?php
            if (empty($linkedProjects)) {
                echo "<h4>This team has not been linked to any projects yet.</h4>";
            } else {
                //Show list of linked projects and option to unlink per project.
                ?>
                <h4><?php echo $team->name; ?> is linked to the following projects:</h4>
                <div class="row expanded">
                    <div class="large-12 columns">
                        <br/>
                        <?php foreach ($projects as $k => $v) { 
                            if(in_array($v["id"] , $linkedProjectArr)){
                            ?>
                            <div class="row expanded">
                                <div class="large-4 columns">
                                    <?php echo $v["name"]; ?>
                                </div>
                                <div class="large-4 columns low-row" >
                                    <?php echo $v["description"]; ?>
                                </div>
                                <div class="large-4 columns">
                                    <button class="button" value="<?php echo $v["id"]?>" id="unlink_team_from_project" name="unlink_team_from_project">UnLink<button>
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
        <div id="linkTeamToProject">
            <h3>Link Team: <?php echo $team->name; ?>, to one or more of the following projects:</h3>
            <div class="row expanded">
                <div class="large-12 columns">
                    <br/>
                    <?php 
                        if(empty($unlinkedProjects)){
                            echo "<h4>There are no unlinked projects.</h4>";
                        }else{
                        foreach ($unlinkedProjects as $k => $v) { ?>
                        <div id="project_<?php echo $v["id"]; ?>" class="row expanded">
                            <div class="large-4 columns">
                                <?php echo $v["name"]; ?>
                            </div>
                            <div class="large-4 columns low-row" >
                                <?php echo $v["description"]; ?>
                            </div>
                            <div class="large-4 columns">
                                <button class="button" value="<?php echo $v["id"]?>" id="link_team_to_project" name="link_team_to_project" onClick="linkTeamToProject(this);">Link<button>
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
<script type="text/javascript" src="/js/team/link_to_project.js">