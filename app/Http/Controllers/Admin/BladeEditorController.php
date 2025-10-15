<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;

class BladeEditorController extends Controller
{
    public function index()
    {
        $files = $this->getBladeFiles(resource_path('views'));
        return view('admin.blade_editor.index', compact('files'));
    }

    public function show(Request $request)
    {
        $file = $this->sanitizePath($request->get('file'));

        if (!$this->isEditable($file)) {
            return response()->json(['error' => 'This file is not editable.'], 403);
        }

        $path = resource_path('views/' . $file);

        if (File::exists($path)) {
            $content = File::get($path);
            return response()->json(['content' => $content]);
        }

        return response()->json(['error' => 'File not found.'], 404);
    }

    public function update(Request $request)
    {
        $file = $this->sanitizePath($request->get('file'));
        $content = $request->get('content');

        if (!$this->isEditable($file)) {
            return response()->json(['error' => 'This file is not editable.'], 403);
        }

        $path = resource_path('views/' . $file);

        if (File::exists($path)) {
            File::put($path, $content);
            return response()->json(['success' => 'File updated successfully.']);
        }

        return response()->json(['error' => 'File not found.'], 404);
    }

    private function getBladeFiles($dir)
    {
        $files = [];
        $items = scandir($dir);

        foreach ($items as $item) {
            if ($item === '.' || $item === '..') {
                continue;
            }

            $path = $dir . '/' . $item;

            if (is_dir($path)) {
                $files = array_merge($files, $this->getBladeFiles($path));
            } elseif (Str::endsWith($item, '.blade.php')) {
                $file = str_replace(resource_path('views') . '/', '', $path);
                if ($this->isEditable($file)) {
                    $files[] = $file;
                }
            }
        }

        return $files;
    }

    private function sanitizePath($path)
    {
        return str_replace('..', '', $path);
    }

    private function isEditable($file)
    {
        $whitelist = [
            'frontend/about.blade.php',
            'frontend/contact.blade.php',
            'frontend/index.blade.php',
            'frontend/rooms.blade.php',
            'frontend/rooms_details.blade.php',
            'frontend/service.blade.php',
        ];

        return in_array($file, $whitelist);
    }
}
