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
                        if ($vat == 0) {
                            $vat_text = "+VAT";
                        } else {
                            $vat_text = "+$vat% VAT";
                        }

                            ?>
                            <td>
                                <div style="text-align: center;width: <?php echo $width; ?>;height:<?php echo $height; ?>; font-size:<?php echo $font_size; ?>;margin-left:<?php echo $margin_left ?>;margin-right:<?php echo $margin_right ?>;margin-top:<?php echo $margin_top ?>;margin-bottom:<?php echo $margin_bottom ?>;">
                                    <div style="padding-top: 20px;font-weight:bold;">
                                        <b>{{ $company_name }}</b>
                                    </div>
                                    @if(!empty($product_name))<div style="padding-bottom:5px;">
                                        <p style="margin:0;">{{ $product_name }}</p>
                                    </div>@endif
                                    <div style="text-align: center;width:100%">
                                        <img src="{{ 'data:image/png;base64,' . DNS1D::getBarcodePNG($barcode, 'EAN13') }}" alt="barcode" style="width: 100%;" />
                                    </div>
                                    <div style="letter-spacing: 4.2px;">{{ $barcode }}</div>

                                    @if(!empty($product_price))<div class="price barcode-price"><b>@if(!empty($currency_code)){{ $currency_code }}@endif :</b> {{ $symbol_prefix.' '.$product_price.' '.$symbol_suppix.' '.$vat_text }}</div>@endif
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