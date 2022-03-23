<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CustomUser;

class CustomUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$users = CustomUser::all()->toArray();
        $users = CustomUser::latest()
        ->get()
        ->map(function($user) {
            
            if(empty($user->photo)){
                $user->photo = asset('uploads/no-image.png');
            }else{
                $user->photo = asset($user->photo);
            }
            
            return $user;
        })->toArray();

        return array_reverse($users);  
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = $request->validate([
            'name' => 'required',
            'surname' => 'required',
            'email' => 'required|email|unique:custom_users',
            'phone' => 'required',
            'company' => 'required',
            'address' => 'required',
            'file' => 'mimes:jpeg,jpg,png|nullable|max:10000',
        ]);
        
     
        $userImg = null;
        if ($request->hasFile('file'))
        {
            $image = $request->file('file');
            $filename  = rand(11111,99999) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/'), $filename);
            $userImg= 'uploads/'.$filename;
        }
        
        $product = new CustomUser([
            'name' => $request->input('name'),
            'surname' => $request->input('surname'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'company' => $request->input('company'),
            'address' => $request->input('address'),
            'photo' => $userImg
        ]);
        $product->save();
        $data = CustomUser::find($product->id);
        if(empty($data->photo)){
            $data->photo = asset('uploads/no-image.png');
        }else{
            $data->photo = asset($data->photo);
        }
        return response()->json(['error' => false, 'data' => $data, 'message' => 'User created!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CustomUser  
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = CustomUser::find($id);
        if(empty($data)){
            return response()->json(['error' => false, 'data' => '']);
        }
        // Add full url of photo
        if(empty($data->photo)){
            $data->photo = asset('uploads/no-image.png');
        }else{
            $data->photo = asset($data->photo);
        }    
        return response()->json(['error' => false, 'data' => $data]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CustomUser  $customUser
     * @return \Illuminate\Http\Response
     */
    public function edit(CustomUser $customUser)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CustomUser  $customUser
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CustomUser $customUser)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CustomUser  $customUser
     * @return \Illuminate\Http\Response
     */
    public function destroy(CustomUser $customUser)
    {
        //
    }
}
