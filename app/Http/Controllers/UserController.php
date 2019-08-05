<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    }

    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request
     */
    public function getUsers(Request $request)
    {
        $columns = array(
            0 =>'id',
            1 =>'name',
            2=> 'email',
            3=> 'level'
        );

        $totalData = User::count();

        $totalFiltered = $totalData;

        $limit = $request->input('length');
        if (!isset($limit)) {
            $limit = 10;
        }
        $start = $request->input('start');
        if (!isset($start)) {
            $start = 0;
        }

        $order = $columns[$request->input('order.0.column')];
        $dir   = $request->input('order.0.dir');

        $search = $request->input('search.value');
        if(!isset($search) || empty($search))
        {
            $users = User::offset($start)
                ->limit($limit)
                ->orderBy($order,$dir)
                ->get();
        }
        else
        {
            $users =  User::
            where('id','LIKE',"%{$search}%")
                ->orWhere('name', 'LIKE',"%{$search}%")
                ->orWhere('email', 'LIKE',"%{$search}%")
                ->orWhere('level', 'LIKE',"%{$search}%")
                ->offset($start)
                ->limit($limit)
                ->orderBy($order,$dir)
                ->get();

            $totalFiltered = User::
            where('id','LIKE',"%{$search}%")
                ->orWhere('name', 'LIKE',"%{$search}%")
                ->orWhere('email', 'LIKE',"%{$search}%")
                ->orWhere('level', 'LIKE',"%{$search}%")
                ->count();
        }

        $data = array();
        if(!empty($users))
        {
            foreach ($users as $user)
            {
                $edit  = route('users.edit',$user->id);
                $deact = route('users.destroy',$user->id);

                $nestedData['id']     = $user->id;
                $nestedData['name']   = $user->name;
                $nestedData['email']  = $user->email;
                $nestedData['level']  = $user->level=="admin" ? "Administrador" : "Usuario";
                $nestedData['actions']=
                    "<a href='$edit' title='Editar' class='btn btn-warning btn-sm'>
                        <span class='fa fa-edit'></span></a>
                    &nbsp;
                    <a href='$deact' title='Desactivar' class='btn btn-danger btn-sm'><span class='fa fa-trash'></span></a>";
                $data[] = $nestedData;

            }
        }

        $json_data = array(
            "draw"            => intval($request->input('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $data
        );

        echo json_encode($json_data);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
