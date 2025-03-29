<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Payment;
use Inertia\Response;

class PaymentController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Payments', [
            'payments' => Payment::all()
        ]);
    }

    public function destroy($id)
    {
        $payment = Payment::findOrFail($id);
        $payment->delete();

        return redirect()->back()->with('success', 'Payment Deleted Successfully');
    }

    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'email' => 'required|email',
                'amount' => 'required|numeric',
                'status' => 'required|in:success,pending,failed,processing'
            ]
        );

        $payment = Payment::findOrFail($id);
        $payment->update([
            'email' => $request->email,
            'amount' => $request->amount,
            'status' => $request->status
        ]);

        return response()->json(['message'=> 'Payment Updated Successfully'], 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:payments,email',
            'amount' => 'required|numeric|min:0',
            'status' => 'required|in:pending,success,failed, processing'
        ]);

        Payment::create([
            'email' => $request->email,
            'amount' => $request->amount,
            'status' => $request->status
        ]);
        return response()->json(['message' => 'Payment Created Successfully'], 200);

    }
}
