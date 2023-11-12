<?php


namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Tree;  
use App\Models\Barangay;  

use Illuminate\Http\Request; 
use Spatie\QueryBuilder\AllowedFilter;  
use Illuminate\Support\Collection; 
use ProtoneMedia\Splade\AbstractTable; 
use ProtoneMedia\Splade\SpladeTable; 
use ProtoneMedia\Splade\Facades\Splade; 
use Spatie\QueryBuilder\QueryBuilder; 
use Illuminate\Support\Facades\Redirect;
use ProtoneMedia\Splade\Facades\Toast;  
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator; 


class JobController extends Controller {

    public function messages() //OPTIONAL
        {
            return [
                'quantity.required' => 'Email is required',
                'job_description.email' => 'Email is not correct'
            ];
        } 
  
    public function jobsApi(Request $request) {
        $user =  $request->user(); 
        $user_id = $user->id; 

      
        $jobs = QueryBuilder::for(Job::class)
            ->defaultSort('-updated_at')
            ->allowedSorts(['id', 'title', 'updated_at'])
            ->allowedFilters(['id', 'title'])
            ->where('title', 'like', '%'.request()->get('title').'%') 
            ->where('tree', 'like', '%'.request()->get('tree').'%') 
            ->where('address', 'like', '%'.request()->get('address').'%') 
            ->where('user_id', $user_id)
            ->with('tree')
            ->with('user_id')
            ->with('address')
            ->paginate(3);
    
        return response()->json([
            'jobs' => $jobs,
        ]);
    } 

     
    public function index(Request $request)
    {       
        $user =  $request->user(); 
        $user_id = $user->id; 

        // $jobs = Job::all();

        // return view('jobs.index', compact('jobs'));
        $globalSearch = AllowedFilter::callback('global', function ($query, $value) {
            $query->where(function ($query) use ($value) {
                Collection::wrap($value)->each(function ($value) use ($query) {
                    $query
                        ->orWhere('id', 'LIKE', "%{$value}%")
                        ->orWhere('title', 'LIKE', "%{$value}%");
                });
            });
        });

        // $trees = Tree::all(); 

        $jobs = QueryBuilder::for(Job::class)
        ->defaultSort('-updated_at')
        ->allowedSorts(['id', 'title', 'updated_at'])
        ->allowedFilters(['id', 'title', $globalSearch])
        ->where('user_id', $user_id);
    
        return view('jobs.index', [
            'jobs' => SpladeTable::for($jobs)
                ->withGlobalSearch(columns: ['id', 'title'])
                ->column('id', sortable: true) 
                ->column('title', sortable: true)
                ->column('user_id', sortable: true)
                ->column('tree', sortable: true)
                ->column('updated_at', sortable: true)
                ->column('action')
                ->paginate(15)
                ->perPageOptions([15, 50, 100]),
            'trees' => Tree::all(),
            'address' => Barangay::all(), 
            'user' => $user, 
        ]); 
    }

    public function create(Request $request)
    {
        $user =  $request->user(); 
        $user_id = $user->id; 
        $request->validate([
            'title' => 'required|string|unique:trees|max:255',
        ]); 
    }

    public function store(Request $request) {
        $user =  $request->user(); 
        $user_id = $user->id; 

        if($user->role_id === 1 || $user->role_id === 2) {
            $this->validate($request, [
                'title' => 'required',
                'quantity' => 'required|numeric|min:1',
                'tree' => 'required', 
                'address' => 'required', 
                'job_description' => 'required',
            ]);
    
            $job = Job::create([
                'title' => $request->input('title'),
                'user_id' => $user_id,
                'tree' => $request->input('tree'), 
                'address' => $request->input('address'), 
                'quantity' => $request->input('quantity'),
                'job_description' => $request->input('job_description'),
            ]);
    
            Toast::title('Success')->message('Job added successfully')->success()->rightTop()->autoDismiss(3);
    
            return Redirect::route('jobs.index');
        }else {
    
            Toast::title('Whoops!')
                ->message('You are not allowed to do this function')
                ->warning()
                ->rightTop()
                ->autoDismiss(3);
    
            return Redirect::route('jobs.index');
        }
        
    }
    

    public function show(Job $job)
    {
        return view('jobs.show', compact('job'));
    }

    public function edit(Job $job)
    {
        return view('jobs.edit', compact('job'));
    }

    public function update(Request $request, Job $job)
    {

        if ($request->method() !== 'GET') {
            $validator = \Validator::make($request->all(), [
                'quantity' => 'required|min:1|numeric',
                'job_description' => 'required',
            ]); 

            if ($validator->fails()) {
                $errorMessages = $validator->errors();
                $response = [
                    'status'  => false,
                    'errors' => $errorMessages,
                ];
                return response()->json($response, 401); 
            }
                
            $job->update($request->all());  
            if ($job->save()) {
                return response()->json([
                    'message' => 'Job updated successfully',
                    'data' => $job,
                ]);
            } else {
                return response()->json([
                    'error' => 'An error occurred while updating the job',
                ], 500);
            }
        } else {
            return response()->json([
                'data' => $job,
            ]);
        } 
    }

    public function destroy(Job $job)
    {
        $job->delete();

        return redirect()->route('jobs.index');
    }
}