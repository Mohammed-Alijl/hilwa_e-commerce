@extends('dashboard.layouts.master')
@section('title',__('Front-end/pages/products.show.product'))
@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('page-header')
    <div class="row mb-2 mb-xl-3">
        <div class="col-auto d-none d-sm-block">
            <h3>
                <strong>{{__('Front-end/pages/products.title')}}</strong>
                / {{__('Front-end/pages/products.show.product')}}
            </h3>
        </div>
    </div>
@endsection
@section('content')
    <label class="form-check">
        <input class="form-check-input" type="radio" value="simple"
               name="product_type" {{!$isComplex ? 'checked' : 'disabled'}} >
        <span class="form-check-label">{{__('Front-end/pages/products.simple_product')}}</span>
    </label>
    <label class="form-check">
        <input class="form-check-input" type="radio" value="complex"
               name="product_type" {{$isComplex ? 'checked' : 'disabled'}} >
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
                @if($isComplex)
                    <li class="nav-item complex-product"><a class="nav-link" href="#attributes"
                                                            data-bs-toggle="tab"
                                                            role="tab"> {{__('Front-end/pages/products.attributes')}}</a>
                    </li>
                    <li class="nav-item complex-product"><a class="nav-link" href="#variations"
                                                            data-bs-toggle="tab"
                                                            role="tab"> {{__('Front-end/pages/products.variations')}}</a>
                    </li>
                @endif


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
                                           value="{{$product->getTranslation('name','en')}}" disabled>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label"
                                           for="name_ar">{{__('Front-end/pages/products.name_ar')}}</label>
                                    <input type="text" class="form-control" id="name_ar" name="name_ar"
                                           value="{{$product->getTranslation('name','ar')}}" disabled>
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label class="form-label"
                                           for="description_en">{{__('Front-end/pages/products.description_en')}}</label>
                                    <textarea name="description_en" id="description_en">
                                        {{$product->description_en}}
                                        </textarea>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label"
                                           for="description_ar">{{__('Front-end/pages/products.description_ar')}}</label>
                                    <textarea name="description_ar" id="description_ar" required>
                                        {{$product->description_ar}}
                                        </textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label class="form-label"
                                           for="sku">{{__('Front-end/pages/products.sku')}}</label>
                                    <input type="text" class="form-control" id="sku" name="sku"
                                           value="{{$product->sku}}" disabled>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label"
                                           for="weight_in_points">{{__('Front-end/pages/products.weight_in_points')}}</label>
                                    <input type="text" class="form-control" id="weight_in_points"
                                           name="weight_in_points" value="{{$product->weight_in_points}}" disabled>
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label class="form-label"
                                           for="price">{{__('Front-end/pages/products.price')}}</label>
                                    <input type="text" class="form-control" id="price" name="price"
                                           value="{{$product->price}}" disabled>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label"
                                           for="spacial_price">{{__('Front-end/pages/products.spacial_price')}}</label>
                                    <input type="text" class="form-control" id="spacial_price" name="spacial_price"
                                           value="{{$product->special_price}}" disabled>
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label class="form-label"
                                           for="min_quantity">{{__('Front-end/pages/products.min_quantity')}}</label>
                                    <input type="text" class="form-control" id="min_quantity" name="min_quantity"
                                           value="{{$product->min_quantity}}" disabled>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label"
                                           for="max_quantity">{{__('Front-end/pages/products.max_quantity')}}</label>
                                    <input type="text" class="form-control" id="max_quantity"
                                           value="{{$product->max_quantity}}" disabled>
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label class="form-label"
                                           for="category">{{__('Front-end/pages/products.category')}}</label>
                                    <select id="category" class="form-control choices-single" name="category_id"
                                            disabled>
                                        <option value="{{$product->category->id}}">{{$product->category->name}}</option>
                                    </select>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label"
                                           for="unit">{{__('Front-end/pages/products.unit')}}</label>
                                    <select id="unit" class="form-control choices-single" name="unit_id" disabled>
                                        <option value="{{$product->unit->id}}">{{$product->unit->name}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label class="form-label"
                                           for="status">{{__('Front-end/pages/products.status')}}</label>
                                    <select name="status" id="status" class="form-control choices-single" disabled>
                                        @if($product->status)
                                            <option value="1">{{__('Front-end/pages/products.enable')}}</option>
                                        @else
                                            <option value="0">{{__('Front-end/pages/products.disable')}}</option>
                                        @endif
                                    </select>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label"
                                           for="show_customer_app">{{__('Front-end/pages/products.show_customer_app')}}</label>
                                    <select name="show_customer_app" id="show_customer_app"
                                            class="form-control choices-single" disabled>
                                        @if($product->show_customer_app)
                                            <option value="1">{{__('Front-end/pages/products.enable')}}</option>
                                        @else
                                            <option value="0">{{__('Front-end/pages/products.disable')}}</option>
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label class="form-label"
                                           for="stock_quantity">{{__('Front-end/pages/products.stock_quantity')}}</label>
                                    <input type="text" class="form-control" id="stock_quantity"
                                           value="{{$product->stock_quantity}}" disabled>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label"
                                           for="stock_status">{{__('Front-end/pages/products.stock_status')}}</label>
                                    <select name="stock_status" id="stock_status"
                                            class="form-control choices-single" disabled>
                                        @if($product->stock_status == 0)
                                            <option value="0">{{__('Front-end/pages/products.in_stock')}}</option>
                                        @elseif($product->stock_status == 1)
                                            <option value="1">{{__('Front-end/pages/products.out_of_stock')}}</option>
                                        @elseif($product->stock_status == 2)
                                            <option value="2">{{__('Front-end/pages/products.2_3_days')}}</option>
                                        @else
                                            <option value="3">{{__('Front-end/pages/products.4_7_days')}}</option>
                                        @endif

                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                @foreach($product->images as $image)
                                    <div class="col-12 col-md-6 col-lg-3">
                                        <div class="card">
                                            <img class="card-img-top" src="{{URL::asset("img/products/$image->name")}}"
                                                 alt="{{$image->name}}">
                                        </div>
                                    </div>
                                @endforeach
                            </div>

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
                            @foreach($product->discounts as $discount)
                                <div class="row">
                                    <div class="mb-3 col-md-4">
                                        <label for="discount_type"
                                               class="form-label">{{__('Front-end/pages/products.discount_type')}}</label>
                                        <select id="discount_type" disabled class="form-control">
                                            <option class="form-control">
                                                {{__('Front-end/pages/products.' . $discount->discount_type)}}
                                            </option>
                                        </select>
                                    </div>
                                    <div class="mb-3 col-md-4">
                                        <label for="discount_value"
                                               class="form-label">{{__('Front-end/pages/products.' . $discount->discount_type)}}</label>
                                        <input type="text" id="discount_value" class="form-control"
                                               value="{{$discount->discount_value}}" disabled>
                                    </div>
                                    <div class="mb-3 col-md-4">
                                        <label
                                            class="form-label">{{__('Front-end/pages/products.discount_date')}}</label>
                                        <input type="text" class="form-control"
                                               value="{{"$discount->start_date to $discount->end_date"}}" disabled>
                                    </div>
                                </div>
                            @endforeach
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
                                @foreach($product->relatedProducts as $relatedProduct)
                                    <option selected>{{$relatedProduct->name}}</option>
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
                                <label for="inputCity"
                                       class="form-label">{{__('Front-end/pages/products.cities')}}</label>
                                <select class="form-control cities" multiple id="inputCity">
                                    @foreach($product->cities as $city)
                                        <option selected>{{$city->name}}</option>
                                    @endforeach
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
                                    <input type="text" class="form-control"
                                           placeholder="{{__('Front-end/pages/products.select.date')}}" disabled
                                           value="{{$product->featured ? $product->featured->start_at . " to " . $product->featured->end_at : ''}}"/>
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label for="display-order"
                                           class="form-label">{{__('Front-end/pages/products.display_order')}}</label>
                                    <input id="display-order" type="text" class="form-control" disabled
                                           placeholder="{{__('Front-end/pages/products.display_order')}}"
                                           value="{{$product->featured ? $product->featured->display_order : ''}}"/>
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label class="form-label"
                                           for="featured-status">{{__('Front-end/pages/products.status')}}</label>
                                    <select name="featured_status" id="featured-status"
                                            class="form-control choices-single" disabled>
                                        @if(!$product->featured)
                                            <option>{{__('Front-end/pages/products.choose')}}</option>
                                        @elseif($product->featured->status)
                                            <option>{{__('Front-end/pages/products.enable')}}</option>
                                        @else
                                            <option>{{__('Front-end/pages/products.disable')}}</option>
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @if($isComplex)
                    <div class="tab-pane complex-product" id="attributes" role="tabpanel">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title"><i
                                        class="align-middle me-2 far fa-fw fa-list-alt"></i> {{__('Front-end/pages/products.attributes')}}
                                </h5>
                            </div>
                            <div class="card-body attributesContainer">
                                <div class="row">
                                    @foreach($product->attributes as $attribute)
                                        <label class="form-label">{{$attribute->name}}</label>
                                        <select multiple class="form-control" id="{{$attribute->name}}">
                                            @foreach($product->options->where('attribute_id',$attribute->id) as $value)
                                                <option selected>{{$value->name}}</option>
                                            @endforeach
                                        </select>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane complex-product" id="variations" role="tabpanel">
                        @foreach($product->variants as $variant)
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title">
{{--                                        @foreach($variant->attributes as $variantAttribute)--}}
{{--                                            {{$variantAttribute->values->name . " "}}--}}
{{--                                        @endforeach--}}
                                        {{implode(',',\App\Models\AttributeValue::whereIn('id',\Illuminate\Support\Facades\DB::table('attribute_variant')->where('variant_id',$variant->id)->pluck('attribute_value_id'))->pluck('name')->toArray())}}
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label"
                                                   for="variant_price">{{__('Front-end/pages/products.price')}}</label>
                                            <input type="text" class="form-control" id="variant_price"
                                                   name="variant_price[]"
                                                   value="{{$variant->price}}" disabled>
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label"
                                                   for="variant_quantity">{{__('Front-end/pages/products.stock_quantity')}}</label>
                                            <input type="text" class="form-control" id="variant_quantity"
                                                   name="variant_quantity[]"
                                                   value="{{$variant->quantity}}" disabled>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 col-md-6 col-lg-6">
                                            <div class="card">
                                                <img class="card-img-top"
                                                     src="{{URL::asset('img/variants/' . $variant->image)}}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
        @endsection
        @section('scripts')


            <script>
                document.addEventListener("DOMContentLoaded", function () {
                    new Choices(document.querySelector("#category"));
                    new Choices(document.querySelector("#unit"));
                    new Choices(document.querySelector("#inputCity"));
                    new Choices(document.querySelector(".related-products"));
                });
            </script>

            <script src="https://cdn.ckeditor.com/ckeditor5/38.1.1/super-build/ckeditor.js"></script>

            <script>
                // This sample still does not showcase all CKEditor 5 features (!)
                // Visit https://ckeditor.com/docs/ckeditor5/latest/features/index.html to browse all the features.
                CKEDITOR.ClassicEditor.create(document.getElementById("description_en"), {
                    // https://ckeditor.com/docs/ckeditor5/latest/features/toolbar/toolbar.html#extended-toolbar-configuration-format
                    toolbar: {
                        items: [
                            'exportPDF', 'exportWord', '|',
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
                            {model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph'},
                            {model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1'},
                            {model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2'},
                            {model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3'},
                            {model: 'heading4', view: 'h4', title: 'Heading 4', class: 'ck-heading_heading4'},
                            {model: 'heading5', view: 'h5', title: 'Heading 5', class: 'ck-heading_heading5'},
                            {model: 'heading6', view: 'h6', title: 'Heading 6', class: 'ck-heading_heading6'}
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
                        options: [10, 12, 14, 'default', 18, 20, 22],
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
                            'exportPDF', 'exportWord', '|',
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
                            {model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph'},
                            {model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1'},
                            {model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2'},
                            {model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3'},
                            {model: 'heading4', view: 'h4', title: 'Heading 4', class: 'ck-heading_heading4'},
                            {model: 'heading5', view: 'h5', title: 'Heading 5', class: 'ck-heading_heading5'},
                            {model: 'heading6', view: 'h6', title: 'Heading 6', class: 'ck-heading_heading6'}
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
                        options: [10, 12, 14, 'default', 18, 20, 22],
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
                @foreach($product->attributes as $productAttribute)
                new Choices(document.querySelector("#{{$productAttribute->name}}"));
                @endforeach
            </script>

@endsection

