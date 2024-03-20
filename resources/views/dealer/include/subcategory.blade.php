<div class="col-md-6">
    <div class="form-group">
        <label for="">Product SubCategory</label>
        <div class="form-field">
            <select type="text" name="subcategory" class="form-control" placeholder="Product SubCategory"
                id="subcategory">
                <option value="">Select the category</option>
                @foreach ($subcategories as $subcategory)
                    <option value="{{ $subcategory->id }}">{{ $subcategory->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>
