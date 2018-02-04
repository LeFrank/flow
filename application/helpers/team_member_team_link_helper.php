<?php

function removeLinkedTeamMember($teams, $linkedTeams) {
    if(empty($linkedTeams)){
        return $teams;
    }
    foreach ($linkedTeams as $k => $v) {
        foreach ($teams as $key => $team) {
            if ($team["id"] == $v["team_id"]) {
                unset($teams[$key]);
            }
        }
    }
    return $teams;
}

function getLinkedTeamIds($linkedTeams) {
    $linkedTeamsArr = array();
    foreach ($linkedTeams as $v) {
        $linkedTeamsArr[] = $v->team_id;
    }
    return $linkedTeamsArr;
}

function mapTeamMemberIdToTeam($teamMemberTeamLinks){
//   echo "<pre>";
//   print_r($teamMemberTeamLinks);
//   echo "</pre>";
    $teamMemberToTeamMap = array();
    foreach($teamMemberTeamLinks as $v){
        $teamMemberToTeamMap[$v->team_member_id][] = $v->team_id;
    }
//    print_r($teamToProjectMap);
    return $teamMemberToTeamMap;
}