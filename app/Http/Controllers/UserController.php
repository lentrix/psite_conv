<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function profile(User $user) {
        return view('users.profile', compact('user'));
    }

    public function create() {
        return view('users.create');
    }

    public function store(Request $request) {
        $this->validate($request, [
            'lname' => 'required|max:60',
            'fname' => 'required|max:60',
            'email' => 'required|email|unique:users',
            // 'password' => 'confirmed',
            'gender' => 'required',
            'designation' => 'required',
            'school' => 'required',
            'school_address' => 'required',
        ]);

        $user = User::create([
            'lname' => $request['lname'],
            'fname' => $request['fname'],
            'email' => $request['email'],
            'gender' => $request['gender'],
            'designation' => $request['designation'],
            'school' => $request['school'],
            'school_address' => $request['school_address'],
            'password' => bcrypt($request['password']),
        ]);

        return redirect("/profile/$user->id")->with('Success', 'New delegate successfully created.');
    }

    public function edit(User $user) {
        if(auth()->user()->id==$user->id || auth()->user()->admin) {
            return view('users.edit', compact('user'));
        }else {
            return redirect()->back()->with('Error','Sorry! Only the owner or an Administrator can edit a user profile.');
        }
    }

    public function update(User $user, Request $request) {
        if(auth()->user()->id==$user->id || auth()->user()->admin) {
            $this->validate($request, [
                'lname' => 'required|max:60',
                'fname' => 'required|max:60',
                'email' => 'required|email',
                'designation' => 'required',
                'school' => 'required',
                'school_address' => 'required',
            ]);

            $user->update($request->all());

            return redirect('/profile/' . $user->id)->with('Success','This user profile has been updated.');
        }else {
            return redirect()->back()->with('Error','Sorry! Only the owner or an Administrator can edit a user profile.');
        }
    }

    public function picture(User $user) {
        return view('users.picture', compact('user'));
    }

    public function setActive(Request $request) {
        $this->validate($request, [
            'user_id' => 'required|numeric',
            'active' => 'required|boolean'
        ]);

        $active = $request['active'];

        $user = User::find($request['user_id']);

        $user->active = $active;
        $user->save();

        return redirect()->back()->with('Success',"The user has been " . ($active?'activated':'deactivated'));
    }

    public function delegates() {
        $users = \App\User::orderByRaw('lname,fname')->get();
        return view('delegation.index', ['users'=>$users]);
    }

    public function changePasswordForm(User $user) {
        if(auth()->user()->admin || $user->id===auth()->user()->id)
            return view('users.change-password', compact('user'));

        return redirect()->back()->with('Error','Only the account owner or an administrator can change password.');
    }

    public function changePassword(User $user, Request $request) {
        if(!auth()->user()->admin && $user->id!==auth()->user()->id)
            return redirect()->back()->with('Error','Only the account owner or an administrator can change password.');

        $this->validate($request, [
            // 'old_password'=>['required', new \App\Rules\CheckPasswordRule($user)],
            'password' => ['required','confirmed'],
        ]);

        $user->password = bcrypt($request['password']);
        $user->save();

        return redirect("/profile/$user->id")->with('Success', 'The user password has been changed.');
    }

    public function avatar(Request $request) {
        if(auth()->user()->admin || auth()->user()->id==$request['user_id']){
            $image = $request['image-data'];  // your base64 encoded
            $image = str_replace('data:image/png;base64,', '', $image);
            $image = str_replace(' ', '+', $image);
            $imageName = $request['user_id'].'.'.'png';



            Storage::put('public/avatars/' . $imageName, base64_decode($image));

            return redirect("/profile/{$request['user_id']}");
        }

        return redirect()->back()->with("Error","Only the owner or an administrator can change avatar.");
    }

    public function importForm() {
        return view('users.import-form');
    }

    public function importUpload(Request $request) {
        $file_input = $request->file('csv_file');
        $file = fopen($file_input->getRealPath(), "r");

        $faker = \Faker\Factory::create();

        fgetcsv($file);

        while(!feof($file)) {
            $row = fgetcsv($file);
            $name_array = explode(",", $row[0]);
            $lastName = $name_array[0];
            $fname_mname_array = explode(" ", $name_array[1]);
            $firstName = implode(" ", array_splice($fname_mname_array, 0,-1));

            $tmpPass = $faker->text(5);
            User::create([
                'lname' => $lastName,
                'fname' => $firstName,
                'gender' => $row[7],
                'email' => $row[2],
                'password' => bcrypt($tmpPass),
                'school' => $row[4],
                'school_address' => $row[5],
                'designation' => $row[6],
                'tmp_password' => $tmpPass
            ]);
        }

        return redirect('/delegates');
    }
}
