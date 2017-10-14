<?php
namespace App\Helpers;

use Illuminate\Http\UploadedFile;
use Tests\TestCase;
use Dompdf\Dompdf;
use Mockery;
use App;

class HelperTest extends TestCase
{
    public function test_uploadImage()
    {
        $mockFile = Mockery::mock(UploadedFile::class)->makePartial();
        $mockFile->shouldReceive('getClientOriginalExtension')->once()->andReturn('fileimage');
        $mockFile->shouldReceive('move')->once();

        $helper = new Helper();
        $result = $helper->uploadImage($mockFile);

        $expectFile = time(). '.fileimage';
        $this->assertEquals($expectFile, $result);
    }

    public function test_generatePdf()
    {
        $mockPdf = Mockery::mock(Dompdf::class)->makePartial();
        $mockPdf->shouldReceive('loadHtml')->once()->with('content')->andReturn($mockPdf);
        $mockPdf->shouldReceive('render')->once()->andReturn($mockPdf);
        $mockPdf->shouldReceive('stream')->once()->andReturn($mockPdf);
        App::instance(Dompdf::class, $mockPdf);

        $helper = new Helper();
        $helper->generatePdf('content');
    }
}
