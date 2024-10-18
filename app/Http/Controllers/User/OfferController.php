<?php

namespace App\Http\Controllers\User;

use App\Models\Offer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OfferController extends Controller
{
    public function getAllOffer()
    {
        $offer = Offer::with('product')->whereHas('product')->where('show', 'offer_page')
            ->where('status', 1)->latest()->get();
        return view('pages.frontend.offer', [
            'offer' => $offer
        ]);
    }
}
