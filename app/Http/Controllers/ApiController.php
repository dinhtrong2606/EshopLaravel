<?php

namespace App\Http\Controllers;

use App\Models\Videos;
use App\Models\Product;
use Illuminate\Http\Request;
use Svg\Tag\Rect;

class ApiController extends Controller
{
    public function edit(Request $request)
    {
        $keyword = $request->_text;
        if ($keyword) {
            $search = Product::orderBy('product_id', 'DESC')
                ->where('product_name', 'LIKE', '%' . $keyword . '%')
                ->get();
        }

        $result = [
            'code' => 200,
            'data' => $search
        ];

        return $result;
    }
}