@extends('dashboard.layouts.master')
@section('title',__('Front-end/pages/categories.add.category'))
@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('page-header')
    <div class="row mb-2 mb-xl-3">
        <div class="col-auto d-none d-sm-block">
            <h3>
                <strong>{{__('Front-end/pages/categories.title')}}</strong>
                / {{__('Front-end/pages/categories.add.category')}}
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
    <form action="{{route('categories.store')}}" method="post" id="create_user"
          class="needs-validation" novalidate>
        @csrf
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">{{__('Front-end/pages/categories.add.category')}}</h5>
                    <h6 class="card-subtitle text-muted">{{__('Front-end/pages/categories.add.description')}}</h6>
                </div>
                <div class="card-body">

                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label class="form-label"
                                   for="language">{{__('Front-end/pages/categories.language')}}</label>
                            <input type="text" class="form-control" id="language" disabled value="English">
                        </div>

                        <div class="mb-3 col-md-6">
                            <label class="form-label" for="last_name">{{__('Front-end/pages/categories.name')}}</label>
                            <input type="text" class="form-control" id="name" name="name"
                                   placeholder="{{__('Front-end/pages/categories.name')}}" autocomplete="off" required>
                            <div class="valid-feedback">
                                {{__('Front-end/pages/categories.name.valid')}}
                            </div>
                            <div class="invalid-feedback">
                                {{__('Front-end/pages/categories.name.invalid')}}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label class="form-label"
                                   for="display_order">{{__('Front-end/pages/categories.display_order')}}</label>
                            <input type="text" class="form-control" id="display_order" name="display_order"
                                   oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"
                                   placeholder="{{__('Front-end/pages/categories.display_order')}}" autocomplete="off"
                                   required>
                            <div class="valid-feedback">
                                {{__('Front-end/pages/categories.display_order.valid')}}
                            </div>
                            <div class="invalid-feedback">
                                {{__('Front-end/pages/categories.display_order.invalid')}}
                            </div>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label"
                                   for="parent_category">{{__('Front-end/pages/categories.parent_category')}}</label>
                            <select id="parent_category" class="form-control choices-single">
                                <option selected value="">{{__('Front-end/pages/users.choose')}}</option>
                                @foreach($categories as $category)
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label for="color_code"
                                   class="form-label">{{__('Front-end/pages/categories.color_code')}}</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="color_code"
                                       aria-describedby="inputGroupPrepend" name="color_code" autocomplete="off"
                                       placeholder="{{__('Front-end/pages/categories.color_code')}}"

                                >
                                <div id="mobile-validation-feedback"></div>

                                <div class="valid-feedback">
                                    {{__('Front-end/pages/categories.color_code.valid')}}
                                </div>
                                <div class="invalid-feedback">
                                    {{__('Front-end/pages/categories.color_code.invalid')}}
                                </div>

                            </div>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label" for="status">{{__('Front-end/pages/categories.status')}}</label>
                            <select name="status" id="status" class="form-control choices-single" required>
                                <option value="1">{{__('Front-end/pages/categories.enable')}}</option>
                                <option value="0">{{__('Front-end/pages/categories.disable')}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label class="form-label"
                                   for="inputEmail4">{{__('Front-end/pages/categories.icon')}}</label>
                            <input type="file" class="form-control" id="icon" name="icon" autocomplete="off"
                                   accept=".jpg, .jpeg, .png, .svg">
                        </div>
                    </div>
                </div>
{{--                <div class="card">--}}
{{--                    <div class="card-header">--}}
{{--                        <h5 class="card-title"><i class="align-middle me-2" data-feather="slash"></i>{{__('Front-end/pages/categories.restricted.in')}}</h5>--}}
{{--                    </div>--}}
{{--                    <div class="card-body">--}}
{{--                        <div class="row">--}}
{{--                            <label class="form-label">{{__('Front-end/pages/categories.states')}}</label>--}}
{{--                        <select class="form-control states" multiple id="inputState">--}}
{{--                            @foreach($states as $state)--}}
{{--                                <option value="{{$state->id}}">{{$state->name}}</option>--}}
{{--                            @endforeach--}}
{{--                        </select>--}}
{{--                        </div>--}}
{{--                        <div class="row">--}}
{{--                            <label class="form-label">{{__('Front-end/pages/categories.cities')}}</label>--}}
{{--                        <select class="form-control cities" multiple>--}}
{{--                        </select>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="card">--}}
{{--                    <div class="card-header">--}}
{{--                        <h5 class="card-title"><i class="align-middle me-2 fas fa-fw fa-align-center"></i>{{__('Front-end/pages/categories.attribute')}}</h5>--}}
{{--                    </div>--}}
{{--                    <div class="card-body">--}}
{{--                        <div class="row">--}}
{{--                            <label class="form-label">{{__('Front-end/pages/categories.attribute')}}</label>--}}
{{--                            <select class="form-control attributes" id="inputAttribute">--}}
{{--                                <option value="" selected>choose...</option>--}}

{{--                                @foreach($attributes as $attribute)--}}
{{--                                    <option value="{{$attribute->id}}">{{$attribute->translations->first()->name}}</option>--}}
{{--                                @endforeach--}}

{{--                            </select>--}}
{{--                            <div class="row" id="container">--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}

            </div>
            <button id="save_user" type="submit"
                    class="btn btn-primary">{{__('Front-end/pages/categories.add')}}</button>
        </div>
    </form>
@endsection
@section('scripts')
    <script>
        (function () {
            'use strict';

            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.querySelectorAll('.needs-validation');

            // Loop over them and prevent submission
            Array.prototype.slice.call(forms)
                .forEach(function (form) {
                    form.addEventListener('submit', function (event) {
                        if (!form.checkValidity() || !checkColorCode()) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
        })();
    </script>
    <script>
        document.getElementById('color_code').addEventListener('input', checkColorCode);

        function checkColorCode() {
            let colorInput = document.getElementById('color_code');
            let colorSyntax = /^#([0-9a-f]{3}|[0-9a-f]{6})$/i;
            let isColorValid = colorSyntax.test(colorInput.value);
            colorInput.classList.toggle("is-valid", isColorValid);
            colorInput.classList.toggle("is-invalid", !isColorValid);
            return isColorValid;
        }
    </script>
    <script>
        new Choices(document.querySelector("#parent_category"));
    </script>
{{--    <script>--}}
{{--        document.addEventListener("DOMContentLoaded", function () {--}}
{{--            new Choices(document.querySelector("#parent_category"));--}}
{{--            new Choices(document.querySelector(".states"));--}}
{{--            var citySelect = new Choices(document.querySelector(".cities"));--}}

{{--            async function updateCityOptions(StateId) {--}}
{{--                if (StateId) {--}}
{{--                    try {--}}
{{--                        const response = await fetch(`{{ URL::to('admin/state-cities') }}/${StateId}`);--}}
{{--                        const data = await response.json();--}}

{{--                        return { StateId, data };--}}
{{--                    } catch (error) {--}}
{{--                        console.error(error);--}}
{{--                        return null;--}}
{{--                    }--}}
{{--                }--}}
{{--                return null;--}}
{{--            }--}}

{{--            function removeCitiesOfState(StateId) {--}}
{{--                const citySelectElement = document.querySelector(".cities");--}}
{{--                const cities = citySelectElement.querySelectorAll(`option[data-group="${StateId}"]`);--}}

{{--                cities.forEach(city => {--}}
{{--                    city.remove();--}}
{{--                });--}}
{{--            }--}}

{{--            $('#inputState').on('change', async function () {--}}
{{--                var StatesId = $(this).val();--}}
{{--                var promises = StatesId.map(updateCityOptions);--}}
{{--                var cityOptions = [];--}}

{{--                try {--}}
{{--                    var results = await Promise.all(promises);--}}

{{--                    results.forEach(result => {--}}
{{--                        if (result) {--}}
{{--                            var { StateId, data } = result;--}}
{{--                            $.each(data, function (key, value) {--}}
{{--                                cityOptions.push({ value: key, label: value, group: StateId }); // Add each city as an object to the array--}}
{{--                            });--}}
{{--                        }--}}
{{--                    });--}}

{{--                    citySelect.setChoices(cityOptions, 'value', 'label', true); // Set all city options at once--}}
{{--                } catch (error) {--}}
{{--                    console.error(error);--}}
{{--                }--}}
{{--            });--}}

{{--            $('#inputState').on('removeItem', function (event) {--}}
{{--                var StateId = event.detail.value;--}}
{{--                removeCitiesOfState(StateId);--}}
{{--            });--}}
{{--        });--}}
{{--    </script>--}}
{{--    <script>--}}
{{--        document.addEventListener("DOMContentLoaded", function () {--}}
{{--            var choices = new Choices(document.querySelector(".attributes"));--}}
{{--            var container = document.querySelector("#container");--}}
{{--            var selectedAttributes = [];--}}

{{--            $('#inputAttribute').on('change', function () {--}}
{{--                var selectedAttributeId = $(this).val();--}}
{{--                var selectedAttributeName = $(this).find('option:selected').text();--}}

{{--                // Check if the selected option is already added to the container--}}
{{--                if (selectedAttributeId && selectedAttributeName && !selectedAttributes.includes(selectedAttributeId)) {--}}
{{--                    var card = document.createElement("div");--}}
{{--                    card.classList.add("card");--}}

{{--                    var cardHeader = document.createElement("div");--}}
{{--                    cardHeader.classList.add("card-header");--}}
{{--                    var cardTitle = document.createElement("h5");--}}
{{--                    cardTitle.classList.add("card-title", "mb-0");--}}
{{--                    cardTitle.textContent = selectedAttributeName;--}}
{{--                    cardHeader.appendChild(cardTitle);--}}

{{--                    var deleteButton = document.createElement("button");--}}
{{--                    deleteButton.classList.add("btn", "btn-danger", "float-end");--}}
{{--                    deleteButton.textContent = "Delete";--}}
{{--                    deleteButton.addEventListener("click", function () {--}}
{{--                        container.removeChild(fullCard); // Remove the card from the container--}}

{{--                        // Re-enable the selected option in the Choices select box--}}
{{--                        choices.setChoiceByValue(selectedAttributeId);--}}

{{--                        // Remove the selected option from the selectedAttributes array--}}
{{--                        var index = selectedAttributes.indexOf(selectedAttributeId);--}}
{{--                        if (index > -1) {--}}
{{--                            selectedAttributes.splice(index, 1);--}}
{{--                        }--}}
{{--                    });--}}

{{--                    card.appendChild(cardHeader);--}}

{{--                    var cardBody = document.createElement("div");--}}
{{--                    cardBody.classList.add("card-body");--}}

{{--                    var displayOrderLabel = document.createElement("label");--}}
{{--                    displayOrderLabel.classList.add("form-label");--}}
{{--                    displayOrderLabel.textContent = "{{__('Front-end/pages/categories.display.order')}}";--}}
{{--                    cardBody.appendChild(displayOrderLabel);--}}

{{--                    var displayOrderInput = document.createElement("input");--}}
{{--                    displayOrderInput.classList.add("form-control");--}}
{{--                    displayOrderInput.type = "text";--}}
{{--                    displayOrderInput.placeholder = "{{__('Front-end/pages/categories.display.order')}}";--}}
{{--                    displayOrderInput.name = "attributes[" + selectedAttributeId + "][display_order]";--}}
{{--                    displayOrderInput.setAttribute('required','required');--}}
{{--                    cardBody.appendChild(displayOrderInput);--}}

{{--                    var br1 = document.createElement("br");--}}
{{--                    cardBody.appendChild(br1);--}}

{{--                    var valueLabel = document.createElement("label");--}}
{{--                    valueLabel.classList.add("form-label");--}}
{{--                    valueLabel.textContent = "{{__('Front-end/pages/categories.value')}}";--}}
{{--                    cardBody.appendChild(valueLabel);--}}

{{--                    var valueInput = document.createElement("input");--}}
{{--                    valueInput.classList.add("form-control");--}}
{{--                    valueInput.type = "text";--}}
{{--                    valueInput.placeholder = "{{__('Front-end/pages/categories.value')}}";--}}
{{--                    valueInput.name = "attributes[" + selectedAttributeId + "][value]";--}}
{{--                    valueInput.setAttribute('required','required');--}}
{{--                    cardBody.appendChild(valueInput);--}}

{{--                    var br2 = document.createElement("br");--}}
{{--                    cardBody.appendChild(br2);--}}

{{--                    var statusLabel = document.createElement("label");--}}
{{--                    statusLabel.classList.add("form-label");--}}
{{--                    statusLabel.textContent = "{{__('Front-end/pages/categories.status')}}";--}}
{{--                    cardBody.appendChild(statusLabel);--}}

{{--                    var statusSelect = document.createElement("select");--}}
{{--                    statusSelect.classList.add("form-control");--}}
{{--                    statusSelect.setAttribute('required','required');--}}
{{--                    var optionEnable = document.createElement("option");--}}
{{--                    optionEnable.value = "1";--}}
{{--                    optionEnable.textContent = "{{__('Front-end/pages/categories.enable')}}";--}}
{{--                    optionEnable.setAttribute("selected", "selected");--}}
{{--                    var optionDisable = document.createElement("option");--}}
{{--                    optionDisable.value = "0";--}}
{{--                    optionDisable.textContent = "{{__('Front-end/pages/categories.disable')}}";--}}
{{--                    statusSelect.appendChild(optionEnable);--}}
{{--                    statusSelect.appendChild(optionDisable);--}}
{{--                    cardBody.appendChild(statusSelect);--}}

{{--                    let attributeId = document.createElement('input');--}}
{{--                    attributeId.name = 'id';--}}
{{--                    attributeId.type = 'hidden';--}}
{{--                    attributeId.value = `${selectedAttributeId}[]`;--}}
{{--                    cardBody.appendChild(attributeId);--}}

{{--                    deleteButton.style.cssText = "position:relative;top:30px;right:75%";--}}
{{--                    cardBody.appendChild(deleteButton);--}}

{{--                    card.appendChild(cardBody);--}}

{{--                    let fullCard = document.createElement('div');--}}
{{--                    fullCard.className = "mb-3 col-md-4";--}}
{{--                    fullCard.appendChild(card);--}}
{{--                    container.appendChild(fullCard);--}}

{{--                    // Add the selected option to the array to prevent reselection--}}
{{--                    selectedAttributes.push(selectedAttributeId);--}}

{{--                    // Remove the selected option from the Choices select box--}}
{{--                    choices.removeActiveItemsByValue(selectedAttributeId);--}}
{{--                }--}}
{{--            });--}}
{{--        });--}}
{{--    </script>--}}







@endsection

