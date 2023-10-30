<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Models\Tree;
use Illuminate\Support\Collection; 
use ProtoneMedia\Splade\AbstractTable; 
use ProtoneMedia\Splade\SpladeTable; 
use Spatie\QueryBuilder\QueryBuilder; 
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use ProtoneMedia\Splade\Facades\Toast; 
use App\Http\Requests\TreeUpdateRequest;
use Spatie\QueryBuilder\AllowedFilter; 

class TreeController extends Controller
{   

    

     // Display the form to add a new tree
     public function create(Tree $tree)
     {
         return view('admin.trees.create');
     } 

    public function edit(Tree $tree)
    {

        return view('admin.trees.edit', compact('tree'));
    }


    public function index(Request $request) {
        $globalSearch = AllowedFilter::callback('global', function ($query, $value) {
            $query->where(function ($query) use ($value) {
                Collection::wrap($value)->each(function ($value) use ($query) {
                    $query
                        ->orWhere('id', 'LIKE', "%{$value}%")
                        ->orWhere('name', 'LIKE', "%{$value}%");
                });
            });
        });

         
        $trees = QueryBuilder::for(Tree::class)
        ->defaultSort('name')
        ->allowedSorts(['id', 'name', 'updated_at'])
        ->allowedFilters(['id', 'name', $globalSearch]);
    
    return view('admin.trees.index', [
        'trees' => SpladeTable::for($trees)
            ->withGlobalSearch(columns: ['id', 'name'])
            ->defaultSort('name')
            ->column('id', sortable: true)
            ->column('name', sortable: true)
            ->column('updated_at', sortable: true)
            ->column('action')
            ->paginate(15)

    ]); 
    } 
    

    public function update(Request $request, Tree $tree)
    {
        // Validate the request data as needed
        $request->validate([
            'name' => 'required|string|max:255',
        ]);
        

        $tree->update($request->all());

        Toast::title('Success')->message('Tree has been updated.')->success()->rightTop()->autoDismiss(3);

        return Redirect::route('admin.trees.edit', $tree->id)->with('status', 'tree-updated');
    } 

    // Store a new tree in the database
    public function store(Request $request) 
    {
        $request->validate([
            'name' => 'required|string|max:255',
            // Add validation rules for other tree attributes
        ]);

        // Create a new tree in the database
        Tree::create($request->all());

        // Redirect back to the form with a success message
        return redirect()->route('admin.trees.index')->with('success', 'Tree added successfully');
    } 

    public function destroy(Request $request, $treeId) {
        
        $tree = Tree::find($treeId);

        if(!$tree) {
            Toast::title('Error!')->message('Tree cannot be deleted.')->error()->rightTop()->autoDismiss(3); 
        }

        $tree->delete(); 

        Toast::title('Success')->message('Tree has been deleted.')->success()->rightTop()->autoDismiss(3); 
        // Redirect to the tree list or another appropriate page after deletion
        return redirect()->route('admin.trees.index')->with('success', 'Tree deleted successfully'); 
    }
    
}
 