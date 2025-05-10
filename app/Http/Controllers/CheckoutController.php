<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, string $plan = 'price_1RM73dPq260KNrONH4cY3Suf')
    {
        return $request->user()
            ->newSubscription('prod_SGeMvA9SIV59cd', $plan)
            ->checkout([
                'success_url' => route('success-checkout'),
                'cancel_url' => url()->previous()
            ]);
    }
}
