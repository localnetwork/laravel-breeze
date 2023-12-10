<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\QueryBuilder\QueryBuilder; 
use Illuminate\Support\Facades\Redirect;
use ProtoneMedia\Splade\Facades\Toast;  
use ProtoneMedia\Splade\SpladeTable; 
use ProtoneMedia\Splade\SpladeQueryBuilder; 

use App\Models\VolunteerJobsTaken;  
use App\Models\Job;  

class VolunteerJobsTakenController extends Controller
{
    //
    public function apiJobsTaken(Request $request) {
        $transactions = QueryBuilder::for(VolunteerJobsTaken::class)
        ->defaultSort('-updated_at')
        ->allowedSorts(['id', 'updated_at'])
        ->allowedFilters(['id']);

        $user =  $request->user(); 
        $user_id = $user->id; 

      
        $transactions = QueryBuilder::for(VolunteerJobsTaken::class)
            ->defaultSort('-updated_at')
            ->allowedSorts(['id', 'updated_at'])
            ->allowedFilters(['id'])
            ->where('taken_by', $user_id)
            ->with(['job'])
            ->paginate(3); 
    
            return response()->json([
                'transactions' => $transactions,
            ]);
    }


    public function index(Request $request) {
        $user = $request->user(); 
        $transactions = QueryBuilder::for(VolunteerJobsTaken::class)
        ->defaultSort('-updated_at')
        ->allowedSorts(['id', 'updated_at'])
        ->allowedFilters(['id']);
    
        return view('jobs.taken', [
            'user' => $user, 
            'transactions' => SpladeTable::for($transactions)
                ->withGlobalSearch(columns: ['id'])
                ->column('id', sortable: true)
                ->column('job_id')
                ->column('tree')
                ->column('address')
                ->column('status')
                ->column('updated_at', sortable: true)
                ->column('action')
                ->paginate(15)
                ->perPageOptions([15, 50, 100])
                
        ]); 
    }
    public function store(Request $request) {
        $user = $request->user(); 
        $req = $request->headers->all();
        

        
        // $job = Job::where('id', request('jobId'))->first();
        $job = Job::find(request('jobId'));

        $count = VolunteerJobsTaken::where('taken_by', request('userId'))
            ->where('status', 'accepted')
            ->count();
        
        
        if(isset($user) && $user->role_id == 3 && isset($job) && $job->stocks > 0) {
            if($user->address == $job->address) {
                if($count <= 4) {
                    // Create the Job Taken transaction.
                    VolunteerJobsTaken::create([
                        'status' => 'accepted', 
                        'job_id' => $job->id, 
                        'taken_by' => request('userId'),
                    ]);
                    // Job::update([
                    //     'stocks' => $job->stocks - 1,
                    // ]);
                    $job->update([
                        'stocks' => $job->stocks - 1, 
                    ]);
                    // Toast::title('Success')->message('You have successfully accepted the job.')->success()->rightTop()->autoDismiss(3);
                    // return back(); 
                    return response()->json([
                        'success' => true,
                        'message' => 'Job successfully accepted.',
                    ], 200); 

                }else {
                    // Toast::title("Whoops! Can't accept the job.")->message('You still have pending tasks. Please complete your pending tasks first.')->warning()->rightTop()->autoDismiss(3);
                    // return back(); 

                    return response()->json([
                        'success' => false,
                        'message' => 'You still have pending jobs. Please finish your pending jobs first.',
                    ], 422); 
                }
                
            }else {
                // Toast::title("Whoops! Can't accept the job.")->message('You can accept the job within your area.')->warning()->rightTop()->autoDismiss(3);
                // return back(); 
                return response()->json([
                    'success' => false,
                    'message' => 'You can only accept the jobs within your area..',
                ], 422); 
            }
        }else {
            // Toast::title("Whoops! Can't accept the job.")->message('No more slots available to accept this job.')->warning()->rightTop()->autoDismiss(3);
            // return back();
            return response()->json([
                'success' => false,
                'message' => 'No more slots available to accept this job.',
            ], 422);  
        }
    }
}
