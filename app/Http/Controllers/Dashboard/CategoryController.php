<?php

namespace App\Http\Controllers\Dashboard;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App;
use Validator;
use App\Models\Category;

class CategoryController extends Controller
{
    public function set_lang()
    {
        switch (session()->get('lang')) {
            case 'en':
                $this->lang = "en";
                break;
            case 'ar':
                $this->lang = "ar";
                break;

            default:
                $this->lang = "en";
                break;
        }
        App::setlocale($this->lang);
    }

    public function index()
    {
        self::set_lang();
        return view('dashboard.categories.categories', [
            'titleofpage' =>__('lang.categories'),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getcategories(Request $request)
    {
        self::set_lang();
        if ($request->start ==0) {
            $request['page']=1;
        } else {
            $request['page']= ($request->start / $request->length)+1;
        }

        $query_length = $request['length'];
        $settings=Category::where('lang_code',$this->lang);
        if ($settings==null) {
            $output['message'] = 'No data entry';
            $output['code'] = 404;
            $output['data'] = $settings;

            return response()->json($output, 200, [], JSON_UNESCAPED_UNICODE);
        }
        $columns=[
            "0"=>"category_id",
            "1"=>"name",
        ];
        $data=null;
        $column= isset($columns[$request["order"][0]["column"]]) ? $columns[$request["order"][0]["column"]] :null;
        $dir=$request["order"][0]["dir"];
        if ($column!=null) {
            $data = $settings->
            orderBy($column, $dir);
        }else{
            $data = $settings->
            orderBy("updated_at", "DESC");
        }   
        if ($request["search"]["value"]  != null) {
            $data = $settings->
                where("name", 'like', '%'.$request['search']["value"].'%');
            
        }
        $count=$data->count();
        $data=$data->paginate(intVal($query_length))->toArray();
        $data['recordsTotal']=  $count;
        $data['recordsFiltered']=  $count;

        return response()->json($data, 200, [], JSON_UNESCAPED_UNICODE);
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $categoryLast=Category::latest()->first();
        $langauges=['ar','en'];
        foreach ($langauges as $language) {
            
            $category=new Category();
            $category->name=$request['name_'.$language];
            if($categoryLast){
                $category->category_id=(string)$categoryLast['_id'];
            }else{
                $category->category_id='615c4ed1003ab820a8055539';
            }
            $category->lang_code=$language;
            $category->save();

        }

        $data['code']=200;
        return response()->json($data, 200, []);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $category=Category::findOrFail($request['category_id']);
        $category->name=$request['name'];
        $category->save();
        
        return response()->json(['code'=>200], 200, []);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $category=Category::findOrFail($request['category_id']);
        $category->delete();
        
        return response()->json(['code'=>200], 200, []);
    }
}
