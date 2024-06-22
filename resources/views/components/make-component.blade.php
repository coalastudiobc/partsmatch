 @foreach($makedata as $make)
    <option value="{{$make->id}}" data-name="{{$make->name}}">{{$make->name}}</option>
@endforeach