<?php


namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Tree;  

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


class JobController extends Controller {
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


        $this->validate($request, [
            'title' => 'required',
            'quantity' => 'required|numeric|min:1',
            'tree' => 'required', 
            'job_description' => 'required',
        ]);

        $job = Job::create([
            'title' => $request->input('title'),
            'user_id' => $user_id,
            'tree' => $request->input('tree'), 
            'quantity' => $request->input('quantity'),
            'job_description' => $request->input('job_description'),
        ]);

        Toast::title('Success')->message('Job added successfully')->success()->rightTop()->autoDismiss(3);

        return Redirect::route('jobs.index')->with('success', 'Job added successfully');
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
        $job->title = $request->input('title');
        $job->user_id = $request->input('user_id');
        $job->quantity = $request->input('quantity');
        $job->job_description = $request->input('job_description');

        $job->save();

        return redirect()->route('jobs.index');
    }

    public function destroy(Job $job)
    {
        $job->delete();

        return redirect()->route('jobs.index');
    }
}