<?php

namespace WebSheetTest\Sdk;

use Mockery;
use PHPUnit\Framework\TestCase;

class PdfTest extends TestCase
{
    /**
     * @test
     *
     */
    public function MakePdf()
    {
        $name = 'pdfFile.pdf';
        $htmlContent = '<h1>Pdf Title</h1>';
        
        $apiMock = Mockery::mock(\WebSheet\Sdk\Pdf::class,['api-key'])
            ->shouldReceive('make')
            ->andReturn(\WebSheet\Sdk\PdfResult::fromArray([
                'id'=>'1',
                'name'=>'pdf file',
                'url'=>'https://www.example.com/file.pdf',
                'createdAt'=>'2022-09-26T23:43:40.448Z'
            ]))
            ->getMock();
        
        $result = $apiMock->make(name: $name, content: $htmlContent);
        
        $this->assertInstanceOf(\WebSheet\Sdk\PdfResult::class, $result);
        
    }
}
