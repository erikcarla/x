<?php
namespace App\Helpers;

use Dompdf\Dompdf;
use App;

class Helper
{
    public function uploadImage($image)
    {
        $filename = time().'.'.$image->getClientOriginalExtension();
        $destinationPath = public_path('/images');
        $image->move($destinationPath, $filename);

        return $filename;
    }

    public function generatePdf($content)
    {
        $dompdf = App::make(Dompdf::class);
        $dompdf->loadHtml($content);
        $dompdf->render();
        return $dompdf->stream();
    }
}
