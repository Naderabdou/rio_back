<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Question;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\QuestionRequest;

class QuestionController extends Controller
{
    public function index()
    {
        $questions = Question::all();
        return view('dashboard.questions.index', compact('questions'));
    }


    public function create()
    {
        return view('dashboard.questions.create');
    }

    public function store(QuestionRequest $request)
    {
        Question::create($request->validated());
        return redirect()->route('admin.questions.index')->with('success', transWord('Question created successfully'));
    }

    public function edit(Question $question)
    {
        return view('dashboard.questions.edit', compact('question'));
    }

    public function update(QuestionRequest $request , Question $question){
             $question->update($request->validated());
             return redirect()->route('admin.questions.index')->with('success', transWord('Question updated successfully'));
    }

    public function destroy(Question $question)
    {
        $question->delete();
        return response()->json(['message' => transWord('Question deleted successfully')] , 200);
    }

    public function show($id){
        return redirect()->route('admin.questions.index');
    }
}
