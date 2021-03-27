<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BarcodeController extends Controller
{

    public function index()
    {
        $data = ['sub_title' => 'Barecode', 'breadcrumb' => [['name' => 'Print Barcode']]];
        return view('barcode.index', $data);
    }

    public function generateBarcode(Request $request)
    {
        //dd($request->all());
        if ($request->ajax()) {

            if ($request->company_name == '') {
                $company_name = "Barcode Print";
            } else {
                $company_name = $request->company_name;
            }

            $data = [
                'company_name'  => $company_name,
                'barcode'       => $request->product_code,
                'product_name'  => $request->product_name,
                'product_price' => $request->product_price,
                'barcode_qty'   => $request->barcode_qty,
                'row_qty'       => $request->row_qty,
                'currency_symbol'       => $request->currency_symbol,
                'height'   => $request->height,
                'width'   => $request->width,
                'font_size'   => $request->font_size,
                'margin_left'   => $request->margin_left,
                'margin_right'   => $request->margin_right,
                'margin_top'   => $request->margin_top,
                'margin_bottom'   => $request->margin_bottom,
                'prefix'   => $request->prefix,
                'vat'   => $request->vat,
                'vatinc'   => $request->vatinc,
                'formate_with'   => $request->formate_with,
                'barcode_position'   => $request->barcode_position,
                'text_position'   => $request->text_position,
                'currency_code'   => $request->currency_code,
                'totalheight'   => $request->totalheight,
                'totalwidth'   => $request->totalwidth,
                'totaltop'   => $request->totaltop,
                'totalleft'   => $request->totalleft,
                'totalright'   => $request->totalright,
                'totalbottom'   => $request->totalbottom,
                'bheight'   => $request->bheight,
                'bwidth'   => $request->bwidth,
                'bfont'   => $request->bfont,
                'bfontletter'   => $request->bfontletter,
                'btop'   => $request->btop,
                'bleft'   => $request->bleft,
                'bright'   => $request->bright,
                'bbottom'   => $request->bbottom,
                'theight'   => $request->theight,
                'twidth'   => $request->twidth,
                'tfont'   => $request->tfont,
                'ttop'   => $request->ttop,
                'tleft'   => $request->tleft,
                'tright'   => $request->tright,
                'tbottom'   => $request->tbottom,
            ];
             //dd($data);
            return view('barcode.print-area', $data)->render();
        }
    }

    public function generateEAN($number)
    {
        $code = '894' . str_pad($number, 9, '0');
        $weightflag = true;
        $sum = 0;
        // Weight for a digit in the checksum is 3, 1, 3.. starting from the last digit. 
        // loop backwards to make the loop length-agnostic. The same basic functionality 
        // will work for codes of different lengths.
        for ($i = strlen($code) - 1; $i >= 0; $i--) {
            $sum += (int)$code[$i] * ($weightflag ? 3 : 1);
            $weightflag = !$weightflag;
        }
        $code .= (10 - ($sum % 10)) % 10;
        return $code;
    }
}
