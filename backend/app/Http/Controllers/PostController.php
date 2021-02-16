<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Http\Resources\Post as ResourcesPost;
use App\Models\Post;
use App\Models\Topic;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PostsExport;
use App\Exports\TagExport;
use App\Exports\TopicExport;
use App\Exports\UsersExport;
use App\Http\Requests\ExportRequest;
use App\Http\Resources\PostsCollectionResource;
use App\Imports\PostsImport;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Excel as ExcelExcel;


class PostController extends Controller
{

    public function index(Topic $topic)
    {

        $posts = $topic->posts()->withCount(['likes' => function (Builder $query) {
            $query->select((count($query->where('is_liked', '1'))) - (count($query->where('is_liked', '0'))));

            // (($query->where('is_liked', '1')) - ($query->where('is_liked', '0')));
        }])->paginate(15);

        return new PostsCollectionResource($posts);


        // TODO: Fetch topic's posts $topic->posts()->paginate();
        // 'data' => [],
        // 'meta' => [],

        // 'meta' => [..., topic]

        // Create a new resource collection php artisan make:resource --collection

        //  new PostCollection($)

        // $post = new Post;
        // $post->body = $request->body;
        // $post->user()->associate($request->user());
        // $topic->posts()->save($post);

        // $media = collect($request->medias)
        //     ->map(function ($file) use ($post) {

        //         return $post->addMedia($file)->toMediaCollection();
        //     });

        // return new ResourcesPost($topic->posts()->paginate());
    }

    public function store(StorePostRequest $request, Topic $topic)
    {
        $post = new Post;
        $post->body = $request->body;
        $post->user()->associate($request->user());
        $topic->posts()->save($post);

        $media = collect($request->medias)
            ->map(function ($file) use ($post) {

                return $post->addMedia($file)->toMediaCollection();
            });

        return new ResourcesPost($post);
    }

    public function update(UpdatePostRequest $request, Topic $topic, Post $post)
    {
        $this->authorize('update', $post);
        $post->body = $request->get('body', $post->body);
        $post->save();
        return new ResourcesPost($post);
    }

    public function destroy(Topic $topic, Post $post)
    {
        $this->authorize('destroy', $post);
        $post->delete();
        return response(null, 204);
    }

    public function show(Request $request, Topic $topic, Post $post)
    {
        return new ResourcesPost($post);
    }

    public function import()
    {
        Excel::import(new PostsImport, 'testImport.csv', 'testExcel', ExcelExcel::CSV);
        return redirect('/')->with('success', 'All good!');
    }

    public function export(Request $request, $type, $name, $model)
    {

        switch ($model) {
            case "user":
                $model = new UsersExport;
                break;
            case "topic":
                $model = new TopicExport;
                break;
            case "tag":
                $model = new TagExport;
                break;
            case "post":
                $model = new PostsExport;
                break;
            default:
                return "unexistant model";
        }

        switch ($type) {
            case "xlsx":
                Excel::store($model, "$name.xlsx", 'testExcel', ExcelExcel::XLSX);
                return Excel::download($model, "$name.xlsx", ExcelExcel::XLSX);
                break;
            case "csv":
                Excel::store($model, "$name.csv", 'testExcel', ExcelExcel::CSV);
                return Excel::download($model, "'$name.'csv", ExcelExcel::CSV);
                break;
            case "tsv":
                Excel::store($model, "$name.tsv", 'testExcel', ExcelExcel::TSV);
                return Excel::download($model, "$name.tsv", ExcelExcel::TSV);
                break;
            case "ods":
                Excel::store($model, "$name.ods", 'testExcel', ExcelExcel::ODS);
                return Excel::download($model, "$name.ods", ExcelExcel::ODS);
                break;
            case "xls":
                Excel::store($model, "$name.xls", 'testExcel', ExcelExcel::XLS);
                return Excel::download($model, "$name.xls", ExcelExcel::XLS);
                break;
            case "html":
                Excel::store($model, "$name.html", 'testExcel', ExcelExcel::HTML);
                return Excel::download($model, "$name.html", ExcelExcel::HTML);
                break;
            default:
                return "You write a bad type";
        }
    }
}
