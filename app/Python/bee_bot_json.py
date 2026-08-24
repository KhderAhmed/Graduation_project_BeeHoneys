import sys
import json
import os
import torch
from sentence_transformers import SentenceTransformer, util
import re

# ✅ دعم UTF-8 على Windows
if sys.platform.startswith('win'):
    sys.stdout.reconfigure(encoding='utf-8')
model = SentenceTransformer('sentence-transformers/paraphrase-multilingual-MiniLM-L12-v2')

# ✅ تحميل قاعدة البيانات
dataset_path = r'C:\Users\ASUSD\Desktop\beeHoneys\app\Python\dataset.json'

if not os.path.exists(dataset_path):
    print("❌ لم يتم العثور على ملف البيانات (dataset.json). تأكد من وجوده في المسار الصحيح.")
    sys.exit(1)

with open(dataset_path, 'r', encoding='utf-8') as f:
    qa_data = json.load(f)

# ✅ تجهيز الأسئلة باللغتين
questions_ar, answers_ar = [], []
questions_en, answers_en = [], []

for item in qa_data:
    q_ar = (item.get('question_ar') or "").strip()
    a_ar = (item.get('answer_ar') or "").strip()
    q_en = (item.get('question_en') or "").strip()
    a_en = (item.get('answer_en') or "").strip()

    if q_ar and a_ar:
        questions_ar.append(q_ar)
        answers_ar.append(a_ar)
    if q_en and a_en:
        questions_en.append(q_en)
        answers_en.append(a_en)

# ✅ تأكد من وجود بيانات
if not questions_ar and not questions_en:
    print("❌ قاعدة البيانات فارغة.")
    sys.exit(1)

# ✅ استقبال السؤال من المستخدم
if len(sys.argv) <= 1:
    print("❌ يرجى تمرير السؤال كمُدخل.")
    sys.exit(1)

user_question = " ".join(sys.argv[1:]).strip()

# ✅ كشف اللغة
def detect_language(text):
    if re.search(r'[\u0600-\u06FF]', text):
        return 'ar'
    return 'en'

lang = detect_language(user_question)

# ✅ اختيار مجموعة الأسئلة حسب اللغة
if lang == 'ar':
    question_set = questions_ar
    answer_set = answers_ar
else:
    question_set = questions_en
    answer_set = answers_en

# ✅ التحقق من وجود أسئلة باللغة المطلوبة
if not question_set:
    if lang == 'ar':
        print("❌ لا توجد أسئلة باللغة العربية في قاعدة البيانات حالياً.")
    else:
        print("❌ No Arabic questions in database.")
    sys.exit(1)

# ✅ إنشاء التمثيلات الشعاعية
question_embeddings = model.encode(question_set, convert_to_tensor=True)
user_embedding = model.encode(user_question, convert_to_tensor=True)

# ✅ حساب التشابه
similarities = util.cos_sim(user_embedding, question_embeddings)[0]
best_match_index = torch.argmax(similarities).item()
best_score = similarities[best_match_index].item()

# ✅ الرد النهائي بنفس اللغة
if best_score < 0.3:
    if lang == 'ar':
        print(f"🤔 لم أفهم سؤالك بوضوح. أقرب سؤال موجود:\n👉 {question_set[best_match_index]}\n\n💡 حاول إعادة صياغة السؤال.")
    else:
        print(f"🤔 I didn't quite understand. Closest match:\n👉 {question_set[best_match_index]}\n\n💡 Please rephrase your question.")
else:
    print(answer_set[best_match_index])