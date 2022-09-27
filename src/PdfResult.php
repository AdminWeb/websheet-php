<?php
namespace WebSheet\Sdk;

use DateTime;
use DateTimeInterface;

/**
 * Structure data class from result of api operation
 */
class PdfResult
{
    private function __construct(
        public string $id,
        public string $name,
        public string $url,
        public DateTime $createdAt,
    )
    {
    
    }
    
    /**
     * @param array $data
     * @return static
     */
    public static function fromArray(array $data): self
    {
        return new self(
            id: $data['id'],
            name: $data['name'],
            url:$data['url'],
            createdAt: DateTime::createFromFormat(DateTimeInterface::RFC3339_EXTENDED, $data['createdAt'])
        );
    }
    
    
}
