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
    $("#start_date, #end_date").datepicker({
        orientation: 'bottom',
        format: 'dd/mm/yyyy',
        autoclose: true,
        todayHighlight: true,
        toggleActive: true
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
            province_id: $("#province").val(),
            ngo_id: $("#ngo").val()
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
                    tr += "<td>" + "<button type='button' class='btn btn-sm btn-success btn-flat my-btn' onclick='editEvent(this,event)'>Edit</button> <button type='button' class='btn btn-sm btn-danger btn-flat my-btn' onclick='deleteEvent(this,event)'>Delete</button>" + "</td>";
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
function clearBeneficiary()
{
    $("#beneficiary_id").val("0");
    $("#bid").val("");
    $("#full_name").val("");
    $("#bemail").val("");
    $("#bposition").val("");
    $("#bphone").val("");
    $("#come_from").val("");
    $("#bprovince").val("0");
    $("#bdistrict").html("");
    $("#bcommune").html("");
    $("#bvillage").html("");
    $("input[name='bch']").prop("checked", false);
}
function saveBeneficiary()
{
    var aid = $("#id").val();
    var o = confirm('Do you want to save?');
    if(o)
    {
        var ch = "";
        var check = $("input[name='bch']");
        for(var i=0; i<check.length;i++)
        {
            if(check[i].checked)
            {
                ch += check[i].value + ",";
            }
        }
        var bf = {
            id: $("#beneficiary_id").val(),
            bid: $("#bid").val(),
            full_name: $("#full_name").val(),
            activity_achieved_id: aid,
            gender: $("#bgender").val(),
            email: $("#bemail").val(),
            phone: $("#bphone").val(),
            come_from: $("#come_from").val(),
            province: $("#bprovince").val(),
            district: $("#bdistrict").val(),
            commune: $("#bcommune").val(),
            village: $("#bvillage").val(),
            type: ch,
            position: $("#bposition").val()
        }
        $.ajax({
            type: 'POST',
            url:burl + '/activity-achieve/beneficiary/save',
            data: bf,
            type: 'POST',
            beforeSend: function (request) {
                return request.setRequestHeader('X-CSRF-Token', $("input[name='_token']").val());
            },
            success:function(sms){
                // console.log(sms);

                sms = JSON.parse(sms);
                var x = $("#beneficiary_id").val();
                if(x>0)
                {
                    var str = "#beneficiaryData tr[id='" + x + "']";
                    var tr = $(str);
                    var id = $(tr).attr("id");
                    var tds = $(tr).children('td');
                    $(tds[1]).html(sms.benficiary_id);
                    $(tds[2]).html(sms.full_name);
                    $(tds[3]).html(sms.gender);
                    $(tds[4]).html(sms.come_from);
                    $(tds[5]).html(sms.email);
                    $(tds[6]).html(sms.phone);
                    $(tds[7]).html(sms.position);
                    $("#bsms").html("All changes have been saved successfully!");                        
                }
                else{
                    var counter = $("#beneficiaryData tr").length;
                    var tr = "";
                    
                    tr +="<tr id='" + sms.id + "'>";
                    tr += "<td>" + (counter++) + "</td>";
                    tr += "<td>" +  sms.benficiary_id + "</td>";
                    tr +="<td>" + sms.full_name + "</td>";
                    tr +="<td>" + sms.gender + "</td>";
                    tr +="<td>" + sms.come_from + "</td>";
                    tr +="<td>" + sms.email + "</td>";
                    tr +="<td>" + sms.phone + "</td>";
                    tr +="<td>" + sms.position + "</td>";
                    tr += "<td>" + "<button type='button' class='btn btn-sm btn-success btn-flat my-btn' onclick='editBeneficiary(this,event)'>Edit</button> <button type='button' class='btn btn-sm btn-danger btn-flat my-btn' onclick='deleteBeneficiary(this,event)'>Delete</button>" + "</td>";
                    tr +="</tr>";
                    
                    if(counter>0){
                        $("#beneficiaryData tr:last-child").after(tr);
                    }
                    else{
                        $("#beneficiaryData").html(tr);
                    }
                    clearBeneficiary();
                    $("#bsms").html("New beneficiary has been created successfully!");
                    
                }
            },
        });
    }
}
function deleteBeneficiary(obj, evt) {
    evt.preventDefault();
    var tr = $(obj).parent().parent();
    var id = $(tr).attr('id');
    var con = confirm('You want to delete?');
    if(con)
    {
        $.ajax({
        type: "GET",
        url: burl + "/activity-achieve/beneficiary/delete/" + id,
        success: function (response) {
                $(tr).remove();
            }
        });
    }

}
function editBeneficiary(obj,evt)
{
    evt.preventDefault();
    $("#beneficiary_title").html("Edit Beneficiary");
        var tr = $(obj).parent().parent();
        var id = $(tr).attr('id');
        $("#beneficiary_id").val(id);
        $.ajax({
        type: "GET",
        url: burl + "/activity-achieve/beneficiary/get/" + id,
        success: function(sms){
            sms = JSON.parse(sms);
            var txt = sms.type;
            txt = txt.split(",");
            var check = $("input[name='bch']");
            for(var i=0;i<txt.length;i++)
            {
                var str = "input[value='" + txt[i] + "']";
                $(str).prop("checked", true);
            }
           
            $("#bid").val(sms.beneficiary_id);
            $("#full_name").val(sms.full_name);
            $("#bgender").val(sms.gender);
            $("#bemail").val(sms.email);
            $("#bphone").val(sms.phone);
            $("#bposition").val(sms.position);
            $("#bprovince").val(sms.province_id);
            $("#come_from").val(sms.come_from);
            bindDistict1();
            $("#bdistrict").val(sms.district_id);
            $("#bcommune").val(sms.commune_id);
            $("#bvillage").val(sms.village_id);
            $("#btnAddBeneficiary").trigger("click");

        }
    });
}