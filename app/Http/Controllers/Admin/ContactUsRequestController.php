<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactUsRequest;
use Yajra\DataTables\DataTables;

class ContactUsRequestController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:super_admin')->only(['index']);
        $this->middleware('role:super_admin')->only(['delete', 'bulk_delete']);

    }// end of __construct

    public function index()
    {
        return view('admin.contact_us_requests.index');

    }// end of index

    public function data()
    {
        $contactUsRequests = ContactUsRequest::select();

        return DataTables::of($contactUsRequests)
            ->addColumn('record_select', 'admin.contact_us_requests.data_table.record_select')
            ->editColumn('created_at', function (ContactUsRequest $contactUsRequest) {
                return $contactUsRequest->created_at->format('Y-m-d');
            })
            ->rawColumns(['record_select'])
            ->toJson();

    }// end of data

    public function destroy(ContactUsRequest $contactUsRequest)
    {
        $this->delete($contactUsRequest);
        session()->flash('success', __('site.deleted_successfully'));
        return response(__('site.deleted_successfully'));

    }// end of destroy

    public function bulkDelete()
    {
        foreach (json_decode(request()->record_ids) as $recordId) {

            $contactUsRequest = ContactUsRequest::FindOrFail($recordId);
            $this->delete($contactUsRequest);

        }//end of for each

        session()->flash('success', __('site.deleted_successfully'));
        return response(__('site.deleted_successfully'));

    }// end of bulkDelete

    private function delete(ContactUsRequest $contactUsRequest)
    {
        $contactUsRequest->delete();

    }// end of delete

}//end of controller
