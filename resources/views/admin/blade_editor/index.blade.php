@extends('layouts.master')

@section('content')
<div class="container">
    <h1>Blade Editor</h1>
    <div class="form-group">
        <label for="file-select">Select a Blade File</label>
        <select id="file-select" class="form-control">
            <option value="">-- Select a file --</option>
            @foreach($files as $file)
                <option value="{{ $file }}">{{ $file }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <textarea id="file-content" class="form-control" rows="20"></textarea>
    </div>
    <button id="save-btn" class="btn btn-primary">Save</button>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('#file-select').change(function() {
            var file = $(this).val();
            if (file) {
                $.ajax({
                    url: '{{ route('admin.blade.editor.show') }}',
                    type: 'GET',
                    data: { file: file },
                    success: function(response) {
                        $('#file-content').val(response.content);
                    },
                    error: function(xhr) {
                        alert(xhr.responseJSON.error);
                    }
                });
            } else {
                $('#file-content').val('');
            }
        });

        $('#save-btn').click(function() {
            var file = $('#file-select').val();
            var content = $('#file-content').val();
            if (file) {
                $.ajax({
                    url: '{{ route('admin.blade.editor.update') }}',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        file: file,
                        content: content
                    },
                    success: function(response) {
                        alert(response.success);
                    },
                    error: function(xhr) {
                        alert(xhr.responseJSON.error);
                    }
                });
            }
        });
    });
</script>
@endpush
