@extends('layouts.admin')
@section('content')

    <main>
        <div class="container-fluid px-4">
            <div class="my-3">
                <h3 class="my-4 d-inline">Items Create</h3>
                <a href="{{route('items.index')}}" class="btn btn-danger float-end">Cancel</a>
            </div>

            <div class="card mb-4">
                <div class="card-body py-5">
                    <div class="row">
                        <div class="offset-md-1 col-md-10">
                            <form action="{{route('items.store')}}" method="POST" enctype="multipart/form-data">
                                {{csrf_field()}}
                                <div class="mb-3">
                                    <label for="codeNo" class="form-label">Code No</label>
                                    <input type="text" class="form-control" name="codeNo" id="codeNo">
                                </div>
                                <div class="mb-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" class="form-control" name="name" id="name">
                                </div>
                                <div class="mb-3">
                                    <label for="image" class="form-label">Image</label>
                                    <input type="file" accept="image/*" class="form-control" name="image" id="image">
                                </div>
                                <div class="mb-3">
                                    <label for="price" class="form-label">Price</label>
                                    <input type="text" class="form-control" name="price" id="price">
                                </div>
                                <div class="mb-3">
                                    <label for="discount" class="form-label">Discount</label>
                                    <input type="text" class="form-control" name="discount" id="discount">
                                </div>
                                <div class="mb-3">
                                    <label for="inStock" class="form-label">InStock</label>
                                    <select class="form-select" name="inStock">
                                        <option value="1" selected>Yes</option>
                                        <option value="0">No</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="category" class="form-label">Category</label>
                                    <select class="form-select" name="category_id">
                                        <option value="">Choose Category</option>
                                        @foreach($categories as $category)
                                            <option value="{{$category->id}}">{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="description">Description</label>
                                    <textarea name="description" id="description" class="form-control"></textarea>
                                </div>
                                <div class="d-grid gap-2">
                                    <button class="btn btn-primary" type="submit">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection