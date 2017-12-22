var funding_active_status = "{{session('funding')}}";
$(document).ready(function () {
    $("#siderbar li a").removeClass("current");
    $("#menu_activity_achieved").addClass("current");
    $('#person_responsible').multiSelect();
    $("#component_responsible").multiSelect();
    $("#person_achieved").multiSelect();
    if(funding_active_status=='active')
    {
        $("#funding_tab").trigger("click");
    }
    bindFramework();
    bindComponent();
    bindPerson();
    $("#btnCancel").click(function(){
        location.href = burl + "/activity-achieve/edit/" + $("#id").val();
    });
    $("#activity_type").change(function(){
        var ngo_id = $("#ngo").val();
        $("#result_framework_structure").val("");
        bindActivity(ngo_id);
    });
    $("#activity_name").change(function(){
        $("#result_framework_structure").val("");
        bindFramework();
        bindComponent();
        bindPerson();
    });
    $('#start_date').datepicker({
        uiLibrary: 'bootstrap4'
    });
    $('#end_date').datepicker({
        uiLibrary: 'bootstrap4'
    });
});
// function binding data on ngo changed
function binding()
{
    var id = $("#ngo").val();
    $("#result_framework_structure").val("");
    bindActivityType(id);

}

// bind activity type
function bindActivityType(ngo_id)
{
    $.ajax({
        type: "GET",
        url: burl + "/activity_type/get/" + ngo_id,
        success: function(sms){
            var opts = "";
            for(var i=0;i<sms.length;i++)
            {
                opts += "<option value='" + sms[i].id + "'>" + sms[i].name + "</option>";
            }
             //$('#activity_type').val('').trigger('chosen:updated');  
            $('#activity_type').chosen('destroy');
            $("#activity_type").html(opts);
            $("#activity_type option:first-child").attr("selected","selected");
            $('#activity_type').chosen();                 
            bindActivity(ngo_id);
        }
    });
}
// bind framework
function bindActivity(ngo_id)
{
   var aid = $("#activity_type").val();
   $.ajax({
        type: "GET",
        url: burl + "/setting/get/" + ngo_id+"*"+aid,
        success: function(sms){
            var opts = "";
            for(var i=0;i<sms.length;i++)
            {
                opts += "<option value='" + sms[i].id + "'>" + sms[i].activity_name + "</option>";
            }
             //$('#activity_type').val('').trigger('chosen:updated');  
            $('#activity_name').chosen('destroy');
            $("#activity_name").html(opts);
            $("#activity_name option:first-child").attr("selected","selected");
            $('#activity_name').chosen();                 
            bindFramework();
            bindComponent();
            bindPerson();
        }
    });
}
function bindFramework()
{
   var id = $("#activity_name").val();
   $.ajax({
        type: "GET",
        url: burl + "/setting/framework/get/" + id,
        success: function(sms){
          
            for(var i=0;i<sms.length;i++)
            {
                $("#result_framework_structure").val(sms[i].fname);
            }
        }
    });
}
// bind component
function bindComponent()
{
    var id = $("#activity_name").val();
    $.ajax({
        type: "GET",
        url: burl + "/setting/component/get/" + id,
        success: function(sms){
            var opts = "<select class='form-control' name='component_responsible[]' id='component_responsible' multiple disabled>";
            for(var i=0;i<sms.length;i++)
            {
                opts += "<option value='" + sms[i].id + "' selected>" + sms[i].name + "</option>";
            }
            opts += "</select>";
            $("#sp").html(opts);
            $("#component_responsible").multiSelect();

        }
    });
}
 function bindPerson()
{
    var id = $("#activity_name").val();
    $.ajax({
        type: "GET",
        url: burl + "/setting/person/get/" + id,
        success: function(sms){
            var opts = "<select class='form-control' name='person_responsible[]' id='person_responsible' multiple disabled>";
            for(var i=0;i<sms.length;i++)
            {
                opts += "<option value='" + sms[i].id + "' selected>" + sms[i].name + "</option>";
            }
            opts += "</select>";
            $("#sp1").html(opts);
            $("#person_responsible").multiSelect();

        }
    });
}
// bind component
function bindUser(ngo_id)
{
    $.ajax({
        type: "GET",
        url: burl + "/user/get/" + ngo_id,
        success: function(sms){
            var lbs = "";
            for(var i=0;i<sms.length;i++)
            {
                lbs += "<label class='multi-select-menuitem' for='person_responsible_" + i + "' role='menuitem'>";
                lbs += "<input id='person_responsible_" + i + "' value='" + sms[i].id + "' type='checkbox'>";
                lbs += sms[i].name;
                lbs += "</label>";
            }
            $("#sp1 .multi-select-menuitems").html(lbs);
           
        }
    });
}
function bindDistict()
{
    var p_id = $("#province").val();
    $.ajax({
        type: "GET",
        url: burl + "/setting/district/get/" + p_id,
        success: function(sms){
             var opts = "";
            for(var i=0;i<sms.length;i++)
            {
                opts += "<option value='" + sms[i].id + "'>" + sms[i].name + " - " + sms[i].name_kh + "</option>";
            }
            $("#district").html(opts);
            bindCommune();
        }
    });
}
function bindDistict1()
{
    var p_id = $("#bprovince").val();
    $.ajax({
        type: "GET",
        url: burl + "/setting/district/get/" + p_id,
        success: function(sms){
             var opts = "";
            for(var i=0;i<sms.length;i++)
            {
                opts += "<option value='" + sms[i].id + "'>" + sms[i].name + " - " + sms[i].name_kh + "</option>";
            }
            $("#bdistrict").html(opts);
            bindCommune1();
        }
    });
}
function bindCommune()
{
    var p_id = $("#district").val();
    $.ajax({
        type: "GET",
        url: burl + "/setting/commune/get/" + p_id,
        success: function(sms){
             var opts = "";
            for(var i=0;i<sms.length;i++)
            {
                opts += "<option value='" + sms[i].id + "'>" + sms[i].name + " - " + sms[i].name_kh + "</option>";
            }
            $("#commune").html(opts);
            bindVillage();
        }
    });
}
 function bindCommune1()
{
    var p_id = $("#bdistrict").val();
    $.ajax({
        type: "GET",
        url: burl + "/setting/commune/get/" + p_id,
        success: function(sms){
             var opts = "";
            for(var i=0;i<sms.length;i++)
            {
                opts += "<option value='" + sms[i].id + "'>" + sms[i].name + " - " + sms[i].name_kh + "</option>";
            }
            $("#bcommune").html(opts);
            bindVillage1();
        }
    });
}
function bindVillage()
{
    var p_id = $("#commune").val();
    $.ajax({
        type: "GET",
        url: burl + "/setting/village/get/" + p_id,
        success: function(sms){
             var opts = "";
            for(var i=0;i<sms.length;i++)
            {
                opts += "<option value='" + sms[i].id + "'>" + sms[i].name + " - " + sms[i].name_kh + "</option>";
            }
            $("#village").html(opts);
        }
    });
}
function bindVillage1()
{
    var p_id = $("#bcommune").val();
    $.ajax({
        type: "GET",
        url: burl + "/setting/village/get/" + p_id,
        success: function(sms){
             var opts = "";
            for(var i=0;i<sms.length;i++)
            {
                opts += "<option value='" + sms[i].id + "'>" + sms[i].name + " - " + sms[i].name_kh + "</option>";
            }
            $("#bvillage").html(opts);
        }
    });
}
function showEdit(evt)
{
    evt.preventDefault();
    $("input").removeAttr("disabled");
   // $("textarea").removeAttr("disabled");
    $("#result_framework_structure").attr("disabled","disabled");
    // enable ngo dropdown
    $("#ngo").chosen('destroy');
    $("#ngo").removeAttr("disabled");
    $("#ngo").chosen();
    // enable activity type dropdown
    $("#activity_type").chosen("destroy");
    $("#activity_type").removeAttr("disabled");
    $("#activity_type").chosen();
    // enable activity name
    $("#activity_name").chosen("destroy");
    $("#activity_name").removeAttr("disabled");
    $("#activity_name").chosen();
    // enable activity category
    $("#activity_category").chosen("destroy");
    $("#activity_category").removeAttr("disabled");
    $("#activity_category").chosen();
    // person achieved

    $("#person_achieved").removeAttr("disabled");

    $("#box").removeClass('hide');
}
function clearDoc() {
    $("#doc_description").val("");
    $("#doc_file_name").val("");
    $("#docsms").html("");
    $("#doc_id").val("0");
}
function clearEvent()
{
    $("#event_id").val("0");
    $("#activity_subject").val("");
    $("#total").val("0");
    $("#total_female").val("0");
    $("#total_youth").val("0");
    $("#eventsms").html("");
    $("#exampleModalLabel").html("Create New Event");
    
}
// delete a document by its id
function deleteDoc (obj, evt) {
    var tr = $(obj).parent().parent();
    var id = $(tr).attr('id');
    var con = confirm('You want to delete?');
    if(con)
    {
        $.ajax({
        type: "GET",
        url: burl + "/document/delete/" + id,
        success: function (response) {
            $(tr).remove();
            }
        });
    }

}
function deleteEvent (obj, evt) {
    evt.preventDefault();
    var tr = $(obj).parent().parent();
    var id = $(tr).attr('id');
    var con = confirm('You want to delete?');
    if(con)
    {
        $.ajax({
        type: "GET",
        url: burl + "/activity-achieve/event/delete/" + id,
        success: function (response) {
            $(tr).remove();
            }
        });
    }

}
function editEvent(obj,evt)
{
evt.preventDefault();
$("#exampleModalLabel").html("Edit Event");
var tr = $(obj).parent().parent();
var id = $(tr).attr('id');
$("#event_id").val(id);
$.ajax({
type: "GET",
url: burl + "/activity-achieve/event/get/" + id,
success: function(sms){
    sms = JSON.parse(sms);
    $("#event_id").val(sms.id);
    $("#activity_area").val(sms.activity_area_id);
    $("#activity_subject").val(sms.subject);
    $("#event_organizer").val(sms.organizer_id);
    $("#total").val(sms.total_participant);
    $("#total_female").val(sms.total_female);
    $("#total_youth").val(sms.total_youth);
    $("#province").val(sms.province_id);
    bindDistict();
    $("#district").val(sms.district_id);
    $("#commune").val(sms.commune_id);
    $("#village").val(sms.village_id);
    $("#btnAddEvent").trigger("click");
}
});
}
// save document
function saveDoc () {
var id = $("#id").val();

var o = confirm('Do you want to save?');
if(o)
{
    var file_data = $('#doc_file_name').prop('files')[0];
    var form_data = new FormData();
    form_data.append('doc_file_name', file_data);
    form_data.append("description", $('#doc_description').val());
    form_data.append("act_id", id);
    $("#docsms").html("<img src='" + asset + "/ajax-loader.gif" + "'>");
    $.ajax({
        type: 'POST',
        url:burl + '/document/save',
        data: form_data,
        type: 'POST',
        contentType: false,       // The content type used when sending data to the server.
        cache: false,             // To unable request pages to be cached
        processData: false,
        beforeSend: function (request) {
            return request.setRequestHeader('X-CSRF-Token', $("input[name='_token']").val());
        },
        success:function(sms){
 
           sms = JSON.parse(sms);
           var counter = $("#docData tr").length;
            var tr = "";
            
            tr +="<tr id='" + sms.id + "'>";
            tr += "<td>" + (counter++) + "</td>";
            tr += "<td>" + "<a href='" + doc_url + "/" + sms.file_name + "' target='_blank'>" + sms.file_name + "</a>" + "</td>";
            tr +="<td>" + sms.description+ "</td>";
            tr += "<td>" + "<button type='button' onclick='deleteDoc(this,event)' class='btn btn-sm btn-danger'><i class='fa fa-trash'></i> Delete</button>" + "</td>";
            tr +="</tr>";
            
            if(counter>0){
                $("#docData tr:last-child").after(tr);
            }
            else{
                $("#docData").html(tr);
            }
            $("#docsms").html("Your doc has been saved!");
            $("#doc_description").val("");
            $("#doc_file_name").val("");
        },
    });

}
}
function saveEvent()
{
var aid = $("#id").val();
var o = confirm('Do you want to save?');
if(o)
{
    var ed = {
        id: $("#event_id").val(),
        activity_area_id: $("#activity_area").val(),
        subject: $("#activity_subject").val(),
        activity_achieved_id: aid,
        organizer_id: $("#event_organizer").val(),
        total_participant: $("#total").val(),
        total_female: $("#total_female").val(),
        total_youth: $("#total_youth").val(),
        village_id: $("#village").val(),
        commune_id: $("#commune").val(),
        district_id: $("#district").val(),
        province_id: $("#province").val()
    }
     $.ajax({
        type: 'POST',
        url:burl + '/activity-achieve/event/save',
        data: ed,
        type: 'POST',
        beforeSend: function (request) {
            return request.setRequestHeader('X-CSRF-Token', $("input[name='_token']").val());
        },
        success:function(sms){
            sms = JSON.parse(sms);
            var x = $("#event_id").val();
            if(x>0)
            {
                var str = "#eventData tr[id='" + x + "']";
                var tr = $(str);
                var id = $(tr).attr("id");
                var tds = $(tr).children('td');
                $(tds[1]).html(sms.subject);
                $(tds[2]).html(sms.name);
                $(tds[3]).html(sms.total_participant);
                $(tds[4]).html(sms.total_female);
                $(tds[5]).html(sms.total_youth);
                $("#eventsms").html("All changes have been saved successfully!");                        
            }
            else{
                var counter = $("#eventData tr").length;
                var tr = "";
                
                tr +="<tr id='" + sms.id + "'>";
                tr += "<td>" + (counter++) + "</td>";
                tr += "<td>" +  sms.subject + "</td>";
                tr +="<td>" + sms.name + "</td>";
                tr +="<td>" + sms.total_participant + "</td>";
                tr +="<td>" + sms.total_female + "</td>";
                tr +="<td>" + sms.total_youth + "</td>";
                tr += "<td>" + "<button type='button' class='btn btn-sm btn-success' onclick='editEvent(this,event)'><i class='fa fa-pencil'></i> Edit</button> <button type='button' class='btn btn-sm btn-danger' onclick='deleteEvent(this,event)'><i class='fa fa-trush-o'></i> Delete</button>" + "</td>";
                tr +="</tr>";
                
                if(counter>0){
                    $("#eventData tr:last-child").after(tr);
                }
                else{
                    $("#eventData").html(tr);
                }
                clearEvent();
                $("#province").val("0");
                $("#eventsms").html("New event has been created successfully!");
                $("#district").html("");
                $("#commune").html("");
                $("#village").html("");
            }
        },
    });
}
}
function editDescription()
{
$("textarea").removeAttr("disabled");
$("#description_box").removeClass("hide");
}
function cancelDescription()
{
$("textarea").attr("disabled", "disabled");    
$("#description_box").addClass("hide");
}
function editFunding()
{
$("#total_budget").removeAttr("disabled");
$("#total_expense").removeAttr("disabled");
$("#funding_box").removeClass('hide');
}
function cancelFunding()
{
$("#total_budget").attr("disabled", "disabled");
$("#total_expense").attr("disabled", "disabled");
$("#funding_box").addClass('hide');
}