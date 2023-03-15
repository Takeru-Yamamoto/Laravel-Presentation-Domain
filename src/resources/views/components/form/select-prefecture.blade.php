<div class="form-group {{ isset($addClass) ? $addClass : '' }}">
    <label for="{{ $name }}">{{ $title }}</label>
    <select class="form-control" name="{{ $name }}" id="{{ $name }}">
        <option value="">{{ ___('mycustom.message.select_option') }}</option>
        @foreach (config('mycustoms.prefecture.kanji_full') as $prefecture => $prefectureFullKanji)
            <option value="{{ $prefecture }}" {{ ViewFunctions::isSelected(isset($selected) && $selected === $prefecture) }}>
                {{ $prefectureFullKanji }}</option>
        @endforeach
    </select>
</div>
