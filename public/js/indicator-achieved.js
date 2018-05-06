$(document).ready(function(){
    $("#siderbar li a").removeClass("current");
    $("#menu_indicator").addClass("current");
    $("#start_date, #end_date").datepicker({
        orientation: 'bottom',
        format: 'dd/mm/yyyy',
        autoclose: true,
        todayHighlight: true,
        toggleActive: true
    });
    $("#target").multiSelect();
    $("#btnCancel").click(function(){
        var o = confirm('You want to cancel?');
        if(o)
        {
            location.href = burl + "/indicator-achieve/edit/" + $("#id").val();
            
        }
    });
    getInfo();
});
// bind target to a setting
function getTarget()
{
    var sid = $("#project_name").val();
    $.ajax({
        type: "GET",
        url: burl + "/indicator/target/get/" + sid,
        success: function(sms){
            sms = JSON.parse(sms);
            var opts = "<select class='form-control' name='target[]' id='target' multiple disabled>";
            for(var i=0;i<sms.length;i++)
            {
                opts += "<option value='" + sms[i].id + "' selected>" + sms[i].year + "</option>";
            }
            opts += "</select>";
            $("#sp").html(opts);
            $("#target").multiSelect();
          
        }
    });
}
// get project
function getProject()
{
    var ngo_id = $("#ngo").val();
    $.ajax({
        type: "GET",
        url: burl + "/indicator/project/get/" + ngo_id,
        success: function(sms){
            sms = JSON.parse(sms);
            var opts = "";
            for(var i=0;i<sms.length;i++)
            {
                opts += "<option value='" + sms[i].id + "'>" + sms[i].project_name + "</option>";
            }
            $("#project_name").chosen('destroy');
            $("#project_name").html(opts);
            $("#project_name").chosen();
            getInfo();
        }
    });
}
// bind info when project is change
function getInfo()
{
    clearForm();
    var sid = $("#project_name").val();
    $.ajax({
        type: "GET",
        url: burl + "/indicator/info/get/" + sid,
        success: function(sms){
            sms = JSON.parse(sms);
            $("#project_code").val(sms.project_code);
            $("#indicator_code").val(sms.indicator_code);
            $("#indicator_name").val(sms.indicator_name);
            $("#indicator_type").val(sms.type);
            $("#framework").val(sms.framework);
            $("#baseline").val(sms.baseline);
            $("#indicator_unit").val(sms.indicator_unit);
        }
    });
    getTarget();                
    
}
function clearForm()
{
    $("#project_code").val("");
            $("#indicator_code").val("");
            $("#indicator_name").val("");
            $("#indicator_type").val("");
            $("#framework").val("");
            $("#baseline").val("");
            $("#indicator_unit").val("");
}
// function to enable edit form
function editIndicator(evt)
{
    evt.preventDefault();
    $("#ngo").chosen('destroy');
    $("#ngo").removeAttr("disabled");
    $("#ngo").chosen();
    $("#project_name").chosen('destroy');
    $("#project_name").removeAttr('disabled');
    $("#project_name").chosen();
    $("#btnBox").removeClass("hide");
    $("#start_date").removeAttr("disabled");
    $("#end_date").removeAttr("disabled");
    $("#indicator_mode").removeAttr("disabled");
    $("#indicator_code").removeAttr("disabled");
    $("#indicator_name").removeAttr("disabled");
}
function editDescription()
{
    $("textarea").removeAttr("disabled");
    $("#description_box").removeClass("hide");
}
function clearDoc() {
    $("#doc_description").val("");
    $("#doc_file_name").val("");
    $("#docsms").html("");
    $("#doc_id").val("0");
    $("#file_url").val("");
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
        url: burl + "/indicator/document/delete/" + id,
        success: function (response) {
            $(tr).remove();
            }
        });
    }

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
        form_data.append('url', $("#file_url").val());
        form_data.append("act_id", id);
        $("#docsms").html("<img src='" + asset + "/ajax-loader.gif" + "'>");
        $.ajax({
            type: 'POST',
            url:burl + '/indicator/document/save',
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
                    tr +="<td>" + sms.description+ "</td>";
                    tr += "<td>" + "<a href='" + sms.url + "' target='_blank'>" + (sms.url!=null?sms.url:'') + "</a></td>";
                    tr += "<td>" + "<a href='" + doc_url + "/" + sms.file_name + "' target='_blank'>" + (sms.file_name!=null?sms.file_name:'') + "</a>" + "</td>";
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