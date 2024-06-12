<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Payment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\PaymentRequest;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::latest()->get();
        return view('dashboard.payments.index', compact('payments'));
    }

    public function create()
    {
        return view('dashboard.payments.create');
    }

    public function store(PaymentRequest $request)
    {
        $data = $request->validated();
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('payments', 'public');
        }

        Payment::create($data);


        return redirect()->route('admin.payments.index')->with('success', transWord('Payment created successfully'));
    }

    public function edit(Payment $payment)
    {
        return view('dashboard.payments.edit', compact('payment'));
    }

    public function update(PaymentRequest $request, Payment $payment)
    {
        $data = $request->validated();
        if ($request->hasFile('image')) {

            if ($payment->image) {
                Storage::disk('public')->delete($payment->icon);
            }
            $data['image'] = $request->file('image')->store('payments', 'public');
        }

        $payment->update($data);

        return redirect()->route('admin.payments.index')->with('success', transWord('Payment updated successfully'));
    }

    public function destroy(Payment $payment)
    {
        if ($payment->image) {
            Storage::disk('public')->delete($payment->image);
        }
        $payment->delete();
        return response()->json(['message' => transWord('Payment deleted successfully')]);
    }

    public function changeStatus(Request $request)
    {
        $payment = Payment::find($request->id);
        $payment->update([
            'is_active' => ! $payment->is_active
        ]);
        return response()-> json(['message' => transWord('Status changed successfully')]);
    }
}
