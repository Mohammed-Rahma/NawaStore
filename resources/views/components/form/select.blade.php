@props([
'id' , 'name' , 'labal', 'options', 'value'=>''
]);

<div>

    <div class="mb-3">
        <label for="{{$id}}">{{$labal}}</label>
        <div>
            <select class="form-select form-control  @error($name) is-invalid @enderror" id="{{$id}}" name="{{$name}}">
                <option value=""></option>
                @foreach ($options as $option_value => $option_text)
                <option @selected($option_value==old($name, $value)) value="{{$option_value}}">{{$option_text}}</option>
                @endforeach
                <x-form.error name="{{$name}}" />
        </div>

    </div>