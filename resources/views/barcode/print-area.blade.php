<div class="col-md-12 col-lg-12" style="width: 100%;">
    <div class="row">
        <div class="col-md-12">
            <button type="button" class="btn btn-primary btn-sm float-right mb-5" id="print-barcode"> <i class="fas fa-print"></i> Print</button>
        </div>
        <div class="col-md-12" id="printableArea" style="width: 100%;margin:0;padding:0;">
            <link href="{{asset('css/print.css')}}" rel="stylesheet" type="text/css" />
            @if (!empty($barcode))
            <table style="width: 100%;">
                <tbody>
                    <?php
                    $counter = 0;
                    for ($i = 0; $i < $barcode_qty; $i++) {
                    ?>
                        <?php if ($counter == $row_qty) { ?>
                            <tr>
                                <?php $counter = 0; ?>
                            <?php }

                        if ($prefix == 1) {
                            $symbol_prefix = $currency_symbol;
                            $symbol_suppix = "";
                        } else {
                            $symbol_suppix = $currency_symbol;
                            $symbol_prefix = "";
                        }
                        $vat_text = "";
                        if ($vatinc == 1) {
                            if ($vat == 0) {
                                $vat_text = "+VAT";
                            } else {
                                $vat_text = "+$vat% VAT";
                            }
                        } else {
                            $vat_text = "";
                        }

                            ?>
                            <td>
                                <div class="fullbodyheighwidth" style="width: <?php echo $width; ?>;height:<?php echo $height; ?>; font-size:<?php echo $font_size; ?>;margin-left:<?php echo $margin_left ?>;margin-right:<?php echo $margin_right ?>;margin-top:<?php echo $margin_top ?>;margin-bottom:<?php echo $margin_bottom ?>;">

                                    <?php if ($formate_with == 'normal') { ?>
                                        <div class="textpossition" style="text-align: <?php echo $text_position; ?>;padding-top: 20px;font-weight:bold;">
                                            <b>{{ $company_name }}</b>
                                        </div>
                                        @if(!empty($product_name))<div class="textpossition" style="text-align: <?php echo $text_position; ?>;padding-bottom:5px;">
                                            <p style="margin:0;">{{ $product_name }}</p>
                                        </div>@endif
                                        <div class="barcodposition" style="text-align: <?php echo $barcode_position; ?>;width:100%">
                                            <img src="{{ 'data:image/png;base64,' . DNS1D::getBarcodePNG($barcode, 'EAN13') }}" alt="barcode" style="width: 100%;" />
                                        </div>
                                        <div class="textpossition" style="text-align: <?php echo $barcode_position; ?>;letter-spacing: 4.2px;">{{ $barcode }}</div>

                                        @if(!empty($product_price))<div class="price barcode-price" style="text-align: <?php echo $text_position; ?>"><b>@if(!empty($currency_code)){{ $currency_code }}@endif :</b> {{ $symbol_prefix.' '.$product_price.' '.$symbol_suppix.' '.$vat_text }}</div>@endif
                                    <?php } else if ($formate_with == 'left_barcode') { ?>

                                        <div class="totalheighwidth" style="height:<?php echo $totalheight; ?>;width:<?php echo $totalwidth; ?>;margin-top:<?php echo $totaltop; ?>;margin-left:<?php echo $totalleft; ?>;margin-right:<?php echo $totalright; ?>;margin-bottom:<?php echo $totalbottom; ?>;">
                                            <div class="barcodeheightwidth barcodposition" style="text-align: <?php echo $barcode_position; ?>;height:<?php echo $bheight; ?>;width:<?php echo $bwidth; ?>;float:left;margin-top:<?php echo $btop; ?>;margin-left:<?php echo $bleft; ?>;margin-right:<?php echo $bright; ?>;margin-bottom:<?php echo $bbottom; ?>;font-size:<?php echo $bfont; ?>">
                                                <img src="{{ 'data:image/png;base64,' . DNS1D::getBarcodePNG($barcode, 'EAN13') }}" alt="barcode" style="width: 100%" />
                                                <div class="barcodposition" style="text-align: <?php echo $barcode_position; ?>;letter-spacing: 1.8px;font-size:<?php echo $bfontletter; ?>;margin-top:2%;">{{ $barcode }}</div>
                                            </div>

                                            <div class="textheightwidth" style="height:<?php echo $theight; ?>;width:<?php echo $twidth; ?>;float:left;margin-top:<?php echo $ttop; ?>;margin-left:<?php echo $tleft; ?>;margin-right:<?php echo $tright; ?>;margin-bottom:<?php echo $tbottom; ?>;font-size:<?php echo $tfont; ?>">
                                                <div class="textpossition" style="text-align: <?php echo $text_position; ?>;padding-top: 0;font-weight:bold">
                                                    <b>{{ $company_name }}</b>
                                                </div>
                                                @if(!empty($product_name))<div class="textpossition" style="text-align: <?php echo $text_position; ?>;padding-bottom:0;">
                                                    <p style="margin:0;">{{ $product_name }}</p>
                                                </div>@endif

                                                @if(!empty($product_price))<div class="textpossition price barcode-price" style="text-align: <?php echo $text_position; ?>;"><b>@if(!empty($currency_code)){{ $currency_code }}@endif :</b> {{ $symbol_prefix.' '.$product_price.' '.$symbol_suppix.' '.$vat_text }}</div>@endif
                                            </div>
                                        </div>

                                    <?php } else {
                                    ?>
                                        <div class="totalheighwidth" style="height:<?php echo $totalheight; ?>;width:<?php echo $totalwidth; ?>;margin-top:<?php echo $totaltop; ?>;margin-left:<?php echo $totalleft; ?>;margin-right:<?php echo $totalright; ?>;margin-bottom:<?php echo $totalbottom; ?>;">

                                            <div class="textheightwidth" style="height:<?php echo $theight; ?>;width:<?php echo $twidth; ?>;float:left;margin-top:<?php echo $ttop; ?>;margin-left:<?php echo $tleft; ?>;margin-right:<?php echo $tright; ?>;margin-bottom:<?php echo $tbottom; ?>;font-size:<?php echo $tfont; ?>">
                                                <div class="textpossition" style="text-align: <?php echo $text_position; ?>;padding-top: 0;font-weight:bold">
                                                    <b>{{ $company_name }}</b>
                                                </div>
                                                @if(!empty($product_name))<div class="textpossition" style="text-align: <?php echo $text_position; ?>;padding-bottom:0;">
                                                    <p style="margin:0;">{{ $product_name }}</p>
                                                </div>@endif

                                                @if(!empty($product_price))<div class="textpossition price barcode-price" style="text-align: <?php echo $text_position; ?>;"><b>@if(!empty($currency_code)){{ $currency_code }}@endif :</b> {{ $symbol_prefix.' '.$product_price.' '.$symbol_suppix.' '.$vat_text }}</div>@endif
                                            </div>
                                            <div class="barcodeheightwidth barcodposition" style="text-align: <?php echo $barcode_position; ?>;height:<?php echo $bheight; ?>;width:<?php echo $bwidth; ?>;float:left;margin-top:<?php echo $btop; ?>;margin-left:<?php echo $bleft; ?>;margin-right:<?php echo $bright; ?>;margin-bottom:<?php echo $bbottom; ?>;font-size:<?php echo $bfont; ?>">
                                                <img src="{{ 'data:image/png;base64,' . DNS1D::getBarcodePNG($barcode, 'EAN13') }}" alt="barcode" style="width: 100%" />
                                                <div class="barcodposition" style="text-align: <?php echo $barcode_position; ?>;letter-spacing: 1.8px;font-size:<?php echo $bfontletter; ?>;margin-top:2%;">{{ $barcode }}</div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                            </td>
                            <?php if ($counter == 5) { ?>
                            </tr>
                            <?php $counter = 0; ?>
                        <?php } ?>
                        <?php $counter++; ?>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
            @endif
        </div>
    </div>
</div>