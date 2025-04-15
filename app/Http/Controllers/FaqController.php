<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{

    public function index()
    {
        $faqsProduct = Faq::where('category', 'product')->get();
        $faqsOrder = Faq::where('category', 'order')->get();
        $faqsDelivery = Faq::where('category', 'delivery')->get();
        $faqsOrderReceived = Faq::where('category', 'Order Received')->get();
        $faqsGeneral = Faq::where('category', 'general')->get();

        return view('frontend.faq', compact('faqsProduct', 'faqsOrder', 'faqsDelivery', 'faqsOrderReceived', 'faqsGeneral'));
    }

    public function faq()
    {
        $faqs = Faq::orderby('id', 'desc')->paginate(10);
        return view('admin.faq', compact('faqs'));
    }


    public function faqAdd()
    {
        return view('admin.faq-add');
    }

    public function faqStore(Request $request)
    {
        $request->validate([
            'question' => 'required',
            'answer' => 'required',
            'category' => 'required',
        ]);

        Faq::create($request->all());

        return redirect()->route('admin.faq')->with('success', 'FAQ added successfully.');
    }

    public function faqEdit($id)
    {
        $faq = Faq::findOrFail($id);
        return view('admin.faq-edit', compact('faq'));
    }

    public function faqUpdate(Request $request, $id)
    {
        $request->validate([
            'question' => 'required',
            'answer' => 'required',
            'category' => 'required',
        ]);

        $faq = Faq::findOrFail($id);
        $faq->update($request->all());

        return redirect()->route('admin.faq')->with('success', 'FAQ updated successfully.');
    }


    public function faqDelete($id)
    {
        $faq = Faq::findOrFail($id);
        $faq->delete();

        return redirect()->route('admin.faq')->with('success', 'FAQ deleted successfully.');
    }
}
