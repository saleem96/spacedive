<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// Route::get('/email/gig',function (\Illuminate\Http\Request $request) {
//     $task = \App\Task::find(1);

//    return view('emails.gig',compact('task'));
// });
Route::get('/asd', function (\Illuminate\Http\Request $request) {
    phpinfo();
});

Route::get('/approve_gig_{id}', function($id,\Illuminate\Http\Request $request) {
    $task = \App\Task::find($id);
    if($task){

        \App::setLocale($task->lang);
        setcookie("lang", $task->lang, time()+180*24*60*60);

        return view('approve_gig',compact('task'));
    }
});
Route::post('/approve_gig_{id}', function($id,\Illuminate\Http\Request $request) {

    $task = \App\Task::find($id);
    $task->is_client_approved = 1;
    $task->insurance = $request->insurance;
     $task->status='confirmed';
    $task->save();
    \App\Notification::create([
        'user_id' => 7,
        'title' => 'Gig Approved by Client',
        'data' => $task->client->name . ' approved this gig : ' . $task->name,
        'url' => url('admin_tasks')
    ]);
      \App\Notification::create([
        'user_id' => $task->user_id,
        'title' => 'Task status changed',
        'data' => $task->name . '$#status_change_to$#' . ucwords($task->status),
        'url' => url('tasks')
    ]);
    \App::setLocale($task->lang);
    setcookie("lang", $task->lang, time()+180*24*60*60);

    // Mail::send('emails.confirmation', ['task' => $task], function($message) use ($task) {
    //     $message->to($task->user->email)->subject
    //     (__('strings.confirm_notification'));
    // });
            // dd(url('admin_task_'."$id"));

    $msg = (__('strings.confirm_notification')) . $task->user->email.'<br>'. '<a href="'.url('admin_task_'.$id).'">Click here to view</a>';
    $url =  url('admin_task_'.$id);
    //  return view('emails.confirmation',compact('msg','url'));
    Mail::send('emails.confirmation', ["msg"=>$msg,"url"=>$url], function($message)  {
        $message->to('rasmus@scheuer-larsen.com', 'Support User')->subject
        ('Support ');

    });

    return view('gig_thanks');
});

Route::get('/change_language', function (\Illuminate\Http\Request $request) {
    setcookie("lang", $request->lang, time()+180*24*60*60);
    return back();
});

Route::group(['middleware' => 'guest'], function () {
    Route::get('/login', function () {
        return view('login');
    });



    Route::get('/register', function () {
        $token = request()->get("_token",'');
//        if ($plan->id != 1) {
//            $result = \App\Payment::checkPayment($token);
//            if ($result) {
//                return view('register', compact('token'));
//            } else {
//                return redirect("/payment-".$plan->id);
//            }
//        }
        return view('register', compact('token'));
    });

    Route::post('/register', 'AuthController@postRegister');
    Route::post('/login', 'AuthController@postLogin');


    Route::get('/reset_password_{id}', function ($id) {$user = \App\User::find($id); if(!$user){return back();}return view('reset')->with('u_id',$id);});
    Route::get('/forgotPass', function () {return view('forgot');});

    Route::post('/forgotPass', function (\Illuminate\Http\Request $request) {
        $email = $request->email;
        $u = \App\User::where("email",$email)->first();
        if($u){
            $link = url('/reset_password_'.$u->id);
            Mail::send('emails.forgot', ["link"=>$link], function($message) use ($email) {
                $message->to($email, 'User')->subject
                ('Forgot Password');
            });
            return back()->withErrors('Email sent successfully');
        }
        return back()->withErrors('Email not found');
    });
    Route::post('/reset_password_{id}', function ($id,\Illuminate\Http\Request $request) {
        $u = \App\User::find($id);
        if($u){
            $u->password = bcrypt($request->password);
            $u->save();
            return back()->withErrors('Password updated successfully');
        }
        return back()->withErrors('User not found');
    });
});
Route::group(['middleware' => 'auth'], function () {

    Route::get('/admin_notification_read_{id}', function($id) {
        $n = \App\Notification::find($id);
        $n->read = 1;
        $n->save();
        if(!$n->url){
            return redirect('/');
        }
        return redirect($n->url);
    });
    Route::get('/admin_tasks', function(\Illuminate\Http\Request $request) {
        $tasks = \App\Task::when($request->user_id,function ($q) use ($request) {
            return $q->where('user_id',$request->user_id);
        })->when($request->status,function ($q) use ($request) {
            return $q->where('status',$request->status);
        })->orderBy('id','desc')->get();
        // dd($tasks);
        return view('admin.tasks',compact('tasks'));
    });

    Route::get('/admin_task_{id}', function($id,\Illuminate\Http\Request $request) {
        $task = \App\Task::find($id);
        return view('admin.viewTask',compact('task'));
    });

    Route::post('/admin_edit_task', function(\Illuminate\Http\Request $request) {
        $task = \App\Task::find($request->id);
        $task->status = $request->status;
        $task->save();
//        return view('emails.gig',compact('task'));

        \App\Notification::create([
            'user_id' => $task->user_id,
            'title' => 'Task status changed',
            'data' => $task->name . '$#status_change_to$#' . ucwords($task->status),
            'url' => url('tasks')
        ]);

        if($request->status == "sent_to_client"){
//            return view('emails.gig',compact('task'));
            \App::setLocale($task->lang);
            setcookie("lang", $task->lang, time()+180*24*60*60);

            // return view('emails.gig',compact('task'));
            // dd( url('admin_tasks_'."$request->id"));
            Mail::send('emails.gig', ['task' => $task], function($message) use ($task) {
                $message->to($task->client->email, $task->client->name)->subject
                (__('strings.Approve gig'));
            });

            \App::setLocale('en');
            setcookie("lang", "en", time()+180*24*60*60);
            return back()->withErrors('Task has been sent to Client for confirmation');
        }

        return back();
    });
    Route::get('/admin_users', function(\Illuminate\Http\Request $request) {

        if($request->subBtn == 'admin_export_users'){
            return Excel::download(new \App\Exports\UserExport($request->plan_id ? $request->plan_id : 0), 'users.xlsx');
        }
        $plan_id = $request->get('plan_id',0);
        $users = \App\User::when($request->plan_id,function ($q) use ($request) {
            return $q->where('plan_id',$request->plan_id);
        })->where('is_admin',0)->get();
        $plans = \App\Plan::all();
        return view('admin.users',compact('users','plans','plan_id'));
    });
    Route::get('/admin_del_users', function(\Illuminate\Http\Request $request) {

        $users = \App\User::onlyTrashed()->get();
        $plans = \App\Plan::all();
        return view('admin.deletedUsers',compact('users','plans'));
    });
    Route::get('/admin', function() {

        $invoices = \App\Invoice::where('status','<>','draft')->get();
        $total_users = \App\User::where('is_admin',0)->count();
        $users = \App\User::selectRaw('count(id) as total,plan_id')->where('is_admin',0)->groupBy('plan_id')->get();
        $payments = \App\Payment::selectRaw('sum(amount) as tamount,plan_id')->groupBy('plan_id')->get();

        $graph_data = DB::select("select count(id) as total, created_at as new_date, YEAR(created_at) year, MONTH(created_at) month from `users` where `is_admin` = 0  and deleted_at is null group by YEAR(created_at),MONTH(created_at)");
        $graph_data4 = DB::select("select count(id) as total, created_at as new_date, YEAR(created_at) year, MONTH(created_at) month from `invoices` group by YEAR(created_at),MONTH(created_at)");
        $graph_data5 = DB::select("select count(id) as total, created_at as new_date, YEAR(created_at) year, MONTH(created_at) month from `tasks` group by YEAR(created_at),MONTH(created_at)");
        $graph_data3 = DB::select("select count(id) as total, created_at as new_date, YEAR(created_at) year, MONTH(created_at) month from `users` where `is_admin` = 0 and deleted_at is not null group by YEAR(created_at),MONTH(created_at)");
        $graph2_data = DB::select("select sum(amount) as total, created_at as new_date, YEAR(created_at) year, MONTH(created_at) month from `payment_histories` group by YEAR(created_at),MONTH(created_at)");

        return view('admin.home',compact('total_users','payments','invoices','users','graph2_data','graph_data','graph_data3','graph_data4','graph_data5'));
    });

    Route::post('admin_invoice_status', function (\Illuminate\Http\Request $request) {

        $invoice = \App\Invoice::find($request->invoice_id);
        if($invoice){
            $invoice->status = $request->invoice_type;
            $invoice->save();

            \App\Notification::create([
                'user_id' => $invoice->user_id,
                'title' => 'invoice_status_change',
                'data' => $invoice->invoice_num . '$#status_change_to$#' . ucwords($invoice->status),
                'url' => url('invoice_'.$invoice->id)
            ]);
        }
        return back();
    });

    Route::get('admin_invoice_status_update_job', function (\Illuminate\Http\Request $request) {
        $invoices = \App\Invoice::whereRaw('json_extract(data, "$.date_due") < ?',[date('Y-m-d')])
            ->where('status','<>','paid')->get();
        foreach ($invoices as $invoice) {
            $invoice->status = 'overdue';
            $invoice->save();
        }
    });
    Route::get('admin_invoices', function (\Illuminate\Http\Request $request) {
        $invoices = \App\Invoice::when($request->user_id,function ($q) use ($request) {
            return $q->where('user_id',$request->user_id);
        });
        if($request->client_id){
            $invoices->where('client_id','=',$request->client_id);
        }
        if($request->type){
            $invoices->where('status','=',$request->type);
        }
        $invoices = $invoices->orderBy('id','DESC')->get();

        $clients = \App\Client::get();
        $users = \App\User::where('is_admin',0)->get();


        // $over_due = \App\Invoice::whereRaw('json_extract(data, "$.date_due") < ?',[date('Y-m-d')])
        //   ->get();
        //     dd($over_due);
        //     foreach ($over_due as $over) {
        //         $over->status = 'overdue';
        //         $over->save();
        //     }

        // $p_overdue = \App\Invoice::get();
        // //  dd($p_overdue);



        // foreach ($p_overdue as $item) {
        //     $item->data = json_decode($item->data);
        //     if(date('Y-m-d') > date('Y-m-d',strtotime($item->data->date_due))){
        //         // dd( $item->status);
        //         $item->status = "overdue";

        //     }

        // }



        return view('admin.invoices',compact('clients','invoices','users'));
    });

    Route::get('/plans', function () {
        $plans = Plan::all();
        return view('plans2',compact("plans"));
    });


    Route::get('/admin_export_users', function () {
        return Excel::download(new \App\Exports\UserExport, 'users.xlsx');
    });

    Route::get('/payment-{plan}', function (\App\Plan $plan) {
        $user = auth()->user();
        return view('payment2',compact('user','plan'));
    });
    Route::post('/payment-{plan}', 'AuthController@postPayment');
    Route::get('/endplan', 'AuthController@endPlan');
    Route::get('/admin_endplan', 'AuthController@endPlan');

    Route::get('/', function () {
        $gigs = \App\Task::where('user_id',auth()->id())->get();

        $invoices = \App\Invoice::where('user_id',auth()->id())->where('final','1')->get();
        $paid_amount = $invoices->where('status','paid')->sum('total');
        $pend = $invoices->where('status','overdue');
        // dd($pend);
        $total = 0;
        foreach ($pend as $item) {
            $item->data = json_decode($item->data);
            if(date('Y-m-d') > date('Y-m-d',strtotime($item->data->date_due))){

                $total += $item->total;
            }
        }
        $graph_data = DB::select("select sum(total) as total, created_at as new_date, YEAR(created_at) year, MONTH(created_at) month from `invoices` where `user_id` = ? group by `year`, `month`",[auth()->id()]);
        $graph2_data = DB::select("select sum(total) as total, created_at as new_date, YEAR(created_at) year, MONTH(created_at) month from `invoices` where status = 'paid' and`user_id` = ? group by `year`, `month`",[auth()->id()]);
        if(count($graph2_data)){
            $a = [(object)[
                "total" => 0,
                "new_date" => date('Y-m-d',strtotime('-1 month',strtotime($graph2_data[0]->new_date)))
            ]];
            $graph2_data = array_merge($a,$graph2_data);
        }
        $clients = \App\Client::select('*')
            ->selectRaw('(select IFNULL(sum(total),0) from invoices where invoices.client_id=clients.id) as invoice_total')
            ->orderBy('invoice_total','desc')
            ->where('user_id',auth()->id())
            ->get(5);
        return view('home',compact('gigs','clients','invoices','paid_amount','total','graph_data','graph2_data'));
    });
    Route::get('/invoices', function (\Illuminate\Http\Request $request) {
        $invoices = \App\Invoice::where('user_id',auth()->id());
        if($request->client_id){
            $invoices->where('client_id','=',$request->client_id);
        }
        if($request->type){
            $invoices->where('status','=',$request->type);
        }else{
            $invoices->where('status','!=','draft');
        }
        $invoices = $invoices->orderBy('id','DESC')->get();

        $clients = \App\Client::where('user_id',auth()->id())->get();
        return view('invoices',compact('clients','invoices'));
    });
    Route::get('/search', function (\Illuminate\Http\Request $request) {
        $str = $request->search;
        $invoices = \App\Invoice::where('invoice_num','like','%'.$str.'%')->where('user_id',auth()->id())->get();
        return response()->json($invoices);
    });
    Route::get('/draft_invoices', function () {
        $invoices = \App\Invoice::where('user_id',auth()->id())->where('status','=','draft')->get();
        return view('draftinvoices',compact('invoices'));
    });
        Route::get('/new_invoice', function (\Illuminate\Http\Request $request) {
            $tasks = \App\Task::where('user_id',auth()->id())->where('is_client_approved',1)
             ->where('status','!=','completed')
            ->orderBy('id','desc')->get();

            if(!count($tasks)){
                return redirect('/')->withErrors(__('strings.no_task'));
            }
            if($request->has('task_id')){
                return redirect('new_invoice_'.$request->task_id);
            }

            $clients = \App\Client::where('user_id',auth()->id())->get();


            return view('newInvoice',compact('clients','tasks'));
        });
        Route::get('/new_invoice_{id}', function ($id) {
            $tasks = \App\Task::where('user_id',auth()->id())->where('is_client_approved',1)->get();

            $task = \App\Task::find($id);
            $client_id = $task->client_id;
            $clients = \App\Client::where('user_id',auth()->id())->get();
            return view('newInvoice',compact('clients','client_id','task','tasks'));
        });

        Route::post('/new_invoice', 'InvoiceController@add');
        Route::post('/new_invoice_{id}', 'InvoiceController@add');

    Route::get('/clients', function () {
        $clients = \App\Client::where('user_id',auth()->id())->get();

        return view('clients',compact('clients'));
    });
    Route::get('/profile', function () {
        $user = \App\User::find(auth()->id());
        return view('profile',compact('user'));
    });
    Route::get('/admin_profile_{id}', function ($id) {
        $user = \App\User::find($id);
        return view('admin.profile',compact('user'));
    });
    Route::get('/payments', function () {
        $payments = \App\Payment::where("user_id",auth()->id())->get();
        return view('my-payments',compact('payments'));
    });
    Route::get('/dashboard', function () {
        $invoices = \App\Invoice::all();

        return view('dashboard',compact('invoices'));
    });
    Route::get('/support', function () {
        return view('support');
    });
    Route::get('/plan2', function () {
        return view('plans2');
    });
    Route::post('/profile', 'AuthController@update');
    Route::post('/admin_profile_{id}', 'AuthController@update');
    Route::post('/update-plan', 'AuthController@updatePlan');
    Route::post('/admin_update-plan', 'AuthController@updatePlan');
    Route::post('/add_client', 'InvoiceController@add_client');
    Route::post('/edit_client', 'InvoiceController@edit_client');
    Route::get('/del_client/{id}', 'InvoiceController@del_client');
    Route::get('/edit_invoice_{id}', 'InvoiceController@edit');
    Route::post('/delete_invoice_{id}', 'InvoiceController@delete');
    Route::get  ('/delete_invoice_{id}', 'InvoiceController@delete');
    Route::get('/invoice_{id}', 'InvoiceController@view');
    Route::get('/admin_invoice_{id}', 'InvoiceController@adminview');
    Route::post('/edit_invoice_{id}', 'InvoiceController@update');

    Route::get('/logout', 'AuthController@postLogout');
    Route::get('/admin_logout', 'AuthController@postLogout');



    Route::get('/tasks', function (\Illuminate\Http\Request $request) {
        $clients = \App\Client::where('user_id',auth()->id())->get();

        $tasks = \App\Task::when($request->client_id,function ($q) use ($request) {
            return $q->where('client_id',$request->client_id);
        })->when($request->status,function ($q) use ($request) {
            return $q->where('status',$request->status);
        })->where('user_id',auth()->id())->orderBy('id','desc')->get();

        return view('tasks',compact('tasks','clients'));
    });
        Route::group(['middleware' => 'invoice'], function () {

    Route::get('/new_tasks', function () {
        $user = auth()->user();
        $latest_task = App\Task::orderBy('created_at','DESC')->first();
$reference_no = '#'.str_pad($latest_task->id+1, 4, "0", STR_PAD_LEFT);
// dd($ref_no);
        return view('newTask',compact('user','reference_no'));
    });
    });
    Route::get('/edit_tasks_{id}', function ($id) {
        $user = auth()->user();
        $task = \App\Task::find($id);
        return view('editTask',compact('user','task'));
    });

    Route::post('/edit_tasks_{id}', 'InvoiceController@edit_task');
    Route::post('/new_tasks', 'InvoiceController@add_task');
    Route::post('/edit_task', 'InvoiceController@edit_task');
    Route::get('/del_task/{id}', 'InvoiceController@del_task');


    Route::post('/support', function (\Illuminate\Http\Request $request) {
        $email = $request->aboutme;
        Mail::send('emails.support', ["msg"=>$email], function($message) use ($email) {
            $message->to('rasmus@scheuer-larsen.com', 'Support User')->subject
            ('Support ');
        });
     return back()->withErrors((__('strings.message_send_s')));
    });


    Route::get('/delete/profile', function (\Illuminate\Http\Request $request) {
        $user = \App\User::where('id',auth()->id())->delete();
        \App\Payment::where('user_id',auth()->id())->delete();
        Auth::logout();
        return back();
    });
});

