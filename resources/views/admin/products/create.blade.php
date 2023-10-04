@component('admin.layouts.content', ['title' => 'Create Product'])
    @slot('breadcrumb')
        <li class="breadcrumb-item"><a href="{{ route('admin.main') }}">Admin Panel</a></li>
        <li class="breadcrumb-item active">Create Product</li>
        <li class="breadcrumb-item "><a href="{{ route('admin.products.index') }}">Product List</a></li>
    @endslot


    @slot('script')
        <script src="/js/ckeditor5-build-classic/ckeditor.js"></script>


        {{-- <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
        <script>
            tinymce.init({
                selector: '#description'
            });
        </script> --}}

        <script>
             ClassicEditor
                 .create(document.querySelector('#description'))
                .catch(error => {
                     console.error(error);
                 });



            document.addEventListener("DOMContentLoaded", function() {

                document.getElementById('button-image').addEventListener('click', (event) => {
                    event.preventDefault();

                    window.open('/file-manager/fm-button', 'fm', 'width=1400,height=800');
                });
            });

            // set file link
            function fmSetLink($url) {
                document.getElementById('image_label').value = $url;
            }




            $('#categories').select2({
                'placeholder': 'دسترسی مورد نظر را انتخاب کنید'
            })


            let changeAttributeValues = (event, id) => {
                let valueBox = $(`select[name='attributes[${id}][value]']`);


                //
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': document.head.querySelector('meta[name="csrf-token"]').content,
                        'Content-Type': 'application/json'
                    }
                })
                //
                $.ajax({
                    type: 'POST',
                    url: '/admin/attribute/values',
                    data: JSON.stringify({
                        name: event.target.value
                    }),
                    success: function(res) {
                        valueBox.html(`
                        <option value="" selected>انتخاب کنید</option>
                        ${
                            res.data.map(function (item) {
                                return `<option value="${item}">${item}</option>`
                            })
                        }
                    `);
                    }
                });
            }

            let createNewAttr = ({
                attributes,
                id
            }) => {

                return `
                <div class="row" id="attribute-${id}">
                    <div class="col-5">
                        <div class="form-group">
                             <label>عنوان ویژگی</label>
                             <select name="attributes[${id}][name]" onchange="changeAttributeValues(event, ${id});" class="attribute-select form-control">
                                <option value="">انتخاب کنید</option>
                                ${
                                    attributes.map(function(item) {
                                        return `<option value="${item}">${item}</option>`
                                    })
                                }
                             </select>
                        </div>
                    </div>
                    <div class="col-5">
                        <div class="form-group">
                             <label>مقدار ویژگی</label>
                             <select name="attributes[${id}][value]" class="attribute-select form-control">
                                    <option value="">انتخاب کنید</option>
                             </select>
                        </div>
                    </div>
                     <div class="col-2">
                        <label >اقدامات</label>
                        <div>
                            <button type="button" class="btn btn-sm btn-warning" onclick="document.getElementById('attribute-${id}').remove()">حذف</button>
                        </div>
                    </div>
                </div>
            `
            }

            $('#add_product_attribute').click(function() {
                let attributesSection = $('#attribute_section');
                let id = attributesSection.children().length;

                let attributes = $('#attributes').data('attributes');

                attributesSection.append(
                    createNewAttr({
                        attributes,
                        id
                    })
                );

                $('.attribute-select').select2({
                    tags: true
                });
            });
        </script>
    @endslot





    <div class="row">
        <div class="col-lg-12">
            @include('admin.layouts.errors')
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Product Create Form</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->

                <div id="attributes" data-attributes="{{ json_encode(\App\Models\Attribute::all()->pluck('name')) }}"></div>
                <form class="form-horizontal" method="POST" action="{{ route('admin.products.store') }}"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="inputTitle" class="col-sm-2 control-label">Product Name</label>
                            <input type="text" name="title" class="form-control" id="inputTitle"
                                placeholder="Enter Your permission" value="{{ old('title') }}">
                        </div>
                        <div class="form-group">
                            <label for="label" class="col-sm-2 control-label">Description</label>
                            <textarea class="form-control" name="description" id="description" cols="30" rows="10"
                                value="{{ old('description') }}"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="inputTitle" class="col-sm-2 control-label">Price</label>
                            <input type="number" name="price" class="form-control" id="inputPrice"
                                placeholder="Enter Your price" value="{{ old('price') }}">
                        </div>
                        <div class="form-group">
                            <label for="inputTitle" class="col-sm-2 control-label">Upload Image</label>
                            <div class="input-group">
                                <input type="text" id="image_label" class="form-control" name="image">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary" type="button"
                                        id="button-image">Select</button>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputTitle" class="col-sm-2 control-label">Count</label>
                            <input type="number" name="inventory" class="form-control" id="inputCount"
                                placeholder="Enter Your count" value="{{ old('inventory') }}">
                        </div>
                        <div class="form-group">
                            <label for="label" class="col-sm-2 control-label">Categories</label>
                            <select class="form-control" name="categories[]" id="categories" multiple>
                                @foreach (\App\Models\Category::all() as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <h6>Features</h6>
                            <hr>
                            <div id="attribute_section"></div>
                            <button class="btn btn-primary btn-sm" type="button" id="add_product_attribute">New
                                Feature</button>
                        </div>

                        <!-- /.card-body -->
                        <div class="card-footer mt-5">
                            <button type="submit" class="btn btn-info">Confirm</button>
                            <a href="{{ route('admin.products.index') }}" class="btn btn-danger float-left">Cancel</a>
                        </div>
                        <!-- /.card-footer -->
                </form>
            </div>
        </div>
    </div>
@endcomponent
