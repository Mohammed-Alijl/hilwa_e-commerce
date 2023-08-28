@extends('dashboard.layouts.master')
@section('title',__('Front-end/pages/products.add.product'))
@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- default icons used in the plugin are from Bootstrap 5.x icon library (which can be enabled by loading CSS below) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.min.css"
          crossorigin="anonymous">
    <!-- the fileinput plugin styling CSS file -->
    <link href="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.5.0/css/fileinput.min.css" media="all"
          rel="stylesheet" type="text/css"/>
    <!-- if using RTL (Right-To-Left) orientation, load the RTL CSS file after fileinput.css by uncommenting below -->
    <!-- link href="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.5.0/css/fileinput-rtl.min.css" media="all" rel="stylesheet" type="text/css" /-->
    <!-- the jQuery Library -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
    <!-- buffer.min.js and filetype.min.js are necessary in the order listed for advanced mime type parsing and more correct
         preview. This is a feature available since v5.5.0 and is needed if you want to ensure file mime type is parsed
         correctly even if the local file's extension is named incorrectly. This will ensure more correct preview of the
         selected file (note: this will involve a small processing overhead in scanning of file contents locally). If you
         do not load these scripts then the mime type parsing will largely be derived using the extension in the filename
         and some basic file content parsing signatures. -->
    <script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.5.0/js/plugins/buffer.min.js"
            type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.5.0/js/plugins/filetype.min.js"
            type="text/javascript"></script>
    <!-- piexif.min.js is needed for auto orienting image files OR when restoring exif data in resized images and when you
        wish to resize images before upload. This must be loaded before fileinput.min.js -->
    <script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.5.0/js/plugins/piexif.min.js"
            type="text/javascript"></script>
    <!-- sortable.min.js is only needed if you wish to sort / rearrange files in initial preview.
        This must be loaded before fileinput.min.js -->
    <script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.5.0/js/plugins/sortable.min.js"
            type="text/javascript"></script>
    <!-- bootstrap.bundle.min.js below is needed if you wish to zoom and preview file content in a detail modal
        dialog. bootstrap 5.x or 4.x is supported. You can also use the bootstrap js 3.3.x versions. -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"
            crossorigin="anonymous"></script>
    <!-- the main fileinput plugin script JS file -->

@endsection
@section('page-header')
    <div class="row mb-2 mb-xl-3">
        <div class="col-auto d-none d-sm-block">
            <h3>
                <strong>{{__('Front-end/pages/products.title')}}</strong>
                / {{__('Front-end/pages/products.add.product')}}
            </h3>
        </div>
    </div>
@endsection
@section('content')
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            <div class="alert-message">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif
    <form action="{{route('products.store')}}" method="post" id="create_user" enctype="multipart/form-data"
          class="needs-validation" novalidate>
        @csrf
        <label class="form-check">
            <input class="form-check-input" type="radio" value="simple" name="product_type" checked>
            <span class="form-check-label">{{__('Front-end/pages/products.simple_product')}}</span>
        </label>
        <label class="form-check">
            <input class="form-check-input" type="radio" value="complex" name="product_type">
            <span class="form-check-label">{{__('Front-end/pages/products.complex_product')}}</span>
        </label>
        <br>
        <div class="col-md-12">
            <div class="tab">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item"><a class="nav-link active" href="#product-info" data-bs-toggle="tab"

                                            role="tab"> {{__('Front-end/pages/products.product_info')}}</a></li>
                    <li class="nav-item"><a class="nav-link" href="#product-discounts" data-bs-toggle="tab"
                                            role="tab"> {{__('Front-end/pages/products.product_discounts')}}</a></li>
                    <li class="nav-item"><a class="nav-link" href="#related-products" data-bs-toggle="tab"
                                            role="tab"> {{__('Front-end/pages/products.related_products')}}</a></li>
                    <li class="nav-item"><a class="nav-link" href="#restrictedIn-products" data-bs-toggle="tab"
                                            role="tab"> {{__('Front-end/pages/products.restricted_in')}}</a></li>
                    <li class="nav-item"><a class="nav-link" href="#products-featured" data-bs-toggle="tab"
                                            role="tab"> {{__('Front-end/pages/products.featured')}}</a></li>
                    <li class="nav-item complex-product" style="display: none"><a class="nav-link" href="#attributes" data-bs-toggle="tab"
                                                            role="tab"> {{__('Front-end/pages/products.attributes')}}</a>
                    </li>
                    <li class="nav-item complex-product" style="display: none"><a class="nav-link" href="#variations" data-bs-toggle="tab"
                                                            role="tab"> {{__('Front-end/pages/products.variations')}}</a>
                    </li>

                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="product-info" role="tabpanel">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title"><i class="align-middle me-2"
                                                          data-feather="info"></i>{{__('Front-end/pages/products.product_info')}}
                                </h5>
                            </div>
                            <div class="card-body">

                                <div class="row">
                                    <div class="mb-3 col-md-6">
                                        <label class="form-label"
                                               for="name_en">{{__('Front-end/pages/products.name_en')}}</label>
                                        <input type="text" class="form-control" id="name_en" name="name_en"
                                               placeholder="{{__('Front-end/pages/products.name')}}" autocomplete="off"
                                               required>
                                        <div class="valid-feedback">
                                            {{__('Front-end/pages/products.name.valid')}}
                                        </div>
                                        <div class="invalid-feedback">
                                            {{__('Front-end/pages/products.name.invalid')}}
                                        </div>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label class="form-label"
                                               for="name_ar">{{__('Front-end/pages/products.name_ar')}}</label>
                                        <input type="text" class="form-control" id="name_ar" name="name_ar"
                                               placeholder="{{__('Front-end/pages/products.name')}}" autocomplete="off"
                                               required>
                                        <div class="valid-feedback">
                                            {{__('Front-end/pages/products.name.valid')}}
                                        </div>
                                        <div class="invalid-feedback">
                                            {{__('Front-end/pages/products.name.invalid')}}
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="mb-3 col-md-6">
                                        <label class="form-label"
                                               for="description_en">{{__('Front-end/pages/products.description_en')}}</label>
                                        <textarea name="description_en" id="description_en" required>
                                        </textarea>
                                        <div class="valid-feedback">
                                            {{__('Front-end/pages/products.description_en.valid')}}
                                        </div>
                                        <div class="invalid-feedback">
                                            {{__('Front-end/pages/products.description_en.invalid')}}
                                        </div>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label class="form-label"
                                               for="description_ar">{{__('Front-end/pages/products.description_ar')}}</label>
                                        <textarea name="description_ar" id="description_ar" required placeholder="Write The Arabic Description Here!">
                                        </textarea>
                                        <div class="valid-feedback">
                                            {{__('Front-end/pages/products.description_ar.valid')}}
                                        </div>
                                        <div class="invalid-feedback">
                                            {{__('Front-end/pages/products.description_ar.invalid')}}
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="mb-3 col-md-6">
                                        <label class="form-label"
                                               for="sku">{{__('Front-end/pages/products.sku')}}</label>
                                        <input type="text" class="form-control" id="sku" name="sku"
                                               placeholder="{{__('Front-end/pages/products.sku')}}" autocomplete="off"
                                               required>
                                        <div class="valid-feedback">
                                            {{__('Front-end/pages/products.sku.valid')}}
                                        </div>
                                        <div class="invalid-feedback">
                                            {{__('Front-end/pages/products.sku.invalid')}}
                                        </div>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label class="form-label"
                                               for="weight_in_points">{{__('Front-end/pages/products.weight_in_points')}}</label>
                                        <input type="text" class="form-control" id="weight_in_points"
                                               name="weight_in_points"
                                               oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"
                                               placeholder="{{__('Front-end/pages/products.weight_in_points')}}"
                                               autocomplete="off"
                                               required value="0" min="0">
                                        <div class="valid-feedback">
                                            {{__('Front-end/pages/products.points.valid')}}
                                        </div>
                                        <div class="invalid-feedback">
                                            {{__('Front-end/pages/products.points.invalid')}}
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="mb-3 col-md-6">
                                        <label class="form-label"
                                               for="price">{{__('Front-end/pages/products.price')}}</label>
                                        <input type="text" class="form-control" id="price" name="price"
                                               oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"
                                               placeholder="{{__('Front-end/pages/products.price')}}" autocomplete="off"
                                               required min="0">
                                        <div class="valid-feedback">
                                            {{__('Front-end/pages/products.price.valid')}}
                                        </div>
                                        <div class="invalid-feedback">
                                            {{__('Front-end/pages/products.price.invalid')}}
                                        </div>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label class="form-label"
                                               for="spacial_price">{{__('Front-end/pages/products.spacial_price')}}</label>
                                        <input type="text" class="form-control" id="spacial_price" name="spacial_price"
                                               oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"
                                               placeholder="{{__('Front-end/pages/products.spacial_price')}}"
                                               autocomplete="off"
                                               required min="0">
                                        <div class="valid-feedback">
                                            {{__('Front-end/pages/products.points.valid')}}
                                        </div>
                                        <div class="invalid-feedback">
                                            {{__('Front-end/pages/products.points.invalid')}}
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="mb-3 col-md-6">
                                        <label class="form-label"
                                               for="min_quantity">{{__('Front-end/pages/products.min_quantity')}}</label>
                                        <input type="text" class="form-control" id="min_quantity" name="min_quantity"
                                               oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"
                                               placeholder="{{__('Front-end/pages/products.min_quantity')}}"
                                               autocomplete="off"
                                               required min="1">
                                        <div class="valid-feedback">
                                            {{__('Front-end/pages/products.min_quantity.valid')}}
                                        </div>
                                        <div class="invalid-feedback">
                                            {{__('Front-end/pages/products.min_quantity.invalid')}}
                                        </div>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label class="form-label"
                                               for="max_quantity">{{__('Front-end/pages/products.max_quantity')}}</label>
                                        <input type="text" class="form-control" id="max_quantity" name="max_quantity"
                                               oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"
                                               placeholder="{{__('Front-end/pages/products.max_quantity')}}"
                                               autocomplete="off"
                                               required min="0">
                                        <div class="valid-feedback">
                                            {{__('Front-end/pages/products.max_quantity.valid')}}
                                        </div>
                                        <div class="invalid-feedback">
                                            {{__('Front-end/pages/products.max_quantity.invalid')}}
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="mb-3 col-md-6">
                                        <label class="form-label"
                                               for="category">{{__('Front-end/pages/products.category')}}</label>
                                        <select id="category" class="form-control choices-single" name="category_id"
                                                required>
                                            @foreach($categories as $category)
                                                <option value="{{$category->id}}">{{$category->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label class="form-label"
                                               for="unit">{{__('Front-end/pages/products.unit')}}</label>
                                        <select id="unit" class="form-control choices-single" name="unit_id" required>
                                            @foreach($units as $unit)
                                                <option value="{{$unit->id}}">{{$unit->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="mb-3 col-md-6">
                                        <label class="form-label"
                                               for="status">{{__('Front-end/pages/products.status')}}</label>
                                        <select name="status" id="status" class="form-control choices-single" required>
                                            <option value="1">{{__('Front-end/pages/products.enable')}}</option>
                                            <option value="0">{{__('Front-end/pages/products.disable')}}</option>
                                        </select>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label class="form-label"
                                               for="show_customer_app">{{__('Front-end/pages/products.show_customer_app')}}</label>
                                        <select name="show_customer_app" id="show_customer_app"
                                                class="form-control choices-single" required>
                                            <option value="1">{{__('Front-end/pages/products.enable')}}</option>
                                            <option value="0">{{__('Front-end/pages/products.disable')}}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="mb-3 col-md-6">
                                        <label class="form-label"
                                               for="stock_quantity">{{__('Front-end/pages/products.stock_quantity')}}</label>
                                        <input type="text" class="form-control" id="stock_quantity"
                                               name="stock_quantity"
                                               oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"
                                               placeholder="{{__('Front-end/pages/products.stock_quantity')}}"
                                               autocomplete="off"
                                               required min="0">
                                        <div class="valid-feedback">
                                            {{__('Front-end/pages/products.stock_quantity.valid')}}
                                        </div>
                                        <div class="invalid-feedback">
                                            {{__('Front-end/pages/products.stock_quantity.invalid')}}
                                        </div>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label class="form-label"
                                               for="stock_status">{{__('Front-end/pages/products.stock_status')}}</label>
                                        <select name="stock_status" id="stock_status"
                                                class="form-control choices-single" required>
                                            <option value="0">{{__('Front-end/pages/products.in_stock')}}</option>
                                            <option value="1">{{__('Front-end/pages/products.out_of_stock')}}</option>
                                            <option value="2">{{__('Front-end/pages/products.2_3_days')}}</option>
                                            <option value="3">{{__('Front-end/pages/products.4_7_days')}}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">

                                </div>
                                <input id="input-b3" name="images[]" type="file" class="file" multiple required
                                       data-show-upload="false" data-show-caption="true"
                                       data-msg-placeholder="Select images for upload...">
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="product-discounts" role="tabpanel">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title"><i
                                        class="align-middle me-2 fas fa-fw fa-percentage"></i>{{__('Front-end/pages/products.product_discounts')}}
                                </h5>
                            </div>
                            <div class="card-body" id="discount-container">
                                <div class="row">
                                    <div class="mb-3 col-md-6">
                                        <button class="btn btn-primary"
                                                id="add-discount">{{__('Front-end/pages/products.add_discount')}}</button>
                                    </div>
                                </div>
                                <br>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="related-products" role="tabpanel">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title"><i
                                        class="align-middle me-2 fas fa-fw fa-tasks"></i> {{__('Front-end/pages/products.related_products')}}
                                </h5>
                            </div>
                            <div class="card-body">
                                <select name="related_products[]" class="form-control related-products" multiple>
                                    @foreach($products as $product)
                                        <option value="{{$product->id}}">{{$product->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="restrictedIn-products" role="tabpanel">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title"><i class="align-middle me-2"
                                                          data-feather="alert-triangle"></i> {{__('Front-end/pages/products.restricted_in')}}
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <label for="inputState"
                                           class="form-label">{{__('Front-end/pages/products.states')}}</label>
                                    <select class="form-control states" multiple id="inputState" name="states[]">
                                        @foreach($states as $state)
                                            <option value="{{$state->id}}">{{$state->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="row">
                                    <label for="inputCity"
                                           class="form-label">{{__('Front-end/pages/products.cities')}}</label>
                                    <select class="form-control cities" multiple id="inputCity" name="cities[]">
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="products-featured" role="tabpanel">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title"><i class="align-middle me-2"
                                                          data-feather="star"></i> {{__('Front-end/pages/products.featured')}}
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="mb-3 col-md-4">
                                        <label
                                            class="form-label">{{__('Front-end/pages/products.featured.date')}}</label>
                                        <input type="text" class="form-control featured-range"
                                               placeholder="{{__('Front-end/pages/products.select.date')}}"
                                               name="featured_date"/>
                                    </div>
                                    <div class="mb-3 col-md-4">
                                        <label for="display-order"
                                               class="form-label">{{__('Front-end/pages/products.display_order')}}</label>
                                        <input id="display-order" type="text" class="form-control"
                                               placeholder="{{__('Front-end/pages/products.display_order')}}"
                                               oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"
                                               name="display_order"
                                        />
                                    </div>
                                    <div class="mb-3 col-md-4">
                                        <label class="form-label"
                                               for="featured-status">{{__('Front-end/pages/products.status')}}</label>
                                        <select name="featured_status" id="featured-status"
                                                class="form-control choices-single">
                                            <option value="" selected
                                                    disabled>{{__('Front-end/pages/products.choose')}}</option>
                                            <option value="1">{{__('Front-end/pages/products.enable')}}</option>
                                            <option value="0">{{__('Front-end/pages/products.disable')}}</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane complex-product" id="attributes" role="tabpanel" style="display: none">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title"><i
                                        class="align-middle me-2 far fa-fw fa-list-alt"></i> {{__('Front-end/pages/products.attributes')}}
                                </h5>
                            </div>
                            <div class="card-body attributesContainer">
                                <div class="row">
                                    <label for="inputAttributes"
                                           class="form-label">{{__('Front-end/pages/products.attributes')}}</label>
                                    <select class="form-control" id="inputAttributes">
                                        <option value="" selected
                                                disabled>{{__('Front-end/pages/products.choose')}}</option>
                                        @foreach($attributes as $attribute)
                                            <option value="{{$attribute->id}}">{{$attribute->name}}</option>
                                        @endforeach
                                    </select>
                                    <br>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane complex-product" id="variations" role="tabpanel" style="display: none">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title"><i
                                        class="align-middle me-2 fas fa-fw fa-th-large"></i> {{__('Front-end/pages/products.variations')}}
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="variations-container"></div>
                                <div class="variations-containers"></div>
                            </div>
                        </div>
                    </div>
                        <button type="submit" class="btn btn-square btn-primary">submit</button>
                </div>
            </div>
        </div>
    </form>

@endsection
@section('scripts')
    <script>
        $("#input-b3").fileinput({
            minFileCount: 1,
            theme: 'fas',
            showUpload: false,
            showCaption: true,
            initialPreviewConfig: [
                    @foreach($product->images as $image)
                {
                    caption: '{{ $image->name }}',
                },
                @endforeach
            ],
            initialPreviewAsData: true,
            initialPreviewFileType: 'image',
            initialPreviewShowDelete: false,
        });
    </script>
    <script>
        (function () {
            'use strict';

            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.querySelectorAll('.needs-validation');

            // Loop over them and prevent submission
            Array.prototype.slice.call(forms)
                .forEach(function (form) {
                    form.addEventListener('submit', function (event) {
                        if (!form.checkValidity()) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
        })();
    </script>


    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const container = document.getElementById("discount-container");
            const addButton = document.getElementById("add-discount");
            var rowsNumber = 1;

            addButton.addEventListener("click", function (event) {
                event.preventDefault();
                const newRow = createDiscountRow();
                container.appendChild(newRow);
                const scriptElement = document.createElement("script");
                scriptElement.innerHTML = `
            flatpickr(".flatpickr-range${rowsNumber}", {
                mode: "range",
                dateFormat: "d-m-Y"
            });
        `;
                document.body.appendChild(scriptElement);
                rowsNumber++;
            });

            container.addEventListener("click", function (event) {
                if (event.target && event.target.classList.contains("delete-discount")) {
                    const rowToDelete = event.target.closest(".row");
                    rowToDelete.remove();
                }
            });

            function createDiscountRow() {
                const row = document.createElement("div");
                row.classList.add("row");

                const column1 = createColumn(["mb-3", "col-md-3"], "{{__('Front-end/pages/products.discount_type')}}", 'select');
                const column2 = createColumn(["mb-3", "col-md-3", 'type-value'], '{{__('Front-end/pages/products.fixed')}}', 'price-fixed');
                const column3 = createColumn(["mb-3", "col-md-3"], "{{__('Front-end/pages/products.discount_date')}}", 'discount-date');

                row.appendChild(column1);
                row.appendChild(column2);
                row.appendChild(column3);

                const deleteButton = document.createElement("button");
                deleteButton.classList.add("btn", "btn-danger", "delete-discount");
                deleteButton.type = "button";
                deleteButton.innerHTML = '<i class="fas fa-times"></i>';
                let buttonContainer = document.createElement('div');
                buttonContainer.classList.add("mb-3", "col-md-3");
                buttonContainer.appendChild(document.createElement('br'))
                buttonContainer.appendChild(deleteButton);
                row.appendChild(buttonContainer);
                return row;
            }

            function createColumn(classes, labelText, inputType) {
                const column = document.createElement("div");
                column.classList.add(...classes);

                // Label
                const label = document.createElement("label");
                label.classList.add("form-label");
                label.textContent = labelText;
                column.appendChild(label);

                // Input
                if (inputType === 'select') {
                    let selectDiscountType = document.createElement('select');
                    selectDiscountType.className = "form-control";
                    selectDiscountType.name = "discount_type[]";
                    selectDiscountType.required = true;
                    @foreach(\App\Models\ProductDiscount::getDiscountTypes() as $discount)
                    var discountType = document.createElement('option');
                    discountType.value = "{{$discount}}";
                    discountType.appendChild(document.createTextNode("{{__('Front-end/pages/products.' . $discount)}}"));
                    selectDiscountType.appendChild(discountType);
                    @endforeach
                    selectDiscountType.addEventListener("change", function () {
                        updateDiscountInput(selectDiscountType.value,selectDiscountType);
                    });
                    column.appendChild(selectDiscountType);
                } else if (inputType === 'price-fixed') {
                    let priceFixedInput = document.createElement('input');
                    priceFixedInput.className = "form-control";
                    priceFixedInput.name = "discount_value[]";
                    priceFixedInput.required = true;
                    priceFixedInput.min = 1;
                    priceFixedInput.placeholder = "Price";
                    priceFixedInput.addEventListener("input", function () {
                        this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');
                    });
                    column.appendChild(priceFixedInput);
                } else if (inputType === 'discount-date') {
                    let discountDate = document.createElement("input");
                    discountDate.classList.add('form-control', `flatpickr-range${rowsNumber}`);
                    discountDate.placeholder = '{{__('Front-end/pages/products.select.date')}}';
                    discountDate.name = 'discount_date[]';
                    discountDate.required = true;
                    column.appendChild(discountDate);
                }

                return column;
            }
        });

        function updateDiscountInput(selectedValue, selectElement) {
            const row = selectElement.closest('.row'); // Find the closest row element
            const inputContainer = row.querySelector(".type-value"); // Find the input container within the row

            while (inputContainer.firstChild) {
                inputContainer.removeChild(inputContainer.firstChild);
            }

            if (selectedValue === "fixed") {
                // Create input for fixed discount value
                const priceFixedInput = document.createElement('input');
                priceFixedInput.className = "form-control";
                priceFixedInput.name = "discount_value[]";
                priceFixedInput.required = true;
                priceFixedInput.min = 1;
                priceFixedInput.placeholder = "Price";
                priceFixedInput.addEventListener("input", function () {
                    this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');
                });

                // Create label for fixed discount input
                const label = document.createElement("label");
                label.classList.add("form-label");
                label.textContent = "{{__('Front-end/pages/products.fixed')}}";

                inputContainer.appendChild(label);
                inputContainer.appendChild(priceFixedInput);
            } else if (selectedValue === "percent") {
                // Create input for percentage discount value
                const percentInput = document.createElement('input');
                percentInput.className = "form-control";
                percentInput.name = "discount_value[]";
                percentInput.required = true;
                percentInput.min = 1;
                percentInput.max = 100;
                percentInput.placeholder = 'Percent %';
                percentInput.addEventListener("input", function () {
                    this.value = this.value.replace(/[^0-9]/g, '');

                    if (parseInt(this.value) > 100) {
                        this.value = 100;
                    }
                });

                // Create label for percentage discount input
                const label = document.createElement("label");
                label.classList.add("form-label");
                label.textContent = "{{__('Front-end/pages/products.percent')}}";

                inputContainer.appendChild(label);
                inputContainer.appendChild(percentInput);
            }
        }


    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            new Choices(document.querySelector("#category"));
            new Choices(document.querySelector("#unit"));
            new Choices(document.querySelector("#inputState"));
            let citySelect = new Choices(document.querySelector("#inputCity"));
            new Choices(document.querySelector(".related-products"));
            flatpickr(".featured-range", {
                mode: "range",
                dateFormat: "d-m-Y"
            });

            var optionsArrays = {};
            var combinations = [];

            $('.tab-pane#variations').on('change', '.input-group-text', function () {
                var idCheckbox = $(this).find("input").attr('id');
                var modifiedStringofID = idCheckbox.replace("_", "");

                var previousTabPane = $(this).closest('.tab-pane').prev('.tab-pane#attributes');
                var previousTabPane = previousTabPane.find(`#${modifiedStringofID}`);

                if (!optionsArrays[modifiedStringofID]) {
                    optionsArrays[modifiedStringofID] = [];
                }

                if ($(this).find("input").prop('checked')) {
                    $(previousTabPane).each(function () {
                        var inputId = $(this).attr('id');

                        if (inputId === modifiedStringofID) {
                            var children = previousTabPane.children();

                            for (var i = 0; i < children.length; i++) {
                                var option = children[i].textContent;
                                optionsArrays[modifiedStringofID].push(option);
                            }
                        }
                    });
                } else {
                    delete optionsArrays[modifiedStringofID];
                }

                $('.variations-containers').empty();

                var keys = Object.keys(optionsArrays);

                if (keys.length === 1) {
                    var arrayValues = optionsArrays[keys[0]];
                    for (var i = 0; i < arrayValues.length; i++) {
                        var arrayValue = arrayValues[i];
                        makeVariantContainer(arrayValue, i)
                    }
                }

                if (keys.length >= 2) {
                    combinations = [];
                    generateCombinations(0, []);
                    for (var i = 0; i < combinations.length; i++) {
                        var combinationText = combinations[i].join(' , ');
                        makeVariantContainer(combinationText, i)

                    }
                }
            });

            function makeVariantContainer(titleText, i) {
                let attributeCard = document.createElement('div');
                attributeCard.classList.add('card');
                let attributeCardHeader = document.createElement('div');
                attributeCardHeader.classList.add('card-header');
                let attributeCardHeaderTitle = document.createElement('h5');
                attributeCardHeaderTitle.classList.add('card-title');
                attributeCardHeaderTitle.appendChild(document.createTextNode(titleText));
                attributeCardHeader.appendChild(attributeCardHeaderTitle);


                let variantCardBody = document.createElement('div');
                variantCardBody.classList.add('card-body');
                let variantCardBody_row1 = document.createElement("div");
                variantCardBody_row1.className = "row";
                let variantCardBody_col1 = document.createElement("div");
                variantCardBody_col1.className = "mb-3 col-md-6";
                let variantCardBody_col1_label1 = document.createElement("label");
                variantCardBody_col1_label1.className = "form-label";
                variantCardBody_col1_label1.textContent = "{{__('Front-end/pages/products.price')}}";
                let variantCardBody_col1_input1 = document.createElement("input");
                variantCardBody_col1_input1.type = "text";
                variantCardBody_col1_input1.className = "form-control";
                variantCardBody_col1_input1.id = "variant_price";
                variantCardBody_col1_input1.name = "variant_price[]";
                variantCardBody_col1.appendChild(variantCardBody_col1_label1);
                variantCardBody_col1.appendChild(variantCardBody_col1_input1);
                let variantCardBody_col2 = document.createElement("div");
                variantCardBody_col2.className = "mb-3 col-md-6";
                let variantCardBody_col2_label2 = document.createElement("label");
                variantCardBody_col2_label2.className = "form-label";
                variantCardBody_col2_label2.textContent = "{{__('Front-end/pages/products.stock_quantity')}}";
                let variantCardBody_col2_input2 = document.createElement("input");
                variantCardBody_col2_input2.type = "text";
                variantCardBody_col2_input2.className = "form-control";
                variantCardBody_col2_input2.id = "variant_quantity";
                variantCardBody_col2_input2.name = "variant_quantity[]";

                variantCardBody_col2.appendChild(variantCardBody_col2_label2);
                variantCardBody_col2.appendChild(variantCardBody_col2_input2);

                variantCardBody_row1.appendChild(variantCardBody_col1);
                variantCardBody_row1.appendChild(variantCardBody_col2);

                var variantImageInput = document.createElement("input");
                variantImageInput.id = "variant-input-" + i;
                variantImageInput.name = "variant_image[]";
                variantImageInput.type = "file";
                variantImageInput.className = "file";
                variantImageInput.required = true;
                variantImageInput.setAttribute("data-show-upload", "false");
                variantImageInput.setAttribute("data-show-caption", "true");
                variantImageInput.setAttribute("data-msg-placeholder", "Select images for upload...");

                variantCardBody.appendChild(variantCardBody_row1);
                variantCardBody.appendChild(variantImageInput);
                $(variantImageInput).fileinput({
                    theme: 'fas', // Set the theme to Font Awesome
                    showUpload: false,
                    showCaption: true,
                    browseOnZoneClick: true,
                    msgPlaceholder: "Select images for upload...",
                    allowedFileExtensions: ["jpg", "jpeg", "png", "gif"], // Example list of allowed file extensions
                    // Other options you want to configure
                });
                // variantCardBody.appendChild(variantCardBody_row2);


                attributeCard.appendChild(attributeCardHeader);
                attributeCard.appendChild(variantCardBody);
                $('.variations-containers').append(attributeCard);
            }

            function generateCombinations(index, currentCombination) {
                var keys = Object.keys(optionsArrays);

                if (index === keys.length) {
                    combinations.push(currentCombination);
                    return;
                }

                var currentKey = keys[index];
                var currentArray = optionsArrays[currentKey];

                if (currentArray.length === 0) {
                    generateCombinations(index + 1, currentCombination);
                } else {
                    for (var i = 0; i < currentArray.length; i++) {
                        var newCombination = currentCombination.slice();
                        newCombination.push(currentArray[i]);
                        generateCombinations(index + 1, newCombination);
                    }
                }
            }


            async function updateCityOptions(StateId) {
                if (StateId) {
                    try {
                        const response = await fetch(`{{ URL::to('admin/state-cities') }}/${StateId}`);
                        const data = await response.json();

                        return {StateId, data};
                    } catch (error) {
                        console.error(error);
                        return null;
                    }
                }
                return null;
            }

            function removeCitiesOfState(StateId) {
                const citySelectElement = document.querySelector("#inputCity");
                const cities = citySelectElement.querySelectorAll(`option[data-group="${StateId}"]`);

                cities.forEach(city => {
                    city.remove();
                });
            }

            $('#inputState').on('change', async function () {
                var StatesId = $(this).val();
                var promises = StatesId.map(updateCityOptions);
                var cityOptions = [];

                try {
                    var results = await Promise.all(promises);

                    results.forEach(result => {
                        if (result) {
                            var {StateId, data} = result;
                            $.each(data, function (key, value) {
                                cityOptions.push({value: key, label: value, group: StateId}); // Add each city as an object to the array
                            });
                        }
                    });

                    citySelect.setChoices(cityOptions, 'value', 'label', true, true); // Set all city options at once
                } catch (error) {
                    console.error(error);
                }
            });

            $('#inputState').on('removeItem', function (event) {
                var StateId = event.detail.value;
                removeCitiesOfState(StateId);
            });
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            new Choices(document.querySelector("#inputAttributes"));
            var container = document.querySelector(".attributesContainer");
            var selectedAttributes = [];

            $('#inputAttributes').on('change', function () {
                var selectedAttributeId = $(this).val();
                var selectedAttributeName = $(this).find('option:selected').text();

                // Check if the selected option is already added to the container
                if (selectedAttributeId && selectedAttributeName && !selectedAttributes.includes(selectedAttributeId)) {
                    var row = document.createElement("div");
                    row.classList.add("row");

                    let selectedAttributeContainer = document.createElement('div');
                    selectedAttributeContainer.classList.add('mb-3', 'col-md-9');
                    let selectedAttributeLabel = document.createElement('label');
                    selectedAttributeLabel.textContent = selectedAttributeName;
                    selectedAttributeLabel.classList.add('form-label');
                    selectedAttributeLabel.setAttribute('for', `${selectedAttributeName}${selectedAttributeId}`)
                    let selectedAttributeBox = document.createElement('select');
                    selectedAttributeBox.classList.add('form-control');
                    selectedAttributeBox.name = 'attribute_value_id[]';
                    selectedAttributeBox.id = `${selectedAttributeName}${selectedAttributeId}`;
                    selectedAttributeBox.multiple = true;
                    let attributeId = document.createElement('input');
                    attributeId.type = 'hidden';
                    attributeId.name = 'attribute_id[]';
                    attributeId.setAttribute('value', selectedAttributeId);
                    let attributeScript = document.createElement('script');
                    getAttributeValues(selectedAttributeId).then(function (attributeOptions) {
                        attributeScript.innerHTML = `new Choices(document.querySelector("#${selectedAttributeName}${selectedAttributeId}")).setChoices(${JSON.stringify(attributeOptions)}, 'value', 'label', true);`;
                    });
                    selectedAttributeContainer.appendChild(selectedAttributeLabel);
                    selectedAttributeContainer.appendChild(selectedAttributeBox);
                    selectedAttributeContainer.appendChild(attributeId);


                    let removeAttributeButtonContainer = document.createElement('div');
                    removeAttributeButtonContainer.classList.add('mb-3', 'col-md-3');
                    let removeAttributeButton = document.createElement("button");
                    removeAttributeButton.classList.add("btn", "btn-danger", "delete-discount");
                    removeAttributeButton.innerHTML = '<i class="fas fa-times"></i>';
                    removeAttributeButton.style.cssText = 'margin-top:32px';
                    removeAttributeButtonContainer.appendChild((removeAttributeButton));


                    let variationsContainer = document.querySelector('.variations-container');
                    let variationsRow = document.createElement('div');
                    variationsRow.classList.add('row');
                    let attributeVariationCheckbox = document.createElement('div');
                    attributeVariationCheckbox.classList.add('mb-3', 'col-md-3');
                    let inputGroupVariant = document.createElement('div');
                    inputGroupVariant.classList.add('input-group');
                    let inputGroupTextVariant = document.createElement('div');
                    inputGroupTextVariant.classList.add('input-group-text');
                    let inputGroupTextVariantCheckbox = document.createElement('input');
                    inputGroupTextVariantCheckbox.type = 'checkbox';
                    inputGroupTextVariantCheckbox.id = `${selectedAttributeName}_${selectedAttributeId}`;
                    inputGroupTextVariantCheckbox.classList.add('data-attribute-checkbox');
                    inputGroupTextVariantCheckbox.setAttribute('attribute-id',selectedAttributeId);
                    let variantCheckboxName = document.createElement('input');
                    variantCheckboxName.classList.add('form-control');
                    variantCheckboxName.value = selectedAttributeName;
                    variantCheckboxName.disabled = true;
                    inputGroupTextVariant.appendChild(inputGroupTextVariantCheckbox);
                    inputGroupVariant.appendChild(inputGroupTextVariant);
                    inputGroupVariant.appendChild(variantCheckboxName);
                    attributeVariationCheckbox.appendChild(inputGroupVariant);
                    variationsRow.appendChild(attributeVariationCheckbox);

                    row.appendChild(selectedAttributeContainer);
                    row.appendChild(removeAttributeButtonContainer);
                    container.appendChild(row);
                    document.body.appendChild(attributeScript);
                    selectedAttributes.push(selectedAttributeId)
                    variationsContainer.appendChild(variationsRow);

                    removeAttributeButton.addEventListener('click', function (event) {
                        event.preventDefault();
                        var index = selectedAttributes.indexOf(selectedAttributeId);
                        if (index > -1) {
                            selectedAttributes.splice(index, 1);
                            row.remove();
                            attributeScript.remove();
                            attributeVariationCheckbox.remove();
                            document.querySelector('.variations-containers').innerHTML = '';
                        }
                    });
                    var checkedAttributes = []; // Array to store selected attribute IDs

                    // Event listener for attribute checkboxes
                    $('.attribute-checkbox').on('change', function () {
                        var attributeId = $(this).data('attribute-id');
                        console.log(attributeId);

                        // Update selected attributes array based on checkbox state
                        if (this.checked) {
                            checkedAttributes.push(attributeId);
                        } else {
                            var index = checkedAttributes.indexOf(attributeId);
                            if (index !== -1) {
                                checkedAttributes.splice(index, 1);
                            }
                        }

                        // Regenerate and display variations
                        generateAndDisplayVariations();
                    });

                    function generateAndDisplayVariations() {
                        // Clear existing variations
                        $('.variations-containers').empty();

                        var selectedAttributeIds = $('.attribute-checkbox:checked').map(function () {
                            return $(this).data('attribute-id');
                        }).get();

                        // Generate variations based on selected attributes and values
                        var variations = generateCombinations(selectedAttributeIds);

                        // Display variations
                        variations.forEach(function (variation) {
                            var variationContainer = document.createElement('div');
                            variationContainer.classList.add('variation');
                            variationContainer.textContent = variation.join(', ');
                            $('.variations-containers').append(variationContainer);
                        });
                    }
                    function generateCombinations(selectedAttributeIds) {
                        var variations = [[]];
                        selectedAttributeIds.forEach(function (attributeId) {
                            console.log('test');
                            var attributeValues = getSelectedAttributeValues(attributeId); // Implement this function
                            var newVariations = [];

                            // For each attribute value, duplicate and combine with existing variations
                            attributeValues.forEach(function (value) {
                                variations.forEach(function (existingVariation) {
                                    newVariations.push(existingVariation.concat(value));
                                });
                            });

                            variations = newVariations;
                        });

                        return variations;
                    }
                    function getSelectedAttributeValues(attributeId) {
                        var selectedValues = [];

                        // Find the multi-select box using the attribute ID
                        var multiSelectId = `#${selectedAttributeName}${attributeId}`;
                        console.log(multiSelectId);
                        var multiSelectBox = document.querySelector(multiSelectId);

                        // Retrieve the selected values from the multi-select box
                        var selectedOptions = multiSelectBox.selectedOptions;

                        for (var i = 0; i < selectedOptions.length; i++) {
                            selectedValues.push(selectedOptions[i].value);
                        }

                        return selectedValues;
                    }
                }
            });
        });

        function getAttributeValues(attributeId) {
            return new Promise(function (resolve, reject) {
                let valueOptions = [];
                $.ajax({
                    url: "{{ URL::to('admin/attribute-values') }}/" + attributeId,
                    type: "GET",
                    dataType: "json",
                    success: function (data) {
                        $.each(data, function (key, value) {
                            valueOptions.push({value: key, label: value});
                        });
                        resolve(valueOptions);
                    },
                    error: function (error) {
                        reject(error);
                    }
                });
            });
        }

        rad = document.querySelectorAll('[name="product_type"]');
        for (let i = 0; i < rad.length; i++) {
            rad[i].addEventListener('change', function () {
                let complex_product = document.querySelectorAll('.complex-product');
                if (rad[i].value === 'complex') {
                    for (let j = 0; j < 4; j++)
                        complex_product[j].style.removeProperty('display');
                } else {
                    for (let j = 0; j < 4; j++)
                        complex_product[j].style.cssText = "display:none"
                }
            });
        }
    </script>

    <script src="https://cdn.ckeditor.com/ckeditor5/38.1.1/super-build/ckeditor.js"></script>

    <script>
        ClassicEditor
            .create( document.querySelector( '#description_en' ) )
            .catch( error => {
                console.error( error );
            } );
        ClassicEditor
            .create( document.querySelector( '#description_ar' ) )
            .catch( error => {
                console.error( error );
            } );
    </script>
    <script>
        // This sample still does not showcase all CKEditor 5 features (!)
        // Visit https://ckeditor.com/docs/ckeditor5/latest/features/index.html to browse all the features.
        CKEDITOR.ClassicEditor.create(document.getElementById("description_en"), {
            // https://ckeditor.com/docs/ckeditor5/latest/features/toolbar/toolbar.html#extended-toolbar-configuration-format
            toolbar: {
                items: [
                    'exportPDF','exportWord', '|',
                    'findAndReplace', 'selectAll', '|',
                    'heading', '|',
                    'bold', 'italic', 'strikethrough', 'underline', 'code', 'subscript', 'superscript', 'removeFormat', '|',
                    'bulletedList', 'numberedList', 'todoList', '|',
                    'outdent', 'indent', '|',
                    'undo', 'redo',
                    '-',
                    'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor', 'highlight', '|',
                    'alignment', '|',
                    'link', 'insertImage', 'blockQuote', 'insertTable', 'mediaEmbed', 'codeBlock', 'htmlEmbed', '|',
                    'specialCharacters', 'horizontalLine', 'pageBreak', '|',
                    'textPartLanguage', '|',
                    'sourceEditing'
                ],
                shouldNotGroupWhenFull: true
            },
            // Changing the language of the interface requires loading the language file using the <script> tag.
            // language: 'es',
            list: {
                properties: {
                    styles: true,
                    startIndex: true,
                    reversed: true
                }
            },
            // https://ckeditor.com/docs/ckeditor5/latest/features/headings.html#configuration
            heading: {
                options: [
                    { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                    { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                    { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
                    { model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' },
                    { model: 'heading4', view: 'h4', title: 'Heading 4', class: 'ck-heading_heading4' },
                    { model: 'heading5', view: 'h5', title: 'Heading 5', class: 'ck-heading_heading5' },
                    { model: 'heading6', view: 'h6', title: 'Heading 6', class: 'ck-heading_heading6' }
                ]
            },
            // https://ckeditor.com/docs/ckeditor5/latest/features/editor-placeholder.html#using-the-editor-configuration
            placeholder: 'Write The English Description Here!',
            // https://ckeditor.com/docs/ckeditor5/latest/features/font.html#configuring-the-font-family-feature
            fontFamily: {
                options: [
                    'default',
                    'Arial, Helvetica, sans-serif',
                    'Courier New, Courier, monospace',
                    'Georgia, serif',
                    'Lucida Sans Unicode, Lucida Grande, sans-serif',
                    'Tahoma, Geneva, sans-serif',
                    'Times New Roman, Times, serif',
                    'Trebuchet MS, Helvetica, sans-serif',
                    'Verdana, Geneva, sans-serif'
                ],
                supportAllValues: true
            },
            // https://ckeditor.com/docs/ckeditor5/latest/features/font.html#configuring-the-font-size-feature
            fontSize: {
                options: [ 10, 12, 14, 'default', 18, 20, 22 ],
                supportAllValues: true
            },
            // Be careful with the setting below. It instructs CKEditor to accept ALL HTML markup.
            // https://ckeditor.com/docs/ckeditor5/latest/features/general-html-support.html#enabling-all-html-features
            htmlSupport: {
                allow: [
                    {
                        name: /.*/,
                        attributes: true,
                        classes: true,
                        styles: true
                    }
                ]
            },
            // Be careful with enabling previews
            // https://ckeditor.com/docs/ckeditor5/latest/features/html-embed.html#content-previews
            htmlEmbed: {
                showPreviews: true
            },
            // https://ckeditor.com/docs/ckeditor5/latest/features/link.html#custom-link-attributes-decorators
            link: {
                decorators: {
                    addTargetToExternalLinks: true,
                    defaultProtocol: 'https://',
                    toggleDownloadable: {
                        mode: 'manual',
                        label: 'Downloadable',
                        attributes: {
                            download: 'file'
                        }
                    }
                }
            },
            // https://ckeditor.com/docs/ckeditor5/latest/features/mentions.html#configuration
            mention: {
                feeds: [
                    {
                        marker: '@',
                        feed: [
                            '@apple', '@bears', '@brownie', '@cake', '@cake', '@candy', '@canes', '@chocolate', '@cookie', '@cotton', '@cream',
                            '@cupcake', '@danish', '@donut', '@dragée', '@fruitcake', '@gingerbread', '@gummi', '@ice', '@jelly-o',
                            '@liquorice', '@macaroon', '@marzipan', '@oat', '@pie', '@plum', '@pudding', '@sesame', '@snaps', '@soufflé',
                            '@sugar', '@sweet', '@topping', '@wafer'
                        ],
                        minimumCharacters: 1
                    }
                ]
            },
            // The "super-build" contains more premium features that require additional configuration, disable them below.
            // Do not turn them on unless you read the documentation and know how to configure them and setup the editor.
            removePlugins: [
                // These two are commercial, but you can try them out without registering to a trial.
                // 'ExportPdf',
                // 'ExportWord',
                'CKBox',
                'CKFinder',
                'EasyImage',
                // This sample uses the Base64UploadAdapter to handle image uploads as it requires no configuration.
                // https://ckeditor.com/docs/ckeditor5/latest/features/images/image-upload/base64-upload-adapter.html
                // Storing images as Base64 is usually a very bad idea.
                // Replace it on production website with other solutions:
                // https://ckeditor.com/docs/ckeditor5/latest/features/images/image-upload/image-upload.html
                // 'Base64UploadAdapter',
                'RealTimeCollaborativeComments',
                'RealTimeCollaborativeTrackChanges',
                'RealTimeCollaborativeRevisionHistory',
                'PresenceList',
                'Comments',
                'TrackChanges',
                'TrackChangesData',
                'RevisionHistory',
                'Pagination',
                'WProofreader',
                // Careful, with the Mathtype plugin CKEditor will not load when loading this sample
                // from a local file system (file://) - load this site via HTTP server if you enable MathType.
                'MathType',
                // The following features are part of the Productivity Pack and require additional license.
                'SlashCommand',
                'Template',
                'DocumentOutline',
                'FormatPainter',
                'TableOfContents'
            ]
        });
        CKEDITOR.ClassicEditor.create(document.getElementById("description_ar"), {
            // https://ckeditor.com/docs/ckeditor5/latest/features/toolbar/toolbar.html#extended-toolbar-configuration-format
            toolbar: {
                items: [
                    'exportPDF','exportWord', '|',
                    'findAndReplace', 'selectAll', '|',
                    'heading', '|',
                    'bold', 'italic', 'strikethrough', 'underline', 'code', 'subscript', 'superscript', 'removeFormat', '|',
                    'bulletedList', 'numberedList', 'todoList', '|',
                    'outdent', 'indent', '|',
                    'undo', 'redo',
                    '-',
                    'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor', 'highlight', '|',
                    'alignment', '|',
                    'link', 'insertImage', 'blockQuote', 'insertTable', 'mediaEmbed', 'codeBlock', 'htmlEmbed', '|',
                    'specialCharacters', 'horizontalLine', 'pageBreak', '|',
                    'textPartLanguage', '|',
                    'sourceEditing'
                ],
                shouldNotGroupWhenFull: true
            },
            // Changing the language of the interface requires loading the language file using the <script> tag.
            // language: 'es',
            list: {
                properties: {
                    styles: true,
                    startIndex: true,
                    reversed: true
                }
            },
            // https://ckeditor.com/docs/ckeditor5/latest/features/headings.html#configuration
            heading: {
                options: [
                    { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                    { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                    { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
                    { model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' },
                    { model: 'heading4', view: 'h4', title: 'Heading 4', class: 'ck-heading_heading4' },
                    { model: 'heading5', view: 'h5', title: 'Heading 5', class: 'ck-heading_heading5' },
                    { model: 'heading6', view: 'h6', title: 'Heading 6', class: 'ck-heading_heading6' }
                ]
            },
            // https://ckeditor.com/docs/ckeditor5/latest/features/editor-placeholder.html#using-the-editor-configuration
            placeholder: 'Write The Arabic Description Here!',
            // https://ckeditor.com/docs/ckeditor5/latest/features/font.html#configuring-the-font-family-feature
            fontFamily: {
                options: [
                    'default',
                    'Arial, Helvetica, sans-serif',
                    'Courier New, Courier, monospace',
                    'Georgia, serif',
                    'Lucida Sans Unicode, Lucida Grande, sans-serif',
                    'Tahoma, Geneva, sans-serif',
                    'Times New Roman, Times, serif',
                    'Trebuchet MS, Helvetica, sans-serif',
                    'Verdana, Geneva, sans-serif'
                ],
                supportAllValues: true
            },
            // https://ckeditor.com/docs/ckeditor5/latest/features/font.html#configuring-the-font-size-feature
            fontSize: {
                options: [ 10, 12, 14, 'default', 18, 20, 22 ],
                supportAllValues: true
            },
            // Be careful with the setting below. It instructs CKEditor to accept ALL HTML markup.
            // https://ckeditor.com/docs/ckeditor5/latest/features/general-html-support.html#enabling-all-html-features
            htmlSupport: {
                allow: [
                    {
                        name: /.*/,
                        attributes: true,
                        classes: true,
                        styles: true
                    }
                ]
            },
            // Be careful with enabling previews
            // https://ckeditor.com/docs/ckeditor5/latest/features/html-embed.html#content-previews
            htmlEmbed: {
                showPreviews: true
            },
            // https://ckeditor.com/docs/ckeditor5/latest/features/link.html#custom-link-attributes-decorators
            link: {
                decorators: {
                    addTargetToExternalLinks: true,
                    defaultProtocol: 'https://',
                    toggleDownloadable: {
                        mode: 'manual',
                        label: 'Downloadable',
                        attributes: {
                            download: 'file'
                        }
                    }
                }
            },
            // https://ckeditor.com/docs/ckeditor5/latest/features/mentions.html#configuration
            mention: {
                feeds: [
                    {
                        marker: '@',
                        feed: [
                            '@apple', '@bears', '@brownie', '@cake', '@cake', '@candy', '@canes', '@chocolate', '@cookie', '@cotton', '@cream',
                            '@cupcake', '@danish', '@donut', '@dragée', '@fruitcake', '@gingerbread', '@gummi', '@ice', '@jelly-o',
                            '@liquorice', '@macaroon', '@marzipan', '@oat', '@pie', '@plum', '@pudding', '@sesame', '@snaps', '@soufflé',
                            '@sugar', '@sweet', '@topping', '@wafer'
                        ],
                        minimumCharacters: 1
                    }
                ]
            },
            // The "super-build" contains more premium features that require additional configuration, disable them below.
            // Do not turn them on unless you read the documentation and know how to configure them and setup the editor.
            removePlugins: [
                // These two are commercial, but you can try them out without registering to a trial.
                // 'ExportPdf',
                // 'ExportWord',
                'CKBox',
                'CKFinder',
                'EasyImage',
                // This sample uses the Base64UploadAdapter to handle image uploads as it requires no configuration.
                // https://ckeditor.com/docs/ckeditor5/latest/features/images/image-upload/base64-upload-adapter.html
                // Storing images as Base64 is usually a very bad idea.
                // Replace it on production website with other solutions:
                // https://ckeditor.com/docs/ckeditor5/latest/features/images/image-upload/image-upload.html
                // 'Base64UploadAdapter',
                'RealTimeCollaborativeComments',
                'RealTimeCollaborativeTrackChanges',
                'RealTimeCollaborativeRevisionHistory',
                'PresenceList',
                'Comments',
                'TrackChanges',
                'TrackChangesData',
                'RevisionHistory',
                'Pagination',
                'WProofreader',
                // Careful, with the Mathtype plugin CKEditor will not load when loading this sample
                // from a local file system (file://) - load this site via HTTP server if you enable MathType.
                'MathType',
                // The following features are part of the Productivity Pack and require additional license.
                'SlashCommand',
                'Template',
                'DocumentOutline',
                'FormatPainter',
                'TableOfContents'
            ]
        });
    </script>
    <script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.5.0/js/fileinput.min.js"></script>

@endsection

