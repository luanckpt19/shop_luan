<?php

namespace App\Http\Controllers;

use App\Components\Recusive;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{

    private $category;

    public function __construct(Category $category)
    {
        $this ->category = $category;
    }

    public function create()
    {

//
//       foreach ($data as $value) {
//           if ($value['parent_id'] == 0) {
//               echo "<opition>" . $value['name'] . "</opition>";
//
//               foreach ($data as $value2) {
//                   if ($value2['parent_id'] == $value['id']) {
//                       echo "<opition>" . $value2['name'] . "</opition>";
//
//                       foreach ($data as $value3) {
//                           if ($value3['parent_id'] == $value2['id']) {
//                               echo "<opition>" . $value3['name'] . "</opition>";
//                           }
//
//                       }
//                   }
//               }
//           }
//       }

        $htmlOption = $this->getCategory($parentId = '');
        return view('admin.category.add', compact('htmlOption'));
    }

    public function index()
    {
        $categories = DB::table('categories')->paginate(5);
        return view('admin.category.index', compact('categories'));
    }

    public function store(Request $request)
    {

        $this->category->create([
            'name'=> $request->name,
            'parent_id' => $request -> parent_id,
            'slug' => Str::slug($request->name),

        ]);

        return redirect()->route('admin.categories.index');
    }

    public function getCategory($parentId){
        $data = $this->category->all();
        $recusive = new Recusive($data);
        $htmlOption = $recusive -> categoryRecusive($parentId);
        return$htmlOption;
    }

    public  function edit($id){
        $category = $this->category->find($id);
        $htmlOption = $this->getCategory($category->parent_id);

        return view('admin.category.edit', compact('category', 'htmlOption'));

    }
    public function update($id,Request $request){
        $this ->category ->find($id) -> update([
            'name'=> $request->name,
            'parent_id' => $request -> parent_id,
            'slug' => Str::slug($request->name),
        ]);
        return redirect()->route('admin.categories.index');

    }

    public  function delete($id){
        $this->category -> find($id)->delete();
        return redirect()->route('admin.categories.index');

    }
}


