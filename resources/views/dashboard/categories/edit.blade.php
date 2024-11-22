<x-layout bodyClass="g-sidenav-show bg-gray-200">
    <x-navbars.sidebar activePage='categories'></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Edit Category"></x-navbars.navs.auth>
        <!-- End Navbar -->

        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header pb-0">
                            <h6>Edit Category</h6>
                            <a href="{{ route('categories.index') }}" class="btn btn-primary btn-sm">Back</a>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="input-group input-group-static mt-3">
                                    <label for="name" >Name</label>
                                    <input type="text" class="form-control" id="name" name="name" value="{{ $category->name }}">
                                </div>
                                
                                <div class="input-group input-group-static mt-3">
                                    <label for="description" >Description</label>
                                    <textarea class="form-control" id="description" name="description" rows="3">{{ $category->description }}</textarea>
                                </div>

                                <div class="input-group input-group-static mt-3">
                                    <label for="image" >Image</label>
                                    <input type="file" class="form-control" id="image" name="image">
                                </div>
                                
                                <button type="submit" class="btn btn-primary mt-3">Update</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>            
        </div>
    </main>
</x-layout>
