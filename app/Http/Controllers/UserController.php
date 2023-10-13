<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\User;
use App\CalItem;
use App\CalLocation;
use Illuminate\Validation\Rule;
use Auth;
use Illuminate\Http\Request;
use Response;
use Validator;
use Mail;
use Config;
use Hash;
use Storage;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $title = 'Home';
        // $dataItem = CalItem::whereRaw('LOWER(company) like (?)', [strtolower(@Auth::user()->company)]);
        // if(isset($request->location) && $request->location != ''){
        //     $dataItem->where('location_id',$request->location)->get();
        // }
        // $data = $dataItem->get();
        $data = CalItem::where('location_id',Auth::user()->company_id)->get();
        $locations = CalLocation::whereRaw('LOWER(company) like (?)', [strtolower(@Auth::user()->company)])->get();
        return view('home')->with(compact('title','data','locations'));
    }

    public function thankyou()
    {
        $title = 'Thankyou';
        return view('thankyou', compact('title'));
    }

    public function login()
    {
        if(@Auth::user()){
            return redirect('home');
        }else{
            $title = 'Login';
            return view('login', compact('title'));
        }
    }

    public function signup()
    {
        $title = 'Signup';
        $locations = CalLocation::all();
        return view('signup')->with(compact('title','locations'));
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            //'user_name'   => ['required', Rule::unique('calusers')],
            'first_name'  => 'required',
            'last_name'   => 'required',
            'email'       => ['required', 'email', 'max:255', Rule::unique('calusers')],
            'phone' => ['required', 'numeric', 'Integer'],
            //'password'    => 'required|min:6|confirmed',
            'company'     => 'required',
            'address'     => 'required',
            'city'        => 'required',
            'state'       => 'required',
            'zip'         => 'required',
            //'company_id'     => 'required',
        ]);
        if($validator->fails()){
            return back()->withInput()->withErrors($validator->errors()->all());
        }
        //try{
            $data = $request->all();
            //$data['password'] = \Hash::make($request->password);
            if($request->has('avatar'))
            {
                $file = $request->avatar;
                $target_dir = "user_profiles/";
                $extension = $file->getClientOriginalExtension();
                $filename = rand(100000, 999999).time(). ".".$extension;
                if($extension != "jpg" && $extension != "png" && $extension != "jpeg" && $extension != "gif" ) {
                    return back()->with('error',trans("Sorry, only JPG, JPEG, PNG & GIF files are allowed."));
                }
                Storage::disk(Config::get('constants.DISK'))->put($target_dir.$filename, file_get_contents($file), 'public');
                $data['avatar'] = $filename;
            }
            $user = User::create($data);
            $user = User::with('calcompany')->where('id',$user->id)->first();
            $maildata = array('name'=>$user->first_name,'company'=>$user->company);
            $email = $request->email;
            Mail::send('emails.thank', $maildata, function($message) use ($email) {
                $message->to($email)
                        ->subject('Thank You');
            });
            $maildata = array(
                //'user_name'=>$user->user_name,
                'first_name'=>$user->first_name,
                'last_name'=>$user->last_name,
                'email'=>$user->email,
                'company'=>$user->company,
                'address'=>$user->address,
                'city'=>$user->city,
                'state'=>$user->state,
                'zip'=>$user->zip,
                'phone'=>$user->phone,
                //'calcompany'=>$user->calcompany->name,
            );
            $email = Config::get('constants.ADMIN_MAIL');
            Mail::send('emails.register', $maildata, function($message) use ($email) {
                $message->to($email)
                        ->subject('User Register');
            });
            return redirect('thankyou');
        // }catch(\Exception $e){
        //     return back()->with('error','Something went wrong.please try again!');
        // }
        
    }

    public function signin(Request $request)
    {
        $credentials = $request->only('email','password');
        //try {
            if (!Auth::attempt($credentials)) {
                return back()->with('error','Email and Password not on file.');
            }else{
                if(Auth::user()->is_active == 1){
                    return redirect('home');
                }else{
                    Auth::logout();
                    return back()->with('error','Your account is currently under review. Please try after account is confirmed!');
                }
            }
        // } catch (\Exception $e) {
        //     return back()->with('error','Email and Password not on file.');
        // }
    }

    public function logout(Request $request)
    {
        try{
            Auth::logout();
            return redirect('/');
        }catch(\Exception $e){
            return back()->with('error','Something went wrong.please try again!');
        }
    }

    public function forgot()
    {
        $title = 'Forgot';
        return view('forgot', compact('title'));
    }

    public function resetPassword(Request $request){
        $validator = Validator::make($request->all(), [
            'email'  => ['required', 'email']
        ]);
        if($validator->fails()){
            return back()->withErrors($validator->errors()->all());
        }
        try{
            if($request->email != "") {
                $checkEmail = User::where('email',$request->email)->first();
                if(!empty($checkEmail)){
                    if($checkEmail->password != null && $checkEmail->password != ''){
                        $random = str_shuffle('abcdefghjklmnopqrstuvwxyzABCDEFGHJKLMNOPQRSTUVWXYZ234567890!$%^&!$%^&');
                        $password = substr($random, 0, 10);
                        $new_password = \Hash::make($password);
                        $data = array('name'=>$checkEmail->first_name,'email'=>$checkEmail->email,"password" => $password,'company'=>$checkEmail->company);
                        Mail::send('emails.forgot', $data, function($message) use ($request) {
                            $message->to($request->email)
                                    ->subject('Forgot Password');
                        });
                        User::where('id',$checkEmail->id)->update(array('password' => $new_password));
                        return redirect('/')->with('success','Your account information has been sent. Please check your email.');
                    }else{
                        return back()->with('error','Your password is not created. Please contact cal@com-power.com if you have any questions.');
                    }
                }else{
                    return back()->with('error','We could not verify that you have an account with us. Please contact 
                     cal@com-power.com if you have any questions.');
                }
            } else  {
                return back()->with('error','We could not verify that you have an account with us. Please contact 
                cal@com-power.com if you have any questions.');
            }
        }catch(\Exception $e){
            return back()->with('error','Something went wrong.please try again!');
        }
    }

    public function settings()
    {
        $title = 'Settings';
        return view('settings', compact('title'));
    }

    public function profile(Request $request) 
    {   
        $user = Auth::getUser();   
        $validator = Validator::make($request->all(), [
            'first_name'  => 'required',
            'last_name'   => 'required',
            // 'email'       => 'required|email|unique:calusers,email,'.$user->id,
            'phone'       => 'required|numeric',
            // 'company'     => 'required',
            'address'     => 'required',
            'city'        => 'required',
            'state'       => 'required',
            'zip'         => 'required'
        ]);
        if($validator->fails()){
            return back()->withErrors($validator->errors()->all());
        }
        try{
            $data = $request->only('first_name','last_name','phone','address',
            'city','state','zip');
            if($request->has('avatar'))
            {
                if($user->avatar){
                    $path = 'user_profiles/'.$user->avatar;
                    Storage::disk(Config::get('constants.DISK'))->delete($path);
                }
                $file = $request->avatar;
                $target_dir = "user_profiles/";
                $extension = $file->getClientOriginalExtension();
                $filename = rand(100000, 999999).time(). ".".$extension;
                if($extension != "jpg" && $extension != "png" && $extension != "jpeg" && $extension != "gif" ) {
                    return back()->with('error',"Sorry, only JPG, JPEG, PNG & GIF files are allowed.");
                }
                Storage::disk(Config::get('constants.DISK'))->put($target_dir.$filename, file_get_contents($file), 'public');
                $data['avatar'] = $filename;
            }
            User::where('id',$user->id)->update($data);
            return redirect('settings')->with('success','Profile updated succesfully.');
        }catch(\Exception $e){
            return back()->with('error',$e->getMessage());
        }
    }

    public function changePassword(Request $request) 
    {      
        $validator = Validator::make($request->all(), [
            'password'  => 'required',
            'new_password' => 'required|min:6'
        ]);
        if($validator->fails()){
            return back()->withErrors($validator->errors()->all());
        }        
        try{
            $user = Auth::getUser();
            if (Hash::check($request->get('password'), $user->password)) {
                $user->password = Hash::make($request->get('new_password'));
                $user->save();
                return redirect('settings')->with('success','Password change successfully!');
            } else {
                return back()->with('error','Current password is incorrect.');
            }
        }catch(\Exception $e){
            return back()->with('error','Something went wrong.please try again!');
        }
    }

}
