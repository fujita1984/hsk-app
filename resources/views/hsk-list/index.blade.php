@extends('layouts.app')

@section('title', 'HSK単語一覧')

@section('content')
<h1>HSK単語一覧</h1>

<div class="mb-3">
    <form method="get" class="row g-3 align-items-center">
        <div class="col-auto">
            <label for="level" class="col-form-label">HSKレベル:</label>
        </div>
        <div class="col-auto">
            <select name="level" id="level" class="form-select" onchange="this.form.submit()">
                <option value="">-- 選択してください --</option>
                @foreach ($levels as $lvl)
                    <option value="{{ $lvl }}" {{ (string)$selectedLevel === (string)$lvl ? 'selected' : '' }}>
                        HSK {{ $lvl }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-auto">
            @if ($words->isNotEmpty())
                <span class="badge bg-primary fs-6">{{ $words->count() }} 件</span>
            @endif
        </div>
    </form>
</div>

@php
    $columns = [
        'chinese'          => '中国語',
        'pinyin'           => 'ピンイン',
        'japanese_meaning' => '日本語',
    ];
@endphp

@if ($selectedLevel !== null && $words->isNotEmpty())
    <table class="table table-striped table-hover">
        <thead class="table-dark">
            <tr>
                @foreach ($columns as $col => $label)
                    @php
                        $nextDir = (strtolower($sortColumn) === $col && strtolower($sortDirection) === 'asc') ? 'desc' : 'asc';
                    @endphp
                    <th>
                        <a href="{{ url('/hsk-list') }}?level={{ $selectedLevel }}&sortColumn={{ $col }}&sortDirection={{ $nextDir }}"
                           class="text-white text-decoration-none">
                            {{ $label }}
                        </a>
                        @if (strtolower($sortColumn) === $col)
                            <span>{{ strtolower($sortDirection) === 'asc' ? '▲' : '▼' }}</span>
                        @endif
                    </th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach ($words as $word)
                <tr style="cursor: pointer;" data-word-id="{{ $word->id }}" onclick="playAudio(this.dataset.wordId)">
                    <td class="fs-4">{{ $word->chinese }}</td>
                    <td>{{ $word->pinyin_with_tone }}</td>
                    <td>{{ $word->japanese_meaning }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@elseif ($selectedLevel !== null)
    <div class="alert alert-info">該当する単語がありません。</div>
@endif

<audio id="audioPlayer" style="display:none;"></audio>
@endsection

@section('scripts')
<script>
    function playAudio(id) {
        const audio = document.getElementById('audioPlayer');
        audio.src = '/audio/hsk/' + id + '.mp3';
        audio.play().catch(function(error) {
            console.error('Audio playback failed:', error);
        });
    }
</script>
@endsection
