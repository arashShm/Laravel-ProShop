@component('admin.layouts.content', ['title' => 'Edit Product'])
    @slot('breadcrumb')
        <li class="breadcrumb-item"><a href="{{ route('admin.main') }}">Admin Panel</a></li>
        <li class="breadcrumb-item active">Edit Product</li>
        <li class="breadcrumb-item "><a href="{{ route('admin.products.index') }}">Product List</a></li>
    @endslot


    @slot('script')
        <script>
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

            $('.attribute-select').select2({
                tags: true
            });
        </script>
    @endslot


    <div class="row">
        <div class="col-lg-12">
            @include('admin.layouts.errors')
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Product Edit Form</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <div id="attributes" data-attributes="{{ json_encode(\App\Models\Attribute::all()->pluck('name')) }}"></div>
                <form class="form-horizontal" method="POST" action="{{ route('admin.products.update', $product->id) }}"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="card-body">
                        <div class="form-group">
                            <label for="inputTitle" class="col-sm-2 control-label">Product Name</label>
                            <input type="text" name="title" class="form-control" id="inputTitle"
                                placeholder="Enter Your permission" value="{{ old('title', $product->title) }}">
                        </div>
                        <div class="form-group">
                            <label for="label" class="col-sm-2 control-label">Description</label>
                            <textarea class="form-control" name="description" id="description" value="">{{ old('description', $product->description) }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="inputTitle" class="col-sm-2 control-label">Price</label>
                            <input type="number" name="price" class="form-control" id="inputPrice"
                                placeholder="Enter Your price" value="{{ old('price', $product->price) }}">
                        </div>
                        <div class="form-group">
                            <hr>
                            <label for="inputTitle" class="col-sm-2 control-label">Upload Image</label>
                            <div class="input-group mb-2">
                                <input type="text" id="image_label" class="form-control" name="image" dir="ltr"
                                    value="{{ $product->image }}">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary" type="button"
                                        id="button-image">Select</button>
                                </div>
                            </div>
                            <img src="{{ $product->image }}" class="m-25 w-50 h-50">
                        </div>
                        <div class="form-group">
                            <label for="inputTitle" class="col-sm-2 control-label">Count</label>
                            <input type="number" name="inventory" class="form-control" id="inputCount"
                                placeholder="Enter Your count" value="{{ old('inventory', $product->inventory) }}">
                        </div>
                        <div class="form-group">
                            <label for="label" class="col-sm-2 control-label">Categories</label>
                            <select class="form-control" name="categories[]" id="categories" multiple>
                                @foreach (\App\Models\Category::all() as $category)
                                    <option value="{{ $category->id }}"
                                        {{ in_array($category->id, $product->categories->pluck('id')->toArray()) ? 'selected' : '' }}>
                                        {{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <h6>Features</h6>
                            <hr>
                            <div id="attribute_section">
                                @foreach ($product->attributes as $attribute)
                                    <div class="row" id="attribute-{{ $loop->index }}">
                                        <div class="col-5">
                                            <div class="form-group">
                                                <label>Feature Name</label>
                                                <select name="attributes[{{ $loop->index }}][name]"
                                                    onchange="changeAttributeValues(event, {{ $loop->index }});"
                                                    class="attribute-select form-control">
                                                    <option value="">Please Choose</option>
                                                    @foreach (\App\Models\Attribute::all() as $attr)
                                                        <option value="{{ $attr->name }}"
                                                            {{ $attr->name == $attribute->name ? 'selected' : '' }}>
                                                            {{ $attr->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-5">
                                            <div class="form-group">
                                                <label>Feature Value</label>
                                                <select name="attributes[{{ $loop->index }}][value]"
                                                    class="attribute-select form-control">
                                                    <option value="">Please Choose</option>
                                                    @foreach ($attribute->values as $value)
                                                        <option value="{{ $value->value }}"
                                                            {{ $value->id === $attribute->pivot->value_id ? 'selected' : '' }}>
                                                            {{ $value->value }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-2">
                                            <label>Proceedings</label>
                                            <div>
                                                <button type="button" class="btn btn-sm btn-warning"
                                                    onclick="document.getElementById('attribute-{{ $loop->index }}').remove()">Delete</button>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <button class="btn btn-primary btn-sm" type="button" id="add_product_attribute">New
                                Feature</button>
                        </div>


                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-info">Confirm</button>
                            <a href="{{ route('admin.products.index') }}" class="btn btn-danger float-left">Cancel</a>
                        </div>
                        <!-- /.card-footer -->
                </form>
            </div>
        </div>
    </div>
@endcomponent
