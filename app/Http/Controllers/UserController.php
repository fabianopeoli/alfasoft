<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use App\Models\User;

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
        $request->validated();

        $success_text = '';

        $user = User::find($request->id);

        if(empty($user->id)){
            $user = new User;
            $is_new = true;
            $success_text = 'incluído';
        } else {
            $success_text = 'alterado';
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->contact = $request->contact;

        // $user->password = bcrypt('@1234');

        $user->save();

        $msg = "Usuário {$success_text} com sucesso !";

        return redirect()->intended(route('user.index'))->with($msg);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response JSON
     */
    public function show($id)
    {
        $user = User::find($id);

        return response()->json($user, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, $redirect = null)
    {
        $user = User::find($id);

        return view('users.edit',compact('user'));
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
        //
    }

}
