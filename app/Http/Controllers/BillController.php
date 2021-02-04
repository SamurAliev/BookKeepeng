<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\Category;
use App\Models\Type;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BillController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //получение данных текущего пользователя
        $currentUserId = Auth::id();
        $currentUser = User::find($currentUserId);
        $bills = $currentUser->bills()->orderBy('date', 'asc')->get();
        $types = Type::pluck('title', 'id')->all();
        $total = 0;

        if (isset($_GET['type']) && $_GET['type']!='') {
            $bills = $bills->where('type_id', '=', $_GET['type']);
        }

        return view('bills.index', compact('bills', 'types', 'total'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $type = $_GET['type'];
        $user = User::find(Auth::id());

        //получение всех категорий(созданных по умолчанию и созданных пользователем) по заданному типу
        // и добавление опции "Другое" в массив категорий
        $type = Type::find($type);
        $default_categories = Category::doesntHave('users')->get()->where('type_id', '=', $type->id)->pluck('title', 'id')->all();
        $user_categories = $user->categories()->get()->where('type_id', '=', $type->id)->pluck('title', 'id')->all();

        $categories = $default_categories + $user_categories;
        $categories[] = 'Другое';
        $lastCategoryId = array_key_last($categories);
        return view('bills.create', compact('type', 'categories', 'lastCategoryId'));


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $lastCategoryId = $request->get('lastId');
        $typeId = $request->get('typeId');
        $sum = $request->get('sum');
        $categoryId = $request->get('category');

        $this->validate($request, [
            'category' => 'required',
            'new_category' => 'required_if:category,' . $lastCategoryId,
            'date' => 'required',
            'sum' => 'required|integer'
        ]);

        //создание новой категории, если выбрали "другое"
        if ($request->get('new_category')) {
            $new_category = Category::createNewCategory($request);
            $categoryId = $new_category->id;
            $user = User::find(Auth::id());
            $user->categories()->attach($categoryId);
        }

        //создание новой строки расходов/доходов
        $bill = Bill::create([
            'type_id' => $typeId,
            'category_id' => $categoryId,
            'date' => $request->get('date'),
            'sum' => $sum,
            'comment' => $request->get('comment')
        ]);

        //привязывание новой строки к текущему пользователю
        $id = Auth::id();
        $bill->users()->attach($id);

        return redirect()->route('bills.index')->with('status', 'Успешно добавлено');

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
