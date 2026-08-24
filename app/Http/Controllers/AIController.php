<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Services\LangServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class AIController extends Controller
{
    public function __construct(protected LangServices $langServices)
    {
    }
    
    // عرض النموذج
    public function showForm()
    {
        $this->langServices->langFunction();
        return view('ai.form');
    }

    // تنفيذ السكربت والرد على السؤال
    public function getAnswer(Request $request)
    {
        $request->validate([
            'question' => 'required|string|max:255',
        ]);

        $userQuestion = $request->input('question');
        
        // ✅ 1. التحقق من Cache أولاً (للسؤال المتكرر = سرعة فورية)
        $cacheKey = 'bert_answer_' . md5($userQuestion);
        
        if (Cache::has($cacheKey)) {
            return view('ai.form', [
                'question' => $userQuestion,
                'answer' => Cache::get($cacheKey),
            ]);
        }
        
        // ✅ 2. استخدام BERT (الشبكة العصبية) لأول مرة فقط
        $escapedQuestion = escapeshellarg($userQuestion);
        
        // مسار سكربت بايثون (استخدم ملف BERT الأصلي)
        $scriptPath = base_path('app/Python/bee_bot_json.py');
        
        // مسار بايثون حسب نظام التشغيل
        $pythonPath = PHP_OS_FAMILY === 'Windows' 
            ? 'python' 
            : '/usr/bin/python3';
        
        // تنفيذ الأمر
        $command = "$pythonPath \"$scriptPath\" $escapedQuestion 2>&1";
        $output = shell_exec($command);
        
        if (empty($output) || trim($output) === '') {
            $output = "❌ النظام مشغول حالياً، يرجى المحاولة مرة أخرى.";
        }
        
        // ✅ 3. تخزين الإجابة في Cache لمدة ساعة (لأي سؤال مكرر)
        Cache::put($cacheKey, trim($output), 3600);
        
        return view('ai.form', [
            'question' => $userQuestion,
            'answer' => trim($output),
        ]);
    }
}