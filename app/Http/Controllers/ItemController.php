<?php

namespace App\Http\Controllers;

use App\Helpers\FormatResponse;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Psy\Formatter\Formatter;

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

    public function create(Request $request)
    {
        $rules = [
            'name' => 'required|string',
            'type' => 'required|in:kg,pcs',
            'stock' => 'required|integer',
            'price' => 'required|integer',
            'photo' => 'required|string',
        ];

        $data = $request->all();
        $validate = Validator::make($data, $rules);

        if ($validate->fails()) {
            return FormatResponse::createAPI(400, 'failed', $validate->errors());
        }

        $createItem = Item::create($data);

        return FormatResponse::createAPI(201, 'success', $createItem);
    }

    public function update(Request $request, $id)
    {
        $rules = [
            'name' => 'string',
            'type' => 'in:kg,pcs',
            'stock' => 'integer',
            'price' => 'integer',
            'photo' => 'string',
        ];

        $data = $request->all();
        $validate = Validator::make($data, $rules);

        if ($validate->fails()) {
            return FormatResponse::createAPI(400, 'failed', $validate->errors());
        }


        $updateItem = Item::find($id);
        if (!$updateItem) {
            return FormatResponse::createAPI(404, 'failed', 'Item not found');
        }

        $updateItem->fill($data);
        $updateItem->save();

        return FormatResponse::createAPI(200, 'success', $updateItem);
    }

    public function destroy($id)
    {
        $deleteItem = Item::find($id);
        if (!$deleteItem) {
            return FormatResponse::createAPI(404, 'failed', 'Item not found');
        }

        $deleteItem->delete();
        
        return FormatResponse::createAPI(200, 'success', 'Item deleted');
    }
}
