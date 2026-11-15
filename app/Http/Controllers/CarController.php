<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;

class CarController extends Controller
{
    // 1. عرض قائمة جميع السيارات (Read)
    public function index()
    {
        $cars = Car::latest()->get();
        return view('cars.index', compact('cars'));
    }

    // 2. فتح صفحة نموذج إضافة سيارة جديدة (Create Form)
    public function create()
    {
        return view('cars.create');
    }

    // 3. حفظ بيانات السيارة الجديدة في قاعدة البيانات (Store)
    public function store(Request $request)
    {
        $validated = $request->validate([
            'brand'        => 'required|string|max:255',
            'model'        => 'required|string|max:255',
            'plate_number' => 'required|string|max:50|unique:cars,plate_number',
            'daily_rate'   => 'required|numeric|min:0',
            'status'       => 'required|in:available,rented',
        ]);

        Car::create($validated);

        return redirect()->route('cars.index')
            ->with('success', 'تمت إضافة السيارة بنجاح!');
    }

    // 4. فتح صفحة تعديل بيانات سيارة محددة (Edit Form)
    public function edit(Car $car)
    {
        return view('cars.edit', compact('car'));
    }

    // 5. حفظ التعديلات في قاعدة البيانات (Update)
    public function update(Request $request, Car $car)
    {
        $validated = $request->validate([
            'brand'        => 'required|string|max:255',
            'model'        => 'required|string|max:255',
            'plate_number' => 'required|string|max:50|unique:cars,plate_number,' . $car->id,
            'daily_rate'   => 'required|numeric|min:0',
            'status'       => 'required|in:available,rented',
        ]);

        $car->update($validated);

        return redirect()->route('cars.index')
            ->with('success', 'تم تحديث بيانات السيارة بنجاح!');
    }

    // 6. حذف السيارة من قاعدة البيانات (Delete)
    public function destroy(Car $car)
    {
        $car->delete();

        return redirect()->route('cars.index')
            ->with('success', 'تم حذف السيارة بنجاح!');
    }
}