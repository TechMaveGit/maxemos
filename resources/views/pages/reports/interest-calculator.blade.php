@extends('layout.master')

@section('content')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        .loan-calculator {
            font-family: "Roboto", sans-serif;
            width: 95%;
            margin: 24px auto;
            background: #fff;
            box-shadow: 0 12px 50px -11px rgba(0, 0, 0, 0.2);
            border-radius: 8px;
            color: #14213d;
            overflow: hidden;
        }

        .loan-calculator,
        .loan-calculator * {
            box-sizing: border-box;
        }

        .loan-calculator .top {
            background: #050A30;
            color: #fff;
            padding: 32px;
        }


        .loan-calculator .result {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 32px;
        }

        .loan-calculator .result .left {
            width: 100%;
            padding: 8px 32px;
        }

        .loan-calculator .left h3 {
            font-size: 16px;
            font-weight: 400;
            margin-bottom: 8px;
        }

        .loan-calculator .result .value {
            font-size: 30px;
            font-weight: 900;
            padding-bottom: 10px;
            border-bottom: 1px solid rgba(20, 33, 61, 0.2);
        }

        .loan-calculator .result .value::before {
            content: "\20B9";
            font-size: 27px;
            font-weight: 400;
            margin-right: 6px;
            opacity: 0.4;
        }

        .select2-selection {
            height: 39px !important;
            display: flex !important;
            align-items: center;
        }



        .loan-calculator .right {
            width: 50%;
        }
        .total-down-payment h3{
            font-size: 20px;
            font-weight: 800 !important;
        }

        .font-b{
            font-size: 30px;
        }

        @media (max-width: 650px) {
            .loan-calculator {
                width: 90%;
                max-width: 500px;
                min-height: 1400px;
            }

            .loan-calculator form .group {
                flex-direction: column;
                gap: 20px;
            }

            .loan-calculator form .groups {
                flex-direction: column;
                gap: 20px;
            }

            .loan-calculator .result {
                flex-direction: column;
                text-align: center;
            }
        }
    </style>
    <main>
        <div class="breadcrums_area breadcrums">
            <div class="common_pagetitle">Raw Interest Calculate</div>

            <div class="flex items-center space-x-4  lg:py-6 breadcrum_right">
                <h2 class="text-xl font-medium text-slate-800 dark:text-navy-50 lg:text-2xl breadcrum_largetitle">
                    Dashboard
                </h2>
                <div class="hidden h-full py-1 sm:flex">
                    <div class="h-full w-px bg-slate-300 dark:bg-navy-600"></div>
                </div>
                <ul class="hidden flex-wrap items-center space-x-2 sm:flex">
                    <li class="flex items-center space-x-2">
                        <a class="text-primary transition-colors hover:text-primary-focus dark:text-accent-light dark:hover:text-accent"
                            href="javascript:;">Reports</a>
                        <svg x-ignore="" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </li>
                    <li>Raw Interest Calculate</li>
                </ul>
            </div>
        </div>

        <div class="main_page_title">
            <div class="common_pagetitlebig" style="width: 30%;">Raw Interest Calculate</div>

        </div>

        <section class="filters_table">

            <div class="table_mainstart">
                <div class="row">
                    <div class="col-lg-12">
                        <div>
                            <div class="row loan-calculator">
                                <div class="col-md-6 top" id="FormCalculate">
                                    <form action="#" class="row my-3">
                                        <div class="form-group mb-3">
                                            <label class="title">Customer Name </label>
                                            <select class="form-control select2 required_fields" id="selectCustomer">
                                                <option value="">Select Customer</option>
                                                @if ($allcustomers)
                                                    @foreach ($allcustomers as $kk => $customer)
                                                        <option value="{{ $kk }}">{{ $customer['customerCode'] }}
                                                            ({{ $customer['name'] }})
                                                        </option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>

                                        <div class="form-group mb-3">
                                            <label class="title">Loan ID</label>
                                            <select class="form-control select2 required_fields" id="selectLoans">

                                            </select>
                                        </div>

                                        <div class="form-group mb-3">
                                            <label class="title">Pay Amount</label>
                                            <input class="form-control required_fields" id="payamount" type="number" min="0"
                                                value="" />
                                        </div>

                                        <div class="form-group mb-3">
                                            <label class="title">Transaction Date</label>
                                            <input id="dateOfBirthE" name="transactionDate"  x-flatpickr=""
                                                class="form-control mt-1.5  w-full rounded-lg required_fields flatpickr-input"
                                                placeholder="Choose date..." type="text" readonly="readonly">
                                        </div>
                                        <div class="col-12">
                                            <button id="calculate_data" class="btn btn-primary mt-3"
                                                style="background: #0d6efd; width:100%" type="button">Calculate</button>
                                        </div>
                                    </form>

                                </div>

                                <div class="result col-md-6">
                                    <div class="left">
                                        <div class="total-down-payment mb-4">
                                            <h3>ROI %</h3>
                                            <div class="roi_value font-b">0</div>
                                        </div>
                                        <div class="total-down-payment mb-4">
                                            <h3>Number Of Days</h3>
                                            <div class="numOfDays font-b">0</div>
                                        </div>
                                        <div class="total-down-payment mb-4">
                                            <h3>TDS Percent %</h3>
                                            <div class="tdsPercent font-b">0</div>
                                        </div>
                                        <div class="total-down-payment mb-4">
                                            <h3>Loan Payble</h3>
                                            <div class="loanPayble font-b">0</div>
                                        </div>
                                        <div class="total-amount total-down-payment">
                                            <h3>Total Interest Payble</h3>
                                            <div class="interestPayble text-danger font-b">0</div>
                                        </div>
                                    </div>

                                    <div class="right">
                                        <canvas height="400" id="myChart" width="400"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.select2').select2();
        });

        var loanData = @json($allcustomers);

        $("#selectCustomer").change(function() {
            let customerId = $(this).val();
            let loandata = loanData[customerId].pendingloans;
            var seloption = "";
            $("#selectLoans").empty();
            $.each(loandata, function(i) {
                seloption += '<option value="' + loandata[i].id + '">LF00' + loandata[i].id + '</option>';
            });
            $("#selectLoans").append(seloption);
        });


        $("#calculate_data").click(function() {
            let customer = $("#selectCustomer").val();
            let loan = $("#selectLoans").val();
            let payamount = $("#payamount").val();
            let transactionDate = $("#dateOfBirthE").val();

            if(validateFormByDiv('FormCalculate')){
                $.post('{{ route('interestCalculatorData') }}', {
                    "_token": "{{ csrf_token() }}",
                    loan: loan,
                    payamount: payamount,
                    transactionDate:transactionDate
                }, function(data) {
                    let totalData = JSON.parse(data);
                    let roi_value = 0;
                    let numOfDays = 0;
                    let tdsPercent = 0;
                    let interestPayble = 0;
                    let loanPayble = 0;
                    $.each(totalData.totalInterest, function(key, value){
                        roi_value = value.rateOfInterest;
                        tdsPercent = value.tdsPercent;
                        numOfDays+= parseInt(value.numOfDays);
                        loanPayble+= parseInt(value.playbleLoanAmount);
                        interestPayble+= parseInt(value.interestPayble);
                    });
                    $(".roi_value").text(roi_value);
                    $(".tdsPercent").text(tdsPercent);
                    $(".numOfDays").text(numOfDays);
                    $(".loanPayble").text(loanPayble);
                    $(".interestPayble").text(interestPayble);
                });
            }
        });


        function validateFormByDiv(divId) {
            let noisValid = true;

            $(`.select2-selection`).removeClass('invalid-select');
            $(`.custom_error`).remove();
            $(`input`).removeClass('is-invalid');
            $(`#${divId} .required_fields`).each(function() {
                if ($(this).is(':file') && !$(this)[0].files.length) {
                    noisValid = false;
                    $(this).closest('.dropify-wrapper').addClass('invalid-select');
                    $(this).closest('.dropify-wrapper').after(
                        '<span class="custom_error text-danger">This field is required.</span>');
                    $(this).focus();
                } else if (!$(this).val() || ($(this).is('select') && ($(this).val() == ""))) {
                    noisValid = false;
                    $(this).addClass('is-invalid');
                    if ($(this).is('select')) {
                        $(this).next('.select2-container').find('.select2-selection').addClass('invalid-select');
                        $(this).next('.select2-container').find('.select2-selection').after(
                            '<span class="custom_error text-danger">This field is required.</span>');
                    } else {
                        $(this).after('<span class="custom_error text-danger">This field is required.</span>');
                    }
                    $(this).focus();
                } else {
                    $(this).removeClass('is-invalid');
                }
            });

            $(`#${divId} input.number`).each(function() {
                let closestTabPaneId = $(this).closest('.tab-pane').attr('id');
                let inputValue = $(this).val().trim();

                if (inputValue !== '' && !$.isNumeric(inputValue)) {
                    noisValid = false;
                    $(this).addClass('is-invalid');
                    $(this).after('<span class="custom_error text-danger">Please enter a valid number.</span>');
                    $(`#${closestTabPaneId}Tab`).tab('show');
                    $(this).focus();
                } else {
                    $(this).removeClass('is-invalid');
                }
            });

            

            $(`#${divId} [min], #${divId} [max]`).each(function() {
                let minLength = parseInt($(this).attr('minlength'));
                let maxLength = parseInt($(this).attr('maxlength'));
                let minValue = parseInt($(this).attr('min'));
                let maxValue = parseInt($(this).attr('max'));
                let inputValue = $(this).val().trim(); // Trim whitespace from input value

                if (inputValue !== '') { // Check if input value is not blank

                    if (!isNaN(minValue) && parseInt(inputValue) < minValue) {
                        noisValid = false;
                        $(this).addClass('is-invalid');
                        let closestTabPaneId = $(this).closest('.tab-pane').attr('id');
                        $(this).after(
                            `<span class="custom_error text-danger">Minimum value is ${minValue}.</span>`);
                        $(`#${closestTabPaneId}Tab`).tab('show');
                        $(this).focus();
                    }

                    if (!isNaN(maxValue) && parseInt(inputValue) > maxValue) {
                        noisValid = false;
                        $(this).addClass('is-invalid');
                        let closestTabPaneId = $(this).closest('.tab-pane').attr('id');
                        $(this).after(
                            `<span class="custom_error text-danger">Maximum value is ${maxValue}.</span>`);
                        $(`#${closestTabPaneId}Tab`).tab('show');
                        $(this).focus();
                    }
                }
            });

            return noisValid;
        }
    </script>
@endsection
