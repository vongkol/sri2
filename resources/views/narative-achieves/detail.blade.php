@extends("layouts.setting")
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <strong>NGO Detail</strong>&nbsp;&nbsp;
                    <a href="{{url('/narative-achieve/create')}}"><i class="fa fa-plus"></i> New</a>
                    <a href="{{url('/narative-achieve/edit/'.$narative_achieve->id)}}" class="text-danger"><i class="fa fa-pencil"></i> Edit</a>
                    <a href="{{url('/narative-achieve')}}" class="text-success"><i class="fa fa-arrow-left"></i> Back</a>
                </div>
                <div class="card-block">
                   <div class="row">
                       <div class="col-sm-6">
                           <div class="form-group row">
                               <label class="control-label col-sm-3 lb">Start Date</label>
                               <div class="col-sm-8">
                                   <input type="text" class="form-control" value="{{$narative_achieve->start_date}}" readonly>
                               </div>
                           </div>
                           <div class="form-group row">
                               <label  class="control-label col-sm-3 lb">End Date</label>
                               <div class="col-sm-8">
                                   <input type="text" class="form-control" value="{{$narative_achieve->start_date}}" readonly>
                               </div>
                           </div>
                        </div>
                        <div class="col-sm-6">
                           <div class="form-group row">
                               <label class="control-label col-sm-3 lb">User NGO</label>
                               <div class="col-sm-8">
                                    <select name="ngo" id="ngo" class="form-control chosen-select">
                                        @foreach($ngos as $ngo)
                                            <option value="{{$ngo->id}}" {{$narative_achieve->ngo_id==$ngo->id?'selected':''}}>{{$ngo->name}}</option>
                                        @endforeach
                                    </select>
                               </div>
                           </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group row">
                                <label  class="control-label col-sm-12 lb text-primary"><b>Cover Page</b></label>
                                <div class="col-sm-12 lb">
                                    {!!$narative_achieve->cover_page!!}
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group row">
                                <label  class="control-label col-sm-12 lb text-primary"><b>Content</b></label>
                                <div class="col-sm-12 lb">
                                    {!!$narative_achieve->content!!}
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group row">
                                <label  class="control-label col-sm-12 lb text-primary"><b>Acronyms</b></label>
                                <div class="col-sm-12 lb">
                                    {!!$narative_achieve->acronyms!!}
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group row">
                                <label  class="control-label col-sm-12 lb text-primary"><b>Table List</b></label>
                                <div class="col-sm-12 lb">
                                    {!!$narative_achieve->table_list!!}
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group row">
                                <label  class="control-label col-sm-12 lb text-primary"><b>Figure</b></label>
                                <div class="col-sm-12 lb">
                                    {!!$narative_achieve->figure!!}
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group row">
                                <label  class="control-label col-sm-12 lb text-primary"><b>Photos</b></label>
                                <div class="col-sm-12 lb">
                                    {!!$narative_achieve->photos!!}
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group row">
                                <label  class="control-label col-sm-12 lb text-primary"><b>Summary</b></label>
                                <div class="col-sm-12 lb">
                                    {!!$narative_achieve->summary!!}
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group row">
                                <label  class="control-label col-sm-12 lb text-primary"><b>Introduction</b></label>
                                <div class="col-sm-12 lb">
                                    {!!$narative_achieve->introduction!!}
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group row">
                                <label  class="control-label col-sm-12 lb text-primary"><b>Result Framework</b></label>
                                <div class="col-sm-12 lb">
                                    {!!$narative_achieve->result_framework!!}
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group row">
                                <label  class="control-label col-sm-12 lb text-primary"><b>Indicator</b></label>
                                <div class="col-sm-12 lb">
                                    {!!$narative_achieve->indicator!!}
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group row">
                                <label  class="control-label col-sm-12 lb text-primary"><b>Outcome</b></label>
                                <div class="col-sm-12 lb">
                                    {!!$narative_achieve->outcome!!}
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group row">
                                <label  class="control-label col-sm-12 lb text-primary"><b>Challenge</b></label>
                                <div class="col-sm-12 lb">
                                    {!!$narative_achieve->challenge!!}
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group row">
                                <label  class="control-label col-sm-12 lb text-primary"><b>Lesson Learn</b></label>
                                <div class="col-sm-12 lb">
                                    {!!$narative_achieve->lesson_learn!!}
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group row">
                                <label  class="control-label col-sm-12 lb text-primary"><b>Next Plan</b></label>
                                <div class="col-sm-12 lb">
                                    {!!$narative_achieve->next_plan!!}
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group row">
                                <label  class="control-label col-sm-12 lb text-primary"><b>Financial</b></label>
                                <div class="col-sm-12 lb">
                                    {!!$narative_achieve->financial!!}
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group row">
                                <label  class="control-label col-sm-12 lb text-primary"><b>Annex</b></label>
                                <div class="col-sm-12 lb">
                                    {!!$narative_achieve->annex!!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        function loadFile(e){
            var output = document.getElementById('preview');
            output.src = URL.createObjectURL(e.target.files[0]);
        }
        $(document).ready(function () {
            $("#siderbar li a").removeClass("current");
            $("#company").addClass("current");
        })
    </script>

@endsection