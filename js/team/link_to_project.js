/* 
 * To change this license header, choose License Headers in Team Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

var targetEleId = null;
var fade_out = function () {
    console.log("Fired!!! ");
    console.log(targetEleId);
    $(targetEleId).fadeOut("slow").empty();
}

$(document).ready(function () {
//    $("#link_team_to_project").click(function (ele) {
//        var projectId = $(this).val();
//        var teamId = $("#team_id").val();
//        console.log($("#team_id").val());
//        console.log("Value: " + $(this).val());
//        var data = {"team_id": teamId, "project_id": projectId, "status": "1"};
//        console.log(data);
////        console.log(data.serialize());
//        $.post(
//                "/team/new/link-to-project",
//                data
//                ).done(function (resp) {
//            console.log(resp);
//            if (resp == "1") {
//                console.log("Successfully added");
//                targetEleId = "#project_" + projectId;
//                $(targetEleId).html('<div class="large-12 columns success">Successfully Linked Team to Project.</div>');
//                setTimeout(fade_out, 5000);
//            }
//        });
//    });
});

function linkTeamToProject(ele) {
    var projectId = $(ele).val();
    var teamId = $("#team_id").val();
    console.log($("#team_id").val());
    console.log("Value: " + projectId);
    var data = {"team_id": teamId, "project_id": projectId, "status": "1"};
    console.log(data);
//        console.log(data.serialize());
    $.post(
            "/team/new/link-to-project",
            data
            ).done(function (resp) {
        console.log(resp);
        if (resp == "1") {
            console.log("Successfully added");
            targetEleId = "#project_" + projectId;
            $(targetEleId).html('<div class="large-12 columns success">Successfully Linked Team to Project.</div>');
            setTimeout(fade_out, 5000);
        }
    });
}



