<?php ?>
<input type="hidden" value="<?php echo $team_memberId; ?>" name="team_member_id" id="team_member_id" />
<div class="row expanded">
    <div class="large-12 columns">
        <div id="linkTeam_MemberToTeam">
            <h3><?php echo $team_member->name; ?> is Currently Linked to the following Teams:</h3>
            <?php
            if (empty($linkedTeams)) {
                echo "<h4>This team_member has not been linked to any teams yet.</h4>";
            } else {
                //Show list of linked teams and option to unlink per team.
                ?>
                <h4><?php echo $team_member->name; ?> is linked to the following teams:</h4>
                <div class="row expanded">
                    <div class="large-12 columns">
                        <br/>
                        <?php foreach ($teams as $k => $v) { 
                            if(in_array($v["id"] , $linkedTeamArr)){
                            ?>
                            <div class="row expanded">
                                <div class="large-4 columns">
                                    <?php echo $v["name"]; ?>
                                </div>
                                <div class="large-4 columns low-row" >
                                    <?php echo $v["description"]; ?>
                                </div>
                                <div class="large-4 columns">
                                    <button class="button" value="<?php echo $v["id"]?>" id="unlink_team_member_from_team" name="unlink_team_member_from_team">UnLink<button>
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
        <div id="linkTeam_MemberToTeam">
            <h3>Link Team_Member: <?php echo $team_member->name; ?>, to one or more of the following teams:</h3>
            <div class="row expanded">
                <div class="large-12 columns">
                    <br/>
                    <?php 
                        if(empty($unlinkedTeams)){
                            echo "<h4>There are no unlinked teams.</h4>";
                        }else{
                        foreach ($unlinkedTeams as $k => $v) { ?>
                        <div id="team_<?php echo $v["id"]; ?>" class="row expanded">
                            <div class="large-4 columns">
                                <?php echo $v["name"]; ?>
                            </div>
                            <div class="large-4 columns low-row" >
                                <?php echo $v["description"]; ?>
                            </div>
                            <div class="large-4 columns">
                                <button class="button" value="<?php echo $v["id"]?>" id="link_team_member_to_team" name="link_team_member_to_team" onClick="linkTeam_MemberToTeam(this);">Link<button>
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
<script type="text/javascript" src="/js/team_member/link_to_team.js">