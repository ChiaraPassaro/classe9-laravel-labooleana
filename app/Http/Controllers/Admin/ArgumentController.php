<?php

namespace App\Http\Controllers\Admin;

use App\Argument;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use PhpParser\Node\Arg;

class ArgumentController extends Controller
{

    private $validateRules;
    public function __construct()
    {
        $this->validateRules = [
            'name' => 'required|unique:arguments|string|max:255'
        ];
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $arguments = Argument::all();
        
        return view('admin.arguments.index', compact('arguments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.arguments.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate($this->validateRules);
        $data = $request->all();
        
        $newArgument = new Argument;
        $newArgument->fill($data);
        $newArgument->user_id = Auth::id();

        $saved = $newArgument->save();

        if(!$saved) {
            return redirect()->back()->withInput();
        }

        return redirect()->route('admin.arguments.show', $newArgument);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Argument $argument)
    {
        if(empty($argument)){
            abort('404');
        }

        return view('admin.arguments.show', compact('argument'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $argument = Argument::find($id);

        if(empty($argument) || Auth::id() != $argument->user->id){
            abort('404');
        }
       
        $argument = $argument->first();
        // dd($argument);
        return view('admin.arguments.edit', compact('argument'));
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
        $request->validate($this->validateRules);
        $data = $request->all();

        $argument = Argument::find($id);

        if (empty($argument) || Auth::id() != $argument->user->id) {
            abort('404');
        }

        $argument->name = $data['name'];

        $updated = $argument->update();

        if (!$updated) {
            return redirect()->back()->withInput();
        }

        return redirect()->route('admin.arguments.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $argument = Argument::find($id);

        if (empty($argument) || Auth::id() != $argument->user->id) {
            abort('404');
        }

        $argument->articles()->detach();
        // dd($argument->articles);
        if($argument->articles->isEmpty()){
            $argument->delete();
            return redirect()->route('admin.arguments.index');
        }
        
        return redirect()->back();

    }
}
