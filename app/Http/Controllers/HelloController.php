<?php

namespace App\Http\Controllers;
use App\User;
use App\Models\Data;
use App\Http\Requests\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Mail\Sendmail;
use Illuminate\Support\Facades\Auth;
use Mail;
use Validator;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\AjaxRequest;

class HelloController extends Controller
{

    public function form_js(){
        return view('form_js');
    }

    public function ajax_add(AjaxRequest $request) {

        // $input = $request->only('name', 'email');
        // $data_tbl = new Data;
        // $data_tbl->subject = $input['name'];
        // $data_tbl->email = $input['email'];
        // $data_tbl->message = $input['name'];
        // $data_tbl->save();
        // // DB::table('users')->insert(
        // //     ['email' => 'john@example.com', 'name' => 'hjah']
        // // );
        // // $user_tbl->name = $input['name'];
        // // $user_tbl->email = $input['email'];
        // // $user_tbl->save();
        // $items = response()->json($input);
        // return $items;
        return '成功';
    }

    public function index(){
        $items = DB::table('users')->get();

       // var_export($items);
        return view('welcome', compact('items'));
    }
    //API
    public function show(){
       // var_export($items);
       
        return DB::table('users')->get();
    }
    
    public function get_data_tbl(){
        return DB::table('datas')->get();
     }

    public function add(Request $request) {

        $input = $request->only('name', 'email');
        $data_tbl = new Data;
        $data_tbl->subject = $input['name'];
        $data_tbl->email = $input['email'];
        $data_tbl->message = $input['name'];
        $data_tbl->save();
        // DB::table('users')->insert(
        //     ['email' => 'john@example.com', 'name' => 'hjah']
        // );
        // $user_tbl->name = $input['name'];
        // $user_tbl->email = $input['email'];
        // $user_tbl->save();
        $items = response()->json($input);
        return $items;
    }

    public function list()
    {
        //$items =Data::all();

        $items = Data::paginate(5);
        return view('list', compact('items'));
    }

    public function del($id)
    {
        Data::destroy($id);
        return view('thanks');
    }

    public function edit($id)
    {
        $items = Data::find($id);
        return view('edit_form',compact('items'));
    }

    public function edit_post(Request $request){
        $input = $request->only('id', 'name', 'email', 'subject', 'message');
        //\var_dump($input);
        $message = [
            'name.required' => '名前を入力してください',
            'subject.required' => '整数で入力してください',
            'email.email' => 'メールアドレスを入力してください',
            'message.required' => 'メッセージを入力してください',
        ];
		$validator = Validator::make($request->all(), [
            'name' => 'required',
            'subject' => 'required',
            'email' => 'email:strict',
            'message' => 'required',
        ],$message);

        if ($validator->fails()) {
            return redirect(route('edit', [
                'id' => $input['id'],
            ]))
            ->withErrors($validator)
            ->withInput();
        } else {
        //セッションに書き込む
            $request->session()->put("post", $input);
            return redirect()->route("edit.confirm");

        }
    }

    public function edit_confirm(Request $request){
        //セッションから値を取り出す
		$input = $request->session()->get("post");
		
		//セッションに値が無い時はフォームに戻る
		if(!$input){
			return redirect()->action("HelloController@show");
		}
		return view("edit_confirm",["input" => $input]);
    }

    public function edit_end (Request $request){
        $action = $request->input('action');
        if($request->session()->has('post')){
            $input = $request->session()->get("post");
        }
        switch ($action){
            case 'send':
                //Mail::to('ponponhoohoo@yahoo.co.jp')->send(new Sendmail($input));
                Data::updateOrCreate(
                    ['id' => $input['id']],
                    ['subject' => $input['subject'], 'email' => $input['email'] , 'message' => $input['message']]
                );
                $request->session()->forget("post");
                return view('thanks');
              break;
            case 'back':
                return redirect()->route("edit",[
                    'id' => $input['id'],
                ])->withInput($input);
              break;
            default:
            return redirect()->route("edit");
        }
    }

    public function form(Request $request){
		if($request->session()->has('post')){
            $request->session()->forget("post");
        }
        return view('form');
    }

    public function post(Request $request){
        $input = $request->only('name', 'email', 'subject', 'message');
        $message = [
            'name.required' => '名前を入力してください',
            'subject.required' => '整数で入力してください',
            'email.email' => 'メールアドレスを入力してください',
            'message.required' => 'メッセージを入力してください',
        ];
        
		$validator = Validator::make($request->all(), [
            'name' => 'required',
            'subject' => 'required',
            'email' => 'email:strict',
            'image_url'=>['mimes:jpeg,png,jpg,bmb','max:2048'],
            'message' => 'required',
        ],$message);

        if ($request->hasFile('image_url')) { //"photo" は input type の name属性
            $str = 'abcdef';
           // $file_name = $req->file('image_url')->store('public/upload');
            $path = $request->file('image_url')->storeAs('public/upload', date("Ymt").'_'. str_shuffle($str) . '.jpg');
        } 

        if ($validator->fails()) {
            return redirect('/form')
            ->withErrors($validator)
            ->withInput();
            
          } else {
            //セッションに書き込む
		    $request->session()->put("post", $input);
            return redirect()->route("form.confirm");
        }
    }
    
    public function confirm(Request $request){
        //セッションから値を取り出す
		$input = $request->session()->get("post");
		
		//セッションに値が無い時はフォームに戻る
		if(!$input){
			return redirect()->action("HelloController@show");
		}
		return view("confirm",["input" => $input]);
    }

    public function send(Request $request){
        $action = $request->input('action');
        if($request->session()->has('post')){
            $input = $request->session()->get("post");
        }
        switch ($action){
            case 'send':
                //Mail::to('ponponhoohoo@yahoo.co.jp')->send(new Sendmail($input));
                $data_tbl = new Data;

                $data_tbl->subject = $input['subject'];
                $data_tbl->email = $input['email'];
                $data_tbl->message = $input['message'];
                $data_tbl->save();
                $request->session()->forget("post");
                return view('thanks');
              break;
            case 'back':
                return redirect()->route("form.show",)->withInput($input);
              break;
            default:
            return redirect()->route("form.show");
        }
    }
}
