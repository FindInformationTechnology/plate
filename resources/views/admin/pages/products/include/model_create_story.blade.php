<div class="modal fade" tabindex="-1" id="kt_modal_1">
    <div class="modal-dialog">
    <!-- <form class="form d-flex flex-column flex-lg-row"  id="myForm"> -->
    <form class="form d-flex flex-column flex-lg-row"  method="POST" enctype="multipart/form-data"
    action="{{ route('admin.stories.store') }}">

    @csrf
   
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Story</h3>

                <input type="number" name="product_id" hidden class="form-control  " value="{{$variant->product->id}}" id="product_id"/>
               
                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                </div>
                <!--end::Close-->
            </div>

            <div class="modal-body">
                <div class="mb-10">
                <label for="exampleFormControlInput1" class="required form-label">Type</label>
                    <select class="form-select" name="type" aria-label="Select example" id="type">
                        <option> select type</option>
                        @foreach ($storyTypes as $type)
                        <option value="{{ $type->value }}">{{ $type->name }}</option>
                        @endforeach
                        
                    </select>
                </div>
                <div class="mb-10">
                    <label for="exampleFormControlInput1" class="required form-label">Featured File</label>
                  
                    <input type="file" class="form-control mb-2" name="source" id="source" required>
                                                                                                    
                </div>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
        </div>

    </form>

    </div>
</div>