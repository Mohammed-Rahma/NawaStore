@props([
'id' , 'name' , 'labal', 'value'=>''
]);

<div>
    <div class="mb-3">
        <label for="{{$id}}">{{$labal}}</label>
        <div>
            <textarea class="form-control  @error($name) is-invalid @enderror" id="{{$id}}" name="{{$name}}" placeholder="{{$labal}}">{{ old($name, $value) }}</textarea>
            <x-form.error name="{{$name}}" />

        </div>
    </div>