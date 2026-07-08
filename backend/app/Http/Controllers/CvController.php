<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cv;
use App\Models\CvTemplate;
use Spatie\Browsershot\Browsershot;

class CvController extends Controller
{
    public function templates()
    {
        $templates = CvTemplate::where('is_active', true)->get();
        return response()->json([
            'success' => true,
            'data' => $templates
        ]);
    }

    public function preview(Request $request)
    {
        $validated = $request->validate([
            'template_id' => 'required|exists:cv_templates,id',
            'data' => 'required|array',
        ]);

        $template = CvTemplate::findOrFail($validated['template_id']);
        $html = $this->renderCv(
            $template,
            $validated['data'],
        );
        return response($html, 200)
            ->header('Content-Type', 'text/html; charset=UTF-8');
    }

    //Génerer et download
    public function download(Request $request)
    {
        $validated = $request->validate([
            'template_id' => 'required|exists:cv_templates,id',
            'name' => 'required|string|max:50',
            'data' => 'required|array'
        ]);

        $template = CvTemplate::findOrFail($validated['template_id']);
        $html = $this->renderCv(
            $template,
            $validated['data']
        );

        if(auth()->check()){
            Cv::create([
                'user_id' => auth()->id(),
                'template_id' => $template->id,
                'name' => $validated['name'],
                'data' => $validated['data'],
                'last_downloaded_at' => now()
            ]);
        }

        $pdf = $this->generatePdf($html);
        return response($pdf, 200)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'attachment; filename="CV_' . str_replace(' ','_', $validated['name']) . '.pdf"');
    }

    //CV SAUVRGARDE
    public function mycvs()
    {
        $cvs = Cv::where('user_id', auth()->id())
            ->with('template')
            ->latest()
            ->get();
        return response()->json([
            'success' => true,
            'data' => $cvs
        ]);
    }

    // télecharger un cv qui a éte sauvegarder

    public function downloadCv($id)
    {
        $cv = Cv::where('user_id', auth()->id())
            ->with('template')
            ->findOrFail($id);

        $html = $this->renderCv($cv->template, $cv->data);

        $cv->update(['last_downloaded_at' => now()]);

        $pdf = $this->generatePdf($html);
        return response($pdf, 200)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'attachment; filename="CV_' . str_replace(' ','_', $cv->name) . '.pdf"');

    }

    public function destroy($id)
    {
        $cv = Cv::where('user_id', auth()->id())
            ->findOrFail($id);
        $cv->delete();
        return response()->json([
            'success' => true,
            'message' => "CV supprimé."
        ]);
    }

    private function renderCv(CvTemplate $template, array $data): string
    {
        return view($template->blade_view, [
            'data' => $data,
        ])->render();
    }

    private function generatePdf(string $html): string
    {
        return Browsershot::html($html)
            ->format('A4')
            ->showBackground()
            ->margins(10, 10, 10, 10)
            ->waitUntilNetworkIdle()
            ->pdf();
    }
}
