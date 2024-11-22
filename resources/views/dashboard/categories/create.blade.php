<x-layout bodyClass="g-sidenav-show  bg-gray-200">
    <x-navbars.sidebar activePage='categories'></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Category"></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header pb-0">
                            <h6>Create Category</h6>
                            <a href="{{ route('categories.index') }}" class="btn btn-primary btn-sm">Back</a>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="input-group input-group-static mt-3">
                                    <label for="name" class="">Name</label>
                                    <input type="text" class="form-control" id="name" name="name">
                                  </div>
                                  <div class="input-group input-group-static mt-3">
                                  <label for="description" class="">Description</label>
                                  <textarea name="description" class="form-control" rows="3" spellcheck="false"></textarea>
                                </div>
                                <div class="input-group input-group-static mt-3">
                                    <label for="image" class="">Image</label>
                                    <input type="file" class="form-control" id="image" name="image">
                                </div>
                                <button type="submit" class="btn btn-primary mt-3">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>            
        </div>
    </main>
</x-layout>
