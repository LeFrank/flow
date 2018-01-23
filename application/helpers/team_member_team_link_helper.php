<?php

function removeLinkedTeam($teams, $linkedTeams) {
    foreach ($linkedTeams as $k => $v) {
        foreach ($teams as $key => $team) {
            if ($team["id"] == $v["project_id"]) {
                unset($team[$key]);
            }
        }
    }
    return $$teams;
}

function getLinkedTeamIds($linkedTeams) {
    $linkedTeamsArr = array();
    foreach ($linkedTeams as $v) {
        $linkedTeamsArr[] = $v->team_id;
    }
    return $linkedTeamsArr;
}

function mapTeamMemberIdToTeam($teamMemberTeamLinks){
//    print_r($teamProjectLinks);
    $teammemberToTeamMap = array();
    foreach($teamMemberTeamLinks as $v){
        $teamMemberTeamLinks[$v->team_member_id][] = $v->team_id;
    }
//    print_r($teamToProjectMap);
    return $teammemberToTeamMap;
}