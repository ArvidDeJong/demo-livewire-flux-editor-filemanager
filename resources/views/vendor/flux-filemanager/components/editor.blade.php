@props([
    'id' => null,
    'rows' => 12,
    'toolbar' => 'default', // 'default', 'minimal', 'full', or false for custom
    'dragDropMethod' => config('flux-filemanager.drag_drop.method', 'base64'),
    'uploadUrl' => config('flux-filemanager.drag_drop.upload_url'),
    'maxFileSize' => config('flux-filemanager.drag_drop.max_file_size'),
    'allowedTypes' => implode(',', config('flux-filemanager.drag_drop.allowed_types', [])),
])

@once
    <script>
        window.fluxFilemanagerConfig = {
            ...(window.fluxFilemanagerConfig || {}),
            filemanager_url: @json(config('flux-filemanager.url', '/filemanager')),
            popup_width: @json(config('flux-filemanager.popup.width', 900)),
            popup_height: @json(config('flux-filemanager.popup.height', 600)),
            popup_blocked_message: @json(config('flux-filemanager.messages.popup_blocked')),
            filemanager_error_message: @json(config('flux-filemanager.messages.filemanager_not_found')),
        }
    </script>
@endonce

<flux:editor :id="$id" {{ $attributes }} :rows="$rows"
    data-drag-drop-method="{{ $dragDropMethod }}" data-upload-url="{{ $uploadUrl }}"
    data-max-file-size="{{ $maxFileSize }}" data-allowed-types="{{ $allowedTypes }}">
    @if ($toolbar !== false)
        <flux:editor.toolbar>
            @if ($toolbar === 'minimal')
                {{-- Minimal toolbar: basic formatting only --}}
                <flux:editor.bold />
                <flux:editor.italic />
                <flux:editor.separator />
                <flux:editor.link />
            @elseif($toolbar === 'full')
                {{-- Full toolbar: all options --}}
                <flux:editor.heading />
                <flux:editor.separator />
                <flux:editor.bold />
                <flux:editor.italic />
                <flux:editor.strike />
                <flux:editor.underline />
                <flux:editor.separator />
                <flux:editor.bullet />
                <flux:editor.ordered />
                <flux:editor.blockquote />
                <flux:editor.separator />
                @include('flux-filemanager::flux.editor.image')
                <flux:editor.link />
                @include('flux-filemanager::flux.editor.file-link')
                @include('flux-filemanager::flux.editor.checklist')
                <flux:editor.separator />
                <flux:editor.align />
                <flux:editor.separator />
                <flux:editor.code />
            @else
                {{-- Default toolbar: most commonly used options --}}
                <flux:editor.heading />
                <flux:editor.separator />
                <flux:editor.bold />
                <flux:editor.italic />
                <flux:editor.strike />
                <flux:editor.separator />
                <flux:editor.bullet />
                <flux:editor.ordered />
                <flux:editor.blockquote />
                <flux:editor.separator />
                @include('flux-filemanager::flux.editor.image')
                <flux:editor.link />
                @include('flux-filemanager::flux.editor.file-link')
                @include('flux-filemanager::flux.editor.checklist')
                <flux:editor.separator />
                <flux:editor.align />
            @endif
        </flux:editor.toolbar>
    @else
        {{-- Custom toolbar via slot --}}
        {{ $slot }}
    @endif

    <flux:editor.content />
</flux:editor>
