<?php

namespace App\Http\Controllers\Backend;

use App\Models\CommitteeApplication;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Mpdf\Mpdf;
use Mpdf\Config\ConfigVariables;
use Mpdf\Config\FontVariables;

class CommitteeApplicationController extends Controller
{
    public function index()
    {
        $applications = CommitteeApplication::latest()->paginate(20);
        return view('backend.committee_applications.index', compact('applications'));
    }

    public function show(CommitteeApplication $application)
    {
        return view('backend.committee_applications.show', compact('application'));
    }

    public function downloadPdf(CommitteeApplication $application, Request $request)
    {
        $html = view('backend.committee_applications.pdf', compact('application'))->render();

        $defaultConfig = (new ConfigVariables())->getDefaults();
        $fontDirs = $defaultConfig['fontDir'];

        $defaultFontConfig = (new FontVariables())->getDefaults();
        $fontData = $defaultFontConfig['fontdata'];

        $mpdf = new Mpdf([
            'mode'          => 'utf-8',
            'format'        => 'A4',
            'orientation'   => 'P',
            'margin_top'    => 15,
            'margin_bottom' => 15,
            'margin_left'   => 15,
            'margin_right'  => 15,
            'fontDir'       => array_merge($fontDirs, [storage_path('fonts')]),
            'fontdata'      => array_merge($fontData, [
                'notobengali' => [
                    'R' => 'NotoSansBengali-Regular.ttf',
                ],
            ]),
            'default_font'  => 'notobengali',
        ]);

        $mpdf->SetTitle($application->committee_type . ' কমিটি তালিকা');
        $mpdf->SetAuthor('BDHRP Admin');
        $mpdf->WriteHTML($html);

        $filename = 'committee-' . $application->id . '-' . $application->district . '.pdf';

        if ($request->query('inline') === '1') {
            return response($mpdf->Output($filename, 'S'))
                ->header('Content-Type', 'application/pdf')
                ->header('Content-Disposition', 'inline; filename="' . $filename . '"');
        }

        return response($mpdf->Output($filename, 'S'))
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'attachment; filename="' . $filename . '"');
    }

    public function updateStatus(Request $request, CommitteeApplication $application)
    {
        $request->validate([
            'status' => 'required|string|in:pending,approved,rejected',
        ]);

        $application->update(['status' => $request->status]);

        return redirect()->back()->with('success', 'Application status updated successfully.');
    }

    public function destroy(CommitteeApplication $application)
    {
        $application->delete();
        return redirect()->route('admin.committee-applications.index')->with('success', 'Application deleted successfully.');
    }
}
