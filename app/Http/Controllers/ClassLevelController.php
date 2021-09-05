<?php

namespace App\Http\Controllers;

use App\Http\Resources\ClassLevelResource;
use App\Models\ClassLevel;
use Illuminate\Http\Request;

class ClassLevelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ClassLevelResource::collection(ClassLevel::paginate(10));
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
        $data = $request->validate([
            'name' => 'required | string',
            'year'=> 'required | string',
            'level_id'=> 'required'
        ]);
        $classlevel = ClassLevel::create($data);
        if($classlevel){
            return new ClassLevelResource($classlevel);
        }
        return $this->responseMessage('Something went wrong', 500);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ClassLevel  $classLevel
     * @return \Illuminate\Http\Response
     */
    public function show(ClassLevel $classLevel)
    {
        return new ClassLevelResource($classLevel);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ClassLevel  $classLevel
     * @return \Illuminate\Http\Response
     */
    public function edit(ClassLevel $classLevel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ClassLevel  $classLevel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ClassLevel $classLevel)
    {
        $data = $request->validate([
            'name'=> 'required',
            'year'=> 'required',
            'level_id'=> 'required'
        ]);

        if($classLevel->update([
            'name'=> $data['name'],
            'year'=> $data['year'],
            'level_id' => $data['level_id']
        ])){
            return new ClassLevelResource($classLevel);
        }
        return $this->responseMessage("Something went wrong", 500);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ClassLevel  $classLevel
     * @return \Illuminate\Http\Response
     */
    public function destroy(ClassLevel $classLevel)
    {
        if($classLevel->delete()){
          return $this->responseMessage("Class deleted", 200);
        }
        return $this->responseMessage("Something went wrong", 500);
    }
}
