<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\UserActive;
use App\Models\UserBank;
use App\Models\UserBusiness;
use App\Models\UserHeir;
use App\Models\UserImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

use function PHPUnit\Framework\isEmpty;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $current_page = $request->query('current_page', 1);
        $data = new User();

        // Apply filters
        $fillable_column = (new User())->getFillable();
        foreach ($fillable_column as $column) {
            if ($request->query($column)) {
                $data = $data->where($column, 'like', '%' . $request->query($column) . '%');
            }
        }

        // Apply is_active condition and paginate
        $data = $data->where('is_deleted', false)->paginate(20, ['*'], 'page', $current_page);

        // map data add verified value on data (non filter)
        $data_with_verified = $data->map(function ($item) {
            $this->addVerifiedValueToTheData($item);

            return $item;
        });

        // Include related data
        if ($request->query('include')) {
            $includes = $request->query('include');
            foreach ($includes as $include) {
                $data_with_verified = $data_with_verified->load($include);
            }
        }

        return response()->json([
            'status' => 'success',
            'data' => $data_with_verified,
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
        $validator = Validator::make($request->all(), [
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string',
            're_password' => 'required|string|same:password',
            'authorization_level' => 'required|in:1,2,3',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors(),
                'server_time' => (int) round(microtime(true) * 1000),
            ], 422);
        }

        // Create user active
        $user_active = UserActive::create();

        // Create user bank
        $field_user_bank = $request->only((new UserBank)->getFillable());
        $user_bank = UserBank::create($field_user_bank);

        // Create user business
        $field_user_bussiness = $request->only((new UserBusiness)->getFillable());
        $field_user_bussiness['name'] = $request->user_business_name;
        $field_user_bussiness['address'] = $request->user_business_address;
        if ($request->file('file_certificate')) {
            $file_certificate = $request->file('file_certificate');
            $original_name = $file_certificate->getClientOriginalName();
            $timestamp = now()->timestamp;
            $new_file_name = $timestamp . '_' . str_replace(' ', '_', $original_name); // Replace spaces with underscores
            $path_of_file_certificate = $file_certificate->storeAs('public/certificate', $new_file_name);
            $certificate_url = Storage::url($path_of_file_certificate);
            $field_user_bussiness['certificate_url'] = $certificate_url;
        }
        $user_bussiness = UserBusiness::create($field_user_bussiness);

        // Create user heir
        $field_user_heir = $request->only((new UserHeir)->getFillable());
        $field_user_heir['name'] = $request->user_heir_name;
        $field_user_heir['relationship'] = $request->user_heir_relationship;
        $field_user_heir['phone_number'] = $request->user_heir_phone_number;
        $field_user_heir['address'] = $request->user_heir_address;
        $user_heir = UserHeir::create($field_user_heir);

        // Create user image
        $field_user_image = $request->only((new UserImage)->getFillable());
        if ($request->file('file_id_card')) {
            $file_id_card = $request->file('file_id_card');
            $original_name = $file_id_card->getClientOriginalName();
            $timestamp = now()->timestamp;
            $new_file_name = $timestamp . '_' . str_replace(' ', '_', $original_name); // Replace spaces with underscores
            $path_of_file_id_card = $file_id_card->storeAs('public/id_card', $new_file_name);
            $id_card_url = Storage::url($path_of_file_id_card);
            $field_user_image['id_card_url'] = $id_card_url;
        }
        if ($request->file('file_id_card_with_face')) {
            $file_id_card_with_face = $request->file('file_id_card_with_face');
            $original_name = $file_id_card_with_face->getClientOriginalName();
            $timestamp = now()->timestamp;
            $new_file_name = $timestamp . '_' . str_replace(' ', '_', $original_name); // Replace spaces with underscores
            $path_of_file_id_card_with_face = $file_id_card_with_face->storeAs('public/id_card_with_face', $new_file_name);
            $id_card_with_face_url = Storage::url($path_of_file_id_card_with_face);
            $field_user_image['id_card_with_face_url'] = $id_card_with_face_url;
        }
        if ($request->file('file_selfie')) {
            $file_selfie = $request->file('file_selfie');
            $original_name = $file_selfie->getClientOriginalName();
            $timestamp = now()->timestamp;
            $new_file_name = $timestamp . '_' . str_replace(' ', '_', $original_name); // Replace spaces with underscores
            $path_of_file_selfie = $file_selfie->storeAs('public/selfie', $new_file_name);
            $selfie_url = Storage::url($path_of_file_selfie);
            $field_user_image['selfie_url'] = $selfie_url;
        }

        $user_image = UserImage::create($field_user_image);

        // Create user
        $field_user = $request->only((new User)->getFillable());
        $field_user['password'] = bcrypt($request->password);
        $field_user['id_user_active'] = $user_active->id;
        $field_user['id_user_bank'] = $user_bank->id;
        $field_user['id_user_business'] = $user_bussiness->id;
        $field_user['id_user_heir'] = $user_heir->id;
        $field_user['id_user_image'] = $user_image->id;
        $data = User::create($field_user);
        $data['is_verified'] = false;

        $credentials = $request->only('email', 'password');
        $token = Auth::attempt($credentials);

        return response()->json([
            'status' => 'success',
            'message' => 'Data created successfully',
            'data' => $data,
            'authorization' => [
                "token" => $token,
                "type" => "bearer"
            ],
            'server_time' => (int) round(microtime(true) * 1000),
        ]);
    }

    public function show(Request $request, $id)
    {
        $data = new User();
        $data = $data->find($id);

        return $this->show_user_common($data, $request);
    }

    public function update(Request $request, $id)
    {
        // update user
        $data = User::find($id);
        return $this->update_user_common($request, $data);
    }

    public function change_password_user(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'current_password' => 'required|string',
            'password' => 'required|string',
            're_password' => 'required|string|same:password',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors(),
                'server_time' => (int) round(microtime(true) * 1000),
            ], 422);
        }

        $data = User::find($id);
        return $this->change_password_common($request, $data);
    }


    public function destroy($id)
    {
        $data = User::find($id);
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

    // fitur custom
    public function show_user_by_token(Request $request)
    {

        $data = new User();
        $data = $data->find($request->user()->id);
        return $this->show_user_common($data, $request);

    }

    public function update_user_by_token(Request $request)
    {
        // update user
        $data = User::find($request->user()->id);
        return $this->update_user_common($request, $data);
    }

    public function change_password_user_by_token(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'current_password' => 'required|string',
            'password' => 'required|string',
            're_password' => 'required|string|same:password',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors(),
                'server_time' => (int) round(microtime(true) * 1000),
            ], 422);
        }

        $data = User::find($request->user()->id);
        return $this->change_password_common($request, $data);
    }

    /**
     * @param $data
     * @return void
     */
    public static function addVerifiedValueToTheData($data): void
    {
        if ($data === null) {
            return;
        }

        $data->is_verified = true;
        if ($data->authorization_level == 1) {
            $data->is_verified = $data->user_active->phone_number == 1 && $data->user_active->email == 1 && $data->user_active->id_card == 1 && $data->user_active->tax_registration_number == 1 && $data->user_active->user_bank == 1;
        } else if ($data->authorization_level == 2) {
            $data->is_verified = $data->user_active->phone_number == 1 && $data->user_active->email == 1 && $data->user_active->id_card == 1 && $data->user_active->tax_registration_number == 1 && $data->user_active->user_bank == 1 && $data->user_active->user_business == 1;
        }

        // Remove the user_active property
        unset($data->user_active);
    }

    /**
     * @param Request $request
     * @param $data
     * @return \Illuminate\Http\JsonResponse
     */
    public function update_user_common(Request $request, $data): \Illuminate\Http\JsonResponse
    {
        $field_user = $request->only((new User)->getFillable());
        $field_user['password'] = null;
        unset($field_user['password']);

        // update user active
        if (isset($field_user['phone_number']) && $field_user['phone_number'] != $data->phone_number) {
            $data->user_active->update(['phone_number' => 0]);
        }

        if (isset($field_user['email']) && $field_user['email'] != $data->email) {
            $data->user_active->update(['email' => 0]);
        }

        if (isset($field_user['tax_registration_number']) && $field_user['tax_registration_number'] != $data->tax_registration_number) {
            $data->user_active->update(['tax_registration_number' => 0]);
        }

        // update user
        $data->update($field_user);

        // update user bank
        $field_user_bank = $request->only((new UserBank)->getFillable());

        // update user active
        if (isset($field_user_bank['bank_name']) && $field_user_bank['bank_name'] != $data->user_bank->bank_name) {
            $data->user_active->update(['user_bank' => 0]);
        }

        if (isset($field_user_bank['account_number']) && $field_user_bank['account_number'] != $data->user_bank->account_number) {
            $data->user_active->update(['user_bank' => 0]);
        }

        if (isset($field_user_bank['account_name']) && $field_user_bank['account_name'] != $data->user_bank->account_name) {
            $data->user_active->update(['user_bank' => 0]);
        }

        // update user bank
        $data->user_bank->update($field_user_bank);

        // update user business
        $field_user_bussiness = $request->only((new UserBusiness)->getFillable());
        if ($request->user_business_name) {
            $field_user_bussiness['name'] = $request->user_business_name;
        }
        if ($request->user_business_address) {
            $field_user_bussiness['address'] = $request->user_business_address;
        }
        if ($request->file('file_certificate')) {
            $file_certificate = $request->file('file_certificate');
            $original_name = $file_certificate->getClientOriginalName();
            $timestamp = now()->timestamp;
            $new_file_name = $timestamp . '_' . str_replace(' ', '_', $original_name); // Replace spaces with underscores
            $path_of_file_certificate = $file_certificate->storeAs('public/certificate', $new_file_name);
            $certificate_url = Storage::url($path_of_file_certificate);
            $field_user_bussiness['certificate_url'] = $certificate_url;
        }


        // update user active
        if (isset($field_user_bussiness['name']) && $field_user_bussiness['name'] != $data->user_business->name) {
            $data->user_active->update(['user_business' => 0]);
        }

        if (isset($field_user_bussiness['certificate_url']) && $field_user_bussiness['certificate_url'] != $data->user_business->certificate_url) {
            $data->user_active->update(['user_business' => 0]);
        }

        if (isset($field_user_bussiness['address']) && $field_user_bussiness['address'] != $data->user_business->address) {
            $data->user_active->update(['user_business' => 0]);
        }

        if ($data->user_business) {
            $data->user_business->update($field_user_bussiness);
        }

        // Update user heir
        $field_user_heir = $request->only((new UserHeir)->getFillable());
        if ($request->user_heir_name) {
            $field_user_heir['name'] = $request->user_heir_name;
        }
        if ($request->user_heir_relationship) {
            $field_user_heir['relationship'] = $request->user_heir_relationship;
        }
        if ($request->user_heir_phone_number) {
            $field_user_heir['phone_number'] = $request->user_heir_phone_number;
        }
        if ($request->user_heir_address) {
            $field_user_heir['address'] = $request->user_heir_address;
        }

        if($data->user_heir){
            $data->user_heir->update($field_user_heir);
        }

        // update user image
        $field_user_image = $request->only((new UserImage)->getFillable());
        if ($request->file('file_id_card')) {
            $file_id_card = $request->file('file_id_card');
            $original_name = $file_id_card->getClientOriginalName();
            $timestamp = now()->timestamp;
            $new_file_name = $timestamp . '_' . str_replace(' ', '_', $original_name); // Replace spaces with underscores
            $path_of_file_id_card = $file_id_card->storeAs('public/id_card', $new_file_name);
            $id_card_url = Storage::url($path_of_file_id_card);
            $field_user_image['id_card_url'] = $id_card_url;

            $new_file_name_parts = explode('_', $new_file_name);
            $current_file_name_parts = explode('_', $data->user_image->id_card_url);
            $new_file_name_without_timestamp = end($new_file_name_parts);
            $current_file_name_without_timestamp = end($current_file_name_parts);

            if ($new_file_name_without_timestamp != $current_file_name_without_timestamp) {
                $data->user_active->update(['id_card' => 0]);
            }

        }
        if ($request->file('file_id_card_with_face')) {
            $file_id_card_with_face = $request->file('file_id_card_with_face');
            $original_name = $file_id_card_with_face->getClientOriginalName();
            $timestamp = now()->timestamp;
            $new_file_name = $timestamp . '_' . str_replace(' ', '_', $original_name); // Replace spaces with underscores
            $path_of_file_id_card_with_face = $file_id_card_with_face->storeAs('public/id_card_with_face', $new_file_name);
            $id_card_with_face_url = Storage::url($path_of_file_id_card_with_face);
            $field_user_image['id_card_with_face_url'] = $id_card_with_face_url;

            $new_file_name_parts = explode('_', $new_file_name);
            $current_file_name_parts = explode('_', $data->user_image->id_card_with_face_url);
            $new_file_name_without_timestamp = end($new_file_name_parts);
            $current_file_name_without_timestamp = end($current_file_name_parts);

            if ($new_file_name_without_timestamp != $current_file_name_without_timestamp) {
                $data->user_active->update(['id_card' => 0]);
            }
        }
        if ($request->file('file_selfie')) {
            $file_selfie = $request->file('file_selfie');
            $original_name = $file_selfie->getClientOriginalName();
            $timestamp = now()->timestamp;
            $new_file_name = $timestamp . '_' . str_replace(' ', '_', $original_name); // Replace spaces with underscores
            $path_of_file_selfie = $file_selfie->storeAs('public/selfie', $new_file_name);
            $selfie_url = Storage::url($path_of_file_selfie);
            $field_user_image['selfie_url'] = $selfie_url;

            $new_file_name_parts = explode('_', $new_file_name);
            $current_file_name_parts = explode('_', $data->user_image->selfie_url);
            $new_file_name_without_timestamp = end($new_file_name_parts);
            $current_file_name_without_timestamp = end($current_file_name_parts);

            if ($new_file_name_without_timestamp != $current_file_name_without_timestamp) {
                $data->user_active->update(['id_card' => 0]);
            }
        }

        // update user image
        $data->user_image->update($field_user_image);

        // Add verified value to the data
        $this->addVerifiedValueToTheData($data);

        return response()->json([
            'status' => 'success',
            'message' => 'Data update successfully',
            'data' => $data,
            'server_time' => (int)round(microtime(true) * 1000),
        ]);
    }

    /**
     * @param $data
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function show_user_common($data, Request $request): \Illuminate\Http\JsonResponse
    {
        // Add verified value to the data
        $this->addVerifiedValueToTheData($data);

        // Include related data
        if ($request->query('include')) {
            $includes = $request->query('include');
            foreach ($includes as $include) {
                $data = $data->load($include);
            }
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Data retrieved successfully',
            'data' => $data,
        ]);
    }

    /**
     * @param Request $request
     * @param $data
     * @return \Illuminate\Http\JsonResponse
     */
    public function change_password_common(Request $request, $data): \Illuminate\Http\JsonResponse
    {
        $currentPassword = $request->input('current_password');
        if (!Hash::check($currentPassword, $data->password)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Current password is incorrect.',
                'server_time' => (int)round(microtime(true) * 1000),
            ], 422);
        }

        $field_user = $request->only(['password']);
        $field_user['password'] = bcrypt($request->password);
        $data->update($field_user);

        // Add verified value to the data
        $this->addVerifiedValueToTheData($data);

        return response()->json([
            'status' => 'success',
            'message' => 'Data update successfully',
            'data' => $data,
            'server_time' => (int)round(microtime(true) * 1000),
        ]);
    }
}
