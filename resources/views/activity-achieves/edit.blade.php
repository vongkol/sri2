@extends("layouts.activity")
@section('content')
<link href="{{asset('css/datepicker.css')}}" rel="stylesheet">
<style>
    #sp .multi-select-button, #sp1 .multi-select-button{
        background: #eceeef;
    }
</style>
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <strong>Edit Activity Achieved</strong>&nbsp;&nbsp;
                <a href="{{url('/activity-achieve')}}" class="text-success"><i class="fa fa-arrow-left"></i> Back</a>
                <a href="#" class="text-danger" onclick="showEdit(event)"><i class="fa fa-pencil"></i> Edit</a>
                <a href="{{url('/activity-achieve/create')}}" class="text-primary"><i class="fa fa-plus"></i> New</a>
            </div>
            <div class="card-block">
                @if(Session::has('sms'))
                    <div class="alert alert-success" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <div>
                            {{session('sms')}}
                        </div>
                    </div>
                @endif
                <form action="{{url('/activity-achieve/update')}}" class="form-horizontal" method="post" onsubmit="return confirm('You want to save?')" id='frm'>
                    {{csrf_field()}}
                    <input type="hidden" name="id" value="{{$activity_achieve->id}}" id="id">
                    <div class="row">
                        <div class="col-sm-12">
                            <p class="text-primary" style="border-bottom:1px solid #ccc">
                                <strong>Information</strong>
                            </p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                             <div class="form-group row">
                            
                                <label for="ngo" class="control-label col-sm-4 lb">User NGO <span class="text-danger">*</span></label>
                                <div class="col-sm-8">
                                    <select name="ngo" id="ngo" class="form-control chosen-select" onchange="binding()" disabled>
                                    @foreach($ngos as $ngo)
                                        <option value="{{$ngo->id}}" {{$activity_achieve->ngo_id==$ngo->id?'selected':''}}>{{$ngo->name}}</option>
                                    @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group row">
                                <label for="activity_type" class="control-label col-sm-4 lb">Activity Type <span class="text-danger">*</span></label>
                                <div class="col-sm-8">
                                    <select name="activity_type" id="activity_type" class="form-control chosen-select" disabled>
                                        @foreach($activity_types as $t)
                                        <option value="{{$t->id}}" {{$t->id==$activity_achieve->activity_type_id?'selected':''}}>{{$t->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group row">
                                <label for="activity_name" class="control-label col-sm-2 lb">Activity Name</label>
                                <div class="col-sm-10">
                                    <select name="activity_name" id="activity_name" class="form-control chosen-select" disabled>
                                    @foreach($settings as $s)
                                        <option value="{{$s->id}}" {{$s->id==$activity_achieve->activity_setting_id?'selected':''}}>{{$s->activity_name}}</option>
                                    @endforeach
                                </select>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12"></div>
                    </div>
                    <div class="row">

                        <div class="col-sm-6">
                            <div class="form-group row">
                                <label for="start_date" class="control-label col-sm-4 lb">Start Date</label>
                                <div class="col-sm-8">
                                   <input type="text"  placeholder="MM/DD/YYYY"  class="form-control datepicker-icon" id="start_date" name="start_date" value="{{$activity_achieve->start_date}}" disabled>
                                </div>
                            </div>
                           <div class="form-group row">
                                <label for="result_framework_structure" class="control-label col-sm-4 lb">Result Framework Structure</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="result_framework_structure" name="result_framework_structure" disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="activity_category" class="control-label col-sm-4 lb">Activity Category</label>
                                <div class="col-sm-8">
                                    <select name="activity_category" id="activity_category" class="form-control chosen-select" data-placeholder=" " disabled>
                                    @foreach($activity_categories as $c)
                                        <option value="{{$c->id}}" {{$c->id==$activity_achieve->activity_category_id?'selected':''}}>{{$c->name}}</option>
                                    @endforeach
                                    </select>
                                </div>
                            </div>
                           <div class="form-group row">
                                <label for="person_achieved" class="control-label col-sm-4 lb">Person(s) achieved activity</label>
                                <div class="col-sm-8" id="sp2">
                                    <select name="person_achieved[]" id="person_achieved" class="form-control" multiple disabled>
                                    @foreach($users as $per)
                                        @php($a = "")
                                        @foreach($person_achieves as $pa)
                                            @if($per->id==$pa->user_id)
                                                {{$a="selected"}}
                                            @endif
                                        @endforeach
                                        <option value="{{$per->id}}" {{$a}}>{{$per->name}}</option>
                                        @php($a="")
                                    @endforeach
                                    </select>
                                </div>
                            </div>
                           
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group row">
                                <label for="end_date" class="control-label col-sm-4 lb">End Date</label>
                                <div class="col-sm-8">
                                   <input type="text" class="form-control datepicker-icon"  placeholder="MM/DD/YYYY"  id="end_date" name="end_date" value="{{$activity_achieve->end_date}}" disabled>
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label for="component_responsible" class="control-label col-sm-4 lb">Component Responsible</label>
                                <div class="col-sm-8" id="sp">
                                    <select name="component_responsible[]" id="component_responsible" class="form-control" multiple disabled>
                                   
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="actual" class="control-label col-sm-4 lb">Actual</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" value="{{$activity_achieve->actual}}" id="actual" name="actual" placeholder="Input actual" disabled>
                                </div>
                            </div>
                           <div class="form-group row">
                                <label for="person_responsible" class="control-label col-sm-4 lb">Person Responsible</label>
                                <div class="col-sm-8" id="sp1">
                                    <select name="person_responsible[]" id="person_responsible" class="form-control" multiple disabled>
                                   
                                    </select>
                                </div>
                            </div>
                        </div>                  
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <p class="text-center hide" id="box">
                                <br>
                                <button class="btn btn-primary btn-flat" type="submit">Save</button>
                                <button class="btn btn-danger btn-flat" type="button" id="btnCancel">Cancel</button>
                            </p>
                        </div>
                    </div>
                     <div class="row">
                        <div class="col-sm-12">
                            <p class="text-success">
                                <br>
                                All fields with <span class="text-danger">*</span> are required!
                                <br>
                            </p>
                        </div>
                    </div>
                </form>
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#description" role="tab">Description</a>
                    </li>
                     <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#funding" role="tab" id="funding_tab">Funding</a>
                    </li>
                     <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#document" role="tab">Supporting Document</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#event" role="tab">Event</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#beneficiary" role="tab">Beneficiary</a>
                    </li>
                     <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#other1" role="tab">Other 1</a>
                    </li>
                     <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#other2" role="tab">Other 2</a>
                    </li>
                     <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#other3" role="tab">Other 3</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="description" role="tabpanel">
                        <form action="{{url('/activity-achieve/description/update')}}" method="post" onsubmit="return confirm('You want to save changes?')">
                        {{csrf_field()}}
                        <input type="hidden" value="{{$activity_achieve->id}}" name="id_for_description">
                        <div class="row">
                            <div class="col-sm-12">
                                @if(Session::has('sms2'))
                                    <div class="alert alert-success" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        <div>
                                            {{session('sms2')}}
                                        </div>
                                    </div>
                                @endif
                                <p>
                                <br>
                                <button type="button" class="btn btn-primary btn-flat" onclick="editDescription()"><i class="fa fa-plus"></i> Edit Description</button>
                                </p>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label for="achievement" class="control-label col-sm-4 lb">Achievement</label>
                                    <div class="col-sm-8">
                                        <textarea name="achievement" id="achievement" cols="30" rows="2" class="form-control" disabled>{{$activity_achieve->achievement}}</textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="solution" class="control-label col-sm-4 lb">Solution</label>
                                    <div class="col-sm-8">
                                        <textarea name="solution" id="solution" cols="30" rows="2" class="form-control" disabled>{{$activity_achieve->solution}}</textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="next_plan" class="control-label col-sm-4 lb">Next Plan</label>
                                    <div class="col-sm-8">
                                        <textarea name="next_plan" id="next_plan" cols="30" rows="2" class="form-control" disabled>{{$activity_achieve->next_plan}}</textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-sm-4 lb">&nbsp;</label>
                                    <div class="col-sm-8">
                                        <p class="hide" id="description_box">
                                            <button type="submit" class="btn btn-primary btn-flat">Save Changes</button>
                                            <button type="button" class="btn btn-danger btn-flat" onclick="cancelDescription()">Cancel</button>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label for="challenge" class="control-label col-sm-4 lb">Challenge</label>
                                    <div class="col-sm-8">
                                        <textarea name="challenge" id="challenge" cols="30" rows="2" class="form-control" disabled>{{$activity_achieve->challenge}}</textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="lesson_learn" class="control-label col-sm-4 lb">Lesson Learn</label>
                                    <div class="col-sm-8">
                                        <textarea name="lesson_learn" id="lesson_learn" cols="30" rows="2" class="form-control" disabled>{{$activity_achieve->lesson_learn}}</textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="other_comment" class="control-label col-sm-4 lb">Other Comment</label>
                                    <div class="col-sm-8">
                                        <textarea name="other_comment" id="other_comment" cols="30" rows="2" class="form-control" disabled>{{$activity_achieve->other_comment}}</textarea>
                                    </div>
                                </div>

                            </div>
                        </div>
                        </form>
                    </div>
                    <div class="tab-pane" id="funding" role="tabpanel">
                    <form action="{{url('/activity-achieve/funding/update')}}" method="post" onsubmit="return confirm('You want to save changes?')">
                        {{csrf_field()}}
                        <input type="hidden" value="{{$activity_achieve->id}}" name="id_for_funding">
                        <div class="row">
                            <div class="col-sm-12">
                                @if(Session::has('sms3'))
                                    <div class="alert alert-success" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        <div>
                                            {{session('sms3')}}
                                        </div>
                                    </div>
                                @endif
                                <p>
                                <br>
                                <button type="button" class="btn btn-primary btn-flat" onclick="editFunding()"><i class="fa fa-plus"></i> Edit Funding</button>
                                </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label for="total_budget" class="control-label col-sm-4 lb">Total Budget($)</label>
                                    <div class="col-sm-8">
                                        <input type="number" step="0.01" min="0" value="{{$activity_achieve->total_budget}}" class="form-control" id="total_budget" name="total_budget" disabled>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-sm-4 lb">&nbsp;</label>
                                    <div class="col-sm-8">
                                        <p class="hide" id="funding_box">
                                            <button type="submit" class="btn btn-primary btn-flat">Save Changes</button>
                                            <button type="button" class="btn btn-danger btn-flat" onclick="cancelFunding()">Cancel</button>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label for="total_expense" class="control-label col-sm-4 lb">Total Expense($)</label>
                                    <div class="col-sm-8">
                                        <input type="number" step="0.01" min="0" value="{{$activity_achieve->total_expense}}" class="form-control" id="total_expense" name="total_expense" disabled>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        </form>
                    </div>
                    <div class="tab-pane" id="document" role="tabpanel">
                        <p>
                        <br>
                            <a class="btn btn-primary btn-flat" href="#" id="btnAddTarget" data-toggle="modal" 
                            data-target=".bd-target-modal-lg"><i class="fa fa-plus"></i> Upload Document</a>
                        </p>
                        <table class="tbl">
                            <thead>
                                <tr>
                                    <th>&numero;</th>
                                    <th>File Name</th>
                                    <th>Description</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody id="docData">
                            @php($i=1)
                            @foreach($documents as $doc)
                                <tr id="{{$doc->id}}">
                                    <td>{{$i++}}</td>
                                    <td><a href="{{asset('uploads/documents/'.$doc->file_name)}}" target="_blank">{{$doc->file_name}}</a></td>
                                    <td>{{$doc->description}}</td>
                                    <td>
                                        <button type='button' class="btn btn-sm btn-danger" onclick="deleteDoc(this,event)"><i class="fa fa-trash-o"></i> Delete</button>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane" id="event" role="tabpanel">
                        <p>
                        <br>
                            <a href="#" class="btn btn-primary btn-flat" id="btnAddEvent" data-toggle="modal" data-target="#event_modal"><i class="fa fa-plus"></i> New Event</a>
                        </p>
                       <table class="tbl">
                            <thead>
                                <tr>
                                    <th>&numero;</th>
                                    <th>Activity Subject</th>
                                    <th>Event Organizer</th>
                                    <th>Total Participant</th>
                                    <th>Total Female</th>
                                    <th>Total Youth</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody id="eventData">
                            @php($i=1)
                            @foreach($events as $ev)
                                <tr id="{{$ev->id}}">
                                    <td>{{$i++}}</td>
                                    <td>{{$ev->subject}}</td>
                                    <td>{{$ev->name}}</td>
                                    <td>{{$ev->total_participant}}</td>
                                    <td>{{$ev->total_female}}</td>
                                    <td>{{$ev->total_youth}}</td>
                                    <td>
                                        <button type='button' class="btn btn-sm btn-success" onclick="editEvent(this,event)"><i class="fa fa-pencil"></i> Edit</button>
                                        <button type='button' class="btn btn-sm btn-danger" onclick="deleteEvent(this,event)"><i class="fa fa-trash-o"></i> Delete</button>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        
                    </div>
                    <div class="tab-pane" id="beneficiary" role="tabpanel">
                        <p>
                        <br>
                            <a href="#" class="btn btn-primary btn-flat" id="btnAddBeneficiary" data-toggle="modal" data-target="#beneficiary_modal"><i class="fa fa-plus"></i> New Beneficiary</a>
                        </p>
                        <table class="tbl">
                            <thead>
                                <tr>
                                    <th>&numero;</th>
                                    <th>Beneficiary ID</th>
                                    <th>Beneficiay Name</th>
                                    <th>Gender</th>
                                    <th>Come From</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Position</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody id="beneficiaryData">
                            @php($i=1)
                            @foreach($beneficiaries as $b)
                                <tr id="{{$b->id}}">
                                    <td>{{$i++}}</td>
                                    <td>{{$b->beneficiary_id}}</td>
                                    <td>{{$b->full_name}}</td>
                                    <td>{{$b->gender}}</td>
                                    <td>{{$b->come_from}}</td>
                                    <td>{{$b->email}}</td>
                                    <td>{{$b->phone}}</td>
                                    <td>{{$b->position}}</td>
                                    <td>
                                        <button type='button' class="btn btn-sm btn-success" onclick="editBeneficiary(this,event)"><i class="fa fa-pencil"></i> Edit</button>
                                        <button type='button' class="btn btn-sm btn-danger" onclick="deleteBeneficiary(this,event)"><i class="fa fa-trash-o"></i> Delete</button>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        
                    </div>
                    <div class="tab-pane" id="other1" role="tabpanel">
                        <p>
                            Other 1
                        </p>
                        
                    </div>
                    <div class="tab-pane" id="other2" role="tabpanel">
                        <p>
                            Other 2
                        </p>
                        
                    </div>
                    <div class="tab-pane" id="other3" role="tabpanel">
                        <p>
                            Other 3
                        </p>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('modal')
<div class="modal fade bd-target-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content btn-flat">
            <div class="modal-header">
                <h5 class="modal-title" id="documentTitle">Upload New Document</h5>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="target1">
                   <input type="hidden" id="doc_id" name="doc_id" value="0">
                    <div class="form-group row">
                        <label for="doc_description" class="control-label col-sm-2 lb">Description</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="doc_description" name="doc_description">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="doc_file_name" class="control-label col-sm-2 lb">File Name</label>
                        <div class="col-sm-8">
                            <input type="file" class="form-control" id="doc_file_name" name="doc_file_name">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <br>
                            <p class="text-success text-center" id="docsms"></p>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <div class="col-md-12 text-center">
                <button type="button" class="btn btn-primary btn-flat" onclick="saveDoc()">Save</button>
                <button type="button" class="btn btn-danger btn-flat" data-dismiss="modal" onclick="clearDoc()">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade bd-target-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="event_modal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content btn-flat">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Create New Event</h5>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="target1">
                   <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group row">
                                <label for="activity_area" class="control-label col-sm-3 lb">Activity Area <span class="text-danger">*</span></label>
                                <div class="col-sm-8">
                                    <select name="activity_area" id="activity_area" class="form-control">
                                    @foreach($activity_areas as $ac)
                                        <option value="{{$ac->id}}">{{$ac->name}}</option>
                                    @endforeach
                                    </select>
                                    
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="activity_subject" class="control-label col-sm-3 lb">Activity Subject <span class="text-danger">*</span></label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="activity_subject" name="activity_subject">
                                    <input type="hidden" name="event_id" id="event_id" value="0">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="event_organizer" class="control-label col-sm-3 lb">Event Organizer <span class="text-danger">*</span></label>
                                <div class="col-sm-8">
                                    <select name="event_organizer" id="event_organizer" class="form-control">
                                    @foreach($event_organizers as $ev)
                                        <option value="{{$ev->id}}">{{$ev->name}}</option>
                                    @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="total" class="control-label col-sm-3 lb">Total Participant</label>
                                <div class="col-sm-8">
                                    <input type="number" class="form-control" id="total" value="0" min="0" step="1" name="total">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="total_female" class="control-label col-sm-3 lb">Total Female</label>
                                <div class="col-sm-8">
                                    <input type="number" class="form-control" id="total_female" value="0" min="0" step="1" name="total_female">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="total_youth" class="control-label col-sm-3 lb">Total Youth</label>
                                <div class="col-sm-8">
                                    <input type="number" class="form-control" id="total_youth" value="0" min="0" step="1" name="total_youth">
                                </div>
                            </div>
                             <div class="form-group row">
                                <label for="province" class="control-label col-sm-3 lb">Province</label>
                                <div class="col-sm-8">
                                    <select name="province" id="province" class="form-control" onchange="bindDistict()">
                                        <option value="0">-- Choose One --</option>
                                    @foreach($provinces as $pro)
                                        <option value="{{$pro->id}}">{{$pro->name}} - {{$pro->name_kh}}</option>
                                    @endforeach
                                    </select>
                                </div>
                            </div>
                             <div class="form-group row">
                                <label for="district" class="control-label col-sm-3 lb">District</label>
                                <div class="col-sm-8">
                                    <select name="district" id="district" class="form-control" onchange="bindCommune()">
                                        
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="commune" class="control-label col-sm-3 lb">Commune</label>
                                <div class="col-sm-8">
                                    <select name="commune" id="commune" class="form-control" onchange="bindVillage()">
                                        
                                    </select>
                                </div>
                            </div>
                             <div class="form-group row">
                                <label for="village" class="control-label col-sm-3 lb">Village</label>
                                <div class="col-sm-8">
                                    <select name="village" id="village" class="form-control">
                                        
                                    </select>
                                </div>
                            </div>
                        </div>
                   </div>
                   
                    <div class="row">
                        <div class="col-sm-12">
                            <br>
                            <p class="text-success text-center" id="eventsms"></p>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <div class="col-md-12 text-center">
                <button type="button" class="btn btn-primary btn-flat" onclick="saveEvent()">Save</button>
                <button type="button" class="btn btn-danger btn-flat" data-dismiss="modal" onclick="clearEvent()">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade bd-target-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="beneficiary_modal">
    <div class="modal-dialog modal-xlg">
        <div class="modal-content btn-flat">
            <div class="modal-header">
                <h5 class="modal-title" id="beneficiary_title">Create New Beneficiary</h5>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="target1">
                   <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group row">
                                <label for="bid" class="control-label col-sm-3 lb">Beneficiary ID</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" id="bid" name="bid">
                                    <input type="hidden" id="beneficiary_id" name="beneficiary_id" value="0">
                                </div>
                                 <label for="bgender" class="control-label col-sm-1 lb">Gender</label>
                                <div class="col-sm-3">
                                    <select name="bgender" id="bgender" class="form-control">
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                </div>
                               
                            </div>
                          
                            <div class="form-group row">
                                <label for="full_name" class="control-label col-sm-3 lb">Beneficiary Name</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="full_name" name="full_name">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="bemail" class="control-label col-sm-3 lb">Email</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" id="bemail" name="bemail">
                                </div>
                                <label for="bphone" class="control-label col-sm-1 lb">Phone</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" id="bphone" name="bphone">
                                </div>
                            </div>
                            <div class="form-group row">
                            <label for="come_from" class="control-label col-sm-3 lb">Come From</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" id="come_from" name="come_from">
                                </div>
                                <label for="bposition" class="control-label col-sm-1 lb">Position</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" id="bposition" name="bposition">
                                </div>
                            </div>
                             <div class="form-group row">
                                <label for="bprovince" class="control-label col-sm-3 lb">Province</label>
                                <div class="col-sm-4">
                                    <select name="bprovince" id="bprovince" class="form-control" onchange="bindDistict1()">
                                        <option value="0">-- Choose One --</option>
                                    @foreach($provinces as $pro)
                                        <option value="{{$pro->id}}">{{$pro->name}} - {{$pro->name_kh}}</option>
                                    @endforeach
                                    </select>

                                </div>
                                <label for="bdistrict" class="control-label col-sm-1 lb">District</label>
                                <div class="col-sm-3">
                                    <select name="bdistrict" id="bdistrict" class="form-control" onchange="bindCommune1()">
                                        
                                    </select>
                                </div>
                            </div>
                           
                            <div class="form-group row">
                                <label for="bcommune" class="control-label col-sm-3 lb">Commune</label>
                                <div class="col-sm-4">
                                    <select name="bcommune" id="bcommune" class="form-control" onchange="bindVillage1()">
                                        
                                    </select>
                                </div>
                                <label for="bvillage" class="control-label col-sm-1 lb">Village</label>
                                <div class="col-sm-3">
                                    <select name="bvillage" id="bvillage" class="form-control">
                                        
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label lb col-sm-3">Beneficiary Type</label>
                                <div class="col-sm-4">
                                    <br>
                                    <label class="lb">
                                        <input type="checkbox" name="bch" value="Provincial NGO Network"> Provincial NGO Network
                                    </label>
                                    <br>
                                    <label class="lb">
                                        <input type="checkbox" name="bch" value="Non-member"> Non-member
                                    </label>
                                    
                                </div> 
                                <div class="col-sm-4">
                                    <br>
                                    <label class="lb">
                                        <input type="checkbox" name="bch" value="Member"> Member
                                    </label>
                                    <br>
                                    <label class="lb">
                                        <input type="checkbox" name="bch" value="Other"> Other
                                    </label>
                                </div>   
                            </div>
                        </div>
                   </div>
                   
                    <div class="row">
                        <div class="col-sm-12">
                            <br>
                            <p class="text-success text-center" id="bsms"></p>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <div class="col-md-12 text-center">
                <button type="button" class="btn btn-primary btn-flat" onclick="saveBeneficiary()">Save</button>
                <button type="button" class="btn btn-danger btn-flat" data-dismiss="modal" onclick="clearBeneficiary()">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
    <script src="{{asset('js/multiselect/jquery.multi-select.min.js')}}"></script>
    <script src="{{asset('datepicker/js/bootstrap-datepicker.min.js')}}"></script>
    <script src="{{asset('js/activity-achieved.js')}}"></script>
@endsection
