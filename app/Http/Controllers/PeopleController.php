<?php

namespace App\Http\Controllers;

use App\People;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use DB;

class PeopleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $people = People::all();
        return Datatables::of($people)->addColumn('action', function ($people) {
                return '<button class="btn btn-danger delete" data-id = "'.$people->id.'" data-token="'.csrf_token().'"> Delete</button> 
                <button class="btn btn-primary edit-model" data-id = "'.$people->id.'" data-name = "'.$people->name.'" data-email = "'.$people->email.'" data-contact = "'.$people->contact.'" > Edit</button>';
            })
            ->editColumn('id', '{{$id}}')
            ->make(true);
        //return view('peoplesdata')->with('people', $people);
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
        $people = new People();
        $people->name = $request['name'];
        $people->email = $request['email'];
        $people->contact = $request['contact'];
        $people->password = bcrypt($request['password']);
        if($people->save())
            $request->session()->flash('status', 'People Data Add Succussfully !!!');
        return Response($people);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\People  $people
     * @return \Illuminate\Http\Response
     */
    public function show(People $people)
    {
        //
        return view('peoplesdata');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\People  $people
     * @return \Illuminate\Http\Response
     */
    public function edit(People $people)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\People  $people
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id = $request['id'];
        $data = DB::table('people')
                ->where('id', $id)
                ->update(['name'=>$request['name'],
                          'email'=>$request['email'],
                          'contact'=>$request['contact']
                        ]);
        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\People  $people
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $data = DB::delete('delete from people where id = ?', [$id]);
        return Response($data);
    }

    /**
     * Search the resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    /*public function searchquery(Request $request)
    {
        if($request->ajax())     
        {     
            $output="";     
            $products=DB::table('people')->where('name','LIKE','%'.$request->search."%")
                                         ->orWhere('email','LIKE','%'.$request->search."%")
                                         ->orWhere('contact','LIKE','%'.$request->search."%")
                                         ->get();    
            if($products)    
            { 
                foreach ($products as $key => $product) {   
                    $output.='<tr>'.     
                    '<td>'.$product->name.'</td>'.     
                    '<td>'.$product->email.'</td>'.     
                    '<td>'.$product->contact.'</td>'. 
                    '<td>'.'<button class="btn btn-danger delete" data-id = "'.$product->id.'" data-token="'.csrf_token().'"> Delete</button> 
                <button class="btn btn-primary edit-model" data-id = "'.$product->id.'" > Edit</button>'.'</td>'.
                    '</tr>';  
                }
            return Response($output);
            }
        }
    }*/
}
