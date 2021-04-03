<div>
    <form class="form_search" role="form" action="{{route('search')}}">

        @csrf

        <input id="query search-autocomplete" type="search" name="search"
               placeholder="ابحث هنا ..." class="nav-search nav-search-field"
               aria-expanded="true">
        <button type="submit" class="btn-search">
            <i class="ti-search"></i>
        </button>
    </form>
</div>
