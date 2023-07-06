<?php

namespace App\Http\Controllers;

use App\Imports\CampaignReportDetailImport;
use App\Imports\DataImport;
use App\Models\CampaignReport;
use App\Models\Campaign;
use App\Models\CampaignReportDetail;
use App\Models\CampaignReportGroup;
use App\Models\Payment;
use App\Models\Receipt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class CampaignReportController extends Controller
{
    public function index(Request $request)
    {
        $current_page = $request->query('current_page', 1);
        $data = new CampaignReport;

        // Apply filters
        $fillable_column = (new CampaignReport())->getFillable();
        foreach ($fillable_column as $column) {
            if ($request->query($column)) {
                $data = $data->where($column, 'like', '%' . $request->query($column) . '%');
            }
        }

        // Include related data
        if ($request->query('include')) {
            $includes = $request->query('include');
            foreach ($includes as $include) {
                $data = $data->with($include);
            }
        }

        // Apply is_active condition and paginate
        $data = $data->where('is_deleted', false)->paginate(10, ['*'], 'page', $current_page);

        return response()->json([
            'status' => 'success',
            'data' => $data->items(),
            'meta' => [
                'current_page' => $data->currentPage(),
                'last_page' => $data->lastPage(),
                'total_records' => $data->total(),
            ],
            'server_time' => (int) round(microtime(true) * 1000),
        ]);
    }

    public function store(Request $request)
    {
        $id_campaign = $request->id_campaign;
        $status = DB::table('campaigns')->where('id', $id_campaign)->value('status');

        if ($status == 'RUNNING'){
            
        $field_receipts = [];
        $receipts = Receipt::create($field_receipts);

        // create payments
        $field_payment = [];
        $field_payment['id_user'] = $request->user()->id;
        $field_payment['id_receipt'] = $receipts->id;
        $payments = Payment::create($field_payment);

        $field_campaign_reports = $request->only((new CampaignReport())->getFillable());
        $field_campaign_reports['id_payment'] = $payments->id;
        if ($request->file('file_document')) {
            $file_document = $request->file('file_document');
            $original_name = $file_document->getClientOriginalName();
            $timestamp = now()->timestamp;
            $new_file_name = $timestamp . '_' . $original_name;
            $path_of_file_document = $file_document->storeAs('public/document', $new_file_name);
            $document_url = Storage::url($path_of_file_document);
            $field_campaign_reports['document_url'] = $document_url;
        }
        $data = CampaignReport::create($field_campaign_reports);
        return response()->json([
            'status' => 'success',
            'message' => 'Data created successfully',
            'data' => $data,
            'server_time' => (int) round(microtime(true) * 1000),
        ]);
    } else {
        return response()->json([
            'status' => 'gagal',
            'message' => 'gabiisa' ]);
    }
}

    public function show(Request $request, $id)
    {
        $data = new CampaignReport();
        // Include related data
        if ($request->query('include')) {
            $includes = $request->query('include');
            foreach ($includes as $include) {
                $data = $data->with($include);
            }
        }

        $data = $data->find($id);

        return response()->json([
            'status' => 'success',
            'message' => 'Data retrieved successfully',
            'data' => $data,
        ]);
    }

    public function update(Request $request, $id)
    {
        $data = CampaignReport::find($id);
        $field_campaign_reports = $request->only((new CampaignReport())->getFillable());

        if ($request->file('file_document')) {
            $file_document = $request->file('file_document');
            $original_name = $file_document->getClientOriginalName();
            $timestamp = now()->timestamp;
            $new_file_name = $timestamp . '_' . $original_name;
            $path_of_file_document = $file_document->storeAs('public/document', $new_file_name);
            $document_url = Storage::url($path_of_file_document);
            $field_campaign_reports['document_url'] = $document_url;
        }

        $data->update($field_campaign_reports);

        if ($request->is_exported && $request->is_exported == 1) {
            $file = public_path($data->document_url);
            $extension = pathinfo($file, PATHINFO_EXTENSION);

            if ($extension === 'xlsx') {
                $import = new CampaignReportDetailImport();
                $data_of_campaign_report_detail = Excel::toArray($import, $file);
            } elseif ($extension === 'csv') {
                $data_of_campaign_report_detail = array_map('str_getcsv', file($file));
                array_shift($data_of_campaign_report_detail); // Remove header row
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Unsupported file format',
                    'server_time' => (int) round(microtime(true) * 1000),
                ], 422);
            }

            foreach ($data_of_campaign_report_detail as $value) {
                $campaign_report_detail = CampaignReportDetail::create([
                    'date' => ($extension === 'csv') ? $value[0] : $this->transformDate($value['date']),
                    'description' => ($extension === 'csv') ? $value[1] : $value['description'],
                    'evidence' => ($extension === 'csv') ? $value[2] : $value['evidence'],
                    'amount' => ($extension === 'csv') ? $value[3] : $value['amount'],
                    'type' => ($extension === 'csv') ? $value[4] : $value['type'],
                ]);

                CampaignReportGroup::create([
                    'id_campaign_report' => $data->id,
                    'id_campaign_report_detail' => $campaign_report_detail->id,
                ]);
            }
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Data updated successfully',
            'data' => $data,
            'server_time' => (int) round(microtime(true) * 1000),
        ]);
    }


    public function destroy($id)
    {
        $data = CampaignReport::find($id);
        $data->is_deleted = true;
        $data->save();
        // $data->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Data deleted successfully',
            'data' => $data,
            'server_time' => (int) round(microtime(true) * 1000),
        ]);
    }

    public function transformDate($value, $format = 'Y-m-d')
    {
        try {
            $string = \Carbon\Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($value));
            $parts = explode("T", $string); // Split the string at 'T'

            $dateString = $parts[0]; // Extract the date part

            $dateArray = explode("-", $dateString); // Split the date part at '-'
            $year = $dateArray[0]; // Extract the year
            $month = $dateArray[1]; // Extract the month
            $day = $dateArray[2]; // Extract the day

            $formattedDate = "{$year}-{$month}-{$day}"; // F
            return $formattedDate;
        } catch (\ErrorException $e) {
            return \Carbon\Carbon::createFromFormat($format, $value);
        }
    }
}
