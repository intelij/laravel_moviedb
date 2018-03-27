<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe as Stripe;

class SubscriptionController extends Controller
{

    public function __construct()
    {
         $this->middleware('auth');
         Stripe\Stripe::setApiKey(config('services.stripe.secret'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();

        if(!$user::subscriber()) {
            return redirect('/account/billing');
        }

        $invoices = $user->invoices();

        //Primer za pristam do invoice-ot
        /*dd($invoices[0]->lines->data[0]->plan->name);*/

        return view('subscription.index',compact('user','invoices'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = auth()->user();

        if($user::subscriber()) {
            return redirect('/user/'.$user->id);
        }


        return view('subscription.create',compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $plan_id = $request->input('plan');
       $user = auth()->user();
       if(is_null($user->stripe_id)) {
            $customer = Stripe\Customer::create([
                "description" => "Customer for moviesdb.com",
                "source" => $request->input('stripeToken'),
                "email" => $user->email
            ]);

            $user->stripe_id = $customer->id;
            $user->save();
       }

       $plan_name = explode('_',$plan_id)[1];
       $user->newSubscription($plan_name,$plan_id)->create($request->input('stripeToken'));

       if($user->roles->count() == 0) {
           $user->roles()->attach(4);
       }

       session()->flash('message','Thank you for your subscription!');

       return redirect('/user/'.$user->id);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = auth()->user();
        $plan_id = $id;

        $current_sub = $user->subscriptions->first();
        $user->subscription($current_sub->name)->swap($id);

        $current_sub->name = explode('_',$plan_id)[1];

        $current_sub->save();

        session()->flash('message','Successfully changed subscription!');

        return redirect('/account/plan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = auth()->user();

        $current_plan = $user->subscriptions->first()->name;

        $user->subscription($current_plan)->cancelNow();

        $user->roles()->detach();

        session()->flash('message','Subscription has been canceled.');

        return redirect('/user/'.$user->id);
    }
}
