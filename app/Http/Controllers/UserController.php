<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Permission;
use Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
	 public function __construct()
	{
		$this->middleware('auth');
	} 
    public function index()
    {
        return view('user.list');
    }
	
	
    public function userList()
	{
		$get_users = User::where('id', '!=' , auth()->user()->id)->orderBy('id','DESC')->get();
		
		return datatables()->of($get_users)
		->addIndexColumn()
		->editColumn('created_at', function($data){
			return date('Y-m-d H:i:s', strtotime($data->created_at));
		})
		->addColumn('action', function($data){
			$action = "";
			
			if(!empty(auth()->user()->permission_id)){
			if(in_array(1,explode(',',auth()->user()->permission_id)))
			{
				$action = '<a href="' . route('user.show',$data->id) . '" class="btn btn-sencdory shadow btn-xs sharp mr-1"><i class="fa fa-eye"></i></a>';
			}
			if(in_array(3,explode(',',auth()->user()->permission_id)))
			{
				$action .= '<a href="' . route('user.edit',$data->id) . '" class="btn btn-primary shadow btn-xs sharp mr-1"><i class="fa fa-pencil">Edit</i></a>';
			}
			if(in_array(4,explode(',',auth()->user()->permission_id)))
			{
				$action .= '<a href="' . route('user.delete',$data->id) . '" class="btn btn-danger shadow btn-xs sharp" onClick="return confirm_click()"><i class="fa fa-trash"></i></a>';
			}
			}
			return $action;
		})
		->addColumn('status', function($data){
			if(auth()->id() == 1) {
				return $data->status;
			}
			return null;
		})
		->rawColumns(['action'])
		->make(true);
	}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if(!empty(auth()->user()->permission_id)){
			if(in_array(2,explode(',',auth()->user()->permission_id)))
			{
				$permissions = Permission::get();
				//echo$permissions ;die;
				return view('user.create',compact('permissions'));
			}
			
			return redirect()->route('user.index')->with('danger', 'Do not have permmision to add user');
		}
		return redirect()->route('user.index')->with('danger', 'Do not have permmision to add user');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
		//dd($request->all());
        $data = $request->validate([
            'name' => 'required|alpha_num|max:50',
            'email' => 'required|email|max:100',
            'password' => 'required',
            'phone_number' => 'required|numeric|digits:10',
            'city' => 'required',
            'gender' => 'required',
            'hobbies' => 'required|array',
            'permission' => 'required|array',
        ],
        [
            'name.required' => 'Name field is required',
            'email.required' => 'Email field is required',
            'email.email' => 'Please enter a valid email address',
            'password.required' => 'Password field is required',
            'password.min' => 'Password must be at least 6 characters',
            'password.max' => 'Password cannot exceed 12 characters',
            'password.regex' => 'Password must contain at least one uppercase letter, one number, and one special character',
            'phone_number.required' => 'Phone number is required',
            'phone_number.numeric' => 'Phone number must be numeric',
            'phone_number.digits' => 'Phone number must be 10 digits',
            'city.required' => 'City is required',
            'gender.required' => 'Gender is required',
            'hobbies.required' => 'Please select at least one hobby',
            'permission.required' => 'Please select at least one permission'
        ]);

        try {
			/* laravel last query print */
//\DB::enableQueryLog(); // Enable query log
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->phone_number = $request->phone_number;
            $user->city = $request->city;
            $user->gender = $request->gender;
            $user->hobbies = implode(',', $request->hobbies);
            $user->permission_id = implode(',', $request->permission);
            $user->status = 0; // Set default status to inactive
            $user->save();
			//dd(\DB::getQueryLog()); // Show results of log

            return redirect()->route('user.index')->with('success', 'User added successfully');
			//return redirect()->route('user.index')->with('success', 'User updated successfully');
        } catch (\Exception $e) {
          //  return redirect()->back()->with('error', 'Error creating user: ' . $e->getMessage())->withInput();
		  return redirect()->route('user.index')->with('success', 'User updated successfully');
        }
    }

    /**
     * Display the specified resource.
     */
   //View page load.
	public function show(User $user)
	{
		return view('user.view', compact('user'));
	}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        if(!empty(auth()->user()->permission_id)){
			if(in_array(3,explode(',',auth()->user()->permission_id)))
			{
				$permissions = Permission::get();
				return view('user.edit', compact('user','permissions'));
			}
			return redirect()->route('user.index')->with('danger', 'Do not have permmision to edit user');
		}
		return redirect()->route('user.index')->with('danger', 'Do not have permmision to edit user');
    }

    /**
     * Update the specified resource in storage.
     */
   //Update.
	public function update(Request $request, User $user)
	{
		//dd($request->all());
		$data = $request->validate([
		'name' => 'required|alpha_num|max:50',
		'email' => 'required|email|max:100',
		'phone_number' => 'required',
		'city' => 'required',
		'gender' => 'required',
		'hobbies' => 'required|array',
		'permission' => 'required|array',
		],
		[
		'name.required' =>('Name field is required'),
		]);
		/* laravel last query print */
//\DB::enableQueryLog(); // Enable query log
		$user = User::find($user->id);
		$user->name = $request->name;
		$user->email = $request->email;
		$user->phone_number = $request->phone_number;
		$user->city = $request->city;
		$user->gender = $request->gender;
		$user->hobbies = implode(',',$request->hobbies);
		$user->permission_id = implode(',',$request->permission);
		$user->save();
		//dd(\DB::getQueryLog()); // Show results of log
		return redirect()->route('user.index')->with('success', 'User updated successfully');
	}

    /**
     * Remove the specified resource from storage.
     */
	 
   //Delete.
	public function delete($id)
    {
        if(!empty(auth()->user()->permission_id)){
			if(in_array(4,explode(',',auth()->user()->permission_id)))
			{
				$user = User::find($id);
				$user->delete();
				
				return redirect()->route('user.index')->with('success', 'User deleted successfully');
			}
			return redirect()->route('user.index')->with('danger', 'Do not have permmision to delete user');
		}
		return redirect()->route('user.index')->with('danger', 'Do not have permmision to delete user');
    }

    public function updateStatus(Request $request, $id)
    {
        try {
            $user = User::findOrFail($id);
            $user->status = $request->status;
            $user->save();
            
            return response()->json(['success' => true, 'message' => 'Status updated successfully']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error updating status']);
        }
    }
}
