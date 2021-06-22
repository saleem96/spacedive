<?php

namespace App\Http\Controllers;

use App\CouponCode;
use App\Http\Requests\PaymentRequest;
use App\Payment;
use App\Plan;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function postRegister(Request $request)
    {
        // $name='ddd';
        //  return view('emails.welcome',compact('name'));

        $data = $request->all();
        $validator = Validator::make($data, [
            'lname' => ['required', 'string', 'max:255'],
            'fname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,NULL,id,deleted_at,NULL'],
            'password' => ['required', 'string', 'min:3'],
            'terms' => ['required'],
            'ssn'=>['required', 'string', 'min:10','max:10'],
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator->errors());
        }
        $user_insert = [
            "fname" => $data["fname"],
            "lname" => $data["lname"],
            "email" => $data["email"],
            "number" => $data["phone"],
            "ssn"=>$data["ssn"],
            "password" => Hash::make($data["password"])
        ];
//        $token = $request->get("registration_token");
//        $record = DB::table("payment_for_registration")->where("token", $token)->first();
//        if ($record) {
//            $user_insert['card_number'] = $record->card;
//            $user_insert['cvc'] = $record->cvc;
//            $user_insert['ex_month'] = $record->month;
//            $user_insert['ex_year'] = $record->year;
//            $user_insert['plan_id'] = $record->plan_id;
//        } else {
//        }
        $user_insert['plan_id'] = 1;

        $user = User::create($user_insert);

        \App\Notification::create([
            'user_id' => 7,
            'title' => 'New User Registered',
            'data' => $user->fname . ' registered',
            'url' => url('admin_profile_'.$user->id)
        ]);
        $msg = 'New user registered with email : ' . $user->email.'<br>'. ' <a href="'.url('admin_profile_'.$user->id).'">Click here to view</a>';
        $url = url('admin_profile_'.$user->id);
        Mail::send('emails.notifications', ["msg"=>$msg,"url"=>$url], function($message)  {
            $message->to('rasmus@scheuer-larsen.com', 'Support User')->subject
            ('Support ');
        });

//        if ($record) {
//            $payment = [
//                "amount" => $record->amount,
//                "card_number" => $record->card,
//                "cvc" => $record->cvc,
//                "month" => $record->month,
//                "year" => $record->year,
//            ];
//            Payment::AddPayment($payment, $user->id);
//            DB::table("payment_for_registration")->where("token", $token)->delete();
//        }
        $email = $user->email;

        Mail::send('emails.welcome', ["name"=>$user->fname . ' ' . $user->lname], function($message) use ($user, $email) {
            $message->to($email, $user->fname)->subject
            ('Welcome to Spacedive');
        });
        Auth::login($user);
        return redirect("/")->withErrors(__('strings.welcome_first'));
    }

    public function postLogin(Request $request)
    {

        $data = $request->all();
        $validator = Validator::make($data, [
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:3'],
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator->errors());
        }
        $user = User::where("email", $request->email)->first();
        if ($user) {
            if (Hash::check(request()->get('password'), $user->password)) {
                Auth::login($user);
                return back();
            } else {
                return back()->withErrors(['Password is incorrect']);
            }
        } else {
            return back()->withErrors(['Email not found']);

        }

    }

    public function postLogout()
    {
        auth()->logout();
        return redirect("/");
    }

    public function update(Request $request)
    {
        $data = $request->except('_token', 'image');
        $user = User::find($request->id);
        $user->fname = $request->fname;
        $user->lname = $request->lname;
        $user->email = $request->email;
        $user->dob = $request->dob;
        $user->number = $request->number;
        $user->address = $request->address;
        $user->street = $request->street;
        $user->city = $request->city;
        $user->country = $request->country;
        $user->zipcode = $request->zipcode;
        $user->card_number = $request->card_number;
        $user->cvc = $request->cvc;
        $user->ex_month = $request->ex_month;
        $user->ex_year = $request->ex_year;
        if ($request->password != "%change-password-key%") {
            $user->password = Hash::make($request->password);
        }
        $user->gender = $request->gender;
        $user->aboutme = $request->aboutme;
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . request()->image->getClientOriginalExtension();
            $user->image = $imageName;
            request()->image->move(public_path('images/user/'), $imageName);
        }
        $user->save();

        return back();
    }

    public function postPayment(PaymentRequest $request, Plan $plan)
    {
        // return view('emails.receipt');
        $amount = $plan->amount;
        $coupon = CouponCode::where('code',$request->coupon_code)->first();
        if($coupon){
            $amount = $amount - $coupon->amount;
        }
        $last_plan = Payment::where('user_id',auth()->id())->orderBy('id','desc')->first();
        if($last_plan){
            if(date('Y-m-d',strtotime('-30 days')) < date('Y-m-d',strtotime($last_plan->created_at))){
                $amount = $amount - $last_plan->amount;
                if($amount < 0 ){
                    $amount = 1;
                }
            }
        }
        $plan_id = $plan->id;
        $data = $request->all();
        $user = User::find(auth()->id());

        if($plan_id != 1){

            $result = Payment::payStripe($data, $amount, "Registration Payment to " . config('app.name'), function () use ($data, $plan_id, $amount) {
                $token = Str::random(60);

                $result = DB::table("payment_for_registration")->insert([
                    "token" => $token,
                    "plan_id" => $plan_id,
                    "amount" => $amount,
                    "status" => "paid",
                    "card" => $data['card'],
                    "cvc" => $data['cvc'],
                    "month" => $data['month'],
                    "year" => $data['year'],
                ]);
                if ($result) {
                    return $token;
                } else {
                    return false;
                }
            });

            if($result && $result['type'] == "paid"){
                $email = $user->email;




                Mail::send('emails.receipt', ["name"=>$user->fname . ' ' . $user->lname,'payment'=>[
                    "amount" => $amount,
                    "plan_name" => $plan->title,
                    "card_number" => $data['card'],
                ]], function($message) use ($user, $email) {
                    $message->to($email, $user->fname)->subject
                    ('Upgrade Confirmation');
                });


                $msg = 'User upgrade subscription : ' . $user->email.'<br>'. ' <a href="'.url('admin_profile_'.$user->id).'">Click here to view the user</a>';
                $url = url('admin_profile_'.$user->id);

                Mail::send('emails.notifications', ["msg"=>$msg,"url"=>$url], function($message)  {
                    $message->to('rasmus@scheuer-larsen.com', 'Support User')->subject
                    ('Support ');
                });
            }
        }

        if ($plan_id == 1 || ($result && $result['type'] == "paid")) {
            $payment = [
                "amount" => $amount,
                "plan_id" => $plan_id,
                "card_number" => $data['card'],
                "cvc" => $data['cvc'],
                "month" => $data['month'],
                "year" => $data['year'],
            ];
            Payment::AddPayment($payment, auth()->id());
            $user->plan_id = $plan_id;
            $user->save();
            return redirect("/")->withErrors(__('strings.plan_update'). ' '.$plan->title.'.');
        } else {
            return back()->withErrors($result['msg']);
        }
    }

    public function updatePlan (Request $request) {
        $user = User::find($request->id);
        $user->plan_id = $request->plan_id;
        $user->save();
        return back();
    }

    public function endPlan (Request $request) {
        $user_id = $request->has('id') ? $request->id : auth()->id();
        $user = User::find($user_id);
        $user->plan_id = null;
        $user->save();

        \App\Notification::create([
            'user_id' => 7,
            'title' => 'User cancel subscription',
            'data' => $user->email . ' cancel their subscription',
            'url' => url('admin_profile_'.$user->id)
        ]);

        $msg = 'User cancel subscription : ' . $user->email.'<br>'. ' <a href="'.url('admin_profile_'.$user->id).'">Click here to view the user</a>';
        $url = url('admin_profile_'.$user->id);

        Mail::send('emails.notifications', ["msg"=>$msg,"url"=>$url], function($message)  {
            $message->to('rasmus@scheuer-larsen.com', 'Support User')->subject
            ('Support ');
        });
        return back()->withErrors('Congratulation ! Your Subscription has been canceled successfully.');;
    }
}
