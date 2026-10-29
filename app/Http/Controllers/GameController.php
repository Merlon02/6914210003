<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GameController extends Controller
{
    public function index()
    {
        $games = Game::latest()->get();

        if ($games->isEmpty()) {
            $games = collect([
                (object)[
                    'id' => 1,
                    'title' => 'CALL OF DUTY: MODERN WARFARE 4 XBOX SERIES X|S|PC (WW)',
                    'image' => 'https://images.unsplash.com/photo-1542751371-adc38448a05e?w=500&auto=format&fit=crop&q=60',
                    'price' => 2395.49,
                    'discount' => '26% OFF',
                    'stock_qty' => 15
                ]
            ]);
        }

        return view('games.index', compact('games'));
    }

    public function stock()
    {
        $games = Game::all();
        return view('games.stock', compact('games'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'price' => 'required|numeric',
            'stock_qty' => 'required|integer|min:0',
            'image' => 'required|url',
        ]);

        Game::create($request->all());

        return redirect()->route('games.stock')->with('success', 'เพิ่มสินค้าเข้าสต็อกเรียบร้อย!');
    }

    public function show($id)
    {
        $game = Game::find($id);
        
        if (!$game) {
            $game = (object)[
                'id' => $id,
                'title' => 'Call of Duty: Modern Warfare 4 Xbox Series X|S/PC (WW) Key',
                'image' => 'https://images.unsplash.com/photo-1542751371-adc38448a05e?w=800&auto=format&fit=crop&q=60',
                'price' => 2395.49,
                'discount' => '26% OFF',
                'stock_qty' => 15
            ];
        }

        return view('games.show', compact('game'));
    }

    public function processPayment(Request $request, $id)
    {
        // ตรวจสอบว่าเข้าสู่ระบบหรือยัง ถ้ายังให้ดีดไปหน้า Login พร้อมแจ้งเตือน
        if (!Auth::check()) {
            return redirect()->route('games.login')->with('error', 'กรุณาเข้าสู่ระบบก่อนทำการซื้อสินค้า');
        }

        $game = Game::find($id);
        if ($game && $game->stock_qty > 0) {
            $game->stock_qty -= 1;
            $game->save();
        }

        return redirect()->route('games.index')->with('success', 'ชำระเงินสำเร็จ! คำสั่งซื้อของคุณเสร็จสมบูรณ์');
    }

    public function search(Request $request)
    {
        $keyword = $request->input('query');
        $game = Game::where('title', 'LIKE', "%{$keyword}%")->first();

        if ($game) {
            return redirect()->route('games.show', $game->id);
        }

        return redirect()->back()->with('error', 'ไม่พบเกมที่คุณค้นหา');
    }

    public function login()
    {
        return view('games.login');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // ตรวจสอบข้อมูลเข้าสู่ระบบและสร้างเซสชัน
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            // ล็อกอินสำเร็จ พาไปหน้า Personal Info
            return redirect()->route('customer.account');
        }

        return back()->withErrors([
            'email' => 'อีเมลหรือรหัสผ่านไม่ถูกต้อง',
        ]);
    }

    public function account()
    {
        if (!Auth::check()) {
            return redirect()->route('games.login');
        }
        $user = Auth::user();
        return view('games.account', compact('user'));
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('games.index');
    }
}