<?php

namespace Adminweb\Sdk;

use GuzzleHttp\Client;
use Adminweb\Sdk\Exception\PdfException;

/**
 * Class Pdf generator for PDF
 */
class Pdf
{
    private string $url = 'https://api.websheet.tech/';
    
    private string|null $templateEmailId = null;
    private string|null $to = null;
    
    /**
     * API Key for connect pdf generator service
     * @param string $key Api key from https://www.websheet.tech
     */
    public function __construct(private string $key)
    {
    }
    
    /**
     * Set template ID for send email with pdf file. Create the template on https://www.websheet.tech
     * @param string $id
     * @return $this
     */
    public function setTemplate(string $id)
    {
        $this->templateEmailId = $id;
        return $this;
    }
    
    /**
     * @param string $email Email of destinatary for receive the pdf file on email
     * @return $this
     */
    public function setDestinatary(string $email)
    {
        $this->to = $email;
        return $this;
    }
    
    /**
     * Generate PDF file in html
     * @param string $name Name of PDF file
     * @param string $content Content HTML of PDF file.
     * @return \Adminweb\Sdk\PdfResult
     * @throws \Adminweb\Sdk\Exception\PdfException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function make(string $name, string $content): PdfResult
    {
        try {
            $client = new Client([
                'base_uri' => $this->url,
                'headers' => [
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                    'x-api-key' => $this->key,
                    'User-Agent' => 'AW-SDK/1.0 (WebSheet)'
                ]
            ]);
            $response = $client->request('POST', '/pdf', [
                'json' => ['content' => $content, 'name' => $name, 'template' => $this->templateEmailId, 'to' => $this->to]
            ]);
            $data = json_decode($response->getBody()->getContents(), true);
            return PdfResult::fromArray($data);
            
        } catch (\Exception $e) {
            throw new PdfException($e->getMessage());
        }
    }
}
