@extends('layouts.app')

@section('title', 'Print Barcode')

@push('styles')
{{-- <link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Libre+Barcode+EAN13+Text&display=swap" rel="stylesheet"> 
<style>
    .barcode{
        font-family: 'Libre Barcode EAN13 Text', cursive;
    }
</style> --}}
@endpush

@section('content')
<div class="d-flex flex-column-fluid">
    <div class="container-fluid">
        <!--begin::Notice-->
        <div class="card card-custom gutter-b">
            <div class="card-header flex-wrap py-5">
                <div class="card-title text-center">
                    <h3 class="card-label"><i class=" text-primary"></i> Print Barcode</h3>
                </div>
            </div>
        </div>
        <!--end::Notice-->
        <!--begin::Card-->
        <div class="card card-custom" style="padding-bottom: 100px !important;">
            <div class="card-body" style="padding-bottom: 100px !important;">
                <!--begin: Datatable-->
                <div id="kt_datatable_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer pb-5">

                    <form id="generate-barcode-form" method="POST">
                        @csrf
                        <div class="row">
                            <div class="form-group col-md-3">
                                <label for=""><b>General Field</b></label>
                                <div class="div">
                                    <div class="custom-control">
                                        <input type="text" required="required" name="company_name" id="company_name" placeholder="Company Name" class="form-control text-left" />
                                    </div>
                                    <div class="custom-control">
                                        <input type="text" required="required" id="product_code" name="product_code" placeholder="Valid Product Barcode" class="form-control text-left">
                                    </div>
                                    <div class="custom-control">
                                        <input type="text" required="required" name="product_name" id="product_name" placeholder="Product Name" class="form-control text-left">
                                    </div>
                                    <div class="custom-control">
                                        <input type="text" required="required" name="price" id="price" placeholder="Price" class="form-control text-left">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-md-3">
                                <label for=""><b>Print/Print Row Quantity</b></label>
                                <div class="div">
                                    <div class="custom-control">
                                        <input type="text" required="required" name="barcode_qty" id="barcode_qty" placeholder="Quantity" class="form-control text-center" />
                                    </div>
                                    <div class="custom-control">
                                        <input type="text" required="required" name="row_qty" id="row_qty" placeholder="Row Qun" class="form-control text-center">
                                    </div>
                                    <div class="custom-control">
                                        <div class="row">
                                            <div class="col-md-8">
                                                <input type="text" required="required" name="currency_symbol" id="currency_symbol" placeholder="Currency Symbol" class="form-control text-center">
                                            </div>
                                            <div class="col-md-4">
                                                <div class="custom-control">
                                                    <label class="radio">
                                                        <input type="radio" name="currency_position" checked id="currency_position" value="1">
                                                        <span></span>Prefix</label>
                                                    <label class="radio">
                                                        <input type="radio" name="currency_position" id="currency_position" value="2">
                                                        <span></span>Suffix</label>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="custom-control">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <input type="text" required="required" name="Currency Code" id="currency_code" placeholder="Currency Code M.R.P." class="form-control text-center">
                                            </div>
                                            <div class="col-md-6">
                                                <input type="text" required="required" name="vat" id="vat" placeholder="Vat" class="form-control text-center">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-md-2">
                                <label for=""><b>Barcode Body</b></label>
                                <div class="div">
                                    <div class="custom-control">
                                        <input type="text" required="required" placeholder="30mm Height" class="form-control text-left" id="height">
                                    </div>
                                    <div class="custom-control">
                                        <input type="text" required="required" placeholder="40mm Width" class="form-control text-left" id="width">
                                    </div>
                                    <div class="custom-control">
                                        <input type="text" required="required" placeholder="12px Font Size" class="form-control text-left" id="font_size">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-md-3">
                                <label for=""><b>Barcode Body Margin</b></label>
                                <div class="div">
                                    <div class="custom-control">
                                        <input type="text" required="required" placeholder="Left Margin" class="form-control text-left" id="margin_left">
                                    </div>
                                    <div class="custom-control">
                                        <input type="text" required="required" placeholder="Right Margin" class="form-control text-left" id="margin_right">
                                    </div>
                                    <div class="custom-control">
                                        <input type="text" required="required" placeholder="Top Margin" class="form-control text-left" id="margin_top">
                                    </div>
                                    <div class="custom-control">
                                        <input type="text" required="required" placeholder="Bottom Margin" class="form-control text-left" id="margin_bottom">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-md-1">
                                <label for=""><b>Size With</b></label>
                                <div class="div">
                                    <label class="radio">
                                        <input type="radio" name="size_with" checked id="size_with" value="mm">
                                        <span></span>MM
                                    </label>
                                    <label class="radio">
                                        <input type="radio" name="size_with" id="size_with" value="cm">
                                        <span></span>CM
                                    </label>
                                    <label class="radio">
                                        <input type="radio" name="size_with" id="size_with" value="inch">
                                        <span></span>Inch
                                    </label>
                                    <!-- <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" value="mm" id="mm">
                                        <label class="custom-control-label" for="mm">MM</label>
                                    </div>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" value="cm" id="cm">
                                        <label class="custom-control-label" for="cm">CM</label>
                                    </div>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" value="inch" id="inch">
                                        <label class="custom-control-label" for="inch">Inch</label>
                                    </div> -->
                                </div>
                            </div>
                            <div class="form-group col-md-12" style="text-align:center;padding-top:28px;">
                                <button type="button" class="btn btn-primary btn-sm" id="generate-barcode"><i class="fas fa-barcode"></i>Generate Barcode</button>
                            </div>
                        </div>
                    </form>

                    <div class="row" id="barcode-section">

                    </div>
                </div>
                <!--end: Datatable-->
            </div>
        </div>
        <!--end::Card-->
    </div>
</div>
@endsection

@push('scripts')
<script src="js/jquery.printarea.js"></script>
<script>
    $(document).ready(function() {
        $(document).on('click', '#generate-barcode', function() {
            var company_name = $('#company_name').val();
            var product_code = $('#product_code').val();
            var product_name = $('#product_name').val();
            var product_price = $('#price').val();;
            var barcode_qty = "10";
            var row_qty = "1";
            var currency_symbol = "TK.";
            var height = "33mm";
            var width = "40mm";
            var font_size = "12px";
            var margin_left = "25px";
            var margin_right = "0";
            var margin_top = "0";
            var margin_bottom = "0";
            var vat = "";
            var currency_code = "M.R.P.";

            if ($('#height').val() == '' && $('#width').val() == '') {
                height = "30mm";
                width = "40mm";
            } else {
                var size_with = $("input:radio[name=size_with]:checked").val();
                if (size_with == 'mm') {
                    height = $('#height').val() + 'mm';
                    width = $('#width').val() + 'mm';
                } else if (size_with == 'cm') {
                    height = $('#height').val() + 'cm';
                    width = $('#width').val() + 'cm';
                } else if (size_with == 'inch') {
                    height = $('#height').val() + 'in';
                    width = $('#width').val() + 'in';
                }
            }

            var prefix = $("input:radio[name=currency_position]:checked").val();

            if ($('#margin_left').val() != '') {
                margin_left = $('#margin_left').val() + 'px';
            }
            if ($('#margin_right').val() != '') {
                margin_right = $('#margin_right').val() + 'px';
            }
            if ($('#margin_top').val() != '') {
                margin_top = $('#margin_top').val() + 'px';
            }
            if ($('#margin_bottom').val() != '') {
                margin_bottom = $('#margin_bottom').val() + 'px';
            }
            if ($('#font_size').val() != '') {
                font_size = $('#font_size').val() + 'px';
            }
            if ($('#barcode_qty').val() != '') {
                barcode_qty = $('#barcode_qty').val();
            }
            if ($('#row_qty').val() != '') {
                row_qty = $('#row_qty').val();
            }
            if ($('#currency_symbol').val() != '') {
                currency_symbol = $('#currency_symbol').val();
            }
            if ($('#vat').val() != '') {
                vat = $('#vat').val();
            }
            if ($('#currency_code').val() != '') {
                currency_code = $('#currency_code').val();
            }

            $.ajax({
                url: "{{ route('generate.barcode') }}",
                type: "POST",
                data: {
                    company_name: company_name,
                    product_code: product_code,
                    product_name: product_name,
                    product_price: product_price,
                    barcode_qty: barcode_qty,
                    row_qty: row_qty,
                    currency_symbol: currency_symbol,
                    height: height,
                    width: width,
                    margin_left: margin_left,
                    margin_right: margin_right,
                    margin_top: margin_top,
                    margin_bottom: margin_bottom,
                    font_size: font_size,
                    prefix: prefix,
                    vat: vat,
                    currency_code: currency_code,
                    _token: _token
                },
                beforeSend: function() {
                    $('#generate-barcode').addClass('spinner spinner-white spinner-right');
                },
                complete: function() {
                    $('#generate-barcode').removeClass('spinner spinner-white spinner-right');
                },
                success: function(data) {
                    $('#generate-barcode-form').find('.is-invalid').removeClass('is-invalid');
                    $('#generate-barcode-form').find('.error').remove();
                    if (data.status == false) {
                        $.each(data.errors, function(key, value) {
                            var key = key.split('.').join('_');
                            $('#generate-barcode-form input#' + key).addClass('is-invalid');
                            $('#generate-barcode-form textarea#' + key).addClass('is-invalid');
                            $('#generate-barcode-form select#' + key).parent().addClass('is-invalid');
                            $('#generate-barcode-form #' + key).parent().append(
                                '<small class="error text-danger">' + value + '</small>');
                        });
                    }
                    if (data) {
                        $('#barcode-section').html('');
                        $('#barcode-section').html(data);
                    }

                },
                error: function(xhr, ajaxOption, thrownError) {
                    console.log(thrownError + '\r\n' + xhr.statusText + '\r\n' + xhr.responseText);
                }
            });
        });

        $(document).on('click', '#print-barcode', function() {
            var mode = 'iframe'; // popup
            var close = mode == "popup";
            var options = {
                mode: mode,
                popClose: close
            };
            $("#printableArea").printArea(options);
        });
    });
</script>
@endpush