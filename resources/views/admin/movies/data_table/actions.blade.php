<a href="{{route('admin.movies.show',$id)}}"   class="btn btn-primary btn-sm "><i class="fa fa-eye"></i> @lang('site.show')</a>

@if (auth()->user()->hasPermission('delete_movies'))
    <form action="{{ route('admin.movies.destroy', $id) }}" class="my-1 my-xl-0" method="post" style="display: inline-block;">
        @csrf
        @method('delete')
        <button type="submit" class="btn btn-danger btn-sm delete"><i class="fa fa-trash"></i> @lang('site.delete')</button>
    </form>
@endif
