<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\Category\CategoryCollection;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $categories = Category::whereNull('parent')->with('children')->get();
        return view('admin.category.list', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request )
    {
        return view('admin.category.create');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Employee $employee )
    {   
       
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
        public function store(Request $request) {

             $request->validate([
                'category_name' => [
                    'required',
                    Rule::unique('categories', 'name'),
                ],
            ]);

            $category = new Category;
            $category->name = $request->category_name;
            $category->parent = $request->parent_category;
            if($category->save()){ 
                return response()->json(['message'=>'Profile  Updated', 'class'=>'success', 'error'=>false]);
                return redirect()->route('admin.category.index')->with(['message'=>'Category Successfully Added','class'=>'success']);
            }
            return response()->json(['class'=>'error','message'=>'Whoops, looks like something went wrong ! Try again ...']);
            return redirect()->back()->with(['class'=>'error','message'=>'Whoops, looks like something went wrong ! Try again ...']);
        }
        
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Category $category)
    {
        return response()->json(['message'=>'Data Found', 'class'=>'success', 'error'=>false, 'datas'=>$category]);
        return view('admin.category.edit',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $this->validate($request,[
            'edit_category_name'=>'required',     
        ]);

        $category->name = $request->edit_category_name;
        $category->parent = $request->edit_parent_category;

        if($category->save()){ 
            return response()->json(['message'=>'Profile  Updated', 'class'=>'success', 'error'=>false]);
            return redirect()->route('admin.category.index')->with(['message'=>'Category Successfully Added','class'=>'success']);
        }
        return response()->json(['class'=>'error','message'=>'Whoops, looks like something went wrong ! Try again ...']);
        return redirect()->back()->with(['class'=>'error','message'=>'Whoops, looks like something went wrong ! Try again ...']);
    }


    public function updateParent(Request $request, $id)
    {
        $this->validate($request,[
            'parent_category'=>'required',     
            'child_category_id'=>'required',      
        ]);

        if(Category::where('id', $request->child_category_id)->update(['parent'=>$request->parent_category])){ 
            return response()->json(['message'=>'Category  Updated', 'class'=>'success', 'error'=>false]);
        }
        return response()->json(['class'=>'error','message'=>'Whoops, looks like something went wrong ! Try again ...']);
    }


    public function removeParent(Request $request, $id){

        if(Category::where('id', $id)->update(['parent'=>null])){ 
            return response()->json(['message'=>'Category  Updated', 'class'=>'success', 'error'=>false]);
        }
        return response()->json(['class'=>'error','message'=>'Whoops, looks like something went wrong ! Try again ...']);
    }


    public function parentList(Request $request){
        $categories = Category::all();
        if($categories->count()){ 
            return response()->json(['message'=>'Category  Updated', 'class'=>'success', 'error'=>false, 'datas'=>$categories]);
        }
        return response()->json(['class'=>'error','message'=>'Whoops, looks like something went wrong ! Try again ...']);
    }

    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Category $category)
    {
        Category::where('parent', $category->id)->update(['parent'=>null]);
        if($category->delete()){
            return response()->json(['message'=>'Category deleted Successfully ...', 'class'=>'success']);  
        }
        return response()->json(['message'=>'Whoops, looks like something went wrong ! Try again ...', 'class'=>'error']);
    }


    public function updateOrder(Request $request)
    {
        $order = json_decode($request->input('order'), true);
        $this->updateNodeOrder($order);
        return response()->json(['message'=>'Category Upfated Successfully ...', 'class'=>'bg-success', 'error' => false]);  
    }

    private function updateNodeOrder($nodes, $parentId = null)
    {
        foreach ($nodes as $index => $node) {
            Category::where('id', $node['id'])->update([
                'ordering' => $index,
                'parent' => $parentId
            ]);
            if (!empty($node['children'])) {
                $this->updateNodeOrder($node['children'], $node['id']);
            }
        }
    }


    public function changeOrder(Request $request){
        return $request->all();
        if($request->orderedNodes){
            $inputes = $request->orderedNodes;
            foreach($inputes as $input){
                $category = Category::find($input['id']);
               // $category->parent = $input['parent'];
                $category->ordering = $input['ordering'];
                $category->save();
            }
        } else{
            $category = Category::find($request->item_id);
            $category->parent = $request->item_parent;
            $category->ordering = $request->item_ordering;
            $category->save();
        }
        return $request->all();
        return response()->json(['message'=>'Category Updated Successfully ...', 'class'=>'bg-success', 'error'=>false]);   
    }


    public function renderCategories($categories)
    {
        echo '<ul>';
        foreach ($categories as $category) {
            echo '<li>' . $category->name . '</li>';

            if ($category->children->isNotEmpty()) {
                // Call the same function to render child categories
                $this->renderCategories($category->children);
            }
        }
        echo '</ul>';
    }


    public function renderCategoriesWithCheckbox($categories)
    {
        echo '<div class="list-group">';
        foreach ($categories as $category) {
            // Add a checkbox with the category ID
            echo '<label class="list-group-item">';
            echo '<input type="checkbox" name="categories[]" value="' . $category->id . '">';
            echo $category->name;

            // Recursively render children if they exist
            if ($category->children->isNotEmpty()) {
                $this->renderCategoriesWithCheckbox($category->children);
            }
            echo '</label>';
        }
        echo '</div>';
    }
}
