<?php

namespace App\Http\Controllers;

use App\Helpers\FormatResponse;
use App\Models\Customer;
use App\Models\Item;
use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Prophecy\Doubler\Generator\Node\ReturnTypeNode;

class SaleController extends Controller
{
    public function index()
    {
        // $sales = Sale::all();
        $sales = Sale::with('customer')->with('item')->get();


        if ($sales) {
            return FormatResponse::createAPI(200, 'success', $sales);
        } else {
            return FormatResponse::createAPI(404, 'failed');
        }
    }

    public function show($id)
    {
        $sale = Sale::with('customer')->with('item')->findOrFail($id);
        // $sale = Sale::with('customer')->findOrFail($id);

        $currentStock = $sale->item->stock;
        $quantity = $sale->quantity;
        
        if($quantity > $currentStock) {
            return FormatResponse::createAPI(400, 'failed', 'Out of stock');
        }

        $discount = $sale->customer->discount;
        $price = $sale->item->price;

        $totalDiscount = $discount / 100 * $price;
        $totalPrice = $price - $totalDiscount;
        // dd($quantity);
        

        if ($sale) {
            return FormatResponse::createAPI(200, 'success', $sale);
        } else {
            return FormatResponse::createAPI(404, 'failed', 'Sale not found');
        }
    }

    public function create(Request $request)
    {
        $rules = [
            'transaction_code' => 'required|string',
            'transaction_date' => 'required|date',
            'quantity' => 'required|integer',
            'total_discount' => 'required|integer',
            'total_price' => 'required|integer',
            'total_checkout' => 'required|integer',
            'item_id' => 'required|integer',
            'customer_id' => 'required|integer',
        ];

        $data = $request->all();
        $validate = Validator::make($data, $rules);

        if ($validate->fails()) {
            return FormatResponse::createAPI(400, 'failed', $validate->errors());
        }

        $item = Item::find($request->item_id);
        if (!$item) {
            return FormatResponse::createAPI(404, 'failed', 'Item not found');
        }

        $customer = Customer::find($request->customer_id);
        if (!$customer) {
            return FormatResponse::createAPI(404, 'failed', 'Customer not found');
        }


        $createSale = Sale::create($data);

        return FormatResponse::createAPI(201, 'success', $createSale);
    }

    public function update(Request $request, $id)
    {
        $rules = [
            'transaction_code' => 'string',
            'transaction_date' => 'date',
            'quantity' => 'integer',
            'total_discount' => 'integer',
            'total_price' => 'integer',
            'total_checkout' => 'integer',
            'item_id' => 'integer',
            'customer_id' => 'integer',
        ];

        $data = $request->all();
        $validate = Validator::make($data, $rules);

        if ($validate->fails()) {
            return FormatResponse::createAPI(400, 'failed', $validate->errors());
        }

        $updateSale = Sale::find($id);
        if (!$updateSale) {
            return FormatResponse::createAPI(404, 'failed', 'Sale not found');
        }

        $updateSale->fill($data);
        $updateSale->save();

        return FormatResponse::createAPI(200, 'success', $updateSale);
    }

    public function destroy($id)
    {
        $deleteSale = Sale::find($id);
        if (!$deleteSale) {
            return FormatResponse::createAPI(404, 'failed', 'Sale not found');
        }

        $deleteSale->delete();
        
        return FormatResponse::createAPI(200, 'success', 'Sale deleted');
    }
}
