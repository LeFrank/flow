<?php

function removeLinkedProjects($projects, $linkedProjects) {
    foreach ($linkedProjects as $k => $v) {
        foreach ($projects as $key => $project) {
            if ($project["id"] == $v["project_id"]) {
                unset($projects[$key]);
            }
        }
    }
    return $projects;
}

function getLinkedProjectIds($linkedprojects) {
    $linkedProjectsArr = array();
    foreach ($linkedprojects as $v) {
        $linkedProjectsArr[] = $v->project_id;
    }
    return $linkedProjectsArr;
}

function mapTeamIdToProject($teamProjectLinks){
//    print_r($teamProjectLinks);
    $teamToProjectMap = array();
    foreach($teamProjectLinks as $v){
        $teamToProjectMap[$v->team_id][] = $v->project_id;
    }
//    print_r($teamToProjectMap);
    return $teamToProjectMap;
}