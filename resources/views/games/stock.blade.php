<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>ระบบจัดการสินค้าและสต็อก (Stock POS)</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-[#0f0e26] text-white p-8">
    <div class="max-w-5xl mx-auto space-y-6">
        <div class="flex justify-between items-center bg-[#171638] p-6 rounded-lg border border-indigo-900">
            <h1 class="text-xl font-bold flex items-center gap-2">
                <i class="fa-solid fa-boxes-stacked text-indigo-400"></i> โมดูลสินค้าและสต็อก (Stock POS)
            </h1>
            <a href="{{ route('games.index') }}" class="text-sm bg-indigo-600 hover:bg-indigo-700 px-4 py-2 rounded transition">กลับหน้าร้านค้า</a>
        </div>

        @if(session('success'))
            <div class="bg-emerald-600/90 text-white p-4 rounded border border-emerald-400 text-sm">{{ session('success') }}</div>
        @endif

        <!-- Form เพิ่มสินค้า -->
        <div class="bg-[#171638] p-6 rounded-lg border border-indigo-900">
            <h2 class="text-lg font-semibold mb-4 text-gray-200">เพิ่มสินค้าใหม่เข้าระบบสต็อก</h2>
            <form action="{{ route('games.store') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-xs mb-1 text-gray-400">ชื่อเกม</label>
                    <input type="text" name="title" required class="w-full bg-[#0f0e26] border border-indigo-900 p-2.5 rounded text-sm text-white focus:outline-none focus:border-indigo-500">
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-xs mb-1 text-gray-400">ราคา (THB)</label>
                        <input type="number" step="0.01" name="price" required class="w-full bg-[#0f0e26] border border-indigo-900 p-2.5 rounded text-sm text-white focus:outline-none focus:border-indigo-500">
                    </div>
                    <div>
                        <label class="block text-xs mb-1 text-gray-400">จำนวนในสต็อก (ชิ้น)</label>
                        <input type="number" name="stock_qty" required min="0" value="10" class="w-full bg-[#0f0e26] border border-indigo-900 p-2.5 rounded text-sm text-white focus:outline-none focus:border-indigo-500">
                    </div>
                    <div>
                        <label class="block text-xs mb-1 text-gray-400">ส่วนลด (เช่น 20% OFF)</label>
                        <input type="text" name="discount" class="w-full bg-[#0f0e26] border border-indigo-900 p-2.5 rounded text-sm text-white focus:outline-none focus:border-indigo-500">
                    </div>
                </div>
                <div>
                    <label class="block text-xs mb-1 text-gray-400">URL รูปภาพ</label>
                    <input type="url" name="image" required class="w-full bg-[#0f0e26] border border-indigo-900 p-2.5 rounded text-sm text-white focus:outline-none focus:border-indigo-500">
                </div>
                <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 px-4 py-2.5 rounded text-sm font-bold w-full transition">
                    + บันทึกเพิ่มสินค้าเข้าสต็อก
                </button>
            </form>
        </div>

        <!-- รายการสต็อกปัจจุบัน -->
        <div class="bg-[#171638] p-6 rounded-lg border border-indigo-900">
            <h2 class="text-lg font-semibold mb-4 text-gray-200">รายการสต็อกปัจจุบันในระบบ</h2>
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm text-gray-300">
                    <thead class="bg-[#0f0e26] text-xs uppercase text-gray-400">
                        <tr>
                            <th class="p-3">สินค้า</th>
                            <th class="p-3">ราคา</th>
                            <th class="p-3">จำนวนสต็อก</th>
                            <th class="p-3">สถานะ</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-indigo-900/40">
                        @forelse($games as $game)
                        <tr>
                            <td class="p-3 flex items-center space-x-3">
                                <img src="{{ $game->image }}" class="w-10 h-12 object-cover rounded">
                                <span class="font-medium text-white line-clamp-1">{{ $game->title }}</span>
                            </td>
                            <td class="p-3">฿{{ number_format($game->price, 2) }}</td>
                            <td class="p-3 font-bold text-indigo-300">{{ $game->stock_qty }} ชิ้น</td>
                            <td class="p-3">
                                @if($game->stock_qty > 0)
                                    <span class="text-xs bg-emerald-900/80 text-emerald-300 px-2.5 py-1 rounded">มีสินค้า</span>
                                @else
                                    <span class="text-xs bg-rose-900/80 text-rose-300 px-2.5 py-1 rounded">สินค้าหมด</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="p-4 text-center text-gray-500">ไม่มีข้อมูลในฐานข้อมูล (ระบบใช้ Dummy Data แสดงผลชั่วคราว)</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>