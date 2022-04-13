<?php

namespace App\Http\Controllers;

use App\Helpers\FormatResponse;
use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index()
    {
        $items = Item::all();

        if ($items) {
            return FormatResponse::createAPI(200, 'success', $items);
        } else {
            return FormatResponse::createAPI(404, 'failed');
        }
    }
}
