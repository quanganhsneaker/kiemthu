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
        $validatedData = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'product_id' => 'required|string',
            'phone' => 'required|numeric',
            'gender' => 'required|string',
            'product' => 'required|string',
            'complaint_message' => 'required|string',
        ], [
            'name.required' => 'Vui lòng nhập họ và tên.',
            'email.required' => 'Vui lòng nhập email.',
            'email.email' => 'Email không đúng định dạng.',
            'product_id.required' => 'Vui lòng nhập mã sản phẩm.',
            'phone.required' => 'Vui lòng nhập số điện thoại.',
            'phone.numeric' => 'Số điện thoại phải là số.',
            'gender.required' => 'Vui lòng chọn giới tính.',
            'product.required' => 'Vui lòng chọn lý do khiếu nại.',
            'complaint_message.required' => 'Vui lòng nhập nội dung khiếu nại.',
        ]);
    
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
