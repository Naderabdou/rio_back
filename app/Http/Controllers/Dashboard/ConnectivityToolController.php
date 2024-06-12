<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\ToolRequest;
use App\Models\ConnectivityTool;
use App\Repositories\Contract\ConnectivityToolRepositoryInterface;
use Illuminate\Http\Request;

class ConnectivityToolController extends Controller
{
    public function __construct(protected ConnectivityToolRepositoryInterface $connectivityToolRepo)
    {
    }

    public function index()
    {
        $tools = $this->connectivityToolRepo->getAll();

        return view('dashboard.tools.index', compact('tools'));
    }

    public function edit(ConnectivityTool $tool)
    {
        return view('dashboard.tools.edit', compact('tool'));
    }

    public function update(ToolRequest $request, ConnectivityTool $tool)
    {
        $data = $request->except('_token', '_method');

        $tool->update($data);

        return redirect()->route('admin.tools.index')->with('success', transWord('تم التعديل بنجاح'));
    }

    public function toggle($id)
    {
        $tool = $this->connectivityToolRepo->findOne($id);

        if (!$tool->enabled) {
            $tool->update(['enabled' => true]);

            return redirect()->back()->with('success', transWord('تم التفعيل بنجاح'));
        } else {
            $tool->update(['enabled' => false]);

            return redirect()->back()->with('success', transWord('تم إلغاء التفعيل بنجاح'));
        }
    }
}
