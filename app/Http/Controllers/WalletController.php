<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use FedaPay\FedaPay;
use FedaPay\Transaction;
class WalletController extends Controller
{
  public function showRecharge()
{
    return view('vendor.recharge');
}

public function recharge(Request $request)
{
    $vendor = auth()->user();

    FedaPay::setApiKey(config('services.fedapay.secret_key'));
    FedaPay::setEnvironment(config('services.fedapay.environment'));
    $transaction = Transaction::create([
        "description" => "Recharge wallet vendeur",
        "amount" => $request->amount,
        "currency" => ["iso" => "XOF"],
        "callback_url" => route('wallet.callback'),
        "customer" => [
            "firstname" => $vendor->display_name,
            "email" => $vendor->email
        ]
    ]);

    $token = $transaction->generateToken();

    return redirect($token->url);
}


public function callback(Request $request)
{
    $transaction_id = $request->transaction_id;

    FedaPay::setApiKey(config('services.fedapay.secret_key'));

    $transaction = Transaction::retrieve($transaction_id);

    if($transaction->status == "approved"){

        $vendor = auth()->user();

        $vendor->wallet_balance += $transaction->amount;
        $vendor->save();
    }

    return redirect()->route('seller.dashboard')
        ->with('success','Recharge réussie');
}
}
