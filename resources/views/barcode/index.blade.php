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
                            <div class="form-group col-md-2">
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
                            <div class="form-group col-md-2">
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
                                            <div class="col-md-4">
                                                <input type="text" required="required" name="vat" id="vat" placeholder="Vat" class="form-control text-center">
                                            </div>
                                            <div class="col-md-2">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" value="vatinc" id="vatinc">
                                                    <label class="custom-control-label" for="vatinc">Vat Include</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-md-1">
                                <label for=""><b>Barcode Body</b></label>
                                <div class="div">
                                    <div class="custom-control">
                                        <input type="text" required="required" onkeyup="change_margin('height',this)" placeholder="30mm Height" class="form-control text-left" id="height">
                                    </div>
                                    <div class="custom-control">
                                        <input type="text" required="required" onkeyup="change_margin('width',this)" placeholder="40mm Width" class="form-control text-left" id="width">
                                    </div>
                                    <div class="custom-control">
                                        <input type="text" required="required" onkeyup="change_margin('font_size',this)" placeholder="12px Font Size" class="form-control text-left" id="font_size">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-md-2">
                                <label for=""><b>Barcode Body Margin</b></label>
                                <div class="div">
                                    <div class="custom-control">
                                        <input type="text" required="required" onkeyup="change_margin('margin_left',this)" placeholder="Left Margin" class="form-control text-left" id="margin_left">
                                    </div>
                                    <div class="custom-control">
                                        <input type="text" required="required" onkeyup="change_margin('margin_right',this)" placeholder="Right Margin" class="form-control text-left" id="margin_right">
                                    </div>
                                    <div class="custom-control">
                                        <input type="text" required="required" onkeyup="change_margin('margin_top',this)" placeholder="Top Margin" class="form-control text-left" id="margin_top">
                                    </div>
                                    <div class="custom-control">
                                        <input type="text" required="required" onkeyup="change_margin('margin_bottom',this)" placeholder="Bottom Margin" class="form-control text-left" id="margin_bottom">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-md-1">
                                <label for=""><b>Size With</b></label>
                                <div class="div">
                                    <label class="radio">
                                        <input type="radio" class="radioSizewith" name="size_with" checked id="size_with" value="mm">
                                        <span></span>MM
                                    </label>
                                    <label class="radio">
                                        <input type="radio" class="radioSizewith" name="size_with" id="size_with" value="cm">
                                        <span></span>CM
                                    </label>
                                    <label class="radio">
                                        <input type="radio" class="radioSizewith" name="size_with" id="size_with" value="in">
                                        <span></span>Inch
                                    </label>

                                    <label for=""><b>Formate With</b></label>
                                    <div class="div">
                                        <label class="radio">
                                            <input type="radio" name="formate_with" class="formate_with" checked id="formate_with" value="normal">
                                            <span></span>Normal
                                        </label>
                                        <label class="radio">
                                            <input type="radio" name="formate_with" class="formate_with" id="formate_with" value="left_barcode">
                                            <span></span>Left
                                        </label>
                                        <label class="radio">
                                            <input type="radio" name="formate_with" class="formate_with" id="formate_with" value="right_barcode">
                                            <span></span>Right
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-md-1">
                                <label for=""><b>Barcode Position</b></label>
                                <div class="div">
                                    <label class="radio">
                                        <input type="radio" class="barcodePosition" name="barcode_position" id="barcode_position" checked value="center">
                                        <span></span>Center
                                    </label>
                                    <label class="radio">
                                        <input type="radio" class="barcodePosition" name="barcode_position" id="barcode_position" value="left">
                                        <span></span>Left
                                    </label>
                                    <label class="radio">
                                        <input type="radio" class="barcodePosition" name="barcode_position" id="barcode_position" value="right">
                                        <span></span>Right
                                    </label>
                                    <label class="radio">
                                        <input type="radio" class="barcodePosition" name="barcode_position" id="barcode_position" value="justify">
                                        <span></span>Justify
                                    </label>
                                </div>
                                <label for=""><b>Text Position</b></label>
                                <div class="div">
                                    <label class="radio">
                                        <input type="radio" class="textPosition" name="text_position" id="text_position" checked value="center">
                                        <span></span>Center
                                    </label>
                                    <label class="radio">
                                        <input type="radio" class="textPosition" name="text_position" id="text_position" value="left">
                                        <span></span>Left
                                    </label>
                                    <label class="radio">
                                        <input type="radio" class="textPosition" name="text_position" id="text_position" value="right">
                                        <span></span>Right
                                    </label>
                                    <label class="radio">
                                        <input type="radio" class="textPosition" name="text_position" id="text_position" value="justify">
                                        <span></span>Justify
                                    </label>
                                </div>
                            </div>

                            <div class="form-group col-md-3 barcodemargin" style="display: none;">
                                <label for=""><b>Overall Margin</b></label>
                                <div class="div">
                                    <div class="custom-control">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <input type="text" onkeyup="change_margin('totalheight',this)" required="required" placeholder="Height" class="form-control text-left" id="totalheight">
                                            </div>
                                            <div class="col-md-3">
                                                <input type="text" onkeyup="change_margin('totalwidth',this)" required="required" placeholder="Width" class="form-control text-left" id="totalwidth">
                                            </div>
                                            <div class="col-md-3">
                                                <input type="text" onkeyup="change_margin('totaltop',this)" required="required" placeholder="Top" class="form-control text-left" id="totaltop">
                                            </div>
                                            <div class="col-md-3">
                                                <input type="text" onkeyup="change_margin('totalleft',this)" required="required" placeholder="Left" class="form-control text-left" id="totalleft">
                                            </div>
                                            <div class="col-md-3">
                                                <input type="text" onkeyup="change_margin('totalright',this)" required="required" placeholder="Right" class="form-control text-left" id="totalright">
                                            </div>
                                            <div class="col-md-3">
                                                <input type="text" onkeyup="change_margin('totalbottom',this)" required="required" placeholder="Bottom" class="form-control text-left" id="totalbottom">
                                            </div>
                                            <label class="radio">
                                                <input type="radio" name="totalpx_percent" class="totalpxPercent" id="totalpx_percent" checked value="%">
                                                <span></span>%
                                            </label>
                                            <label class="radio">
                                                <input type="radio" name="totalpx_percent" class="totalpxPercent" id="totalpx_percent" value="px">
                                                <span></span>PX
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <label for=""><b>Barcode Margin</b></label>
                                <div class="div">
                                    <div class="custom-control">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <input type="text" onkeyup="change_margin('bheight',this)" required="required" placeholder="Height" class="form-control text-left" id="bheight">
                                            </div>
                                            <div class="col-md-3">
                                                <input type="text" onkeyup="change_margin('bwidth',this)" required="required" placeholder="Width" class="form-control text-left" id="bwidth">
                                            </div>
                                            <div class="col-md-3">
                                                <input type="text" onkeyup="change_margin('bfont',this)" required="required" placeholder="Font" class="form-control text-left" id="bfont">
                                            </div>
                                            <div class="col-md-3">
                                                <input type="text" onkeyup="change_margin('btop',this)" required="required" placeholder="Top" class="form-control text-left" id="btop">
                                            </div>
                                            <div class="col-md-3">
                                                <input type="text" onkeyup="change_margin('bleft',this)" required="required" placeholder="Left" class="form-control text-left" id="bleft">
                                            </div>
                                            <div class="col-md-3">
                                                <input type="text" onkeyup="change_margin('bright',this)" required="required" placeholder="Right" class="form-control text-left" id="bright">
                                            </div>
                                            <div class="col-md-3">
                                                <input type="text" onkeyup="change_margin('bbottom',this)" required="required" placeholder="Bottom" class="form-control text-left" id="bbottom">
                                            </div>
                                            <label class="radio">
                                                <input type="radio" name="bpx_percent" class="bpxPercent" id="bpx_percent" checked value="%">
                                                <span></span>%
                                            </label>
                                            <label class="radio">
                                                <input type="radio" name="bpx_percent" class="bpxPercent" id="bpx_percent" value="px">
                                                <span></span>PX
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <label for=""><b>Text Margin</b></label>
                                <div class="div">
                                    <div class="custom-control">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <input type="text" onkeyup="change_margin('theight',this)" required="required" placeholder="Height" class="form-control text-left" id="theight">
                                            </div>
                                            <div class="col-md-3">
                                                <input type="text" onkeyup="change_margin('twidth',this)" required="required" placeholder="Width" class="form-control text-left" id="twidth">
                                            </div>
                                            <div class="col-md-3">
                                                <input type="text" onkeyup="change_margin('tfont',this)" required="required" placeholder="Font" class="form-control text-left" id="tfont">
                                            </div>
                                            <div class="col-md-3">
                                                <input type="text" onkeyup="change_margin('ttop',this)" required="required" placeholder="Top" class="form-control text-left" id="ttop">
                                            </div>
                                            <div class="col-md-3">
                                                <input type="text" onkeyup="change_margin('tleft',this)" required="required" placeholder="Left" class="form-control text-left" id="tleft">
                                            </div>
                                            <div class="col-md-3">
                                                <input type="text" onkeyup="change_margin('tright',this)" required="required" placeholder="Right" class="form-control text-left" id="tright">
                                            </div>
                                            <div class="col-md-3">
                                                <input type="text" onkeyup="change_margin('tbottom',this)" required="required" placeholder="Bottom" class="form-control text-left" id="tbottom">
                                            </div>
                                            <label class="radio">
                                                <input type="radio" name="tpx_percent" class="tpxPercent" id="tpx_percent" checked value="%">
                                                <span></span>%
                                            </label>
                                            <label class="radio">
                                                <input type="radio" name="tpx_percent" class="tpxPercent" id="tpx_percent" value="px">
                                                <span></span>PX
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
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

        $(".formate_with").click(function() {
            var formate_with = $("input:radio[name=formate_with]:checked").val();
            if (formate_with == 'normal') {
                $(".barcodemargin").hide();
            } else {
                $(".barcodemargin").show();

            }
        });

        $(document).on('click', '#generate-barcode', function(e) {
            e.stopPropagation();
            e.preventDefault();
            var company_name = $('#company_name').val();
            var product_code = $('#product_code').val();
            var product_name = $('#product_name').val();
            var product_price = $('#price').val();
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
            var vatinc = "0";
            var formate_with = $("input:radio[name=formate_with]:checked").val();
            var barcode_position = $("input:radio[name=barcode_position]:checked").val();
            var text_position = $("input:radio[name=text_position]:checked").val();

            //var total_hw = array();

            //barcode margin width height
            var totalpx_percent = $("input:radio[name=totalpx_percent]:checked").val();
            //alert(totalpx_percent);

            // if ($("input:radio[name=totalpx_percent]:checked").val() == 'px') {
            //     totalpx_percent = 'px';
            // }

            var totalheight = "100%";
            var totalwidth = "100%";
            var totaltop = "0";
            var totalleft = "0";
            var totalright = "0";
            var totalbottom = "0";

            //total_hw = [totalheight,totalwidth,totaltop,totalleft,totalright,totalbottom];

            if ($('#totalheight').val() != '') {
                totalheight = $('#totalheight').val() + totalpx_percent;
            }
            if ($('#totalwidth').val() != '') {
                totalwidth = $('#totalwidth').val() + totalpx_percent;
            }
            if ($('#totaltop').val() != '') {
                totaltop = $('#totaltop').val() + totalpx_percent;
            }
            if ($('#totalleft').val() != '') {
                totalleft = $('#totalleft').val() + totalpx_percent;
            }
            if ($('#totalright').val() != '') {
                totalright = $('#totalright').val() + totalpx_percent;
            }
            if ($('#totalbottom').val() != '') {
                totalbottom = $('#totalbottom').val() + totalpx_percent;
            }
            //barcode margin width height

            var bpx_percent = $("input:radio[name=bpx_percent]:checked").val();
            // if ($("input:radio[name=bpx_percent]:checked").val() == 'px') {
            //     bpx_percent = 'px';
            // }
            var bheight = "0";
            var bwidth = "45%";
            var bfont = "12px";
            var bfontletter = "8px";
            var btop = "6%";
            var bleft = "0";
            var bright = "6";
            var bbottom = "0";

            if ($('#bheight').val() != '') {
                bheight = $('#bheight').val() + bpx_percent;
            }
            if ($('#bwidth').val() != '') {
                bwidth = $('#bwidth').val() + bpx_percent;
            }
            if ($('#bfont').val() != '') {
                bfont = $('#bfont').val() + 'px';
                bfontletter = (bfont - 4) + 'px';
            }
            if ($('#btop').val() != '') {
                btop = $('#btop').val() + bpx_percent;
            }
            if ($('#bleft').val() != '') {
                bleft = $('#bleft').val() + bpx_percent;
            }
            if ($('#bright').val() != '') {
                bright = $('#bright').val() + bpx_percent;
            }
            if ($('#bbottom').val() != '') {
                bbottom = $('#bbottom').val() + bpx_percent;
            }

            //text margin width height
            var tpx_percent = $("input:radio[name=tpx_percent]:checked").val();

            // if ($("input:radio[name=tpx_percent]:checked").val() == 'px') {
            //     bpx_percent = 'px';
            // }

            var theight = "0";
            var twidth = "40%";
            var tfont = "10px";
            var ttop = "5%";
            var tleft = "6%";
            var tright = "0";
            var tbottom = "0";

            if ($('#theight').val() != '') {
                theight = $('#theight').val() + tpx_percent;
            }
            if ($('#twidth').val() != '') {
                twidth = $('#twidth').val() + tpx_percent;
            }
            if ($('#tfont').val() != '') {
                tfont = $('#tfont').val() + 'px';
            }
            if ($('#ttop').val() != '') {
                ttop = $('#ttop').val() + tpx_percent;
            }
            if ($('#tleft').val() != '') {
                tleft = $('#tleft').val() + tpx_percent;
            }
            if ($('#tright').val() != '') {
                tright = $('#tright').val() + tpx_percent;
            }
            if ($('#tbottom').val() != '') {
                tbottom = $('#tbottom').val() + tpx_percent;
            }

            var size_with = $("input:radio[name=size_with]:checked").val();

            if (formate_with == 'normal') {
                if ($('#height').val() == '') {
                    height = "33mm";
                }
                if ($('#width').val() == '') {
                    width = "40mm";
                }
                if ($('#height').val() != '') {
                    height = $('#height').val() + size_with;
                }
                if ($('#width').val() != '') {
                    width = $('#width').val() + size_with;
                }
            } else {
                if ($('#height').val() == '') {
                    height = "12mm";
                }
                if ($('#width').val() == '') {
                    width = "50mm";
                }
                if ($('#height').val() != '') {
                    height = $('#height').val() + size_with;
                }
                if ($('#width').val() != '') {
                    width = $('#width').val() + size_with;
                }
                margin_top = "12px";
                font_size = "10px";
                margin_left = "0";
            }

            if ($('#vatinc').prop("checked") == true) {
                vatinc = "1";
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

            //alert(totalheight+' '+totalwidth+' '+totaltop+' '+totalleft+' '+totalright+' '+totalbottom+' '+bheight+' '+bwidth+' '+bfont+' '+bfontletter+' '+btop+' '+bleft+' '+bright+' '+bbottom+' '+theight+' '+twidth+' '+tfont+' '+ttop+' '+tleft+' '+tright+' '+tbottom);

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
                    vatinc: vatinc,
                    formate_with: formate_with,
                    barcode_position: barcode_position,
                    text_position: text_position,
                    currency_code: currency_code,
                    totalheight: totalheight,
                    totalwidth: totalwidth,
                    totaltop: totaltop,
                    totalleft: totalleft,
                    totalright: totalright,
                    totalbottom: totalbottom,
                    bheight: bheight,
                    bwidth: bwidth,
                    bfont: bfont,
                    bfontletter: bfontletter,
                    btop: btop,
                    bleft: bleft,
                    bright: bright,
                    bbottom: bbottom,
                    theight: theight,
                    twidth: twidth,
                    tfont: tfont,
                    ttop: ttop,
                    tleft: tleft,
                    tright: tright,
                    tbottom: tbottom,
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

    $(".radioSizewith").click(function() {
        var size_with = $("input:radio[name=size_with]:checked").val();
        var formate_with = $("input:radio[name=formate_with]:checked").val();

        var height = 0;
        var width = 0;

        if (formate_with == 'normal') {
            if ($('#height').val() == '') {
                height = "33" + size_with;
            } else if ($('#height').val() != '') {
                height = $('#height').val() + size_with;
            }

            if ($('#width').val() == '') {
                width = "40" + size_with;
            } else if ($('#width').val() != '') {
                width = $('#width').val() + size_with;
            }
        } else {
            if ($('#height').val() == '') {
                height = "12" + size_with;
            } else if ($('#height').val() != '') {
                height = $('#height').val() + size_with;
            }

            if ($('#width').val() == '') {
                width = "50" + size_with;
            } else if ($('#width').val() != '') {
                width = $('#width').val() + size_with;
            }
            margin_top = "12px";
            font_size = "10px";
            margin_left = "0";
        }

        $('.fullbodyheighwidth').css('height', height);
        $('.fullbodyheighwidth').css('width', width);
    });

    $(".barcodePosition").click(function() {
        var barcode_position = $("input:radio[name=barcode_position]:checked").val();
        $('.barcodposition').css('text-align', barcode_position);
    });

    $(".textPosition").click(function() {
        var text_position = $("input:radio[name=text_position]:checked").val();
        $('.textpossition').css('text-align', text_position);
    });

    $(".totalpxPercent").click(function() {
        var totalpx_percent = $("input:radio[name=totalpx_percent]:checked").val();

        var totalheight = "100%";
        var totalwidth = "100%";
        var totaltop = "0";
        var totalleft = "0";
        var totalright = "0";
        var totalbottom = "0";

        if ($('#totalheight').val() != '') {
            totalheight = $('#totalheight').val() + totalpx_percent;
        }
        if ($('#totalwidth').val() != '') {
            totalwidth = $('#totalwidth').val() + totalpx_percent;
        }
        if ($('#totaltop').val() != '') {
            totaltop = $('#totaltop').val() + totalpx_percent;
        }
        if ($('#totalleft').val() != '') {
            totalleft = $('#totalleft').val() + totalpx_percent;
        }
        if ($('#totalright').val() != '') {
            totalright = $('#totalright').val() + totalpx_percent;
        }
        if ($('#totalbottom').val() != '') {
            totalbottom = $('#totalbottom').val() + totalpx_percent;
        }

        $('.totalheighwidth').css('height', totalheight);
        $('.totalheighwidth').css('width', totalwidth);
        $('.totalheighwidth').css('margin-top', totaltop);
        $('.totalheighwidth').css('margin-left', totalleft);
        $('.totalheighwidth').css('margin-right', totalright);
        $('.totalheighwidth').css('margin-bottom', totalbottom);

    });
    $(".bpxPercent").click(function() {
        var bpx_percent = $("input:radio[name=bpx_percent]:checked").val();

        var bheight = "0";
        var bwidth = "45%";
        var bfont = "12px";
        var bfontletter = "8px";
        var btop = "6%";
        var bleft = "0";
        var bright = "6";
        var bbottom = "0";

        if ($('#bheight').val() != '') {
            bheight = $('#bheight').val() + bpx_percent;
        }
        if ($('#bwidth').val() != '') {
            bwidth = $('#bwidth').val() + bpx_percent;
        }
        if ($('#bfont').val() != '') {
            bfont = $('#bfont').val() + 'px';
            bfontletter = (bfont - 4) + 'px';
        }
        if ($('#btop').val() != '') {
            btop = $('#btop').val() + bpx_percent;
        }
        if ($('#bleft').val() != '') {
            bleft = $('#bleft').val() + bpx_percent;
        }
        if ($('#bright').val() != '') {
            bright = $('#bright').val() + bpx_percent;
        }
        if ($('#bbottom').val() != '') {
            bbottom = $('#bbottom').val() + bpx_percent;
        }

        $('.barcodeheightwidth').css('height', bheight);
        $('.barcodeheightwidth').css('width', bwidth);
        $('.barcodeheightwidth').css('font-size', bfont);
        $('.barcodposition').css('font-size', bfontletter);
        $('.barcodeheightwidth').css('margin-top', btop);
        $('.barcodeheightwidth').css('margin-left', bleft);
        $('.barcodeheightwidth').css('margin-right', bright);
        $('.barcodeheightwidth').css('margin-bottom', bbottom);

    });
    $(".tpxPercent").click(function() {
        var tpx_percent = $("input:radio[name=tpx_percent]:checked").val();

        var theight = "0";
        var twidth = "40%";
        var tfont = "10px";
        var ttop = "5%";
        var tleft = "6%";
        var tright = "0";
        var tbottom = "0";

        if ($('#theight').val() != '') {
            theight = $('#theight').val() + tpx_percent;
        }
        if ($('#twidth').val() != '') {
            twidth = $('#twidth').val() + tpx_percent;
        }
        if ($('#tfont').val() != '') {
            tfont = $('#tfont').val() + 'px';
        }
        if ($('#ttop').val() != '') {
            ttop = $('#ttop').val() + tpx_percent;
        }
        if ($('#tleft').val() != '') {
            tleft = $('#tleft').val() + tpx_percent;
        }
        if ($('#tright').val() != '') {
            tright = $('#tright').val() + tpx_percent;
        }
        if ($('#tbottom').val() != '') {
            tbottom = $('#tbottom').val() + tpx_percent;
        }
        $('.textheightwidth').css('height', theight);
        $('.textheightwidth').css('width', twidth);
        $('.textheightwidth').css('font-size', tfont);
        $('.textheightwidth').css('margin-top', ttop);
        $('.textheightwidth').css('margin-left', tleft);
        $('.textheightwidth').css('margin-right', tright);
        $('.textheightwidth').css('margin-bottom', tbottom);
    });

    function change_margin(col, vals) {
        var formate_with = $("input:radio[name=formate_with]:checked").val();
        var barcode_position = $("input:radio[name=barcode_position]:checked").val();
        var text_position = $("input:radio[name=text_position]:checked").val();
        var size_with = $("input:radio[name=size_with]:checked").val();
        var value = $(vals).val();
        var bfontletter = 8;

        if (col == 'height') {
            if (value == '') {
                if (formate_with == 'normal') {
                    value = 33;
                } else {
                    value = 12;
                }
            }
            $('.fullbodyheighwidth').css('height', value + size_with);
        }
        if (col == 'width') {
            if (value == '') {
                if (formate_with == 'normal') {
                    value = 40;
                } else {
                    value = 50;
                }
            }
            $('.fullbodyheighwidth').css('width', value + size_with);
        }
        if (col == 'font_size') {
            if (value == '') {
                if (formate_with == 'normal') {
                    value = 12;
                } else {
                    value = 10;
                }
            }
            $('.fullbodyheighwidth').css('font-size', value + 'px');
        }
        if (col == 'margin_left') {
            if (value == '') {
                if (formate_with == 'normal') {
                    value = 25;
                } else {
                    value = 0;
                }
            }
            $('.fullbodyheighwidth').css('margin-left', value + 'px');
        }
        if (col == 'margin_right') {
            if (value == '') {
                value = 0;
            }
            $('.fullbodyheighwidth').css('margin-right', value + 'px');
        }
        if (col == 'margin_top') {
            if (value == '') {
                value = 0;
            }
            $('.fullbodyheighwidth').css('margin-top', value + 'px');
        }
        if (col == 'margin_bottom') {
            if (value == '') {
                value = 0;
            }
            $('.fullbodyheighwidth').css('margin-bottom', value + 'px');
        }

        var totalpx_percent = $("input:radio[name=totalpx_percent]:checked").val();
        // if ($("input:radio[name=totalpx_percent]:checked").val() == 'px') {
        //     totalpx_percent = 'px';
        // }

        if (col == 'totalheight') {
            if (value == '') {
                value = 100;
            }
            $('.totalheighwidth').css('height', value + totalpx_percent);
        }

        if (col == 'totalwidth') {
            if (value == '') {
                value = 100;
            }
            $('.totalheighwidth').css('width', value + totalpx_percent);
        }

        if (col == 'totaltop') {
            if (value == '') {
                value = 0;
            }
            $('.totalheighwidth').css('margin-top', value + totalpx_percent);
        }

        if (col == 'totalleft') {
            if (value == '') {
                value = 0;
            }
            $('.totalheighwidth').css('margin-left', value + totalpx_percent);
        }

        if (col == 'totalright') {
            if (value == '') {
                value = 0;
            }
            $('.totalheighwidth').css('margin-right', value + totalpx_percent);
        }

        if (col == 'totalbottom') {
            if (value == '') {
                value = 0;
            }
            $('.totalheighwidth').css('margin-bottom', value + totalpx_percent);
        }

        var bpx_percent = $("input:radio[name=bpx_percent]:checked").val();
        // if ($("input:radio[name=bpx_percent]:checked").val() == 'px') {
        //     bpx_percent = 'px';
        // }

        if (col == 'bheight') {
            if (value == '') {
                value = 0;
            }
            $('.barcodeheightwidth').css('height', value + bpx_percent);
        }

        if (col == 'bwidth') {
            if (value == '') {
                value = 45;
            }
            $('.barcodeheightwidth').css('width', value + bpx_percent);
        }

        if (col == 'bfont') {
            if (value == '') {
                value = 12;
            }
            bfontletter = (value - 4);
            $('.barcodeheightwidth').css('font-size', value + "px");
            $('.barcodposition').css('font-size', bfontletter + "px");
        }

        if (col == 'btop') {
            if (value == '') {
                value = 6;
            }
            $('.barcodeheightwidth').css('margin-top', value + bpx_percent);
        }

        if (col == 'bleft') {
            if (value == '') {
                value = 0;
            }
            $('.barcodeheightwidth').css('margin-left', value + bpx_percent);
        }

        if (col == 'bright') {
            if (value == '') {
                value = 6;
            }
            $('.barcodeheightwidth').css('margin-right', value + bpx_percent);
        }

        if (col == 'bbottom') {
            if (value == '') {
                value = 0;
            }
            $('.barcodeheightwidth').css('margin-bottom', value + bpx_percent);
        }

        var tpx_percent = $("input:radio[name=tpx_percent]:checked").val();
        // if ($("input:radio[name=tpx_percent]:checked").val() == 'px') {
        //     tpx_percent = 'px';
        // }

        if (col == 'theight') {
            if (value == '') {
                value = 0;
            }
            $('.textheightwidth').css('height', value + tpx_percent);
        }

        if (col == 'twidth') {
            if (value == '') {
                value = 40;
            }
            $('.textheightwidth').css('width', value + tpx_percent);
        }

        if (col == 'tfont') {
            if (value == '') {
                value = 10;
            }
            $('.textheightwidth').css('font-size', value + "px");
        }

        if (col == 'ttop') {
            if (value == '') {
                value = 5;
            }
            $('.textheightwidth').css('margin-top', value + tpx_percent);
        }

        if (col == 'tleft') {
            if (value == '') {
                value = 6;
            }
            $('.textheightwidth').css('margin-left', value + tpx_percent);
        }

        if (col == 'tright') {
            if (value == '') {
                value = 0;
            }
            $('.textheightwidth').css('margin-right', value + tpx_percent);
        }

        if (col == 'tbottom') {
            if (value == '') {
                value = 0;
            }
            $('.textheightwidth').css('margin-bottom', value + tpx_percent);
        }
    }
</script>
@endpush