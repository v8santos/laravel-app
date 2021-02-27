<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUpdateProductRequest;
use App\Models\Product;
use GuzzleHttp\Middleware;
use Illuminate\Cache\Repository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    private $repository;

    public function __construct(Product $product)
    {
        $this->repository = $product;
        // $this->middleware('auth')->except([
        //     'index', 'show'
        // ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = $this->repository->latest()->paginate(15);

        return view('admin.pages.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreUpdateProductRequest  $request with validation
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateProductRequest $request)
    {
        $data = $request->only('name','price','description');

        if($request->hasFile('image') && $request->image->isValid())
        {
            $nameFile = $request->name . '.' . $request->image->extension();
            $imagePath = $request->image->storeAs('products', $nameFile);

            $data['image'] = $imagePath;
        }

        $this->repository->create($data);

        return redirect()->route('products.index');


        // dd('ok');
        // $request->validate([
        //     'name' => 'required|min:3|max:255',
        //     'description' => 'nullable|min:3|max:10000',
        //     'image' => 'required|image'
        // ]);

        // dd($request->all());
        // dd($request->name);
        // dd($request->input('name'));
        // dd($request->only(['name','description']));
        // dd($request->except('_token','description'));

        // if ($request->file('image')->isValid()) {
        //     $nameFile = $request->name . '.' . $request->image->extension();
        //     // dd($request->image->store('products'));
        //     dd($request->image->storeAs('products', $nameFile));
        // };
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $product = $this->repository->where('id', $id)->first();
        // $product = $this->repository->find($id);

        if(!$product = $this->repository->find($id))
            return redirect()->back();


        return view('admin.pages.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(!$product = $this->repository->find($id))
            return redirect()->back();

        return view('admin.pages.products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\StoreUpdateProductRequest  $request with validation
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateProductRequest $request, $id)
    {
        if(!$product = $this->repository->find($id))
            return redirect()->back();

        $data = $request->all();

        if($request->hasFile('image') && $request->image->isValid())
        {
            if($product->image && Storage::exists($product->image))
            {
                Storage::delete($product->image);
            }

            $nameFile = $request->name . '.' . $request->image->extension();
            $imagePath = $request->image->storeAs('products', $nameFile);

            $data['image'] = $imagePath;
        }

        $product->update($data);

        return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!$product = $this->repository->find($id))
            return redirect()->back();

        if($product->image && Storage::exists($product->image))
        {
            Storage::delete($product->image);
        }
        
        $product->delete();

        return redirect()->route('products.index');
    }

    /**
     * Products index filter
     * 
     * @param \Illuminate\Http\Request $request without validation
     */
    public function search(Request $request)
    {
        $filters = $request->except('_token');

        $products = $this->repository->search($request->filter);

        return view('admin.pages.products.index', compact('products','filters'));
    }

}
