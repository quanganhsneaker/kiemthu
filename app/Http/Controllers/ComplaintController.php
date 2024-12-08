<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use Illuminate\Http\Request;

class ComplaintController extends Controller
{
    //
    // Hàm lưu khiếu nại từ người dùng
    public function store(Request $request)
    {
        // Validate dữ liệu
        $validatedData = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'product_id' => 'required|string',
            'phone' => 'required|numeric',
            'gender' => 'required|string',
            'product' => 'required|string',
            'complaint_message' => 'required|string',

        ]);

        // Lưu khiếu nại vào database
        Complaint::create($validatedData);

        return redirect()->back()->with('success', 'Khiếu nại của bạn đã được gửi!');
    }

    // Hàm hiển thị danh sách khiếu nại cho admin
    public function index()
    {
        $title = 'Danh sách khiếu nại';
        $danhsachkhieunai = Complaint::all();
        return view('admin.complaints', compact('danhsachkhieunai','title'));
    }
    public function confirm($id)
{
    $complaint = Complaint::findOrFail($id);
    $complaint->update(['status' => 1]);

    return redirect()->route('admin.complaints')->with('success', 'Khiếu nại đã được xác nhận!');
}

}
