/* 
 * To change this license header, choose License Headers in Team_Member Properties.
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
//    $("#link_team_member_to_team").click(function (ele) {
//        var teamId = $(this).val();
//        var team_memberId = $("#team_member_id").val();
//        console.log($("#team_member_id").val());
//        console.log("Value: " + $(this).val());
//        var data = {"team_member_id": team_memberId, "team_id": teamId, "status": "1"};
//        console.log(data);
////        console.log(data.serialize());
//        $.post(
//                "/team_member/new/link-to-team",
//                data
//                ).done(function (resp) {
//            console.log(resp);
//            if (resp == "1") {
//                console.log("Successfully added");
//                targetEleId = "#team_" + teamId;
//                $(targetEleId).html('<div class="large-12 columns success">Successfully Linked Team_Member to Team.</div>');
//                setTimeout(fade_out, 5000);
//            }
//        });
//    });
});

function link_Team_Member_To_Team(ele) {
    var teamId = $(ele).val();
    var team_memberId = $("#team_member_id").val();
    console.log($("#team_member_id").val());
    console.log("Value: " + teamId);
    var data = {"team_member_id": team_memberId, "team_id": teamId, "status": "1"};
    console.log(data);
//        console.log(data.serialize());
    $.post(
            "/team-member/new/link-to-team",
            data
            ).done(function (resp) {
        console.log(resp);
        if (resp == "1") {
            console.log("Successfully added");
            targetEleId = "#team_" + teamId;
            $(targetEleId).html('<div class="large-12 columns success">Successfully Linked Team_Member to Team.</div>');
            setTimeout(fade_out, 5000);
        }
    });
}



