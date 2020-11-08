<?php

namespace App\Http\Controllers;

use App\Profile;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('profile/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $profile = new Profile();

        $input = $request->all();
        $input['interest'] = $request->input('interest');
        // Profile::create($input);

        $profile->gender = $request->gender;
        $profile->address = $request->address;
        $profile->dob = $request->dob;
        $profile->phone_number = $request->phone_number;
        $profile->school_name = $request->school_name;
        $profile->interest = $input['interest'];

        $your_photo = time().'.'.$request->your_photo->extension();  
        $request->your_photo->move(public_path('images/your_photos'), $your_photo);
        $profile->your_photo = $your_photo;

        $citizenship_photo = time().'.'.$request->citizenship_photo->extension();  
        $request->citizenship_photo->move(public_path('images/citizenship_photos'), $citizenship_photo);
        $profile->citizenship_photo = $citizenship_photo;

        $marksheet_photo = time().'.'.$request->marksheet_photo->extension();  
        $request->marksheet_photo->move(public_path('images/marksheet_photos'), $marksheet_photo);
        $profile->marksheet_photo = $marksheet_photo;
        $profile->user_id = Auth::user()->id;
        
        $profile->save();

        $user = User::findOrFail(Auth::user()->id);
        $user->profile_id = 0;
        $user->save();
        return redirect()->route('home');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function show(Profile $profile)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function edit(Profile $profile)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Profile $profile)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function destroy(Profile $profile)
    {
        //
    }
}
