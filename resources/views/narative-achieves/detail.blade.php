@extends("layouts.achieve")
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <strong>{{trans('labels.ngo_detail')}}</strong>&nbsp;&nbsp;
                    <a href="{{url('/narative-achieve/create')}}"><i class="fa fa-plus"></i> New</a>
                    <a href="{{url('/narative-achieve/edit/'.$narative_achieve->id)}}" class="text-danger"><i class="fa fa-pencil"></i> {{trans('labels.edit')}}</a>
                    <a href="{{url('/narative-achieve')}}" class="text-success"><i class="fa fa-arrow-left"></i> {{trans('labels.back')}}</a>
                </div>
                <div class="card-block">
                   <div class="row">
                       <div class="col-sm-6">
                           <div class="form-group row">
                               <label class="control-label col-sm-3 lb">{{trans('labels.start_date')}}</label>
                               <div class="col-sm-8">
                                   <input type="text" class="form-control" value="{{$narative_achieve->start_date}}" readonly>
                               </div>
                           </div>
                           <div class="form-group row">
                               <label  class="control-label col-sm-3 lb">{{trans('labels.end_date')}}</label>
                               <div class="col-sm-8">
                                   <input type="text" class="form-control" value="{{$narative_achieve->start_date}}" readonly>
                               </div>
                           </div>
                        </div>
                        <div class="col-sm-6">
                           <div class="form-group row">
                               <label class="control-label col-sm-3 lb">{{trans('labels.user_ngo')}}</label>
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
                                <label  class="control-label col-sm-12 lb text-primary"><b>{{trans('labels.cover_page')}}</b></label>
                                <div class="col-sm-12 lb">
                                    {!!$narative_achieve->cover_page!!}
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group row">
                                <label  class="control-label col-sm-12 lb text-primary"><b>{{trans('labels.table_of_content')}}</b></label>
                                <div class="col-sm-12 lb">
                                    {!!$narative_achieve->content!!}
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group row">
                                <label  class="control-label col-sm-12 lb text-primary"><b>{{trans('labels.list_of_acronyms')}}</b></label>
                                <div class="col-sm-12 lb">
                                    {!!$narative_achieve->acronyms!!}
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group row">
                                <label  class="control-label col-sm-12 lb text-primary"><b>{{trans('labels.list_of_table')}}</b></label>
                                <div class="col-sm-12 lb">
                                    {!!$narative_achieve->table_list!!}
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group row">
                                <label  class="control-label col-sm-12 lb text-primary"><b>{{trans('labels.list_of_figures')}}</b></label>
                                <div class="col-sm-12 lb">
                                    {!!$narative_achieve->figure!!}
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group row">
                                <label  class="control-label col-sm-12 lb text-primary"><b>{{trans('labels.list_of_photos')}}</b></label>
                                <div class="col-sm-12 lb">
                                    {!!$narative_achieve->photos!!}
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group row">
                                <label  class="control-label col-sm-12 lb text-primary"><b>{{trans('labels.executive_summary')}}</b></label>
                                <div class="col-sm-12 lb">
                                    {!!$narative_achieve->summary!!}
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group row">
                                <label  class="control-label col-sm-12 lb text-primary"><b>{{trans('labels.introduction')}}</b></label>
                                <div class="col-sm-12 lb">
                                    {!!$narative_achieve->introduction!!}
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group row">
                                <label  class="control-label col-sm-12 lb text-primary"><b>{{trans('labels.achievements_by_results_framework')}}</b></label>
                                <div class="col-sm-12 lb">
                                    {!!$narative_achieve->result_framework!!}
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group row">
                                <label  class="control-label col-sm-12 lb text-primary"><b>{{trans('labels.achievements_by_indicators')}}</b></label>
                                <div class="col-sm-12 lb">
                                    {!!$narative_achieve->indicator!!}
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group row">
                                <label  class="control-label col-sm-12 lb text-primary"><b>{{trans('labels.outcomes_and_impacts')}}</b></label>
                                <div class="col-sm-12 lb">
                                    {!!$narative_achieve->outcome!!}
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group row">
                                <label  class="control-label col-sm-12 lb text-primary"><b>{{trans('labels.challenges_and_solutions')}}</b></label>
                                <div class="col-sm-12 lb">
                                    {!!$narative_achieve->challenge!!}
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group row">
                                <label  class="control-label col-sm-12 lb text-primary"><b>{{trans('labels.lesson_learned')}}</b></label>
                                <div class="col-sm-12 lb">
                                    {!!$narative_achieve->lesson_learn!!}
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group row">
                                <label  class="control-label col-sm-12 lb text-primary"><b>{{trans('labels.next_plan')}}</b></label>
                                <div class="col-sm-12 lb">
                                    {!!$narative_achieve->next_plan!!}
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group row">
                                <label  class="control-label col-sm-12 lb text-primary"><b>{{trans('labels.financial_management')}}</b></label>
                                <div class="col-sm-12 lb">
                                    {!!$narative_achieve->financial!!}
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group row">
                                <label  class="control-label col-sm-12 lb text-primary"><b>{{trans('labels.annexes')}}</b></label>
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