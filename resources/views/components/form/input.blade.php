@props([
'id' , 'name' , 'labal', 'type'=>'text' , 'value'=>'',
]);
<div>
<div class="mb-3">
    <label for="{{$id}}">{{$labal}}</label>
    <div>
        <input type="{{$type}}" class="form-control  @error($name) is-invalid @enderror" id="{{$id}}" name="{{$name}}" value="{{ old($name, $value) }}" placeholder="{{$labal}}">
        <x-form.error name="{{$name}}" />
    </div>
</div>
