<?php

namespace App\Http\Controllers;

use App\Helpers\FormatResponse;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::all();

        if ($customers) {
            return FormatResponse::createAPI(200, 'success', $customers);
        } else {
            return FormatResponse::createAPI(404, 'failed');
        }
    }

    public function create(Request $request)
    {
        $rules = [
            'name' => 'required|string',
            'contact' => 'required|string|min:8|max:13',
            'email' => 'required|email',
            'address' => 'required|string',
            'discount' => 'required|integer',
            'discount_type' => 'required|in:percentage,fixed',
            'identity' => 'required|string',
        ];

        $data = $request->all();
        $validate = Validator::make($data, $rules);

        if ($validate->fails()) {
            return FormatResponse::createAPI(400, 'failed', $validate->errors());
        }

        $createCustomer = Customer::create($data);

        return FormatResponse::createAPI(201, 'success', $createCustomer);
    }

    public function update(Request $request, $id)
    {
        $rules = [
            'name' => 'string',
            'contact' => 'string|min:8|max:13',
            'email' => 'email',
            'address' => 'string',
            'discount' => 'integer',
            'discount_type' => 'in:percentage,fixed',
            'identity' => 'string',
        ];

        $data = $request->all();
        $validate = Validator::make($data, $rules);

        if ($validate->fails()) {
            return FormatResponse::createAPI(400, 'failed', $validate->errors());
        }


        $updateCustomer = Customer::find($id);
        if (!$updateCustomer) {
            return FormatResponse::createAPI(404, 'failed', 'Customer not found');
        }

        $updateCustomer->fill($data);
        $updateCustomer->save();

        return FormatResponse::createAPI(200, 'success', $updateCustomer);
    }

    public function destroy($id)
    {
        $deleteCustomer = Customer::find($id);
        if (!$deleteCustomer) {
            return FormatResponse::createAPI(404, 'failed', 'Customer not found');
        }

        $deleteCustomer->delete();
        
        return FormatResponse::createAPI(200, 'success', 'Customer deleted');
    }

}
