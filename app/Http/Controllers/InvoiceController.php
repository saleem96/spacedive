<?php

namespace App\Http\Controllers;

use App\Client;
use App\Invoice;
use App\Task;
use Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class InvoiceController extends Controller
{
    public function add_task(Request $request){
        // dd($request->all());
        $data = $request->except('_token');

        if ($request->job_type == "other"){
            unset($data['job_type']);
            $data['job_type'] = $request->other_cat;
        }
        unset($data['other_cat']);

//        $request->job_type = $request->other_cat;
//        dd($data);
        $task = Task::create($data);
        $task->lang = \App::getLocale();
        $task->save();
        if(!$request->is_draft){
            $msg = 'Task created to spacedive by ' . auth()->user()->email.'<br>'. '<a href="'.url('admin_tasks').'">Click here to view</a>';
            $url = url('admin_tasks');
            Mail::send('emails.notifications', ["msg"=>$msg,"url"=>$url], function($message)  {
                $message->to('rasmus@scheuer-larsen.com', 'Support User')->subject
                ('Support ');
            });
            \App\Notification::create([
                'user_id' => 7,
                'title' => 'New Task Created',
                'data' => auth()->user()->fname . ' created new task.',
                'url' => url('admin_tasks')
            ]);
            return redirect('/tasks')->withErrors(__('strings.add_task_msg'));
        }
        return redirect('/tasks')->withErrors(__('strings.add_draft_task_msg'));
    }
    public function edit_task(Request $request,$id){
        $data = $request->all();
        $client = Task::find($id);
        $client->name = $data['name'];
        $client->start_date = $data['start_date'];
        $client->end_date = $data['end_date'];
        $client->client_id = $data['client_id'];
        $client->time = $data['time'];
        $client->is_draft = $data['is_draft'];
        $client->job_type = $data['job_type'];
        $client->client_msg = $data['client_msg'];
        $client->price = $data['price'];
        $client->save();
        if(!$request->is_draft){
            $msg = 'Task created to spacedive by ' . auth()->user()->email.'<br>'. '<a href="'.url('admin_tasks').'">Click here to view</a>';
            $url = url('admin_tasks');
            Mail::send('emails.notifications', ["msg"=>$msg,"url"=>$url], function($message)  {
                $message->to('rasmus@scheuer-larsen.com', 'Support User')->subject
                ('Support ');
            });
            \App\Notification::create([
                'user_id' => 7,
                'title' => 'New Task Created',
                'data' => auth()->user()->fname . ' created new task.',
                'url' => url('admin_tasks')
            ]);
            return redirect('/tasks')->withErrors(__('strings.add_task_msg'));
        }
        return back();
    }
    public function del_task($id){
        Task::find($id)->delete();
        return back();
    }

    public function add_client(Request $request){
        $data = $request->all();
        // $validator = Validator::make($data, [
        //     'name' => ['required', 'string', 'max:255'],
        //     'num' => ['required', 'string', 'max:255'],
        //     'address' => ['required', 'string', 'max:255'],
        //     'cname' => ['required', 'string', 'max:255'],
        //     'email' => ['required', 'string', 'max:255'],
        //     'phone' => ['required', 'string', 'max:255'],
        // ]);
        // if ($validator->fails()) {
        //     return back()->withErrors($validator->errors());
        // }
        // else{
            Client::create($request->except('_token'));
            return back();
        // }

    }
    public function edit_client(Request $request){
        $data = $request->all();
        $client = Client::find($data['id']);
        $client->name = $data['name'];
        $client->num = $data['num'];
        $client->ean = $data['ean'];
        $client->address = $data['address'];
        $client->cname = $data['cname'];
        $client->email = $data['email'];
        $client->phone = $data['phone'];
        $client->save();
        return back();
    }
    public function del_client($id){
        Client::find($id)->delete();
        return back();
    }

    public function add($id = null,Request $request){
        $data = $request->all();
        $i = Invoice::create([
            'invoice_num'=>$data['invoice_num'],
            'client_id'=>$data['client_id'],
            'holiday'=>isset($data['holiday']) && $data['holiday'] ? 1 : 0,
            'client'=>$data['client'],
            'data'=>json_encode($request->except('logo')),
            'total'=>$data['total_val'],
            'final'=>$data['submit'] == 'send' ? 1 : 0,
            'status'=>$data['submit'] == 'send' ? 'pending' : 'draft',
            'user_id'=>auth()->id(),
            'task_id'=>$id
        ]);
            
        $task_status=Task::where('id',$id)->first();
        $task_status->status="completed";
        $task_status->save();
        
        if($request->hasFile('logo')){
            $imageName = time() . '.' . request()->logo->getClientOriginalExtension();
            $i->logo = $imageName;
            $i->save();
            request()->logo->move(public_path('images/user/'), $imageName);
        }

        \App\Notification::create([
            'user_id' => 7,
            'title' => 'New Invoice Created',
            'data' => auth()->user()->fname . ' created new invoice.',
            'url' => url('admin_invoice_'.$i->id)
        ]);

        if($data['submit'] == 'send'){
            $msg = 'Invoice sent to Spacedive by ' . auth()->user()->email.'<br>'. '<a href="'.url('admin_invoice_'.$i->id).'">Click here to view the invoice</a>';
            $url = url('admin_invoice_'.$i->id);

            Mail::send('emails.notifications', ["msg"=>$msg,"url"=>$url], function($message)  {
                $message->to('rasmus@scheuer-larsen.com', 'Support User')->subject
                ('Support ');
            });

            if(auth()->user()->plan_id == 1){
                return redirect('/invoice_'.$i->id)->withErrors(__('strings.congrats').' <a href="/plans">'.__('strings.upgrade_here').'</a>.');
            }
            return redirect('/invoice_'.$i->id)->withErrors(__('strings.invoice_send'));
        }
        return redirect('/invoice_'.$i->id);
    }
    public function view($id,Request $request){
        $data = $request->all();
        $invoice = Invoice::find($id);
        $invoice->data = json_decode($invoice->data);
        $clients = \App\Client::where('user_id',auth()->id())->get();

//        dd($invoice);
        return view('invoiceView',compact('invoice','clients'));
    }
    public function adminview($id,Request $request){
        $data = $request->all();
        $invoice = Invoice::find($id);
        $invoice->data = json_decode($invoice->data);
        $clients = \App\Client::where('user_id',auth()->id())->get();

//        dd($invoice);
        return view('admin.invoiceView',compact('invoice','clients'));
    }
    public function edit($id,Request $request){
        $data = $request->all();
        $invoice = Invoice::find($id);
        $invoice->data = json_decode($invoice->data);
        $clients = \App\Client::where('user_id',auth()->id())->get();

//        dd($invoice);
        return view('invoiceEdit',compact('invoice','clients'));
    }
    public function delete($id,Request $request){
        $data = $request->all();
        $invoice = Invoice::find($id);
        if($invoice)
            $invoice->delete();
        return redirect('/draft_invoices')->withErrors('Invoice deleted successfully.');
    }
    public function update(Request $request){
        $data = $request->all();
        $invoice = Invoice::find($data['id']);
        $invoice->client = $data['client'];
        $invoice->client_id = $data['client_id'];
        $invoice->total = $data['total'];
        if($data['submit'] == 'send'){
            $invoice->final = 1;
            $invoice->status = 'pending';
        }else{
            $invoice->final = 0;
            $invoice->status = 'draft';
        }
        $invoice->data = json_encode($data);
        $invoice->save();

        if($request->hasFile('logo')){
            $imageName = time() . '.' . request()->logo->getClientOriginalExtension();
            $invoice->logo = $imageName;
            $invoice->save();
            request()->logo->move(public_path('images/user/'), $imageName);
        }
//        dd($invoice);
        return redirect('/invoice_'.$invoice->id);
    }
}
