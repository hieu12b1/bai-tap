<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Http\Requests\DanhMucRequest;
use App\Http\Services\UserService;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $userService;
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $title = "Danh người dùng";
        $params = [
            'per_page' => $request->input('per_page', User::DEFAULT_LIMIT),
            'name' => $request->input('name'),
            'phone' => $request->input('phone'),
            'email' => $request->input('email')
        ];
        
        $listUser = $this->userService->index($params);
        return view('admins.users.index', compact('title', 'listUser'));
    }

   /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $title = "Thông tin chi tiết người dùng";

        $user = User::query()->findOrFail($id);
        return view('admins.users.show', compact('title', 'user'));
    }
}
