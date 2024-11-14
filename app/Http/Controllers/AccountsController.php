<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Accounts;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
class AccountsController extends Controller
{
    //GET//accounts/
    public function index()
    {
        $accounts = Accounts::all();
        return response()->json($accounts);
    }
    //GET//accounts/{id}
    public function show($id)
    {
        return Accounts::find($id);
    }
    //POST//accounts/

    public function store(Request $request)
    {
        try {
            // Validate input
            $request->validate([
                'full_name' => 'required|string|max:100',
                'email' => 'nullable|email|max:100|unique:accounts,email',
                'password' => 'required|string|min:6|max:100',
                'phone' => 'nullable|string|max:10',
                'status' => 'nullable|string|max:25',
                'role' => 'nullable|string|max:10',
            ]);

            $account = new Accounts();
            $account->full_name = $request->full_name;
            $account->email = $request->email;
            $account->password = bcrypt($request->password); // Mã hóa mật khẩu
            $account->phone = $request->phone;
            $account->status = $request->status;
            $account->role = $request->role;
            $account->save();

            return response()->json($account, 201);
        } catch (\Exception $e) {
            Log::error('Error creating account: ' . $e->getMessage());
            Log::error('Stack Trace: ' . $e->getTraceAsString());
            return response()->json(['error' => 'Account creation failed'], 500);
        }
    }

    //PATCH//accounts/{id}
    public function update(Request $request,$id){
        try{
            $account = Accounts::find($id);
            $request->validate([
                'full_name' => 'required|string|max:100',
                'email' => 'nullable|email|max:100|unique:accounts,email',
                'password' => 'required|string|min:6|max:100',
                'phone' => 'nullable|string|max:10',
                'status' => 'nullable|string|max:25',
                'role' => 'nullable|string|max:10',
            ]);
            $account->full_name = $request->full_name;
            $account->email = $request->email;
            $account->password = bcrypt($request->password); // Mã hóa mật khẩu
            $account->phone = $request->phone;
            $account->status = $request->status;
            $account->role = $request->role;
            $account->save();

            return response()->json($account, 201);
        }catch(\Exception $e){
            Log::error('Error updating account: ' . $e->getMessage());
            Log::error('Stack Trace: ' . $e->getTraceAsString());
            return response()->json(['error' => 'Account update failed'], 500);
        }
    }
    //DELETE//accounts/{id}
    public function delete($id){
        try{
            $account = Accounts::find($id);
            $account->delete();
            return response()->json(null, 204);
        }catch(\Exception $e){
            Log::error('Error deleting account: ' . $e->getMessage());
            Log::error('Stack Trace: ' . $e->getTraceAsString());
            return response()->json(['error' => 'Account deletion failed'], 500);
        }
    }
//Login 
public function login(Request $request)
{
    $email = $request->query('email');
    $password = $request->query('password');

    // Tìm người dùng dựa trên email và mật khẩu
    $user = Accounts::where('email', $email)->first();

    // Kiểm tra mật khẩu
    if ($user && $password == $user->password) {
        return response()->json([
            // 'status' => 'success',
             $user
        ]);
    }

    return response()->json([
        'status' => 'error',
        'message' => 'Invalid email or password'
    ], 401);
}

}
