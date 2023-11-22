<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\QueryBuilder\QueryBuilder; 
use Illuminate\Support\Facades\Redirect;
use ProtoneMedia\Splade\Facades\Toast;  

use App\Models\VolunteerJobsTaken;  
use App\Models\Job;  

class VolunteerJobsTakenController extends Controller
{
    //

    public function store(Request $request, $job_id) {
        // job_id
        // taken by
        // status - set accepted
        $user = $request->user(); 
        $job = Job::where('id', $job_id)->first();

        $count = VolunteerJobsTaken::where('user_id', $user->id)
            ->where('status', 'accepted')
            ->count();
        

        // Accept job if has stocks.
        if(isset($user) && $user->role_id == 3 && isset($job) && $job->stocks > 0) {
            if($user->address == $job->address) {
                if($count <= 5) {
                    // Create the Job Taken transaction.
                    VolunteerJobsTaken::create([
                        'status' => 'accepted', 
                        'job_id' => $job_id, 
                        'take_by' => $user_id,
                    ]);
                    Job::update([
                        'stocks' => $job->stocks - 1,
                    ]);
                    Toast::title('Success')->message('You have successfully accepted the job.')->success()->rightTop()->autoDismiss(3);
                    return back(); 
                }else {
                    Toast::title("Whoops! Can't accept the job.")->message('You still have pending tasks. Please complete your pending tasks first.')->warning()->rightTop()->autoDismiss(3);
                    return back(); 
                }
                
            }else {
                Toast::title("Whoops! Can't accept the job.")->message('You can accept the job within your area.')->warning()->rightTop()->autoDismiss(3);
                return back(); 
            }
        }else {
            Toast::title("Whoops! Can't accept the job.")->message('No more slots available to accept this job.')->warning()->rightTop()->autoDismiss(3);
            return back(); 
        }
    }
}
