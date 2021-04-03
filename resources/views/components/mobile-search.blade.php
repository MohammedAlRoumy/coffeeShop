<li class="onhover-div mobile-search">
    <div><img src="{{asset('frontend/assets/images/icon/search.png')}}"
              onclick="openSearch()"
              class="img-fluid blur-up lazyload" alt=""> <i class="ti-search"
                                                            onclick="openSearch()"></i>
    </div>
    <div id="search-overlay" class="search-overlay">
        <div><span class="closebtn" onclick="closeSearch()"
                   title="Close Overlay">×</span>
            <div class="overlay-content">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-12">
                            <form action="{{route('search')}}" >
                                @csrf
                                <div class="form-group">
                                    <input type="search" name="search" class="form-control"
                                           id="exampleInputPassword1"
                                           placeholder="ابحث هنا ...">
                                </div>
                                <button type="submit" class="btn btn-primary"><i
                                        class="fa fa-search"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</li>
