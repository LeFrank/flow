/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

var targetEleId = null;
var fade_out = function() {
  console.log("Fired!!! ");
  console.log(targetEleId);
  $(targetEleId).fadeOut("slow").empty();
}

$(document).ready(function() {
//    $("#link_project_to_client").click(function(ele){
//        var clientId = $(this).val();
//        var projectId = $("#project_id").val();
//        console.log($("#project_id").val());
//        console.log("Value: " + $(this).val());
//        var data = {"project_id": projectId, "client_id": clientId, "status": "1"};
//        console.log(data);
////        console.log(data.serialize());
//        $.post(
//            "/project/new/link-to-client",
//            data
//        ).done(function (resp) {
//            console.log(resp);
//            if(resp == "1"){
//                console.log("Successfully added");
//                targetEleId = "#client_" + clientId;
//                $(targetEleId).html('<div class="large-12 columns success">Successfully Linked Project to Client.</div>');
//                setTimeout(fade_out, 5000);
//            }
//        });
//    });
});

function linkProjectToClient(ele) {
    var clientId = $(ele).val();
    var projectId = $("#project_id").val();
    console.log($("#project_id").val());
    console.log("Value: " + $(ele).val());
    var data = {"project_id": projectId, "client_id": clientId, "status": "1"};
    console.log(data);
//        console.log(data.serialize());
    $.post(
        "/project/new/link-to-client",
        data
    ).done(function (resp) {
        console.log(resp);
        if(resp == "1"){
            console.log("Successfully added");
            targetEleId = "#client_" + clientId;
            $(targetEleId).html('<div class="large-12 columns success">Successfully Linked Project to Client.</div>');
            setTimeout(fade_out, 5000);
        }
    });
}

