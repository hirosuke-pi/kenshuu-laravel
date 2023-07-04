<div class="mx-3 my-1">
    <input id="{{ $tag->getId() }}" name="tags[]" value="{{ $tag->getId() }}" class="tag-input" type="checkbox">
    <label for="{{ $tag->getId() }}">{{ $tag->getName() }}</label>
</div>
