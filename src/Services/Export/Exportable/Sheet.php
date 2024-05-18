<?php

class Sheet implements \App\Contracts\ExportableInterface
{
    public function __construct(private readonly \App\Contracts\ExportableSourceInterface $source)
    {

    }

    public function getData(): array
    {
        return $this->source->get();
    }

    public function getHeaders(): array
    {
        return [
            'id',
            'firstName',
            'lastName',
            'email',
            'username',
            'phone',
            'address',
        ];
    }
}
