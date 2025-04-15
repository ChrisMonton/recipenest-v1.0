<div class="form-group">
    <label for="{{ $name }}">{{ $title }}:</label>
    <textarea id="{{ $id }}" class="form-control" rows="5" name="{{ $name }}" id="{{ $id }}">
        {{ $value ?? '' }}
    </textarea>
</div>