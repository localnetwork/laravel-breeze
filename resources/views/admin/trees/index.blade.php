<x-app-layout>
    <div class="container">
        <x-splade-link href="/admin/trees/create" preserve-scroll>Add Tree</x-splade-link>
        <x-splade-table :for="$trees">
            @cell('action', $tree)
                <Link href="/admin/trees/{{ $tree->id }}" class="font-bold text-indigo-600">
                    Edit
                </Link>
                <Link confirm="Do you want to delete this tree?"
                confirm-button="Yes, please delete!"
                cancel-button="Cancel!" method="DELETE" href="{{ route('admin.trees.destroy', $tree) }}" class="ml-[5px] font-bold text-[red]">
                    Delete
                </Link>
            @endcell
        </x-splade-table>
    </div>
</x-app-layout>