<?php

namespace App\Http\Controllers;

use Illuminate\Database\QueryException;
use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $where = $orders = [];

        if ($request->has('filter_name') && !empty($request->filter_name)) {
            $where[] = ['name', 'like', "%{$request->filter_name}%"];
            $orders[] = ['name','asc'];
        }
        if ($request->has('filter_email') && !empty($request->filter_email)) {
            $where[] = ['email', 'like', "%{$request->filter_email}%"];
            $orders[] = ['email','asc'];
        }
        if ($request->has('filter_contact') && $request->filter_contact != '') {
            $where[] = ['contact', 'like', "%{$request->filter_contact}%"];
            $orders[] = ['contact','asc'];
        }

        $collection = User::where($where)
        // Conditionally use $orderBy if not empty
        ->when(!empty($orders), function ($query) use ($orders) {
            // Iterate over the pairs
            foreach ($orders as $pair) {
                // Use the 'splat' to turn the pair into two arguments
                $query->orderBy(...$pair);
            }
        })->paginate(5);

        return view('home', compact('collection'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response JSON
     */
    public function store(UserRequest $request)
    {
        $success = false;

        $request->validated();

        $user = User::find($request->id);

        $request->validate([
            'email' => [Rule::unique('users')->ignore($user)],
            'contact' => [Rule::unique('users')->ignore($user)],
        ],[
            'email.unique' => 'Email já existente !',
            'contact.unique' => 'Contato já existente !',
        ]);


        if(empty($user->id)){
            $user = new User;
            $msg = "Contato incluído com sucesso !";
        } else {
            $msg = "Contato alterado com sucesso !";
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->contact = $request->contact;

        $user->password = bcrypt('@1234');

        try{
            $success = $user->save();
        } catch(QueryException $e){
            $msg = $e->getMessage();
        }

        if($success != false){
            return redirect()->route('user.index')->with($msg);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id = null)
    {
        $user = User::find($id);

        return view('users.edit',compact('user'));
    }

    /**
     * Delete record
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $user = User::find($id);

        return view('users.delete',compact('user'));
    }

    /**
     * Delete record
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $user = User::find($request->id);
        $user->delete();

        return redirect()->route('user.index');
    }

}
