@extends('layouts.report')
@section('content')
<link href="{{asset('css/datepicker.css')}}" rel="stylesheet">
    <div class="row">
        <div class="col-sm-12">
            <h3 class="text-primary">Dashboard Report</h3>
            <hr>
        </div>
    </div>
    <form action="{{url('/dashobard/search')}}" method="GET">
    @if(Auth::user()->ngo_id==0)
    <div class="row">
        <div class="col-sm-5">
            <div class="form-group row">
                <label for="ngo" class="control-label col-sm-3 lb">User NGO</label>
                <div class="col-sm-8">
                    <select name="ngo" id="ngo" class="form-control">
                        @foreach($ngos as $ngo)
                            <option value="{{$ngo->id}}" {{$ngo->id==$ngo_id?'selected':''}}>{{$ngo->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>
    @endif
    <p></p>
    <div class="row">
        <div class="col-sm-5">
            <div class="form-group row">
                <label for="start_date" class="control-label col-sm-3 lb">Start Date</label>
                <div class="col-sm-8">
                   <input type="text" class="form-control datepicker-icon"
                   value="{{$start_date}}" name="start_date" id="start_date">
                </div>
               
            </div>
        </div>
        <div class="col-sm-5">
            <div class="form-group row">
                <label for="end_date" class="control-label col-sm-3 lb">End Date</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control datepicker-icon" 
                    value="{{$end_date}}" id="end_date" name="end_date">
                </div>
               
            </div>
        </div>
    </div>

    <p></p>
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group row">
                <label class="col-sm-3 lb">&nbsp;</label>
                <div class="col-sm-8">
                    <button type="submit" name="type" title="Bar chart" value="bar">
                        <img src="{{asset('img/bar_chart.png')}}" alt="View as Bar Chart">
                    </button>
                    <button type="submit" name="type" title="Line chart" value="line">
                        <img src="{{asset('img/line_chart.png')}}" alt="View as Line Chart">
                    </button>
                    <button type="submit" name="type" title="Bar chart" value="pie">
                        <img src="{{asset('img/pie_chart.png')}}" alt="View as Pie Chart">
                    </button>
                </div>
            </div>
        </div>
    </div>
    </form>
<div class="row">
    <div class="col-sm-6">
        <p></p>
        <h6 class="text-primary"># of Activity by Category</h6>
        <p></p>
        <table class="tbl">
            <thead>
                <tr>
                    <th>&numero;</th>
                    <th>Activity Category</th>
                    <th># of Activity</th>
                </tr>
                
            </thead>
            <tbody>
                <?php $i=1; $total=0; ?>
                @foreach($acts as $a)
                    <tr>
                        <td>{{$i++}}</td>
                        <td>{{$a->name}}</td>
                        <td>{{$a->total}}</td>
                        <?php $total += $a->total; ?>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="2">Total</td>
                    <td>{{$total}}</td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="col-sm-6">
        <div id="container1">

        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-6">
            <p></p>
            <h6 class="text-primary"># of Activity by Type</h6>
            <p></p>
            <table class="tbl">
                <thead>
                    <tr>
                        <th>&numero;</th>
                        <th>Activity Type</th>
                        <th># of Activity</th>
                    </tr>
                    
                </thead>
                <tbody>
                    <?php $i=1; $total=0; ?>
                    @foreach($activities as $a)
                        <tr>
                            <td>{{$i++}}</td>
                            <td>{{$a->name}}</td>
                            <td>{{$a->total}}</td>
                            <?php $total += $a->total; ?>
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="2">Total</td>
                        <td>{{$total}}</td>
                    </tr>
                </tbody>
            </table>
    </div>
    <div class="col-sm-6">
        <div id="container2">

        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-6">
            <p></p>
            <h6 class="text-primary"># of Participants by Type</h6>
            <p></p>
            <table class="tbl">
                <thead>
                    <tr>
                        <th>&numero;</th>
                        <th>Participant Type</th>
                        <th>Total</th>
                    </tr>
                    
                </thead>
                <tbody>
                 
                    @foreach($participants as $a)
                        <tr>
                            <td>1</td>
                            <td>Total</td>
                            <td>{{$a->total}}</td>
                           
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Male</td>
                            <td>
                                {{$a->total - ($a->total_female + $a->total_youth)}}
                            </td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>Female</td>
                            <td>{{$a->total_female}}</td>
                            
                        </tr>
                        <tr>
                            <td>4</td>
                            <td>Youth</td>
                            <td>{{$a->total_youth}}</td>
                            
                        </tr>
                        {{-- <tr>
                            <td colspan="2">Total</td>
                            <td>{{$a->total + $a->total_female + $a->total_youth}}</td>
                        </tr> --}}
                    @endforeach
                  
                </tbody>
            </table>
    </div>
    <div class="col-sm-6">
        <div id="container3"></div>
    </div>
</div>
<div class="row">
    <div class="col-sm-6">
            <p></p>
            <h6 class="text-primary"># of Events by Province</h6>
            <p></p>
            <table class="tbl">
                <thead>
                    <tr>
                        <th>&numero;</th>
                        <th>Province</th>
                        <th># of Events</th>
                    </tr>
                    
                </thead>
                <tbody>
                    <?php $i=1; $total=0; ?>
                    @foreach($events as $a)
                        <tr>
                            <td>{{$i++}}</td>
                            <td>{{$a->name}}</td>
                            <td>{{$a->total}}</td>
                            <?php $total += $a->total; ?>
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="2">Total</td>
                        <td>{{$total}}</td>
                    </tr>
                </tbody>
            </table>
    </div>
    <div class="col-sm-6">
        <div id="container4"></div>
    </div>
</div>
<div class="row">
    <div class="col-sm-6">
            <p></p>
            <h6 class="text-primary"># of Events by Venue</h6>
            <p></p>
            <table class="tbl">
                <thead>
                    <tr>
                        <th>&numero;</th>
                        <th>Venue</th>
                        <th># of Events</th>
                    </tr>
                    
                </thead>
                <tbody>
                    <?php $i=1; $total=0; ?>
                    @foreach($events1 as $a)
                        <tr>
                            <td>{{$i++}}</td>
                            <td>{{$a->name}}</td>
                            <td>{{$a->total}}</td>
                            <?php $total += $a->total; ?>
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="2">Total</td>
                        <td>{{$total}}</td>
                    </tr>
                </tbody>
            </table>
    </div>
    <div class="col-sm-6">
        <div id="container5"></div>
    </div>
</div>
@endsection
@section('js')
<script src="{{asset('datepicker/js/bootstrap-datepicker.min.js')}}"></script>
<script src="{{asset('js/highcharts.js')}}"></script>
<script src="{{asset('js/exporting.js')}}"></script>
<script>
    // number of activity by category
    var ac = [];
    var ac1 = [];
    @foreach($acts as $a)
        ac.push("{{$a->name}}");
        ac1.push(Number("{{$a->total}}"));
    @endforeach
    // number of activity by type
    var t1 = [];
    var t2 = [];
    @foreach($activities as $a)
        t1.push("{{$a->name}}");
        t2.push(Number("{{$a->total}}"));
    @endforeach
    // total participant by type
    var p1 = ["Total", "Male", "Female", "Youth"];
    var p2 = [];
    @foreach($participants as $a)
       p2.push(Number("{{$a->total}}"));
       p2.push(Number("{{$a->total - ($a->total_female + $a->total_youth)}}"));
       p2.push(Number("{{$a->total_female}}"));
       p2.push(Number("{{$a->total_youth}}"));
       
    @endforeach
    // # of event by province
    var evt1 = [];
    var evt2 = [];
    @foreach($events as $a)
        evt1.push("{{$a->name}}");
        evt2.push(Number("{{$a->total}}"));
    @endforeach
    // # of event by venue
    var vn1 = [], vn2 = [];
    @foreach($events1 as $a)
        vn1.push("{{$a->name}}");
        vn2.push(Number("{{$a->total}}"));
    @endforeach
    $(document).ready(function(){
        $("#siderbar li a").removeClass("current");
        $("#menu_dashboard").addClass("current");
        $("#start_date, #end_date").datepicker({
            orientation: 'bottom',
            format: 'yyyy-mm-dd',
            autoclose: true,
            todayHighlight: true,
            toggleActive: true
        });
        // number of activity by category
        Highcharts.chart(
            'container1', 
            {
				chart: {
					type: "{{$type}}"
				},
                title: {
                    text: '# of Activity by category',
                    style: {
                        fontFamily: 'Arial',
                        fontSize: '14px',
                        color: '#0000FF'
                    }
                },
                subtitle: {
                    text: ' ' , //'From: May,2017 To: May,2018',
                },
                xAxis: {
                    categories: ac,
                    title: {
                        text: null
                    }
                },
                yAxis: {
                    min: 0,
                    title: {
                        text: '',
                        align: 'high'
                    },
                    labels: {
                        overflow: 'justify'
                    }
                },
                tooltip: {
                    valueSuffix: ''
                },
                plotOptions: {
                    bar: {
                        dataLabels: {
                            enabled: true
                        }
                    }
                },
                legend: {
                    layout: 'vertical',
                    align: 'right',
                    verticalAlign: 'top',
                    x: -40,
                    y: 80,
                    floating: true,
                    borderWidth: 1,
                    backgroundColor: ((Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'),
                    shadow: true
                },
                credits: {
                    enabled: false
                },
                series: [{
                    name: 'Value',
                    showInLegend: false,
                    colorByPoint: true,
                    data: ac1
                }]
            });
        // number of activity by type
        Highcharts.chart(
            'container2', 
            {
				chart: {
					type: "{{$type}}"
				},
                title: {
                    text: '# of Activity by Type',
                    style: {
                        fontFamily: 'Arial',
                        fontSize: '14px',
                        color: '#0000FF'
                    }
                },
                subtitle: {
                    text: ' ' , //'From: May,2017 To: May,2018',
                },
                xAxis: {
                    categories: t1,
                    title: {
                        text: null
                    }
                },
                yAxis: {
                    min: 0,
                    title: {
                        text: '',
                        align: 'high'
                    },
                    labels: {
                        overflow: 'justify'
                    }
                },
                tooltip: {
                    valueSuffix: ''
                },
                plotOptions: {
                    bar: {
                        dataLabels: {
                            enabled: true
                        }
                    }
                },
                legend: {
                    layout: 'vertical',
                    align: 'right',
                    verticalAlign: 'top',
                    x: -40,
                    y: 80,
                    floating: true,
                    borderWidth: 1,
                    backgroundColor: ((Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'),
                    shadow: true
                },
                credits: {
                    enabled: false
                },
                series: [{
                    name: 'Value',
                    showInLegend: false,
                    colorByPoint: true,
                    data: t2
                }]
            });
        // participant by type
        Highcharts.chart(
            'container3', 
            {
				chart: {
					type: "{{$type}}"
				},
                title: {
                    text: '# of Participant by Type',
                    style: {
                        fontFamily: 'Arial',
                        fontSize: '14px',
                        color: '#0000FF'
                    }
                },
                subtitle: {
                    text: ' ' , //'From: May,2017 To: May,2018',
                },
                xAxis: {
                    categories: p1,
                    title: {
                        text: null
                    }
                },
                yAxis: {
                    min: 0,
                    title: {
                        text: '',
                        align: 'high'
                    },
                    labels: {
                        overflow: 'justify'
                    }
                },
                tooltip: {
                    valueSuffix: ''
                },
                plotOptions: {
                    bar: {
                        dataLabels: {
                            enabled: true
                        }
                    }
                },
                legend: {
                    layout: 'vertical',
                    align: 'right',
                    verticalAlign: 'top',
                    x: -40,
                    y: 80,
                    floating: true,
                    borderWidth: 1,
                    backgroundColor: ((Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'),
                    shadow: true
                },
                credits: {
                    enabled: false
                },
                series: [{
                    name: 'Value',
                    showInLegend: false,
                    colorByPoint: true,
                    data: p2
                }]
            });
         // number of event by province
         Highcharts.chart(
            'container4', 
            {
				chart: {
					type: "{{$type}}"
				},
                title: {
                    text: '# of Events by Province',
                    style: {
                        fontFamily: 'Arial',
                        fontSize: '14px',
                        color: '#0000FF'
                    }
                },
                subtitle: {
                    text: ' ' , //'From: May,2017 To: May,2018',
                },
                xAxis: {
                    categories: evt1,
                    title: {
                        text: null
                    }
                },
                yAxis: {
                    min: 0,
                    title: {
                        text: '',
                        align: 'high'
                    },
                    labels: {
                        overflow: 'justify'
                    }
                },
                tooltip: {
                    valueSuffix: ''
                },
                plotOptions: {
                    bar: {
                        dataLabels: {
                            enabled: true
                        }
                    }
                },
                legend: {
                    layout: 'vertical',
                    align: 'right',
                    verticalAlign: 'top',
                    x: -40,
                    y: 80,
                    floating: true,
                    borderWidth: 1,
                    backgroundColor: ((Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'),
                    shadow: true
                },
                credits: {
                    enabled: false
                },
                series: [{
                    name: 'Value',
                    showInLegend: false,
                    colorByPoint: true,
                    data: evt2
                }]
            });
         // number of event by province
         Highcharts.chart(
            'container5', 
            {
				chart: {
					type: "{{$type}}"
				},
                title: {
                    text: '# of Events by Province',
                    style: {
                        fontFamily: 'Arial',
                        fontSize: '14px',
                        color: '#0000FF'
                    }
                },
                subtitle: {
                    text: ' ' , //'From: May,2017 To: May,2018',
                },
                xAxis: {
                    categories: vn1,
                    title: {
                        text: null
                    }
                },
                yAxis: {
                    min: 0,
                    title: {
                        text: '',
                        align: 'high'
                    },
                    labels: {
                        overflow: 'justify'
                    }
                },
                tooltip: {
                    valueSuffix: ''
                },
                plotOptions: {
                    bar: {
                        dataLabels: {
                            enabled: true
                        }
                    }
                },
                legend: {
                    layout: 'vertical',
                    align: 'right',
                    verticalAlign: 'top',
                    x: -40,
                    y: 80,
                    floating: true,
                    borderWidth: 1,
                    backgroundColor: ((Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'),
                    shadow: true
                },
                credits: {
                    enabled: false
                },
                series: [{
                    name: 'Value',
                    showInLegend: false,
                    colorByPoint: true,
                    data: vn2
                }]
            });
    });
</script>
@endsection