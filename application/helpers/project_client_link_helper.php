<?php

function removeLinkedClients($clients, $linkedClients) {
    foreach ($linkedClients as $k => $v) {
        foreach ($clients as $key => $client) {
            if ($client["id"] == $v["client_id"]) {
                unset($clients[$key]);
            }
        }
    }
    return $clients;
}

function getLinkedClientIds($linkedclients) {
    $linkedClientsArr = array();
    foreach ($linkedclients as $v) {
        $linkedClientsArr[] = $v->client_id;
    }
    return $linkedClientsArr;
}

function mapProjectIdToClient($projectClientLinks){
//    print_r($projectClientLinks);
    $projectToClientMap = array();
    foreach($projectClientLinks as $v){
        $projectToClientMap[$v->project_id][] = $v->client_id;
    }
//    print_r($projectToClientMap);
    return $projectToClientMap;
}