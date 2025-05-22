<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Price;
use Stripe\Customer;
use Stripe\Subscription;
class StripeController extends Controller
{
    public function listPrices()
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));

        //$prices = Price::all(['limit' => 10]);
        $prices = Price::all();
        $customers = Customer::all(['limit' => 10]);
        // Retourner comme JSON ou afficher

        // Retrieve a specific customer
        //$customer = Customer::retrieve('cus_SKOv3XV0YBEPdS');
        //return response()->json($customer);

        $subscriptions = Subscription::all([
            'customer' => 'cus_SKOv3XV0YBEPdS',
        ]);

        //return response()->json($subscriptions);


        return response()->json($customers);

        //return view('abonnements.pricing', compact($prices));
    }

    public function getCustomer($id)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));

        try {
            $customer = Customer::retrieve($id);
            return response()->json($customer);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Client non trouvé.'], 404);
        }
    }

}
