<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Actor;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ActorController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('permission:read_actors')->only(['index']);
        $this->middleware('permission:create_actors')->only(['create', 'store']);
        $this->middleware('permission:update_actors')->only(['edit', 'update']);
        $this->middleware('permission:delete_actors')->only(['delete', 'bulk_delete']);

    }// end of __construct

    public function index()
    {
        if (request()->ajax()) {

            $actors = Actor::where('name', 'like','%' . request()->search . '%')

                ->get();

            $results = [];
            $results[] = ['id'=>'','text'=>'All Actors'];

            foreach ($actors as $actor){
                $results[] = ['id' => $actor->id , 'text' => $actor->name] ;
            }//end of foreach

            return json_encode($results);
        }

        return view('admin.actors.index');

    }// end of index

    public function data()
    {
        $actors = Actor::withCount('movies');

        return DataTables::of($actors)
            ->addColumn('record_select', 'admin.actors.data_table.record_select')
            ->editColumn('image', 'admin.actors.data_table.image')
            ->addColumn('actions', 'admin.actors.data_table.actions')
            ->addColumn('related_movies', 'admin.actors.data_table.related_movies')
            ->rawColumns(['record_select', 'actions', 'image', 'related_movies'])
            ->toJson();

    }// end of data


    public function destroy(Actor $actor)
    {
        $this->delete($actor);
        session()->flash('success', __('site.deleted_successfully'));
        return response(__('site.deleted_successfully'));

    }// end of destroy

    public function bulkDelete()
    {
        foreach (json_decode(request()->record_ids) as $recordId) {

            $actor = Actor::FindOrFail($recordId);
            $this->delete($actor);

        }//end of for each

        session()->flash('success', __('site.deleted_successfully'));
        return response(__('site.deleted_successfully'));

    }// end of bulkDelete

    private function delete(Actor $actor)
    {
        $actor->delete();

    }// end of delete

}
