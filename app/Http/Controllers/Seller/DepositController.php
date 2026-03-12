<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use FedaPay\FedaPay;
use FedaPay\Transaction;

class DepositController extends Controller
{
    public function index()
    {
        // Récupérer le vendeur connecté et son solde
        // $vendor = auth()->user()->vendor;
        return view('vendor.depot.deposit');
    }

   public function processMomo(Request $request)
    {

        $request->validate([
            'amount' => 'required|numeric|min:1000'
        ]);

        FedaPay::setApiKey(config('services.fedapay.secret_key'));
        FedaPay::setEnvironment(config('services.fedapay.environment'));

        $transaction = Transaction::create([
            "description" => "Recharge compte vendeur",
            "amount" => $request->amount,
            "currency" => ["iso" => "XOF"],
            "callback_url" => route('seller.deposit.callback'),
            "customer" => [
                "firstname" => auth()->user()->name,
                "email" => auth()->user()->email
            ]
        ]);

        $token = $transaction->generateToken();

        return redirect($token->url);
    }

    public function callback(Request $request)
{

    FedaPay::setApiKey(config('services.fedapay.secret_key'));

    $transaction = \FedaPay\Transaction::retrieve($request->id);

    if($transaction->status == "approved"){

        // ajouter l'argent au vendeur
        $vendor = auth()->user();

        $vendor->balance += $transaction->amount;
        $vendor->save();

        return redirect()->route('seller.deposit')
        ->with('success','Recharge réussie');

    }

    return redirect()->route('seller.deposit')
    ->with('error','Paiement échoué');
}

    public function processVisa(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:1000',
            'card_number' => 'required|digits:16',
            'expiry' => 'required|date_format:Y-m',
            'cvv' => 'required|digits:3',
            'card_holder' => 'required|string',
        ]);

        // Logique de paiement par carte
        // ...

        return redirect()->route('seller.deposit')->with('success', 'Paiement par carte accepté !');
    }
}