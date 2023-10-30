<x-app-layout>
    <div class="container">
        <h1>Add a New Tree</h1>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('admin.trees.store') }}">
            @csrf

            <div class="form-group">
                <label for="name">Tree Name</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}">
            </div>

            <!-- Add more fields for other tree attributes -->

            <button type="submit" class="btn btn-primary">Add Tree</button>
        </form>
    </div> 
</x-app-layout> 