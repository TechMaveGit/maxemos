@extends('layout.master')

@push('plugin-styles')
  <link href="{{ asset('assets/plugins/datatables-net-bs5/dataTables.bootstrap5.css') }}" rel="stylesheet" />

  <link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/jquery-tags-input/jquery.tagsinput.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/dropzone/dropzone.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/dropify/css/dropify.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/bootstrap-colorpicker/bootstrap-colorpicker.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/tempusdominus-bootstrap-4/tempusdominus-bootstrap-4.min.css') }}" rel="stylesheet" />
  @endpush

@push('plugin-styles')
  <link href="{{ asset('assets/plugins/prismjs/prism.css') }}" rel="stylesheet" />
  <script src="{{ asset('assets/meter/gauge.min.js') }}"></script>
@endpush
<style>
    .missingempty{
        border: 1px solid red !important;
    }
</style>

@section('content')

<div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0"><span class="user_name_title">Question & Answer</span></h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item active">System User Management</li>
                                <li class="breadcrumb-item active">Question & Answer</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>

<div class="page-header d-lg-flex d-block qandas_maintitle">
   <div class="page-leftheader">
      <div class="page-title">AdvanX Credit Algo ({{$finalAdvanxScore}})</div>
   </div>

<div class="page-rightheader ms-md-auto">
   <div class="d-flex align-items-end flex-wrap my-auto end-content breadcrumb-end">
      <div class="btn-list">
       <!-- <a href="javascript:void(0);" class="btn btn-primary"  data-bs-toggle="modal" data-bs-target="#add_User_modal"><i data-feather="plus" class="btn-icon-prepend feather_iconfont"></i> Add New User</a> -->
       <!-- <a href="javascript:void(0);" class="btn btn-light" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="E-mail"> <i class="feather feather-mail"></i> </a>
       <a href="javascript:void(0);" class="btn btn-light" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Contact"> <i class="feather feather-phone-call"></i> </a> <a href="javascript:void(0);" class="btn btn-primary" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Info"> <i class="feather feather-info"></i> </a> -->
     </div>
   </div>
</div>
</div>
<div class="row">
    <div class="col-xl-8 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <h6 class="card-title">Score Card</h6>
                    {{--<canvas id="chartjsLineScore"></canvas>--}}
                    <center><canvas id="radial-gauge"></canvas></center>
                </div><hr>
                <div class="row">
                    <div class="col-md-6">
                        <div class="col-md-12">
                            <i class="fa fa-dot-circle-o" style="color: #fa1d05;background: #fa1d05;border-radius: 50%;"></i> 85-125 Very Risky
                        </div>
                        <div class="col-md-12">
                            <i class="fa fa-dot-circle-o" style="color: #f07265;background: #f07265;border-radius: 50%;"></i> 126-150 Risky
                        </div>
                        <div class="col-md-12">
                            <i class="fa fa-dot-circle-o" style="color: #edb442;background: #edb442;border-radius: 50%;"></i> 151-175  Moderate
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="col-md-12">
                            <i class="fa fa-dot-circle-o" style="color: #64db4f;background: #64db4f;border-radius: 50%;"></i> 176-200 Risky
                        </div>
                        <div class="col-md-12">
                            <i class="fa fa-dot-circle-o" style="color: #24cc06;background: #24cc06;border-radius: 50%;"></i> 200-250 Very Safe
                        </div>
                        <div class="col-md-12">
                            <i class="fa fa-dot-circle-o" style="color: #24cc06;background: #24cc06;border-radius: 50%;"></i> Greater than 250 Very Safe
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4 question_credirscopen">
        <div class="card credit_numbersbtn">
            <h3>Credit Score</h3>
            <a href="javascript:void(0);" onclick="$('#creditScoreSummeryModal').modal('show');"><button type="button">Credit Scoring</button></a>
        </div>
    </div>
</div>
<section class="questionansser">
    <div class="row">
        <div class="col-lg-12">
            <div class="question_card card">
                <form id="actionForm" method="post">
                    @csrf
                    @if(count($categories))
                        @foreach($categories as $corw)
                            <div class="row mt-4">
                                <div class="col-md-12 text-center"><h3>{{$corw->name}}</h3></div>
                            </div>

                            <div class="row">
                                @if(isset($questionsArr[$corw->id]))
                                    <?php $questions=$questionsArr[$corw->id]; $qnsr=1; ?>
                                    @foreach($questions as $qnrow)
                                        <div class="col-lg-4 question_start">
                                            <div class="form-group">
                                                <label class="form-label">{{$qnsr++}}) {{$qnrow['qnsTitle']}}</label>
                                                @if($qnrow['qnsType']=='text')
                                                    @php
                                                        $textAns='';
                                                        if($qnrow['id']==1){
                                                            $textAns=$userDtl->name;
                                                        }
                                                    @endphp
                                                    <input type="text" id="{{$qnrow['inputName']}}" value="{{$textAns}}" name="{{$qnrow['inputName']}}" class="form-control">
                                                @else
                                                    @if(isset($optionsArr[$qnrow['id']]))
                                                        <?php $options=$optionsArr[$qnrow['id']]; ?>
                                                    <select class="js-example-basic-single2 form-select" id="{{$qnrow['inputName']}}" name="{{$qnrow['inputName']}}" data-width="100%">
                                                        <option value="" >Select</option>
                                                        @if($qnrow['inputName']=='product_name')
                                                            @foreach($products as $prow)
                                                                <option value="{{$prow->productId}}" >{{$prow->productName}} ({{$prow->productCode}})</option>
                                                            @endforeach
                                                        @else
                                                            @foreach($options as $oprow)
                                                                <option value="{{$oprow['id']}}" >{{$oprow['ansTitle']}}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                    @endif
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>

                        @endforeach
                    @endif


            <div class="modal-footer mt-3">
                <button type="submit" id="formSubmitBtn" class="btn btn-primary">Save changes</button>
            </div>

                </form>
            </div>
        </div>
    </div>
</section>


<div id="creditScoreSummeryModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Credit Scoring</h4>
                <a data-dismiss="modal" style="font-size: 20px;cursor: pointer;" onclick="$('#creditScoreSummeryModal').modal('hide');">X</a>
            </div>
            <div class="modal-body" id="creditScoreSummeryModalHtml">
                <?=$userCibilScoreAnsSummary?>
            </div>
            <div class="modal-footer">
                <button type="button" style="font-size: 20px;cursor: pointer;" onclick="$('#creditScoreSummeryModal').modal('hide');" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>

@endsection


@push('plugin-scripts')
  <script src="{{ asset('assets/plugins/datatables-net/jquery.dataTables.js') }}"></script>
  <script src="{{ asset('assets/plugins/datatables-net-bs5/dataTables.bootstrap5.js') }}"></script>
@endpush

@push('custom-scripts')
  <script src="{{ asset('assets/js/data-table.js') }}"></script>
@endpush

<!-- form elements -->

@push('plugin-scripts')
  <script src="{{ asset('assets/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/inputmask/jquery.inputmask.bundle.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/typeahead-js/typeahead.bundle.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/jquery-tags-input/jquery.tagsinput.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/dropzone/dropzone.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/dropify/js/dropify.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/bootstrap-colorpicker/bootstrap-colorpicker.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/moment/moment.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/tempusdominus-bootstrap-4/tempusdominus-bootstrap-4.js') }}"></script>
@endpush

@push('custom-scripts')
  <script src="{{ asset('assets/js/form-validation.js') }}"></script>
  <script src="{{ asset('assets/js/bootstrap-maxlength.js') }}"></script>
  <script src="{{ asset('assets/js/inputmask.js') }}"></script>
  <script src="{{ asset('assets/js/select2.js') }}"></script>
  <script src="{{ asset('assets/js/typeahead.js') }}"></script>
  <script src="{{ asset('assets/js/tags-input.js') }}"></script>
  <script src="{{ asset('assets/js/dropzone.js') }}"></script>
  <script src="{{ asset('assets/js/dropify.js') }}"></script>
  <script src="{{ asset('assets/js/bootstrap-colorpicker.js') }}"></script>
  <script src="{{ asset('assets/js/datepicker.js') }}"></script>
  <script src="{{ asset('assets/js/timepicker.js') }}"></script>
  <script src="{{ asset('assets/plugins/chartjs/chart.min.js')}}"></script>
  <script src="{{ asset('assets/js/chartjs.js')}}"></script>
@endpush


@push('plugin-scripts')
  <script>
    var varyingModal = document.getElementById('varyingModal')
    varyingModal.addEventListener('show.bs.modal', function (event) {
      // Button that triggered the modal
      var button = event.relatedTarget
      // Extract info from data-bs-* attributes
      var recipient = button.getAttribute('data-bs-whatever')
      // If necessary, you could initiate an AJAX request here
      // and then do the updating in a callback.
      //
      // Update the modal's content.
      var modalTitle = varyingModal.querySelector('.modal-title')
      var modalBodyInput = varyingModal.querySelector('.modal-body input')

      modalTitle.textContent = 'New message to ' + recipient
      modalBodyInput.value = recipient
    })
  </script>
  <script src="{{ asset('assets/plugins/prismjs/prism.js') }}"></script>
  <script src="{{ asset('assets/plugins/clipboard/clipboard.min.js') }}"></script>
@endpush
@section('scripts')
    <script>

        $('#actionForm').submit(function(e) {
            e.preventDefault();

            var formData = new FormData(this);

            $('#formSubmitBtn').text('Please Wait...').attr('disabled','disabled');
            $.ajax({
                type:'POST',
                url: "{{route('saveCreditScoreQnsAns',$userDtl->id)}}",
                data: formData,
                cache:false,
                contentType: false,
                processData: false,
                success: (data) => {
                    var obj = JSON.parse(data);
                    $('#formSubmitBtn').text('Submit').removeAttr('disabled');
                    if(obj.status=='success')
                    {
                        this.reset();
                        alertMessage('Success!', obj.message, 'success', 'yes');
                        return false;
                    }else{
                        alertMessage('Error!', obj.message, 'error', 'no');
                        return false;
                    }
                },
                error: function(data){
                    $('#formSubmitBtn').text('Save').removeAttr('disabled');
                    alertMessage('Error!', 'Invalid data uploaded', 'error', 'no');
                    return false;
                    //console.log(data);
                }
            });
        });

        @if(!empty($creditScoreUserAns))
            faormdata={!! $creditScoreUserAns['formData'] !!};
        @else
            faormdata={};
        @endif

        for (const key in faormdata) {
            if (Object.hasOwnProperty.call(faormdata, key)) {
                const element = faormdata[key];
                if(!element){
                    $('#'+key).addClass('missingempty');
                }
                $('#'+key).val(element);
            }
        }

    </script>
    {{--
    <script>
        var fontFamily = "'Roboto', Helvetica, sans-serif";
        var colors = {
            primary        : "#6571ff",
            secondary      : "#7987a1",
            success        : "#05a34a",
            info           : "#66d1d1",
            warning        : "#fbbc06",
            danger         : "#ff3366",
            light          : "#e9ecef",
            dark           : "#060c17",
            muted          : "#7987a1",
            gridBorder     : "rgba(77, 138, 240, .15)",
            bodyColor      : "#000",
            cardBg         : "#fff",
            veryRisk         : "#fa1d05",
            risky         : "#f07265",
            moderate         : "#edb442",
            safe         : "#64db4f",
            verySafe         : "#24cc06",
        };


        if($('#chartjsLineScore').length) {
            new Chart($("#chartjsLineScore"), {
                <?php
                    $CSVeryRisky=5;
                    $CSRisky=5;
                    $CSModerate=5;
                    $CSSafe=5;
                    $CSVerySafe=5;
                    if($finalAdvanxScore>0 && $finalAdvanxScore<125){
                        $CSVeryRisky=$finalAdvanxScore;
                    }else if($finalAdvanxScore>125 && $finalAdvanxScore<150){
                        $CSRisky=$finalAdvanxScore;
                    }else if($finalAdvanxScore>150 && $finalAdvanxScore<175){
                        $CSModerate=$finalAdvanxScore;
                    }else if($finalAdvanxScore>175 && $finalAdvanxScore<200){
                        $CSSafe=$finalAdvanxScore;
                    }else if($finalAdvanxScore>200 || $finalAdvanxScore>200){
                        $CSVerySafe=$finalAdvanxScore;
                    }
                ?>
                type: 'bar',
                data: {
                    labels: [ "Risk"],
                    datasets: [
                        {
                            label: "Very Risky",
                            backgroundColor: [colors.veryRisk, colors.danger, colors.warning, colors.success, colors.info],
                            data: [{{$CSVeryRisky}}],
                        },
                        {
                            label: "Risky",
                            backgroundColor: [colors.risky, colors.danger, colors.warning, colors.success, colors.info],
                            data: [{{$CSRisky}}],
                        },
                        {
                            label: "Moderate",
                            backgroundColor: [colors.moderate, colors.danger, colors.warning, colors.success, colors.info],
                            data: [{{$CSModerate}}],
                        },
                        {
                            label: "Safe",
                            backgroundColor: [colors.safe, colors.danger, colors.warning, colors.success, colors.info],
                            data: [{{$CSSafe}}],
                        },
                        {
                            label: "Very Safe",
                            backgroundColor: [colors.verySafe, colors.danger, colors.warning, colors.success, colors.info],
                            data: [{{$CSVerySafe}}],
                        }
                    ]
                },
                options: {
                    plugins: {
                        legend: { display: false },
                    },
                    scales: {
                        x: {
                            display: true,
                            grid: {
                                display: true,
                                color: colors.gridBorder,
                                borderColor: colors.gridBorder,
                            },
                            ticks: {
                                color: colors.bodyColor,
                                font: {
                                    size: 12
                                }
                            }
                        },
                        y: {
                            grid: {
                                display: true,
                                color: colors.gridBorder,
                                borderColor: colors.gridBorder,
                            },
                            ticks: {
                                color: colors.bodyColor,
                                font: {
                                    size: 12
                                }
                            }
                        }
                    }
                }
            });
        }

    </script>
    --}}
    <script>
        <?php
        $mtrstr='';
            for($mtr=0; $mtr<=250; $mtr++)
            {
                if($mtr%15==0)
                {
                    $mtrstr .=$mtr.',';
                }

            }
        ?>
        var gauge = new RadialGauge({
            "renderTo": 'radial-gauge',
            "width": 400,
            "height": 300,
            "minValue": 0,
            "maxValue": 250,
            "value": <?=$finalAdvanxScore?>,
            "units": false,
            "exactTicks": true,
            "majorTicks": [
               <?=$mtrstr?>
            ],
            "minorTicks": 0,
            "strokeTicks": true,
            "animatedValue": false,
            "animateOnInit": false,
            "title": false,
            "borders": true,
            "numbersMargin": 1,
            "valueInt": 3,
            "valueDec": 2,
            "majorTicksInt": 1,
            "majorTicksDec": 0,
            "animation": true,
            "animationDuration": 500,
            "animationRule": "cycle",
            "colorPlate": "#fff",
            "colorPlateEnd": "",
            "colorMajorTicks": "#444",
            "colorMinorTicks": "#666",
            "colorTitle": "#888",
            "colorUnits": "#888",
            "colorNumbers": "#444",
            "colorNeedle": "rgba(240,128,128,1)",
            "colorNeedleEnd": "rgba(255,160,122,.9)",
            "colorValueText": "#444",
            "colorValueTextShadow": "rgba(0,0,0,0.3)",
            "colorBorderShadow": "rgba(0,0,0,0.5)",
            "colorBorderOuter": "#ddd",
            "colorBorderOuterEnd": "#aaa",
            "colorBorderMiddle": "#eee",
            "colorBorderMiddleEnd": "#f0f0f0",
            "colorBorderInner": "#fafafa",
            "colorBorderInnerEnd": "#ccc",
            "colorValueBoxRect": "#888",
            "colorValueBoxRectEnd": "#666",
            "colorValueBoxBackground": "#babab2",
            "colorValueBoxShadow": "rgba(0,0,0,1)",
            "colorNeedleShadowUp": "rgba(2,255,255,0.2)",
            "colorNeedleShadowDown": "rgba(188,143,143,0.45)",
            "colorBarStroke": "#222",
            "colorBar": "#ccc",
            "colorBarProgress": "#888",
            "colorBarShadow": "#000",
            "fontNumbers": "Arial",
            "fontTitle": "Arial",
            "fontUnits": "Arial",
            "fontValue": "Arial",
            "fontNumbersSize": 15,
            "fontTitleSize": 24,
            "fontUnitsSize": 22,
            "fontValueSize": 26,
            "fontNumbersStyle": "normal",
            "fontTitleStyle": "normal",
            "fontUnitsStyle": "normal",
            "fontValueStyle": "normal",
            "fontNumbersWeight": "normal",
            "fontTitleWeight": "normal",
            "fontUnitsWeight": "normal",
            "fontValueWeight": "normal",
            "needle": true,
            "needleShadow": true,
            "needleType": "arrow",
            "needleStart": 5,
            "needleEnd": 85,
            "needleWidth": 4,
            "borderOuterWidth": 3,
            "borderMiddleWidth": 3,
            "borderInnerWidth": 3,
            "borderShadowWidth": 3,
            "valueBox": true,
            "valueBoxStroke": 5,
            "valueBoxWidth": 0,
            "valueText": "",
            "valueTextShadow": true,
            "valueBoxBorderRadius": 2.5,
            "highlights": [
                {
                    "from": 0,
                    "to": 125,
                    "color": "#fa1d05"
                },
                {
                    "from": 125,
                    "to": 150,
                    "color": "#f07265"
                },
                {
                    "from": 150,
                    "to": 175,
                    "color": "#edb442"
                },
                {
                    "from": 175,
                    "to": 200,
                    "color": "#64db4f"
                },
                {
                    "from": 200,
                    "to": 250,
                    "color": "#24cc06"
                }
            ],
            "highlightsWidth": 15,
            "barWidth": 0,
            "barStrokeWidth": 0,
            "barProgress": true,
            "barShadow": 0,
            "ticksAngle": 270,
            "startAngle": 45,
            "colorNeedleCircleOuter": "#f0f0f0",
            "colorNeedleCircleOuterEnd": "#ccc",
            "colorNeedleCircleInner": "#e8e8e8",
            "colorNeedleCircleInnerEnd": "#f5f5f5",
            "needleCircleSize": 10,
            "needleCircleInner": true,
            "needleCircleOuter": true,
            "animationTarget": "needle",
            "useMinPath": false,
        }).draw();

    </script>
@endsection
